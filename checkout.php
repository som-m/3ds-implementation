<?php

require_once 'config.php';

$order_id = date('YmdHis') . rand(100, 999);

$charge = OmiseCharge::create(array(
	'amount'			=> 10000,
	'currency'		=> 'thb',
	'return_uri'	=> 'http://localhost:8080/complete.php/orderid=' . $order_id,
	'description'	=> 'Test payment from som-m/3ds-implementation',
	'metadata'		=> array(
		'order_id'	=> $order_id
	),
	'card'				=> $_POST['omiseToken']
));

header('Location: ' . $charge['authorize_uri']);
