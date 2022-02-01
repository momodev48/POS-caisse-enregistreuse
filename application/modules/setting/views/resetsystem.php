<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
            		<div class="row">
                        <div class="form-group col-lg-6 col-sm-offset-3 reset-system-alert">
                            <p class="alert"><?php echo display('fresettext')?></p>
                        </div>
                        <div class="form-group col-lg-6 col-sm-offset-3">                           
                           <a href="javascript:;" onclick="resetdata()" class="btn btn-xs btn-success resettxt"><?php echo display('do_you_want_proceed')?></a>
                            
                              
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<div id="resetdata" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <strong>
      	Verify Account
        </strong> </div>
      <div class="modal-body">
      	<div class="row">
                  
                  <div class="form-group row">
                    <label for="4digit" class="col-sm-4 col-form-label">Type your Password</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control" id="checkpassword" name="checkpassword" />
                    </div>
                  </div>
                  <div class="form-group text-right">
                    <div class="col-sm-11 reset-system-b">
                      <button type="button" id="resetnow" class="btn btn-success w-md m-b-5" onclick="confirmreset()">Reset Data</button>
                    </div>
                  </div>
                </div>
      
      </div>
    </div>
    <div class="modal-footer"> </div>
  </div>
</div>

<link href="<?php echo base_url('application/modules/setting/assets/css/resetsystem.css'); ?>" rel="stylesheet" type="text/css"/>

<script src="<?php echo base_url('application/modules/setting/assets/js/resetsystem_script.js'); ?>" type="text/javascript"></script>
 