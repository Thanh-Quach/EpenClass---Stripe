<?php
	require_once('./vendor/autoload.php');
	include 'stripeInit.php';
	$subscription = $stripe->subscriptions->retrieve(
	  $_POST['subId'],
	  []
	);
	$invoices = $stripe->invoices->all([
	  'customer' => $subscription["customer"],
	]);
	for ($i = count($invoices['data'])-1; $i >= 0; $i--) {
?>
<!-- add a for loop to append invoice to the list -->
	<ul class="row justify-content-between text-center second-font py-2 m-0">
		<li class="col-3 text-left"><?php echo date('M j, Y', $invoices['data'][$i]->lines->data[0]->price->created);?></li>
		<li class="col-2"><?php echo '$'.$invoices['data'][$i]->amount_paid/100;?></li>
		<li class="col-2 text-success">Processed</li>
	</ul>
<?php
	}
	if ($subscription->canceled_at == null) {
		$ftrInvoices = $stripe->invoices->upcoming([
		  'customer' => $subscription["customer"],
		]);	
?>
	<ul id="upcoming" class="row text-center second-font py-2 m-0">
		<li class="col-2 text-left"><?php echo date('M j, Y', $ftrInvoices['created']);?></li>
		<li class="col-2"><?php echo '$'.$ftrInvoices['amount_due']/100;?></li>
		<li class="col-2 text-danger">Upcoming</li>
	</ul>
<?php

};
?>