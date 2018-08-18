<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Дэшборды для отделов продаж</title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <body>
  <div class="ribbon"></div>
  <div class="login">
  <h1>Авторизация на сайте.</h1>
  <p></p>
  <form action="check_aut.php" method="POST">
    <div class="input">
      <div class="blockinput">
        <i class="icon-envelope-alt"></i><input type="mail" placeholder="Логин" name = "login">
      </div>
      <div class="blockinput">
        <i class="icon-unlock"></i><input type="password" placeholder="Пароль" name = "password">
      </div>
    </div>
    <button>Войти</button>
  </form>
  </div>
</body>
  
  
</body>
</html>
<?php
     session_start();
      $_SESSION['a']=false;
      session_destroy();
?> 