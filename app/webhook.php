<?php

include_once __dir__ . '/../app/order.php';

$payload = file_get_contents('php://input');

$event = json_decode($payload);

if ($event->key == 'charge.complete' && $event->data->source->type == 'bill_payment_tesco_lotus') {
  $charge_id = $event->data->id;
  $status = $event->data->status;

  $order = new Order();
  $order->get($charge_id);
  $order->update_status($charge_id, $status);
}
