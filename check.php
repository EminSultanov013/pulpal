<?php
$request_body = file_get_contents('php://input');
$array = json_decode($request_body, true);
$key = "123"; //ключ безопасности, данная переменная должна совпадать с ключем указанным на сайте!!
$header = apache_request_headers();
$pulpal_signature = $header["Signature"]; //Получаем сигнатуру
$pulpal_nonce = intval($header["Nonce"]);
//формируем нашу сигнатуру
$my_signature = base64_encode(pack('H*',hash_hmac('sha256', "https://www.xedzi.com/check.php" . $pulpal_nonce . $request_body, $key)));
//если сигнатуры не совпадают выходим с ошибкой
if ($my_signature != $pulpal_signature) {
	exit('Верификация не пройдена. SHA1_HASH не совпадает.'); // останавливаем скрипт. у вас тут может быть свой код.
}
//если сигнатры сошлись, значит отправитель подленны, ниже можно писать код "что если оплата прошла успешно"
$idd=$array['UserData']; //переменная содержит идентификатор пользователя который мы указали в запросе 


?>
