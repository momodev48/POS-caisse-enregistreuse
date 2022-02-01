<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_ingredient')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_ingredient');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('setting/ingradient/create') ?>
                    <?php echo form_hidden('id', (!empty($intinfo->id)?$intinfo->id:null)) ?>
                        <div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label"><?php echo display('unit_name') ?>*</label>
                        <div class="col-sm-8 customesl">
                        <?php 
						if(empty($categories)){$categories = array('' => '--Select--');}
						echo form_dropdown('unitid',$unitdropdown,(!empty($intinfo->id)?$intinfo->id:null),'class="form-control"') ?>
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="unit_name" class="col-sm-4 col-form-label"><?php echo display('ingredient_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="ingredientname" class="form-control" type="text" placeholder="<?php echo display('ingredient_name') ?>" id="unitname" value="">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="min_stock" class="col-sm-4 col-form-label"><?php echo display('stock_limit') ?> *</label>
                            <div class="col-sm-8">
                                <input name="min_stock" class="form-control" type="text" placeholder="<?php echo display('stock_limit') ?>" id="unitname" value="">
                            </div>
                        </div>
						<div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label">Status*</label>
                        <div class="col-sm-8 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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
                <strong><?php echo display('update_ingredient');?></strong>
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
                            <th><?php echo display('ingredient_name') ?></th>
                            <th><?php echo display('unit_name') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ingredientlist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($ingredientlist as $ingredient) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $ingredient->ingredient_name; ?></td>
                                    <td><?php echo $ingredient->uom_name; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
										 <input name="url" type="hidden" id="url_<?php echo $ingredient->id; ?>" value="<?php echo base_url("setting/ingradient/updateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $ingredient->id; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('setting','delete')->access()): ?>
                                        <a href="<?php echo base_url("setting/ingradient/delete/$ingredient->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
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

     
