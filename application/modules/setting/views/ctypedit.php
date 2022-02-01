<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('setting/customertype/create') ?>
                    <?php echo form_hidden('customer_type_id', (!empty($intinfo->customer_type_id)?$intinfo->customer_type_id:null)) ?>
                        <div class="form-group row">
                            <label for="typename" class="col-sm-4 col-form-label"><?php echo display('type_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="typename" class="form-control" type="text" placeholder="Add <?php echo display('type_name') ?>" id="tablename" value="<?php echo (!empty($intinfo->customer_type)?$intinfo->customer_type:null) ?>">
                            </div>
                        </div>
  						
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>