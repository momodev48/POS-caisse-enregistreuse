                <?php 
 $webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;?>              

				<?php echo form_open('hungry/bookreservation',array('id'=>'reservesubmit')) ?>
                      
                                    
                                    <div class="form-group row bookinfo">
                                    <label for="tableid" class="col-sm-4 col-form-label"><?php echo "Table Name."; ?>*</label>
                                    <div class="col-sm-8">
                                    <?php echo $tableinfo->tablename;?>
                                    <input name="tableid" type="hidden" id="selecttable" value="<?php echo $tableno;?>" />
                                    </div>
                                    </div>
                                    <div class="form-group row bookinfo">
                                    <label for="tablicapacity" class="col-sm-4 col-form-label"><?php echo "No. of People"; ?>*</label>
                                    <div class="col-sm-8">
                                    <?php echo $nopeople;?>
                                    <input name="tablicapacity" class="form-control" type="hidden" id="tablicapacity" value="<?php echo $nopeople;?>">
                                    </div>
                                    </div> 
                                    <div class="form-group row bookinfo">
                                    <label for="bookdate" class="col-sm-4 col-form-label"><?php echo display('date') ?> *</label>
                                    <div class="col-sm-8">
                                    <?php echo $newdate;?>
                                    <input name="bookdate" class="form-control" type="hidden" id="bookdate" value="<?php echo $newdate;?>">
                                    </div>
                                    </div>
                                    <div class="form-group row bookinfo">
                                    <label for="bookfromtime" class="col-sm-4 col-form-label"><?php echo display('s_time') ?> *</label>
                                    <div class="col-sm-8">
                                    <?php echo $gettime;?>
                                    <input name="bookfromtime" class="form-control" type="hidden" id="booktime" value="<?php echo $gettime;?>">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="bookendtime" class="col-sm-4 col-form-label"><?php echo display('e_time') ?> *</label>
                                    <div class="col-sm-8">
                                    <input name="bookendtime" id="reservation_time" class="form-control" type="text" placeholder="<?php echo display('e_time') ?>" value="<?php echo $endtime;?>">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name"  class="col-sm-4 col-form-label"><?php echo display('name') ?></label>
                                        <div class="col-sm-8"><input type="text" name="customer_name" class="form-control" id="name" placeholder="John Doe" value="<?php echo (!empty($customerinfo->customer_name)?$customerinfo->customer_name:null) ?>" required></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone"  class="col-sm-4 col-form-label"><?php echo display('mobile') ?></label>
                                        <div class="col-sm-8"><input type="text" name="mobile" class="form-control" id="phone" placeholder="+8801712121212" value="<?php echo (!empty($customerinfo->customer_phone)?$customerinfo->customer_phone:$contactno) ?>" required></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mail" class="col-sm-4 col-form-label"><?php echo display('email') ?></label>
                                        <div class="col-sm-8"><input type="email" name="email" class="form-control" id="mail" placeholder="john@example.com" value="<?php echo (!empty($customerinfo->customer_email)?$customerinfo->customer_email:null) ?>"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="message"  class="col-sm-4 col-form-label">Message</label>
                                        <div class="col-sm-8"><textarea class="form-control" name="message" id="message" rows="3" placeholder="Write Your Message"></textarea></div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="reset" class="btn btn-danger"><?php echo display('reset') ?></button>
                                        <button type="button" class="btn btn-success" onclick="submitreserve()"><?php echo display('confirm_reservation') ?></button>
                                    </div>
                                </form>
                    <?php echo form_close();?>
					<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/reservation.js"></script>
                    