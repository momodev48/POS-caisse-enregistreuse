                <?php echo  form_open('reservation/reservation/create') ?>
                    <?php echo form_hidden('reserveid', (!empty($intinfo->reserveid)?$intinfo->reserveid:null)) ?>
                        <div class="form-group row">
                        <label for="tableid" class="col-sm-4 col-form-label"><?php echo "Table No."; ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php echo $tableno;?>
                        <input name="tableid" type="hidden" value="<?php echo $tableno;?>" />
                        </div>
                    </div>
                       <div class="form-group row">
                        <label for="tablicapacity" class="col-sm-4 col-form-label"><?php echo "No. of People"; ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php echo $nopeople;?>
                        <input name="tablicapacity" class="form-control" type="hidden" id="tablicapacity" value="<?php echo $nopeople;?>">
                        </div>
                    </div> 
                        <div class="form-group row">
                            <label for="bookdate" class="col-sm-4 col-form-label"><?php echo display('date') ?> *</label>
                            <div class="col-sm-8">
                            	 <?php echo $newdate;?>
                                <input name="bookdate" class="form-control" type="hidden" id="bookdate" value="<?php echo $newdate;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bookfromtime" class="col-sm-4 col-form-label"><?php echo display('s_time') ?> *</label>
                            <div class="col-sm-8">
                             <?php echo $gettime;?>
                                <input name="bookfromtime" class="form-control" type="hidden" id="booktime" value="<?php echo $gettime;?>">
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="bookendtime" class="col-sm-4 col-form-label"><?php echo display('e_time') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bookendtime" class="form-control timepicker" type="text" placeholder="<?php echo display('e_time') ?>" id="booktime" value="<?php echo $endtime;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('name') ?>*</label>
                        <div class="col-sm-8">
                        <input name="customer_name" class="form-control" type="text" id="customer_name" value="<?php if(!empty($customerinfo)){ echo $customerinfo->customer_name;}?>" placeholder="<?php echo display('name') ?>">
                       
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('mobile') ?>*</label>
                        <div class="col-sm-8">
                        <input name="mobile" class="form-control" type="text" id="mobile" value="<?php if(!empty($customerinfo)){ echo $customerinfo->customer_phone;}?>" placeholder="<?php echo display('mobile') ?>">
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo display('email') ?>*</label>
                        <div class="col-sm-8">
                        <input name="email" class="form-control" type="text" id="email" value="<?php if(!empty($customerinfo)){ echo $customerinfo->customer_email;}?>" placeholder="<?php echo display('email') ?>">
                        </div>
                    </div>
						<div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="2">Booked</option>
                                <option value="1">Realease</option>
                              </select>
                        </div>
                    </div>
  
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close();?>