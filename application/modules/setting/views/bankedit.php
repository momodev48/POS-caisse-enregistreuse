<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open_multipart('setting/bank_list/create') ?>
                    <?php echo form_hidden('bankid', (!empty($intinfo->bankid)?$intinfo->bankid:null)) ?>
                    <?php echo form_hidden('signature_picold', (!empty($intinfo->signature_pic)?$intinfo->signature_pic:null)) ?>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-4 col-form-label"><?php echo display('bank_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bank_name" class="form-control" type="text" placeholder="Add <?php echo display('bank_name') ?>" id="bank_name" value="<?php echo (!empty($intinfo->bank_name)?$intinfo->bank_name:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ac_name" class="col-sm-4 col-form-label"><?php echo display('ac_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ac_name" id="ac_name" required="" placeholder="<?php echo display('ac_name') ?>" value="<?php echo (!empty($intinfo->ac_name)?$intinfo->ac_name:null) ?>" tabindex="2"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ac_no" class="col-sm-4 col-form-label"><?php echo display('ac_no') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ac_no" id="ac_no" required="" placeholder="<?php echo display('ac_no') ?>" value="<?php echo (!empty($intinfo->ac_number)?$intinfo->ac_number:null) ?>" tabindex="3"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="branch" class="col-sm-4 col-form-label"><?php echo display('branch1') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="branch" id="branch" required="" placeholder="<?php echo display('branch1') ?>" value="<?php echo (!empty($intinfo->branch)?$intinfo->branch:null) ?>" tabindex="4"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="signature_pic" class="col-sm-4 col-form-label"><?php echo display('signature_pic') ?></label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="signature_pic" id="signature_pic" placeholder="<?php echo display('signature_pic') ?>" tabindex="5" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="signature_pic" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <img src="<?php echo (!empty($intinfo->signature_pic)?$intinfo->signature_pic:null) ?>" class="img img-responsive" height="80" width="80">
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