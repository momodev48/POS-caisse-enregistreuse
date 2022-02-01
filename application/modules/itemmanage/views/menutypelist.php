<div class="form-group text-right">
 <?php if($this->permission->method('itemmanage','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_menu_type')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_menu_type');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open_multipart('itemmanage/item_food/menutypecreate') ?>
                    <?php echo form_hidden('menutypeid', (!empty($intinfo->menutypeid)?$intinfo->menutypeid:null)) ?>
                        
                        <div class="form-group row">
                            <label for="menu_type_name" class="col-sm-4 col-form-label"><?php echo display('menu_type_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="menu_type_name" class="form-control" type="text" placeholder="<?php echo display('menu_type_name') ?>" id="menu_type_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('icon') ?></label>
                        <div class="col-sm-8">
                        <input type="file" accept="image/*" name="picture"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Images"><i class="fa fa-question-circle" aria-hidden="true"></i></a> 
                                
                        </div>
                    </div>
						<div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8">
                            <select name="status"  class="form-control">
                                <option value="" selected="selected">Select Option</option>
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
                <strong><?php echo display('menutype_edit');?></strong>
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
                            <th><?php echo display('menu_type_name') ?></th>
                            <th><?php echo display('icon') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($todaymenutypelist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($todaymenutypelist as $tmenu) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $tmenu->menutype; ?></td>
                                    <td><?php echo $tmenu->menu_icon; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('itemmanage','update')->access()): ?>
<input name="url" type="hidden" id="url_<?php echo $tmenu->menutypeid; ?>" value="<?php echo base_url("itemmanage/item_food/updatemenufrm") ?>" />
                                        <a onclick="editinfo('<?php echo $tmenu->menutypeid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('itemmanage','delete')->access()): ?>
                                        <a href="<?php echo base_url("itemmanage/item_food/deletemenutype/$tmenu->menutypeid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
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
<script src="<?php echo base_url('application/modules/itemmanage/assets/js/menutypelist_script.js'); ?>" type="text/javascript"></script>