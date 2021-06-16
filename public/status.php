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
    Go to <a target="_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $charge->charge_id(); ?>">dashboard</a> and mark as paid/failed. Refresh the page or click the button below to get the latest status of this charge.
  </p>

  <button onclick="refresh()">Refresh</button>
</div>

<script>
function refresh() {
  location.reload();
}

function show_barcode() {
  var type = '<?php echo $charge->type(); ?>';
  var status = '<?php echo $charge->status(); ?>';

  if (type == 'bill_payment_tesco_lotus' && status == 'pending') {
    document.getElementById('barcode').setAttribute("style", "display:block");
  }
}

show_barcode();
</script>

<?php include_once __dir__ . '/../templates/footer.php'; ?>
