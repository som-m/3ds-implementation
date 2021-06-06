<?php
require_once 'config.php';

$order_id = date('YmdHi') . rand(1000, 9999);

$charge = OmiseCharge::create(array(
	'amount'		=> 10000,
	'currency'		=> 'thb',
	'return_uri'	=> 'https://merchant-site.com/complete.php/orderid=' . $order_id,
	'description'	=> 'Test payment. Order ID: ' . $order_id,
	'metadata'		=> array(
		'order_id'	=> $order_id
	),
	'card'			=> $_POST['omiseToken']
));

header('Location: ' . $charge['authorize_uri']);
