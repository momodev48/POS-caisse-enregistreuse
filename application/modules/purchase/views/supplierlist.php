<div class="form-group text-right">
 <?php if($this->permission->method('purchase','create')->access()): ?>
<button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"  ><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('supplier_add')?></button> 
<?php endif; ?>

</div>
<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('supplier_add');?></strong>
            </div>
            <div class="modal-body">
           
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">

                    <?php echo  form_open('purchase/supplierlist/create') ?>
                    <?php echo form_hidden('supid', (!empty($intinfo->supid)?$intinfo->supid:null)) ?>
                        <div class="form-group row">
                            <label for="suppliername" class="col-sm-5 col-form-label"><?php echo display('supplier_name') ?> *</label>
                            <div class="col-sm-7">
                                <input name="suppliername" class="form-control" type="text" placeholder="Add <?php echo display('supplier_name') ?>" id="suppliername" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-5 col-form-label"><?php echo display('email') ?> </label>
                            <div class="col-sm-7">
                                <input name="email" class="form-control" type="email" placeholder="Add <?php echo display('email') ?>" id="email" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-5 col-form-label"><?php echo display('mobile') ?> *</label>
                            <div class="col-sm-7">
                                <input name="mobile" class="form-control" type="text" placeholder="Add <?php echo display('mobile') ?>" id="mobile" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-sm-5 col-form-label"><?php echo display('previous_balance') ?> *</label>
                            <div class="col-sm-7">
                                <input name="previous_balance" class="form-control" type="text" placeholder="<?php echo display('previous_balance') ?>" id="previous_balance" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-5 col-form-label"><?php echo display('address') ?></label>
                            <div class="col-sm-7">
                          <textarea name="address" class="form-control" cols="50" rows="3" placeholder="Add <?php echo display('address') ?>" id="address" ></textarea>
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
                <strong><?php echo display('supplier_edit');?></strong>
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
                            <th><?php echo display('supplier_name') ?></th>
                            <th><?php echo display('email') ?></th>
                            <th><?php echo display('mobile') ?></th>
                            <th><?php echo display('address') ?></th>
                            <th><?php echo display('balance') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($supplierlist)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($supplierlist as $supplier) {
								$this->load->model('supplier_model');
								$supplierledger=$this->supplier_model->suppliers_balance($supplier->supid);
								$total_debit = 0;
									$total_credit = 0;
									$balance =0;
									if(!empty($supplierledger)){
									foreach($supplierledger as $ledger){
											if($ledger['d_c'] == "d") {
												echo (!empty($ledger->amount)?$ledger->amount:null);
												$total_debit =$total_debit + $ledger['amount'];
											}
											else{
												$total_credit =$total_credit + $ledger['amount'];
											}
										}
										$balance =$total_debit-$total_credit;
									}
								 ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><a href="<?php echo base_url("purchase/supplierlist/supplier_due_paid_report/$supplier->supid") ?>"><?php echo $supplier->supName; ?></a></td>
                                    <td><?php echo $supplier->supEmail; ?></td>
                                    <td><?php echo $supplier->supMobile; ?></td>
                                     <td><?php echo $supplier->supAddress; ?></td>
                                     <td><?php echo $balance; ?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('purchase','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $supplier->supid; ?>" value="<?php echo base_url("purchase/supplierlist/updateintfrm") ?>" />
                                        <a onclick="editinfo('<?php echo $supplier->supid; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 if($this->permission->method('purchase','delete')->access()): ?>
                                        <a href="<?php echo base_url("purchase/supplierlist/delete/$supplier->supid") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
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

     
