<div class="row">
  <div class="col-sm-12 col-md-12">
    <div class="panel panel-bd lobidrag">
      <div class="panel-heading">
        <div class="panel-title">
          <h4>
          <?php echo display('contra_voucher')?>
          </h4>
        </div>
      </div>
      <div class="panel-body">
        
        <?php echo  form_open_multipart('accounts/accounts/create_contra_voucher') ?>
        <div class="form-group row">
          <label for="vo_no" class="col-sm-2 col-form-label"> <?php echo display('voucher_no')?></label>
          <div class="col-sm-4">
            <input type="text" name="txtVNo" id="txtVNo" value="<?php if(!empty($voucher_no->voucher)){
            $vn = substr($voucher_no->voucher,7)+1;
            echo $voucher_n = 'Contra-'.$vn;
            }else{
            echo $voucher_n = 'Contra-1';
            } ?>" class="form-control" readonly>
          </div>
        </div>
        
        <div class="form-group row">
          <label for="date" class="col-sm-2 col-form-label"> <?php echo display('date')?></label>
          <div class="col-sm-4">
            <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php echo  date('Y-m-d')?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="txtRemarks" class="col-sm-2 col-form-label"> <?php echo display('remark')?></label>
          <div class="col-sm-4">
            <textarea  name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
          </div>
        </div>
        <div class="table-responsive contra_voucher_mr_t">
          <table class="table table-bordered table-hover" id="debtAccVoucher">
            <thead>
              <tr>
                <th class="text-center"> <?php echo display('account_name')?></th>
                <th class="text-center"> <?php echo display('code')?></th>
                <th class="text-center"> <?php echo display('debit')?></th>
                <th class="text-center"> <?php echo display('credit')?></th>
                <th class="text-center"> <?php echo display('action')?></th>
              </tr>
            </thead>
            <tbody id="debitvoucher">
              
              <tr>
                <td class="contra_voucher_w_200">
                  <select name="cmbCode[]" id="cmbCode_1" class="form-control" onchange="load_code(this.value,1)">
                    <?php foreach ($acc as $acc1) {?>
                    <option value="<?php echo $acc1->HeadCode;?>"><?php echo $acc1->HeadName;?></option>
                    <?php }?>
                  </select>
                </td>
                <td><input type="text" name="txtCode[]"  class="form-control "  id="txtCode_1" ></td>
                <td><input type="text" name="txtAmount[]" value="0" class="form-control total_price"  id="txtAmount_1" onkeyup="calculation(1)" >
                </td>
                <td ><input type="text" name="txtAmountcr[]" value="0" class="form-control total_price1"  id="txtAmount1_1" onkeyup="calculation(1)" >
                </td>
                <td>
                  <button  class="btn btn-danger red contra_voucher_btn_right" type="button" value="<?php echo display('delete')?>" onclick="contradeleteRow(this)"><i class="fa fa-trash-o"></i></button>
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
              <input type="text" id="grandTotal" class="form-control text-right " name="grand_total" readonly="readonly" value="0"/>
            </td>
            <td class="text-right">
              <input type="text" id="grandTotal1" class="form-control text-right " name="grand_total1" readonly="readonly" value="0"/>
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
<script src="<?php echo base_url('application/modules/accounts/assets/js/contra_voucher_script.js'); ?>" type="text/javascript"></script>