<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/posordernew.css'); ?>">
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/postop.js'); ?>" type="text/javascript"></script>
<input name="site_url" type="hidden" value="<?php echo $soundsetting->nofitysound;?>" id="site_url">
<?php $subtotal=0;
    $ptdiscount=0;?>
  <div id="openregister" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="openclosecash">
      
    </div>
  </div>
</div>  
<div class="modal fade" id="vieworder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo display('foodnote') ?></h5>
                    
                </div>
      <div class="modal-body pd-15">
        	<div class="row">
            	<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" for="user_email"><?php echo display('foodnote') ?></label>
                                                <textarea cols="45" rows="3" id="foodnote" class="form-control" name="foodnote"></textarea>
                                                <input name="foodqty" id="foodqty" type="hidden" />
                                                 <input name="foodgroup" id="foodgroup" type="hidden" />
                                                <input name="foodid" id="foodid" type="hidden" />
                                                <input name="foodvid" id="foodvid" type="hidden"/>
                                                <input name="foodcartid" id="foodcartid" type="hidden"/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <a onclick="addnotetoitem()" class="btn btn-success btn-md text-white" id="notesmbt"><?php echo display('addnotesi') ?></a>
                                        </div>
            </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-none">
      <div class="modal-body p-0">
        <div class="position-relative">
          <div class="calcbody">
            <form name="calc">
              <div class="cacldisplay">
                <input type="text" placeholder="0" name="displayResult" />
              </div>
              <div class="calcbuttons">
                <div class="calcrow">
                  <input type="button" name="c0" value="C" placeholder="0" onClick="calcNumbers(c0.value)">
                  <button type="button" data-dismiss="modal" aria-label="Close"> <i class="fa fa-power-off" aria-hidden="true"></i> </button>
                </div>
                <div class="calcrow">
                  <input type="button" name="b7" value="7" onClick="calcNumbers(b7.value)">
                  <input type="button" name="b8" value="8" onClick="calcNumbers(b8.value)">
                  <input type="button" name="b9" value="9" onClick="calcNumbers(b9.value)">
                  <input type="button" name="addb" value="+" onClick="calcNumbers(addb.value)">
                </div>
                <div class="calcrow">
                  <input type="button" name="b4" value="4" onClick="calcNumbers(b4.value)">
                  <input type="button" name="b5" value="5" onClick="calcNumbers(b5.value)">
                  <input type="button" name="b6" value="6" onClick="calcNumbers(b6.value)">
                  <input type="button" name="subb" value="-" onClick="calcNumbers(subb.value)">
                </div>
                <div class="calcrow">
                  <input type="button" name="b1" value="1" onClick="calcNumbers(b1.value)">
                  <input type="button" name="b2" value="2" onClick="calcNumbers(b2.value)">
                  <input type="button" name="b3" value="3" onClick="calcNumbers(b3.value)">
                  <input type="button" name="mulb" value="*" onClick="calcNumbers(mulb.value)">
                </div>
                <div class="calcrow">
                  <input type="button" name="b0" value="0" onClick="calcNumbers(b0.value)">
                  <input type="button" name="potb" value="." onClick="calcNumbers(potb.value)">
                  <input type="button" name="divb" value="/" onClick="calcNumbers(divb.value)">
                  <input type="button" class="calcred" value="=" onClick="displayResult.value = eval(displayResult.value)">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="payprint" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('sl_payment');?></strong> </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">
                <div class="col-md-8">
                  <div class="form-group row">
                    <label for="payments" class="col-sm-4 col-form-label"><?php echo display('paymd');?></label>
                    <div class="col-sm-7 customesl">
                      <?php $card_type=4;
                                  echo form_dropdown('card_typesl',$paymentmethod,(!empty($card_type)?$card_type:null),'class="postform resizeselect form-control" id="card_typesl"') ?>
                    </div>
                  </div>
                  <div id="cardarea wpr_100 display-none">
                    <div class="form-group row">
                      <label for="card_terminal" class="col-sm-4 col-form-label"><?php echo display('crd_terminal');?></label>
                      <div class="col-sm-7 customesl"> <?php echo form_dropdown('card_terminal',$terminalist,'','class="postform resizeselect form-control" id="card_terminal"') ?> </div>
                    </div>
                    <div class="form-group row">
                      <label for="bank" class="col-sm-4 col-form-label"><?php echo display('sl_bank');?></label>
                      <div class="col-sm-7 customesl"> <?php echo form_dropdown('bank',$banklist,'','class="postform resizeselect form-control" id="bank"') ?> </div>
                    </div>
                    <div class="form-group row">
                      <label for="4digit" class="col-sm-4 col-form-label"><?php echo display('lstdigit');?></label>
                      <div class="col-sm-7 customesl">
                        <input type="text" class="form-control" id="last4digit" name="last4digit" value="" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo display('total_amount');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="hidden" id="maintotalamount" name="maintotalamount" value="" />
                      <input type="text" class="form-control" id="totalamount" name="totalamount" readonly="readonly" value="" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo display('cuspayment');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="number"  class="form-control" id="paidamount" name="paidamount" placeholder="0" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo display('cuspayment');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="text" class="form-control" id="change" name="change" readonly="readonly" value="" />
                    </div>
                  </div>
                  <div class="form-group text-right">
                    <div class="col-sm-11 pr-0">
                      <button type="button" id="paidbill" class="btn btn-success w-md m-b-5" onclick="orderconfirmorcancel()"><?php echo display('pay_print');?></button>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <form name="placenum">
                    <div class="grid-container">
                      <input type="button" class="grid-item" name="n1" value="1" onClick="inputNumbers(n1.value)">
                      <input type="button" class="grid-item" name="n2" value="2" onClick="inputNumbers(n2.value)">
                      <input type="button" class="grid-item" name="n3" value="3" onClick="inputNumbers(n3.value)">
                      <input type="button" class="grid-item" name="n4" value="4" onClick="inputNumbers(n4.value)">
                      <input type="button" class="grid-item" name="n5" value="5" onClick="inputNumbers(n5.value)">
                      <input type="button" class="grid-item" name="n6" value="6" onClick="inputNumbers(n6.value)">
                      <input type="button" class="grid-item" name="n7" value="7" onClick="inputNumbers(n7.value)">
                      <input type="button" class="grid-item" name="n8" value="8" onClick="inputNumbers(n8.value)">
                      <input type="button" class="grid-item" name="n9" value="9" onClick="inputNumbers(n9.value)">
                      <input type="button" class="grid-item" name="n10" value="10" onClick="inputNumbers(n10.value)">
                      <input type="button" class="grid-item" name="n20" value="20" onClick="inputNumbers(n20.value)">
                      <input type="button" class="grid-item" name="n50" value="50" onClick="inputNumbers(n50.value)">
                      <input type="button" class="grid-item" name="n100" value="100" onClick="inputNumbers(n100.value)">
                      <input type="button" class="grid-item" name="n500" value="500" onClick="inputNumbers(n500.value)">
                      <input type="button" class="grid-item" name="n1000" value="1000" onClick="inputNumbers(n1000.value)">
                      <input type="button" class="grid-item" name="n0" value="0" onClick="inputNumbers(n0.value)">
                      <input type="button" class="grid-item" name="n00" value="00" onClick="inputNumbers(n00.value)">
                      <input type="button" class="grid-item" name="c0" value="C" placeholder="0" onClick="inputNumbers(c0.value)">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="paymentsselect" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('sl_payment');?></strong> </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">
                <div class="form-group row">
                  <label for="payments" class="col-sm-4 col-form-label"><?php echo display('paymd');?></label>
                  <div class="col-sm-7 customesl">
                    <?php $card_type=4;
                                  echo form_dropdown('card_typesl',$paymentmethod,(!empty($card_type)?$card_type:null),'class="postform resizeselect form-control" id="card_typesl"') ?>
                  </div>
                </div>
                <div id="cardarea display-none wpr_100">
                  <div class="form-group row">
                    <label for="card_terminal" class="col-sm-4 col-form-label"><?php echo display('crd_terminal');?></label>
                    <div class="col-sm-7 customesl"> <?php echo form_dropdown('card_terminal',$terminalist,'','class="postform resizeselect form-control" id="card_terminal"') ?> </div>
                  </div>
                  <div class="form-group row">
                    <label for="bank" class="col-sm-4 col-form-label"><?php echo display('sl_bank');?></label>
                    <div class="col-sm-7 customesl"> <?php echo form_dropdown('bank',$banklist,'','class="postform resizeselect form-control" id="bank"') ?> </div>
                  </div>
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label"><?php echo display('lstdigit');?></label>
                    <div class="col-sm-7 customesl">
                      <input type="text" class="form-control" id="last4digit" name="last4digit" value="" />
                    </div>
                  </div>
                </div>
                <div class="form-group text-right">
                  <div class="col-sm-11 pr-0">
                    <button type="button" class="btn btn-success w-md m-b-5" onclick="onlinepay()"><?php echo display('payn');?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="cancelord" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong><?php echo display('can_ord');?></strong> </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="panel">
              <div class="panel-body">
                <div class="form-group row">
                  <label for="payments" class="col-sm-4 col-form-label"><?php echo display('ordid');?></label>
                  <div class="col-sm-7 customesl"> <span id="canordid"></span>
                    <input name="mycanorder" id="mycanorder" type="hidden" value=""  />
                  </div>
                </div>
                <div class="form-group row">
                  <label for="canreason" class="col-sm-4 col-form-label"><?php echo display('can_reason');?></label>
                  <div class="col-sm-7 customesl">
                    <textarea name="canreason" id="canreason" cols="35" rows="3" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group text-right">
                  <div class="col-sm-11 pr-0">
                    <button type="button" class="btn btn-success w-md m-b-5" id="cancelreason"><?php echo display('submit');?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong>
        <?php //echo display('unit_update');?>
        </strong> </div>
      <div class="modal-body addonsinfo"> </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>
