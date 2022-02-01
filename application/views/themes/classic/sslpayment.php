 <?php 
 $webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;?>

<center><h2> Please wait, while we transfer to secure payment panel...</h2></center>

<?php if($paymentinfo->Islive==1){?>
<?php echo form_open('https://securepay.sslcommerz.com/gwprocess/v3/process.php','method="post" id="payment_gw" name="payment_gw"')?>
    <?php }
            else{
    ?>
    <?php echo form_open('https://sandbox.sslcommerz.com/gwprocess/v3/process.php','method="post" id="payment_gw" name="payment_gw" testbox')?>
        <?php } ?>
        <input type="hidden" name="store_id" value="<?php echo $paymentinfo->marchantid;?>">
        <input type="hidden" name="total_amount" value="<?php echo $orderinfo->totalamount;?>">
        <input type="hidden" name="tran_id" value="<?php echo $orderinfo->order_id;?>">
        <input type="hidden" name="card_issuer" value="<?php echo $billinfo->issuer_name;?>">
        <input type="hidden" name="card_no" value="<?php echo $billinfo->card_no;?>">
        <input type="hidden" name="currency" value="<?php echo $paymentinfo->currency;?>">
        <input type="hidden" name="success_url" value="<?php echo base_url();?>hungry/successful/<?php echo $orderinfo->order_id;?>">
        <input type="hidden" name="fail_url" value = "<?php echo base_url();?>hungry/fail/<?php echo $orderinfo->order_id;?>">
        <input type="hidden" name="cancel_url" value = "<?php echo base_url();?>hungry/cancilorder/<?php echo $orderinfo->order_id;?>">
        <input type="submit" value="Pay with SSLCOMMERZ" name="pay" class="rma_display_none" >
    </form>
<script>
	"use strict";
window.onload = function(){
document.forms['payment_gw'].submit()
}
</script>

