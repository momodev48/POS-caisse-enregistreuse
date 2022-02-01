<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">


                <?php  //print_r($facebookloginbackapi);
				echo form_open_multipart("facebooklogin/facebookloginback/showsetting") ?>
                    
                   
                   
                     <div class="col-lg-6">
                    <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('api_key')?> *</label>
                        <div class="col-sm-8">
                            <input name="app_id" class="form-control" type="text" placeholder="<?php echo display('api_key')?>" id="api_key"  value="<?php echo (!empty($facebookloginbackapi->app_id)?$facebookloginbackapi->app_id:null) ?>">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-form-label"><?php echo display('secret_key')?> *</label>
                        <div class="col-sm-8">
                            <input name="app_secret" class="form-control" type="text" placeholder="<?php echo display('secret_key')?>" id="secret_key"  value="<?php echo (!empty($facebookloginbackapi->app_secret)?$facebookloginbackapi->app_secret:null) ?>">
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                 
                    <div class="form-group text-right">
                        
                        <button type="submit" class="btn btn-success w-md m-b-5">Save</button>
                    </div>
                    </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
</div>
