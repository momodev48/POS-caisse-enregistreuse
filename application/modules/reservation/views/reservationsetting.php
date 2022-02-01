<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
            		
                <?php 
				echo form_open_multipart('reservation/reservation/settingsave','class="form-inner"') ?>
                    <?php echo form_hidden('id',$setting->id) ?>
                     <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('opening_time') ?></label>
                        <div class="col-xs-9">
                            <input name="opentime" type="text" class="form-control timepicker" id="opentime" placeholder="<?php echo display('opening_time') ?>"  value="<?php echo $setting->reservation_open ?>" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('closeTime') ?></label>
                        <div class="col-xs-9">
                            <input name="closetime" type="text" class="form-control timepicker" id="closetime" placeholder="<?php echo display('closeTime') ?>"  value="<?php echo $setting->reservation_close ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="storevat" class="col-xs-3 col-form-label"><?php echo display('max_reserveperson') ?></label>
                        <div class="col-xs-9">
                            <input name="maxperson" type="text" class="form-control" id="scharge" placeholder="<?php echo display('max_reserveperson') ?>"  value="<?php echo $setting->maxreserveperson ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>