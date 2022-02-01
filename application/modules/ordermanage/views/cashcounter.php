
 <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd ">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
 					<?php echo  form_open('ordermanage/order/createcounter',array('id'=>'menuurl')) ?>
                        <div class="form-group row">
                            <label for="counter" class="col-sm-2 col-form-label"><?php echo display('counter_no') ?> *</label>
                            <div class="col-sm-3">
                                <input name="counter" id="counter" class="form-control" type="text" placeholder="<?php echo display('counter_no') ?>">
                            </div>
                            <div class="col-sm-2" id="upbtn">
                            <button type="submit" class="btn btn-success w-md m-b-5 display-block" id="btnchnage"><?php echo display('add_counter') ?></button>
                            </div>
                        </div>
                    <?php echo form_close() ?>
                    <table class="table table-bordered table-hover" id="RoleTbl">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('counter_no') ?></th>
                                <th><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($counterlist)){ ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($counterlist as $counter) { 
							
							?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><?php echo $counter->counterno; ?></td>
                                
                                <td>
                                    <a onclick="editmenu('<?php echo $counter->counterno; ?>',<?php echo $counter->ccid; ?>)"  data-toggle="tooltip" data-placement="left" title="Update" class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                	
                                </td>
                            </tr>
							<?php  } }  ?>
                        </tbody>
                    </table>


            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/cashcounter.js'); ?>" type="text/javascript"></script>





 