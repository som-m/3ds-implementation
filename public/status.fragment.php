<?php

include_once __dir__ . '/../app/order.php';

$order = new Order();
$order->get($charge_id);

?>

<p>
  <?php echo $order->charge_id() . ' via ' . $order->paymemt_type() . ': ' . $order->status(); ?>
</p>