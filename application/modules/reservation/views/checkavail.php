<input name="sldate" id="sldate" type="hidden" value="<?php echo $newdate;?>" />
<input name="sltime" id="sltime" type="hidden" value="<?php echo $gettime;?>" />
<input name="people" id="people" type="hidden" value="<?php echo $nopeople;?>" />
<?php $color="#004040";
					if(!empty($tableinfo)){
					 foreach($tableinfo as $table){
					
						?>
                      <input name="url" type="hidden" id="url_<?php echo $table->tableid; ?>" value="<?php echo base_url("reservation/reservation/reservationform") ?>" />
                        <div class="col-sm-4">
                        	<div id="seatsA" class="table_tables_item checkavail-block">
                              <div class="table_tables_item_content" onclick="editreserveinfo('<?php echo $table->tableid; ?>')">
                                <span class="table_tables_item_name"><?php echo $table->tablename;?></span> 
                                <span class="table_tables_item_seats"> 
                                     <img src="<?php echo base_url(!empty($table->table_icon)?$table->table_icon:'assets/img/icons/table/default.jpg'); ?>" class="img-thumbnail"/>
                                </span>
                               </div>
                            </div>
                        </div>
                        <?php 
						} }
						 else{
							 echo '<div class="col-sm-4"><h2>No Table found!!!</h2></div>';
							 }
						  ?>