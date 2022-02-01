<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong></strong>
            </div>
            <div class="modal-body addonsinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
<div class="row">
                   <div class="panel">
                     <div class="panel-body">
                     <div class="text-right"><a href="<?php echo base_url();?>ordermanage/order/kitchen" class="btn btn-primary btn-md"><i class="fa fa-load-circle" aria-hidden="true"></i>
<?php echo display('ref_page')?></a></div>
                          <ul class="nav nav-tabs mb-2" role="tablist">
                            
                            </ul>
                            
                            <!-- Tab panes -->
                            <div class="tab-content">
                            <h3> <?php echo display('ongoingorder')?></h3>
                              <div class="tab-pane fade active in"  id="profile">
                                  <div class="row" id="kitchenload">
                                  <?php 
									 if(!empty($ongoingorder)){
									 foreach($ongoingorder as $onprocess){
										 $billtotal=round($onprocess->totalamount);
										 if(($onprocess->orderacceptreject==0 || empty($onprocess->orderacceptreject)) && ($onprocess->cutomertype==2)){}
										 else{
										 ?>
                                  		<div class="col-sm-2">
                                            <div class="hero-widget well well-sm height-auto">
                                                    <p class="m-0"><label class="text-muted"><strong><?php echo display('table');?>:<?php echo $onprocess->tablename;?></strong></label></p>
                                                    <p class="m-0"><label class="text-muted"><strong><?php echo display('tok');?>:<?php echo $onprocess->tokenno;?></strong></label></p>
                                                    <p class="m-0"><label class="text-muted"><strong><?php echo display('cookedtime');?>:<?php echo $onprocess->cookedtime;?></strong></label></p>
                                                    <p class="m-0"><label class="text-muted"><?php echo display('ord');?>:<?php echo $onprocess->saleinvoice;?></label></p>
                                                    <p class="m-0"><label class="text-muted"><?php echo display('waiter');?>:<?php echo $onprocess->first_name.' '.$onprocess->last_name;?></label></p>
                                                    <a href="javascript:;" onclick="oredrready('<?php echo $onprocess->order_id;?>')" class="btn btn-xs btn-success btn-sm mr-1 display-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Order"><?php echo display('view_ord');?></a>
                                            </div>
                                        </div>
                                     <?php } } }
									  else{ 
									   $odmsg=display('no_order_run');
									  echo "<p style='padding-left:12px;'>".$odmsg."</p>";
									  }
									 ?>
                                  </div>
                              </div>
                            </div>
                      </div>
                   </div>
              </div>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/kitchen.js'); ?>" type="text/javascript"></script>
