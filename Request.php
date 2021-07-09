<?php

$payment_link = $pulpal->getUrl("GÖNDƏRMƏK İSTƏDİYİNİZ EXTERNAL ID", "QİYMƏT (QƏPİKLƏ)", "MƏHSULUN ADI VƏ İNFO"); // Burada "$payment_link" PulPal ödəmə sisteminə sorğu göndərmək üçündür.

class PaymentGatewayPulPal {
  private $testMerchantId = SATICININ TEST ID-si;
  private $testUrl = 'https://pay-dev.pulpal.az/payment';

  private $prodMerchantId = SATICININ PRODUCTION ID-si;
  private $prodUrl = 'https://pay.pulpal.az/payment';

  private $salt = 'BURADA SALT';
  private $repeatable = 'true';

  public $merchantId = '';
  public $gatewayUrl = '';
  public $env = ''; // Production mühitdə "production" dəyərinə ekvivalent olmalıdır.
  public $epochTime = '';
  public $externalId;
  public $price;
  public $nameAz = '';
  public $nameEn = '';
  public $nameRu = '';
  public $descAz = '';
  public $descEn = '';
  public $descRu = '';

  public function __construct()
  {
      //$this->env = app()->environment();
      $this->epochTime = $this->getEpochTime();

      if ($this->env == 'production') {
          $this->merchantId = $this->prodMerchantId;
          $this->gatewayUrl = $this->prodUrl;
      }
      else {
          $this->merchantId = $this->testMerchantId;
          $this->gatewayUrl = $this->testUrl;
      }
  }

  private function signature()
  {
      $signature =  $this->nameEn
          . $this->nameAz
          . $this->nameRu
          . $this->descEn
          . $this->descRu
          . $this->descAz
          . $this->merchantId
          . $this->externalId
          . $this->price
          . $this->epochTime
          . $this->salt;
          
      return sha1($signature);
  }


  private function apiParams()
  {
      $params = [
          'merchantId' => $this->merchantId,
          'price' => $this->price,
          'repeatable' => $this->repeatable,
          'name_az' => $this->nameAz,
          'name_ru' => $this->nameRu,
          'name_en' => $this->nameEn,
          'description_en' => $this->descEn,
          'description_ru' => $this->descRu,
          'description_az' => $this->descAz,
          'externalId' => $this->externalId,
          'signature2' => $this->signature(),
      ];

      return $params;
  }


  public function getUrl($id, $price, $name)
  {
      $this->externalId = $id;
      $this->price = $price;
      $this->nameAz = $name;
      $this->nameEn = $name;
      $this->nameRu = $name;
      $this->descAz = $name;
      $this->descEn = $name;
      $this->descRu = $name;

      $params = $this->apiParams();

      return $this->gatewayUrl . '?' . http_build_query($params);
  }


  public function getEpochTime()
  {
      return intval((time()*1000) / 300000);
  }
}

?>