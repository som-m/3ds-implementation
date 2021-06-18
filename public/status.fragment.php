<?php

include_once __dir__ . '/../app/charge.php';

$charge = new Charge();
$charge->get($charge_id);

?>

<p>
  <?php echo $charge->charge_id() . ' via ' . $charge->type() . ': ' . $charge->status(); ?>
</p>