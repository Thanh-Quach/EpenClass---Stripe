<?php

    include 'token.php';

   $headers = [
      'content-type: application/json',
      'Authorization: '.$authToken,
   ];
    $ClssInf = curl_init();
       curl_setopt($ClssInf, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Class/Details/".$_POST['classId']);
       curl_setopt($ClssInf, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ClssInf, CURLOPT_HTTPHEADER, $headers);
    $ClssInfo = curl_exec ($ClssInf);
       curl_close ($ClssInf);

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
       "OperatorId"=>json_decode($ClssInfo)->Data->Operator->_id,
       "classId"=>$_POST['classId']
    ];

    $NewUsr = curl_init();
        curl_setopt($NewUsr, CURLOPT_URL,"https://".$domain.".epenbuk.com/api/Student/Create");
        curl_setopt($NewUsr, CURLOPT_POST,1);
        curl_setopt($NewUsr, CURLOPT_POSTFIELDS, json_encode($signUpInf));
        curl_setopt($NewUsr, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($NewUsr, CURLOPT_HTTPHEADER, $headers);
    $NewUser = curl_exec ($NewUsr);
        curl_close ($NewUsr);

?>
<script>
    window.alert('Successfully register to refered class! Please Check your email for login info');
    window.open('https://class.epenbuk.com/');
    window.location.replace('.././index.php?page=home')
</script>