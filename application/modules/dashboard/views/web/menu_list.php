
 <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 					<?php echo  form_open('dashboard/web_setting/createmenu',array('id'=>'menuurl')) ?>
                        <div class="form-group row">
                            <label for="menuname" class="col-sm-4 col-form-label"><?php echo display('menu_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="menuname" id="menuname" class="form-control" type="text" placeholder="<?php echo display('menu_name') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Menuurl" class="col-sm-4 col-form-label"><?php echo display('menu_url') ?></label>
                            <div class="col-sm-8">
                                <input readonly="readonly" name="Menuurl" id="Menuurl" class="form-control" type="text" placeholder="<?php echo display('menu_url') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="category" class="col-sm-4 col-form-label"><?php echo display('sub_menu') ?></label>
                        <div class="col-sm-8">
                        <select name="menuid" class="form-control" id="menuid">
                            <option value="" selected="selected"><?php echo display('sub_menu') ?></option> 
                            <?php foreach($allmenu as $menu){?>
                            <option value="<?php echo $menu->menuid;?>" class='bolden'><strong><?php echo $menu->menu_name;?></strong></option>
                            	<?php if(!empty($menu->sub)){
								foreach($menu->sub as $submenu){?>
                                <option value="<?php echo $submenu->menuid;?>">&nbsp;&nbsp;&nbsp;&mdash;<?php echo $submenu->menu_name;?></option>
                            <?php } } } ?>
                        </select>
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="lastname" class="col-sm-4 col-form-label"><?php echo display('status') ?></label>
                        <div class="col-sm-8 customesl">
                            <select name="status" id="status"  class="form-control">
                                <option value=""><?php echo display('select_option') ?></option>
                                <option value="1" selected="selected"><?php echo display('active') ?></option>
                                <option value="0"><?php echo display('inactive') ?></option>
                              </select>
                        </div>
                    </div>
                        <div class="form-group text-right menu_dashboard_display"  id="upbtn">
                            <button type="submit" class="btn btn-success w-md m-b-5" id="btnchnage"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('menu_name') ?></th>
                                <th><?php echo display('menu_url') ?></th>
                                <th><?php echo display('parent_menu') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allmenu)){ ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($allmenu as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->menu_name; ?></td>
                                <td><?php echo $value->menu_slug; ?></td>
                                <td></td>
                                <td><?php if($value->isactive==1){ echo "Active";}else{ echo "Inactive";} ?></td>
                                <td>
                                    <a onclick="editmenu('<?php echo $value->menu_name; ?>','<?php echo $value->menu_slug; ?>','<?php echo $value->isactive; ?>',<?php echo $value->parentid; ?>,<?php echo $value->menuid; ?>)"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                	
                                </td>
                            </tr>
							<?php if(!empty($value->sub)){
								foreach($value->sub as $submenu){?> 
									<tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $submenu->menu_name; ?></td>
                                <td><?php echo $submenu->menu_slug; ?></td>
                                <td><?php echo $value->menu_name;?></td>
                                <td><?php if($submenu->isactive==1){ echo "Active";}else{ echo "Inactive";} ?></td>
                                <td>
                                    <a onclick="editmenu('<?php echo $submenu->menu_name; ?>','<?php echo $submenu->menu_slug; ?>','<?php echo $submenu->isactive; ?>',<?php echo $submenu->parentid; ?>,<?php echo $submenu->menuid; ?>)"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                 
                                </td>
                            </tr>
								<?php }}?>
							
							<?php  } }  ?>
                            
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('application/modules/dashboard/assest/js/banner.js'); ?>" type="text/javascript"></script>




 