<!DOCTYPE HTML>
<html>
  <head> 
    <title>Omise.js Pre-Built Form & Omise-PHP</title>
  </head>
  <body>
    <div>
      <form id="checkoutForm" method="POST" action="/checkout.php">
        <input type="hidden" name="omiseToken">
        <input type="hidden" name="omiseSource">
        <button type="submit" id="checkoutButton">Pay</button>
      </form>

      <script type="text/javascript" src="https://cdn.omise.co/omise.js">
      </script>

      <script>
        <?php require_once 'config.php'; ?>

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
            otherPaymentMethods: "alipay, installment, internet_banking, rabbit_linepay, truemoney",
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
  </body>
</html>