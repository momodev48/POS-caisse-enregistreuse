<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                    <?php echo form_hidden('purID', (!empty($intinfo->purID)?$intinfo->purID:null)) ?>
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo display('purchase_add') ?></legend>
                    </fieldset>
                    <?php echo form_open_multipart('purchase/purchase/purchase_entry',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                    <input name="url" type="hidden" id="url" value="<?php echo base_url("purchase/purchase/purchaseitem") ?>" />

                    <div class="row">
                             <div class="col-sm-7">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-3 col-form-label"><?php echo display('supplier_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-5">
                                        <?php 
						if(empty($supplier)){$supplier = array('' => '--Select--');}
						echo form_dropdown('suplierid',$supplier,(!empty($intinfo->suplierID)?$intinfo->suplierID:null),'class="form-control" id="suplierid"') ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="<?php echo base_url("purchase/supplierlist/index") ?>"><?php echo display('supplier_add') ?></a>
                                    </div>
                                </div> 
                            </div>
                             <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="invoice_no" class="col-sm-4 col-form-label"><?php echo display('invoice_no') ?><i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                    	<input type="text" tabindex="3" class="form-control" name="invoice_no" placeholder="<?php echo display('invoice_no') ?>" id="invoice_no" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 col-form-label"><?php echo display('purdate') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control datepicker" name="purchase_date" data-date-format="mm/dd/yyyy" value="<?php echo date('d-m-Y');?>" id="date" required="" tabindex="2" readonly="readonly">
                                    </div>
                                    <label for="date" class="col-sm-3 col-form-label"><?php echo display('expdate') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control datepicker" name="expire_date" data-date-format="mm/dd/yyyy" value="<?php echo date('d-m-Y');?>" id="expire_date" required="" tabindex="2" readonly="readonly">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-5">
                               <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?></label>
                                    <div class="col-sm-8">
                        <textarea class="form-control" tabindex="4" id="adress" name="purchase_details" placeholder=" <?php echo display('details') ?>" rows="1"></textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    <div class="row">
                  	  <div class="col-sm-7">
                               <div class="form-group row">
                                    <label for="adress" class="col-sm-3 col-form-label"><?php echo display('ptype') ?></label>
                                    <div class="col-sm-5">
                                    	<select name="paytype" class="form-control" required="" onchange="bank_paymet(this.value)">
                                            <option value="1"><?php echo display('casp') ?></option>
                                            <option value="2"><?php echo display('bnkp') ?></option>
                                            <option value="3">Due Payment</option> 
                                        </select>
                                    </div>
                                </div> 
                            </div>
                      <div class="col-sm-5">
                               <div class="form-group row purchase_d_none" id="showbank">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('sl_bank') ?></label>
                                    <div class="col-sm-8">
                                    	<select name="bank" id="bankid" class="form-control row purchase_w_100">
                                            <option value=""><?php echo display('sl_bank') ?></option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                    </div>
                     <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center" width="20%"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                            <th class="text-center"><?php echo display('stock') ?>/<?php echo display('qty') ?></th>
                                            <th class="text-center"><?php echo display('qty') ?> <i class="text-danger">*</i></th>
                                            <th class="text-center"><?php echo display('s_rate') ?><i class="text-danger">*</i></th>
                                            <th class="text-center"><?php echo display('total') ?></th>
                                            <th class="text-center"></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3 supplier">
                                       <input type="text" name="product_name" required="" class="form-control product_name" onkeypress="product_list(1);" placeholder="Item Name" id="product_name_1" tabindex="5">
                                   <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId">
                                   <input type="hidden" class="sl" value="1">
                                        </td>

                                       <td class="wt">
                                                <input type="text" id="available_quantity_1" class="form-control text-right stock_ctn_1" placeholder="0.00" readonly="">
                                            </td>
                                        
                                            <td class="text-right">
                                                <input type="number" step="0.0001" name="product_quantity[]" id="cartoon_1" class="form-control text-right store_cal_1" onkeyup="calculate_store(1);" onchange="calculate_store(1);" placeholder="0.00" value="" min="0" tabindex="6">
                                            </td>
                                            <td class="test">
                                                <input type="number" step="0.0001" name="product_rate[]" onkeyup="calculate_store(1);" onchange="calculate_store(1);" id="product_rate_1" class="form-control product_rate_1 text-right" placeholder="0.00" value="" min="0"  tabindex="7">
                                            </td>
                                           

                                            <td class="text-right">
                                                <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly">
                                            </td>
                                            <td>
                                                <button  class="btn btn-danger red text-right" type="button" value="Delete" onclick="purchasetdeleteRow(this)" tabindex="8"><?php echo display('delete') ?></button>
                                            </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <input type="button" id="add_invoice_item" class="btn btn-success" name="add-invoice-item" onclick="addmore('addPurchaseItem');" value="<?php echo display('add_more') ?> <?php echo display('item') ?>" tabindex="9">
                                        </td>
                                        <td  colspan="2" class="text-right"><b><?php echo display('grand') ?> <?php echo display('total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control" name="grand_total_price" value="0.00" readonly="readonly">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"  class="text-right"><b><?php echo display('paid') ?> <?php echo display('amount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidamount" class="text-right form-control" name="paidamount" placeholder="0.00">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                     <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add_purchase" class="btn btn-success btn-large" name="add-purchase" value="<?php echo display('submit') ?>">
                            </div>
                        </div>
                        </form>
                </div> 
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('application/modules/purchase/assets/js/addpurchase_script.js'); ?>" type="text/javascript"></script>