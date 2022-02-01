<div class="form-group text-right">
 <?php if($this->permission->method('reservation','create')->access()): ?>
<a class="btn btn-primary btn-md" href="<?php echo base_url("reservation/reservation/tablebooking") ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('take_reservation')?></a>
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('take_reservation');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('reservation/reservation/create') ?>
                    <?php echo form_hidden('reserveid', (!empty($intinfo->reserveid)?$intinfo->reserveid:null)) ?>
                        <div class="form-group row">
                        <label for="customer_name" class="col-sm-4 col-form-label"><?php echo "Customer Name"; ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php echo form_dropdown('customer_name',$customerlist,(!empty($customerlist->CategoryID)?$customerlist->CategoryID:null),'class="postform resizeselect form-control" id="customer_name" required') ?>
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="tableid" class="col-sm-4 col-form-label"><?php echo "Table No."; ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php echo form_dropdown('tableid',$tablelist,(!empty($tablelist->tableid)?$tablelist->tableid:null),'class="form-control" id="tableid" required') ?>
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="tablicapacity" class="col-sm-4 col-form-label"><?php echo "No. of People"; ?>*</label>
                        <div class="col-sm-8 customesl">
                       <select name="tablicapacity" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <?php for($j=1;$j<=15;$j++){?>
                                <option value="<?php echo $j;?>"><?php echo $j;?></option>
                                <?php } ?>
                              </select>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="bookfromtime" class="col-sm-4 col-form-label"><?php echo display('s_time') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bookfromtime" class="form-control timepicker" type="text" placeholder="<?php echo display('s_time') ?>" id="booktime" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bookendtime" class="col-sm-4 col-form-label"><?php echo display('e_time') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bookendtime" class="form-control timepicker" type="text" placeholder="<?php echo display('e_time') ?>" id="booktime" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bookdate" class="col-sm-4 col-form-label"><?php echo display('date') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bookdate" class="form-control datepicker" type="text" placeholder="<?php echo display('date') ?>" id="bookdate" value="">
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
                <strong><?php echo display('update');?></strong>
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
                <table width="100%" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo 'Customer Name'; ?></th>
                            <th><?php echo "Table No."; ?></th>
                            <th><?php echo "No. of Person"; ?></th>
                            <th><?php echo display('s_time'); ?></th>
                             <th><?php echo display('e_time'); ?></th>
                            <th><?php echo display('date'); ?></th>
                            <th><?php echo display('status'); ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reserve)) { ?>
                            <?php $sl = $pagenum+1; ?>
                            <?php foreach ($reserve as $reserve) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $reserve->customer_name; ?></td>
                                    <td><?php echo $reserve->tablename; ?></td>
                                    <td><?php echo $reserve->person_capicity; ?></td>
                                    <td><?php echo $reserve->formtime; ?></td>
                                     <td><?php echo $reserve->totime; ?></td>
                                     <td><?php echo $reserve->reserveday; ?></td>
                                     <td><?php if($reserve->status==1){echo "Free";} if($reserve->status==2){echo "Booked";} ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('reservation','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $reserve->reserveid; ?>" value="<?php echo base_url("reservation/reservation/updateintfrm") ?>" />
                                        <a onclick="editreserveinfo('<?php echo $reserve->reserveid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('reservation','delete')->access()): ?>
                                        <a href="<?php echo base_url("reservation/reservation/delete/$reserve->reserveid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <div class="text-right"><?php echo @$links?></div>
            </div>
        </div>
    </div>
</div>

     
