<?php

include_once __dir__ . '/../templates/header.php';

$charge = OmiseCharge::retrieve($charge_id);

?>

<p>
  <img src="<?php echo $charge['source']['references']['barcode']; ?>">
</p>

<p>
  Go to <a target = "_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $charge['id']; ?>">dashboard</a> and mark as paid/failed, then click the button below to check the status.
</p>

<form method="POST" action="/../status">
  <input type="hidden" name="charge" value="<?php echo $charge['id']; ?>">
  <button type="submit">Status</button>
</form>

<?php include_once __dir__ . '/../templates/footer.php'; ?>
