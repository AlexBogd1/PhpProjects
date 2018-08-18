
<?php 
//выводим все возможные ошибки на экран
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//подключаем БД
$username = '';
$password = '';
$db = new PDO('mysql:host=localhost;dbname=#########', $username, $password);
$db->exec("set names utf8");

//определяем даты
$timethatmonth = mktime(0, 0, 0, date("m"),   1,   date("Y"));
$timetoday = mktime(date("H")+3, date("i"), date("s"), date("m"),   date("d"),   date("Y"));
$timeyesterday = mktime(0, 0, 0, date("m"),   date("d")-1,   date("Y"));
$timetoda =  gmdate("d-m-Y H:i:s", $timetoday);
//Вынимаем время последней записи в БД
$stmt = $db->query('SELECT MAX(last_modified) FROM leads');
$time = $stmt->fetchAll()[0]["MAX(last_modified)"];
$time = gmdate("d-m-Y H:i:s", $time);

//Количество лидов
$stmt = $db->query('SELECT COUNT(*) FROM leads WHERE `date_create` >= '.$timethatmonth);
$countleadsthismonth = $stmt->fetchAll()[0]["COUNT(*)"];

$stmt = $db->query('SELECT COUNT(*) FROM leads WHERE `date_create` >= '.$timetoday);
$countleadsthisday = $stmt->fetchAll()[0]["COUNT(*)"];

$stmt = $db->query('SELECT COUNT(*) FROM leads WHERE (`date_create` >= '.$timeyesterday.' and `date_create` < '.$timetoday.')');
$countleadsyesterday = $stmt->fetchAll()[0]["COUNT(*)"];

//создаем массив users для менеджеров 
$stmt =  $db->query("SELECT * FROM users WHERE users.group_id IN (188883,188880)");
$userInf = $stmt->fetchAll();
// извлекаем кол строк в таблице
$managerresult;
for($i =0; $i<count($userInf); $i++ ){
    $managerresult[$i]['id'] = $userInf[$i]['id'];
    $managerresult[$i]['name'] = $userInf[$i]['name'];
  }
  
  for ($i=0; $i<count($managerresult);$i++){
    $managerresult[$i]['number_selles'] = number_selles($managerresult[$i]['id'],$timethatmonth);   
    $managerresult[$i]['sales_sum'] = sum_sellers($managerresult[$i]['id'],$timethatmonth );
       
  }
  //сортируем менеджеров
  $price = array();
  foreach ($managerresult as $key => $row)
  {
      $price[$key] = $row['sales_sum'];
  }
  array_multisort($price, SORT_DESC,SORT_NUMERIC, $managerresult);
  

//Количество продаж
$counttodaypay = countpay($timetoday);
$countyesterdaypay = countpay($timeyesterday) - $counttodaypay;
$countmonthypay = countpay($timethatmonth);

//Сумма продаж
$sumtodaypay = sumpay($timetoday);
$sumyesterdaypay = sumpay($timeyesterday) - $sumtodaypay;
$summonthypay = sumpay($timethatmonth);


$summonthypay = number_format( $summonthypay,0,',',' ');


//Количество договоров
$counttodaycontracts = howmanycontracts($timetoday);
$countyesrerdaycontracts = howmanycontracts($timeyesterday)-$counttodaycontracts;
$countmonthcontracts = howmanycontracts($timethatmonth);




// echo "<pre>";
// print_r($managerresult);
// echo "</pre>";

//упаковыываем и отправляем json на сайт
$json = json_encode(array(
"managerresult" => $managerresult, 
"countleadsthismonth" => $countleadsthismonth,
"countleadsthisday" => $countleadsthisday,
"countleadsyesterday" => $countleadsyesterday,
"counttodaycontracts" => $counttodaycontracts,
"countyesrerdaycontracts" => $countyesrerdaycontracts,
"countmonthcontracts" => $countmonthcontracts,
"counttodaypay" => $counttodaypay,
"countyesterdaypay" => $countyesterdaypay,
"countmonthypay" => $countmonthypay,
"sumtodaypay" => $sumtodaypay,
"sumyesterdaypay" => $sumyesterdaypay,
"summonthypay" => $summonthypay,
"time" => $timetoda));

echo $json;


