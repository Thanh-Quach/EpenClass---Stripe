<?php

    $usrHeader = [
      'content-type: application/json',
    ];

    $usrInf = [
          "accountId"=>$_POST['accountId'],
    ];

    $usr = curl_init();
       curl_setopt($usr, CURLOPT_URL,'https://auth.epenbuk.com:8443/ePenDataApi-0.0.1-SNAPSHOT/account/send/mail');
       curl_setopt($usr, CURLOPT_POST,1);
       curl_setopt($usr, CURLOPT_POSTFIELDS, json_encode($usrInf));
       curl_setopt($usr, CURLOPT_RETURNTRANSFER,true);
       curl_setopt($usr, CURLOPT_HTTPHEADER, $usrHeader);
       $user = curl_exec ($usr);
       curl_close ($usr);


if (json_decode($user)->responseStatusCode == 200) {
?>
<script>
    window.alert('Please check your email for a recovery link!');
    window.location.replace('.././index.php?page=login');
</script>
<?php
}else{
?>
<script>
    window.alert('Account does not exist!');
    window.location.replace('.././index.php?page=login');
</script>
<?php
};
?>