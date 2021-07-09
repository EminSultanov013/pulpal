<!DOCTYPE html>
<html>
<head>
<title>PulPal odenis sistemi</title>
</head>
<body>

<form action="https://pay.pulpal.az/payment?" method="GET" >

<input type="hidden" name="externalId" value="{user_id}" >
<input type="hidden" name="name_az" value="mehsul_az">
<input type="hidden" name="name_ru" value="mehsul_ru">
<input type="hidden" name="name_en" value="mehsul_en">
<input type="hidden" name="price" value="1">   <!-- qepikle meselen: 1 AZN  = 100 kimi yazilacaq -->
<input type="hidden" name="merchantId" value="{MERCHANT_ID}">

<input type="submit" value="gonder" > 
</form>

</body>
</html>
