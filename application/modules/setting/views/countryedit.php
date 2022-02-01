<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('setting/country_city_list/create') ?>
                    <?php echo form_hidden('countryid', (!empty($intinfo->countryid)?$intinfo->countryid:null)) ?>
                        <div class="form-group row">
                            <label for="country" class="col-sm-4 col-form-label"><?php echo display('countryname') ?> *</label>
                            <div class="col-sm-8">
                                <input name="country" class="form-control" type="text" placeholder="Add <?php echo display('countryname') ?>" id="tablename" value="<?php echo (!empty($intinfo->countryname)?$intinfo->countryname:null) ?>">
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