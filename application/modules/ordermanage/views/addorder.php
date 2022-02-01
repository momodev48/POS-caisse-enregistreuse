<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('unit_update');?></strong>
            </div>
            <div class="modal-body addonsinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
<div id="items" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo "Item Information";?></strong>
            </div>
            <div class="modal-body iteminfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
 <form action="<?php echo base_url("ordermanage/order/insert_customerord") ?>" class="form-vertical" id="validate" method="post" accept-charset="utf-8">
            <div class="modal fade modal-warning" id="client-info" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title"><?php echo display('add_customer')?></h3>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label"><?php echo display('name')?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control simple-control" name ="customer_name" id="name" type="text" placeholder="<?php echo display('customer_name')?>"  required="">
                                </div>
                            </div>
       
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label"><?php echo display('email')?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name ="email" id="email" type="email" placeholder="<?php echo display('email')?>"  required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile')?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="Customer Mobile"  required="" min="0">
                                </div>
                            </div>
       
                            <div class="form-group row">
                                <label for="address " class="col-sm-3 col-form-label"><?php echo display('address')?></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="address" id="address " rows="3" placeholder="Customer Address"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="address " class="col-sm-3 col-form-label"><?php echo display('fav_addesrr')?></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="favaddress" id="favaddress " rows="3" placeholder="Customer Address"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close')?> </button>
                            <button type="submit" class="btn btn-success"><?php echo display('submit')?> </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>
 <div class="modal fade modal-warning" id="payment-info" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title"><?php echo display('payment')?></h3>
                        </div>
                        
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label"><?php echo display('name')?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control simple-control" name ="customer_name" id="name" type="text" placeholder="<?php echo display('customer_name')?>"  required="">
                                </div>
                            </div>
       
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label"><?php echo display('email')?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name ="email" id="email" type="email" placeholder="<?php echo display('email')?>"  required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('mobile')?> <i class="text-danger">*</i></label>
                                <div class="col-sm-6">
                                    <input class="form-control" name ="mobile" id="mobile" type="number" placeholder="<?php echo display('mobile')?>"  required="" min="0">
                                </div>
                            </div>
       
                            <div class="form-group row">
                                <label for="address " class="col-sm-3 col-form-label"><?php echo display('address')?></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('address')?>"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="address " class="col-sm-3 col-form-label"><?php echo display('fav_addesrr')?></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="favaddress" id="favaddress " rows="3" placeholder="<?php echo display('fav_addesrr')?>"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo display('close')?> </button>
                            <button type="submit" class="btn btn-success"><?php echo display('submit')?> </button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
