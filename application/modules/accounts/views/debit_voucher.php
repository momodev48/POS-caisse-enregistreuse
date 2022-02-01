<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('debit_voucher')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?php echo  form_open_multipart('accounts/accounts/create_debit_voucher') ?>
                     <div class="form-group row">
                        <label for="vo_no" class="col-sm-2 col-form-label"><?php echo display('voucher_no')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="txtVNo" id="txtVNo" value="<?php if(!empty($voucher_no->voucher)){
                               $vn = substr($voucher_no->voucher,3)+1;
                              echo $voucher_n = 'DV-'.$vn;
                             }else{
                               echo $voucher_n = 'DV-1';
                             } ?>" class="form-control" readonly>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="ac" class="col-sm-2 col-form-label"><?php echo display('credit_account_head')?></label>
                        <div class="col-sm-4">
                          <select name="cmbDebit" id="cmbDebit" class="form-control">
                            <option value='1020101'><?php echo display('cash_in_hand')?></option>
                            <?php foreach ($crcc as $cracc) { ?>
                            <option value="<?php echo $cracc->HeadCode?>"><?php echo $cracc->HeadName?></option>
                           <?php  } ?>

                          </select>
                        </div>
                    </div> 
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"><?php echo display('date')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php  echo date('Y-m-d');?>">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="txtRemarks" class="col-sm-2 col-form-label"><?php echo display('remark')?></label>
                        <div class="col-sm-4">
                          <textarea  name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
                        </div>
                    </div> 
                       <div class="table-responsive debit_voucher_mr_t">
                            <table class="table table-bordered table-hover" id="debtAccVoucher"> 
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('account_name')?></th>
                                         <th class="text-center"><?php echo display('code')?></th>
                                          <th class="text-center"><?php echo display('amount')?></th>
                                           <th class="text-center"><?php echo display('action')?></th>  
                                    </tr>
                                </thead>
                                <tbody id="debitvoucher">
                                   
                                    <tr>
                                        <td class="debit_voucher_w_200">  
       <select name="cmbCode[]" id="cmbCode_1" class="form-control" onchange="load_code(this.value,1)">
         <?php foreach ($acc as $acc1) {?>
   <option value="<?php echo $acc1->HeadCode;?>"><?php echo $acc1->HeadName;?></option>
         <?php }?>
       </select>

                                         </td>
                                        <td><input type="text" name="txtCode[]" value="" class="form-control "  id="txtCode_1" ></td>
                                        <td><input type="text" name="txtAmount[]" value="" class="form-control total_price"  id="txtAmount_1" onkeyup="calculation(1)" >
                                           </td>
                                       <td>
                                                <button  class="btn btn-danger  red debit_voucher_btn_right" type="button" value="<?php echo display('delete')?>" onclick="debitdeleteRow(this)"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                    </tr>                              
                              
                                </tbody>                               
                             <tfoot>
                                    <tr>
                                      <td >
                                            <input type="button" id="add_more" class="btn btn-info" name="add_more"  onClick="addaccount('debitvoucher');" value="<?php echo display('add_more') ?>" />
                                        </td>
                                        <td colspan="1" class="text-right"><label  for="reason" class="  col-form-label"><?php echo display('total') ?></label>
                                           </td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="form-control text-right " name="grand_total" value="" readonly="readonly" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row">
                           
                            <div class="col-sm-12 text-right">

                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9"/>
                               
                            </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>
    </div>
</div>
<div id="cntra" hidden>
<?php foreach ($acc as $acc2) {?><option value='<?php echo $acc2->HeadCode;?>'><?php echo $acc2->HeadName;?></option><?php }?>
</div>
<script src="<?php echo base_url('application/modules/accounts/assets/js/debit_voucher_script.js'); ?>" type="text/javascript"></script>