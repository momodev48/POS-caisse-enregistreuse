<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>

<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_paymentsetup');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo  form_open('setting/paymentmethod/psetupcreate') ?>
                    <?php echo form_hidden('setupid', (!empty($intinfo->setupid)?$intinfo->setupid:null)) ?>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('payment_name') ?> *</label>
                            <div class="col-sm-8 customesl">
                                <?php if(empty($paymentlist)){$paymentlist = array('' => '--Select--');}
						echo form_dropdown('payment',$paymentlist,(!empty($intinfo->paymentid)?$intinfo->paymentid:null),'class="form-control" id="payment" required') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('marchantid') ?></label>
                            <div class="col-sm-8">
                                 <input name="marchantid" class="form-control" type="text" placeholder="<?php echo display('marchantid') ?>" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('password') ?></label>
                            <div class="col-sm-8">
                                 <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('email') ?></label>
                            <div class="col-sm-8">
                                 <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment" class="col-sm-4 col-form-label"><?php echo display('currency') ?> *</label>
                            <div class="col-sm-8 customesl">
                                <?php if(empty($currency_list)){$currency_list = array('' => '--Select--');}
						echo form_dropdown('currency',$currency_list,(!empty($intinfo->currency)?$intinfo->currency:null),'class="form-control" id="currency" ') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="islive" class="col-sm-4 col-form-label">Is Live or Test</label>
                        <div class="col-sm-8 customesl">
                            <select name="islive" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1">Live</option>
                                <option value="0">Test Mode</option>
                              </select>
                        </div>
                    </div>
						<div class="form-group row">
                        <label for="status" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8 customesl">
                            <select name="status" class="form-control">
                                <option value=""  selected="selected">Select Option</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                              </select>
                        </div>
                    </div>
  
                        <div class="form-group text-right">
                            <button type="reset" class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('Ad') ?></button>
                        </div>
                    <?php echo form_close() ?>

                </div>  
            </div>
        </div>
    </div>
             
    
   
    </div>
     
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>

<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('payment_edit');?></strong>
            </div>
            <div class="modal-body editinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('payment_name') ?></th>
                            <th><?php echo display('email') ?>/ Location ID</th>
                            <th><?php echo display('marchantid') ?>/ Application ID</th>
                            <th><?php echo display('currency') ?></th>
                            <th><?php echo "Mode"; ?></th>
                            <th><?php echo display('status') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($psetuplist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($psetuplist as $payment) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $payment->payment_method; ?></td>
                                    <td><?php echo $payment->email; ?></td>
                                    <td><?php echo $payment->marchantid; ?></td>
                                    <td><?php echo $payment->currency; ?></td>
                                    <td><?php if($payment->Islive==1){echo "Live Mode";}else{echo "Test Mode";} ?></td>
                                    <td><?php if($payment->status==1){echo "Active";}else{echo "Inactive";} ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $payment->setupid; ?>" value="<?php echo base_url("setting/paymentmethod/psetupupdateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $payment->setupid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif;  ?>
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

     
