
 <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 					<?php echo form_open('dashboard/web_setting/createsociallink',array('id'=>'menuurl')) ?>
                        <div class="form-group row">
                            <label for="menuname" class="col-sm-4 col-form-label"><?php echo display('title') ?> *</label>
                            <div class="col-sm-8">
                                <input name="stitle" id="stitle" class="form-control" type="text" placeholder="<?php echo display('title') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url_link" class="col-sm-4 col-form-label"><?php echo display('url_link') ?></label>
                            <div class="col-sm-8">
                                <input name="url_link" id="url_link" class="form-control" type="text" placeholder="<?php echo display('url_link') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sicon" class="col-sm-4 col-form-label"><?php echo display('sicon') ?></label>
                            <div class="col-sm-8">
                                <input name="sicon" id="sicon" class="form-control social-icon" type="text" placeholder="<?php echo display('sicon') ?>" autocomplete="off">
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
                        <div class="form-group text-right" id="upbtn">
                            <button type="submit" class="btn btn-success w-md m-b-5" id="btnchnage"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('title') ?></th>
                                <th><?php echo display('url_link') ?></th>
                                <th><?php echo display('sicon') ?></th>
                                <th><?php echo display('status') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($sociallink_list)){ ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($sociallink_list as $sociallink) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $sociallink->title; ?></td>
                                <td><?php echo $sociallink->socialurl; ?></td>
                                <td><?php echo $sociallink->icon; ?></td>
                                <td><?php if($sociallink->status==1){ echo "Active";}else{ echo "Inactive";} ?></td>
                                <td>
                                    <a onclick="editmenu('<?php echo $sociallink->title; ?>','<?php echo $sociallink->socialurl; ?>','<?php echo $sociallink->status; ?>','<?php echo $sociallink->icon; ?>',<?php echo $sociallink->sid; ?>)"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                	<a href="<?php echo base_url("dashboard/web_setting/deleteslink/$sociallink->sid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
					
							
							<?php  } }  ?>
                            
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assest/js/social.js'); ?>" type="text/javascript"></script>





 