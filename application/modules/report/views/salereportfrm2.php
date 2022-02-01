<script src="<?php echo base_url('application/modules/report/assets/js/salereportfrm2.js'); ?>" type="text/javascript"></script>
<link href="<?php echo base_url('application/modules/report/assets/css/salereportfrm2.css'); ?>" rel="stylesheet" type="text/css"/>

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
		                <?php date_default_timezone_set("Asia/Dhaka"); $today = date('d-m-Y'); ?>
		                    <div class="form-group">
		                        <label class="" for="from_date"><?php echo display('start_date') ?></label>
		                        <input type="text" name="from_date" class="form-control datepicker" id="from_date" placeholder="<?php echo display('start_date') ?>" readonly="readonly" >
		                    </div> 

		                    <div class="form-group">
		                        <label class="" for="to_date"><?php echo display('end_date') ?></label>
		                        <input type="text" name="to_date" class="form-control datepicker" id="to_date" placeholder="<?php echo "To"; ?>" value="<?php echo $today?>" readonly="readonly">
		                    </div>
                            <div class="form-group">
		                        <label class="" for="discount"><?php echo "Type"; ?></label>
                                 <?php echo form_dropdown('ctypeoption',$ctypeoption,'','class="postform resizeselect form-control" id="ctypeoption"') ?>
		                    </div>
                           
 							<a id="mysreport" class="btn btn-success"><?php echo display('search') ?></a>
		                    <a  class="btn btn-warning print-salerpform2"  onclick="printDiv('purchase_div')"><?php echo "Print"; ?></a>
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
		                    <h4><?php echo display('sell_report') ?></h4>
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
								<table class="table table-bordered table-striped table-hover" id="myslreportsf">
			                        <thead>
										<tr>
											<th><?php echo "Sale Date"; ?></th>
                                            <th><?php echo "Invoice No."; ?></th>
											<th><?php echo "Customer ID"; ?></th>
                                            <th><?php echo "Waiter"; ?></th>
                                            <th><?php echo "Sales Type"; ?></th>
                                            <th><?php echo "Total Discount"; ?></th>
                                            <th><?php echo "Third Party Commission"; ?></th>
											<th><?php echo display('total_ammount'); ?></th>
										</tr>
									</thead>
									<tbody>
									
									</tbody>
									<tfoot class="salereportfrm2-foot">
										<tr>
                                        	<th class="center-cell"></th>
                                            <th class="center-cell"></th>
                                            <th class="center-cell"></th>
                                            <th class="center-cell"></th>
                                            <th class="right-cell">Total:</th>
                                            <th class="center-cell"></th>
                                            <th class="center-cell"></th>
                                            <th class="center-cell"></th>
                                        </tr>
									</tfoot>
			                    </table>
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
