<?php

$order_id = date('YmdHis') . rand(100, 999);

$attrs = array(
  'amount'      => 300000,
  'currency'    => 'thb',
  'return_uri'  => 'http://localhost:8080/' . $order_id . '/complete',
  'metadata'    => array(
    'order_id'  => $order_id
  ),
);

if ($_POST['omiseToken']) {
  $attrs['description'] = 'card';
  $attrs['card'] = $_POST['omiseToken'];
}

if ($_POST['omiseSource']) {
  $source = OmiseSource::retrieve($_POST['omiseSource']);

  $attrs['description'] = $source['type'];
  $attrs['source'] = $_POST['omiseSource'];
}

$charge = OmiseCharge::create($attrs);

if ($charge['source']['type'] == 'bill_payment_tesco_lotus') {
  header('Location: /../' . $order_id . '/complete');
} else {
  header('Location: ' . $charge['authorize_uri']);
}

$charge_id = $charge['id'];
$type = $charge['description'];
$barcode = $charge['source']['references']['barcode'];
$status = $charge['status'];

$content = $order_id . ',' . $charge_id . ',' . $type . ',' . $barcode . ',' . $status;

file_put_contents('status.txt', PHP_EOL . $content, FILE_APPEND);
