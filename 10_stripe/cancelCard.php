<?php
	require_once('../vendor/autoload.php');
	include 'stripeInit.php';


	$stripe->subscriptions->update(
	  $_POST['subId'],
	  ['cancel_at_period_end' => true]
	);
	
	$subscription = $stripe->subscriptions->retrieve(
	  $_POST['subId'],
	  []
	);

	$currCard = $stripe->customers->retrieve(
	  $subscription['customer'],
	  []
	);

	$stripe->customers->deleteSource(
	  $subscription['customer'],
	  $currCard['default_source'],
	  []
	);

	$card = 'removed';
	$subExpired = false;
	include 'updateAccountMethod.php';
?>