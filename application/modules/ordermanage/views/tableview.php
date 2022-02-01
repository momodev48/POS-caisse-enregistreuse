<div class="row kitchen-tab">
                            <?php 
                                $row = count($tableinfo);
                                $numOfCols = 3;
                                $rowCount = 0;
                                $bootstrapColWidth = $row / $numOfCols;
                            foreach($tableinfo as $table){?>

                          <div class="col-md-4">
                                <div class="info_part <?php if($table['sum'] >= $table['person_capicity']){ echo 'booked';}?>">
                                    <div class="table-topper">
                                        <div class="">
                                            <input id="chkboxmap-<?php echo
                                            $table['tableid']?>" type="checkbox"  name="add_table[]" value="<?php 
                                            echo $table['tableid']?>">
                                            <label for="chkboxmap-<?php echo
                                            $table['tableid'];?>">
                                                <span class="radio-shape">
                                                    <i class="fa fa-check"></i>
                                                </span>
                                                <div>
                                                    <span class="display-block"><?php 
                                                    echo display('select_this_table');?></span>
                                                </div>
                                            </label>
                                            <table class="table table-modal table-title">
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo display('table');?></td>
                                                        <td><?php echo $table['tablename']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo display('seat');?></td>
                                                        <td><?php echo $table['person_capicity']?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo display('available');?></td>
                                                        <td><?php echo $table['person_capicity']-$table['sum'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <img src="<?php echo base_url();?>/assets/img/006-terrace.png" class="table-img" alt="">
                                    </div>
                                    <table class="table table-bordered table-modal table-info text-center">
                                        <?php $table_count = count($table['table_details']);?>
                                        <thead <?php if($table_count>3){ ?> class="ws"<?php }?>>
                                            <tr>
                                                <th><?php echo display('ord');?></th>
                                                <th><?php echo display('seat_time');?></th>                                         <th><?php echo display('person');?></th><th><?php echo display('action');?></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody id="table-tbody-<?php echo $table['tableid'];?>">
                                            <?php if(!empty($table['table_details'])){
                                                foreach ($table['table_details'] as $table_details) {
                                                ?>
                                                     <tr id="table-tr-<?php echo $table_details->id; ?>">
                                                <td scope="row"><?php echo $table_details->order_id; ?></td>
                                                <td><?php echo $table_details->time_enter; ?></td>
                                                <td><?php echo $table_details->total_people; ?></td>
                                                <td>
                                                    <button class="btn btn-del" onClick="deleterow_table(<?php echo $table_details->id; ?>)"><i class="ti-trash"></i></button>
                                                </td>
                                            </tr>
                                                <?php 
                                                 }//end foreach
                                            }//end if
                                            else{
                                                ?>
                                                <tr><td><h6><?php echo display('no_customer');?></h6></td></tr>
                                                <?php
                                            }
                                            ?>
                                           
                                            
                                        </tbody>
                                    </table>
                                    <div class="extra_elem">
                                        
                                        <form class="add_form">
                                            <input type="number" min="1" class="form-control add_input" placeholder="<?php echo display('person')?>" name="person-<?php echo $table['tableid'];?>" id="person-<?php echo $table['tableid'];?>">
                                            <button type="button" onclick="checktable(<?php echo $table['tableid'];?>)" class="btn add_btn"><i class="ti-plus"></i></button>
                                        </form>
                                  
                                        <?php if(!empty($table['table_details'])){?>
                                        <button class="btn btn-clear" onClick="deleterow_table('9999',<?php echo $table['tableid']; ?>)"><?php echo display('clear')?></button>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                 $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row kitchen-tab">';
                        }?>  
                        </div>