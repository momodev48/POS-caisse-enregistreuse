<?php $webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;?>
<link href="<?php echo base_url('themes/'.$acthemename.'/assets_web/css/paytm.css') ?>" rel="stylesheet" type="text/css"/>  
  <!-- Contact Area -->
    <section class="contact_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 paytm_padding">  
                	 <div id="form-container">
   				<form action="<?php echo base_url();?>hungry/pgRedirectqr" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="ORDER_ID" name="ORDER_ID" size="20" maxlength="20" autocomplete="off" tabindex="1" value="<?php echo  "ORDS" .$orderinfo->order_id?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="CUST_ID" name="CUST_ID" maxlength="12" size="12" autocomplete="off" tabindex="2" value="<?php echo $orderinfo->customer_id;?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="INDUSTRY_TYPE_ID" name="INDUSTRY_TYPE_ID" maxlength="12" size="12"  autocomplete="off" tabindex="3" value="Retail">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="CHANNEL_ID" name="CHANNEL_ID" maxlength="12" size="12" autocomplete="off" tabindex="4" value="WEB">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="TXN_AMOUNT" name="TXN_AMOUNT" autocomplete="off" tabindex="5" value="<?php echo $grandtotal;?>">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="CheckOut" class="btn btn-success btn-lg">
                </div>
                <input type="hidden" id="amount" name="amount" value="<?php echo $grandtotal;?>">
      <input type="hidden" id="currency" name="currency" value="<?php echo $paymentinfo->currency;?>">
      <input type="hidden" id="orderid" name="orderid" value="<?php echo $orderinfo->order_id;?>">
      <input type="hidden" id="pageid" name="pageid" value="<?php echo $page;?>">
            </form>
            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Area -->
