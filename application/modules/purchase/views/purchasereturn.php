<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
					<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-body">
                     <?php echo form_open('purchase/purchase/purchase_return_entry',array('class' => 'form-vertical','id'=>'purchase_return' ))?>
							<div class="col-sm-12">
                              <div class="form-group">
                              <label for="supplier" class="col-sm-2"><?php echo display('supplier_name') ?>:</label>
                              <div class="col-sm-3">
                                  <?php echo form_dropdown('supplier_id',$supplier,(!empty($supplier->supplier_id)?$supplier->supplier_id:null), 'class="form-control" id="supplier_id" onchange="getinvoice()" tabindex="1" required') ?>
                                  </div>
                               <label for="supplier" class="col-sm-1"><?php echo display('invoice') ?>:</label>
                               <div class="col-sm-3" id="invoicelist">
                                 <select name="invoice" id="invoice" class="form-control">
                                	<option value=""  selected="selected">Select Option</option>
                              	 </select>
                                  </div>
                               <input name="invoiceurl" type="hidden" value="<?php echo base_url("purchase/purchase/getinvoice") ?>" id="invoiceurl" />
                               <input name="serachurl" type="hidden" value="<?php echo base_url("purchase/purchase/returnlist") ?>" id="serachurl" />
                               <button type="button" class="btn btn-success" onclick="showinvoice()"><?php echo display('search') ?></button>
                            </div> 
                            
                            </div> 
			                <div id="itemlist">
                            
			                    
			                </div>
                     <?php echo form_close()?>
		            </div>
		        </div>
		    </div>
		</div>
                </div> 
            </div>
        </div>
    </div>
<script src="<?php echo base_url('application/modules/purchase/assets/js/purchasereturn_script.js'); ?>" type="text/javascript"></script>