<?php

$payload = file_get_contents('php://input');

$event = json_decode($payload);

if ($event->key == 'charge.complete') {
  $charge_status = $event->data->id . '=' . $event->data->status;

  file_put_contents('status.txt', PHP_EOL . $charge_status, FILE_APPEND);
}
