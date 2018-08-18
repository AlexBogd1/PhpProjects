<?php 
//выводим все возможные ошибки на экран
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//подключаем amoCRM
require_once __DIR__ . '/amocrm.phar';
$domain = '';
$email = '';
$api = '';
$amo = new \AmoCRM\Client($domain, $email, $api);

//подключаем БД
$username = '';
$password = '';
$db = new PDO('mysql:host=localhost;dbname=sanprimo_dboard', $username, $password);
$db->exec("set names utf8");

//получили дату начала (понадобится только для первого раза)
$timethatmonth = mktime(0, 0, 0, date("m"),   1,   date("Y")); 
$timetoday = mktime(0, 0, 0, date("m"),   date("d"),   date("Y"));

$stmt = $db->query('SELECT max(`last_modified`) FROM `leads`');
$timelastupdate =  $stmt->fetchAll()[0][0]-1;
//vardump($timelastupdate);

$leads_list = get_leads_list($timelastupdate); //получили список лидов
//отправляем инфу по лидам в БД

function add_data_in_db($leads_list) {
	global $db;
for($i=0;$i<count($leads_list);$i++) {
$stmt = $db->query("SELECT COUNT(*) FROM leads WHERE id = ".$leads_list[$i]['id']); //берём id лида из БД
$callback = $stmt->fetchAll();

$sanprice = findcustomfieldval($leads_list[$i], '438801');
$commission = findcustomfieldval($leads_list[$i], '438789');
$sum_prepay = findcustomfieldval($leads_list[$i], '438791');
$date_prepay = findcustomfieldval($leads_list[$i], '438793');
$sum_all_pay = findcustomfieldval($leads_list[$i], '438795');
$date_all_pay = findcustomfieldval($leads_list[$i], '430489');
$manager_share = findcustomfieldval($leads_list[$i], '449788');
$percent_share = findcustomfieldval($leads_list[$i], '449786');

if($callback[0][0] > 0) {
$sql = "UPDATE leads SET 
	name='".$leads_list[$i]['name']."',
	date_create='".$leads_list[$i]['date_create']."',
	created_user_id='".$leads_list[$i]['created_user_id']."',
	last_modified='".$leads_list[$i]['last_modified']."',
	price='".$leads_list[$i]['price']."',
	responsible_user_id='".$leads_list[$i]['responsible_user_id']."',
	pipeline_id='".$leads_list[$i]['pipeline_id']."',
	date_close='".$leads_list[$i]['date_close']."',
	closest_task='".$leads_list[$i]['closest_task']."',
	loss_reason_id='".$leads_list[$i]['loss_reason_id']."',
	deleted='".$leads_list[$i]['deleted']."',
	status_id='".$leads_list[$i]['status_id']."',
	sanprice='".$sanprice."',
	commission='".$commission."',
	sum_prepay='".$sum_prepay."',
	date_prepay='".$date_prepay."',
	sum_all_pay='".$sum_all_pay."',
	date_all_pay='".$date_all_pay."',
	manager_share='".$manager_share."',
	percent_share='".$percent_share."'
 
WHERE id=".$leads_list[$i]['id'];
$stmt = $db->prepare($sql);
$stmt->execute();
}
else {
	$db->query("INSERT INTO leads SET 
	id='".$leads_list[$i]['id']."',
	name='".$leads_list[$i]['name']."',
	date_create='".$leads_list[$i]['date_create']."',
	created_user_id='".$leads_list[$i]['created_user_id']."',
	last_modified='".$leads_list[$i]['last_modified']."',
	price='".$leads_list[$i]['price']."',
	responsible_user_id='".$leads_list[$i]['responsible_user_id']."',
	pipeline_id='".$leads_list[$i]['pipeline_id']."',
	date_close='".$leads_list[$i]['date_close']."',
	closest_task='".$leads_list[$i]['closest_task']."',
	loss_reason_id='".$leads_list[$i]['loss_reason_id']."',
	deleted='".$leads_list[$i]['deleted']."',
	status_id='".$leads_list[$i]['status_id']."',
	sanprice='".$sanprice."',
	commission='".$commission."',
	sum_prepay='".$sum_prepay."',
	date_prepay='".$date_prepay."',
	sum_all_pay='".$sum_all_pay."',
	date_all_pay='".$date_all_pay."',
	manager_share='".$manager_share."',
	percent_share='".$percent_share."'");
	$insertId=$db->lastInsertId();
}
}
}

/////////////////////////////////ФУНКЦИИ///////////////////////////////////////////////////////
function findcustomfieldval($leadarray, $customfieldid ) {
	for($i=0;$i<count($leadarray["custom_fields"]);$i++) {
		if($leadarray["custom_fields"][$i]['id'] == $customfieldid) {
			$array = array();
			for($j=0;$j<count($leadarray["custom_fields"][$i]["values"]);$j++) {
			array_push($array, $leadarray["custom_fields"][$i]["values"][$j]['value']);	
			}
			return implode(",",$array);
		}
	}
}
function new_leads($time_start,$offset) {
	global $amo;
		return $amo->lead->apiList([
		'limit_rows' => 500,
		'limit_offset' => $offset,
    ], $time_start);
};
function get_leads_list($date_start) {
$time_start = date("Y-m-d H:i:s",$date_start);
$array_new_leads = new_leads($time_start,0);
//$leads_list = $array_new_leads;
$a = count($array_new_leads);
add_data_in_db($array_new_leads);
	while(($a % 500) == 0) {
		$array_new_leads = new_leads($time_start,$a);
		$a = $a+count($array_new_leads); 
//		$leads_list = array_merge($leads_list, $array_new_leads);
		add_data_in_db($array_new_leads);
		sleep(1);
	}
//return $leads_list;
}
function vardump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}
?>