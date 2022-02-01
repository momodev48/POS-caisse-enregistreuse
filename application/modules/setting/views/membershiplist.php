<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('membership_add')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('membership_add');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php  form_open('setting/membership/create') ?>
                    <?php echo form_hidden('id', (!empty($intinfo->id)?$intinfo->id:null)) ?>
                        <div class="form-group row">
                            <label for="membershipname" class="col-sm-4 col-form-label"><?php echo display('membership_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="membershipname" class="form-control" type="text" placeholder="<?php echo 'Add '.display('membership_name') ?>" id="membershipname" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-sm-4 col-form-label"><?php echo display('discount') ?><a class="cattooltips" data-toggle="tooltip" data-placement="left" title="Use Number Only"><i class="fa fa-question-circle" aria-hidden="true"></i></a> </label>
                            <div class="col-sm-8">
                                 <input name="discount" class="form-control" type="text" placeholder="<?php echo 'Add '.display('discount') ?>" id="discount" value="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="facilities" class="col-sm-4 col-form-label"><?php echo display('other_facilities') ?></label>
                            <div class="col-sm-8">
                                 <input name="facilities" class="form-control" type="text" placeholder="<?php echo 'Add '.display('other_facilities') ?>" id="facilities" value="">
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
                <strong><?php echo display('membership_edit');?></strong>
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
                            <th><?php echo display('membership_name') ?></th>
                            <th><?php echo display('discount') ?></th>
                            <th><?php echo display('other_facilities') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($membershiplist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($membershiplist as $membership) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $membership->membership_name; ?></td>
                                    <td><?php echo $membership->discount; ?></td>
                                    <td><?php echo $membership->other_facilities; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $membership->id; ?>" value="<?php echo base_url("setting/membership/updateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $membership->id; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('setting','delete')->access()): ?>
                                        <a href="<?php echo base_url("setting/membership/delete/$membership->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

     
