<?php

include_once __dir__ . '/../templates/header.php';

$file = fopen('status.csv','r');

while (($row = fgetcsv($file)) !== FALSE) {
  if ($row[1] == $charge_id) {
    $order_id = $row[0];
    $charge_id = $row[1];
    $type = $row[2];
    $barcode = $row[3];
    $status = $row[4];
    break;
  }
}

fclose($file);

?>

<div id="status">
  <p>
    <?php echo $charge_id . ' via ' . $type . ': ' . $status; ?>
  </p>
</div>

<div id="barcode" style="display: none;">
  <p>
    <img src="<?php echo $barcode; ?>">
  </p>

  <p>
    Go to <a target="_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $charge_id; ?>">dashboard</a> and mark as paid/failed.
  </p>
</div>

<script>
var type = "<?php echo $type ?>";

if (type == "bill_payment_tesco_lotus") {
  document.getElementById('barcode').setAttribute("style", "display:block");
}
</script>

<!-- to do: for bill payment, hide barcode div after payment is successful and display updated status on status div -->

<?php include_once __dir__ . '/../templates/footer.php'; ?>
