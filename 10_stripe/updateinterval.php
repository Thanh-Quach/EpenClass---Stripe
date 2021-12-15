<?php

require_once('../vendor/autoload.php');
include 'stripeInit.php';

$subscription = $stripe->subscriptions->retrieve(
  $_POST['subId'],
  []
);


$subscriptionUpdate = $stripe->subscriptionItems->update(
    $subscription['items']->data[0]->id,
    ['price_data' => [
        'unit_amount' => $_POST['price']*100,
        'currency' => 'cad',
        'product' => $subscription['items']->data[0]->price->product,
        'recurring' => [
          'interval' => $_POST['interval'],
        ],
    ]]
);

$customer = $stripe->customers->retrieve(
	$subscription['customer'],
	[]
);

$card = $stripe->customers->retrieveSource(
	$subscription['customer'],
	$customer['default_source'],
	[]
);

$subExpired = false;
include 'updateAccountMethod.php';
?>