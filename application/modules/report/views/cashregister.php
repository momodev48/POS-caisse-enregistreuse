<script src="<?php echo base_url('application/modules/report/assets/js/cashregister.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('application/modules/report/assets/css/cashregister.css'); ?>" rel="stylesheet" type="text/css"/>

<div id="orderdetailsp" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong>
        
        </strong> </div>
      <div class="modal-body orddetailspop"> </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>
<div class="row">

	   
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo $title; ?></legend>
                    </fieldset>
                    <div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body"> 
		                <?php echo form_open('report/index',array('class' => 'form-inline'))?>
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('Y-m-d'); 
		               $statdate = date('Y-m-d', strtotime('first day of this month'));?>
		                    <div class="form-group">
		                        <label class="" for="from_date"><?php echo display('start_date') ?></label>
		                       
		                        <input type="text" name="from_date" value="<?php echo $statdate?>" class="form-control datepicker5" id="from_date" placeholder="<?php echo display('start_date') ?>" readonly="readonly" >
		                    </div> 

		                    <div class="form-group">
		                        <label class="" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker5" id="to_date" placeholder="<?php echo "To"; ?>" value="<?php echo $today?>" readonly="readonly">
		                    </div>
                            <?php if(!empty($alluser)){?> 
                            <div class="form-group">
		                    	 <?php echo form_dropdown('user',$alluser,'','class="postform resizeselect form-control " id="user"') ?>
		                    </div> 
		                   <?php } ?> 
                           <?php if(!empty($allcounter)){?> 
                            <div class="form-group">
		                    	 <?php echo form_dropdown('counterno',$allcounter,'','class="postform resizeselect form-control " id="counterno"') ?>
		                    </div> 
		                   <?php } ?> 
		                 
		                   
		                    <a  class="btn btn-success" onclick="getreportcash()"><?php echo display('search') ?></a>
                           
		                    <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo "Print"; ?></a>
		                   </div>
		                  
 							
		               <?php echo form_close()?>
		            </div>
		        </div>
		    </div>
	    </div>
					<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('table'); ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		            	<div id="purchase_div">
			            	<div class="text-center">
								<h3> <?php echo $setting->storename;?> </h3>
								<h4><?php echo $setting->address;?> </h4>
								<h4> <?php echo "Print Date" ?>: <?php echo date("d/m/Y h:i:s"); ?> </h4>
							</div>
			                <div class="table-responsive" id="getresult2">
			                    
			                </div>
			            </div>
			            <div class="text-right">
			            </div>
		            </div>
		        </div>
		    </div>
		</div>
                </div> 
            </div>
        </div>
    </div>