<!-- 22-09 -->
<div id="payprint_marge" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg" id="modal-ajaxview"> </div>
</div>
<div id="tablemodal" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-inner" id="table-ajaxview"> </div>
</div>
<div id="payprint_split" class="modal fade  bd-example-modal-lg" role="dialog">
  <div class="modal-dialog modal-lg" id="modal-ajaxview-split"> </div>
</div>

<?php echo form_open('ordermanage/order/insert_customer','method="post" class="form-vertical" id="validate"')?>
  <div class="modal fade modal-warning" id="client-info" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title"><?php echo display('add_customer');?></h3>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label"><?php echo display('customer_name');?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
              <input class="form-control simple-control" name ="customer_name" id="name" type="text" placeholder="Customer Name"  required="">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label"><?php echo display('email');?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
              <input class="form-control" name ="email" id="email" type="email" placeholder="Customer Email"  required="">
            </div>
          </div>
          <div class="form-group row">
            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile');?> <i class="text-danger">*</i></label>
            <div class="col-sm-6">
              <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="Customer Mobile"  required="" min="0">
            </div>
          </div>
          <div class="form-group row">
            <label for="address " class="col-sm-3 col-form-label"><?php echo display('b_address');?></label>
            <div class="col-sm-6">
              <textarea class="form-control" name="address" id="address " rows="3" placeholder="Customer Address"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="address " class="col-sm-3 col-form-label"><?php echo display('fav_addesrr');?></label>
            <div class="col-sm-6">
              <textarea class="form-control" name="favaddress" id="favaddress " rows="3" placeholder="Customer Address"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close');?> </button>
          <button type="submit" class="btn btn-success"><?php echo display('submit');?> </button>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>
  <!-- /.modal -->
