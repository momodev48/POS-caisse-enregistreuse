<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<div id="cancelord" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('can_ord');?></strong>
            </div>
            <div class="modal-body">
            	<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                        <div class="form-group row">
                            <label for="payments" class="col-sm-4 col-form-label"><?php echo display('ordid');?></label>
                            <div class="col-sm-7 customesl">
                            	<span id="canordid"></span>
                                <input name="mycanorder" id="mycanorder" type="hidden" value=""  />
                                <input name="mycanitem" id="mycanitem" type="hidden" value=""  />
                                <input name="myvarient" id="myvarient" type="hidden" value=""/>
                                <input name="mykid" id="mykid" type="hidden" value=""/>
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
                            <button type="button" class="btn btn-success w-md m-b-5" id="itemcancel"><?php echo display('submit');?></button>
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

<div class="row">
                   <div class="panel">
                     <div class="panel-body">
                         <div class="text-right"><a class="display-none" id="fullscreen" href="#"><i class="pe-7s-expand1"></i></a><a href="<?php echo base_url();?>ordermanage/order/allkitchen" class="btn btn-primary btn-md"><i class="fa fa-load-circle" aria-hidden="true"></i>
<?php echo display('ref_page')?></a></div>
                     <div class="row kitchen-tab">
    <div class="col-sm-12">
        <!-- Nav tabs -->
        <ul class="nav nav-pills">
        	<?php $x=0;
			foreach($kitchenlist as $kitchen){ $x++;
			?>
            <li class="<?php if($x==1){echo "active";}?>"><a href="#tab<?php echo $x;?>" data-toggle="tab"><?php echo $kitchen->kitchen_name;?></a></li>
            <?php } ?>
        </ul>
        <!-- Tab panels -->
        <div class="tab-content">
        <?php 
		 $this->load->model('ordermanage/order_model',	'ordermodel');
		if(!empty($kitcheninfo)){
			$k=0;
				foreach($kitcheninfo as $kitchenorderinfo){
					$k++;
					?>
                 <div class="tab-pane fade <?php if($k==1){echo "in active";}?>" id="tab<?php echo $k;?>">
                <div class="panel-body">
                    <div class="grid">
                    <div class="grid-sizer col-vxs-12 col-xs-6 col-md-4 col-lg-3 col-xlg-4"></div>
					    <?php if(!empty($kitchenorderinfo)){
							$t=0;
							 foreach($kitchenorderinfo['orderlist'] as $orderinfo){
								 $t++;
									   ?>
                                 <div class="grid-col col-vxs-12 col-xs-6 col-md-4 col-lg-3 col-xlg-4" id="singlegrid<?php echo $orderinfo->order_id.$orderinfo->kitchenid;?>">
                            <div class="grid-item-content" id="gridcontent<?php echo $orderinfo->order_id.$orderinfo->kitchenid;?>">
                            <?php 
							$alliteminfo=$this->order_model->customerorderkitchen($orderinfo->order_id,$orderinfo->kitchenid);
						
							$allchecked2="";
							$date_arr=array();
							$c=0;
							foreach($alliteminfo as $single){
								$date_arr[$c]=$single->cookedtime;
								$allisexit=$this->db->select('tbl_kitchen_order.*')->from('tbl_kitchen_order')->where('orderid',$orderinfo->order_id)->where('kitchenid',$orderinfo->kitchenid)->where('itemid',$single->menu_id)->where('varient',$single->variantid)->get()->num_rows();
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
							?>
                                <div class="food_item <?php if($isaccept==0){ echo "pending";}?>" id="topsec<?php echo $orderinfo->order_id.$orderinfo->kitchenid;?>">
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
                                        <?php  $st=1;
                                               $curtime=date("i");
                                                $currentday=date('Y-m-d');
                                                $actualtime=date('H:i:s');
                                                $sortactualtime = strtotime($actualtime);
                                                $cookedtime = strtotime(max($date_arr)); 
                                                $ordertime = strtotime($orderinfo->order_time); 
                                                $estimatedtime =$ordertime+$cookedtime-strtotime('00:00:00');
                                            
                                                if(($currentday==$orderinfo->order_date) && ($sortactualtime<$estimatedtime)){
                                                 
                                             $finishtime = date("H:i:s",$estimatedtime);

                                                $array1 = explode(':', $finishtime);
                                        $array2 = explode(':', $actualtime);
                                        $minutes1 = ($array1[0] * 3600.0 + $array1[1]*60.0+$array1[2]);
                                        $minutes2 = ($array2[0] * 3600.0 + $array2[1]*60.0+$array2[2]);
                                        $diff = $minutes1 - $minutes2;
                                        $mins = sprintf('%02d:%02d:%02d', ($diff / 3600), ($diff / 60 % 60), $diff % 60);       $st=1;?>
                                            <script>
                                            var timer<?php echo $orderinfo->order_id;echo $c;?> = "<?php echo $mins;?>";
                                          
                                        var interval<?php echo $orderinfo->order_id;echo $c;?> = setInterval(function() {
                                        
                                        
                                          var timer = timer<?php echo $orderinfo->order_id;echo $c;?>.split(':');
                                          //by parsing integer, I avoid all extra string processing
                                           var hours = parseInt(timer[0], 10);
                                          var minutes = parseInt(timer[1], 10);
                                          var seconds = parseInt(timer[2], 10);
                                          --seconds;
                                          var hours = (minutes < 0) ? --hours : hours;
                                          minutes = (seconds < 0) ? --minutes : minutes;
                                          seconds = (seconds < 0) ? 59 : seconds;
                                          seconds = (seconds < 10) ? '0' + seconds : seconds;
                                 
                                          $('.countdown_<?php echo $orderinfo->order_id;echo $c;?>').html(hours+':'+minutes + ':' + seconds);
                                          if (minutes < 0) clearInterval(interval<?php echo $orderinfo->order_id;echo $c;?>);
                                          //check if both minutes and seconds are 0
                                          if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval<?php echo $orderinfo->order_id;echo $c;?>);
                                          timer<?php echo $orderinfo->order_id;echo $c;?> = hours+':'+minutes + ':' + seconds;
                                        }, 1000);
                                            </script>
                                            <?php }
                                        else{
                                            //$mins ="00:00";
                                            $st=0;
                                            }
                                      
                                       
                                        ?>
                                        <h4 class="kf_info"><?php echo display('cookedtime') ?>:<?php if($st==1){?><span class="countdown_<?php echo $orderinfo->order_id;echo $c;?>" ></span><?php }else{?><span><?php  echo display('time_over');}?></span></h4>
                                        
                                    </div>
                                    <div class="food_select" id="acceptitem<?php echo $orderinfo->order_id.$orderinfo->kitchenid;?>">
                                    	<?php 
										 $iteminfo=$this->ordermodel->customerorderkitchen($orderinfo->order_id,$orderinfo->kitchenid);
										 $allcancelitem=$this->ordermodel->customercancelkitchen($orderinfo->order_id,$orderinfo->kitchenid);
										 $l=0;
										 foreach($iteminfo as $item){
											// print_r($item);
											 $l++;
											 $ischecked=$this->db->select('tbl_kitchen_order.*')->from('tbl_kitchen_order')->where('orderid',$orderinfo->order_id)->where('kitchenid',$orderinfo->kitchenid)->where('itemid',$item->menu_id)->where('varient',$item->variantid)->get()->num_rows();?>
                                        <div class="single_item">
                                            <div class="align-center justify-between item-dv">
                                                <input id='chkbox-<?php echo $l.$item->kitchenid.$orderinfo->order_id;?>' usemap="<?php echo $orderinfo->order_id;?>" title="<?php echo $item->varientid;?>" alt="<?php echo $isaccept;?>" type='checkbox'  <?php if($ischecked==1 && $isaccept==0){ echo "checked disabled";} if($isaccept==1 && $item->food_status==1){ echo "checked";}?> class="individual" name="item<?php echo $orderinfo->order_id.$orderinfo->kitchenid;?>" value="<?php echo $item->menu_id;?>"/>
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
                                        <div class="single_item bgkitchen">
                                            <div class="align-center justify-between item-dv">
                                                 <div>
                                                        <h4 class="quantity"><?php echo $cancelitem->ProductName;?></h4>
                                                     <span class="item-span"><?php echo $item->variantName;?></span>
                                                   </div>
                                                
                                                <h4 class="quantity"><?php echo $cancelitem->quantity;?>x</h4>
                                            </div>
                                           
                                        </div>
                                        <?php } } 
										 
										?>
                                        <div class="align-center justify-between">
                                            <div class="checkAll">
                                                <input id='allSelect<?php echo $orderinfo->order_id;?><?php echo $orderinfo->kitchenid;?>' name="item<?php echo $orderinfo->order_id.$orderinfo->kitchenid;?>" type='checkbox' class="selectall" value=""/>
                                                <label for='allSelect<?php echo $orderinfo->order_id;?><?php echo $orderinfo->kitchenid;?>'>
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    <?php echo display('all') ?>
                                                </label>
                                            </div>
                                            
                                            <div class="<?php if($isaccept==1){ echo "display-block"; }else{ echo "display-none";}?>" id="isprepare<?php echo $orderinfo->order_id;?><?php echo $orderinfo->kitchenid;?>">
                                                <button class="btn btn-success w-smd lh-30" onclick="onprepare(<?php echo $orderinfo->order_id;?>,<?php echo $orderinfo->kitchenid;?>)"><?php echo display('prepared') ?></button>
                                                <button class="btn btn-info lh-30" onclick="printtoken(<?php echo $orderinfo->order_id;?>,<?php echo $orderinfo->kitchenid;?>)"><i class="fa fa-print"></i></button>
                                            </div>
                                            <div class="<?php if($isaccept==0){ echo "display-block"; }else{ echo "display-none";}?>" id="isongoing<?php echo $orderinfo->order_id;?><?php echo $orderinfo->kitchenid;?>">
                                                <button class="btn btn-success w-smd lh-30" onclick="orderaccept(<?php echo $orderinfo->order_id;?>,<?php echo $orderinfo->kitchenid;?>)"><?php echo display('accept') ?></button>
                                                <button class="btn btn-danger w-smd lh-30" onclick="ordercancel(<?php echo $orderinfo->order_id;?>,<?php echo $orderinfo->kitchenid;?>)"><?php echo display('reject') ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                 
								<?php  }  
								if(empty($kitchenorderinfo['orderlist'])){									
									echo '<div class="col-sm-12"><div style="text-align: center;"><h3>'.display('no_orderfound').'</h3> <img src="'.base_url().'assets/img/nofood.png" width="400" /></div></div>';
									}
							 }
							 ?>
                        </div>
                </div>
            </div>
					<?php }
			}
			
			?>
            
        </div>
    </div>

</div>
                      </div>
                   </div>
              </div>


<div class="modal fade modal-warning" id="posprint" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-body" id="kotenpr">
                            
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <script src="<?php echo base_url('application/modules/ordermanage/assets/js/kitchen.js'); ?>" type="text/javascript"></script>

