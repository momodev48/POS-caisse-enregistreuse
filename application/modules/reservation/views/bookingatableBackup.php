<link href="<?php echo base_url('application/modules/reservation/assets/css/bookingatable_backup.css'); ?>" rel="stylesheet" type="text/css"/>
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('Reservation');?></strong>
            </div>
            <div class="modal-body editinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
            <div class="table_content table_contentpost" >
              <div class="table_content_booking"> <span class="table_booking_header">Book a Table</span>
                <div class="table_booking">
                  <div class="table_tables">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <div class="input__holder3">
                                  <input id="date" name="date" type="text" class="form-control datepicker" placeholder="Date" readonly="readonly">
                                </div>
                            </div>
                         </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="time">Time</label>
                                <div class="input__holder3">
                                  <input id="time" name="time" type="text" class="form-control timepicker" placeholder="time" readonly="readonly">
                                </div>
                            </div>
                         </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="people">People</label>
                                <div class="input__holder3">
                                  <input id="people" name="people" type="text" class="form-control" placeholder="No. of people">
                                </div>
                            </div>
                         </div>
                      
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="date">&nbsp;</label>
                                <div class="input__holder3">
                                 <input name="checkurl" type="hidden" value="<?php echo base_url("reservation/reservation/checkavailablity") ?>" /> 
                                  <input type="button" class="btn btn-success" onclick="checkavail()" value="<?php echo display('check_availablity')?>">
                                </div>
                            </div>
                         </div>
                         </div>
                    <div class="row">
                    <?php $color="#004040";
					 foreach($tableinfo as $table){
						if($table->status==1){
							$color="#F00";
							}
						else{
							$color="#004040";
							}
						if($table->person_capicity<=4){
						?>
                      <input name="url" type="hidden" id="url_<?php echo $table->tableid; ?>" value="<?php echo base_url("reservation/reservation/reservationform") ?>" />
                        <div class="col-sm-4">
                        	<div id="seatsA" class="table_tables_item">
                              <div class="table_tables_item_content" onclick="editreserveinfo('<?php echo $table->tableid; ?>')">
                                <span class="table_tables_item_name"><?php echo $table->tablename;?></span> 
                                <span class="table_tables_item_seats"> 
                               
                                    <span class="table_preview_doc"> 
                                        <span id="seatA1" class="table_preview_left table_tables_seat">1</span> 
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span>
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span> 
                                        <span id="seatA10" class="table_preview_right table_tables_seat">3</span> 
                                    </span> 
                                    <span class="table_preview_doc"> 
                                        <span id="seatA2" class="table_preview_left table_tables_seat">2</span> 
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span>
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span> 
                                        <span id="seatA9" class="table_preview_right table_tables_seat">4</span> 
                                    </span> 
                                </span>
                               </div>
                            </div>
                        </div>
                        <?php }
						else if($table->person_capicity>4 && $table->person_capicity<8){
						 ?>
                      <input name="url" type="hidden" id="url_<?php echo $table->tableid; ?>" value="<?php echo base_url("reservation/reservation/reservationform") ?>" />
                         <div class="col-sm-4">
                        <div id="seatsA" class="table_tables_item">
                              <div class="table_tables_item_content" onclick="editreserveinfo('<?php echo $table->tableid; ?>')">
                                <span class="table_tables_item_name"><?php echo $table->tablename;?></span> 
                                <span class="table_tables_item_seats"> 
                                    <span class="table_preview_top"> 
                                        <span id="seatA12" class="table_tables_seat">12</span>
                                        <span id="seatA11" class="table_tables_seat">11</span> 
                                    </span> 
                                    <span class="table_preview_doc"> 
                                        <span id="seatA1" class="table_preview_left table_tables_seat">1</span> 
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span>
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span> 
                                        <span id="seatA10" class="table_preview_right table_tables_seat">10</span> 
                                    </span> 
                                    <span class="table_preview_doc"> 
                                        <span id="seatA2" class="table_preview_left table_tables_seat">2</span> 
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span>
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span> 
                                        <span id="seatA9" class="table_preview_right table_tables_seat">9</span> 
                                    </span> 
                                    <span class="table_preview_doc"> 
                                        <span id="seatAspace" class="seatAspace1" class="table_preview_left table_tables_seat">&nbsp;</span> 
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span>
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span> 
                                        <span id="seatAspace" class="seatAspace2" class="table_preview_left table_tables_seat">&nbsp;</span> 
                                    </span> 
                                    <span class="table_preview_doc"> 
                                        <span id="seatA3" class="table_preview_left table_tables_seat">3</span> 
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span>
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span> 
                                        <span id="seatA8" class="table_preview_right table_tables_seat">8</span> 
                                    </span> 
                                    <span class="table_preview_doc"> 
                                        <span id="seatA4" class="table_preview_left table_tables_seat">4</span> 
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span>
                                        <span class="table_tables_name" style="background: <?php echo $color;?>"></span> 
                                        <span id="seatA7" class="table_preview_right table_tables_seat">7</span> 
                                    </span> 
                                    <span class="table_preview_bot"> 
                                        <span id="seatA5" class="table_tables_seat">5</span>
                                        <span id="seatA6" class="table_tables_seat">6</span> 
                                    </span> 
                                </span>
                               </div>
                            </div>
                         </div>
                         <?php } 
						else if($table->person_capicity>7 && $table->person_capicity<13){
						 ?>
                      <input name="url" type="hidden" id="url_<?php echo $table->tableid; ?>" value="<?php echo base_url("reservation/reservation/reservationform") ?>" />
                         <div class="col-sm-4">
                         <div id="seatsE" class="table_tables_item">
          <div class="table_tables_item_content" onclick="editreserveinfo('<?php echo $table->tableid; ?>')"> <span class="table_tables_item_name"><?php echo $table->tablename;?></span> <span class="table_tables_item_seats"> <span class="table_preview_top"> <span id="seatE18" class="table_tables_seat">18</span><span id="seatE17" class="table_tables_seat">17</span><span id="seatE16" class="table_tables_seat">16</span><span id="seatEspace" class="seatspace">space</span><span id="seatE15" class="table_tables_seat">15</span><span id="seatE14" class="table_tables_seat">14</span><span id="seatE13" class="table_tables_seat">13</span> </span> <span class="table_preview_doc"> <span id="seatE1" class="table_preview_left table_tables_seat">1</span> <span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span> <span id="seatE12" class="table_preview_right table_tables_seat">12</span> </span> <span class="table_preview_doc"> <span id="seatE2" class="table_preview_left table_tables_seat">2</span> <span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span> <span id="seatE11" class="table_preview_right table_tables_seat">11</span> </span> <span class="table_preview_doc"> <span id="seatE3" class="table_preview_left table_tables_seat">3</span> <span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span><span class="table_tables_name" style="background: <?php echo $color;?>"></span> <span id="seatE10" class="table_preview_right table_tables_seat">10</span> </span> <span class="table_preview_bot"> <span id="seatE4" class="table_tables_seat">4</span><span id="seatE5" class="table_tables_seat">5</span><span id="seatE6" class="table_tables_seat">6</span><span id="seatEspace" class="seatspace">space</span><span id="seatE7"class="table_tables_seat">7</span><span id="seatE8" class="table_tables_seat">8</span><span id="seatE9" class="table_tables_seat">9</span> </span> </span> </div>
        </div>
                         </div>
                         <?php } }  ?>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
    </div>
</div>

     
