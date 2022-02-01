<?php
require 'vendor/autoload.php';

$access_token = 'sandbox-sq0atb-4K2efNBH8i9ltb5SoefQeA';
# setup authorization
\SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
# create an instance of the Location API
$locations_api = new \SquareConnect\Api\LocationsApi();
$locationid = '';
try {
  $locations = $locations_api->listLocations();
  $dr = $locations->getLocations();
  $locationid = $dr[0]['id'];
} catch (\SquareConnect\ApiException $e) {
  echo "Caught exception!<br/>";
  print_r("<strong>Response body:</strong><br/>");
  echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
  echo "<br/><strong>Response headers:</strong><br/>";
  echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
  exit(1);
}
?>
<?php

// dotenv is used to read from the '.env' file created for credentials
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
?>
<html>
<head>
  <title>My Payment Form</title>
  <!-- link to the SqPaymentForm library -->
  <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
  <script type="text/javascript">
    window.applicationId =
      <?php
        echo "\"";
        echo ($_ENV["USE_PROD"] == 'true')  ?  $_ENV["PROD_APP_ID"]
                                            :  $_ENV["SANDBOX_APP_ID"];
        echo "\"";
      ?>;
    window.locationId =
    <?php
      echo "\"";
      echo ($_ENV["USE_PROD"] == 'true')  ?  $_ENV["PROD_LOCATION_ID"]
                                          :  $_ENV["SANDBOX_LOCATION_ID"];
      echo "\"";
    ?>;
  </script>

  <!-- link to the local SqPaymentForm initialization -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/square/connect-api-examples/templates/web-ui/payment-form/custom/sq-payment-form.js"></script>
  <!-- link to the custom styles for SqPaymentForm -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/square/connect-api-examples/templates/web-ui/payment-form/custom/sq-payment-form.css">
</head>
<body>
  <!-- Begin Payment Form -->
  <div class="sq-payment-form">
    <!--
      Square's JS will automatically hide these buttons if they are unsupported
      by the current device.
    -->
    <div id="sq-walletbox">
      <button id="sq-google-pay" class="button-google-pay"></button>
      <button id="sq-apple-pay" class="sq-apple-pay"></button>
      <button id="sq-masterpass" class="sq-masterpass"></button>
      <div class="sq-wallet-divider">
        <span class="sq-wallet-divider__text">Or</span>
      </div>
    </div>
    <div id="sq-ccbox">
      <!--
        You should replace the action attribute of the form with the path of
        the URL you want to POST the nonce to (for example, "/process-card").
        You need to then make a "Charge" request to Square's transaction API with
        this nonce to securely charge the customer.
        Learn more about how to setup the server component of the payment form here:
        https://docs.connect.squareup.com/payments/transactions/processing-payment-rest
      -->
      <form id="nonce-form" novalidate action="/process-card.php" method="post">
        <div class="sq-field">
          <label class="sq-label">Card Number</label>
          <div id="sq-card-number"></div>
        </div>
        <div class="sq-field-wrapper">
          <div class="sq-field sq-field--in-wrapper">
            <label class="sq-label">CVV</label>
            <div id="sq-cvv"></div>
          </div>
          <div class="sq-field sq-field--in-wrapper">
            <label class="sq-label">Expiration</label>
            <div id="sq-expiration-date"></div>
          </div>
          <div class="sq-field sq-field--in-wrapper">
            <label class="sq-label">Postal</label>
            <div id="sq-postal-code"></div>
          </div>
        </div>
        <div class="sq-field">
          <button id="sq-creditcard" class="sq-button" onclick="requestCardNonce(event)">
            Pay $1.00 Now
          </button>
        </div>
        <!--
          After a nonce is generated it will be assigned to this hidden input field.
        -->
        <div id="error"></div>
        <input type="hidden" id="card-nonce" name="nonce">
      </form>
    </div>
  </div>
  <!-- End Payment Form -->
</body>
</html>