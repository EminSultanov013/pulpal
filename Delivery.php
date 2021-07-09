<?php

date_default_timezone_set('Asia/Baku');
$date_time = date("Y-m-d H:i:s");

include('connection.php');

$request_body = file_get_contents('php://input');
$array = json_decode($request_body, true);

$header = apache_request_headers();
$pulpal_signature = $header["Signature"];
$pulpal_nonce = intval($header["Nonce"]);
$my_signature = base64_encode(pack('H*',hash_hmac('sha256', "BURADA DELIVERY URL" . $pulpal_nonce . $request_body, "BURADA KEY")));

$sql = "SELECT * FROM payment WHERE variable = 'nonce' LIMIT 1"; // Siz Nonce - i verilənlər bazasında başqa cür də saxlaya bilərsiniz.
$result = mysqli_query($conn, $sql);
$my_nonce = intval(mysqli_fetch_array($result)["value"]);

if ($pulpal_signature == $my_signature && $my_nonce < $pulpal_nonce && $my_nonce > ($pulpal_nonce - 2))
{
    // İmza və Nonce uğurlu olduqda bu execute olur.
}
elseif ($pulpal_nonce > 0)
{
    // İmza və ya Nonce düzgün olmadığı halda bu execute olur.
}
else
{
    // Kənardan boş-boşuna açıldısa, bu execute olur.
    return;
}

// Burada ödəmə uğurlu olduqdan sonrakı funksiyalar.

?>