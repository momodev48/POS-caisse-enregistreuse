<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<!-- Printable area end -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd">
                <div class="panel-footer text-right">
						<a  class="btn btn-info" onclick="printDiv('printableArea')" title="Print"><span class="fa fa-print"></span>
						</a>
                    </div>
	                <div id="printableArea">
	                    <div class="panel-body">
	                        <div class="row">
	                            <div class="col-sm-10 wpr_68 display-inlineblock">
	                                <img src="<?php echo base_url();?><?php echo $storeinfo->logo?>" class="img img-responsive height-mb" alt="">
	                                <br>
	                                <span class="label label-success-outline m-r-15 p-10" ><?php echo display('billing_from') ?></span>
	                                <address class="mt-10">
	                                    <strong><?php echo $storeinfo->storename;?></strong><br>
	                                    <?php echo $storeinfo->address;?><br>
	                                    <abbr><?php echo display('mobile') ?>:</abbr> <?php echo $storeinfo->phone;?><br>
	                                    <abbr><?php echo display('email') ?>:</abbr> 
	                                    <?php echo $storeinfo->email;?><br>
	                                </address>
	                            </div>
	                            <div class="col-sm-2 text-left mb-display">
	                                <h2 class="m-t-0"><?php echo display('invoice') ?></h2>
	                                <div><?php echo display('invoice_no') ?>: <?php echo $orderinfo->saleinvoice;?></div>
	                                <div class="m-b-15"><?php echo display('billing_date') ?>: <?php echo $orderinfo->order_date;?></div>
	                                <span class="label label-success-outline m-r-15"><?php echo display('billing_to') ?></span>
	                                 <address class="mt-10">  
	                                    <strong><?php echo $customerinfo->customer_name;?> </strong><br>
	                                    <abbr><?php echo display('address') ?>:</abbr>
		                                <c class="wmp"><?php echo $customerinfo->customer_address;?></c><br>
	                                    <abbr><?php echo display('mobile') ?>:</abbr><?php echo $customerinfo->customer_phone;?></abbr>
	                                    <br>
	                                    <abbr><?php echo display('email') ?>:</abbr><?php echo $customerinfo->customer_email;?>
	                                   
	                                </address>
	                            </div>
	                        </div> <hr>

	                        <div class="table-responsive m-b-20">
	                            <table class="table table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('item')?> </th>
                                            <th class="text-center"><?php echo display('size')?></th>
                                            <th class="text-center wp_100"><?php echo display('unit_price')?></th> 
                                            <th class="text-center wp_100"><?php echo display('qty')?></th> 
                                            <th class="text-center"><?php echo display('total_price')?></th> 
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
										 $subtotal=$subtotal+$item->price*$item->menuqty;
									?>
                                    <tr>
                                        <td>
                                     	<?php echo $item->ProductName;?>
                                        </td>
                                        <td>
                                        <?php echo $item->variantName;?>
                                        </td>
                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item->price;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                        <td class="text-right"><?php echo $item->menuqty;?></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                     </tr>
                                    <?php 
									if(!empty($item->add_on_id)){
										$y=0;
											foreach($addons as $addonsid){
													$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
													$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
                                                    <tr>
                                                        <td colspan="2">
                                                        <?php echo $adonsinfo->add_on_name;?>
                                                        </td>
                                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                                        <td class="text-right"><?php echo $addonsqty[$y];?></td>
                                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price*$addonsqty[$y];?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                                     </tr>
									<?php $y++;
												}
										 }
									}
									 $itemtotal=$totalamount+$subtotal;
									 $calvat=$itemtotal*$settinginfo->vat/100;
									 
									 $discountpr=0; 
									 if($settinginfo->discount_type==1){ 
									 $dispr=$billinfo->discount*100/$billinfo->total_amount;
									 $discountpr='('.$dispr.'%)';
									 } 
									 else{$discountpr='('.$currency->curr_icon.')';}
									 
									  $sdr=0; 
									 if($storeinfo->service_chargeType==1){ 
									 $sdpr=$billinfo->service_charge*100/$billinfo->total_amount;
									 $sdr='('.round($sdpr).'%)';
									 } 
									 else{$sdr='('.$currency->curr_icon.')';}
									 ?>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('subtotal')?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemtotal;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('discount')?><?php echo $discountpr;?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php $discount=0; if(empty($billinfo)){ echo $discount;} else{echo $discount=$billinfo->discount;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('service_chrg')?><?php echo $sdr;?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php $servicecharge=0; if(empty($billinfo)){ echo $servicecharge;} else{echo $servicecharge=$billinfo->service_charge;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('vat_tax')?> (<?php echo $settinginfo->vat;?>%)</strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat=$billinfo->VAT; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-right" colspan="4"><strong><?php echo display('grand_total')?></strong></td>
                                        <td class="text-right"><strong><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat+$itemtotal+$servicecharge-$discount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </strong></td>
                                    </tr>
                                    <?php 
			if($orderinfo->customerpaid>0){
				$customepaid=$orderinfo->customerpaid;
				$changes=$customepaid-round($orderinfo->totalamount);
				}
			else{
				$customepaid=$orderinfo->totalamount;
				$changes=0;
				}
			?>
            <tr>
              <td align="right" colspan="4"><nobr><?php echo display('customer_paid_amount')?></nobr></td>
              <td align="right"><nobr><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></nobr></td>
            </tr>
            <tr>
              <td align="right" colspan="4"><nobr><?php echo display('change_due')?></nobr></td>
              <td align="right"><nobr><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></nobr></td>
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



