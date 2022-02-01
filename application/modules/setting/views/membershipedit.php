<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('setting/membership/create') ?>

                    <?php echo form_hidden('id', (!empty($intinfo->id)?$intinfo->id:null)) ?>
                        <div class="form-group row">
                            <label for="membershipname" class="col-sm-4 col-form-label"><?php echo display('membership_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="membershipname" class="form-control" type="text" placeholder="Add <?php echo display('membership_name') ?>" id="membershipname" value="<?php echo (!empty($intinfo->membership_name)?$intinfo->membership_name:null) ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-sm-4 col-form-label"><?php echo display('discount') ?><a class="cattooltips" data-toggle="tooltip" data-placement="left" title="Use Number Only"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                            <div class="col-sm-8">
                                 <input name="discount" class="form-control" type="text" placeholder="Add <?php echo display('discount') ?>" id="discount" value="<?php echo (!empty($intinfo->discount)?$intinfo->discount:null) ?>">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="facilities" class="col-sm-4 col-form-label"><?php echo display('other_facilities') ?></label>
                            <div class="col-sm-8">
                                 <input name="facilities" class="form-control" type="text" placeholder="Add <?php echo display('other_facilities') ?>" id="facilities" value="<?php echo (!empty($intinfo->other_facilities)?$intinfo->other_facilities:null) ?>">
                            </div>
                        </div>
  
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>