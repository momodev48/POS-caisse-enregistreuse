<section class="checkout_area sect_pad">
        <div class="container">
        <?php if($paymentinfo->Islive==1){?>
        <form id="payment_gw" name="payment_gw" method="POST" action="https://www.2checkout.com/checkout/purchase">
        <?php }
		else{
		?>
        <form id="payment_gw" name="payment_gw" method="POST" action="https://sandbox.2checkout.com/checkout/purchase">
        <?php } ?>
        <input type='hidden' name='sid' value='<?php echo $paymentinfo->marchantid;?>' />
<input type='hidden' name='mode' value='2CO' />
<input type='hidden' name='li_0_type' value='product' />
<input type='hidden' name='li_0_name' value='<?php echo $orderinfo->order_id;?>' />
<input type='hidden' name='x_receipt_link_url' value='<?php echo base_url();?>hungry/successful2/<?php echo $page;?>' /> 
<input type='hidden' name='li_0_price' value='<?php echo $orderinfo->totalamount;?>' />
<input type='hidden' name='card_holder_name' value='<?php echo $customerinfo->customer_name;?>' />
<input type='hidden' name='street_address' value='<?php echo $customerinfo->customer_address;?>' />
<input type='hidden' name='street_address2' value='<?php echo $customerinfo->customer_address;?>' />
<input type='hidden' name='city' value='NA' />
<input type='hidden' name='state' value='NA' />
<input type='hidden' name='zip' value='NA' />
<input type='hidden' name='country' value='NA' />
<input type='hidden' name='email' value='<?php echo $customerinfo->customer_email;?>' />
<input type='hidden' name='phone' value='<?php echo $customerinfo->customer_phone;?>' />
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
	                <div id="printableArea">
	                    <div class="panel-body">
	                        <div class="table-responsive m-b-20">
	                            <table class="table table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center">Item </th>
                                            <th class="text-center">Size</th>
                                            <th class="text-center checkout_w_2" >Unit Price</th> 
                                            <th class="text-center checkout_w_2">Qty</th> 
                                            <th class="text-center">Total Price</th> 
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; 
								  $totalamount=0;
									  $subtotal=0;
									  $total=$orderinfo->totalamount;
									foreach ($iteminfo as $item){
										$i++;
										$itemprice= $item->price*$item->menuqty;
										$discount=0;
										$adonsprice=0;
										if(!empty($item->add_on_id)){
											$addons=explode(",",$item->add_on_id);
											$addonsqty=explode(",",$item->addonsqty);
											$x=0;
											foreach($addons as $addonsid){
													$adonsinfo=$this->hungry_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
													$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$x];
													$x++;
												}
											$nittotal=$adonsprice;
											$itemprice=$itemprice;
											}
										else{
											$nittotal=0;
											$text='';
											}
									 	 $totalamount=$totalamount+$nittotal;
										 $subtotal=$subtotal+$item->price*$item->menuqty;
									?>
                                    <tr>
                                        <td>
                                     	<?php echo $item->ProductName;?>
                                        </td>
                                        <td>
                                        <?php echo $item->variantName;?>
                                        </td>
                                        <td class="text-right"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php echo $item->price;?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </td>
                                        <td class="text-right"><?php echo $item->menuqty;?></td>
                                        <td class="text-right"><strong><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php echo $itemprice;?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </strong></td>
                                     </tr>
                                    <?php 
									if(!empty($item->add_on_id)){
										$y=0;
											foreach($addons as $addonsid){
													$adonsinfo=$this->hungry_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
													$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
                                                    <tr>
                                                        <td colspan="2">
                                                        <?php echo $adonsinfo->add_on_name;?>
                                                        </td>
                                                        <td class="text-right"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php echo $adonsinfo->price;?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </td>
                                                        <td class="text-right"><?php echo $addonsqty[$y];?></td>
                                                        <td class="text-right"><strong><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php echo $adonsinfo->price*$addonsqty[$y];?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </strong></td>
                                                     </tr>
									<?php $y++;
												}
										 }
									}
									 $itemtotal=$totalamount+$subtotal;
									 $calvat=$itemtotal*15/100;
									 ?>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong>Subtotal</strong></td>
                                        <td class="text-right"><strong><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php echo $itemtotal;?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong>Discount</strong></td>
                                        <td class="text-right"><strong><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?>  <?php $discount=0; if(empty($mybill)){ echo $discount;} else{echo $discount=$mybill->discount;} ?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong>Service Charge</strong></td>
                                        <td class="text-right"><strong><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php $servicecharge=0; if(empty($mybill)){ echo $servicecharge;} else{echo $servicecharge=$mybill->service_charge;} ?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong>Vat (15%)</strong></td>
                                        <td class="text-right"><strong><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php echo $calvat; ?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong>Grand Total</strong></td>
                                        <td class="text-right"><strong><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?> <?php echo $calvat+$itemtotal+$servicecharge-$discount;?> <?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> </strong></td>
                                    </tr>
                                     <tr>
                                    	<td class="text-right" colspan="5"><input name='pay' class="btn btn-success btn-large cusbtn" type='submit' value='Checkout' /></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
	                        </div>
	                    </div>
	                </div>

                     
                </div>
            </div>
        </div>


</form>
</div>
</section>
<script src="https://www.2checkout.com/static/checkout/javascript/direct.min.js"></script>    
<script> window.onload = function(){ document.forms['payment_gw'].submit() }</script>
        
