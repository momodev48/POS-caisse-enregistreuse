<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('setting/country_city_list/createstate') ?>
                    <?php echo form_hidden('stateid', (!empty($intinfo->stateid)?$intinfo->stateid:null)) ?>
                        <div class="form-group row">
                        <label for="country" class="col-sm-4 col-form-label"><?php echo display('country') ?></label>
                        <div class="col-sm-8 customesl">
                            <select name="country" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <?php foreach($country as $single){?>
                                <option value="<?php echo $single->countryid;?>" <?php if($intinfo->countryid==$single->countryid){ echo "selected";}?>><?php echo $single->countryname;?></option>
                                <?php } ?>
                              </select>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="state" class="col-sm-4 col-form-label"><?php echo display('state') ?> *</label>
                            <div class="col-sm-8">
                                <input name="state" class="form-control" type="text" placeholder="Add <?php echo display('state') ?>" id="tablename" value="<?php echo (!empty($intinfo->statename)?$intinfo->statename:null) ?>">
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