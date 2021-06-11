<?php

require __DIR__ . '/../config/config.php';

$path = $_SERVER['PATH_INFO'];
$order_id = filter_var($path, FILTER_SANITIZE_NUMBER_INT);

$search = OmiseCharge::search($order_id);
$charge_id = $search['data'][0]['id'];

$charge = OmiseCharge::retrieve($charge_id);
if ( $charge['authorized'] == false || $charge['paid'] == false) {
  echo "$charge[id] via $charge[description]: $charge[status] - $charge[failure_message]";
} else {
  echo "$charge[id] via $charge[description]: $charge[status]";
}