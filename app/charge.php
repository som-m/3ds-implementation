<?php

class Charge {
  public $charge;

  function get($charge_id) {
    $file = fopen('charge.csv', 'r');

    while (($row = fgetcsv($file)) !== FALSE) {
      if ($row[1] == $charge_id) {
        $this->charge = array($row[0], $row[1], $row[2], $row[3], $row[4]);
        break;
      }
    }

    fclose($file);
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
