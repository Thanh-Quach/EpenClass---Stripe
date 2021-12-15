<?php
//POST user login authentication Token
//domain: auth API
    $usrHeader = [
    	'content-type: application/json',
    ];

    $usrInf = [
          "accountId"=>$accountId,
          "password"=>$password,
    ];

    $usr = curl_init();
       curl_setopt($usr, CURLOPT_URL,'https://auth.epenbuk.com:8443/ePenDataApi-0.0.1-SNAPSHOT/account/session');
       curl_setopt($usr, CURLOPT_POST,1);
       curl_setopt($usr, CURLOPT_POSTFIELDS, json_encode($usrInf));
       curl_setopt($usr, CURLOPT_RETURNTRANSFER,true);
       curl_setopt($usr, CURLOPT_HTTPHEADER, $usrHeader);
       $user = curl_exec ($usr);
       curl_close ($usr);

//if redirect by AdminAPI-> admin token else teacher or student token
   $authToken = 'bearer '.json_decode($user)->content->tokenId;
?>