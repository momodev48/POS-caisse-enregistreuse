<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<a href="<?php echo base_url()?>setting/restauranttable/floorlist" class="btn btn-primary btn-md" ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_floor')?></a> 
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_room')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_room');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open_multipart('setting/restauranttable/createroom') ?>
                    <?php echo form_hidden('roomid', (!empty($intinfo->id)?$intinfo->id:null)) ?>
                        <div class="form-group row">
                            <label for="roomno" class="col-sm-4 col-form-label"><?php echo display('room_no') ?> *</label>
                            <div class="col-sm-8">
                                <input name="roomno" class="form-control" type="text" placeholder="<?php echo display('room_no') ?>" id="roomno" value="">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="floor" class="col-sm-4 col-form-label"><?php echo display('floor_select') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="floor" id="floor" >
                                        <option value="">--Select--</option>                                        
                                        <?php 
                                           foreach($floorlist as $floor){
                                            echo '<option value="'.$floor->tbfloorid.'">'.$floor->floorName.'</option>';
                                        }
                                        ?>
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
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('room_no') ?></th>
                            <th><?php echo display('floor_name') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($roomlist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($roomlist as $room) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $room->roomno; ?></td>
                                    <td><?php echo $room->floorName; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $room->id; ?>" value="<?php echo base_url("setting/restauranttable/updateroomfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $room->id; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('setting','delete')->access()): ?>
                                        <a href="<?php echo base_url("setting/restauranttable/deleteroom/$room->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <div class="text-right"><?php ?></div>
                
            </div>
        </div>
        
    </div>
</div>

     
