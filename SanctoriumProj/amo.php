<?php
 require_once __DIR__ . '/amocrm.phar';

  use AmoCRM\Request\ParamsBag;

 try {
    // Создание клиента
    $domain = '';
    $email = '';
    $api = '';
    $amo = new \AmoCRM\Client($domain, $email, $api);
    // Получение экземпляра модели для работы с аккаунтом
   // $account = $amo->account;  
} catch (\AmoCRM\Exception $e) {
    printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}
	
 ?>
 