</form>
<div class="modal fade modal-warning" id="myModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <form id="updateCart" action="#" method="post">
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <th class="wpr_25">Price</th>
                <th class="wpr_25"><span id="net_price" class="price"></span></th>
              </tr>
            </tbody>
          </table>
          <div class="form-group row">
            <label for="available_quantity" class="col-sm-4 col-form-label">Ava. Qnty</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="available_quantity" placeholder="Ava. Qnty" name="available_quantity" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="unit" class="col-sm-4 col-form-label">Unit</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="unit" placeholder="Unit" name="unit" readonly="readonly">
            </div>
          </div>
          <div class="form-group row">
            <label for="Qnty" class="col-sm-4 col-form-label">Qnty <span class="color-red">*</span></label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="Qnty" name="quantity">
            </div>
          </div>
          <div class="form-group row">
            <label for="Rate" class="col-sm-4 col-form-label">Rate <span class="color-red">*</span></label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="Rate" name="rate">
            </div>
          </div>
          <div class="form-group row">
            <label for="Dis/ Pcs" class="col-sm-4 col-form-label">Dis/ Pcs</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" id="Dis/ Pcs" placeholder="Dis/ Pcs" name="discount">
            </div>
          </div>
          <input type="hidden" name="rowID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->
<?php 
 
$scan = scandir('application/modules/');
$qrapp=0;
foreach($scan as $file) {
   if($file=="qrapp"){
	   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
	   $qrapp=1;
	   }
	   }
}

 ?>
 <input name="csrfres" id="csrfresarvation" type="hidden" value="<?php echo $this->security->get_csrf_token_name(); ?>" />
 <input name="csrfhash" id="csrfhashresarvation" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<div class="row pos">
  <div class="panel">
    <div class="panel-body">
       <div class="tabsection"> <span class="display-none"><?php echo $settinginfo->language;?></span>
        <ul class="nav nav-tabs mb-2" role="tablist">
          <li><a href="<?php echo base_url() ?>dashboard/home" class="maindashboard"><i class="fa fa-home"></i></a></li>
          <li class="active"> <a href="#home" role="tab" data-toggle="tab" title="New Order" class="home newtab" onclick="giveselecttab(this)"><i class="fa fa-plus smallview"></i> <span class="responsiveview"><?php echo display('nw_order');?></span> </a></li>
          <li><a href="#profile" role="tab" data-toggle="tab" class="ongord newtab" id="ongoingorder" onclick="giveselecttab(this)"><i class="fa fa-hourglass-start smallview"></i> <span class="responsiveview"><?php echo display('ongoingorder');?></span> </a> </li>
          <li><a href="#kitchen" role="tab" data-toggle="tab" class="torder newtab" id="kitchenorder" onclick="giveselecttab(this)"><i class="fa fa-coffee smallview"></i> <span class="responsiveview"><?php echo display('kitchen_status');?></span> </a> </li>
          <?php if($qrapp==1){?>
          <li class="seelist2"> <a href="#qrorder" role="tab" data-toggle="tab" id="todayqrorder" class="home newtab" onclick="giveselecttab(this)"><i class="fa fa-qrcode smallview"></i> <span class="responsiveview"><?php echo display('qr-order');?></span> </a> <a href="" class="notif2"><span class="label label-danger count2">0</span></a> </li>
          <?php } ?>
          <li class="seelist"> <a href="#settings" role="tab" data-toggle="tab" class="comorder newtab" id="todayonlieorder" onclick="giveselecttab(this)"><i class="fa fa-shopping-bag smallview"></i> <span class="responsiveview"><?php echo display('onlineord');?></span> </a> <a href="" class="notif"><span class="label label-danger count">0</span></a> </li>
          <li> <a href="#messages" role="tab" data-toggle="tab" class="torder newtab" id="todayorder" onclick="giveselecttab(this)"><i class="fa fa-first-order smallview"></i> <span class="responsiveview"><?php echo display('tdayorder');?></span> </a> </li>
          <?php if ($new_version!=$myversion) {
		  if($versioncheck->version!=$new_version){
		  ?><li class="mobiletag">
          <a href="<?php echo base_url("dashboard/autoupdate") ?>" class="updateanimate"><i class="fa fa-warning fa-warning-bg"></i><span class="f-size-weight">Update Available</span></a>
          </li><?php } } ?>
          <li class="mobiletag"><a href="javascript:;" class="btn" onclick="closeopenresister()" role="button"><i class="fa fa-window-close fa-lg"></i></a></li>
          <li class="mobiletag"><a  href="#"><i class="fa fa-keyboard hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<table class='table table-condensed table-striped' >
        <tr>
            <th>Operations</th>
            <th>Keyboard Shortcut</th>
            <th>Operations</th>
            <th>Keyboard Shortcut</th>
        </tr>
        <tr>
        <td>New Order Tab</td>
        <td>Shift+N</td>
        <td>On Going Tab</td>
        <td>Shift+G</td>
        </tr>
        <tr>
        <td>Today Order Tab</td>
        <td>Shift+T</td>
        <td>Online Order Tab</td>
        <td>Shift+O</td>
        </tr>
        <tr>
        <td>Place Order</td>
        <td>Shift+P</td>
        <td>Quick Order</td>
        <td>Shift+Q</td>
        </tr>
        <tr>
        <td>Search Product</td>
        <td>Shift+S</td>
        <td>Select Customer</td>
        <td>Shift+C</td>
        </tr>               
        <tr>
        <td>Select Customer Type</td>
        <td>Shift+Y</td>
        <td>Edit Discount:</td>
        <td>Shift+D</td></tr>
        <tr>
        <td>Edit Service Charge</td>
        <td>Shift+R</td>
        <td>Select Waiter</td>
        <td>Shift+W</td>
        </tr>          
        <tr>
        <td>Select Table</td>
        <td>Shift+B</td>
        <td>Cooking Time</td>
        <td>Alt+K</td></tr>
        <tr>
        <td>Search Table</td>
        <td>Alt+T</td>
        <td>Go Edit</td>
        <td>Shift+E</td></tr>
        <tr>
        <td>Search Today Order</td>
        <td>Shift+X</td>
        <td>Search Online Order</td>
        <td>Shift+V</td>
        </tr>  
        <tr>
        <td>Update Search Product</td>
        <td>Alt+S</td>
        <td>Update Select Customer</td>
        <td>Alt+C</td>
        </tr>               
        <tr>
        <td>Update Select Customer Type</td>
        <td>Alt+Y</td>
        <td>Update Discount:</td>
        <td>Alt+D</td></tr>
        <tr>
        <td>Update Service Charge:</td>
        <td>Alt+R</td>
        <td>Update Select Table</td>
        <td>Alt+B</td>
        </tr>          
        
        <td>Update Submit From</td>
        <td>Alt+U</td>
        <td>Select Payment Type</td>
        <td>Alt+M</td></tr>
        <tr>
        <td>Pay & Print Bill</td>
        <td>Alt+P</td>
        <td>Paid Amount Typing</td>
        <td>Alt+A</td></tr>
    </table>" data-html="true" data-trigger="hover" data-original-title="" title=""></i></a></li>
    <li class="mobiletag">
    <?php $languagenames = $this->db->field_data('language');?>
