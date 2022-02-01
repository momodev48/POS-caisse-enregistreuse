<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php  echo form_open_multipart("accounts/accounts/updatecoahead");?>
                    <?php echo form_hidden('HeadCode', (!empty($intinfo->HeadCode)?$intinfo->HeadCode:null)) ?>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-4 col-form-label"><?php echo "Head Name"; ?> *</label>
                            <div class="col-sm-8">
                                <input name="headname" class="form-control" type="text" placeholder="Add Head Name" id="headname" value="<?php echo (!empty($intinfo->HeadName)?$intinfo->HeadName:null) ?>" required>
                            </div>
                        </div>
  						<div class="form-group row">
                                    <label for="lastname" class="col-sm-6 col-form-label"><input type="checkbox" name="IsTransaction" value="1" <?php if($intinfo->IsTransaction==1){ echo "checked";}?> id="IsTransaction" size="28"><label for="IsTransaction"> Transaction</label>
        <input type="checkbox" value="1" name="IsActive" id="IsActive" <?php if($intinfo->IsActive==1){ echo "checked";}?> size="28"><label for="IsActive"> Active</label>
        <input type="checkbox" value="1" name="IsGL" <?php if($intinfo->IsGL==1){ echo "checked";}?> id="IsGL" size="28"><label for="IsGL"> GL</label></label>
                                    <div class="col-sm-6">
                                       <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                                        </div>
                                    </div>
                    			</div>
                    <?php echo form_close() ?>
                </div>  
            </div>
        </div>
    </div>