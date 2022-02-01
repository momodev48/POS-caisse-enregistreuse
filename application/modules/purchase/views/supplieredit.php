<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('purchase/supplierlist/create') ?>
                    <?php echo form_hidden('supid', (!empty($intinfo->supid)?$intinfo->supid:null)) ?>
                    <input name="oldname" type="hidden" value="<?php echo $intinfo->suplier_code.'-'.$intinfo->supName;?>" />
                    <input name="supcode" type="hidden" value="<?php echo $intinfo->suplier_code;?>" />
                        <div class="form-group row">
                            <label for="suppliername" class="col-sm-5 col-form-label"><?php echo display('supplier_name') ?> *</label>
                            <div class="col-sm-7">
                                <input name="suppliername" class="form-control" type="text" placeholder="Add <?php echo display('supplier_name') ?>" id="suppliername" value="<?php echo (!empty($intinfo->supName)?$intinfo->supName:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-5 col-form-label"><?php echo display('email') ?> </label>
                            <div class="col-sm-7">
                                <input name="email" class="form-control" type="email" placeholder="Add <?php echo display('email') ?>" id="email" value="<?php echo (!empty($intinfo->supEmail)?$intinfo->supEmail:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-5 col-form-label"><?php echo display('mobile') ?> *</label>
                            <div class="col-sm-7">
                                <input name="mobile" class="form-control" type="text" placeholder="Add <?php echo display('mobile') ?>" id="mobile" value="<?php echo (!empty($intinfo->supMobile)?$intinfo->supMobile:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-5 col-form-label"><?php echo display('address') ?></label>
                            <div class="col-sm-7">
                        <textarea name="address" cols="50" rows="3" class="form-control" placeholder="Add <?php echo display('address') ?>" id="address" ><?php echo (!empty($intinfo->supAddress)?$intinfo->supAddress:null) ?></textarea>
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