
<?php 
	$autorization_login = '';
	$autorization_password = '';
	session_start();
    if($autorization_login == $_POST['login'] && $autorization_password == $_POST['password']){
		$_SESSION['a'] = true;		
		exit(header('Location:/main.php'));
				
      } else {
		
		  exit(header('Location:/index.html'));
		}

?> 