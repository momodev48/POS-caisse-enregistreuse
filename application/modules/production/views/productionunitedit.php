<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                   
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo display('set_productionunit') ?></legend>
                    </fieldset>
                    <?php echo form_open_multipart('production/production/update_entry',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                     <?php echo form_hidden('itemid', (!empty($productioninfo->foodid)?$productioninfo->foodid:null)); ?>
                     <input name="url" type="hidden" id="url" value="<?php echo base_url("production/production/productionitem") ?>" />

                    <div class="row">
                             <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-4 col-form-label"><?php echo display('item_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php if(empty($item)){$item = array('' => '--Select--');}
										echo form_dropdown('foodid',$item,(!empty($productioninfo->foodid)?$productioninfo->foodid:null),'class="form-control" id="foodid" onchange="selectfoodvarient()"') 
										?>
                                    </div>
                                </div> 
                            </div>
                             <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-2 col-form-label"><?php echo display('varient_name') ?> <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php 
						if(empty($item)){$item = array('' => '--Select--');}
						echo form_dropdown('foodvarientid',$varientinfo,(!empty($productioninfo->pvarientid)?$productioninfo->pvarientid:null),'class="form-control" id="foodvarientid"') ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                     <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center" width="20%"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                            <th class="text-center"><?php echo display('qty') ?> <i class="text-danger">*</i></th>
                                            <th class="text-center"><?php echo display('price')?> </i></th>
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
                                   <input type="hidden" class="autocomplete_hidden_value product_id_<?php echo $i;?>" name="product_id[]" id="SchoolHiddenId" value="<?php echo $item->ingredientid;?>">
                                   <input type="hidden" class="sl" value="<?php echo $i;?>">
                                   
                                        </td>
                                            <td class="text-right">
                                                <input type="text" name="product_quantity[]" id="cartoon_<?php echo $i;?>" class="form-control text-right store_cal_<?php echo $i;?>" placeholder="0.00" value="<?php echo $item->qty;?>" onkeyup='calprice(this)' min="0" tabindex="6">
                                            </td>
                                         
                                             <td class="text-right">
                                                <input type="text"  id="price_<?php echo $i;?>" class="form-control text-right store_cal_1" placeholder="0.00" value="<?php echo $item->uprice*$item->qty;?>" min="0" tabindex="6" readonly>
                                            </td>
                                            <td>
                                               <input type="hidden" id="unit-total_<?php echo $i;?>" value="<?php echo $item->uprice;?>" class="" />
                                                <button  class="btn btn-danger red text-right" type="button" value="Delete" onclick="deleteRow(this)" tabindex="8"><?php echo display('delete') ?></button>
                                            </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <input type="button" id="add_invoice_item" class="btn btn-success" name="add-invoice-item" onclick="addmore('addPurchaseItem');" value="<?php echo display('add_more') ?> <?php echo display('item') ?>" tabindex="9">
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
<script src="<?php echo base_url('application/modules/production/assets/js/productionedit.js'); ?>" type="text/javascript"></script>