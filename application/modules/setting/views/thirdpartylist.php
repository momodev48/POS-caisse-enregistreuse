<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_3rdparty_comapny')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_3rdparty_comapny');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('setting/thirdpratycustomer/create') ?>
                    <?php echo form_hidden('companyId', (!empty($intinfo->companyId)?$intinfo->companyId:null)) ?>
                        <div class="form-group row">
                            <label for="3rdcompany_name" class="col-sm-4 col-form-label"><?php echo display('3rdcompany_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="3rdcompany_name" class="form-control" type="text" placeholder="Add <?php echo display('3rdcompany_name') ?>" id="3rdcompany_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="commision" class="col-sm-4 col-form-label"><?php echo display('commision') ?>(%) *</label>
                            <div class="col-sm-8">
                                <input name="commision" class="form-control" type="text" placeholder="<?php echo display('commision') ?>" id="commision" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label"><?php echo display('address') ?> *</label>
                            <div class="col-sm-8">
                               <textarea name="address" cols="30" rows="3" class="form-control" placeholder="<?php echo display('address') ?>" id="address"></textarea>
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
                <strong><?php echo display('update_3rdparty');?></strong>
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
                            <th><?php echo display('3rdcompany_name') ?></th>
                            <th><?php echo display('commision') ?></th>
                            <th><?php echo display('address') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($typelist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($typelist as $type) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $type->company_name; ?></td>
                                    <td><?php echo $type->commision; ?> (%)</td>
                                    <td><?php echo $type->address; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $type->companyId; ?>" value="<?php echo base_url("setting/thirdpratycustomer/updateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $type->companyId; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('setting','delete')->access()): 
										 $exitid = $this->db->select("*")->from('customer_order')->where('isthirdparty',$type->companyId)->get()->row();
										 if(!empty($exitid)){
										 ?>
                                         <a  onclick="return confirm('You Can not Remove this Company!!! Because the delivary Company Have some Order!!')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                         <?php }
										 else{
										 ?>
                                        <a href="<?php echo base_url("setting/thirdpratycustomer/delete/$type->companyId") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                         <?php }
										 endif; ?>
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

     
