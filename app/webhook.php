<?php

$payload = file_get_contents('php://input');

$event = json_decode($payload);

if ($event->key == 'charge.complete' && $event->data->source->type == 'bill_payment_tesco_lotus') {
  $charge_id = $event->data->id;

  $charge = OmiseCharge::retrieve($charge_id);

  $input = fopen('status.csv', 'r');
  $output = fopen('status-temp.csv', 'w');
  
  while (($row = fgetcsv($input)) !== FALSE) {
    if ($row[1] == $charge['id']) {
      $row[4] = $charge['status'];
    }
    fputcsv($output, $row);
  }

  $stat = fstat($output);
  ftruncate($output, $stat['size']-1);

  fclose($input);
  fclose($output);

  unlink('status.csv');

  rename('status-temp.csv', 'status.csv');
}
