<?
php
date_default_timezone_set('Asia/Baku');


include('connection.php');


$status = $_GET["Status"];
 // Uğurludursa, "success", səhv baş verərsə, "error", alıcı tərəfindən ləğv edildikdə isə "canceled" cavabı verir.
$external_id = $_GET["ExternalId"]; // Ödəməni həyata keçirən alıcı tərəfindən uğurlu ödəniş zamanı Delivery - ə göndərilən dəyişən.

?>
