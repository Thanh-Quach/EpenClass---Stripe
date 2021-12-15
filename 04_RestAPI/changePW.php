<?php

    $headers = [
      'content-type: application/json',
      'Authorization: bearer '.$_POST['token']
    ];

    $password = [
          "newPassword"<=$_POST['newPW'],
          "password"<=$_POST['currPW']
    ];

    $usr = curl_init();
       curl_setopt($usr, CURLOPT_URL,'https://auth.epenbuk.com:8443/ePenDataApi-0.0.1-SNAPSHOT/user/user/password');
       curl_setopt($usr, CURLOPT_PUT, true);
       curl_setopt($usr, CURLOPT_POSTFIELDS, $password);
       curl_setopt($usr, CURLOPT_RETURNTRANSFER,true);
       curl_setopt($usr, CURLOPT_HTTPHEADER, $headers);
       $user = curl_exec ($usr);
       curl_close ($usr);

       echo $user; 
if (json_decode($user)->responseStatusCode == 200) {
?>
<script>
    window.alert('Password Changed');
    window.location.replace('./index.php?page=usrIndex#');
</script>
<?php
};
?>