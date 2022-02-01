<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_banner');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open_multipart('dashboard/web_setting/create') ?>
                        <div class="form-group row">
                            <label for="ptype" class="col-sm-4 col-form-label"><?php echo display('banner_type') ?> *</label>
                            <div class="col-sm-8 customesl">
                                <?php if(empty($type)){$type = array('' => '--Select--');}
						echo form_dropdown('banner_type',$type,(!empty($type->stype_id)?$type->stype_id:null),'class="form-control" id="ptype" required') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label"><?php echo display('bannersize') ?> *</label>
                            <div class="col-sm-3">
                                <input name="width" class="form-control" type="number" placeholder="<?php echo display('width') ?>" required>
                            </div>
                            <div class="col-sm-1">X</div>
                            <div class="col-sm-3">
                                <input name="height" class="form-control" type="number" placeholder="<?php echo display('height') ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label"><?php echo display('title') ?> *</label>
                            <div class="col-sm-8">
                                <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="suppliername" value="">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="subtitle" class="col-sm-4 col-form-label"><?php echo display('subtitle') ?> *</label>
                            <div class="col-sm-8">
                                <input name="subtitle" class="form-control" type="text" placeholder="<?php echo display('subtitle') ?>" id="email" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-4 col-form-label"><?php echo display('image') ?> </label>
                            <div class="col-sm-8">
                                <input type="file" accept="image/*" name="picture"><a class="cattooltipsimg" data-toggle="tooltip" data-placement="top" title="Use only .jpg,.jpeg,.gif and .png Image. full Size: 1920X902,thumbnail Size:263X332,263X177"><i class="fa fa-question-circle" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="col-sm-4 col-form-label"><?php echo display('link_url') ?> *</label>
                            <div class="col-sm-8">
                                <input name="url" class="form-control" type="text" placeholder="<?php echo display('link_url') ?>" >
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label"><?php echo display('status') ?> *</label>
                        <div class="col-sm-8 customesl">
                            <select name="status"  class="form-control">
                                <option value=""  selected="selected"><?php echo display('select_option') ?></option>
                                <option value="1" selected="selected"><?php echo display('active') ?></option>
                                <option value="0"><?php echo display('inactive') ?></option>
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
                <strong><?php echo display('banner_edit');?></strong>
            </div>
            <div class="modal-body editbanner">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
 <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
					<div class="btn-group pull-right"> 
                   
                    <a data-target="#add0" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo display('add_banner')?></a>
                    </div>
                    
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('title') ?></th>
                                <th><?php echo display('image') ?></th>
                                <th><?php echo display('bannersize') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($baller_list)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($baller_list as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->title; ?></td>
                                <td><img src="<?php echo base_url(!empty($value->image)?$value->image:'assets/img/icons/default.jpg'); ?>" alt="Image" height="64" ></td>
                                <td><?php echo display('width') ?>:<?php echo $value->width; ?> X <?php echo display('height') ?>:<?php echo $value->height; ?></td>
                                <td><?php if($value->status==1){echo display('active');}else{ echo display('inactive');} ?></td>
                                <td>
                                    <a onclick="editbanner('<?php echo $value->slid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="<?php echo base_url("dashboard/web_setting/delete/$value->slid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assest/js/banner.js'); ?>" type="text/javascript"></script>



