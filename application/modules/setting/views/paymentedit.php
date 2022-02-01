<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('setting/paymentmethod/create') ?>
                    <?php echo form_hidden('payment_method_id', (!empty($intinfo->payment_method_id)?$intinfo->payment_method_id:null)) ?>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('unit_short_name') ?></label>
                            <div class="col-sm-8">
                                 <input name="payment" class="form-control" type="text" placeholder="<?php echo display('unit_short_name') ?>" id="payment" value="<?php echo (!empty($intinfo->payment_method)?$intinfo->payment_method:null) ?>">
                            </div>
                        </div> 
						<div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1" <?php if(!empty($intinfo)){if($intinfo->is_active==1){echo "Selected";}} ?>>Active</option>
                                <option value="0" <?php if(!empty($intinfo)){if($intinfo->is_active==0){echo "Selected";}} ?>>Inactive</option>
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