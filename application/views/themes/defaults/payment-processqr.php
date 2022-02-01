<?php
require 'connect-php-sdk-master/vendor/autoload.php';
$access_token = $paymentinfo->password;
$currency=$paymentinfo->currency;
# setup authorization
$api_config = new \SquareConnect\Configuration();
if($paymentinfo->Islive==1){
$api_config->setHost("https://connect.squareup.com");
}
else{
$api_config->setHost("https://connect.squareupsandbox.com");
}
$api_config->setAccessToken($access_token);
$api_client = new \SquareConnect\ApiClient($api_config);
# create an instance of the Payments API class
$transactions_api = new \SquareConnect\Api\TransactionsApi($api_client);
$location_id = $paymentinfo->email;
$nonce = $_POST['nonce'];
$grandtotal=$_POST['amount'];
$actualamount=round($grandtotal*100);
$request_body = array (
    "card_nonce" => $nonce,
    "amount_money" => array (
        "amount" => (int) $actualamount,
        "currency" => $currency
    ),
    "idempotency_key" => uniqid()
);

try {
    $result = $transactions_api->charge($location_id,  $request_body);
	if($result['transaction']['id']){
	
		$redirecturl=base_url().'hungry/successfulqr/'.$orderid.'/'.$page;
		header("Location: ".$redirecturl); /* Redirect browser */
  exit();
	}
} catch (\SquareConnect\ApiException $e) {


$webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;
	?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/sweetalert/sweetalert.css">
     <script type="text/javascript" src="<?php echo base_url();?>assets/sweetalert/sweetalert.min.js"></script>

<script>
$(document).ready(function(){
   "use strict";
swal({
		title: "Order Failed!!!",
		text: "Order Not Placed Due to some Reason.Please check Authorization or Currency???",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Try Again",
		cancelButtonText: "Cancel",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function (isConfirm) {
		if (isConfirm) {
		  window.location.href="<?php echo base_url()?>paymentsqr/<?php echo $orderid;?>";
		}
		 else {
			window.location.href="<?php echo base_url()?>apporedrlist";
		}
	});
});
</script>


	<?php } ?>