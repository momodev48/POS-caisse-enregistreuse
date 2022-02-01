<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('includes/head') ?>
        <style>
        .loading:after {
  content: ' .';
  animation: dots 1s steps(5, end) infinite;}
		@keyframes dots {
  20%, 20% {
    color: rgba(0,0,0,1);
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  40% {
    color: #F00;
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  60% {
    text-shadow:
      .25em 0 0 #F00,
      .5em 0 0 rgba(0,0,0,0);}
  80%, 100% {
    text-shadow:
      .25em 0 0 #666,
      .5em 0 0 #666;}}
	   
        </style>
    </head>

    <body class="hold-transition sidebar-mini <?php if(($title=='posinvoiceloading') || ($title=='Counter Dashboard')){ echo "sidebar-collapse pace-done";}?>">
        <!-- Site wrapper -->
       
        <div class="wrapper">
        <?php if($title=='posinvoiceloading'){?>
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-green">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p><?php echo display('please_wait') ?>...</p>
            </div>
        </div>
         <?php } ?>
<script>
		$(document).ready(function()
		{
			
			setTimeout(function () {
                $('.page-loader-wrapper').fadeOut();
            }, 2000);
			
		});
        
        </script>
            <header class="main-header"> 
                <?php if($title!='posinvoiceloading'){
				$this->load->view('includes/header');
				}
				?>
            </header>

 
            <!-- Left side column. contains the sidebar -->
             <?php if(($title!='posinvoiceloading')){?>
            <aside class="main-sidebar">
                <!-- sidebar -->
                <?php $this->load->view('includes/sidebar') ?>
            </aside>
			<?php } ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper <?php if($title=='posinvoiceloading'){ echo "ml-0";}?>">
                <!-- Content Header (Page header) -->
                <?php if(($title!='posinvoiceloading') && ($title!='Counter Dashboard')){?>
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-home"></i></div>
                    <div class="header-title">
                        <h1><?php if($this->uri->segment(2)=="paymentmethod"){
									$titlename="Payment Method";
								}
								else if($this->uri->segment(2)=="shippingmethod"){
									$titlename="Shipping Method";
									}
							   else if($this->uri->segment(2)=="supplierlist"){
									$titlename="Supplier List";
									}
								else if($this->uri->segment(2)=="restauranttable"){
									$titlename="Restaurant Table";
									}
								else if($this->uri->segment(2)=="customertype"){
									$titlename="Customer Type";
									}
								else if($this->uri->segment(2)=="unitmeasurement"){
									$titlename="Unit Measurement";
									}
								else if($this->uri->segment(2)=="couponlist"){
									$titlename="Coupon List";
									}
								else if($this->uri->segment(2)=="smsetting"){
									$titlename="Sms Setting";
									}
								else if($this->uri->segment(2)=="smsetting"){
									$titlename="Sms Setting";
									}
								else if($this->uri->segment(2)=="shiftmangmentback"){
									$titlename="Shift Module";
									}
								else if($this->uri->segment(2)=="Wastetracking"){
									$titlename="Waste tracking";
									}
								else if($this->uri->segment(2)=="Cexpense"){
									$titlename="Expense";
									}
								else if($this->uri->segment(2)=="kitchensetting"){
									$titlename="kitchen Setting";
									}
								else if($this->uri->segment(2)=="qrmodule"){
									$titlename="QR module";
									}
								else if($this->uri->segment(2)=="facebookloginback"){
									$titlename="Facebook Login";
									}
								else if($this->uri->segment(2)=="customerlist"){
									$titlename="Customer List";
									}
								else if($this->uri->segment(2)=="ingradient"){
									$titlename="Ingredients";
									}
								else if($this->uri->segment(2)=="serversetting"){
									$titlename="Server Setting";
									}		
								else if($this->uri->segment(2)=="Commissionsetting"){
									$titlename="Commission Setting";
									}	
								else if($this->uri->segment(2)=="thirdpratycustomer"){
									$titlename="Third-Party Customers";
									}
								else if($this->uri->segment(2)=="country_city_list"){
									$titlename="Country List";
									}
								else{
									$titlename=str_replace("_", " ", $this->uri->segment(2));
							}
						

						//Paymentmethod
						 ?> <!--/--> <?php echo (!empty($titlename)?ucwords($titlename):null) ?></h1>
                        <small><?php echo (!empty($title)?$title:null) ?></small>
                    </div>
                </section>
				<?php } ?>

                <!-- Main content -->
                <div class="content">
                    <!-- load messages -->
                    <?php $this->load->view('includes/messages') ?>
                    <!-- load custom page -->
                    <?php echo $this->load->view($module.'/'.$page) ?>
                </div> <!-- /.content -->


            </div> <!-- /.content-wrapper -->

<?php if(($title!='posinvoiceloading')){?>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <?php echo (!empty($setting->address)?$setting->address:null) ?> 
                </div>

                <strong>
                    <?php echo (!empty($setting->footer_text)?$setting->footer_text:null) ?>
                </strong>
                    <a href="<?php echo current_url() ?>">
                    <?php echo (!empty($setting->title)?$setting->title:null) ?></a>
            </footer>
 <?php } ?>
            
        </div> <!-- ./wrapper -->
 
        <!-- Start Core Plugins-->

        <?php $this->load->view('includes/js') ?>
        <script>
        var url = window.location;
        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href != url;
        }).parent().removeClass('active');

        // for sidebar menu entirely but not cover treeview
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');

        // for treeview
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
        </script>
        <input name="segment1" id="segment1" type="hidden" value="<?php echo $this->uri->segment(1);?>" />
<input name="segment2" id="segment2" type="hidden" value="<?php echo $this->uri->segment(2);?>" />
<input name="segment3" id="segment3" type="hidden" value="<?php echo $this->uri->segment(3);?>" />
<input name="segment4" id="segment4" type="hidden" value="<?php echo $this->uri->segment(4);?>" />
<input name="segment5" id="segment5" type="hidden" value="<?php echo $this->uri->segment(5);?>" />
    </body>
</html>
