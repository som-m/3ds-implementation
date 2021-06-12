<?php

$payload = file_get_contents('php://input');

$event = json_decode($payload);

if ($event->key == 'charge.complete' && $event->data->source->type == 'bill_payment_tesco_lotus') {
  $charge_id = $event->data->id;

  $charge = OmiseCharge::retrieve($charge_id);
  // to do: record final status in status.txt
}
