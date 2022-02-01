<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('setting/thirdpratycustomer/create') ?>
                    <?php echo form_hidden('companyId', (!empty($intinfo->companyId)?$intinfo->companyId:null)) ?>
                    	<div class="form-group row">
                            <label for="3rdcompany_name" class="col-sm-4 col-form-label"><?php echo display('3rdcompany_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="3rdcompany_name" class="form-control" type="text" placeholder="<?php echo display('3rdcompany_name') ?>" id="3rdcompany_name" value="<?php echo (!empty($intinfo->company_name)?$intinfo->company_name:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="commision" class="col-sm-4 col-form-label"><?php echo display('commision') ?>(%) *</label>
                            <div class="col-sm-8">
                                <input name="commision" class="form-control" type="text" placeholder="<?php echo display('commision') ?>" id="commision" value="<?php echo (!empty($intinfo->commision)?$intinfo->commision:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label"><?php echo display('address') ?> *</label>
                            <div class="col-sm-8">
                               <textarea name="address" cols="30" rows="3" class="form-control" placeholder="<?php echo display('address') ?>" id="address"><?php echo (!empty($intinfo->address)?$intinfo->address:null) ?></textarea>
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