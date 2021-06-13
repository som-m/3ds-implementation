<?php

include_once __dir__ . '/../app/charge.php';

$payload = file_get_contents('php://input');

$event = json_decode($payload);

if ($event->key == 'charge.complete' && $event->data->source->type == 'bill_payment_tesco_lotus') {
  $charge_id = $event->data->id;
  $status = $event->data->status;

  $charge = new Charge();
  $charge->get($charge_id);
  $charge->update_status($charge_id, $status);
}
