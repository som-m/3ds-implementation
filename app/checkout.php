<?php

include_once __dir__ . '/../app/order.php';

$order_id = date('Ymd-His') . rand(100, 999);

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

$charge_id = $charge['id'];
$paymemt_type = $charge['description'];
$barcode = $charge['source']['references']['barcode'];
$status = $charge['status'];

$order_data = array($order_id, $charge_id, $paymemt_type, $barcode, $status);

$order = new Order();
$order->insert($order_data);

if ($charge['source']['type'] == 'bill_payment_tesco_lotus') {
  header('Location: /../' . $order_id . '/complete');
} else {
  header('Location: ' . $charge['authorize_uri']);
}
