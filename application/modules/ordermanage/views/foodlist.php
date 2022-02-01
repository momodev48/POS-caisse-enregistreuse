<div class="table-wrapper-scroll-y">
<table class="table table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('item_information')?></th>
                                            <th class="text-center"><?php echo display('size')?></th>
                                            <th class="text-center wp_100"><?php echo display('qty')?></th> 
                                            <th class="text-center wp_120"><?php echo display('price')?></th>  
                                            <th class="text-center"></th>
                                        </tr>
                                </thead>
                                <tbody id="addItem">
                                <?php $i=0; 
								foreach($itemlist as $item){
									$i++;
									$this->db->select('*');
									$this->db->from('menu_add_on');
									$this->db->where('menu_id',$item->ProductsID);
									$query = $this->db->get();
									$getadons="";
									if ($query->num_rows() > 0) {
									$getadons = 1;
									$readonly='readonly="readonly"';
									}
									else{
										$getadons =  0;
										$readonly='';
										}
									?>
                                    <tr>
                                        <td>
                    				<input name="itemname" type="hidden" id="itemname_<?php echo $i?>" value="<?php echo $item->ProductName;  if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>" />
                                     	<?php echo $item->ProductName; if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>
                                        </td>
                                        <td>
                                        <input name="sizeid" type="hidden" id="sizeid_<?php echo $i?>" value="<?php echo $item->variantid;?>" />
                                        <input name="size" type="hidden" value="<?php echo $item->variantName;?>" id="size_<?php echo $i;?>" />
                                        <?php echo $item->variantName;?>
                                        </td>
                                        <td>
                                        <input type="number" name="itemqty" id="itemqty_<?php echo $i?>" class="form-control text-right" value="1" min="1" <?php echo $readonly;?> />
                                        </td>
                                         <td>
                                        <input name="itemprice" type="hidden" value="<?php echo $item->price;?>" id="itemprice_<?php echo $i;?>" />
                                        <?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item->price;?> <?php if($currency->position==2){echo $currency->curr_icon;}?>
                                        </td>
                                            <td><?php if($getadons==1){?>
												 <a class="btn btn-success" onclick="addonsitem(<?php echo $item->ProductsID;?>,<?php echo $item->variantid;?>)" data-toggle="modal" data-target="#edit" data-dismiss="modal"><?php echo display('add_to_cart')?></a>
												<?php }
											else{
											?>
                                               <a class="btn btn-success" onclick="addfoodtocart(<?php echo $item->ProductsID;?>,<?php echo $i;?>)"><?php echo display('add_to_cart')?></a><?php } ?>
                                            </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
</div>                            