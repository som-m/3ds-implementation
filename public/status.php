<?php

include_once __dir__ . '/../templates/header.php';
include_once __dir__ . '/../app/charge.php';

$charge = new Charge();
$charge->get($charge_id);

?>

<div id="status">
  <p>
    <?php echo $charge->charge_id() . ' via ' . $charge->type() . ': ' . $charge->status(); ?>
  </p>
</div>

<div id="barcode" style="display: none;">
  <p>
    <img src="<?php echo $charge->barcode(); ?>">
  </p>

  <p>
    Go to <a target="_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $charge->charge_id(); ?>">dashboard</a> and mark as paid/failed.
  </p>
</div>

<script>
var type = '<?php echo $charge->type(); ?>';

if (type == 'bill_payment_tesco_lotus') {
  document.getElementById('barcode').setAttribute("style", "display:block");
}
</script>

<!-- to do: for bill payment, hide barcode div after payment is successful and display updated status on status div -->

<?php include_once __dir__ . '/../templates/footer.php'; ?>
