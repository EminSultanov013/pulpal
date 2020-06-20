# pulpal подключение платежной системы
Для совершения оплаты пользователю необходимо перейти по ссылке
https://pay-dev.pulpal.az/payment?paymentdata=eyJwcm9kdWN0VW5pcXVlQ29kZSI6ICIzNTk0NCJ9&email=821test

paymentdata - строка закодированная base64 ({"productUniqueCode": "35944"}) содержит код продукта на сайте pulpal.az.
Параметр email может содержать любую информацию о пользователе (email, номер телефона, id)

Для проверки платежа используется скрипт check.php, после успешной оплаты на него приходит сл. запрос:
<pre>
a:9:{s:5:"Price";i:12300;s:4:"Debt";i:0;s:11:"ProductType";i:1;s:10:"ExternalId";s:0:"";s:6:"Amount";i:3407;s:8:"UserData";s:7:"821test";s:12:"ProviderType";i:1;s:14:"PaymentAttempt";s:36:"3fedf186-da46-4456-9004-82f7d6671f16";s:18:"CustomMerchantName";N;}
</pre>

В файле check.php описан способ проверки подписи. 
