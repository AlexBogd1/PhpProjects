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
$db = new PDO('mysql:host=localhost;dbname=#########', $username, $password);
$db->exec("set names utf8");

//получили дату начала (понадобится только для первого раза)
$timethatmonth = mktime(0, 0, 0, date("m"),   1,   date("Y")); 

$stmt = $db->query('SELECT max(`last_modified`) FROM `notes_statchange`');
$timelastupdate =  $stmt->fetchAll()[0][0]-1;

$notes_list = get_notes_list($timelastupdate);

//отправляем инфу по договорам в БД
for($i=0;$i<count($notes_list);$i++) {
$stmt = $db->query("SELECT COUNT(*) FROM `notes_statchange` WHERE id = ".$notes_list[$i]['id']); //берём id договора из БД
$callback = $stmt->fetchAll();

$text = json_decode($notes_list[$i]["text"],true);
$STATUS_NEW = $text['STATUS_NEW'];
$STATUS_OLD = $text['STATUS_OLD'];
$PIPELINE_ID_NEW = $text["PIPELINE_ID_NEW"];
$PIPELINE_ID_OLD = $text["PIPELINE_ID_OLD"];

if($callback[0]['COUNT(*)'] > 0) {
$sql = "UPDATE notes_statchange SET 
	element_id='".$notes_list[$i]['element_id']."',
	element_type='".$notes_list[$i]['element_type']."',
	note_type='".$notes_list[$i]['note_type']."',
	date_create='".$notes_list[$i]['date_create']."',
	created_user_id='".$notes_list[$i]['created_user_id']."',
	last_modified='".$notes_list[$i]['last_modified']."',
	STATUS_NEW='".$STATUS_NEW."',
	STATUS_OLD='".$STATUS_OLD."',
	PIPELINE_ID_NEW='".$PIPELINE_ID_NEW."',
	PIPELINE_ID_OLD='".$PIPELINE_ID_OLD."',
 
WHERE id=".$notes_list[$i]['id'];
$stmt = $db->prepare($sql);
$stmt->execute();
}
else {
	$db->query("INSERT INTO notes_statchange SET 
	id='".$notes_list[$i]['id']."',
	element_id='".$notes_list[$i]['element_id']."',
	element_type='".$notes_list[$i]['element_type']."',
	note_type='".$notes_list[$i]['note_type']."',
	date_create='".$notes_list[$i]['date_create']."',
	created_user_id='".$notes_list[$i]['created_user_id']."',
	last_modified='".$notes_list[$i]['last_modified']."',
	STATUS_NEW='".$STATUS_NEW."',
	STATUS_OLD='".$STATUS_OLD."',
	PIPELINE_ID_NEW='".$PIPELINE_ID_NEW."',
	PIPELINE_ID_OLD='".$PIPELINE_ID_OLD."'");
	$insertId=$db->lastInsertId();
}
}

/////////////////////////////////ФУНКЦИИ///////////////////////////////////////////////////////
function new_notes_statchange($timetoday) {
	global $amo;
		return $amo->note->apiList([
        'type' => 'lead',
		'note_type' => 3,
    ], $timetoday);
};

function get_notes_list($date_start) {
$time_start = date("Y-m-d H:i:s",$date_start);
$array_new_notes = new_notes_statchange($time_start);
$notes_list = $array_new_notes;
$a = count($array_new_notes);
$last_note = array_pop($array_new_notes);
	while($a == 500) {
		$last_note = array_pop($array_new_notes);
		$array_new_notes = new_notes_statchange(date("Y-m-d H:i:s",$last_note['last_modified']));
		$a = count($array_new_notes); 
		$notes_list = array_merge($notes_list, $array_new_notes);
		sleep(1);
	}
return $notes_list;
};

function vardump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}
?>