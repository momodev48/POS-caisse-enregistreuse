<div class="table-wrapper-scroll-y productclist">
								<div class="table-responsive">
								<table class="table table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('item')?> </th>
                                            <th class="text-center"><?php echo display('varient_name')?></th>
                                            <th class="text-center wp_100"><?php echo display('unit_price')?></th> 
                                            <th class="text-center wp_100"><?php echo display('qty');?></th> 
                                            <th class="text-center"><?php echo display('total_price')?></th> 
                                            <th class="text-center"><?php echo display('action')?></th> 
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; 
								  $totalamount=0;
									  $subtotal=0;
									  $total=$orderinfo->totalamount;
									  $pdiscount=0;
									   $discount=0;
									   $multiplletax = array();
									foreach ($iteminfo as $item){
										$i++;
										if($item->isgroup==1){
											$isgroupidp=1;
											$isgroup=$item->menu_id;
										}
										else{
											$isgroupidp=0;
											$isgroup=0;
											}
										$iteminfor=$this->order_model->getiteminfo($item->menu_id);
											if($item->price>0){
											$itemprice= $item->price*$item->menuqty;
											$itemsingleprice=$item->price;
											}
											else{
												$itemprice= $item->mprice*$item->menuqty;
												$itemsingleprice=$item->mprice;
												}
										
										$mypdiscountprice =0;
										 if(!empty($taxinfos)){
                                    $tx=0;
                                    if($iteminfor->OffersRate>0){
                                        
                                     $mypdiscountprice=$iteminfor->OffersRate*$itemprice/100;
                                      }
                                       $itemvalprice =  ($itemprice-$mypdiscountprice);
                                    foreach ($taxinfos as $taxinfo) 
                                    {
                                      $fildname='tax'.$tx;
                                      if(!empty($iteminfor->$fildname)){
                                      $vatcalc=$itemvalprice*$iteminfor->$fildname/100;
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
										if($iteminfor->OffersRate>0){
											$mypdiscount=$iteminfor->OffersRate*$itemprice/100;
											$pdiscount=$pdiscount+($iteminfor->OffersRate*$itemprice/100);
											}
										else{
											$mypdiscount=0;
											$pdiscount=$pdiscount+0;
										}
										$adonsprice=0;
										if(!empty($item->add_on_id)){
											$addons=explode(",",$item->add_on_id);
											$addonsqty=explode(",",$item->addonsqty);
											$text='&nbsp;&nbsp;<a class="text-right adonsmore" onclick="expand('.$i.')">More..</a>';
											$x=0;
											foreach($addons as $addonsid){
													$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
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
										 $subtotal=$subtotal+$nittotal+$itemprice;
									?>
                                    <tr>
                                        <td>
                                     	<?php echo $item->ProductName;?><?php echo $text;?> <a class="serach pl-15" onclick="itemnote('<?php echo $item->row_id;?>','<?php echo $item->notes;?>',<?php echo $item->order_id;?>,1,<?php echo $isgroup;?>)" title="<?php echo display('foodnote') ?>"> <i class="fa fa-sticky-note" aria-hidden="true"></i> </a>
                                        </td>
                                        <td>
                                        <?php echo $item->variantName;?>
                                        </td>
                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemsingleprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                        <td class="text-right"><input type="hidden" class="exists_qty" name="select_qty_<?php echo $item->menu_id?>" id="select_qty_<?php echo $item->menu_id?>_<?php echo $item->varientid?>" value="<?php echo $item->menuqty;?>"><a class="btn btn-danger btn-sm btnrightalign" onclick="positemupdate('<?php echo $item->menu_id?>',<?php echo $item->menuqty;?>,'<?php echo $item->order_id;?>','<?php echo $item->varientid?>','<?php echo $isgroupidp;?>','<?php echo $item->addonsuid?>','del')"><i class="fa fa-minus" aria-hidden="true"></i></a> <span id="productionsetting-update-<?php echo $item->menu_id.'-'.$item->varientid ?>"><?php echo number_format($item->menuqty,3);?> </span><a class="btn btn-info btn-sm btnleftalign" onclick="positemupdate('<?php echo $item->menu_id?>',<?php echo $item->menuqty;?>,'<?php echo $item->order_id;?>','<?php echo $item->varientid?>','<?php echo $isgroupidp;?>','<?php echo $item->addonsuid?>','add')"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemprice-$mypdiscount,3);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                        <td class="text-right"><?php if($this->permission->method('ordermanage','delete')->access()){?><a class="btn btn-danger btn-sm btnrightalign" onclick="deletecart(<?php echo $item->row_id;?>,<?php echo $item->order_id;?>,<?php echo $item->menu_id?>,<?php echo $item->varientid?>,<?php echo $item->menuqty;?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a><?php } ?></td>
                                     </tr>
                                    <?php 
									if(!empty($item->add_on_id)){
										$y=0;
											foreach($addons as $addonsid){
													$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
													$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];
													 /*for adonsval cal*/
                                        				if(!empty($taxinfos)){
                                                    $tax=0;
                                        
                                          foreach ($taxinfos as $taxainfo) 
                                          {

                                            $fildaname='tax'.$tax;

                                        if(!empty($adonsinfo->$fildaname)){
                                       
                                        $avatcalc=($adonsinfo->price*$addonsqty[$y])*($adonsinfo->$fildaname)/100; 
                                        $multiplletax[$fildaname] = $multiplletax[$fildaname]+$avatcalc;
                                         
                                        }
                                        else{
                                          $avatcalc=($adonsinfo->price*$addonsqty[$y])*$taxainfo['default_value']/100; 
                                          $multiplletax[$fildaname] = $multiplletax[$fildaname]+$avatcalc; 
                                        }

                                      $pvat=$pvat+$avatcalc;
                                      
                                      $avatcalc=0;
                                            $tax++;
                                          }
                                      }
                                      				/*adonse update val cal*/
													?>
                                                    <tr class="bg-deep-purple get_<?php echo $i;?> hasaddons" id="expandcol_<?php echo $i;?>">
                                                        <td colspan="2">
                                                        <?php echo $adonsinfo->add_on_name;?>
                                                        </td>
                                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                                        <td class="text-right"><?php echo $addonsqty[$y];?></td>
                                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price*$addonsqty[$y];?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                                        <td class="text-right">&nbsp;</td>
                                                     </tr>
									<?php $y++;
												}
										 }
									}
									 $itemtotal=$subtotal-$pdiscount;
									 if(empty($taxinfos)){
                                      if($settinginfo->vat>0 ){
                                        $calvat=$itemtotal*$settinginfo->vat/100;
                                      }
                                      else{
                                        $calvat=$pvat;
                                        }
                                      }
									  else{
										$calvat=$pvat;
									  }
									 ?>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('subtotal')?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($itemtotal,3);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
                                 </div>
                                </div>
                                <input name="subtotal" id="subtotal_update" type="hidden" value="<?php echo $subtotal;?>" />
                                <input name="multiplletaxvalue" id="multiplletaxvalue_update" type="hidden" value="<?php echo $multiplletaxvalue;?>" />
<table class="table table-bordered bg-white">
                                <?php $servicecharge=0;
                                            if(empty($billinfo)){
                                                $servicecharge=0;
                                                }
                                            else{
                                                    if($settinginfo->service_chargeType==0){
                                                    $servicecharge=$billinfo->service_charge;
                                                    }
                                                    else{
                                                        $servicecharge=$billinfo->service_charge*100/$billinfo->total_amount;
                                                        }
                                                    $sdamount=$billinfo->service_charge;
                                                   } 
                                                ?>
                                            <?php $discount=0;
							$customerinfo=$this->order_model->read('*', 'customer_info', array('customer_id' =>$billinfo->customer_id));
							$mtype=$this->order_model->read('*', 'membership', array('id' => $customerinfo->membership_type));
                                            if(empty($billinfo)){
                                                $discount=$pdiscount;
                                                }
                                                else{
													$newsubtotal=$subtotal-$pdiscount;
													$discount=$pdiscount+($mtype->discount*$newsubtotal/100);
                                                    $disamount=$billinfo->discount;
                                                   } 
                                                 
                                                ?>
                                <input name="distype" id="distype_update" type="hidden" value="<?php echo $settinginfo->discount_type;?>" />
                                <input name="sdtype" id="sdtype_update" type="hidden" value="<?php echo $settinginfo->service_chargeType;?>" />
                                <input name="invoice_discount" class="text-right" id="invoice_discount_update" type="hidden" value="<?php echo $discount;?>" />
                                <tr>
                                    <td class="text-right wpr_494"><strong><?php echo display('service_chrg')?><?php if($settinginfo->service_chargeType==0){ echo "(".$currency->curr_icon.")";}else{ echo "(%)";}?></strong></td>
                                    <td class="text-right wpr_28">
                                            <strong> <?php $servicecharge=0;
											if(empty($billinfo)){
												$servicecharge=0;
												}
												else{
													if($settinginfo->service_chargeType==0){
													$servicecharge=$settinginfo->servicecharge;
													}
													else{
														 $totalsercharge=$subtotal-$pdiscount;
							 							 $servicecharge=$settinginfo->servicecharge*$totalsercharge/100;
														}
													$sdamount=$billinfo->service_charge;
											       } 
												?>
                                            <input name="service_charge" class="text-right" id="service_charge_update" type="number" placeholder="0.00" onkeyup="sumcalculation(1)" value="<?php echo $settinginfo->servicecharge;?>" />
                                           
                                            </strong>
                                        </td>
                                    <td class="text-right wpr_126">&nbsp;</td>
                                    </tr>
                                <tr>
                                    <td class="text-right wpr_494"><strong><?php echo display('vat_tax')?></strong></td>
                                    <td class="text-right wpr_28">
                                   
                                    <input id="vat_update" name="vat" type="hidden" value="<?php echo $calvat;?>" />
                                            <strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($calvat,3);?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong>
                                        </td>
                                    <td class="text-right wpr_126">&nbsp;</td>
                                    </tr>
                                <tr>
                                    <td class="text-right wpr_494"><strong><?php echo display('grand_total')?></strong></td>
                                    <td class="text-right wpr_28">
                                    <input name="tgtotal" type="hidden" value="<?php echo $calvat+$itemtotal+$servicecharge;?>" id="tgtotal" />
                                            <input name="orginattotal" id="orginattotal_update" type="hidden" value="<?php echo $calvat+$itemtotal+$servicecharge;?>" /><input name="grandtotal" id="grandtotal_update" type="hidden" value="<?php echo $calvat+$itemtotal+$servicecharge;?>"><?php if($currency->position==1){echo $currency->curr_icon;}?> <strong id="gtotal_update"><?php echo number_format($calvat+$itemtotal+$servicecharge,3);?></strong> <?php if($currency->position==2){echo $currency->curr_icon;}?>
                                        </td>
                                    <td class="text-right wpr_126">&nbsp;</td>
                                    </tr>
                                
                                </table>