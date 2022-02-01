<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
            		
                <?php 
                
				echo form_open_multipart('dashboard/setting/create','class="form-inner"') ?>
                    <?php echo form_hidden('id',$setting->id) ?>

                    <div class="form-group row">
                        <label for="title" class="col-xs-3 col-form-label"><?php echo display('application_title') ?> <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="title" type="text" class="form-control" id="title" placeholder="<?php echo display('application_title') ?>" value="<?php echo $setting->title ?>">
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="stname" class="col-xs-3 col-form-label"><?php echo display('store_name'); ?></label>
                        <div class="col-xs-9">
                            <input name="stname" type="text" class="form-control" id="stname" placeholder="<?php echo display('store_name') ?>" value="<?php echo $setting->storename ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?></label>
                        <div class="col-xs-9">
                            <input name="address" type="text" class="form-control" id="address" placeholder="<?php echo display('address') ?>"  value="<?php echo $setting->address ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-xs-3 col-form-label"><?php echo display('email')?></label>
                        <div class="col-xs-9">
                            <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email')?>"  value="<?php echo $setting->email ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                        <div class="col-xs-9">
                            <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo display('phone') ?>"  value="<?php echo $setting->phone ?>" >
                        </div>
                    </div>


                    <!-- if setting favicon is already uploaded -->
                    <?php if(!empty($setting->favicon)) {  ?>
                    <div class="form-group row">
                        <label for="faviconPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($setting->favicon) ?>" alt="Favicon" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="favicon" class="col-xs-3 col-form-label"><?php echo display('favicon') ?> </label>
                        <div class="col-xs-9">
                            <input type="file" name="favicon" id="favicon">
                            <input type="hidden" name="old_favicon" value="<?php echo $setting->favicon ?>">
                        </div>
                    </div>


                    <!-- if setting logo is already uploaded -->
                    <?php if(!empty($setting->logo)) {  ?>
                    <div class="form-group row">
                        <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($setting->logo) ?>" alt="Picture" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="logo" class="col-xs-3 col-form-label"><?php echo display('logo') ?></label>
                        <div class="col-xs-9">
                            <input type="file" name="logo" id="logo">
                            <input type="hidden" name="old_logo" value="<?php echo $setting->logo ?>">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('opent') ?></label>
                        <div class="col-xs-9">
                            <input name="opentime" type="text" class="form-control" id="opentime" placeholder="<?php echo display('opent') ?>"  value="<?php echo $setting->opentime ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('closeTime') ?></label>
                        <div class="col-xs-9">
                            <input name="closetime" type="text" class="form-control" id="closetime" placeholder="<?php echo display('closeTime') ?>"  value="<?php echo $setting->closetime ?>" >
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('distype') ?></label>
                        <div class="col-xs-9">
                            <select class="form-control" name="dtype">
                            	<option value=""><?php echo display('sldistype') ?></option>
                                <option value="0" <?php if($setting->discount_type=="0"){ echo "selected";}?>><?php echo display('amount') ?></option>
                                <option value="1" <?php if($setting->discount_type=="1"){ echo "selected";}?>><?php echo display('percent') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('sl_se_ch_ty') ?></label>
                        <div class="col-xs-9">
                            <select class="form-control" name="sdtype">
                            	<option value=""><?php echo display('sl_se_ch_ty') ?></option>
                                <option value="0" <?php if($setting->service_chargeType=="0"){ echo "selected";}?>><?php echo display('amount') ?></option>
                                <option value="1" <?php if($setting->service_chargeType=="1"){ echo "selected";}?>><?php echo display('percent') ?></option>
                            </select>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('vatset') ?></label>
                        <div class="col-xs-9">
                            <input name="storevat" type="text" class="form-control" id="storevat" placeholder="<?php echo display('vat_tax') ?>"  value="<?php echo $setting->vat ?>" >
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('currency') ?></label>
                        <div class="col-xs-9">
                            <?php echo  form_dropdown('currency',$currencyList,$setting->currency, 'class="form-control"') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="delivary_time" class="col-xs-3 col-form-label"><?php echo display('mindeltime') ?></label>
                        <div class="col-xs-9">
                            <input name="delivary_time" type="text" class="form-control" id="delivary_time" placeholder="<?php echo display('mindeltime') ?>"  value="<?php echo $setting->min_prepare_time ?>" >
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('language') ?></label>
                        <div class="col-xs-9">
                            <?php echo  form_dropdown('language',$languageList,$setting->language, 'class="form-control"') ?>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('dateformat') ?></label>
                        <div class="col-xs-9">
                            <select class="form-control" name="timeformat">
                            	<option value=""><?php echo display('sedateformat') ?></option>
                                <option value="d/m/Y" <?php if($setting->dateformat=="d/m/Y"){ echo "selected";}?>>dd/mm/yyyy</option>
                                <option value="Y/m/d" <?php if($setting->dateformat=="Y/m/d"){ echo "selected";}?>>yyyy/mm/dd</option>
                                <option value="d-m-Y" <?php if($setting->dateformat=="d-m-Y"){ echo "selected";}?>>dd-mm-yyyy</option>
                                <option value="Y-m-d" <?php if($setting->dateformat=="Y-m-d"){ echo "selected";}?>>yyyy-mm-dd</option>
                                <option value="m/d/Y" <?php if($setting->dateformat=="m/d/Y"){ echo "selected";}?>>mm/dd/yyyy</option>
                                <option value="d M,Y" <?php if($setting->dateformat=="d M,Y"){ echo "selected";}?>>dd M,yyyy</option>
                                <option value="d F,Y" <?php if($setting->dateformat=="d F,Y"){ echo "selected";}?>>dd MM,yyyy</option>
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('site_align') ?></label>
                        <div class="col-xs-9">
                            <?php echo  form_dropdown('site_align', array('LTR' => display('left_to_right'), 'RTL' => display('right_to_left')) ,$setting->site_align, 'class="form-control"') ?>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="power_text" class="col-xs-3 col-form-label"><?php echo "Powered By Text";?></label>
                        <div class="col-xs-9">
                            <textarea name="power_text" class="form-control"  placeholder="Powered By Text" maxlength="140" rows="7"><?php echo $setting->powerbytxt ?></textarea>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="footer_text" class="col-xs-3 col-form-label"><?php echo display('footer_text') ?></label>
                        <div class="col-xs-9">
                            <textarea name="footer_text" class="form-control"  placeholder="Footer Text" maxlength="140" rows="7"><?php echo $setting->footer_text ?></textarea>
                        </div>
                    </div>   

                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>