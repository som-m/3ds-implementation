<?php include_once __dir__ . '/../templates/header.php'; ?>

<div>
  <p>Click the button below to open the checkout form.</p>
</div>

<div>
  <form id="checkoutForm" method="POST" action="/../checkout">
    <input type="hidden" name="omiseToken">
    <input type="hidden" name="omiseSource">
    <button type="submit" id="checkoutButton">Pay</button>
  </form>

  <script>
    OmiseCard.configure({
      publicKey: "<?php echo $_ENV['OMISE_PUBLIC_KEY']; ?>"
    });

    var button = document.querySelector("#checkoutButton");
    var form = document.querySelector("#checkoutForm");

    button.addEventListener("click", (event) => {
      event.preventDefault();
      OmiseCard.open({
        amount: 300000,
        currency: "THB",
        defaultPaymentMethod: "credit_card",
        otherPaymentMethods: "alipay, bill_payment_tesco_lotus, installment, internet_banking, rabbit_linepay, truemoney",
        onCreateTokenSuccess: (nonce) => {
          if (nonce.startsWith("tokn_")) {
            form.omiseToken.value = nonce;
          } else {
            form.omiseSource.value = nonce;
          };
          form.submit();
        }
      });
    });
  </script>
</div>

<?php include_once __dir__ . '/../templates/footer.php'; ?>
