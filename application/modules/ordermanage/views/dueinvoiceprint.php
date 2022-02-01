<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/pos_token.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/pos_print.css'); ?>">
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="printableArea" class="bill__container bill-pos-mini__container width-font">
    <div class="pt-5">
        <div class="bill-pos-mini__logo border" align="center"><img src="<?php echo base_url();?><?php echo $storeinfo->logo?>" class="img img-responsive" alt=""></div>
    </div>
    <div class="px-4">
        <h5 class="text-center mt-3 mb-0 text-bold"><?php echo display('bill');?></h5>
        <p class="text-note text-primary text-center mb-0 text-bold"><?php echo $storeinfo->storename;?></p>
        <p class="text-note text-center mb-3"><?php echo $storeinfo->address;?></p>
        <div>
            <p class="mb-0"><b class="text-bold"><?php echo display('recept')?>: </b> #<?php echo $orderinfo->saleinvoice;?></p>
            <p class="mb-0"><b class="text-bold"><?php echo display('table');?>: </b> <?php echo $tableinfo->tablename;?></p>
            <?php if($storeinfo->isvatnumshow==1){?><p class="mb-0"><b class="text-bold"><?php echo display('tinvat');?>: </b><?php echo $storeinfo->vattinno;?></p><?php } ?>
            <p class="mb-0"><b class="text-bold"><?php echo display('date');?>: </b><?php echo date("M d, Y", strtotime($orderinfo->order_date));?></p>
            <div class="d-flex justify-content-between">
                <p class="mb-0"><b class="text-bold"><?php echo display('checkin')?>: </b> <?php echo $orderinfo->order_time;?></p>
               
            </div>
        </div>
        <div class="pb-3 border-bottom--dashed">
            <table class="w-100">
                <thead>
                    <th class="wpr_50"><strong><?php echo display('item')?></strong></th>
                    <th class="wpr_50 text-right"><strong><?php echo display('total')?></strong></th>
                </thead>
                <tbody>
                <?php $this->load->model('ordermanage/order_model',	'ordermodel');
				  $i=0; 
				  $totalamount=0;
					  $subtotal=0;
					  $total=$orderinfo->totalamount;
					  $pdiscount=0;
					foreach ($iteminfo as $item){
						$i++;
						$itemprice= $item->price*$item->menuqty;
						$itemdetails=$this->ordermodel->getiteminfo($item->menu_id);
						if($itemdetails->OffersRate>0){
						 $ptdiscount=$itemdetails->OffersRate*$itemprice/100;
						  $pdiscount=$pdiscount+($itemdetails->OffersRate*$itemprice/100);
						}
						else{
							$ptdiscount=0;
							$pdiscount=$pdiscount+0;
							}
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
                        <td class="p-0"><p class="mb-0"><?php echo $item->ProductName;?>-<?php echo $item->variantName;?></p><small class="mb-0 text-italic"><?php echo $item->price;?> x <?php echo $item->menuqty;?></small></td>
                        <td valign="top" class="p-0 text-right"><p class="mb-0"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemprice-$ptdiscount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p></td>
                    </tr>
                    
                    <?php 
			if(!empty($item->add_on_id)){
				$y=0;
					foreach($addons as $addonsid){
							$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
							$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
			 		<tr>
                        <td valign="top" class="p-0"><p class="mb-0 ml-2">-<?php echo $adonsinfo->add_on_name;?></p><small class="mb-0 ml-2 text-italic"><?php echo $adonsinfo->price;?> x <?php echo $addonsqty[$y];?></small></td>
                        <td valign="top" class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $adonsinfo->price*$addonsqty[$y];?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                    </tr>
             
             <?php $y++;
						}
				 }
			}			 
			 $itemtotal=$totalamount+$subtotal;
			 $calvat=$itemtotal*15/100;
			 
			 $servicecharge=0; 
			 if(empty($billinfo)){ $servicecharge;} 
			 else{$servicecharge=$billinfo->service_charge;}
			 
			 $sdr=0; 
			 if($storeinfo->service_chargeType==1){ 
			 $sdpr=$billinfo->service_charge*100/$billinfo->total_amount;
			 $sdr='('.round($sdpr).'%)';
			 } 
			 else{$sdr='('.$currency->curr_icon.')';}
			 
			  $discount=0; 
			 if(empty($billinfo)){ $discount;} 
			 else{$discount=$billinfo->discount;}
			 
			 $discountpr=0; 
			 if($storeinfo->discount_type==1){ 
			 $dispr=$billinfo->discount*100/$billinfo->total_amount;
			 $discountpr='('.round($dispr).'%)';
			 } 
			 else{$discountpr='('.$currency->curr_icon.')';}
			 ?>
                </tbody>
            </table>
        </div>
        <div class="border-bottom--dashed">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary text-bold"><?php echo display('subtotal')?>:</p>
                <p class="mb-0 text-note text-primary text-bold"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $billinfo->total_amount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary"><?php echo display('discount')?></p>
                <p class="mb-0 text-note text-primary">-<?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php $discount=0; if(empty($billinfo)){ echo $discount;} else{echo $discount=$billinfo->discount;} ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary"><?php echo display('service_chrg')?>:</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?><?php $sdcharge=0; if(empty($billinfo)){ echo $sdcharge;} else{echo $sdcharge=$billinfo->service_charge;} ?><?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary"><?php echo display('vat_tax')?>(<?php echo $storeinfo->vat;?>%):</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $calvat=$billinfo->VAT; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
        </div>
        <div class="border-bottom--dashed">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary text-bold"><?php echo display('grand_total')?>:</p>
                <p class="mb-0 text-note text-primary text-bold"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $billinfo->bill_amount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <?php 
			if($orderinfo->customerpaid>0){
				$customepaid=$orderinfo->customerpaid;
				$changes=$customepaid-$orderinfo->totalamount;
				}
			else{
				$customepaid=$orderinfo->totalamount;
				$changes=0;
				}
			if($billinfo->bill_status==1){?>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 text-note text-primary"><?php echo display('customer_paid_amount')?>:</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <?php } else{ ?>
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 text-note text-primary"><?php echo display('total_due')?>:</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
            <?php } ?>
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0 text-note text-primary"><?php echo display('change_due')?>:</p>
                <p class="mb-0 text-note text-primary"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $changes; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
            </div>
        </div>
        <div class="">
            <div class="d-flex justify-content-between">
                <p class="text-note text-center mb-0">+ <?php echo display('totalpayment')?></p>
                <?php if($billinfo->bill_status==1){?><p class="mb-0 text-note"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo $customepaid; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p>
				<?php } else{?><p class="mb-0 text-note"><?php if($currency->position==1){echo $currency->curr_icon;}?>  <?php echo 0.00; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></p><?php } ?>
            </div>
        </div>
    </div>
    <div class="">
        <div class="mx-auto mb-1 width-border"></div>
        <p class="text-note text-center text-bold mb-2"><?php echo $customerinfo->customer_name;?></p>
        <p class="text-note text-center font-flexible mb-0">
            <?php echo display('thanssuport')?>
</p>
<div class="justify-content-between align-items-center flex-column">
    <p class="text-note text-center"><?php echo display('itaewoncorner')?></p>
</div>
</div>
<div class="border-top py-1">
    <p class="text-note text-primary text-center mb-0 text-bold"><?php echo display('thanks_you')?></p>
    <p class="text-note text-primary text-center mb-0"><?php echo display('powerbybdtask')?></p>
</div>
</div>

