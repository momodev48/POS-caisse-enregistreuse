<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('supplier_payment')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?php echo  form_open_multipart('accounts/accounts/create_supplier_payment') ?>
                     <div class="form-group row">
                        <label for="vo_no" class="col-sm-2 col-form-label"><?php echo display('voucher_no')?></label>
                        <div class="col-sm-4">
                             <input type="text" name="txtVNo" id="txtVNo" value="<?php if(!empty($voucher_no->voucher)){
                               $vn = substr($voucher_no->voucher,3)+1;
                              echo $voucher_n = 'PM-'.$vn;
                             }else{
                               echo $voucher_n = 'PM-1';
                             } ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                                    <label for="adress" class="col-sm-2 col-form-label"><?php echo display('ptype')?></label>
                                    <div class="col-sm-4">
                                    	<select name="paytype" class="form-control" required="" onchange="bank_paymet(this.value)">
                                            <option value="1"><?php echo display('casp')?></option>
                                            <option value="2"><?php echo display('bnkp')?></option>
                                        </select>
                                    </div>
                                </div>
                      <div class="form-group row supplier_payment_form_dnone" id="showbank" >
                                    <label for="adress" class="col-sm-2 col-form-label"><?php echo display('slbank')?></label>
                                    <div class="col-sm-4">
                                    	<select name="bank" id="bankid" class="form-control supplier_payment_form_w_100" >
                                            <option value=""><?php echo display('slbank')?></option>
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
                   
                       <div class="table-responsive supplier_payment_form_mr_t">
                            <table class="table table-bordered table-hover" id="debtAccVoucher"> 
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('supplier_name')?></th>
                                         <th class="text-center"><?php echo display('code')?></th>
                                          <th class="text-center"><?php echo display('amount')?></th>
                                            
                                    </tr>
                                </thead>
                                <tbody id="debitvoucher">
                                   
                                    <tr>
                                        <td class="supplier_payment_form_mr_w_200px" >  
       <select name="supplier_id" id="supplier_id_1" class="form-control" onchange="load_code(this.value,1)" required>
        <option value=""><?php echo display('slsuplier') ?></option>
         <?php foreach ($supplier_list as $suplier) {?>
   <option value="<?php echo $suplier->supid;?>"><?php echo $suplier->supName;?></option>
         <?php }?>
       </select>

                                         </td>
                                        <td><input type="text" name="txtCode" value="" class="form-control "  id="txtCode_1" readonly=""></td>
                                        <td><input type="number" name="txtAmount" value="" class="form-control total_price text-right"  id="txtAmount_1" onkeyup="calculation(1)" required>
                                           </td>
                                 
                                    </tr>                              
                              
                                </tbody>                               
                             <tfoot>
                                    <tr>
                                      <td >

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
<?php foreach ($supplier_list as $suplier) {?><option value='<?php echo $suplier->supplier_id;?>'><?php echo $suplier->supplier_name;?></option><?php }?>
</div>
<script src="<?php echo base_url('application/modules/accounts/assets/js/supplier_payment_form_script.js'); ?>" type="text/javascript"></script>