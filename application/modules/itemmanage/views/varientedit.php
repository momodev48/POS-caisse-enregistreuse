<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo form_open('itemmanage/item_food/varientcreate'); ?>
                   	<?php echo form_hidden('variantid', (!empty($intinfo->variantid)?$intinfo->variantid:null)) ?>
                        <div class="form-group row">
                        <label for="itemname" class="col-sm-4 col-form-label"><?php echo display('item_name') ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php 
						if(empty($itemdropdown)){$itemdropdown = array('' => '--Select--');}
						echo form_dropdown('foodid',$itemdropdown,(!empty($intinfo->menuid)?$intinfo->menuid:null),'class="form-control"') ?>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="varientname" class="col-sm-4 col-form-label"><?php echo display('varient_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="varientname" class="form-control" type="text" placeholder="<?php echo display('add_varient') ?>" id="unitname" value="<?php echo (!empty($intinfo->variantName)?$intinfo->variantName:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label"><?php echo display('price') ?> *</label>
                            <div class="col-sm-8">
                                <input name="price" class="form-control" type="text" placeholder="<?php echo display('price') ?>" id="price" value="<?php echo (!empty($intinfo->price)?$intinfo->price:null) ?>"><a class="cattooltips" data-toggle="tooltip" data-placement="top" title=""><?php echo $currency->curr_icon;?></i></a>
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