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
				echo form_open_multipart('dashboard/web_setting/common_create','class="form-inner"') ?>
                    <?php echo form_hidden('id',$websetting->id) ?>
                    <div class="form-group row">
                        <label for="email" class="col-xs-3 col-form-label"><?php echo display('email')?></label>
                        <div class="col-xs-9">
                            <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo display('email')?>"  value="<?php echo $websetting->email ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-xs-3 col-form-label"><?php echo display('mobile') ?></label>
                        <div class="col-xs-9">
                            <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo display('mobile') ?>"  value="<?php echo $websetting->phone ?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone2" class="col-xs-3 col-form-label"><?php echo display('phone') ?></label>
                        <div class="col-xs-9">
                            <input name="phone2" type="text" class="form-control" id="phone2" placeholder="<?php echo display('phone') ?>"  value="<?php echo $websetting->phone_optional ?>" >
                        </div>
                    </div>

                    <!-- if setting logo is already uploaded -->
                    <?php if(!empty($websetting->logo)) {  ?>
                    <div class="form-group row">
                        <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($websetting->logo) ?>" alt="Picture" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="logo" class="col-xs-3 col-form-label"><?php echo display('logo') ?></label>
                        <div class="col-xs-9">
                            <input type="file" name="logo" id="logo">
                            <input type="hidden" name="old_logo" value="<?php echo $websetting->logo ?>">
                        </div>
                    </div>
                    <?php if(!empty($websetting->logo_footer)) {  ?>
                    <div class="form-group row">
                        <label for="logoPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($websetting->logo_footer) ?>" alt="Picture" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="logofooter" class="col-xs-3 col-form-label"><?php echo display('footer_logo') ?></label>
                        <div class="col-xs-9">
                            <input type="file" name="logofooter" id="logofooter">
                            <input type="hidden" name="old_footerlogo" value="<?php echo $websetting->logo_footer ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone2" class="col-xs-3 col-form-label"><?php echo display('webdisable') ?></label>
                        <div class="col-sm-9 customesl">
                            <select name="websiteonoff" class="form-control">
                                <option value=""><?php echo display('select_option') ?></option>
                                <option value="1" <?php if($websetting->web_onoff==1){ echo "selected";}?>><?php echo display('webon') ?></option>
                                <option value="0" <?php if($websetting->web_onoff==0){ echo "selected";}?>><?php echo display('weboff') ?></option>
                              </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="membershipenable" class="col-xs-3 col-form-label"><?php echo display('membershipenable') ?></label>
                        <div class="col-sm-9 customesl">
                            <select name="membershipenable" class="form-control">
                                <option value=""><?php echo display('select_option') ?></option>
                                <option value="1" <?php if($websetting->ismembership==1){ echo "selected";}?>><?php echo display('active') ?></option>
                                <option value="0" <?php if($websetting->ismembership==0){ echo "selected";}?>><?php echo display('inactive') ?></option>
                              </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-xs-3 col-form-label"><?php echo display('address') ?></label>
                        <div class="col-xs-9">                            
                            <textarea name="address" id="address" class="form-control tinymce2"  placeholder="<?php echo display('address') ?>"  rows="4"><?php echo $websetting->address ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="power_text" class="col-xs-3 col-form-label"><?php echo display('powered_by') ?></label>
                        <div class="col-xs-9">
                            <textarea name="power_text" class="form-control"  placeholder="Powered By Text" maxlength="140" rows="3"><?php echo $websetting->powerbytxt ?></textarea>
                        </div>
                    </div> 
                    <?php 	$scan = scandir('application/modules/');
							$qrm="";
							foreach($scan as $file) {
							   if($file=="qrapp"){
								   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
								   $qrm=1;
								   }
								   }
							}
							if($qrm==1){
							?>
                    <div class="form-group row">
                    	<label for="qrbgcolor" class="col-xs-3 col-form-label">QR Header Color</label>
                    	<div class="col-xs-3">
                      		<input name="headercolor" class="form-control" type="color" value="<?php echo $websetting->backgroundcolorqr ?>" id="headercolor">
                        </div>
                        <label for="qrfontcolor" class="col-xs-3 col-form-label">QR Header Font Color</label>
                        <div class="col-xs-3">
                      		<input name="headerfontcolor" class="form-control" type="color" value="<?php echo $websetting->qrheaderfontcolor ?>" id="headerfontcolor">
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

