<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo display('production_add')?></legend>
                    </fieldset>
                    <?php echo form_open_multipart('production/production/insert_production',array('class' => 'form-vertical', 'id' => 'insert_production','name' => 'insert_production'))?>
                    <div class="row">
                             <div class="col-sm-4">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-5 col-form-label"><?php echo display('item_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <?php 
						if(empty($item)){$item = array('' => '--Select--');}
						echo form_dropdown('foodid',$item,(!empty($item->ProductsID)?$item->ProductsID:null),'class="form-control" id="foodid"') ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-4">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-5 col-form-label"><?php echo display('varient_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <?php 
						if(empty($item)){$item = array('' => '--Select--');}
						echo form_dropdown('foodvarientid','','','class="form-control" id="foodvarientid"') ?>
                                    </div>
                                </div> 
                            </div>
                             <div class="col-sm-4">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-5 col-form-label"><?php echo display('production')?> <?php echo display('date')?><i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                 <input type="text" class="form-control datepicker" name="production_date" value="<?php echo date('d-m-Y');?>" id="production_date" required="" tabindex="2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                             <div class="col-sm-4">
                               <div class="form-group row">
                                    <label for="quantity" class="col-sm-5 col-form-label"><?php echo display('serving_unit')?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="pro_qty" value="" id="pro_qty" required="" tabindex="3" onkeyup="checkavailablity()">
                                    </div>
                                </div> 
                               
                            </div>
                            <div class="col-sm-4">
                            <div class="form-group row">
                                    <label for="date" class="col-sm-5 col-form-label"><?php echo display('expdate')?><i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-7">
                                 <input type="text" class="form-control datepicker" name="expire_date" value="<?php echo date('d-m-Y');?>" id="expire_date" required="" tabindex="2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                	<div class="col-sm-2"><input type="submit" id="add_production" class="btn btn-success btn-large" name="add-purchase" value="<?php echo display('submit') ?>"></div>
                            	</div>
                            </div>
                        </div>
                     
                        </form>
                </div> 
            </div>
        </div>
    </div>
<script src="<?php echo base_url('application/modules/production/assets/js/production.js'); ?>" type="text/javascript"></script>