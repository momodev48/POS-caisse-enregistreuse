<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('reservation/reservation/unavailablecreate') ?>
                   	<?php echo form_hidden('offdayid', (!empty($intinfo->offdayid)?$intinfo->offdayid:null)) ?>
                        <div class="form-group row">
                        <label for="unavaildate" class="col-sm-4 col-form-label"><?php echo display('unavaildate')?>*</label>
                        <div class="col-sm-8">
                       		<input name="unavaildate" class="form-control" type="text" placeholder="<?php echo display('unavaildate')?>" id="unavaildate2" value="<?php echo $intinfo->offdaydate;?>" autocomplete="off">
                        </div>
                    </div>
                    
                        <div class="form-group row">
                        <?php if(!empty($intinfo->availtime)){
							$workingtime = $intinfo->availtime;
							$availtime=explode('-',$workingtime);
							$availtimefrom = $availtime[0];
							$availtimeto = $availtime[1];
							}
							else{
								$availtimefrom = "";
							    $availtimeto = "";
								}
							?>
                            <label for="availtime" class="col-sm-4 col-form-label"><?php echo display('s_time') ?> *<a class="cattooltips" data-toggle="tooltip" data-placement="top" title="Use Time Like:2:00,10:00"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                            <div class="col-sm-3 unavailableedit-form">
                                <input name="fromtime" class="form-control timepicker2" type="text" placeholder="<?php echo display('s_time') ?>" id="fromtime" value="<?php echo $availtimefrom;?>" autocomplete="off"> 
                            </div>
                            <label for="availtime" class="col-sm-2 col-form-label"><?php echo display('e_time') ?> </label>
                            <div class="col-sm-3">
                                <input name="totime" class="form-control timepicker2" type="text" placeholder="<?php echo display('e_time') ?>" id="totime" value="<?php echo $availtimeto;?>" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1" <?php if(!empty($intinfo)){if($intinfo->is_active==1){echo "Selected";}} else{echo "Selected";} ?>>Active</option>
                                <option value="0" <?php if(!empty($intinfo)){if($intinfo->is_active==0){echo "Selected";}} ?>>Inactive</option>
                              </select>
                        </div>
                    </div>
                        <div class="form-group text-right">
                        	<div class="col-sm-11  unavailableedit-form">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                            </div>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="<?php echo base_url('application/modules/reservation/assets/js/unavailabledit.js'); ?>" type="text/javascript"></script>