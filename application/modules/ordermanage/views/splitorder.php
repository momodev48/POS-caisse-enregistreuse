<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/splitorder.css'); ?>">

    <?php ?>

            <div id="payprint_marge" class="modal-dialog modal-inner" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo display('split_order');?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row kitchen-tab">
                            

                         <div class="col-md-3">
                            <div class="table-split">
                                <table class="table table-split-left">
                                    <tbody>
                                                    <?php 
                                                    
                                                        $num=0; 
                                                        $list[''] = 'Select Method';
                                                    foreach ($iteminfo as $item) {
                                                       $num= $num+$item->menuqty;
                                                       $qty = $item->menuqty;
                                                     if(!empty($suborder_info)){ 
                                                        
                                                     foreach($suborder_info as $menu_items){
                                                        if (!empty($menu_items->order_menu_id)) {
                                                            
                                                            $suborder_data = unserialize($menu_items->order_menu_id);
                                                            foreach ($suborder_data as $key => $value) {
                                                                if($key == $item->row_id ){
                                                                    $qty = $qty-$value;
                                                                   
                                                                }
                                                            }
                                                            
                                                        }

                                                     }
                                                 }
                                                   
												    ?>
                                                    <tr onclick='addintosuborder("<?php echo $item->row_id;?>","<?php echo $item->order_id;?>",this)' data-url="<?php echo base_url().$module.'/order/showsuborderdetails/';?>">
                                                        <td><?php echo $item->ProductName; ?></td>
                                                        <td><?php echo $qty;?></td>
                                                    </tr>
                                                    <?php }
                                                        for ($i=2; $i <=$num ; $i++) {
                                                            $list[$i] = $i;
                                                        }
                                                        
                                                    ?>
                                                </tbody>
                                </table>
                            </div>
                        </div>
                          <div class="col-md-9">
                            <div class="row split-content">
                                <div class="col-md-12">

                                    <div class="form-group">
                                    <label for="number-of-sub-order">Select number of order:</label>
                                     <?php
                                     $count =count($suborder_info);
                                  echo form_dropdown('number',$list,$count,' class="form-control" id="number-of-sub-order" onchange="showsuborder(this)" data-url="'.base_url().$module.'/order/showsuborder/" data-value="'.$order_info->order_id.'"') ?>
                                    </div>
                                </div>
                                <div class="col-md-12 row" id="show-sub-order">
                                     <?php if(!empty($suborder_info)){?>
                                          <?php 
                                          
  foreach ($suborder_info as $suborder) {
    $totalprice =0;
    $totalvat =0;
    $itemprice=0;
	
       ?>
  <div class="col-md-6">
                                    <div class="info_part split-item" onclick="selectelement(this)" data-value="<?php echo $suborder->sub_id; ?>">
                                        <div class="table-topper">
                                            <div class="">

                                                <label for="chkbox-">
                                                  
                                                    <div>
                                                        <span class="display-block"><?php echo display('ord');?></span>
                                                    </div>
                                                </label>
                                                <table class="table table-modal table-title">
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo display('ord');?></td>
                                                            <td><?php echo $suborder->sub_id; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                        <table class="table table-bordered table-modal table-info text-center" id="table-tbody-<?php echo $suborder->order_id;?>-<?php echo $suborder->sub_id;?>">
                                            <thead>
                                                <tr>
                                                    <th><?php echo display('item');?></th>
                                                <th><?php echo display('varient_name');?></th>      
                                                <th><?php echo display('unit_price');?></th>
                                                <th><?php echo display('qty');?></th>
                                                <th class="text-center"><?php echo display('total_price')?></th> 

                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $SD=0;
											if(!empty($suborder->order_menu_id)){
                                                $suborderqty = unserialize($suborder->order_menu_id);
                                               
                                                foreach ($suborder->suborderitem as $subitem) {
												$isoffer=$this->order_model->read('*', 'order_menu', array('row_id' => $subitem->row_id));	
                                                 if($isoffer->isgroup==1){
													$this->db->select('order_menu.*,item_foods.ProductName,item_foods.OffersRate,variant.variantid,variant.variantName,variant.price');
													$this->db->from('order_menu');
													$this->db->join('item_foods','order_menu.groupmid=item_foods.ProductsID','left');
													$this->db->join('variant','order_menu.groupvarient=variant.variantid','left');
													$this->db->where('order_menu.row_id',$subitem->row_id);
													$query = $this->db->get();
													$orderinfo=$query->row(); 
													$subitem->ProductName=$orderinfo->ProductName;
													$subitem->OffersRate=$orderinfo->OffersRate;
													$subitem->price=$orderinfo->price;
													$subitem->variantName=$orderinfo->variantName;
													
												  }
													 
                                                /* 
                                                 for addones*/ 
                                                    $adonsprice =0;
                                                    $addonsname = array();
                                                    $addonsnamestring ='';
                                                
                                                $isaddones=$this->order_model->read('*', 'check_addones', array('order_menuid' => $subitem->row_id));
                                    if(!empty($suborder->adons_id) && !empty($isaddones) ){
                                        $y=0;
                                        
                                        
                                        $addons = explode(',', $suborder->adons_id);
                                        $addonsqty = explode(',',  $suborder->adons_qty);

                                            foreach($addons as $addonsid){
                                                    $adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                                    $addonsname[$y] = $adonsinfo->add_on_name;
                                                   
                                                    $adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
                                                    $adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];
                                                    
                                     $y++;
                                                }
                                                $addonsnamestring = implode($addonsname, ',');

                                         } ?>
                                                <!-- end addones -->
                                                
                                                <tr>
                                                    <td scope="row"><?php echo $subitem->ProductName.','.$addonsnamestring; ?></td>
                                                    <td><?php echo $subitem->variantName; ?></td>
                                                    <td>
                                                       <?php echo $subitem->price;?>
                                                    </td>
                                                    <td><?php echo $suborderqty[$subitem->row_id]; ?></td>
                                                    <td><?php  if($subitem->OffersRate >0){ 
                                                        $discountt = ($subitem->price*$subitem->OffersRate)/100;  
                                                            echo $suborderqty[$subitem->row_id]*$subitem->price-($suborderqty[$subitem->row_id]*$discountt)+$adonsprice;
                                                             $totalprice = $totalprice+$suborderqty[$subitem->row_id]*$subitem->price-($suborderqty[$subitem->row_id]*$discountt)+$adonsprice;
                                                             $itemprice = $suborderqty[$subitem->row_id]*$subitem->price-($suborderqty[$subitem->row_id]*$discountt)+$adonsprice;   
                                                            }
                                                    else{
                                                        echo $suborderqty[$subitem->row_id]*$subitem->price+$adonsprice;
                                                         $itemprice = $suborderqty[$subitem->row_id]*$subitem->price+$adonsprice;
                                                            $totalprice = $totalprice+$suborderqty[$subitem->row_id]*$subitem->price+$adonsprice;

                                                    } ?></td>
                                                    <!-- for vat -->
                                                     <?php 
                                                        $vatcalc=$itemprice*$subitem->productvat/100;
                                                        $pvat = $vatcalc;
                                                     if($settinginfo->vat>0){
                                                            $calvat=$itemprice*$settinginfo->vat/100;
                                                                 }
                                                            else{
                                                            $calvat=$pvat;
                                                                } 
                                                                $totalvat = $calvat+$totalvat;
                                                                ?>
                                                    <!-- end vat -->
                                                </tr>
                                       
                                             
                                            <?php 
                                            $msd=$itemprice*$settinginfo->servicecharge/100;
													 $SD=$msd+$SD;
                                        }
                                        }
												if($settinginfo->service_chargeType==1){
													$service_chrg_data =$SD;
													}
												else{
												$service_chrg_data = $service->service_charge/$count;
												}
                                                ?>

                                            </tbody>
                                            <!-- table footer -->
                                                <tfoot>
                                        <tr>
                                            <td colspan="1" align="right" class="text-right font-14">&nbsp; <b><?php echo display('total') ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($totalprice,3);?> </b></td>
                                        </tr>
                                         <tr>
                                            <td colspan="1" align="right" class="text-right font-14">&nbsp; <b><?php echo display('vat_tax') ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($totalvat,3);?></b></td>
                                        </tr>
                                         <tr>
                                            <td colspan="1" align="right" class="text-right font-14">&nbsp; <b><?php echo display('service_chrg') ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($service_chrg_data,3);?></b></td>
                                        </tr>
                                         <tr>
                                            <td colspan="1" align="right" class="text-right font-14">&nbsp; <b><?php echo display('grand_total') ?> </b></td>
                                            <td class="text-right"><b><?php 
                                            echo number_format($totalprice+$totalvat+$service_chrg_data,3);?></b></td>
                                            <input type="hidden" id="total-sub-<?php echo $suborder->sub_id;?>" value="<?php echo $totalprice;?>">
                                            <input type="hidden" id="vat-<?php echo $suborder->sub_id;?>" value="<?php echo $totalvat;?>">
                                            <input type="hidden" id="service-<?php echo $suborder->sub_id;?>" value="<?php echo $service_chrg_data;?>">
                                        </tr>
                                    </tfoot>
                                            <!-- end table footer -->
                                        </table>
                                       

                                            <div class="customer-select">
                                                <label for="customer" class="customer-label">Customer</label>
                                             
                                                <?php 
                                                                    echo form_dropdown('customer_name[]',$customerlist,(!empty($cusid)?$cusid:1),'class="form-control " id="customer-'.$suborder->sub_id.'" required'); ?>
                                                
                                            </div>
                                     
                                        <div class="submit_area"> 

                                            <?php if($suborder->status ==0){?>                           
                                            <button class="btn btn-clear" id="subpay-<?php echo $suborder->sub_id;?>" onclick="paySuborder(this)" data-url="<?php echo base_url().$module.'/order/paysuborder';?>"><?php echo display('pay_print')?></button>
                                        <?php }?>
                                        </div>
                                    </div>
                                </div>

                <?php 
                    }
            }?>
                                 </div>
                            </div>
                        </div>
                     
                     
                        </div>
                    </div>
                    
                </div>
            </div>

