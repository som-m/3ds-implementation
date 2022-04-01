<?php

class Order {
  public $order;

  function get($id) {
    $file = fopen('order.csv', 'r');

    while (($row = fgetcsv($file)) !== FALSE) {
      if ($row[0] == $id || $row[1] == $id) {
        $this->order = array($row[0], $row[1], $row[2], $row[3], $row[4]);

        break;
      }
    }

    fclose($file);
  }

  function update_status($id, $status) {
    $file = fopen('order.csv', 'r');
    $file_temp = fopen('order-temp.csv', 'w');

    while (($row = fgetcsv($file)) !== FALSE) {
      if ($row[1] == $id) {
        $row[4] = $status;
      }
      fputcsv($file_temp, $row);
    }

    fclose($file);
    fclose($file_temp);

    unlink('order.csv');

    rename('order-temp.csv', 'order.csv');
  }

  function insert($order) {
    $file = fopen('order.csv', 'a');

    fputcsv($file, $order);

    fclose($file);
  }

  function order_id() {
    return $this->order[0];
  }

  function charge_id() {
    return $this->order[1];
  }

  function paymemt_type() {
    return $this->order[2];
  }

  function barcode() {
    return $this->order[3];
  }

  function status() {
    return $this->order[4];
  }
}