<div class="row">
        <div class="col-sm-12 col-md-12">
         <?php echo form_open_multipart('ordermanage/order/placeoreder',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
            <div class="panel panel-bd">
               <div class="panel-heading">
                <div class="panel-title">
                 <div class="btn-group pull-right"> 
                <?php echo "Choose Category"; ?>
                 <?php 
						if(empty($categorylist)){$categorylist = array('' => '--Select--');}
						echo form_dropdown('catid',$categorylist,(!empty($categorylist->CategoryID)?$categorylist->CategoryID:null),'class="form-control" id="catid"  onchange="itemlist()"') ?>
                    </div>
                    <h4><?php echo "Add Order" ?></h4>
                </div>
            </div>
                <div class="panel-body">
                   
                    <input name="url" type="hidden" id="url" value="<?php echo base_url("ordermanage/order/itemlistselect") ?>" />
                    <input name="url" type="hidden" id="carturl" value="<?php echo base_url("ordermanage/order/addtocart") ?>" />
                    <input name="url" type="hidden" id="cartupdateturl" value="<?php echo base_url("ordermanage/order/cartupdate") ?>" />
                    <input name="url" type="hidden" id="addonsurl" value="<?php echo base_url("ordermanage/order/addonsmenu") ?>" />
                    <input name="updateid" type="hidden" id="updateid" value="" />
                    <input class="form-control" type="hidden" id="bill_info" name="bill_info" required value="1" />
					<div class="row">
                             <div class="col-sm-6" id="findfood">
                                
                            </div>
                             <div class="col-sm-12" id="cartlist">
                                <?php 
								$calvat=0;
								$discount=0;
								$itemtotal=0;
								 $pvat=0;
								  $this->load->model('ordermanage/order_model',	'ordermodel');
								if ($cart = $this->cart->contents()){?>
                               <div class="table-wrapper-scroll-y">
								<table class="table table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center">Item </th>
                                            <th class="text-center">Size</th>
                                            <th class="text-center wp_100">Unit Price</th> 
                                            <th class="text-center wp_70">Qty</th> 
                                            <th class="text-center">Total Price</th>  
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; 
								      $totalamount=0;
									  $subtotal=0;
									  $pvat=0;
									 	
									foreach ($cart as $item){
										$iteminfo=$this->ordermodel->getiteminfo($item['pid']);
										$itemprice= $item['price']*$item['qty'];
										$vatcalc=$itemprice*$iteminfo->productvat/100;
										$pvat=$pvat+$vatcalc;
										$discount=0;
										if(!empty($item['addonsid'])){
											$nittotal=$item['addontpr'];
											$itemprice=$itemprice+$item['addontpr'];
											}
										else{
											$nittotal=0;
											$itemprice=$itemprice;
											}
										 $totalamount=$totalamount+$nittotal;
										 $subtotal=$subtotal+$item['price']*$item['qty'];
									$i++;
									?>
                                    <tr>
                                        <td>
                                     	<?php echo $item['name'];
										if(!empty($item['addonsid'])){
											echo "<br>";
											echo $item['addonname'].' -Qty:'.$item['addonsqty'];
											}
										?>
                                        </td>
                                        <td>
                                        <?php echo $item['size'];?>
                                        </td>
                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item['price'];?> <?php if($currency->position==2){echo $currency->curr_icon;}?> 
                                        <?php 
										if(!empty($item['addonsid'])){
											echo "<br>";
											if($currency->position==1){echo $currency->curr_icon;}
											echo $item['addontpr'];
											if($currency->position==2){echo $currency->curr_icon;}
											}
										?>
                                        </td>
                                        <td class="text-center">
                                        <?php echo $item['qty'];
										if(!empty($item['addonsid'])){
											echo "<br>";
											echo $item['addonsqty'];
											}
										?>
                                        </td>
                                         <td class="text-right"><a class="btn btn-info btn-sm btnleftalign" onclick="updatecart('<?php echo $item['rowid']?>',<?php echo $item['qty'];?>,'add')"><i class="fa fa-plus" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                        <strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong>&nbsp;&nbsp;
                                        <a class="btn btn-danger btn-sm btnrightalign" onclick="updatecart('<?php echo $item['rowid']?>',<?php echo $item['qty'];?>,'del')"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                        </td>
                                     </tr>
                                    <?php 
									} 
									$itemtotal=$totalamount+$subtotal;
									if($settinginfo->vat>0){
										$calvat=$itemtotal*$settinginfo->vat/100;
									}
									else{
										$calvat=$pvat;
										}
									?>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong>Subtotal</strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemtotal;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
                                </div>
                            <?php }  ?>
                            </div>
                        </div>
                    <div class="row">
                             <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="customertype" class="col-sm-4 col-form-label"><?php echo "Customer Type"; ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                      <?php $ctyid=1;
						if(empty($curtomertype)){$curtomertype = array('' => '--Select--');}
						echo form_dropdown('ctypeid',$curtomertype,(!empty($ctyid)?$ctyid:null),'class="form-control" id="ctypeid" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="waiter" class="col-sm-4 col-form-label"><?php echo "Select Table"; ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                      <?php 
						if(empty($tablelist)){$tablelist = array('' => '--Select--');}
						echo form_dropdown('tableid',$tablelist,(!empty($tablelist->tableid)?$tablelist->tableid:null),'class="form-control" id="tableid" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('customer_name')?> <span class="color-red">*</span></label>
                               <div class="col-sm-5">
                                <?php  $cusid=1;
								 echo form_dropdown('customer_name',$customerlist,(!empty($cusid)?$cusid:null),'class="postform resizeselect form-control" id="customer_name" required') ?>
                           	   </div>
                               <div class="col-sm-3">
                               <a href="#" class="client-add-btn position-relative" aria-hidden="true" data-toggle="modal" data-target="#client-info"><i class="ti-plus m-r-2"></i>New Customer </a>
                               </div>
                            </div>
                                
                            </div>
                             <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="waiter" class="col-sm-4 col-form-label"><?php echo "Select Waiter"; ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                      <?php 
						if(empty($waiterlist)){$waiterlist = array('' => '--Select--');}
						echo form_dropdown('waiter',$waiterlist,(!empty($waiterlist->emp_his_id)?$waiterlist->emp_his_id:null),'class="form-control" id="waiter" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label">Customer Note</label>
                                    <div class="col-sm-8">
                                 <input type="text" class="form-control" name="customernote" value="" id="customernote" tabindex="2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label">Order Date<i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                 <input type="text" class="form-control datepicker" name="order_date" value="<?php echo date('d-m-Y');?>" id="date" required="" tabindex="2">
                                    </div>
                                </div>
                            </div>
                            <div  class="payment_method display-none">
                            <div class="col-sm-12">
                            <fieldset class="border p-2">
                               <legend class="w-auto">Payment Information</legend>
                            </fieldset>
                            </div>
                            		<div class="col-sm-7">
                                        <div class="form-group row">
                                            <label for="customertype" class="col-sm-4 col-form-label"><?php echo "Card Type:"; ?> <i class="text-danger">*</i>
                                            </label>
                                            <div class="col-sm-6">
                                             <?php echo form_dropdown('card_type',$paymentmethod,(!empty($paymentmethod->CategoryID)?$paymentmethod->CategoryID:null),'class="postform resizeselect form-control" id="card_type"') ?>
                                            </div>
                                        </div>
                                		<div class="form-group row" id="cholder display-none">
                                   			 <label for="date" class="col-sm-4 col-form-label">Card Holder Name</label>
                                    <div class="col-sm-6">
                                 		<input type="text" class="form-control" name="card_holdername" value="" id="card_holdername" tabindex="2">
                                    </div>
                                </div>
                            		</div>
                                    <div class="col-sm-5 display-none" id="cnumber">
                                    <div class="form-group row">
                                   			 <label for="date" class="col-sm-4 col-form-label">Card No.</label>
                                    <div class="col-sm-8">
                                 		<input type="text" class="form-control" name="card_no" value="" id="card_no" tabindex="2">
                                    </div>
                                </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row fixedclass">
                         	<div class="bottomarea">
                                 <div class="row">
                                 	<div class="col-sm-5">
                                    <div class="col-sm-12">
                                        <input type="submit" id="add_payment" class="btn btn-success btn-large cusbtn" name="add-payment" value="Place Order">
                                        <button type="button" class="btn btn-purple payment_button cusbtn">Payment</button>
                                        <a href="<?php echo base_url("ordermanage/order/cartclear") ?>" type="button" class="btn btn-danger cusbtn">Cancel</a>
                                         
                                    </div>
                                    </div>
                                    <div class="col-sm-7">
                                    	<div class="form-group row mb-0">
                                            <div class="col-sm-3"> Vat/Tax:<strong><input type="hidden" name="vat" value="<?php echo $calvat;?>"/><?php if($currency->position==1){echo $currency->curr_icon;}?><span id="calvat"> <?php echo $calvat;?></span><?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></div> 
                                            <div class="col-sm-5"> <label for="scharge" class="col-sm-5 col-form-label">Service Charge</label><div class="col-sm-7"> <input type="text" id="service_charge" 
                                            onkeyup="calculatetotal();"  class="form-control text-right mb-5" name="service_charge" placeholder ="0.00" /></div></div>
                                            <div class="col-sm-4 grandtxt">&nbsp;</div>
                                        </div> 
                                        <div class="form-group row mb-0">
                                            <div class="col-sm-5"> <label for="discount" class="col-sm-3 col-form-label">Discount:</label><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <div class="col-sm-4"><input type="text" id="invoice_discount" class="form-control text-right" name="invoice_discount" placeholder="0.00" onkeyup="calculatetotal();" onchange="calculatetotal();" value="<?php if($discount>0){echo $discount;}else{ echo "";}?>"></div><?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></div> 
                                            <div class="col-sm-4 grandtxt"> Grand Total:<input type="hidden" id="orggrandTotal" value="<?php echo $calvat+$itemtotal-$discount;?>" name="orggrandTotal"><input name="grandtotal" type="hidden" value="<?php echo $calvat+$itemtotal-$discount;?>" id="grandtotal" /><span class="grandbg"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <span id="caltotal"><?php echo $calvat+$itemtotal-$discount;?></span><?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></span></div>
                                        	 <div class="col-sm-2 grandtxt">&nbsp;</div>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                </div> 
            </div>
             </form>
        </div>
    </div>
  <script src="<?php echo base_url('application/modules/ordermanage/assets/js/cashcounter.js'); ?>" type="text/javascript"></script>
   