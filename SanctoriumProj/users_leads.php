<?php
    
// $username = '';
// $password = '';
    
// $db = new PDO('mysql:host=localhost;dbname=', $username, $password);
// $db->exec("set names utf8");
 
// $timethatmonth = mktime(0, 0, 0, date("m")-1,   1,   date("Y"));
// $timetoday = mktime(date("H")+3, date("i"), date("s"), date("m"),   date("d"),   date("Y"));
// $timeyesterday = mktime(0, 0, 0, date("m"),   date("d")-1,   date("Y"));
 
// $time = gmdate("Y-m-d ", $timethatmonth);
// //  $query = " SELECT SUM(leads.sum_all_pay/leads.price * (leads.percent_share / 100)) FROM leads
// //  WHERE (leads.manager_share = 2449165 and leads.date_all_pay >= '$time')";
 
               
//                // + 
// // select sum_prepay * (percent_share / 100) where (manager_share = id_manager and date_prepay >= Дата начала месяца) +
// //  select sum_all_pay * (percent_share / 100) where (manager_share = id_manager and date_all_pay >= Дата начала месяца)"
 
// $stmt =  $db->query("SELECT * FROM users");
// $userInf = $stmt->fetchAll();
// // извлекаем кол строк в таблице
// $users;
// for($i =0; $i<count($userInf); $i++ ){
//     $users[$i]['id'] = $userInf[$i]['id'];
//     $users[$i]['name'] = $userInf[$i]['name'];
//   }
  
//   for ($i=0; $i<count($users);$i++){
//         $users[$i]['sales_sum'] = sum_sellers($users[$i]['id'],$timethatmonth );
//         $users[$i]['number_selles'] = number_selles($users[$i]['id'],$timethatmonth);
//   }

//   echo "<pre>";
//   print_r($users);
//   echo "</pre>";
  
//   function sum_sellers($user_id, $date_start) {
//     global $db;
//     $datestart = gmdate("Y-m-d ", $datestart);
//     $stmt = $db->query("SELECT SUM( leads.sum_prepay * (100 - leads.percent_share)/100) FROM leads, users 
//     WHERE (leads.responsible_user_id = '$user_id' and DATE(leads.date_prepay) >= '$date_start') ");
//     $a = $stmt->fetchAll()[0][0];
//     $result = $db->query("SELECT SUM( leads.sum_all_pay * (100 - leads.percent_share)/100) FROM leads, users 
//     WHERE (leads.responsible_user_id = '$user_id' and leads.date_all_pay >= '$date_start') ");
//     $b = $stmt->fetchAll()[0][0];
//     $result = $db->query(" SELECT SUM(leads.sum_prepay * (leads.percent_share / 100)) FROM leads, users 
//     WHERE (leads.manager_share = '$user_id' and leads.date_prepay >= '$date_start') ");
//     $c = $stmt->fetchAll()[0][0];
//     $result = $db->query("SELECT SUM(leads.sum_all_pay * (leads.percent_share / 100)) FROM leads, users
//     WHERE (leads.manager_share = '$user_id' and leads.date_all_pay >= '$date_start') ");
//     $d = $stmt->fetchAll()[0][0];

//     return round($a + $b + $c + $d,2);
//     };

//   function number_selles($user_id, $date_start){
//     global $db;
//     $datestart = gmdate("Y-m-d ", $datestart);
//     $stmt = $db->query("SELECT SUM(leads.sum_prepay/leads.price * (100 - leads.percent_share)/100) FROM leads 
//     WHERE (leads.responsible_user_id = '$user_id' and leads.date_prepay >= '$date_start') ");
//     $a = $stmt->fetchAll()[0][0];
//     $stmt = $db->query("SELECT SUM(leads.sum_all_pay/leads.price * (100 - leads.percent_share)/100) FROM leads
//     WHERE (leads.responsible_user_id = '$user_id' and leads.date_all_pay >= '$date_start') ");
//     $b = $stmt->fetchAll()[0][0];
//     $stmt = $db->query("SELECT SUM(leads.sum_prepay/leads.price * (leads.percent_share / 100)) FROM leads 
//     WHERE (leads.manager_share = '$user_id' and leads.date_prepay >= '$date_start')" );
//     $c = $stmt->fetchAll()[0][0];
//     $stmt = $db->query("SELECT SUM(leads.sum_all_pay/leads.price * (leads.percent_share / 100)) FROM leads
//     WHERE (leads.manager_share = '$user_id' and leads.date_all_pay >= '$date_start') " );
//     $d = $stmt->fetchAll()[0][0];
//     return round($a + $b + $c + $d,2);
//   }




    // $query = "INSERT INTO users VALUES('$user_id','$user_name','$user_last','$user_group_id','000')" ;
    // $result = $conn->query($query);
?>