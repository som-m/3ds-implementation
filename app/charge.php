<?php

class Charge {
  public $charge;

  function get($id) {
    $file = fopen('charge.csv', 'r');

    while (($row = fgetcsv($file)) !== FALSE) {
      if ($row[0] == $id || $row[1] == $id) {
        $this->charge = array($row[0], $row[1], $row[2], $row[3], $row[4]);

        break;
      }
    }

    fclose($file);
  }

  function update_status($id, $status) {
    $file = fopen('charge.csv', 'r');
    $file_temp = fopen('charge-temp.csv', 'w');

    while (($row = fgetcsv($file)) !== FALSE) {
      if ($row[1] == $id) {
        $row[4] = $status;
      }
      fputcsv($file_temp, $row);
    }

    $stat = fstat($file_temp);

    ftruncate($file_temp, $stat['size']-1);

    fclose($file);
    fclose($file_temp);

    unlink('charge.csv');

    rename('charge-temp.csv', 'charge.csv');
  }

  function order_id() {
    return $this->charge[0];
  }

  function charge_id() {
    return $this->charge[1];
  }

  function type() {
    return $this->charge[2];
  }

  function barcode() {
    return $this->charge[3];
  }

  function status() {
    return $this->charge[4];
  }
}
