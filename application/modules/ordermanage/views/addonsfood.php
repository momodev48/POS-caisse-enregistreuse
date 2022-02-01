<table class="table table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('item_information')?></th>
                                            <th class="text-center"><?php echo display('size')?></th>
                                            <th class="text-center wp_100"><?php echo display('qty')?></th> 
                                            <th class="text-center wp_120"><?php echo display('price')?></th>  
                                        </tr>
                                </thead>
                                <tbody id="addItem">
                                    <tr>
                                        <td>
                    				<input name="itemname" type="hidden" id="itemname_<?php echo "1";?>" value="<?php echo $item->ProductName; if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>" />
                                     	<?php echo $item->ProductName;  if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>
                                        </td>
                                        <td>
                                        <input name="sizeid" type="hidden" id="sizeid_<?php echo "1";?>" value="<?php echo $item->variantid;?>" />
                                        <input name="size" type="hidden" value="<?php echo $item->variantName;?>" id="size_<?php echo 1;?>" />
                                        <?php echo $item->variantName;?>
                                        </td>
                                        <td>
                                        <input type="number" name="itemqty" id="itemqty_<?php echo "1";?>" class="form-control text-right" value="1" min="1"/>
                                        </td>
                                         <td>
                                        <input name="itemprice" type="hidden" value="<?php echo $item->price;?>" id="itemprice_<?php echo "1";?>" />
                                        <?php echo $item->price;?>
                                        </td>
                                          
                                    </tr>
                                   
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
<table class="table table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center"><?php echo display('addons_name')?></th>
                                            <th class="text-center wp_100"><?php echo display('addons_qty')?></th>
                                            <th class="text-center"><?php echo display('price')?></th>
                                           
                                        </tr>
                                </thead>
                                <tbody>
                               <?php $k=0;
							   foreach($addonslist as $addons){
								   $k++;
								   ?>
                                    <tr>
                                    	<td><div class="checkbox checkbox-success">
                                    <input type="checkbox" role="<?php echo $addons->price;?>" title="<?php echo $addons->add_on_name;?>" name="addons" value="<?php echo $addons->add_on_id;?>"  id="addons_<?php echo $addons->add_on_id;?>">
                                        <label for="addons_<?php echo $addons->add_on_id;?>"></label>
                                    </div></td>
                                        <td class="text-center"><?php echo $addons->add_on_name;?></td>
                                         <td>
                                        <input type="number" name="addonqty" id="addonqty_<?php echo $addons->add_on_id;?>" class="form-control text-right" value="1" min="1"/>
                                        </td>
                                        <td class="text-center"><?php echo $addons->price;?></td>
                                    </tr>
                                    <?php } ?>
                                     
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>
                            <a class="btn btn-success" onclick="addonsfoodtocart(<?php echo $item->ProductsID;?>,1)"><?php echo display('add_to_cart')?></a>
