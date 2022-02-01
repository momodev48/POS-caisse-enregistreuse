
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('add_expense_item')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?php echo  form_open_multipart('hrm/Cexpense/create_expense_item') ?>
                                <div class="row">
                          <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('expense_item_name') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="expense_item_name" id="expense_item_name" class="form-control" value="" required="">

                                    </div>
                                </div>
                            </div>
                         <div class="col-sm-12">
						 <div class="form-group row">   
                        	<label for="action" class="col-sm-4 col-form-label">&nbsp;</label> 
                            <div class="col-sm-8">                              
                        		<input type="submit" id="add_expense_item" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" />
                            </div>
                        </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>
    </div>
</div>
</div>
