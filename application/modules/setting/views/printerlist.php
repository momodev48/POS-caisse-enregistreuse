<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_printer')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_printer');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('setting/kitchensetting/addprinter') ?>
                    <?php echo form_hidden('kitchenid', (!empty($intinfo->kitchenid)?$intinfo->kitchenid:null)) ?>
                        <div class="form-group row">
                      		<label for="kitchenname" class="col-sm-4 col-form-label"><?php echo display('kitchen_name') ?> *</label>
                            <div class="col-sm-8">
                            <select name="kitchenname" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <?php foreach($allkitchen as $kitchen){?>
                                <option value="<?php echo $kitchen->kitchenid;?>"><?php echo $kitchen->kitchen_name;?></option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                      		<label for="ipaddress" class="col-sm-4 col-form-label"><?php echo display('ip_address') ?> *</label>
                            <div class="col-sm-8">
                          <input name="ipaddress" class="form-control" type="text" placeholder="<?php echo display('ip_address') ?>" id="ipaddress">
                            </div>
                        </div>
                        <div class="form-group row">
                      		<label for="ipport" class="col-sm-4 col-form-label"><?php echo display('ip_port') ?> *</label>
                            <div class="col-sm-8">
                          <input name="ipport" class="form-control" type="text" placeholder="<?php echo display('ip_port') ?>" id="ipport">
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
                            <th><?php echo display('kitchen_name') ?></th>
                            <th><?php echo display('ip_address') ?></th>
                            <th><?php echo display('ip_port') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($printerlist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($printerlist as $kitchen) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $kitchen->kitchen_name; ?></td> 
                                    <td><?php echo $kitchen->ip; ?></td>
                                    <td><?php echo $kitchen->port; ?></td>                                  
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $kitchen->kitchenid; ?>" value="<?php echo base_url("setting/kitchensetting/updateprintertfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $kitchen->kitchenid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
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

     
