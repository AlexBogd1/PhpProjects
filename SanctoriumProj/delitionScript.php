<?php
    
    $username = '';
    $password = '';
    $db = new PDO('mysql:host=localhost;dbname=', $username, $password);
    $db->exec("set names utf8");

     // принимаем POST запрос о удалении сделки

     $lead_id =  $_POST['leads']['delete'][0]['id'];
     $db->query("DELETE FROM leads WHERE Id='$lead_id'");   
     
?>