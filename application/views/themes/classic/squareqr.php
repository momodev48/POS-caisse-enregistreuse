  <!-- Contact Area -->
    <section class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">  
   <?php 
   $applicationid= $paymentinfo->marchantid;
   $locationID= $paymentinfo->email;
   ?>
    <?php if($paymentinfo->Islive==1){?>
    <script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
    <!-- link to the local SqPaymentForm initialization -->
    <script type="text/javascript">
	// JavaScript Document
// Set the application ID
var applicationId = "<?php echo $applicationid;?>";

// Set the location ID
var locationId = "<?php echo $locationID;?>";


function buildForm(form) {
  if (SqPaymentForm.isSupportedBrowser()) {
    form.build();
    form.recalculateSize();
  }
}
function buildForm1() {
    if (SqPaymentForm.isSupportedBrowser()) {
      var paymentDiv = document.getElementById("form-container");
      if (paymentDiv.style.display === "none") {
          paymentDiv.style.display = "block";
      }
      paymentform.build();
      paymentform.recalculateSize();
    } else {
      // Show a "Browser is not supported" message to your buyer
    }
  }
/*
 * function: requestCardNonce
 *
 * requestCardNonce is triggered when the "Pay with credit card" button is
 * clicked
 *
 * Modifying this function is not required, but can be customized if you
 * wish to take additional action when the form button is clicked.
 */
function requestCardNonce(event) {

  // Don't submit the form until SqPaymentForm returns with a nonce
  event.preventDefault();

  // Request a nonce from the SqPaymentForm object
  paymentForm.requestCardNonce();
}

// Create and initialize a payment form object
var paymentForm = new SqPaymentForm({
 
  // Initialize the payment form elements
  applicationId: applicationId,
  locationId: locationId,
  inputClass: 'sq-input',
  autoBuild: false,

  // Customize the CSS for SqPaymentForm iframe elements
  inputStyles: [{
    fontSize: '16px',
    fontFamily: 'Helvetica Neue',
    padding: '16px',
    color: '#373F4A',
    backgroundColor: 'transparent',
    lineHeight: '24px',
    placeholderColor: '#CCC',
    _webkitFontSmoothing: 'antialiased',
    _mozOsxFontSmoothing: 'grayscale'
  }],

  // Initialize Apple Pay placeholder ID
  applePay: false,

  // Initialize Masterpass placeholder ID
  masterpass: false,

  // Initialize the credit card placeholders
  cardNumber: {
    elementId: 'sq-card-number',
    placeholder: 'XXXX XXXX XXXX XXXX'
  },
  cvv: {
    elementId: 'sq-cvv',
    placeholder: 'CVV'
  },
  expirationDate: {
    elementId: 'sq-expiration-date',
    placeholder: 'MM/YY'
  },
  postalCode: {
    elementId: 'sq-postal-code',
    placeholder: '12345'
  },

  // SqPaymentForm callback functions
  callbacks: {
    /*
     * callback function: createPaymentRequest
     * Triggered when: a digital wallet payment button is clicked.
     * Replace the JSON object declaration with a function that creates
     * a JSON object with Digital Wallet payment details
     */


    /*
     * callback function: cardNonceResponseReceived
     * Triggered when: SqPaymentForm completes a card nonce request
     */
    cardNonceResponseReceived: function (errors, nonce, cardData) {
      if (errors) {
        // Log errors from nonce generation to the Javascript console
        console.log("Encountered errors:");
        errors.forEach(function (error) {
          console.log(' er= ' + error.message);
          alert(error.message);
        });

        return;
      }
      // Assign the nonce value to the hidden form field
      document.getElementById('card-nonce').value = nonce;

      // POST the nonce form to the payment processing page
      document.getElementById('nonce-form').submit();

    },

    /*
     * callback function: unsupportedBrowserDetected
     * Triggered when: the page loads and an unsupported browser is detected
     */
    unsupportedBrowserDetected: function () {
      /* PROVIDE FEEDBACK TO SITE VISITORS */
    },

    /*
     * callback function: inputEventReceived
     * Triggered when: visitors interact with SqPaymentForm iframe elements.
     */
    inputEventReceived: function (inputEvent) {
      switch (inputEvent.eventType) {
        case 'focusClassAdded':
          /* HANDLE AS DESIRED */
          break;
        case 'focusClassRemoved':
          /* HANDLE AS DESIRED */
          break;
        case 'errorClassAdded':
          document.getElementById("error").innerHTML = "Please fix card information errors before continuing.";
          break;
        case 'errorClassRemoved':
          /* HANDLE AS DESIRED */
          document.getElementById("error").style.display = "none";
          break;
        case 'cardBrandChanged':
          /* HANDLE AS DESIRED */
          break;
        case 'postalCodeChanged':
          /* HANDLE AS DESIRED */
          break;
      }
    },

    /*
     * callback function: paymentFormLoaded
     * Triggered when: SqPaymentForm is fully loaded
     */
    paymentFormLoaded: function () {
      /* HANDLE AS DESIRED */
      console.log("The form loaded!");
    }
  }
});
    </script>
    <?php }
	else{
	?>
    <script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>
	<!-- link to the local SqPaymentForm initialization -->
    <script type="text/javascript">
	// JavaScript Document
// Set the application ID
var applicationId = "<?php echo $applicationid;?>";

// Set the location ID
var locationId = "<?php echo $locationID;?>";


function buildForm(form) {
  if (SqPaymentForm.isSupportedBrowser()) {
    form.build();
    form.recalculateSize();
  }
}
function buildForm1() {
    if (SqPaymentForm.isSupportedBrowser()) {
      var paymentDiv = document.getElementById("form-container");
      if (paymentDiv.style.display === "none") {
          paymentDiv.style.display = "block";
      }
      paymentform.build();
      paymentform.recalculateSize();
    } else {
      // Show a "Browser is not supported" message to your buyer
    }
  }
/*
 * function: requestCardNonce
 *
 * requestCardNonce is triggered when the "Pay with credit card" button is
 * clicked
 *
 * Modifying this function is not required, but can be customized if you
 * wish to take additional action when the form button is clicked.
 */
function requestCardNonce(event) {

  // Don't submit the form until SqPaymentForm returns with a nonce
  event.preventDefault();

  // Request a nonce from the SqPaymentForm object
  paymentForm.requestCardNonce();
}

// Create and initialize a payment form object
var paymentForm = new SqPaymentForm({
 
  // Initialize the payment form elements
  applicationId: applicationId,
  locationId: locationId,
  inputClass: 'sq-input',
  autoBuild: false,

  // Customize the CSS for SqPaymentForm iframe elements
  inputStyles: [{
    fontSize: '16px',
    fontFamily: 'Helvetica Neue',
    padding: '16px',
    color: '#373F4A',
    backgroundColor: 'transparent',
    lineHeight: '24px',
    placeholderColor: '#CCC',
    _webkitFontSmoothing: 'antialiased',
    _mozOsxFontSmoothing: 'grayscale'
  }],

  // Initialize Apple Pay placeholder ID
  applePay: false,

  // Initialize Masterpass placeholder ID
  masterpass: false,

  // Initialize the credit card placeholders
  cardNumber: {
    elementId: 'sq-card-number',
    placeholder: 'XXXX XXXX XXXX XXXX'
  },
  cvv: {
    elementId: 'sq-cvv',
    placeholder: 'CVV'
  },
  expirationDate: {
    elementId: 'sq-expiration-date',
    placeholder: 'MM/YY'
  },
  postalCode: {
    elementId: 'sq-postal-code',
    placeholder: '12345'
  },

  // SqPaymentForm callback functions
  callbacks: {
    /*
     * callback function: createPaymentRequest
     * Triggered when: a digital wallet payment button is clicked.
     * Replace the JSON object declaration with a function that creates
     * a JSON object with Digital Wallet payment details
     */


    /*
     * callback function: cardNonceResponseReceived
     * Triggered when: SqPaymentForm completes a card nonce request
     */
    cardNonceResponseReceived: function (errors, nonce, cardData) {
      if (errors) {
        // Log errors from nonce generation to the Javascript console
        console.log("Encountered errors:");
        errors.forEach(function (error) {
          console.log(' er= ' + error.message);
          alert(error.message);
        });

        return;
      }
      // Assign the nonce value to the hidden form field
      document.getElementById('card-nonce').value = nonce;

      // POST the nonce form to the payment processing page
      document.getElementById('nonce-form').submit();

    },

    /*
     * callback function: unsupportedBrowserDetected
     * Triggered when: the page loads and an unsupported browser is detected
     */
    unsupportedBrowserDetected: function () {
      /* PROVIDE FEEDBACK TO SITE VISITORS */
    },

    /*
     * callback function: inputEventReceived
     * Triggered when: visitors interact with SqPaymentForm iframe elements.
     */
    inputEventReceived: function (inputEvent) {
      switch (inputEvent.eventType) {
        case 'focusClassAdded':
          /* HANDLE AS DESIRED */
          break;
        case 'focusClassRemoved':
          /* HANDLE AS DESIRED */
          break;
        case 'errorClassAdded':
          document.getElementById("error").innerHTML = "Please fix card information errors before continuing.";
          break;
        case 'errorClassRemoved':
          /* HANDLE AS DESIRED */
          document.getElementById("error").style.display = "none";
          break;
        case 'cardBrandChanged':
          /* HANDLE AS DESIRED */
          break;
        case 'postalCodeChanged':
          /* HANDLE AS DESIRED */
          break;
      }
    },

    /*
     * callback function: paymentFormLoaded
     * Triggered when: SqPaymentForm is fully loaded
     */
    paymentFormLoaded: function () {
      /* HANDLE AS DESIRED */
      console.log("The form loaded!");
    }
  }
});
    </script>
	<?php }?>
    

    <!-- link to the custom styles for SqPaymentForm -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/sqpaymentform-basic.css">
	<script>
	 document.addEventListener("DOMContentLoaded", function(event) {
    if (SqPaymentForm.isSupportedBrowser()) {
      paymentForm.build();
      paymentForm.recalculateSize();
    }
  });
	</script>

