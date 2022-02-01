
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo display('placr_setting') ?></legend>
                    </fieldset>
					<div class="row bg-brown">
                             <div class="col-sm-12 kitchen-tab" id="option">
                                                <input id="chkbox-1760" type="checkbox" class="individual placeord" name="waiter" value="waiter" <?php if($possetting->waiter==1){ echo "checked";}?>>
                                                <label for="chkbox-1760" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('waiter') ?>
                                                </label>
                                                <input id="chkbox-1761" type="checkbox" class="individual placeord" name="table" value="tableid" <?php if($possetting->tableid==1){ echo "checked";}?>>
                                                <label for="chkbox-1761" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('table') ?>
                                                </label>
                                                <input id="chkbox-1762" type="checkbox" class="individual placeord" name="cooktime" value="cooktime" <?php if($possetting->cooktime==1){ echo "checked";}?>>
                                                <label for="chkbox-1762" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('cookedtime') ?>
                                                </label>
                                                <input id="chkbox-1763" type="checkbox" class="individual placeord" name="tablemaping" value="tablemaping" <?php if($possetting->tablemaping==1){ echo "checked";}?>>
                                                <label for="chkbox-1763" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('table_map') ?>
                                                </label>
                                                <input id="chkbox-1764" type="checkbox" class="individual placeord" name="soundenable" value="soundenable" <?php if($possetting->soundenable==1){ echo "checked";}?>>
                                                <label for="chkbox-1764" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('is_sound') ?>
                                                </label>
                            </div>
                        </div>
                </div> 
                <div class="panel-body">
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo display('quick_ord') ?></legend>
                    </fieldset>
					<div class="row bg-brown">
                             <div class="col-sm-12 kitchen-tab" id="option">
                                                <input id="chkbox-1860" type="checkbox" class="individual quick" name="waiter" value="waiter" <?php if($quickorder->waiter==1){ echo "checked";}?>>
                                                <label for="chkbox-1860" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('waiter') ?>
                                                </label>
                                                <input id="chkbox-1861" type="checkbox" class="individual quick" name="table" value="tableid" <?php if($quickorder->tableid==1){ echo "checked";}?>>
                                                <label for="chkbox-1861" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('table') ?>
                                                </label>
                                                <input id="chkbox-1862" type="checkbox" class="individual quick" name="cooktime" value="cooktime" <?php if($quickorder->cooktime==1){ echo "checked";}?>>
                                                <label for="chkbox-1862" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('cookedtime') ?>
                                                </label>
                                                <input id="chkbox-1863" type="checkbox" class="individual quick" name="tablemaping" value="tablemaping" <?php if($quickorder->tablemaping==1){ echo "checked";}?>>
                                                <label for="chkbox-1863" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('table_map') ?>
                                                </label>
                                                <input id="chkbox-1864" type="checkbox" class="individual quick" name="soundenable" value="soundenable" <?php if($quickorder->soundenable==1){ echo "checked";}?>>
                                                <label for="chkbox-1864" class="display-inline-flex">
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                   <?php echo display('is_sound') ?>
                                                </label>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('application/modules/ordermanage/assets/js/possettingpage.js'); ?>" type="text/javascript"></script>
