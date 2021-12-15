<?php
require_once('../vendor/autoload.php');
include 'stripeInit.php';

$subscription = $stripe->subscriptions->retrieve(
	$_POST['subId'],
	[]
);
if ((time() - $subscription->cancel_at) < 600) {
		$token = $stripe->tokens->create([
		  'card' => [
		    'number' => $_POST['card-number'],
		    'exp_month' => $_POST['month'],
		    'exp_year' => $_POST['year'],
		    'cvc' => $_POST['CVC'],
		  ],
		]);

		$card = $stripe->customers->createSource(
		  $subscription['customer'],
		  ['source' => $token['id']],
		);

		$stripe->subscriptions->update(
			$_POST['subId'],
			['cancel_at_period_end' => false]
		);


		if ($subscription['items']->data[0]->price->recurring->interval == $_POST['interval']) {
			$subExpired = false;
			include 'updateAccountMethod.php';
		}else{
			include 'updateinterval.php';
		};

}else{
	$customersId = $subscription['customer'];
	include 'paymentProcess.php';
}
?>