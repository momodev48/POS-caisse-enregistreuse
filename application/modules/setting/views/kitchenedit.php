<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <?php echo  form_open('setting/kitchensetting/create') ?>
                    <?php echo form_hidden('kitchenid', (!empty($intinfo->kitchenid)?$intinfo->kitchenid:null)) ?>
                        <div class="form-group row">
                      	<label for="kitchenname" class="col-sm-4 col-form-label"><?php echo display('kitchen_name') ?> *</label>
                            <div class="col-sm-8">
                          <input name="kitchenname" class="form-control" type="text" placeholder="<?php echo display('kitchen_name') ?>" id="kitchenname" value="<?php echo (!empty($intinfo->kitchen_name)?$intinfo->kitchen_name:null) ?>">
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