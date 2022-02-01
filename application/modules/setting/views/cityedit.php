<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('setting/country_city_list/createcity') ?>
                    <?php echo form_hidden('cityid', (!empty($intinfo->cityid)?$intinfo->cityid:null)) ?>
                    	<input name="country1" type="hidden" value="<?php echo (!empty($intinfo->countryid)?$intinfo->countryid:null) ?>" id="country2"/>
                        <input name="state" type="hidden" value="e" />
                        <input name="city" type="hidden" value="d" />
                        <div class="form-group row">
                        <label for="state" class="col-sm-4 col-form-label"><?php echo display('country') ?></label>
                        <div class="col-sm-8 customesl">
                            <select name="state1" id="state2" class="form-control" onchange="getcountry()">
                                <option value=""  selected="selected">Select Option</option>
                                <?php foreach($allstate as $single){?>
                                <option value="<?php echo $single->stateid;?>" <?php if($intinfo->stateid==$single->stateid){ echo "selected";}?> data-title="<?php echo $single->countryid;?>"><?php echo $single->statename;?></option>
                                <?php } ?>
                              </select>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="city" class="col-sm-4 col-form-label"><?php echo display('city') ?> *</label>
                            <div class="col-sm-8">
                                <input name="city1" class="form-control" type="text" placeholder="Add <?php echo display('city') ?>" id="city" value="<?php echo (!empty($intinfo->cityname)?$intinfo->cityname:null) ?>">
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

    <script src="<?php echo base_url('application/modules/setting/assets/js/cityedit.js'); ?>" type="text/javascript"></script>