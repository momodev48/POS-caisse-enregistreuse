 <div class="container">
            <div class="row table_chart_inner py-5">
<input name="sldate" id="sldate" type="hidden" value="<?php echo $newdate;?>" />
<input name="sltime" id="sltime" type="hidden" value="<?php echo $gettime;?>" />
<input name="people" id="people" type="hidden" value="<?php echo $nopeople;?>" />
<?php $color="#004040";
					if(!empty($tableinfo)){
					 foreach($tableinfo as $table){
					
						?>
                      <input name="url" type="hidden" id="url_<?php echo $table->tableid; ?>" value="<?php echo base_url("hungry/reservationform") ?>" />
                        <div class="col-md-4 col-sm-6 text-center mb-3">
                        <?php echo $table->tablename; ?>
                            <a href="#" data-toggle="modal" data-target="#bookinfo" onclick="editreserveinfo('<?php echo $table->tableid; ?>')">
                                <img src="<?php echo base_url(!empty($table->table_icon)?$table->table_icon:'assets/img/icons/table/default.jpg'); ?>" class="img-fluid" alt="<?php echo $table->tablename;?>">
                            </a>
                        </div>
                        <?php 
						} }
						 else{
							 echo '<div class="col-sm-4"><h2>No Table found!!!</h2></div>';
							 }
						  ?>
						  
                          </div>
        </div>