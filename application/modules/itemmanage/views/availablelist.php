<div class="form-group text-right">
 <?php if($this->permission->method('itemmanage','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_availablity')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_availablity');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('itemmanage/item_food/availablecreate') ?>
                    <?php echo form_hidden('availableID', (!empty($intinfo->availableID)?$intinfo->availableID:null)) ?>
                        <div class="form-group row">
                        <label for="itemname" class="col-sm-3 col-form-label"><?php echo display('item_name') 	
?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php 
						if(empty($itemdropdown)){$itemdropdown = array('' => '--Select--');}
						echo form_dropdown('foodid',$itemdropdown,(!empty($intinfo->foodid)?$intinfo->foodid:null),'class="form-control"') ?>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="availday" class="col-sm-3 col-form-label"><?php echo display('available_day') ?> *<a class="cattooltips" data-toggle="tooltip" data-placement="top" title="Use Day Name Like:Saturday,Sunday....."><i class="fa fa-question-circle" aria-hidden="true"></i></a> </label>
                            <div class="col-sm-8 customesl">
                            	<select name="availday" class="form-control" id="availday">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fromtime" class="col-sm-3 col-form-label"><?php echo "From Time:" ?> *<a class="cattooltips" data-toggle="tooltip" data-placement="top" title="Use Time Like:2:00,10:00"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                            <div class="col-sm-3 availabledit_padding_right" >
                                <input name="fromtime" class="form-control timepicker" type="text" placeholder="<?php echo 'From Time' ?>" id="formtime" value="" readonly="readonly"> 
                            </div>
                            <label for="totime" class="col-sm-2 col-form-label"><?php echo "To Time:" ?> </label>
                            <div class="col-sm-3">
                                <input name="totime" class="form-control timepicker" type="text" placeholder="<?php echo 'To Time' ?>" id="totime" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                              </select>
                        </div>
                    </div>
						
  
                        <div class="form-group text-right">
                        	<div class="col-sm-11 availabledit_padding_right" >
                                <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                            </div>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
             
    
   
    </div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('edit_availablity');?></strong>
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
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('item_name') ?></th>
                            <th><?php echo display('available_day') ?></th>
                            <th><?php echo display('available_time') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($foodavailist)) { ?>
                            <?php $sl = $pagenum+1; ?>
                            <?php foreach ($foodavailist as $avail) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $avail->ProductName; ?></td>
									<td><?php echo $avail->availday; ?></td>
                                    <td><?php echo $avail->availtime; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('itemmanage','update')->access()): ?>

                                        <a onclick="editavailable('<?php echo $avail->availableID; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('itemmanage','delete')->access()): ?>
                                        <a href="<?php echo base_url("itemmanage/item_food/deleteavailable/$avail->availableID") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <div class="text-right"></div>
            </div>
        </div>
    </div>
</div>

     
