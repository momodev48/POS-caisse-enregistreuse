
    
        <center><h2> Please wait, while we transfer to secure payment panel...</h2></center>
 
   

        <?php if($paymentinfo->Islive==1){?>
        <form id="payment_gw" name="payment_gw" method="POST" action="https://www.paypal.com/cgi-bin/webscr">
        <?php }
		else{
		?>
        <form id="payment_gw" name="payment_gw" method="POST" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
        <?php } ?>
         <input type="hidden" name="business" value="<?php echo $paymentinfo->email;?>">
          <input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="amount" value="<?php echo $orderinfo->totalamount;?>">
<input type="hidden" name="item_number" value="<?php echo $orderinfo->order_id;?>">
<input type="hidden" name="first_name" value="<?php echo $customerinfo->customer_name;?>">
<input type="hidden" name="currency_code" value="<?php echo $paymentinfo->currency;?>">
<input type="hidden" name="return" value="<?php echo base_url();?>ordermanage/order/successful/<?php echo $orderinfo->order_id;?>">
<input type="hidden" name="cancel_return" value = "<?php echo base_url();?>ordermanage/order/cancilorder/<?php echo $orderinfo->order_id;?>">
<input type="submit" value="Pay with SSLCOMMERZ" name="pay" class="display-none">
</form> 
    
        <script>
            window.onload = function(){
              document.forms['payment_gw'].submit()
            }        
        </script>
        
