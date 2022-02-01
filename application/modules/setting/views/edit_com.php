
                      <?php if(empty($edit)){?>
                         <div class="col-sm-4">
                            <div class="form-group">
                                <label for="date"><?php echo display('position')?></label>
                                <div class="input__holder3">
                                  <?php echo form_dropdown('po',$poslist,null,'class="form-control" id="poslist" required');?>
                            
                                </div>
                            </div>
                         </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="people"><?php echo display('commission');?></label>
                                <div class="input__holder3">
                                  <input id="commission" name="rate" type="text" class="form-control" placeholder="%" value="">
                                </div>
                            </div>
                         </div>
                      <?php } else{?>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label for="date"><?php echo display('position')?></label>
                                <div class="input__holder3">
                                  <div><?php echo $poslist->position_name ?></div>
                                  <input type="hidden" id="poslist" value="<?php echo $poslist->pos_id;?>" >
                                  
                            
                                </div>
                            </div>
                         </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="people"><?php echo display('commission');?></label>
                                <div class="input__holder3">

                                  <input id="commission" name="rate" type="text" class="form-control" placeholder="%" value="<?php echo $poslist->rate;?>">
                                </div>
                            </div>
                         </div>
                      <?php }?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="date">&nbsp;</label>
                                <div class="input__holder3">
                                 <input name="checkurl" id="checkurl" type="hidden" value="<?php echo base_url("reservation/reservation/checkavailablity") ?>" /> 
                                  <input type="button" class="btn btn-success" onclick="savedata(<?php if(!empty($edit)){ echo $poslist->id; }  ?>)" value="<?php if(!empty($edit)){ echo display('update');}else{
                                    echo display('save');
                                  }?>">
                                </div>
                            </div>
                         </div>

                                         