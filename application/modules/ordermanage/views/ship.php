        <center><h2> Please wait, while we transfer to secure payment panel...</h2></center>
        <?php if($paymentinfo->Islive==1){?>
        <form id="payment_gw" name="payment_gw" method="POST" action="https://payment-webinit.sips-atos.com/paymentInit">
        <?php }
		else{
		?>
        <form id="payment_gw" name="payment_gw" method="POST" action="https://payment-webinit.simu.sips-atos.com/paymentServlet">
        <?php } 
		$datafield='amount='.round($orderinfo->totalamount).'|currencyCode=978|merchantId='.$paymentinfo->marchantid.'|normalReturnUrl='.base_url().'ordermanage/order/successful/'.$orderinfo->order_id.'|transactionReference='.$orderinfo->order_id.'|keyVersion='.$paymentinfo->email.'';
		$secretKey=$paymentinfo->password;
		$seal=hash('sha256', $datafield.$secretKey);
		?>
<input type="hidden" name="Data" value="amount=<?php echo round($orderinfo->totalamount);?>|currencyCode=978|merchantId=<?php echo $paymentinfo->marchantid;?>|normalReturnUrl=<?php echo base_url();?>ordermanage/order/successful/<?php echo $orderinfo->order_id;?>|transactionReference=<?php echo $orderinfo->order_id;?>|keyVersion=<?php echo $paymentinfo->email;?>">
    <input type="hidden" name="InterfaceVersion" value="HP_1.0">
    <input type="hidden" name="Seal" value="<?php echo $seal;?>">

<input type="submit" value="Pay with SSLCOMMERZ" name="pay" class="display-none">
</form> 
    
        <script>
            window.onload = function(){
              document.forms['payment_gw'].submit()
            }        
        </script>
        
