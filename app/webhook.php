<?php

$payload = file_get_contents('php://input');

$event = json_decode($payload);

if ($event->key == 'charge.complete') {
  $charge_id = $event->data->id;

  $charge = OmiseCharge::retrieve($charge_id);
  if ($charge['status'] == 'successful') {
    file_put_contents('status.txt', PHP_EOL . $charge['id'], FILE_APPEND);
  }
}
