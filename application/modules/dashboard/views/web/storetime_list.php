
 <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 					<?php echo  form_open('dashboard/web_setting/storetimecreate',array('id'=>'typeurl')) ?>
                        <div class="form-group row">
                            <label for="dayname" class="col-sm-4 col-form-label"><?php echo display('day_name') ?> *</label>
                            <div class="col-sm-8 customesl">
                            <select name="dayname" id="dayname" class="form-control">
                                <option value=""  selected="selected"><?php echo display('select_option') ?></option>
                                <option value="<?php echo display('saturday') ?>"><?php echo display('saturday') ?></option>
                                <option value="<?php echo display('sunday') ?>"><?php echo display('sunday') ?></option>
                                <option value="<?php echo display('monday') ?>"><?php echo display('monday') ?></option>
                                <option value="<?php echo display('tuesday') ?>"><?php echo display('tuesday') ?></option>
                                <option value="<?php echo display('wednesday') ?>"><?php echo display('wednesday') ?></option>
                                <option value="<?php echo display('thursday') ?>"><?php echo display('thursday') ?></option>
                                <option value="<?php echo display('friday') ?>"><?php echo display('friday') ?></option>
                              </select>
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="opentime" class="col-sm-4 col-form-label"><?php echo display('opent') ?> *</label>
                            <div class="col-sm-8">
                                <input name="opentime" id="opentime" class="form-control" type="text" placeholder="Add <?php echo display('opent') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="closetime" class="col-sm-4 col-form-label"><?php echo display('closeTime') ?> *</label>
                            <div class="col-sm-8">
                                <input name="closetime" id="closetime" class="form-control" type="text" placeholder="Add <?php echo display('closeTime') ?>">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5 menu_dashboard_display" id="btnchnage" ><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('day_name') ?></th>
                                <th><?php echo display('opent') ?></th>
                                <th><?php echo display('closeTime') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($openclosetime)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($openclosetime as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->dayname; ?></td>
                                <td><?php echo $value->opentime; ?></td>
                                <td><?php echo $value->closetime; ?></td>
                                <td>
                                    <a onclick="edittype('<?php echo $value->dayname; ?>','<?php echo $value->opentime; ?>','<?php echo $value->closetime; ?>',<?php echo $value->	stid; ?>)"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assest/js/social.js'); ?>" type="text/javascript"></script>




 