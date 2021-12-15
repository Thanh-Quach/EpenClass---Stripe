<?php
$accountId = $_POST['email'];
$domain = $_POST['domain'];

  if ($domain == 'classadmin') {
    $password = 'Class772';
  } else if ($domain == 'testprepadmin'){
    $password = 'TestPrep772';
  }
?>