				<?php echo  form_open('dashboard/web_setting/editwidget/'.$widget_info->widgetid,array('id'=>'widgeturl')) ?>
                        <div class="form-group row">
                            <label for="widgetname" class="col-sm-4 col-form-label"><?php echo display('widget_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="widgetname" id="widgetname" class="form-control" type="text" placeholder="<?php echo display('widget_name') ?>" value="<?php echo $widget_info->widget_name;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="widgettitle" class="col-sm-4 col-form-label"><?php echo display('widget_title') ?></label>
                            <div class="col-sm-8">
                                <input name="widgettitle" id="widgettitle" class="form-control" type="text" placeholder="<?php echo display('widget_title') ?>" value="<?php echo $widget_info->widget_title;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="widgettitle" class="col-sm-4 col-form-label"><?php echo display('widget_desc') ?></label>
                            <div class="col-sm-8">
                            	 <textarea name="widgetdesc" id="widgetdesc" class="form-control tinymce"  placeholder="<?php echo display('widget_desc') ?>"  rows="4"><?php echo $widget_info->widget_desc;?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="widgettitle" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                            <div class="col-sm-8 customesl">
                            <select name="status"  class="form-control">
                                <option value=""><?php echo display('select_option') ?></option>
                                <option value="1" <?php if($widget_info->status==1){ echo "selected";}?>><?php echo display('active') ?></option>
                                <option value="0" <?php if($widget_info->status==0){ echo "selected";}?>><?php echo display('inactive') ?></option>
                              </select>
                        	</div>
                        </div>
                        <div class="form-group text-right" id="upbtn">
                            <button type="submit" class="btn btn-success w-md m-b-5" id="btnchnage"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>
                    
<script src="<?php echo base_url('application/modules/dashboard/assest/js/banner.js'); ?>" type="text/javascript"></script>
