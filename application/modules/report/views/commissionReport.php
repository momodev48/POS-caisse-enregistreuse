<script src="<?php echo base_url('application/modules/report/assets/js/commissionReport.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('application/modules/report/assets/css/commissionReport.css'); ?>" rel="stylesheet" type="text/css"/>

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
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('d-m-Y'); 
		               $statdate = date('d-m-Y', strtotime('first day of this month'));?>
		                    <div class="form-group">
		                        <label class="" for="from_date"><?php echo display('start_date') ?></label>
		                       
		                        <input type="text" name="from_date" value="<?php echo $statdate?>" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" readonly="readonly" >
		                        <input type="hidden" name="" id="view_name" value="<?php echo $view; ?>">
		                    </div> 

		                    <div class="form-group">
		                        <label class="" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo "To"; ?>" value="<?php echo $today?>" readonly="readonly">
		                    </div> 
		                    <?php if(!empty($table_id) ){?>
		                    	<div class="form-group">
                            	 <label class="" for="orderid"><?php echo display('table').':'; echo $table_details->tablename;?></label>
		                    	
		                    </div>
		                    	 <input type="hidden" name="table_id" class="form-control" id="table_id" placeholder="" value="<?php echo $table_id;?>">
		                    <?php } else{?>
		                    	 <input type="hidden" name="table_id" class="form-control" id="table_id" placeholder="" value="">
		                    <?php }?>
		                 
		                   
		                    <a  class="btn btn-success" onclick="getreport()"><?php echo display('search') ?></a>
                            
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
		                    <h4><?php echo display('commission') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		            	<div id="purchase_div" style="margin-left:2px;">
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
