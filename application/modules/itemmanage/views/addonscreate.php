<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">


                <?php  
				echo form_open_multipart("itemmanage/menu_addons/create") ?>
                    
                   <?php  echo form_hidden('id',$this->session->userdata('id')); ?>
                     <?php echo form_hidden('add_on_id', (!empty($addonsinfo->add_on_id)?$addonsinfo->add_on_id:null)) ?>
                     <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label">Add-ons Name *</label>
                        <div class="col-sm-8">
                            <input name="addonsname" class="form-control" type="text" placeholder="Add-ons Name" id="addonsname"  value="<?php echo (!empty($addonsinfo->add_on_name)?$addonsinfo->add_on_name:null) ?>">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label">Price *</label>
                        <div class="col-sm-8">
                            <input name="addonsprice" class="form-control" type="text" placeholder="Add-ons Price" id="addonsprice"  value="<?php echo (!empty($addonsinfo->price)?$addonsinfo->price:null) ?>">
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                     <?php if(!empty($taxitems)){
                        $tx=0;
                        foreach ($taxitems as $taxitem) {
                           $field_name = 'tax'.$tx; 
                        ?>
                          <div class="form-group row">
                        <label for="vat" class="col-sm-3 col-form-label"><?php echo $taxitem['tax_name'];?></label>
                        <div class="col-sm-9">
                            
                            <input name="<?php echo $field_name;?>" type="text" class="form-control" id="<?php echo $field_name;?>" placeholder="<?php echo $taxitem['tax_name'];?>" autocomplete="off" value="<?php echo (!empty($addonsinfo->$field_name)?$addonsinfo->$field_name:null) ?>" />
                            </div>
                    </div>
                        <?php
                        $tx++;
                        }
                    }
                    ?>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1" <?php if(!empty($addonsinfo)){if($addonsinfo->is_active==1){echo "Selected";}} else{echo "Selected";} ?>>Active</option>
                                <option value="0" <?php if(!empty($addonsinfo)){if($addonsinfo->is_active==0){echo "Selected";}} ?>>Inactive</option>
                              </select>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                        <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                    </div>
                    </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>