<div id="form-container">
  <div id="sq-ccbox">
    <form id="nonce-form" novalidate action="<?php echo base_url();?>payment-process" method="post">
      <fieldset>
        <span class="label">Card Number</span>
        <div id="sq-card-number"></div>

        <div class="third">
          <span class="label">Expiration</span>
          <div id="sq-expiration-date"></div>
        </div>

        <div class="third">
          <span class="label">CVV</span>
          <div id="sq-cvv"></div>
        </div>

        <div class="third">
          <span class="label">Postal</span>
          <div id="sq-postal-code"></div>
        </div>
      </fieldset>

      <button id="sq-creditcard" class="button-credit-card" onClick="requestCardNonce(event)">Pay <?php echo $paymentinfo->currency;?> <?php echo $grandtotal;?></button>

      <div id="error"></div>

      <!--
        After a nonce is generated it will be assigned to this hidden input field.
      -->
	  <input type="hidden" id="amount" name="amount" value="<?php echo $grandtotal;?>">
      <input type="hidden" id="currency" name="currency" value="<?php echo $paymentinfo->currency;?>">
      <input type="hidden" id="orderid" name="orderid" value="<?php echo $orderinfo->order_id;?>">
      <input type="hidden" id="pageid" name="pageid" value="<?php echo $page;?>">
      <input type="hidden" id="card-nonce" name="nonce">
    </form>
  </div> <!-- end #sq-ccbox -->

</div> <!-- end #form-container -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Area -->
