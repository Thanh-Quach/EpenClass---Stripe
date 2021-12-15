<?php
include './04_RestAPI/admin.php';
include './04_RestAPI/token.php';

  $headers = [
      'content-type: application/json',
      'Authorization: '.$authToken,
  ];

   $AccPaymnt = curl_init();
   curl_setopt($AccPaymnt , CURLOPT_URL,"https://admin.epenbuk.com/api/Setting/GetAccountPayment");
   curl_setopt($AccPaymnt , CURLOPT_RETURNTRANSFER, true);
   curl_setopt($AccPaymnt , CURLOPT_HTTPHEADER, $headers);
   $AccPaymn = curl_exec ($AccPaymnt);
   curl_close ($AccPaymnt);

?>