<!-- for language -->
<div class="dropdown dropdown-user">

<a href="#" class="btn dropdown-toggle lang_box"  data-toggle="dropdown"><?php if($this->session->has_userdata('language')){  echo mb_strimwidth(strtoupper($this->session->userdata('language')),0,3,''); } else{
                                    echo mb_strimwidth(strtoupper($setting->language),0,3,'');
                                }?></a>
                                <ul class="dropdown-menu lang_options">
                    <?php 
                        $lii=0;
                    foreach($languagenames as $languagename ){
                        if($lii >= 2){
                                        ?>
                    <li><a href="javascript:;" onclick="addlang(this)" data-url="<?php echo base_url();?>hungry/setlangue/<?php echo $languagename->name;?>">
                        <?php echo ucfirst($languagename->name);?></a></li>
                    <?php 
                    }
                    $lii++;
                }?>
                </ul>
              </div>
    </li>
        </ul>
        <?php 
 $new_version  = file_get_contents('https://update.bdtask.com/bhojon/autoupdate/update_info');
 $myversion = current_version();
function current_version(){

        //Current Version
        $product_version = '';
        $path = FCPATH.'system/core/compat/lic.php'; 
        if (file_exists($path)) {
            
            // Open the file
            $whitefile = file_get_contents($path);

            $file = fopen($path, "r");
            $i    = 0;
            $product_version_tmp = array();
            $product_key_tmp = array();
            while (!feof($file)) {
                $line_of_text = fgets($file);

                if (strstr($line_of_text, 'product_version')  && $i==0) {
                    $product_version_tmp = explode('=', strstr($line_of_text, 'product_version'));
                    $i++;
                }                
            }
            fclose($file);

            $product_version = trim(@$product_version_tmp[1]);
            $product_version = ltrim(@$product_version, '\'');
            $product_version = rtrim(@$product_version, '\';');

            return @$product_version;
            
        } else {
            //file is not exists
            return false;
        }
        
    }

