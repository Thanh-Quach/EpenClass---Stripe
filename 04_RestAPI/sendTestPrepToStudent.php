<?php
  $accountId = 'admin@datapi.com';
  $password = 'Admin77@Admin77@';

  $bookIds=[
  	'98856e01-7330-4aca-94a3-2305374713a5',
    'b0f7d685-39c1-4f50-be6c-68dc8476dfec',
    'e2471f79-aa22-4518-b013-e2a2f48974d5',
    '5e7bb88c-bd41-44e0-b026-fb79f7ec46da',
    'ce847327-5489-4223-bf55-ea2de75051aa',
    '604cb72f-96a5-4b30-92db-48b808d78519',
  ];

 include'token.php';
   $autHeaders = [
       'content-type: application/json',
       'Accept: application/json',
       'Authorization: '.$authToken,
   ];

for ($i=0; $i < count($bookIds); $i++){
   $getBks = curl_init();
   curl_setopt($getBks, CURLOPT_URL,"https://testprepadmin.epenbuk.com/api/Workbook/Details/".$bookIds[$i]);
   curl_setopt($getBks, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($getBks, CURLOPT_HTTPHEADER, $autHeaders);
   $getBooks = curl_exec ($getBks);
   curl_close ($getBks);

   $arrayLv1 = json_decode($getBooks)->Data->Chapters;
   
   $a = 0;
for ($b=0; $b < count($arrayLv1); $b++) {
   $arrayLv2 = json_decode($getBooks)->Data->Chapters[$b]->Navigations;
   		for ($c=0; $c < count($arrayLv2); $c++) {

   		$arrayLv3 = json_decode($getBooks)->Data->Chapters[$b]->Navigations[$c]->_id;
		   $getWrshts = curl_init();
		   curl_setopt($getWrshts, CURLOPT_URL,"https://testprepadmin.epenbuk.com/api/Workbook/GetWorkSheetsBySectionId/".$arrayLv3."?pageIndex=1&pageSize=0");
		   curl_setopt($getWrshts, CURLOPT_RETURNTRANSFER, true);
		   curl_setopt($getWrshts, CURLOPT_HTTPHEADER, $autHeaders);
		   $getWorksheets = curl_exec ($getWrshts);
		   curl_close ($getWrshts);

	     
  		 $arrayLv4 = json_decode($getWorksheets)->Data;
  			for ($d=0; $d < count($arrayLv4); $d++) {
  				$WorkSheetNumber[$a] = $arrayLv4[$d]->_id;
          $a = $a + 1;
			}
   		}
}
$studentId = [
    json_decode($NewUser)->Data->_id,
];

$worksheetInfo = [
	  "WorksheetIds"=>$WorkSheetNumber,
	  "ClassId"=>json_decode($NewClass)->Data->_id,
	  "StudentIds"=>$studentId,
	  "DeadLine"=>"",
	  "ShowSolution"=>true
];
  $snt = curl_init();
    curl_setopt($snt, CURLOPT_URL,"https://testprepadmin.epenbuk.com/api/Assignment/SendToStudents");
    curl_setopt($snt, CURLOPT_POST,1);
    curl_setopt($snt, CURLOPT_POSTFIELDS, json_encode($worksheetInfo));
    curl_setopt($snt, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($snt, CURLOPT_HTTPHEADER, $autHeaders);
    $sentToStudent = curl_exec ($snt);
    curl_close ($snt);

}


?>