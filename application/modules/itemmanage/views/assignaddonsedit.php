<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo form_open('itemmanage/menu_addons/assignaddonscreate'); ?>

                    <?php echo form_hidden('row_id', (!empty($addonsinfo->row_id)?$addonsinfo->row_id:null)) ?>
						<div class="form-group row">
                        <label for="addonsid" class="col-sm-4 col-form-label"><?php echo display('addons_name') ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php 
						if(empty($addonsmenulist)){$addonsmenulist = array('' => '--Select--');}
						echo form_dropdown('addonsid',$addonsdropdown,(!empty($addonsinfo->add_on_id)?$addonsinfo->add_on_id:null),'class="form-control"') ?>
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="menuid" class="col-sm-4 col-form-label"><?php echo display('item_name') ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php 
						if(empty($addonsmenulist)){$addonsmenulist = array('' => '--Select--');}
						echo form_dropdown('menuid',$menudropdown,(!empty($addonsinfo->menu_id)?$addonsinfo->menu_id:null),'class="form-control"') ?>
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