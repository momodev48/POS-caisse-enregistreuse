<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('setting/paymentmethod/psetupcreate') ?>
                   <?php echo form_hidden('setupid', (!empty($intinfo->setupid)?$intinfo->setupid:null)) ?>
                     <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('payment_name') ?> *</label>
                            <div class="col-sm-8 customesl">
                                <?php if(empty($paymentlist)){$paymentlist = array('' => '--Select--');}
						echo form_dropdown('payment',$paymentlist,(!empty($intinfo->paymentid)?$intinfo->paymentid:null),'class="form-control" id="payment" required') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php if($intinfo->paymentid=='8'){ echo "Application ID";}elseif($intinfo->paymentid=='13') {echo "Api Key";}else{echo display('marchantid');} ?></label>
                            <div class="col-sm-8">
                                <!-- iyzico -->
                                 <input name="marchantid" class="form-control" type="text" placeholder="<?php if($intinfo->paymentid=='8'){ echo "Application ID";} else if($intinfo->paymentid=='13') {echo "API Key";} else{echo display('marchantid');} ?>" value="<?php echo (!empty($intinfo->marchantid)?$intinfo->marchantid:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                               <!-- iyzico -->
                            <label for="payment" class="col-sm-4 col-form-label"><?php if($intinfo->paymentid=='8'){ echo "Access Token";}elseif($intinfo->paymentid=='13') {echo "Security Key";}else{echo display('password');} ?></label>
                            <div class="col-sm-8">
                                 <input name="password" class="form-control" type="password" placeholder="<?php if($intinfo->paymentid=='8'){ echo "Access Token";}else{echo display('password');} ?>" value="<?php echo (!empty($intinfo->password)?$intinfo->password:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php if($intinfo->paymentid=='8'){ echo "Location ID";}else{echo display('email');} ?></label>
                            <div class="col-sm-8">
                                 <input name="email" class="form-control" type="text" placeholder="<?php if($intinfo->paymentid=='8'){ echo "Location ID";}else{echo display('email');} ?>" value="<?php echo (!empty($intinfo->email)?$intinfo->email:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('currency') ?> *</label>
                            <div class="col-sm-8 customesl">
                                <?php if(empty($currency_list)){$currency_list = array('' => '--Select--');}
						echo form_dropdown('currency',$currency_list,(!empty($intinfo->currency)?$intinfo->currency:null),'class="form-control" id="currency" ') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="islive" class="col-sm-4 col-form-label">Is Live or Test</label>
                        <div class="col-sm-8 customesl">
                            <select name="islive" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                 <option value="1" <?php if(!empty($intinfo)){if($intinfo->Islive==1){echo "Selected";}} ?>>Live</option>
                                <option value="0" <?php if(!empty($intinfo)){if($intinfo->Islive==0){echo "Selected";}} ?>>Test Mode</option>
                              </select>
                        </div>
                    </div>
						<div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1" <?php if(!empty($intinfo)){if($intinfo->status==1){echo "Selected";}} ?>>Active</option>
                                <option value="0" <?php if(!empty($intinfo)){if($intinfo->status==0){echo "Selected";}} ?>>Inactive</option>
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