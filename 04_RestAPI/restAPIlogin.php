<?php
//POST user login authentication Token
//domain: auth API

include'token.php';

   $OperatorType = substr(json_decode($user)->content->accountId, -5, 1);
   if ($OperatorType == 'T') {
      $domain = 'classadmin';
   }else if($OperatorType == 'S'){
      $domain = 'testprepadmin';
   }
//GET user account information
//domain: admin API
   $usrTkn = $authToken;
   $autHeaders = [
       'Accept: application/json',
       'Authorization: '.$usrTkn,
   ];
   $autUser = curl_init();
   curl_setopt($autUser, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Account/GetAccountInfo");
   curl_setopt($autUser, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($autUser, CURLOPT_HTTPHEADER, $autHeaders);
   $autUserInf = curl_exec ($autUser);
   curl_close ($autUser);

// if ($autUserInf == null) {
      // echo "<script>window.alert('Please login again');window.open('https://class.epenbuk.com/');window.location.replace('.././index.php?page=home');</script>";
   //    echo "Please login again via <a onclick='redirect()' href='https://class.epenbuk.com/' target='_blank'>this link</a>";
   // }else{
   
if ($autUserInf == null) {
      echo "<script>window.alert('Wrong Username or Password.');window.location.replace('.././index.php?page=login');</script>";
   }else{

    if ($domain == 'classadmin') {
       $accountId = json_decode($autUserInf)->Data->Email;
       $password = 'Class772';
     }else if ($domain == 'testprepadmin'){
       $accountId = json_decode($autUserInf)->Data->DetailUserInfo->ParentInfo->Email;
       $password = 'TestPrep772';
     }

   include 'token.php';

   $oprTkn = $authToken;
   $headers = [
       'Accept: application/json',
       'Authorization: '.$oprTkn,
   ];
   $paymnt = curl_init();
   curl_setopt($paymnt, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/DetailPaymentAccount");
   curl_setopt($paymnt, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($paymnt, CURLOPT_HTTPHEADER, $headers);
   $paymntInf = curl_exec ($paymnt);
   curl_close ($paymnt);
};
    if (json_decode($paymntInf)->Data == null) {
      $paymntInf = null;
   };
?>

<script>
    //store user data inside localStorage
    var autUserItems ='<?php echo $autUserInf?>';
    var currUserToken = '<?php echo $usrTkn?>';
    localStorage.setItem('usrDta', autUserItems);
    localStorage.setItem('currUsrTkn', currUserToken);


    var currOprToken = '<?php echo  $oprTkn?>';
    var currOprPaymnt = '<?php echo  $paymntInf?>';
    localStorage.setItem('currOprTkn', currOprToken);
    localStorage.setItem('currOprPaymnt', currOprPaymnt);

    window.location.replace("../index.php?page=usrIndex");

    function redirect(){
      window.location.replace(".././index.php?page=home");
    }
</script>