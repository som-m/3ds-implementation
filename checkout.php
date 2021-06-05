<?php
require_once 'config.php';

$file = "orderid.txt";
$linecount = 0;
$handle = fopen($file, "r");
while (!feof($handle)) {
	$line = fgets($handle);
	$linecount++;
}
fclose($handle);
$order_id = $linecount;

$metadata = array(
	'order_id'	=> $order_id,
	'OmisePHP'	=> '2.13.0'
);

$attrs = array(
	'amount'		=> 10000,
	'currency'		=> 'thb',
	'return_uri'	=> 'https://merchant-site.com/complete.php/orderid=' . $order_id,
	'description'	=> 'Test payment. Order ID: ' . $order_id,
	'metadata'		=> $metadata
);

if ($_POST['omiseSource']) {
	$attrs['source'] = $_POST['omiseSource'];
}

if ($_POST['omiseToken']) {
	$attrs['card'] = $_POST['omiseToken'];
}

$charge = OmiseCharge::create($attrs);

header('Location: ' . $charge['authorize_uri']);

file_put_contents("orderid.txt", "\n" . $charge['id'] . "=" . $order_id, FILE_APPEND);
