<?php

include_once __dir__ . '/../templates/header.php';
include_once __dir__ . '/../app/order.php';

$order = new Order();
$order->get($charge_id);

?>

<div id="status">
  <p>
    <?php echo $order->charge_id() . ' via ' . $order->paymemt_type() . ': ' . $order->status(); ?>
  </p>
</div>

<div id="barcode" style="display: none;">
  <p>
    <img src="<?php echo $order->barcode(); ?>">
  </p>

  <p>
    Go to <a target="_blank" href="<?php echo 'https://dashboard.omise.co/test/charges/' . $order->charge_id(); ?>">Omise dashboard</a> and mark the charge as paid or failed. Once the charge is completed, this section will disappear and the updated status will be displayed.
  </p>
</div>

<script type="text/javascript">
var refreshLoop;

function reqListener() {
  doc = new DOMParser().parseFromString(this.responseText, "text/html").body.firstChild;

  document.getElementById("status").replaceChildren();
  document.getElementById("status").appendChild(doc);

  if (!doc.innerHTML.match(/pending/)) {
    clearInterval(refreshLoop);
    document.getElementById('barcode').setAttribute("style", "display:none");
  }
}

function refresh() {
  var oReq = new XMLHttpRequest();
  oReq.addEventListener("load", reqListener);
  oReq.open("GET", window.location + "-fragment");
  oReq.send();
}

function showBarcode() {
  var paymemt_type = '<?php echo $order->paymemt_type(); ?>';
  var status = '<?php echo $order->status(); ?>';

  if (paymemt_type == 'bill_payment_tesco_lotus' && status == 'pending') {
    document.getElementById('barcode').setAttribute("style", "display:block");
  }
}

showBarcode();

refreshLoop = setInterval(refresh, 5000);
</script>

<?php include_once __dir__ . '/../templates/footer.php'; ?>
