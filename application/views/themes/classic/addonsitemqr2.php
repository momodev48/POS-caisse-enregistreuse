<input name="mainqrid" type="hidden" id="mainqrid" value="<?php echo $type;?>" />  
<div class="item-add-ons">
                        <div class="checkbox checkbox-success">
                            <input name="itemname" type="hidden" id="itemname_1<?php echo $type;?>" value="<?php echo $item->ProductName; if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?>" />
                            <label for="addons_2" class="ml-1"><?php echo $item->ProductName;  if(!empty($item->itemnotes)){ echo " -".$item->itemnotes;}?></label>
                            <input name="sizeid" type="hidden" id="sizeid_1<?php echo $type;?>" value="<?php echo $item->variantid;?>" />
                            <input name="size" type="hidden" value="<?php echo $item->variantName;?>" id="varient_1<?php echo $type;?>" />
                            <input type="hidden" name="catid" id="catid_1<?php echo $type;?>" value="<?php echo $item->CategoryID;?>">
                        </div>
                        <div class="d-flex align-items-center justify-content-between ml-6">
                            <div class="cart_counter hidden_cart">
                                <input type="text" name="itemqty" id="sst61_<?php echo $type;?>" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                <button onclick="var result = document.getElementById('sst61_<?php echo $type;?>'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                    <i class="ti-angle-up"></i>
                                </button>
                            </div>
                            <p>
                            <input name="itemprice" type="hidden" value="<?php echo $item->price;?>" id="itemprice_1<?php echo $type;?>" /><input type="hidden" name="cartpage" id="cartpage_1<?php echo $type;?>" value="<?php if($type=="menu"){echo "1";}else{echo "0";}?>"> 
                            <?php echo $item->price;?></p>
                        </div>
                    </div>
                    <?php $k=0;
							   foreach($addonslist as $addons){
								   $k++;
								   ?>
                    
<div class="item-add-ons">
                        <div class="checkbox checkbox-success">
                            <input type="checkbox" role="<?php echo $addons->price;?>" title="<?php echo $addons->add_on_name;?>" name="addons" value="<?php echo $addons->add_on_id;?>" id="addons_<?php echo $addons->add_on_id;?>">
                            <label for="addons_<?php echo $addons->add_on_id;?>" class="ml-1"><?php echo $addons->add_on_name;?></label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between ml-6">
                            <div class="cart_counter hidden_cart">
                                <button onclick="var result = document.getElementById('addonqty_<?php echo $addons->add_on_id;?>'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                    <i class="ti-angle-down"></i>
                                </button>
                                <input type="text" name="addonqty" id="addonqty_<?php echo $addons->add_on_id;?>" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                <button onclick="var result = document.getElementById('addonqty_<?php echo $addons->add_on_id;?>'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                    <i class="ti-angle-up"></i>
                                </button>
                            </div>
                            <p><?php echo $addons->price;?></p>
                        </div>
                    </div>
                 <?php } ?>
				 <?php 
 if($type=="menu"){$flag="menu";}else{ $flag="other";}
?><button class="simple_btn" onclick="addextra2(<?php echo $item->ProductsID;?>,1,'<?php echo $flag;?>',<?php echo $orderid;?>)">
                            <span><?php echo display('add') ?></span>
                        </button>