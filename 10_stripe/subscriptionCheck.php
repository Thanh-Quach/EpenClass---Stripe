<?php
	require_once('../vendor/autoload.php');
	include 'stripeInit.php';

	$subscription = $stripe->subscriptions->retrieve(
	  $subId,
	  []
	);
		if ((time() - $subscription->cancel_at) < 600)
		{
		  $subExpired = false;
		} else {
		  $subExpired = true;
		  $card = 'removed';
		  $interval = $subscription['items']->data[0]->price->recurring->interval;
		  // include 'updateAccountMethod.php';
		};
?>