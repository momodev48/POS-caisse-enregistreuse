
 <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
					<div class="btn-group pull-right"> 
                    <a href="<?php echo base_url()?>dashboard/web_setting/bannersetting" class="btn btn-success"><i class="fa fa-plus"></i> <?php echo display('banner_list')?></a>
                    </div>
                    
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 					<?php echo  form_open('dashboard/web_setting/createtype',array('id'=>'typeurl')) ?>
                        <div class="form-group row">
                            <label for="suppliername" class="col-sm-4 col-form-label"><?php echo display('bannertype') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bannertype" id="bannertype" class="form-control" type="text" placeholder="Add <?php echo display('bannertype') ?>">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5" id="btnchnage"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('title') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ballertype_list)) ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($ballertype_list as $value) { ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $value->STypeName; ?></td>
                                <td>
                                    <a onclick="edittype('<?php echo $value->STypeName; ?>',<?php echo $value->stype_id; ?>)"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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




 