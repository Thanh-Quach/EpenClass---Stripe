<?php

$UsrPassword = $_POST['newPW'];

if (!isset($phone)) {
	$UsrPassword = null;
};

$phone = $_POST['phone'];

if (!isset($phone)) {
    $phone = "000000000";
};

$domain = $_POST['domain'];
include 'admin.php';

if ($domain == 'classadmin') {
    $role = 'Teacher';
   	$UsrInf = [
    	"_id"=>$_POST['Id'],
       "Gender"=>$_POST['gender'],
       "PhoneNumber"=>$phone,
       "OperatorId"=>$_POST['operatorId'],
       "Email"=>$_POST['email'],
       "IsActive"=>'true',
	   "Password"=>$UsrPassword,
	   "ConfirmPassword"=>$UsrPassword,
	];
}elseif ($domain == 'testprepadmin') {
  	$role = 'Student';

  	$additionalInfo = [
       "Name"=>'NA',
       "Email"=> $_POST['email'],
       "PhoneNumber"=> "000000000",
    ];
    $UsrInf = [
    	"_id"=>$_POST['Id'],
       "Gender"=>$_POST['gender'],
       "PhoneNumber"=>$phone,
       "IsActive"=>'true',
       "Grade"=>'13',
       "ParentInfo"=>$additionalInfo,
	   "Password"=>$UsrPassword,
	   "ConfirmPassword"=>$UsrPassword,
       "OperatorId"=>$_POST['operatorId'],
    ];
}



include'token.php';

  $headers = [
    	'content-type: application/json',
    	'Authorization: '.$authToken,
    ];

  $UpdateUsr = curl_init();
    curl_setopt($UpdateUsr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/".$role."/Update");
    curl_setopt($UpdateUsr, CURLOPT_POST,1);
    curl_setopt($UpdateUsr, CURLOPT_POSTFIELDS, json_encode($UsrInf));
    curl_setopt($UpdateUsr, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($UpdateUsr, CURLOPT_HTTPHEADER, $headers);
    $UpdateUser = curl_exec ($UpdateUsr);
    curl_close ($UpdateUsr);

  	
  $autHeaders = [
       'Accept: application/json',
       'Authorization: '.$_POST['currUsrTkn'],
   ];
   $autUser = curl_init();
   curl_setopt($autUser, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Account/GetAccountInfo");
   curl_setopt($autUser, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($autUser, CURLOPT_HTTPHEADER, $autHeaders);
   $autUserInf = curl_exec ($autUser);
   curl_close ($autUser);

?>


<script>
    //store user data inside localStorage
    localStorage.removeItem('usrDta');
    var autUserItems ='<?php echo $autUserInf?>';
    localStorage.setItem('usrDta', autUserItems);
    window.alert('Update Successful');
    window.location.replace("../index.php?page=usrIndex");
</script>