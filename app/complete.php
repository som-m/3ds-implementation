<?php

include_once __dir__ . '/../app/charge.php';

$order = new Charge();
$order->get($order_id);

$charge_id = $order->charge_id();

$charge = OmiseCharge::retrieve($charge_id);

$order->update_status($charge['id'], $charge['status']);

header('Location: /../' . $charge['id'] . '/status');
