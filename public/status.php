<?php

include_once __dir__ . '/../templates/header.php';

$row = array();

$handle = @fopen("status.txt", "r");
if ($handle) {
  while (!feof($handle)) {
    $buffer = fgets($handle);
    if(strpos($buffer, $charge_id) !== FALSE)
      $row[] = $buffer;
  }
  fclose($handle);
}

$column = explode(',', $row[0]);

$order_id = $column[0];
$charge_id = $column[1];
$type = $column[2];
$barcode = $column[3];
$status = $column[4];

?>

<!-- note: status here is not correct, see complete.php and webhook.php -->
<div id="status">
  <p>
    <?php echo $charge_id . ' via ' . $type . ': ' . $status; ?>
  </p>
</div>

<!-- to do: only show if type == bill_payment_tesco_lotus -->
<div id="barcode">
  <p>
    <img src="<?php echo $barcode; ?>">
  </p>

  <p>
    Go to <a target="_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $charge_id; ?>">dashboard</a> and mark as paid/failed, then click the button below to check the status.
  </p>
</div>

<!-- to do: hide barcode div after payment is successful and display updated status on status div -->

<?php include_once __dir__ . '/../templates/footer.php'; ?>
