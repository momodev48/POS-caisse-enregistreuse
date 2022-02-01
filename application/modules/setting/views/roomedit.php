<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open_multipart('setting/restauranttable/createroom') ?>
                    <?php echo form_hidden('roomid', (!empty($intinfo->id)?$intinfo->id:null)) ?>
                        <div class="form-group row">
                            <label for="roomno" class="col-sm-4 col-form-label"><?php echo display('room_no') ?> *</label>
                            <div class="col-sm-8">
                                <input name="roomno" class="form-control" type="text" placeholder="<?php echo display('room_no') ?>" id="roomno" value="<?php echo (!empty($intinfo->roomno)?$intinfo->roomno:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="floor" class="col-sm-4 col-form-label"><?php echo display('floor_select') ?></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="floor" id="floor" >
                                        <option value="">--Select--</option>                                        
                                        <?php foreach($floorlist as $floor){?>
                                            <option value="<?php echo $floor->tbfloorid;?>" <?php if($intinfo->floorno==$floor->tbfloorid){ echo "selected";}?>><?php echo $floor->floorName;?></option>
                                        <?php }?>
                                    </select>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
 