<?php 


require_once "amo.php";

//подключаем БД
$username = '';
$password = '';
$db = new PDO('mysql:host=localhost;dbname=#######', $username, $password);
$db->exec("set names utf8");
// получаем список пользователей
$accountInf = $amo->account;
$account = $accountInf->apiCurrent();
$usersAmo = $account['users'];

$users_for_db;
// получаем юзеров из amo
for($i =0; $i<count($usersAmo); $i++){
    $users_for_db[$i]['id'] = $usersAmo[$i]['id'];
    $users_for_db[$i]['name'] = $usersAmo[$i]['name'];
    $users_for_db[$i]['last_name'] = $usersAmo[$i]['last_name'];
    $users_for_db[$i]['group_id'] = $usersAmo[$i]['group_id'];
}

echo "<pre>";
print_r($users_for_db);
echo "<pre>";

$stmt =  $db->query("SELECT * FROM users ");
$userInf = $stmt->fetchAll();

// echo "юзеры из бд";
// echo "<pre>";
// print_r($userInf);
// echo "<pre>";

// сравниваем юзеров
$result_users= array();

$r = false;
for($i=0;$i<count($users_for_db); $i++){
    global $r;
     for($j=0; $j< count($userInf); $j++){
        if($users_for_db[$i]['id']===$userInf[$j]['id']){
            $r = false; 
            break 1;
         } $r= true;           
     } 
     if($r){
        array_push($result_users, $users_for_db[$i]);   
     }
     $r = false; 
}

if(count($userInf)==0){
    $result_users = $users_for_db;
} 

// echo "<массив перед загр в бд>"."<br>";
// echo "<pre>";
// print_r(count($result_users));
// echo "</pre>";

for($i =0; $i<count($result_users); $i++){
    $user_id = $result_users[$i]['id'];
    $user_name = $result_users[$i]['name'];
    $user_last = $result_users[$i]['last_name'];
    $user_group_id = $result_users[$i]['group_id'];
    $db->query("INSERT INTO users VALUES('$user_id','$user_name','$user_last','$user_group_id','000')");
}
    


?>