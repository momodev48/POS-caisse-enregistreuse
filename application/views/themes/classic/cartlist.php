<div class="col-lg-9">
                    <div class="cart_heading">
                        <div class="shopping-cart">
                            <h5 class="cart-page-title">Shopping Cart</h5>
                            <?php $totalqty=0;
if(!empty($this->cart->contents())){ $totalqty= count($this->cart->contents());} ;?>
					<?php 
					$calvat=0;
					$discount=0;
					$itemtotal=0;
					$pvat=0;
					$totalamount=0;
					$subtotal=0;
					$multiplletax = array();
					if ($cart = $this->cart->contents()){
						 
								      $totalamount=0;
									  $subtotal=0;
									  $pvat=0;
									$i=0; 
						foreach ($cart as $item){
										$itemprice= $item['price']*$item['qty'];
										$iteminfo=$this->hungry_model->getiteminfo($item['pid']);
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
											$discal=$itemprice*$iteminfo->OffersRate/100;
											$discount=$discal+$discount;
											}
										else{
											$discal=0;
											$discount=$discount;
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
										 $subtotal=$subtotal-$discal+$item['price']*$item['qty'];
									$i++;
									?>
                            <div class="product">
                                <div class="product-image">
                                    <img src="<?php echo base_url(!empty($iteminfo->small_thumb)?$iteminfo->small_thumb:'assets/img/no-image.png'); ?>" alt="">
                                </div>
                                <div class="product-details">
                                    <h5 class="product-title"><?php echo $item['name'];?></h5>
                                    <?php if(!empty($item['addonsid'])){?><p class="product-description"><?php echo $item['addonname'].' -Qty:'.$item['addonsqty'];?></p>
									<?php if(!empty($taxinfos)){
                                        
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
                                        } } ?>
                                    <p class="product-description"><?php echo $item['variantName'];?></p>
                                    <div class="cart_counter mt-2">
                                        <button onclick="updatecart('<?php echo $item['rowid']?>',<?php echo $item['qty'];?>,'del')" class="reduced items-count" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="number" name="qty" id="sst3" value="<?php echo $item['qty'];?>" min="1" title="Quantity:" class="input-text qty">
                                        <button onclick="updatecart('<?php echo $item['rowid']?>',<?php echo $item['qty'];?>,'add')" class="increase items-count" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <a class="serach cart_padding_15px" onclick="itemnote('<?php echo $item['rowid']?>','<?php echo $item['itemnote']?>')" title="<?php echo display('foodnote') ?>">
                                        <i class="fa fa-sticky-note" aria-hidden="true"></i>
                                    </a>
                                    </div>

                                </div>
                                <div class="product-line-price"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $item['price'];?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}
								if(!empty($item['addonsid'])){
											echo "<br>";
											if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}
											echo $item['addontpr'];
											if($this->storecurrency->position=2){echo $this->storecurrency->curr_icon;}
											}
										?></div>
                                <div class="product-removal">
                                    <button class="remove-product" onclick="removetocart('<?php echo $item['rowid']?>')">
                                        <i class="ti-close"></i>
                                    </button>
                                </div>
                            </div>
							<?php } } ?>

                            <div class="cart_btn_area d-flex justify-content-between align-items-center">
                                <a href="<?php echo base_url();?>menu" class="btn-dark mt-0">Continue Shopping</a>
                                <!--<a href="#" class="btn-dark mt-0">Update Cart</a>-->
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                <div class="shipping_part shipping_custom mt-5">
                                    <h5 class="shipping_custom_heading"><?php echo display('shipping_method')?></h5>
                                    <div class="radios shipping_custom_box" id="payment">
                                     <?php foreach($shippinginfo as $shipment){?>
                                        <div class="radio">
                                            <input type="radio" name="payment_method" id="payment_method_cre<?php echo $shipment->ship_id;?>" data-parent="#payment" data-target="#description_cre" value="<?php echo $shipment->shippingrate;?>" onchange="getcheckbox('<?php echo $shipment->shippingrate;?>','<?php echo $shipment->shipping_method;?>');">
                                            <label for="payment_method_cre<?php echo $shipment->ship_id;?>" class="shipping"> 
                                                <span class="checker"></span>
                                                <?php echo $shipment->shipping_method;?> - <?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $shipment->shippingrate;?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div>                                    
                                </div>
                                </div>
                                <div class="col-sm-7">
                                <div class="shipping_part shipping_custom mt-5">
                                <h5 class="shipping_custom_heading">Shipping Date & Time</h5>
                                	<div class="row shipping_box">
                            <div class="col-sm-6">
                            <label class="mb-2">Order Date</label>
                            <input type="text" name="orderdate" id="orderdate" value="<?php echo date('Y-n-j');?>" class="datepickerreserve shipping_custom_input">
                            </div>
                            <div class="col-sm-6">
                            <label class="mb-2">Order Time</label>
                            <input type="text" name="ordertime" id="reservation_time" class="shipping_custom_input" value="<?php echo date('H:i');?>">
                            </div>
                            </div>
                            	</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
<div class="col-lg-3">
<div class="coupon">
                        <h5 class="text-center mb-4">Coupon Code</h5>
                        <div class="">
                             <?php echo form_open('checkcoupon','method="post"')?>
                            <input type="text" class="form-control" id="couponcode" name="couponcode" placeholder="Enter your coupon code.." required>
                            <input name="coupon" class="btn simple_btn mt-2" type="submit" value="Apply" />
                            </form>
                        </div>
                    </div>
                <?php if(!empty($this->cart->contents())){
					$itemtotal=$totalamount+$subtotal;
									/*check $taxsetting info*/
					  if(empty($taxinfos)){
					  if($this->settinginfo->vat>0 ){
						$calvat=$itemtotal*$this->settinginfo->vat/100;
					  }
					  else{
						$calvat=$pvat;
						}
					  }
					  else{
						$calvat=$pvat;
					  }
					  $multiplletaxvalue=htmlentities(serialize($multiplletax));
					?>
                    <div class="totals_area">
                        <h5 class="text-center mb-4">Order Summery</h5>
                        <div class="totals">
                            <div class="totals-item">
                                <p>Subtotal</p>
                                <p class="totals-value" id="cart-subtotal"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><span id="subtotal"><?php echo $itemtotal;?></span><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></p>
                            </div>
                            <div class="totals-item">
                                <p>Tax </p>
                                <p class="totals-value" id="cart-tax"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><span id="vat"><?php echo $calvat;?></span><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></p>
                            </div>
                            <div class="totals-item">
                                <p>Discount</p>
                                <p class="totals-value" id="Discount-charge"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><span id="discount"><?php echo $discount;?></span><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></p>
                            </div>
                            
                            <?php $coupon=0;
							if(!empty($this->session->userdata('couponcode'))){?>
                            <div class="totals-item">
                                <p>Coupon Discount</p>
                                <p class="totals-value" id="coupDiscount-charge"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><span id="coupdiscount"><?php echo $coupon=$this->session->userdata('couponprice');?></span><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></p>
                            </div>
                            <?php }
							else{
							 ?>
                             <span id="coupdiscount" class="cartlist_display_none">0</span>
                             <?php } ?>
                             <div class="totals-item totals-item-total">
                                <p>Service Charge</p>
                                <div class="totals-value" id="Service"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><span id="scharge"><?php echo "0";?></span><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?> <input name="servicecharge" type="hidden" value="0" id="getscharge" /><input name="servicename" type="hidden" value="" id="servicename" /></div>
                            </div>
                            <div class="totals-item totals-item-total">
                                <p>Grand Total</p>
                                <div class="totals-value" id="gtotal"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><span id="grtotal"><?php $gtotal=($calvat+$itemtotal)-($discount+$coupon); echo number_format($gtotal,2);?></span><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></div>
                            </div>
                            <button onclick="gotocheckout()" class="checkout">Checkout</button>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="ad_area mt-4">
                        <a href="<?php $offerimg->slink;?>">
                            <img src="<?php echo base_url();?><?php echo $offerimg->image;?>" alt="">
                        </a>
                    </div>
                </div>
                <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/cartlist.js"></script>