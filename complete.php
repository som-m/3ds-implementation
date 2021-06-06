<?php
require_once 'config.php';

$path = $_SERVER['PATH_INFO'];

$order_id = filter_var($path, FILTER_SANITIZE_NUMBER_INT);

$search = OmiseCharge::search($order_id)->filter(array(
	'created' => 'today',
));

$charge_id = $search['data'][0]['id'];

$charge = OmiseCharge::retrieve($charge_id);

if ( $charge['authorized'] == false || $charge['paid'] == false) {
	echo $charge['id'] . ': ' . $charge['failure_message'];
} else {
	echo $charge['id'] . ': ' . $charge['status'];
}
