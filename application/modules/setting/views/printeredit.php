<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <?php echo  form_open('setting/kitchensetting/addprinter') ?>
                    <?php echo form_hidden('kitchenid', (!empty($intinfo->kitchenid)?$intinfo->kitchenid:null)) ?>
                        <div class="form-group row">
                      	<label for="kitchenname" class="col-sm-4 col-form-label"><?php echo display('kitchen_name') ?> *</label>
                            <div class="col-sm-8">
                            <select name="kitchenname" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <?php foreach($allkitchen as $kitchen){?>
                                <option value="<?php echo $kitchen->kitchenid;?>" <?php if($intinfo->kitchenid==$kitchen->kitchenid){ echo "Selected";}?>><?php echo $kitchen->kitchen_name;?></option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                      		<label for="ipaddress" class="col-sm-4 col-form-label"><?php echo display('ip_address') ?> *</label>
                            <div class="col-sm-8">
                          <input name="ipaddress" class="form-control" type="text" placeholder="<?php echo display('ip_address') ?>" id="ipaddress" value="<?php echo (!empty($intinfo->ip)?$intinfo->ip:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                      		<label for="ipport" class="col-sm-4 col-form-label"><?php echo display('ip_port') ?> *</label>
                            <div class="col-sm-8">
                          <input name="ipport" class="form-control" type="text" placeholder="<?php echo display('ip_port') ?>" id="ipport" value="<?php echo (!empty($intinfo->port)?$intinfo->port:null) ?>">
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