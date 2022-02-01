<div class="form-group text-right">
 <?php if($this->permission->method('setting','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('add_bank')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('add_bank');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open_multipart('setting/bank_list/create') ?>
                    <?php echo form_hidden('bankid', (!empty($intinfo->bankid)?$intinfo->bankid:null)) ?>
                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-4 col-form-label"><?php echo display('bank_name') ?> *</label>
                            <div class="col-sm-8">
                                <input name="bank_name" class="form-control" type="text" placeholder="Add <?php echo display('bank_name') ?>" id="bank_name" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ac_name" class="col-sm-4 col-form-label"><?php echo display('ac_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ac_name" id="ac_name" required="" placeholder="<?php echo display('ac_name') ?>" tabindex="2"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ac_no" class="col-sm-4 col-form-label"><?php echo display('ac_no') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ac_no" id="ac_no" required="" placeholder="<?php echo display('ac_no') ?>" tabindex="3"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="branch" class="col-sm-4 col-form-label"><?php echo display('branch1') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="branch" id="branch" required="" placeholder="<?php echo display('branch1') ?>" tabindex="4"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="signature_pic" class="col-sm-4 col-form-label"><?php echo display('signature_pic') ?></label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="signature_pic" id="signature_pic" placeholder="<?php echo display('signature_pic') ?>" tabindex="5"/>
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
                <strong><?php echo display('update_bank');?></strong>
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
                            <th><?php echo display('bank_name') ?></th>
                            <th><?php echo display('ac_name') ?></th>
                            <th><?php echo display('ac_no') ?></th>
                            <th><?php echo display('branch1') ?></th>
                            <th><?php echo display('balance') ?></th>
                            <th><?php echo display('signature_pic') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($typelist)) { ?>
                            <?php $sl = 1; ?>
                            <?php 
							
							foreach ($typelist as $type) { 
									$this->load->model('banklist_model');
									$bankledger=$this->banklist_model->get_bank_ledger($type->bankid);
									$total_debit = 0;
									$total_credit = 0;
									$balance =0;
									if(!empty($bankledger)){
									foreach($bankledger as $ledger){
											if($ledger->ac_type == "Debit(+)") {
												$total_debit =$total_debit + $ledger->dr;
											}
											else{
												$total_credit =$total_credit + $ledger->cr;
											}
										}
										$balance =$total_debit-$total_credit;
									}
									
									
							?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><a href="<?php echo base_url("setting/bank_list/bank_ledger/$type->bankid");?>"><?php echo $type->bank_name; ?></a></td>
                                    <td><?php echo $type->ac_name; ?></td>
                                    <td><?php echo $type->ac_number; ?></td>
                                    <td><?php echo $type->branch; ?></td>
                                    <td><?php echo $balance; ?></td>
                                    <td><img src="<?php echo base_url().$type->signature_pic; ?>" class="img img-responsive center-block" height="80" width="100"></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $type->bankid; ?>" value="<?php echo base_url("setting/bank_list/updateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $type->bankid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
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

     
