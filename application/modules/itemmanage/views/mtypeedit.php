<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open_multipart('itemmanage/item_food/menutypecreate') ?>
                    <?php echo form_hidden('menutypeid', (!empty($intinfo->menutypeid)?$intinfo->menutypeid:null)) ?>
                        
                        <div class="form-group row">
                            <label for="menu_type_name" class="col-sm-4 col-form-label"><?php echo display('menu_type_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="menu_type_name" class="form-control" type="text" placeholder="<?php echo display('menu_type_name') ?>" id="menu_type_name" value="<?php echo (!empty($intinfo->menutype)?$intinfo->menutype:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('icon') ?></label>
                        <div class="col-sm-8">
                        <input type="file" accept="image/*" name="picture"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a> 
                          <small id="fileHelp" class="text-muted"><img src="<?php echo base_url(!empty($intinfo->menu_icon)?$intinfo->menu_icon:'assets/img/icons/default.jpg'); ?>" id="output" class="img-thumbnail add_cat_img_item_bg"/>
</small>
<input type="hidden" name="old_image" value="<?php echo (!empty($intinfo->menu_icon)?$intinfo->menu_icon:null) ?>">      
                        </div>
                    </div>
						<div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <select name="status"  class="form-control">
                                <option value="">Select Option</option>
                                <option value="1" <?php if(!empty($intinfo)){if($intinfo->status==1){echo "Selected";}} else{echo "Selected";} ?>>Active</option>
                                <option value="0" <?php if(!empty($intinfo)){if($intinfo->status==0){echo "Selected";}} else{echo "Selected";} ?>>Inactive</option>
                              </select>
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