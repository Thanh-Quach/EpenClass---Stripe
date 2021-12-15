<?php
//POST to get ADMIN login authentication Token
//domain: auth API
	
  include'token.php';
//create Level 1 access
//default permission: all access
//POST Create Operator
  $dummyAdr=[        
        "Apt"=>"",
        "HouseNoAndStreet"=>"0000",
        "CountryId"=>"620d682e-4eff-4f03-bbf8-da1cf497fa0d",
        "CityId"=>"fafc3017-6e55-441e-aa55-9bb692f06804",
        "ProvinceId"=>"d81891d9-3caa-4b46-8ced-2955cfbdc694",
        "PostalCode"=>"000000"
  ];
  $defaultPaymntSett=[
        "CanEditBanner"=>false,
        "IsPaidAccount"=>true
  ];
  $OprtSett=[
        "ShowWarningTrialsAccessResource"=>true,
        "ShowWarningTrialsAccessSolution"=>true,
        "CanUpload"=>false,
        "CanWriteNote"=>false,
        "AccessResourceConcept"=>true,
        "AccessResourceFoundation"=>true,
        "AccessSolutionConcept"=>true,
        "AccessSolutionFoundation"=>true
  ];
   $adminInf =[
      "Type"=>"Individual Tutor",
      "FirstName"=>$_POST['fn'],
      "LastName"=>$_POST['ln'],
      "Gender"=>$_POST['gender'],
      "PhoneNumber"=> time(),
      "Email"=>$_POST['email'],
      "Address"=>$dummyAdr,
      "PaymentSetting"=>$defaultPaymntSett,
      "OperatorSetting"=>$OprtSett,
      "IsActive"=>true
   ];
  $headers = [
    	'content-type: application/json',
    	'Authorization: '.$authToken,
    ];
  $NewOpr = curl_init();
    curl_setopt($NewOpr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/Create");
    curl_setopt($NewOpr, CURLOPT_POST,1);
    curl_setopt($NewOpr, CURLOPT_POSTFIELDS, json_encode($adminInf));
    curl_setopt($NewOpr, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($NewOpr, CURLOPT_HTTPHEADER, $headers);
    $NewOper = curl_exec ($NewOpr);
    curl_close ($NewOpr);


//GET Operator Infomration
  include 'operator.php';
  

  include'token.php';
  $headers = [
      'content-type: application/json',
      'Authorization: '.$authToken,
  ];
   $autAdm = curl_init();
   curl_setopt($autAdm, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Operator/Detail");
   curl_setopt($autAdm, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($autAdm, CURLOPT_HTTPHEADER, $headers);
   $autAdmInf = curl_exec ($autAdm);
   curl_close ($autAdm);



//Then create Students/Teachers
if ( $domain == 'classadmin' ) {
   $signUpInf = [
       "FirstName"=>$_POST['fn'],
       "LastName"=>$_POST['ln'],
       "Gender"=>$_POST['gender'],
       "Email"=>$_POST['email'],
       "PhoneNumber"=>"000000000",
       "OperatorId"=>json_decode($autAdmInf)->Data->_id,
       "Password"=>$_POST['password'],
       "ConfirmPassword"=>$_POST['password'],
    ];
   $NewUsr = curl_init();
        curl_setopt($NewUsr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Teacher/Create");
        curl_setopt($NewUsr, CURLOPT_POST,1);
        curl_setopt($NewUsr, CURLOPT_POSTFIELDS, json_encode($signUpInf));
        curl_setopt($NewUsr, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($NewUsr, CURLOPT_HTTPHEADER, $headers);
    $NewUser = curl_exec ($NewUsr);
        curl_close ($NewUsr);
   
   $classCreate = [
     "Name" => "GENERAL",
     "PrimaryTeacherId"=> json_decode($NewUser)->Data->_id,
     "OperatorId"=>json_decode($autAdmInf)->Data->_id,
    ];
   $NewCls = curl_init();
        curl_setopt($NewCls, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Class/Create");
        curl_setopt($NewCls, CURLOPT_POST,1);
        curl_setopt($NewCls, CURLOPT_POSTFIELDS, json_encode($classCreate));
        curl_setopt($NewCls, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($NewCls, CURLOPT_HTTPHEADER, $headers);
   $NewClass = curl_exec ($NewCls);
        curl_close ($NewCls);


}elseif( $domain == 'testprepadmin' ){
    $teacher = [
       "FirstName"=>'Test',
       "LastName"=>'Prep',
       "Gender"=>$_POST['gender'],
       "Email"=>'quachgioithanh@gmail.com',
       "PhoneNumber"=>"000000000",
       "OperatorId"=>json_decode($autAdmInf)->Data->_id,
       "Password"=>'123456',
       "ConfirmPassword"=>'123456',
    ];
    $NewUsr = curl_init();
        curl_setopt($NewUsr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Teacher/Create");
        curl_setopt($NewUsr, CURLOPT_POST,1);
        curl_setopt($NewUsr, CURLOPT_POSTFIELDS, json_encode($teacher));
        curl_setopt($NewUsr, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($NewUsr, CURLOPT_HTTPHEADER, $headers);
    $NewUser = curl_exec ($NewUsr);
        curl_close ($NewUsr);
  
 

    $classCreate = [
       "Name" => "GENERAL",
       "PrimaryTeacherId"=> json_decode($NewUser)->Data->_id,
       "OperatorId"=>json_decode($autAdmInf)->Data->_id,
    ];
    $NewCls = curl_init();
        curl_setopt($NewCls, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Class/Create");
        curl_setopt($NewCls, CURLOPT_POST,1);
        curl_setopt($NewCls, CURLOPT_POSTFIELDS, json_encode($classCreate));
        curl_setopt($NewCls, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($NewCls, CURLOPT_HTTPHEADER, $headers);
    $NewClass = curl_exec ($NewCls);
        curl_close ($NewCls);

    $additionalInfo = [
       "Name"=>'NA',
       "Email"=> $_POST['email'],
       "PhoneNumber"=> "000000000",
    ];
    $signUpInf = [
       "FirstName"=>$_POST['fn'],
       "LastName"=>$_POST['ln'],
       "Gender"=>$_POST['gender'],
       "PhoneNumber"=>"000000000",

       "Grade"=>$_POST['grade'],
       "ParentInfo"=>$additionalInfo,
       "PhoneNumber"=>"000000000",

       "Password"=>$_POST['password'],
       "ConfirmPassword"=>$_POST['password'],
       "OperatorId"=>json_decode($autAdmInf)->Data->_id,
       "classId"=>json_decode($NewClass)->Data->_id
    ];

    $NewUsr = curl_init();
        curl_setopt($NewUsr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Student/Create");
        curl_setopt($NewUsr, CURLOPT_POST,1);
        curl_setopt($NewUsr, CURLOPT_POSTFIELDS, json_encode($signUpInf));
        curl_setopt($NewUsr, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($NewUsr, CURLOPT_HTTPHEADER, $headers);
    $NewUser = curl_exec ($NewUsr);
        curl_close ($NewUsr);

    include'sendTestPrepToStudent.php';
};

    $accountId = json_decode($NewUser)->Data->Code;
    $password = $_POST['password'];

?>
<script>
    window.alert('Please check your email to confirm your Username and Password!');
</script>

<?php
include 'restAPIlogin.php';

?>