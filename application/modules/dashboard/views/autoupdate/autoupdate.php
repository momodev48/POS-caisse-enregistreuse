<link href="<?php echo base_url('application/modules/dashboard/assest/css/autoupdate.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
            <?php if ($latest_version!=$current_version) { ?>
                <?php echo form_open_multipart("dashboard/autoupdate/update") ?>
                    <div class="row">
                        <div class="form-group col-lg-8 col-sm-offset-2 autoupdate-blink">
                            <blink class="text-success text-center"><?php echo @$message_txt ?></blink>
                            <blink class="text-waring text-center"><?php echo @$exception_txt ?></blink>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="alert alert-success text-center autoupdate_line_height_font"><?php echo display('latestv')?> <br>V-<?php echo $latest_version ?></div>
                                </div> 
                                <div class="col-lg-6">
                                	<span class="autoupdate_pos_bg_color"><?php echo display('after19')?></span>
                                    <div class="alert alert-danger text-center autoupdate_line_font_18"><?php echo display('crver')?> <br>V-<?php echo $current_version ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="checkserver">
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-offset-3">
                            <p class="alert" id="errormsg" class="autoupdate_line_font_doted"><?php echo "Before Update Check Your Server requirement for Update script.Check Your server php allow_url_fopen is enable,memory Limit More than 100M and max execution time is 300 or more";?></p>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success col-sm-offset-5" onclick="checkserver()"><i class="fa fa-wrench" aria-hidden="true"></i> <?php echo "Check server";?></button>
                        <button type="button" class="btn btn-success" onclick="autoupdateoff(<?php echo $latest_version;?>)"><i class="fa fa-close" aria-hidden="true"></i> Notification Off</button>
                    </div>
                    </div>
                    <div id="serverok" class="autoupdate_d_none">
                    <div class="row">
                        <div class="form-group col-lg-6 col-sm-offset-3">
                        	 <p class="alert"  class="autoupdate_line_font_doted">Note: If you want to update software,you Must have immediate previous version.</p>
                            <p class="alert" class="autoupdate_line_font_doted"><?php echo display('notesupdate')?><a href="<?php echo base_url()?>dashboard/autoupdate/download_backup"  class="btn btn-success col-sm-offset-5"><i class="fa fa-database" aria-hidden="true"></i> Download Database</a></p>
                            <label><?php echo display('lic_pur_key')?><span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="purchase_key">
                        </div>
                        <div class="form-group col-lg-6 col-sm-offset-3">                           
                            <label><?php echo "Select Version";?><span class="text-danger">*</span></label>
                            <select name="version"  class="form-control">
                            <option value=""  selected="selected"><?php echo display('select_option') ?></option>
                           		<?php $start=$latest_version-0.4;
								for($i=$current_version+0.1;$i<=$latest_version;$i+=0.1){
								?>
                                <option value="<?php echo number_format((float)$i, 1, '.', '');?>"><?php echo "Bhojon-v".number_format((float)$i, 1, '.', '');?></option>
                                <?php } ?>
                               
                              </select>
                              <p><a href="https://forum.bdtask.com" target="_blank">Do you Need support?</a> </p>
                        </div>
                    </div> 
                    <div>
                        <button type="submit" class="btn btn-success col-sm-offset-5" onclick="return confirm('are you sure want to update?')"><i class="fa fa-wrench" aria-hidden="true"></i> <?php echo display('update')?></button>
                        
                    </div>
                    </div>
                <?php echo form_close() ?>

                <?php } else{  ?>
                    <div class="row">
                        <div class="form-group col-lg-4 col-sm-offset-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-success text-center autoupdate_line_height_font" ><?php echo display('crver')?> <br>V-<?php echo $current_version ?></div>
                                    <h2 class="text-center"><?php echo display('noupdates')?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('application/modules/dashboard/assest/js/form.js'); ?>" type="text/javascript"></script>
 