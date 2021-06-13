<?php

include_once __dir__ . '/../app/charge.php';

$charge = new Charge();
$charge->get($order_id);
$charge_id = $charge->charge_id();

$charge = OmiseCharge::retrieve($charge_id);

header('Location: /../' . $charge['id'] . '/status');

$input = fopen('charge.csv', 'r');
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

unlink('charge.csv');

rename('status-temp.csv', 'charge.csv');
