 <?php 
 if(!empty($ongoingorder)){
 foreach($ongoingorder as $onprocess){
	 $billtotal=round($onprocess->totalamount);
	 $onprobill=$this->order_model->read('*', 'bill', array('order_id' => $onprocess->order_id));
	 $ispaid=0;
	if($onprocess->cutomertype==99 && $onprobill->bill_status==1){ 
		if($onprocess->customerpaid=='0.00'){$ispaid=1;}
		else if($onprocess->totalamount==$onprocess->customerpaid){$ispaid=1;}
		else {$ispaid=0;}
	} 
	 ?>
                                  		<div class="col-sm-2">
                                            <div class="hero-widget well well-sm height-auto">
                                                    <p class="m-0"><label class="text-muted"><strong><?php echo display('table');?>:<?php echo $onprocess->tablename;?></strong></label><small class="pull-right"><a href="<?php echo base_url("ordermanage/order/updateorder/".$onprocess->order_id) ?>" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update Order"><i class="fa fa-pencil"></i></a></small></p>
                                                    <p class="m-0"><label class="text-muted"><?php echo display('ord_num');?>:<?php echo $onprocess->saleinvoice;?></label></p>
                                                    <p class="m-0"><label class="text-muted"><?php echo display('waiter');?>:<?php echo $onprocess->first_name.' '.$onprocess->last_name;?></label></p>
                                                    <a href="javascript:;" onclick="payorderbill(4,<?php echo $onprocess->order_id;?>,'<?php echo $billtotal;?>')" class="btn btn-xs btn-success btn-sm mr-1"><?php echo display('cmplt');?></a>&nbsp;<a href="javascript:;" data-id="<?php echo $onprocess->order_id;?>" class="btn btn-xs btn-danger btn-sm mr-1 cancelorder" data-toggle="tooltip" data-placement="left" title="" data-original-title="Cancel Order"><i class="fa fa-trash-o"></i></a>&nbsp;<a href="javascript:;" onclick="payorderbill(10,<?php echo $onprocess->order_id;?>,'<?php echo $billtotal;?>')" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Pos Invoice"><i class="fa fa-window-maximize"></i></a>&nbsp;<?php if($ispaid==0){?><a onclick="pospageprintdue(<?php echo $onprocess->order_id;?>)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Due Invoice"><i class="fa fa-window-restore"></i></a><?php } ?>
                                            </div>
                                        </div>
                                     <?php } }
									 else{ echo "<p>".display('no_order_run')."</p>";}
									 ?>