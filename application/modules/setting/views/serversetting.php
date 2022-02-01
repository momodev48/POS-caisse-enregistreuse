<div class="row">
<div class="col-md-12">
            <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('apps_addons')?></h4>
                </div>
            </div>
                <div class="panel-body">
                 <div class="col-md-3 serversetting-local-url">
                 <img src="http://chart.apis.google.com/chart?cht=qr&chs=200x210&chl=<?php echo $setting2->localhost_url;?>/V3/&chld=H|0" alt="qr1" />
                 <p align="center"><strong><?php echo display('kitchen_app')?> QR Scan</strong></p>
                 </div>
                  <div class="col-md-3 serversetting-waiter-app">
                 <img src="http://chart.apis.google.com/chart?cht=qr&chs=200x210&chl=<?php echo $setting2->localhost_url;?>/V1/&chld=H|0" alt="qr1" />
                 <p align="center"><strong><?php echo display('waiter_app')?> QR Scan</strong></p>
                 </div>
                  <div class="col-md-5 serversetting-cusotomer-app">
                  <p class="app-playstore"><?php echo display('download_apps_playstore')?></p>
                  <p><a href="https://play.google.com/store/apps/details?id=com.bdtask.kitchenchef" target="_blank"><img src="<?php echo base_url(); ?>assets/img/appsicon.png" alt="apps" width="50px;"/> <?php echo display('kitchen_app')?></a></p>
                  <p><a href="https://play.google.com/store/apps/details?id=com.bdtask.waiters" target="_blank"><img src="<?php echo base_url(); ?>assets/img/appsicon.png" alt="apps" width="50px;"/> <?php echo display('waiter_app')?></a></p>
                  <p><a href="https://play.google.com/store/apps/details?id=com.bdtask.hungry" target="_blank"><img src="<?php echo base_url(); ?>assets/img/appsicon.png" alt="apps" width="50px;"/> <?php echo display('customer_app')?></a></p>
                  </div>
                
             </div>
         </div>
     </div>
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo (!empty($title)?$title:null) ?></h4>
                </div>
            </div>
            <div class="panel-body">
            		
                <?php 
				echo form_open_multipart('setting/serversetting/create','class="form-inner"') ?>
                    <?php echo form_hidden('serverid',$setting2->serverid) ?>

                    <div class="form-group row">
                        <label for="ipaddress" class="col-xs-3 col-form-label"><?php echo display('netip') ?> <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <input name="ipaddress" type="text" class="form-control" id="ipaddress" placeholder="<?php echo display('netip') ?>" value="<?php echo $setting2->localhost_url ?>">
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="port" class="col-xs-3 col-form-label"><?php echo display('ip_port') ?></label>
                        <div class="col-xs-9">
                            <input name="port" type="text" class="form-control" required id="port" placeholder="<?php echo display('ip_port') ?>" value="<?php echo $setting2->online_url ?>">
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                        <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                    </div>
                <?php echo form_close() ?>
                <p>*** <?php echo display('if_you_need_the_above_all_apps')?><br />
               Email:business@bdtask.com <br />
               Skype:bdtask
                </p>
            </div>
        </div>
    </div>
    
</div>