/////////////////////////////////ФУНКЦИИ///////////////////////////////////////////////////////
function howmanycontracts($datestart) {
	global $db;
	$stmt = $db->query('SELECT count(DISTINCT `element_id`) FROM `notes_statchange` WHERE (`date_create` >='.$datestart.' AND `STATUS_NEW`=14186782 AND `PIPELINE_ID_NEW` = 514933)');
	$res = $stmt->fetchAll()[0][0];
	return  $res;
}

function sumpay($datestart) {
global $db;
$datestart = date("Y-m-d",$datestart);
$stmt = $db->query('SELECT sum(sum_prepay) FROM leads WHERE `date_prepay` >= "'.$datestart.'"');
$a = $stmt->fetchAll()[0][0];
$stmt = $db->query('SELECT sum(sum_all_pay) FROM leads WHERE `date_all_pay` >= "'.$datestart.'"');
$b = $stmt->fetchAll()[0][0];
return round($a + $b,2);
};

function countpay($datestart) {
global $db;
$datestart = date("Y-m-d",$datestart);
$stmt = $db->query('SELECT sum(sum_prepay/price) FROM leads WHERE `date_prepay` >= "'.$datestart.'"');
$a = $stmt->fetchAll()[0][0];
$stmt = $db->query('SELECT sum(sum_all_pay/price) FROM leads WHERE `date_all_pay` >= "'.$datestart.'"');
$b = $stmt->fetchAll()[0][0];
return round($a + $b,2);
}



function sum_sellers($user_id, $date_start) {
    global $db;
    $datestart = date("Y-m-d",$date_start);
    $stmt = $db->query("SELECT SUM( leads.sum_prepay * (100 - leads.percent_share)/100) FROM leads 
    WHERE (leads.responsible_user_id = '$user_id' and DATE(leads.date_prepay) >= '$datestart') ");
    $a = $stmt->fetchAll()[0][0];
    $stmt = $db->query("SELECT SUM( leads.sum_all_pay * (100 - leads.percent_share)/100) FROM leads
    WHERE (leads.responsible_user_id = '$user_id' and leads.date_all_pay >= '$datestart') ");
    $b = $stmt->fetchAll()[0][0];
    $stmt = $db->query(" SELECT SUM(leads.sum_prepay * (leads.percent_share / 100)) FROM leads 
    WHERE (leads.manager_share = '$user_id' and leads.date_prepay >= '$datestart') ");
    $c = $stmt->fetchAll()[0][0];
    $stmt = $db->query("SELECT SUM(leads.sum_all_pay * (leads.percent_share / 100)) FROM leads
    WHERE (leads.manager_share = '$user_id' and leads.date_all_pay >= '$datestart') ");
    $d = $stmt->fetchAll()[0][0];

    return round($a + $b + $c + $d,2);
	};
	
function number_selles($user_id, $date_start){
    global $db;
    $datestart = date("Y-m-d",$date_start);
    $stmt = $db->query("SELECT SUM(leads.sum_prepay/leads.price * (100 - leads.percent_share)/100) FROM leads 
    WHERE (leads.responsible_user_id = '$user_id' and leads.date_prepay >= '$datestart') ");
    $a = $stmt->fetchAll()[0][0];
    $stmt = $db->query("SELECT SUM(leads.sum_all_pay/leads.price * (100 - leads.percent_share)/100) FROM leads
    WHERE (leads.responsible_user_id = '$user_id' and leads.date_all_pay >= '$datestart') ");
    $b = $stmt->fetchAll()[0][0];
    $stmt = $db->query("SELECT SUM(leads.sum_prepay/leads.price * (leads.percent_share / 100)) FROM leads 
    WHERE (leads.manager_share = '$user_id' and leads.date_prepay >= '$datestart')" );
    $c = $stmt->fetchAll()[0][0];
    $stmt = $db->query("SELECT SUM(leads.sum_all_pay/leads.price * (leads.percent_share / 100)) FROM leads
    WHERE (leads.manager_share = '$user_id' and leads.date_all_pay >= '$datestart') " );
    $d = $stmt->fetchAll()[0][0];
    return round($a + $b + $c + $d,2);
  }

//   echo "<pre>";
//   print_r($managerresult);
//   echo "</pre>";
  // function vardump($var) {

	//   echo '<pre>';
//   var_dump($var);
//   echo '</pre>';
// }


?>
