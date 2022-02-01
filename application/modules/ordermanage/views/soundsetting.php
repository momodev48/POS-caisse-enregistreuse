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
				
				
				echo form_open_multipart('ordermanage/order/addsound','class="form-inner"') ?>
                    <?php echo form_hidden('id',$soundsetting->soundid) ?>
                    <!-- if setting favicon is already uploaded -->
                    <?php if(!empty($soundsetting->nofitysound)) {  ?>
                    <div class="form-group row">
                        <label for="faviconPreview" class="col-xs-3 col-form-label"></label>
                        <div class="col-xs-9">
                            <img src="<?php echo base_url($soundsetting->nofitysound) ?>" alt="Notify Sound" class="img-thumbnail" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group row">
                        <label for="favicon" class="col-xs-3 col-form-label"><?php echo display('upload_notify') ?> </label>
                        <div class="col-xs-9">
                            <input type="file" name="notifysound" id="notifysound">
                            <input type="hidden" name="old_notifysound" value="<?php echo $soundsetting->nofitysound ?>">
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>