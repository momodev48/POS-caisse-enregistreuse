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
				echo form_open_multipart('dashboard/web_setting/email_config_save','class="form-inner"') ?>
                    <?php echo form_hidden('email_config_id',$config->email_config_id) ?>
                    <div class="form-group row">
                        <label for="address" class="col-xs-3 col-form-label"><?php echo display('protocal') ?></label>
                        <div class="col-xs-9">
                            <input name="protocol" type="text" class="form-control" id="address" placeholder="<?php echo display('protocal') ?>"  value="<?php echo @$config->protocol;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-xs-3 col-form-label"><?php echo display('mailpath') ?></label>
                        <div class="col-xs-9">
                            <input name="mailpath" type="text" class="form-control" id="email" placeholder="<?php echo display('mailpath') ?>"  value="<?php echo @$config->mailpath;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-xs-3 col-form-label"><?php echo display('Mail_type') ?></label>
                        <div class="col-xs-9">
                            <input name="mailtype" type="text" class="form-control" id="mailtype" placeholder="<?php echo display('Mail_type') ?>"  value="<?php echo @$config->mailtype;?>" >
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-xs-3 col-form-label"> <?php echo display('smtp_host') ?> : </label>
                    <div class="col-xs-9">
                         <input type="text" name="smtp_host" value="<?php echo @$config->smtp_host;?>" required="1" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-3 col-form-label"> <?php echo display('smtp_post') ?> : </label>
                    <div class="col-xs-9">
                         <input type="text" name="smtp_port" value="<?php echo @$config->smtp_port;?>" required="1" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xs-3 col-form-label"> <?php echo display('sender_email') ?> : </label>
                    <div class="col-xs-9">
                         <input type="text" name="sender" value="<?php echo @$config->sender;?>" required="1" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-3 col-form-label"> <?php echo display('smtp_password') ?> : </label>
                    <div class="col-xs-9">
                         <input type="password" name="smtp_password" value="<?php echo @$config->smtp_password;?>" required="1" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-xs-3 col-form-label"> <?php echo display('api_key') ?> : </label>
                    <div class="col-xs-9">
                         <input type="text" name="api_key" value="<?php echo @$config->api_key;?>" required="1" class="form-control">
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