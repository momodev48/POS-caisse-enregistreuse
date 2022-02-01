<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                   
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo display('purchase_add') ?></legend>
                    </fieldset>
                    <?php echo form_open_multipart('purchase/purchase/update_entry',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                     <?php echo form_hidden('purID', (!empty($purchaseinfo->purID)?$purchaseinfo->purID:null));
					 echo form_hidden('oldinvoice', (!empty($purchaseinfo->invoiceid)?$purchaseinfo->invoiceid:null));
					 echo form_hidden('oldsupplier', (!empty($purchaseinfo->suplierID)?$purchaseinfo->suplierID:null));
					 $originalDate = $purchaseinfo->purchasedate;
					 $purchasedate = date("d-m-Y", strtotime($originalDate));
					 
					 $originalexDate = $purchaseinfo->purchaseexpiredate;
					 $expiredatedate = date("d-m-Y", strtotime($originalexDate));
					 ?>
                    <input name="url" type="hidden" id="url" value="<?php echo base_url("purchase/purchase/purchaseitem") ?>" />

                    <div class="row">
                             <div class="col-sm-7">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-3 col-form-label"><?php echo display('supplier_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-5">
                                        <?php 
						if(empty($supplier)){$supplier = array('' => '--Select--');}
						echo form_dropdown('suplierid',$supplier,(!empty($purchaseinfo->suplierID)?$purchaseinfo->suplierID:null),'class="form-control"  id="suplierid"') ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="<?php echo base_url("setting/supplierlist/index") ?>"><?php echo display('supplier_add') ?></a>
                                    </div>
                                </div> 
                            </div>
                             <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="invoice_no" class="col-sm-4 col-form-label"><?php echo display('invoice_no') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" tabindex="3" class="form-control" name="invoice_no" value="<?php echo $purchaseinfo->invoiceid;?>" placeholder="<?php echo display('invoice_no') ?>" id="invoice_no" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                            <div class="col-sm-7">
                            <div class="form-group row">
                                    <label for="date" class="col-sm-3 col-form-label"><?php echo display('purdate') ?><i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-3">
                                 <input type="text" class="form-control datepicker" name="purchase_date" value="<?php echo $purchasedate;?>" id="date" required="" tabindex="2">
                                    </div>
                                     <label for="date" class="col-sm-3 col-form-label"><?php echo display('expdate') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control datepicker" name="expire_date" data-date-format="mm/dd/yyyy" value="<?php echo $expiredatedate;?>" id="expire_date" required="" tabindex="2" readonly="readonly">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-sm-5">
                               <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?></label>
                                    <div class="col-sm-8">
                        <textarea class="form-control" tabindex="4" id="adress" name="purchase_details" placeholder=" <?php echo display('details') ?>" rows="1"><?php echo $purchaseinfo->details;?></textarea>
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
                                            <option value="1" <?php if($purchaseinfo->paymenttype==1){ echo "Selected";}?>><?php echo display('casp') ?></option>
                                            <option value="2" <?php if($purchaseinfo->paymenttype==2){ echo "Selected";}?>><?php echo display('bnkp') ?></option>
                                            <option value="3" <?php if($purchaseinfo->paymenttype==3){ echo "Selected";}?>>Due Payment</option> 
                                        </select>
                                    </div>
                                </div> 
                            </div>
                      <div class="col-sm-5">
                               <div class="form-group row" id="showbank" style="display:<?php if($purchaseinfo->paymenttype!=2){ echo "none";}?>;">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('sl_bank') ?></label>
                                    <div class="col-sm-8">
                                    	<select name="bank" id="bankid" class="form-control purchasedit_w_100">
                                            <option value=""><?php echo display('sl_bank') ?></option>
                                            <?php if(!empty($banklist)){
												foreach($banklist as $bank){?>
												 <option value="<?php echo $bank->bankid?>" <?php if($purchaseinfo->bankid==$bank->bankid){ echo "Selected";}?>><?php echo $bank->bank_name?></option>
											<?php } }?>	
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
                                <?php $i=0;
								foreach($iteminfo as $item){
									$i++;
									?>
                                    <tr>
                                        <td class="span3 supplier">
                                       <input type="text" name="product_name" required="" class="form-control product_name" onkeypress="product_list(<?php echo $i;?>);" placeholder="Item Name" id="product_name_<?php echo $i;?>" value="<?php echo $item->ingredient_name;?>" tabindex="5">
                                   <input type="hidden" class="autocomplete_hidden_value product_id_<?php echo $i;?>" name="product_id[]" id="SchoolHiddenId" value="<?php echo $item->indredientid;?>">
                                   <input type="hidden" class="sl" value="<?php echo $i;?>">
                                        </td>

                                       <td class="wt">
                                                <input type="text" id="available_quantity_<?php echo $i;?>" class="form-control text-right stock_ctn_<?php echo $i;?>" placeholder="0.00" value="<?php echo $item->stock_qty;?>" readonly="">
                                            </td>
                                        
                                            <td class="text-right">
                                                <input type="number" step="0.0001" name="product_quantity[]" id="cartoon_<?php echo $i;?>" class="form-control text-right store_cal_1" onkeyup="calculate_store(<?php echo $i;?>);" onchange="calculate_store(<?php echo $i;?>);" placeholder="0.00" value="<?php echo $item->quantity;?>" min="0" tabindex="6">
                                            </td>
                                            <td class="test">
                                                <input type="number" step="0.0001" name="product_rate[]" onkeyup="calculate_store(<?php echo $i;?>);" onchange="calculate_store(<?php echo $i;?>);" id="product_rate_<?php echo $i;?>" class="form-control product_rate_<?php echo $i;?> text-right" placeholder="0.00" value="<?php echo $item->price;?>" min="0" tabindex="7">
                                            </td>
                                           

                                            <td class="text-right">
                                                <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_<?php echo $i;?>" value="<?php echo $item->totalprice;?>" readonly="readonly">
                                            </td>
                                            <td>
                                                <button  class="btn btn-danger red text-right" type="button" value="Delete" onclick="purchasetdeleteRow(this)" tabindex="8"><?php echo display('delete') ?></button>
                                            </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <input type="button" id="add_invoice_item" class="btn btn-success" name="add-invoice-item" onclick="addmore('addPurchaseItem');" value="<?php echo display('add_more') ?> <?php echo display('item') ?>" tabindex="9">
                                        </td>
                                        <td  class="text-right" colspan="2"><b><?php echo display('grand') ?> <?php echo display('total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control" name="grand_total_price" value="<?php echo $purchaseinfo->total_price;?>" readonly="readonly">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right"><b><?php echo display('paid') ?> <?php echo display('amount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidamount" class="text-right form-control" name="paidamount" value="<?php echo $purchaseinfo->paid_amount;?>" placeholder="0.00">
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
    <script src="<?php echo base_url('application/modules/purchase/assets/js/purchaseedit_script.js'); ?>" type="text/javascript"></script>