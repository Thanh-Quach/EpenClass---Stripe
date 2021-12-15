<?php
require_once('../vendor/autoload.php');
include 'stripeInit.php';

$token = $stripe->tokens->create([
  'card' => [
    'number' => $_POST['card-number'],
    'exp_month' => $_POST['month'],
    'exp_year' => $_POST['year'],
    'cvc' => $_POST['CVC'],
  ],
]);


//create customers for stripe charging
$trialdays = 0;

if (isset($customersId) == false) {
  $customer = $stripe->customers->create([
    'email' => $_POST['email'],
    'name' => $_POST['cardHolderName'],
  ]);
  $customersId = $customer['id'];
}

//create virtual credit/debit cards
$card = $stripe->customers->createSource(
  $customersId,
  ['source' => $token['id']],
);



//create subscription and charge the cusomter
 $subscription = $stripe->subscriptions->create([
    'customer' => $customersId,
    'items' => [[
      'price_data' => [
        'unit_amount' => $_POST['price']*100,
        'currency' => 'cad',
        'product' => $_POST['product'],
        'recurring' => [
          'interval' => $_POST['interval'],
        ],
      ],
    ]],
    'trial_period_days' => $trialdays,
  ]);

$subExpired = false;
include 'updateAccountMethod.php';

?>