?>
        <div class="tgbar">
        
          <a href="javascript:;" class="btn" onclick="closeopenresister()" role="button"><i class="fa fa-window-close fa-lg"></i></a>
          <?php if ($new_version!=$myversion) {
		  if($versioncheck->version!=$new_version){
		  ?>
          <a href="<?php echo base_url("dashboard/autoupdate") ?>" class="updateanimate"><i class="fa fa-warning fa-warning-bg"></i><span class="f-size-weight">Update Available</span></a>
          <?php } } ?>
         <a id="fullscreen" href="#"><i class="pe-7s-expand1"></i></a> <a  href="#"><i class="fa fa-keyboard hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<table class='table table-condensed table-striped' >
        <tr>
            <th>Operations</th>
            <th>Keyboard Shortcut</th>
            <th>Operations</th>
            <th>Keyboard Shortcut</th>
        </tr>
        <tr>
        <td>New Order Tab</td>
        <td>Shift+N</td>
        <td>On Going Tab</td>
        <td>Shift+G</td>
        </tr>
        <tr>
        <td>Today Order Tab</td>
        <td>Shift+T</td>
        <td>Online Order Tab</td>
        <td>Shift+O</td>
        </tr>
        <tr>
        <td>Place Order</td>
        <td>Shift+P</td>
        <td>Quick Order</td>
        <td>Shift+Q</td>
        </tr>
        <tr>
        <td>Search Product</td>
        <td>Shift+S</td>
        <td>Select Customer</td>
        <td>Shift+C</td>
        </tr>               
        <tr>
        <td>Select Customer Type</td>
        <td>Shift+Y</td>
        <td>Edit Discount:</td>
        <td>Shift+D</td></tr>
        <tr>
        <td>Edit Service Charge</td>
        <td>Shift+R</td>
        <td>Select Waiter</td>
        <td>Shift+W</td>
        </tr>          
        <tr>
        <td>Select Table</td>
        <td>Shift+B</td>
        <td>Cooking Time</td>
        <td>Alt+K</td></tr>
        <tr>
        <td>Search Table</td>
        <td>Alt+T</td>
        <td>Go Edit</td>
        <td>Shift+E</td></tr>
        <tr>
        <td>Search Today Order</td>
        <td>Shift+X</td>
        <td>Search Online Order</td>
        <td>Shift+V</td>
        </tr>  
        <tr>
        <td>Update Search Product</td>
        <td>Alt+S</td>
        <td>Update Select Customer</td>
        <td>Alt+C</td>
        </tr>               
        <tr>
        <td>Update Select Customer Type</td>
        <td>Alt+Y</td>
        <td>Update Discount:</td>
        <td>Alt+D</td></tr>
        <tr>
        <td>Update Service Charge:</td>
        <td>Alt+R</td>
        <td>Update Select Table</td>
        <td>Alt+B</td>
        </tr>          
        
        <td>Update Submit From</td>
        <td>Alt+U</td>
        <td>Select Payment Type</td>
        <td>Alt+M</td></tr>
        <tr>
        <td>Pay & Print Bill</td>
        <td>Alt+P</td>
        <td>Paid Amount Typing</td>
        <td>Alt+A</td></tr>
    </table>" data-html="true" data-trigger="hover" data-original-title="" title=""></i></a>
    	 <?php $languagenames = $this->db->field_data('language');?>
        <div class="dropdown">
    <a class="dropdown-toggle lang_box" type="button" data-toggle="dropdown"><?php if($this->session->has_userdata('language')){  echo mb_strimwidth(strtoupper($this->session->userdata('language')),0,3,''); } else{
                                  echo mb_strimwidth(strtoupper($setting->language),0,3,'');
                                }?>
    <span class="caret"></span></a>
    <ul class="dropdown-menu lang_options">
      <?php 
                    $lii=0;
                    foreach($languagenames as $languagename ){
                        if($lii >= 2){
                                        ?>
                    <li><a href="javascript:;" onclick="addlang(this)" data-url="<?php echo base_url();?>hungry/setlangue/<?php echo $languagename->name;?>">
                        <?php echo ucfirst($languagename->name);?></a></li>
                    <?php 
                    }
                    $lii++;
                }?>
    </ul>
  </div>
    
 </div>
      </div>
      
      <!-- Tab panes -->
      <div class="tab-content tab-content-xs">
        <div class="tab-pane fade active in" id="home">
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <div class="panel">
                <input name="url" type="hidden" id="posurl" value="<?php echo base_url("ordermanage/order/getitemlist") ?>" />
                <input name="url" type="hidden" id="productdata" value="<?php echo base_url("ordermanage/order/getitemdata") ?>" />
                <input name="url" type="hidden" id="url" value="<?php echo base_url("ordermanage/order/itemlistselect") ?>" />
                <input name="url" type="hidden" id="carturl" value="<?php echo base_url("ordermanage/order/posaddtocart") ?>" />
                <input name="url" type="hidden" id="cartupdateturl" value="<?php echo base_url("ordermanage/order/poscartupdate") ?>" />
                <input name="url" type="hidden" id="addonexsurl" value="<?php echo base_url("ordermanage/order/posaddonsmenu") ?>" />
                <input name="url" type="hidden" id="removeurl" value="<?php echo base_url("ordermanage/order/removetocart") ?>" />
                <input name="updateid" type="hidden" id="updateid" value="" />
                <div class="row">
                  <div class="col-md-7">
                    <div class="row">
                      <div class="col-md-12">
                        <form class="navbar-search" method="get" action="<?php echo base_url("ordermanage/order/pos_invoice")?>" >
                          <label class="sr-only screen-reader-text" for="search"><?php echo display('search')?>:</label>
                          <div class="input-group">
                            <select id="product_name" class="form-control dont-select-me  search-field" dir="ltr" name="s">
                            </select>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2">
                        <div class="product-category">
                          <div class="listcat" onclick="getslcategory('')"><?php echo display('all')?> </div>
                          <?php $result = array_diff($categorylist, array("Select Food Category"));
                                                                foreach($result as $key=>$test){ ?>
                          <div class="listcat" onclick="getslcategory(<?php echo $key;?>)"><?php echo $test;?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-10">
                        <div style="height:100%">
                            <div class="product-grid">
                              <div class="row row-m-3" id="product_search">
                                <?php $i=0;
                                                                            foreach($itemlist as $item){
                                                                                $item=(object)$item;
                                                                                $i++;
                                                                                $this->db->select('*');
                                                                                            $this->db->from('menu_add_on');
                                                                                            $this->db->where('menu_id',$item->ProductsID);
                                                                                            $query = $this->db->get();
                                                                                            $getadons="";
                                                                                            if ($query->num_rows() > 0) {
                                                                                            $getadons = 1;
                                                                                            }
                                                                                            else{
                                                                                                $getadons =  0;
                                                                                                }
                                                                                ?>
                                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 col-p-3">
                                  <div class="panel panel-bd product-panel select_product">
                                    <div class="panel-body"> <img src="<?php echo base_url(!empty($item->small_thumb)?$item->small_thumb:'assets/img/icons/default.jpg'); ?>" class="img-responsive" alt="<?php echo $item->ProductName;?>">
                                      <input type="hidden" name="select_product_id" class="select_product_id" value="<?php echo $item->ProductsID;?>">
                                      <input type="hidden" name="select_totalvarient" class="select_totalvarient" value="<?php echo $item->totalvarient;?>">
                                      <input type="hidden" name="select_iscustomeqty" class="select_iscustomeqty" value="<?php echo $item->is_customqty;?>">
                                      <input type="hidden" name="select_product_size" class="select_product_size" value="<?php echo $item->variantid;?>">
                                      <input type="hidden" name="select_product_isgroup" class="select_product_isgroup" value="<?php echo $item->isgroup;?>">
                                      <input type="hidden" name="select_product_cat" class="select_product_cat" value="<?php echo $item->CategoryID;?>">
                                      <input type="hidden" name="select_varient_name" class="select_varient_name" value="<?php echo $item->variantName;?>">
                                      <input type="hidden" name="select_product_name" class="select_product_name" value="<?php echo $item->ProductName; if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>">
                                      <input type="hidden" name="select_product_price" class="select_product_price" value="<?php echo $item->price;?>">
                                      <input type="hidden" name="select_addons" class="select_addons" value="<?php echo $getadons;?>">
                                    </div>
                                    <div class="panel-footer"><span><?php echo $item->ProductName;?> (<?php echo $item->variantName;?>)
                                      <?php if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>
                                      </span></div>
                                  </div>
                                </div>
                                <?php } ?>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <form action="<?php echo base_url("ordermanage/order/pos_order")?>" class="form-vertical" id="onlineordersubmit" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                      <div class="row">
                        <div class="col-md-6 form-group">
                          <label for="customer_name"><?php echo display('customer_name');?><span class="color-red">*</span></label>
                          <div class="d-flex">
                            <?php $cusid=1;
                                                                    echo form_dropdown('customer_name',$customerlist,(!empty($cusid)?$cusid:null),'class="postform resizeselect form-control" id="customer_name" required') ?>
                            <button type="button" class="btn btn-primary ml-l" aria-hidden="true" data-toggle="modal" data-target="#client-info"><i class="ti-plus"></i></button>
                          </div>
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="store_id"><?php echo display('customer_type');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                          <?php $ctype=1;
                                                                echo form_dropdown('ctypeid',$curtomertype,(!empty($ctype)?$ctype:null),'class="form-control" id="ctypeid" required') ?>
                        </div>
                        <div id="nonthirdparty" class="col-md-12">
                          <div class="row">
                          
                            <div class="col-md-4 form-group">
                              <label for="store_id"><?php echo display('waiter');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              <?php $waiterkitchen=$this->session->userdata('id');
                                                                            echo form_dropdown('waiter',$waiterlist,(!empty($waiterkitchen)?$waiterkitchen:null),'class="form-control" id="waiter" required') ?>
                            </div>
                            <?php 
							if($possetting->tablemaping==1){
																		?>
                            <div class="col-md-2 form-group pl-0" id="tblsecp">
                              <label for="store_id" class="wpr_100 person"> <span class="color-red">&nbsp;&nbsp;</span></label>
                              <input name="" type="button" class="btn btn-primary  form-control width-auto" onclick="showTablemodal()" id="table_person" value="<?php echo display('person');?>">
                              <input type="hidden" id="table_member" name="table_member" class="form-control" value="" />
                            </div>
                            <?php } ?>
                            <div class="col-md-3 form-group" id="tblsec"> 
                           
                              <label for="store_id"><?php echo display('table');?> <span class="color-red">*</span></label>
                              <?php echo form_dropdown('tableid',$tablelist,(!empty($tablelist->tableid)?$tablelist->tableid:null),'class="postform resizeselect form-control" id="tableid" required onchange="checktable()"')?>
                              <input type="hidden" id="table_member_multi" name="table_member_multi" class="form-control" value="0" />
                              <input type="hidden" id="table_member_multi_person" name="table_member_multi_person" class="form-control" value="0" />
                              
                            </div>
                            <?php 
																	   ?>
                            <div class="col-md-3 form-group" id="cookingtime">
                              <label for="Cooked Time"><?php echo display('cookedtime');?></label>
                              <input name="cookedtime" type="text" class="form-control timepicker3" id="cookedtime" placeholder="00:00:00" autocomplete="off" />
                            </div>
                           
                          </div>
                        </div>
                        <div id="thirdparty" style="display: none;">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="store_id"><?php echo display('del_company');?> <span class="color-red">*</span>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              <?php echo form_dropdown('delivercom',$thirdpartylist,(!empty($thirdpartylist->companyId)?$thirdpartylist->companyId:null),'class="form-control wpr_95" id="delivercom" required disabled="disabled"') ?> </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="third_id"><?php echo display('thirdparty_orderid');?>&nbsp;&nbsp;&nbsp;&nbsp;</label>
                              <input  name="thirdinvoiceid" type="text" class="form-control" id="thirdinvoiceid">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <input class="form-control" type="hidden" id="order_date" name="order_date" required value="<?php echo date('d-m-Y')?>" />
                          <input class="form-control" type="hidden" id="bill_info" name="bill_info" required value="1"  />
                          <input type="hidden" id="card_type" name="card_type" value="4" />
                          <input type="hidden" id="isonline" name="isonline" value="0" />
                          <input type="hidden" id="assigncard_terminal" name="assigncard_terminal" value="" />
                          <input type="hidden" id="assignbank" name="assignbank" value="" />
                          <input type="hidden" id="assignlastdigit" name="assignlastdigit" value="" />
                          <input type="hidden" id="product_value" name="">
                        </div>
                      </div>
                      <div class="productlist">
                      <div class="product-list pdlist">
                        <div class="table-responsive" id="addfoodlist">
                          <?php $grtotal=0;
                                                                    $totalitem=0;
                                                                     $calvat=0;
                                                                     $discount=0;
                                                                     $itemtotal=0;
																	  $pdiscount=0;
																	  $multiplletax = array();
                                                                      $this->load->model('ordermanage/order_model', 'ordermodel');
                        if($cart = $this->cart->contents()){?>
                          <table class="table table-bordered wpr_100" border="1" id="addinvoice">
                            <thead>
                              <tr>
                                <th><?php echo display('item')?></th>
                                <th><?php echo display('varient_name')?></th>
                                <th><?php echo display('price');?></th>
                                <th><?php echo display('quantity');?></th>
                                <th><?php echo display('total');?></th>
                                <th><?php echo display('action');?></th>
                              </tr>
                            </thead>
                            <tbody class="itemNumber">
                              <?php $i=0; 
								  $totalamount=0;
								  $subtotal=0;
								  $ptdiscount=0;
								  $pvat=0;																		  
                                                                        foreach ($cart as $item){
																			$iteminfo=$this->ordermodel->getiteminfo($item['pid']);
                                                                            $itemprice= $item['price']*$item['qty'];
																			$mypdiscountprice =0;
																			if(!empty($taxinfos)){
																			$tx=0;
																			if($iteminfo->OffersRate>0){
																				$mypdiscountprice=$iteminfo->OffersRate*$itemprice/100;
																			  }
																			  $itemvalprice =  ($itemprice-$mypdiscountprice);
																			foreach ($taxinfos as $taxinfo) 
																			{
																			  $fildname='tax'.$tx;
																			  if(!empty($iteminfo->$fildname)){
																			  $vatcalc=$itemvalprice*$iteminfo->$fildname/100;
																			   $multiplletax[$fildname] = $multiplletax[$fildname]+$vatcalc;
																			  }
																			  else{
																				$vatcalc=$itemvalprice*$taxinfo['default_value']/100; 
																				 $multiplletax[$fildname] = $multiplletax[$fildname]+$vatcalc; 
										
																			  }
										
																			$pvat=$pvat+$vatcalc;
																			$vatcalc =0; 
																			$tx++;  
																			}
																		  	}
																			else{
																			  $vatcalc=$itemprice*$iteminfo->productvat/100;
																			  $pvat=$pvat+$vatcalc;
																			  }
																			
																			if($iteminfo->OffersRate>0){
																				$mypdiscount=$iteminfo->OffersRate*$itemprice/100;
																				$ptdiscount=$ptdiscount+($iteminfo->OffersRate*$itemprice/100);
																				}
																			else{
																				$mypdiscount=0;
																				$pdiscount=$pdiscount+0;
																				}
                                                                            if(!empty($item['addonsid'])){
                                                                                $nittotal=$item['addontpr'];
                                                                                $itemprice=$itemprice+$item['addontpr'];
                                                                                }
                                                                            else{
                                                                                $nittotal=0;
                                                                                $itemprice=$itemprice;
                                                                                }
                                                                             $totalamount=$totalamount+$nittotal;
                                                                             $subtotal=$subtotal+$nittotal+$item['price']*$item['qty'];
                                                                        $i++;
                                                                        ?>
                              <tr id="<?php echo $i;?>">
                                <th id="product_name_MFU4E"><?php echo  $item['name'];
                                                                                if(!empty($item['addonsid'])){
                                                                                echo "<br>";
                                                                                echo $item['addonname'];
																				 if(!empty($taxinfos)){
                                        
                                         $addonsarray = explode(',',$item['addonsid']);
                                         $addonsqtyarray = explode(',',$item['addonsqty']);
                                         $getaddonsdatas = $this->db->select('*')->from('add_ons')->where_in('add_on_id',$addonsarray)->get()->result_array();
                                         $addn=0;
                                        foreach ($getaddonsdatas as $getaddonsdata) {
                                          $tax=0;
                                        
                                          foreach ($taxinfos as $taxainfo) 
                                          {

                                            $fildaname='tax'.$tax;

                                        if(!empty($getaddonsdata[$fildaname])){
                                            
                                        $avatcalc=($getaddonsdata['price']*$addonsqtyarray[$addn])*$getaddonsdata[$fildaname]/100;
                                        $multiplletax[$fildaname] = $multiplletax[$fildaname]+$avatcalc; 

                                        }
                                        else{
                                          $avatcalc=($getaddonsdata['price']*$addonsqtyarray[$addn])*$taxainfo['default_value']/100; 
                                          $multiplletax[$fildaname] = $multiplletax[$fildaname]+$avatcalc;  
                                        }

                                      $pvat=$pvat+$avatcalc;

                                            $tax++;
                                          }
                                          $addn++;
                                        }
                                        }
                                 }
                                ?><a class="serach pl-15" onclick="itemnote('<?php echo $item['rowid']?>','<?php echo $item['itemnote']?>',<?php echo $item['qty'];?>,2)" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a></th>
                                <td><?php echo $item['size'];?></td>
                                <td width=""><?php if($currency->position==1){echo $currency->curr_icon;}?>
                                  <?php echo $item['price'];?>
                                  <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                <td scope="row"><a class="btn btn-info btn-sm btnleftalign" onclick="posupdatecart('<?php echo $item['rowid']?>',<?php echo $item['pid'];?>,<?php echo $item['sizeid']?>,<?php echo $item['qty'];?>,'add')"><i class="fa fa-plus" aria-hidden="true"></i></a> <span id="productionsetting-<?php echo $item['pid'].'-'.$item['sizeid'] ?>"> <?php echo $item['qty'];?> </span> <a class="btn btn-danger btn-sm btnrightalign" onclick="posupdatecart('<?php echo $item['rowid']?>',<?php echo $item['pid'];?>,<?php echo $item['sizeid']?>,<?php echo $item['qty'];?>,'del')"><i class="fa fa-minus" aria-hidden="true"></i></a></td>
                                <td width=""><?php if($currency->position==1){echo $currency->curr_icon;}?>
                                  <?php echo $itemprice-$mypdiscount;?>
                                  <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                <td width:"80"=""><a class="btn btn-danger btn-sm btnrightalign" onclick="removecart('<?php echo $item['rowid'];?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                              </tr>
                              <?php } 
                                                                        $itemtotal=$subtotal;
                                                        /*check $taxsetting info*/
														  if(empty($taxinfos)){
														  if($settinginfo->vat>0 ){
															$calvat=($itemtotal-$ptdiscount)*$settinginfo->vat/100;
														  }
														  else{
															$calvat=$pvat;
															}
														  }
														  else{
															$calvat=$pvat;
														  }
                                                            $grtotal=$itemtotal;
                                                                $totalitem=$i;
                                                                        ?>
                            </tbody>
                          </table>
                          <?php $pdiscount=$ptdiscount;}
						
							 $multiplletaxvalue=htmlentities(serialize($multiplletax));								 										
							?>
                          <input name="subtotal" id="subtotal" type="hidden" value="<?php echo $subtotal;?>" />
                         
                          <input name="multiplletaxvalue" id="multiplletaxvalue" type="hidden" value="<?php echo $multiplletaxvalue;?>" />
                          <?php 
						  if(!empty($this->cart->contents())){
						 	if($settinginfo->service_chargeType==1){
							$totalsercharge=$subtotal-$pdiscount;
							  $servicetotal=$settinginfo->servicecharge*$totalsercharge/100;
							 }
							 else{
								 $servicetotal=$settinginfo->servicecharge;
								 }
						  $servicecharge= $settinginfo->servicecharge;
							}
						else{
							$servicetotal=0;
							$servicecharge=0;
							}
						  ?>
                        </div>
                      </div>
                      </div>
                      <div class="fixedclasspos">
                        <div class="row d-flex flex-wrap align-items-center">
                          <div class="col-sm-6 leftview">
                            <input name="distype" id="distype" type="hidden" value="<?php echo $settinginfo->discount_type;?>" />
                            <input name="sdtype" id="sdtype" type="hidden" value="<?php echo $settinginfo->service_chargeType;?>" />
                            <input type="hidden" id="orginattotal" value="<?php echo $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);?>" name="orginattotal">
                            <input type="hidden" id="invoice_discount" class="form-control text-right" name="invoice_discount" value="<?php echo $discount+$pdiscount?>">
                            <table class="table table-bordered footersumtotal">
                              <tr>
                                <td><div class="row m-0">
                                    <label for="date" class="col-sm-8 mb-0"><?php echo display('vat_tax1')?>: </label>
                                    <label class="col-sm-4 mb-0">
                                      <input type="hidden" id="vat" name="vat" value="<?php echo $calvat;?>"/>
                                    </label>
                                    <strong>
                                    <?php if($currency->position==1){echo $currency->curr_icon;}?>
                                    <span id="calvat"> <?php echo $calvat;?></span>
                                    <?php if($currency->position==2){echo $currency->curr_icon;}?>
                                    </strong>
                                    </label>
                                  </div></td>
                                <td rowspan="2"><label for="date" class="mb-0 col-sm-6"><?php echo display('grand_total')?>:</label>
                                  <label class="col-sm-6 p-0 mb-0">
                                    <input type="hidden" id="orggrandTotal" value="<?php echo $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);?>" name="orggrandTotal">
                                    <input name="grandtotal" type="hidden" value="<?php echo $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);?>" id="grandtotal" />
                                    <span class="badge badge-primary grandbg font-26"><strong>
                                    <?php if($currency->position==1){echo $currency->curr_icon;}?>
                                    <span id="caltotal"><?php echo $calvat+$itemtotal+$servicetotal-($discount+$pdiscount);?></span>
                                    <?php if($currency->position==2){echo $currency->curr_icon;}?>
                                </strong></span></label></td>
                              </tr>
                              <tr>
                                <td><label for="date" class="col-sm-8 mb-0"><?php echo display('service_chrg')?>
                                    <?php if($settinginfo->service_chargeType==0){ echo "(".$currency->curr_icon.")";}else{ echo "(%)";}?>
                                    :</label>
                                  <div class="col-sm-4 p-0">
                                    <input type="text" id="service_charge" onkeyup="calculatetotal();"  class="form-control text-right mb-5" value="<?php echo $servicecharge;?>" name="service_charge" placeholder ="0.00"/>
                                  </div></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-sm-6 text-right"> <a class="btn btn-primary cusbtn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-calculator" aria-hidden="true"></i></a> <a href="<?php echo base_url("ordermanage/order/posclear") ?>" type="button" class="btn btn-danger cusbtn"><?php echo display('cancel')?></a>
                            <input type="hidden" id="getitemp" name="getitemp" value="<?php echo $totalitem-$discount;?>" />
                            <input type="button" id="add_payment2" class="btn btn-primary btn-large cusbtn" onclick="quickorder()" name="add-payment" value="<?php echo display('quickorder') ?>">
                            <input type="button" id="add_payment" class="btn btn-success btn-large cusbtn" onclick="placeorder()" name="add-payment" value="<?php echo display('placeorder') ?>">
                            
                            
                            <input type="hidden" id="production_setting" value="<?php echo $possetting->productionsetting; ?>" >
                            <input type="hidden" id="production_url" value="<?php echo base_url("production/production/ingredientcheck") ?>">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile">
          <div class="row m-0" id="onprocesslist"> </div>
        </div>
        <div class="tab-pane fade" id="kitchen">
          <div class="row" id="kitchenstatus"> </div>
        </div>
        <?php if($qrapp==1){?>
        <div class="tab-pane fade" id="qrorder"> </div>
        <?php } ?>
        <div class="tab-pane fade" id="settings"> </div>
        <div class="tab-pane fade" id="messages"> </div>
      </div>
    </div>
  </div>
</div>
<audio id="myAudio" src="<?php echo base_url()?><?php echo $soundsetting->nofitysound;?>" preload="auto" class="display-none"></audio>
<div id="payprint2"> </div>
<div class="modal fade modal-warning" id="posprint" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" id="kotenpr"> </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<div id="orderdetailsp" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong>
     
        </strong> </div>
      <div class="modal-body orddetailspop"> </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>
<?php 
$scan1 = scandir('application/modules/');
		$getdisc="";
		foreach($scan1 as $file) {
		   if($file=="loyalty"){
			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
			   $getdisc=1;
			   }
			   }
		} 
	//$this->load->view('include/pos_script');
?>
<script src="<?php echo base_url('ordermanage/order/possettingjs') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('ordermanage/order/quickorderjs') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/possetting.js'); ?>" type="text/javascript"></script>
