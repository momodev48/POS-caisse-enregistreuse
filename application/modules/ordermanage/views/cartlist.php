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
                                            <th class="text-center"><?php echo display('item')?> </th>
                                            <th class="text-center"><?php echo display('size')?></th>
                                            <th class="text-center wp_100"><?php echo display('unit_price')?></th> 
                                            <th class="text-center wp_70"><?php echo display('qty')?></th> 
                                            <th class="text-center"><?php echo display('total_price')?></th>  
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; 
								      $totalamount=0;
									  $subtotal=0;
									  $pvat=0;
									foreach ($cart as $item){
										$itemprice= $item['price']*$item['qty'];
										$iteminfo=$this->ordermodel->getiteminfo($item['pid']);
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
                                    <?php } 
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
                                        <input name="subtotal" id="subtotal" type="hidden" value="<?php echo $itemtotal;?>" />
							            <input name="tvat" type="hidden" value="<?php echo $calvat;?>" id="tvat" />
                                         <input name="tdiscount" type="hidden" value="<?php if($discount>0){echo $discount;}?>" placeholder="0.00" id="tdiscount" />
                                        <input name="tgtotal" type="hidden" value="<?php echo $calvat+$itemtotal-$discount;?>" id="tgtotal" />