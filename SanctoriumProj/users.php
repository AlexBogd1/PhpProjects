<?php 


require_once "amo.php";
require_once 'loginMySql.php';
// подкл к базе данных 
$conn = new mysqli($hn, $un, $pw, $db);
mysqli_set_charset($conn, "utf8");
if($conn->connect_error) {
     die($conn ->connect_error);
 }
// получаем список пользователей
$accountInf = $amo->account;
$account = $accountInf->apiCurrent();
$usersAmo = $account['users'];

$users_for_db;

for($i =0; $i<count($usersAmo); $i++){
    $users_for_db[$i]['id'] = $usersAmo[$i]['id'];
    $users_for_db[$i]['name'] = $usersAmo[$i]['name'];
    $users_for_db[$i]['last_name'] = $usersAmo[$i]['last_name'];
    $users_for_db[$i]['group_id'] = $usersAmo[$i]['group_id'];
}

for($i =0; $i<count($users_for_db); $i++){
    $user_id = $users_for_db[$i]['id'];
    $user_name = $users_for_db[$i]['name'];
    $user_last = $users_for_db[$i]['last_name'];
    $user_group_id = $users_for_db[$i]['group_id'];
    $query = "INSERT INTO users VALUES('$user_id','$user_name','$user_last','$user_group_id','000')" ;
    $result = $conn->query($query);
    //if (!$result) die "Сбой при доступе к базе данных: " . $conn->error();
    
}

    $result->close();
    $conn -> close();

?>