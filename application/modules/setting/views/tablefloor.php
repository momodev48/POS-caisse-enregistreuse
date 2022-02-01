<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
					<div class="btn-group pull-right"> 
                    <a href="<?php echo base_url()?>setting/restauranttable/index" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo display('table_list')?></a>
                    </div>
                    
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 					<?php echo  form_open('setting/restauranttable/createfloor',array('id'=>'typeurl')) ?>
                        <div class="form-group row">
                            <label for="floor" class="col-sm-2 col-form-label"><?php echo display('floor_name') ?> *</label>
                            <div class="col-sm-3">
                                <input name="floor" id="floor" class="form-control" autocomplete="off" type="text" placeholder="<?php echo display('floor_name') ?>">
                                <input name="tbfloorid" type="hidden" id="floorid" value="" />
                            </div>
                            <div class="col-sm-3"><button type="submit" class="btn btn-success w-md m-b-5" id="btnchnage"><?php echo display('Ad') ?></button></div>
                        </div>

                    <?php echo form_close() ?>
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('floor_name') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($floorlist)){ ?>
                            <?php $sl = 1; ?>
                            <?php foreach($floorlist as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->floorName; ?></td>
                                <td>
                                    <a onclick="edittype('<?php echo $value->floorName; ?>',<?php echo $value->tbfloorid; ?>)"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php }} ?>
                            
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/setting/assets/js/tablefloor_script.js'); ?>" type="text/javascript"></script>




 