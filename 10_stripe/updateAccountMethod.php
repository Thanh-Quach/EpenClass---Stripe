<?php

//Getting Operator Id for update
if ($subExpired == false) {
include '../04_RestAPI/operator.php';
include '../04_RestAPI/token.php';

$oprTkn = $authToken;
$headers = [
      'content-type: application/json',
      'Authorization: '.$oprTkn,
  ];

  $Access = [
    "ShowWarningTrialsAccessResource"=>false,
    "ShowWarningTrialsAccessSolution"=>false,
    "CanUpload"=>true,
    "CanWriteNote"=>true,
    "AccessResourceConcept"=>true,
    "AccessResourceFoundation"=>true,
    "AccessSolutionConcept"=>true,
    "AccessSolutionFoundation"=>true
];
} else {
  $Access = [
    "ShowWarningTrialsAccessResource"=>true,
    "ShowWarningTrialsAccessSolution"=>true,
    "CanUpload"=>false,
    "CanWriteNote"=>false,
    "AccessResourceConcept"=>true,
    "AccessResourceFoundation"=>true,
    "AccessSolutionConcept"=>false,
    "AccessSolutionFoundation"=>false
  ];
}

if (isset($domain) == false) {
  $domain = $_POST['domain'];
}

  $autAdm = curl_init();
  curl_setopt($autAdm, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/Detail");
  curl_setopt($autAdm, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($autAdm, CURLOPT_HTTPHEADER, $headers);
  $OperatorId = curl_exec ($autAdm);
  curl_close ($autAdm);


$BannerSetting = [
  "CanEditBanner"=>true,
  "IsPaidAccount"=>true,
];
$Operator = [
  "_id"=>json_decode($OperatorId)->Data->_id,
  "Type"=>json_decode($OperatorId)->Data->Type,
  "FirstName"=>json_decode($OperatorId)->Data->FirstName,
  "LastName"=>json_decode($OperatorId)->Data->LastName,
  "Gender"=>json_decode($OperatorId)->Data->Gender,
  "PhoneNumber"=>json_decode($OperatorId)->Data->PhoneNumber,
  "Address"=>json_decode($OperatorId)->Data->Address,
  "PaymentSetting"=>$BannerSetting,
  "IsActive"=>true,
  "OperatorSetting"=>$Access,
];

//Vendor update operator account permission
include '../04_RestAPI/admin.php';
include '../04_RestAPI/token.php';
  
  
$adminTkn = $authToken;

  $headers = [
      'content-type: application/json',
      'Authorization: '.$adminTkn,
  ];

  $updtusr = curl_init();
      curl_setopt($updtusr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/Update");
      curl_setopt($updtusr, CURLOPT_POST,1);
      curl_setopt($updtusr, CURLOPT_POSTFIELDS, json_encode($Operator));
      curl_setopt($updtusr, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($updtusr, CURLOPT_HTTPHEADER, $headers);
  $updateusr = curl_exec ($updtusr);
      curl_close ($updtusr);

if (isset($interval) == false) {
  $interval = $_POST['interval'];
}


//Operator update Payment info
if ($card == 'removed'){
  $updatePaymnt = [
    "_id"=>$subscription['id'],
    "Object"=>null,
    "Brand"=>null,
    "CvcCheck"=>null,
    "ExpMonth"=>0,
    "ExpYear"=>0,
    "Fingerprint"=>null,
    "Funding"=>null,
    "Last4"=>null,
    "Name"=>$interval,
  ];
 
} else {
   $updatePaymnt = [
    "_id"=>$subscription['id'],
    "Object"=>$card['object'],
    "Brand"=>$card["cvc_check"],
    "CvcCheck"=>$card["cvc_check"],
    "ExpMonth"=>$card["exp_month"],
    "ExpYear"=>$card["exp_year"],
    "Fingerprint"=>$card["fingerprint"],
    "Funding"=>$card["funding"],
    "Last4"=>$card["last4"],
    "Name"=>$interval,
  ];
};


  $headers = [
      'content-type: application/json',
      'Authorization: '.$oprTkn,
  ];

  $paymntMdthd = curl_init();
  curl_setopt($paymntMdthd, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/UpsertPaymentAccount");
  curl_setopt($paymntMdthd, CURLOPT_POST,1);
  curl_setopt($paymntMdthd, CURLOPT_POSTFIELDS, json_encode($updatePaymnt));
  curl_setopt($paymntMdthd, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($paymntMdthd, CURLOPT_HTTPHEADER, $headers);
  $paymentMedthod = curl_exec ($paymntMdthd);
  curl_close ($paymntMdthd);


  $payInf = curl_init();
  curl_setopt($payInf, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/DetailPaymentAccount");
  curl_setopt($payInf, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($payInf, CURLOPT_HTTPHEADER, $headers);
  $PaymentInf = curl_exec ($payInf);
  curl_close ($payInf);

  $Opr = curl_init();
  curl_setopt($Opr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/Detail/");
  curl_setopt($Opr, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($Opr, CURLOPT_HTTPHEADER, $headers);
  $Opre = curl_exec ($Opr);
  curl_close ($Opr);



//Update Login Info - Relogin

if (isset($autUserInf) == false) {
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
}
?>

<script>
    //store user data inside localStorage
    var autUserItems ='<?php echo $autUserInf?>';
    localStorage.setItem('usrDta', autUserItems);


    var currOprToken = '<?php echo $oprTkn?>';
    var currOprPaymnt = '<?php echo $PaymentInf?>';
    localStorage.setItem('currOprTkn', currOprToken);
    localStorage.setItem('currOprPaymnt', currOprPaymnt);

    window.location.replace("../index.php?page=usrIndex");
</script>