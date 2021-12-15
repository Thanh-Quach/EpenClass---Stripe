<?php
  include 'admin.php';

  $domain = $_POST['domain'];
  $role = $_POST['role'];
  
  if ($role == 'adminReq') {
     include'restAPIadmin.php';
  }else{
     include'addReferredStudent.php';
  }

?>