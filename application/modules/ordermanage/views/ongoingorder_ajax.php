<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/onoing_ajax.css'); ?>">
<div class="col-md-12">
  <div class="row mb-2">
    <div class="col-sm-3">
      <select id="ongoingtable_name" class="form-control dont-select-me  search-table-field" dir="ltr" name="s">
      </select>
    </div>
    <div class="col-sm-3">
      <select id="ongoingtable_sr" class="form-control dont-select-me  search-tablesr-field" dir="ltr" name="ts">
      </select>
    </div>
    <div class="col-sm-6">
      <button class="btn btn-success pull-right" onclick="mergeorderlist()"><?php echo display('mergeord') ?></button>
    </div>
  </div>
  <div class="row">
    <?php 
									 if(!empty($ongoingorder)){
									 foreach($ongoingorder as $onprocess){
										 $billtotal=round($onprocess->totalamount-$onprocess->customerpaid);
										 
										 ?>
                                    <div class="col-sm-4 col-md-3 col-xs-6 col-xlg-2">
                                    	<?php if(!empty($onprocess->marge_order_id)){?>
                                      <div class="hero-widget well well-sm height-abg">
                                        <div class="mdjc">
                                          <label class="text-muted"><strong><?php echo display('table');?>:<?php echo $onprocess->tablename;?></strong></label>
                                          <?php if($this->permission->method('ordermanage','update')->access() && $onprocess->splitpay_status ==0):?>
                                          <div class="display-flex align-items-center">                                          
                                       <?php $margeinfo=$this->db->select('order_id')->from('customer_order')->where('marge_order_id',$onprocess->marge_order_id)->get()->result();
									   $allmergeid="";
									   foreach($margeinfo as $mergeord){
										   $allmergeid.=$mergeord->order_id.',';
									   } 
										$allorder=trim($allmergeid,',');
										?>
                                        <input name="margeid" id="allmerge_<?php echo $onprocess->marge_order_id;?>" type="hidden" value="<?php echo $allorder?>" />
                                        </div>
                                        <?php endif;?>
                                        </div>
                                        <p class="m-0">
                                          <label class="text-muted"><?php echo display('ord_num');?>:<?php echo $allorder;?></label>
                                        </p>
                                        <p class="m-0">
                                          <label class="text-muted"><?php echo display('waiter');?>:<?php echo $onprocess->first_name.' '.$onprocess->last_name;?></label>
                                        </p>
                                         <?php 
                                          $diff=0;
                                          $actualtime=date('H:i:s');
                                           $array1 = explode(':', $actualtime);
                                          $array2 = explode(':', $onprocess->order_time);
                                          $minutes1 = ($array1[0] * 3600.0 + $array1[1]*60.0+$array1[2]);
                                          $minutes2 = ($array2[0] * 3600.0 + $array2[1]*60.0+$array2[2]);
                                          $diff = $minutes1 - $minutes2;
                                          $format = sprintf('%02d:%02d:%02d', ($diff / 3600), ($diff / 60 % 60), $diff % 60);
                                          ?>
                                          <p class="m-0">
                                          <label class="text-muted"><?php echo display('before_time');?>:<?php echo  $format;?></label>
                                        </p>
                                        
                                          <div>
                                          <a href="javascript:;" onclick="duemergeorder(<?php echo $onprocess->order_id;?>,'<?php echo $onprocess->marge_order_id;?>')" class="btn btn-xs btn-success btn-sm mr-1"><?php echo display('cmplt');?></a>
                                           
                                            <?php if($this->permission->method('ordermanage','delete')->access()){?>
                                            <a href="javascript:;" data-id="<?php echo $onprocess->order_id;?>" class="btn btn-xs btn-danger btn-sm mr-1 cancelorder" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancel Order"><i class="fa fa-trash-o"></i></a>&nbsp;
                                            <?php }?>
                                            <a href="javascript:;" onclick="printmergeinvoice('<?php echo base64_encode($onprocess->marge_order_id);?>')" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Pos Invoice"><i class="fa fa-window-maximize"></i></a>&nbsp;<a href="javascript:;" class="btn btn-xs btn-success btn-sm mr-1 due_mergeprint" data-toggle="tooltip" data-placement="left" title="" data-url="<?php echo base_url("ordermanage/order/checkprintdue/".$onprocess->marge_order_id) ?>" data-original-title="Due Invoice"><i class="fa fa-window-restore"></i></a>
                                          </div>
                                          
                                      </div>
                                      <?php } else{?>
                                      <div class="hero-widget well well-sm height-auto">
                                        <div class="mdjc">
                                          <label class="text-muted"><strong><?php echo display('table');?>:<?php echo $onprocess->tablename;?></strong></label>
                                          <?php if($this->permission->method('ordermanage','update')->access() && $onprocess->splitpay_status ==0):?>
                                          <div class="display-flex align-items-center">
                                          <div class=""><a href="javascript:;" onclick="editposorder(<?php echo $onprocess->order_id;?>,1)" class="btn btn-xs btn-success btn-sm mr-1 pdmr" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update Order" id="table-<?php echo $onprocess->order_id;?>"><i class="fa fa-pencil"></i></a></div>
                                        <div class="kitchen-tab bd-pd-overflow">
                                          <input id='chkbox-<?php echo $onprocess->order_id;?>' type='checkbox' class="individual" name="margeorder" value="<?php echo $onprocess->order_id;?>"/>
                                          <label for='chkbox-<?php echo $onprocess->order_id;?>' class="mb-0"> 
                                            <span class="radio-shape mr-0"> <i class="fa fa-check"></i> </span> </label>
                                        </div>
                                        </div>
                                        <?php endif;?>
                                        </div>
                                        <p class="m-0">
                                          <label class="text-muted"><?php echo display('ord_num');?>:<?php echo $onprocess->saleinvoice;?></label>
                                        </p>
                                        <p class="m-0">
                                          <label class="text-muted"><?php echo display('waiter');?>:<?php echo $onprocess->first_name.' '.$onprocess->last_name;?></label>
                                        </p>
                                         <?php 
                                          $diff=0;
                                          
                                          $actualtime=date('H:i:s');
                                         
                                          $array1 = explode(':', $actualtime);
                                          $array2 = explode(':', $onprocess->order_time);
                                          $minutes1 = ($array1[0] * 3600.0 + $array1[1]*60.0+$array1[2]);
                                          $minutes2 = ($array2[0] * 3600.0 + $array2[1]*60.0+$array2[2]);
                                          $diff = $minutes1 - $minutes2;
                                          $format = sprintf('%02d:%02d:%02d', ($diff / 3600), ($diff / 60 % 60), $diff % 60);
                                          ?>
                                          <p class="m-0">
                                          <label class="text-muted"><?php echo display('before_time');?>:<?php echo  $format;?></label>
                                        </p>
                                        
                                          <div>
                                            <?php if($onprocess->splitpay_status ==0) { ?>
                                          <a href="javascript:;" onclick="createMargeorder(<?php echo $onprocess->order_id;?>,1)" class="btn btn-xs btn-success btn-sm mr-1"><?php echo display('cmplt');?></a>
                                           <a href="javascript:;" onclick="showsplitmodal(<?php echo $onprocess->order_id;?>)" class="btn btn-xs btn-success btn-sm mr-1"><?php echo display('split');?></a>
                                            <?php if($this->permission->method('ordermanage','delete')->access()){?>
                                            <a href="javascript:;" data-id="<?php echo $onprocess->order_id;?>" class="btn btn-xs btn-danger btn-sm mr-1 cancelorder" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancel Order"><i class="fa fa-trash-o"></i></a>&nbsp;
                                            <?php }?>
                                            <a href="javascript:;" onclick="createMargeorder(<?php echo $onprocess->order_id;?>,1)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Pos Invoice"><i class="fa fa-window-maximize"></i></a>&nbsp;<a href="javascript:;" class="btn btn-xs btn-success btn-sm mr-1 due_print" data-toggle="tooltip" data-placement="left" title="" data-url="<?php echo base_url("ordermanage/order/dueinvoice/".$onprocess->order_id) ?>" data-original-title="Due Invoice"><i class="fa fa-window-restore"></i></a>
                                            <?php }
                                            else{ ?>
                                               <a href="javascript:;" onclick="showsplitmodal(<?php echo $onprocess->order_id;?>)" class="btn btn-xs btn-success btn-sm mr-1"><?php echo display('split');?></a>
                                               <br><br>
                                              <?php
                                            }?>
                                
                                          </div>
                                          
                                      </div>
                                      <?php } ?>
                                    </div>
                                    <?php } }
									  else{ 
									   $odmsg=display('no_order_run');
									  echo "<p class='pl-12'>".$odmsg."</p>";
									  }
									 ?>
  </div>
</div>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/ongoing.js'); ?>" type="text/javascript"></script>

