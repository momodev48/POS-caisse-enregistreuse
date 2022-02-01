                                    <?php $this->load->model('ordermanage/order_model',	'ordermodel');
										 $alliteminfo=$this->ordermodel->customerorderkitchen($orderinfo->order_id,$kitchenid);
										 $allchecked2="";
							$date_arr=array();
							$c=0;
							foreach($alliteminfo as $single){
								$date_arr[$c]=$single->cookedtime;
								$allisexit=$this->db->select('tbl_kitchen_order.*')->from('tbl_kitchen_order')->where('orderid',$orderinfo->order_id)->where('kitchenid',$kitchenid)->where('itemid',$single->menu_id)->where('varient',$single->variantid)->get()->num_rows();
								if($allisexit>0){
								$allchecked2.="1,";
								}
							else{
								$allchecked2.="0,";
								}
								$c++;
							}
						if( strpos($allchecked2, '0') !== false ) {
								  $isaccept= 0;
									}
								 else{
									 $isaccept= 1;
									 }
									if(!empty($alliteminfo)){ 
									 ?>
                                     <div class="grid-item-content" id="gridcontent<?php echo $orderinfo->order_id.$kitchenid;?>">
                                     <div class="food_item <?php if($isaccept==0){ echo "pending";}?>" id="topsec<?php echo $orderinfo->order_id.$kitchenid;?>">
                                    <div class="food_item_top">
                                        <div class="item_inner">
                                            <h4 class="kf_info"><?php echo display('table') ?>: <?php echo $orderinfo->tablename;?></h4>
                                            <h4 class="kf_info"><?php echo $orderinfo->first_name.' '.$orderinfo->last_name;?></h4>
                                        </div>
                                        <div class="item_inner">
                                            <h4 class="kf_info"><?php echo display('tok') ?>: <?php echo $orderinfo->tokenno;?></h4>
                                            <h4 class="kf_info"><?php echo display('ord') ?>: #<?php echo $orderinfo->order_id;?></h4>
                                        </div>
                                        <div class="item_inner">
                                            <h4 class="kf_info"><?php echo display('customer_name') ?>: <?php echo $orderinfo->customer_name;?></h4>
                                        </div>
                                    </div>
                                    <div class="cooking_time">
                                        <h4 class="kf_info"><?php echo display('cookedtime') ?>: <span><?php if(!empty($date_arr)){echo max($date_arr);}?></span></h4>
                                    </div>
                                    <div class="food_select" id="acceptitem<?php echo $orderinfo->order_id.$kitchenid;?>">
                                    	<?php 
										 $iteminfo=$this->ordermodel->customerorderkitchen($orderinfo->order_id,$kitchenid);
										 $allcancelitem=$this->ordermodel->customercancelkitchen($orderinfo->order_id,$kitchenid);
										 $l=0;
										 foreach($iteminfo as $item){
											 $l++;
											 $ischecked=$this->db->select('tbl_kitchen_order.*')->from('tbl_kitchen_order')->where('orderid',$orderinfo->order_id)->where('kitchenid',$kitchenid)->where('itemid',$item->menu_id)->where('varient',$item->variantid)->get()->num_rows();?>
                                        <div class="single_item">
                                            <div class="align-center justify-between position-relative mb-13">
                                                <input id='chkbox-<?php echo $l.$item->kitchenid.$orderinfo->order_id;?>' usemap="<?php echo $orderinfo->order_id;?>" title="<?php echo $item->varientid;?>" alt="<?php echo $isaccept;?>" type='checkbox'  <?php if($ischecked==1 && $isaccept==0){ echo "checked disabled";} if($isaccept==1 && $item->food_status==1){ echo "checked";}?> class="individual" name="item<?php echo $orderinfo->order_id.$item->kitchenid;?>" value="<?php echo $item->menu_id;?>"/>
                                                <label for='chkbox-<?php echo $l.$item->kitchenid.$orderinfo->order_id;?>'>
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <div>
                                                        <span class="display-block"><?php echo $item->ProductName;?></span>
                                                      <?php if(!empty($item->varientid)){?><span class="item-span"><?php echo $item->variantName;?></span><?php } ?>
                                                   </div>
                                                </label>
                                                
                                                <h4 class="quantity"><?php echo $item->menuqty;?>x</h4>
                                            </div>
                                            <?php if(!empty($item->add_on_id)){
												$addons=explode(",",$item->add_on_id);
												$addonsqty=explode(",",$item->addonsqty);
												$p=0;
												?>
                                            <div><?php 
											foreach($addons as $addonsid){
												
												$adonsinfo=$this->ordermodel->read('*', 'add_ons', array('add_on_id' => $addonsid));
											echo $adonsinfo->add_on_name;
											?>(<?php echo $addonsqty[$p];?>), <?php $p++; } ?></div>
                                            <?php }
											if(!empty($item->notes)){
											?>
                                            <div><strong>Notes:</strong> <?php echo $item->notes;?></div>
                                            <?php }?>
                                        </div>
                                        <?php } 
										if(!empty($allcancelitem)){
											foreach($allcancelitem as $cancelitem){
										?>
                                        <div class="single_item single_item-bg">
                                            <div class="align-center justify-between position-relative mb-13">
                                                 <div>
                                                        <h4 class="quantity"><?php echo $cancelitem->ProductName;?></h4>
                                                     <span class="item-span"><?php echo $item->variantName;?></span>
                                                   </div>
                                                
                                                <h4 class="quantity"><?php echo $cancelitem->quantity;?>x</h4>
                                            </div>
                                           
                                        </div>
                                        <?php } } ?>
                                        <div class="align-center justify-between">
                                            <div class="checkAll">
                                                <input id='allSelect<?php echo $orderinfo->order_id;?><?php echo $kitchenid;?>' name="item<?php echo $orderinfo->order_id.$kitchenid;?>" type='checkbox' class="selectall" value=""/>
                                                <label for='allSelect<?php echo $orderinfo->order_id;?><?php echo $kitchenid;?>'>
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    <?php echo display('all') ?>
                                                </label>
                                            </div>
                                            
                                            <div class="<?php if($isaccept==1){ echo "display-block"; }else{ echo "display-none";}?>" id="isprepare<?php echo $orderinfo->order_id;?><?php echo $kitchenid;?>">
                                                <button class="btn btn-success w-smd lh-30" onclick="onprepare(<?php echo $orderinfo->order_id;?>,<?php echo $kitchenid;?>)"><?php echo display('prepared') ?></button>
                                                <button class="btn btn-info lh-30" onclick="printtoken(<?php echo $orderinfo->order_id;?>,<?php echo $kitchenid;?>)"><i class="fa fa-print"></i></button>
                                            </div>
                                            <div class="<?php if($isaccept==0){ echo "display-block"; }else{ echo "display-none";}?>" id="isongoing<?php echo $orderinfo->order_id;?><?php echo $kitchenid;?>">
                                                <button class="btn btn-success w-smd lh-30" onclick="orderaccept(<?php echo $orderinfo->order_id;?>,<?php echo $kitchenid;?>)"><?php echo display('accept') ?></button>
                                                <button class="btn btn-danger w-smd lh-30" onclick="ordercancel(<?php echo $orderinfo->order_id;?>,<?php echo $kitchenid;?>)"><?php echo display('reject') ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
<script>
$(function(){
$(".selectall").click(function() {
            $(this).parent().parent().siblings().find(".individual").prop("checked", $(this).prop("checked"));
        });
});
</script>
<?php } ?>
