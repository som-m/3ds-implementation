<!DOCTYPE HTML>
<html>
  <head> 
    <title>Omise.js Pre-Built Form & Omise-PHP</title>
  </head>
  <body>
    <?php $charge = OmiseCharge::retrieve($charge_id); ?>
    <p>
      <img src="<?php echo $charge['source']['references']['barcode']; ?>">
    </p>
    <p>
      Go to <a target = "_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $charge['id']; ?>">dashboard</a> and mark as paid/failed.
    </p>
  </body>
</html>