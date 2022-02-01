<div class="form-group text-right">
 <?php if($this->permission->method('reservation','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_unavailablity')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_unavailablity');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('reservation/reservation/unavailablecreate') ?>
                    <?php echo form_hidden('offdayid', (!empty($intinfo->offdayid)?$intinfo->offdayid:null)) ?>
                        <div class="form-group row">
                        <label for="unavaildate" class="col-sm-4 col-form-label"><?php echo display('unavaildate')?>*</label>
                        <div class="col-sm-8">
                       		<input name="unavaildate" class="form-control datepicker5" type="text" placeholder="<?php echo display('unavaildate')?>" id="unavaildate" autocomplete="off">
                        </div>
                    </div>
                        
                        <div class="form-group row">
                            <label for="fromtime" class="col-sm-4 col-form-label"><?php echo display('s_time') ?> *<a class="cattooltips" data-toggle="tooltip" data-placement="top" title="Use Time Like:2:00,10:00"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                            <div class="col-sm-3 unavailableedit-form">
                                <input name="fromtime" class="form-control timepicker" type="text" placeholder="<?php echo display('s_time') ?>" id="formtime" autocomplete="off"> 
                            </div>
                            <label for="totime" class="col-sm-2 col-form-label"><?php echo display('e_time') ?> </label>
                            <div class="col-sm-3">
                                <input name="totime" class="form-control timepicker" type="text" placeholder="<?php echo display('e_time') ?>" id="totime" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                              </select>
                        </div>
                    </div>
						
  
                        <div class="form-group text-right">
                        	<div class="col-sm-11 unavailableedit-form">
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
                <strong><?php echo display('edit_unavailablity');?></strong>
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
                            <th><?php echo display('unavaildate') ?></th>
                            <th><?php echo display('available_time') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reservationoffdays)) {
							$sl=1;
							 ?>
                            <?php foreach ($reservationoffdays as $unavail) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $unavail->offdaydate; ?></td>
                                    <td><?php echo $unavail->availtime; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('reservation','update')->access()): ?>
										<input name="url" type="hidden" id="url_<?php echo $unavail->offdayid; ?>" value="<?php echo base_url("reservation/reservation/updateunavailfrm") ?>" />
                                        <a onclick="edituninfo('<?php echo $unavail->offdayid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php
										  endif; 
										 if($this->permission->method('reservation','delete')->access()): ?>
                                        <a href="<?php echo base_url("reservation/reservation/deleteunavailable/$unavail->offdayid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
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

  