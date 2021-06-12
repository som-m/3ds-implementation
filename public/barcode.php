<?php

include_once __dir__ . '/../templates/header.php';

$charge = OmiseCharge::retrieve($charge_id);

?>

<p>
  <img src="<?php echo $charge['source']['references']['barcode']; ?>">
</p>

<p>
  Go to <a target = "_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $charge['id']; ?>">dashboard</a> and mark as paid/failed.
</p>

<?php include_once __dir__ . '/../templates/footer.php'; ?>
