<?php $webinfo= $this->webinfo;
$activethemeinfo=$this->themeinfo;
$acthemename=$activethemeinfo->themename;

$openingtime=$this->settinginfo->opentime;
$closetime=$this->settinginfo->closetime;
if(strpos($openingtime, 'AM') !== false || strpos($openingtime, 'am') !== false) {
 $starttime= strtotime($openingtime);
}else{
	$starttime= strtotime($openingtime);
}
if(strpos($closetime, 'PM') !== false || strpos($closetime, 'pm') !== false) {
 $endtime= strtotime($closetime);
}else{
	$endtime= strtotime($closetime);
}
$comparetime = strtotime(date("h:i:s A"));
if(($comparetime>=$starttime) && ($comparetime<$endtime)){
	$restaurantisopen=1;
}else{
	$restaurantisopen=0;
	}
?>
<div class="product_sec sec_mar only-sm" id="qrsearch2">
	<div class="container-fluid">
    	<div class="row">
                <div class="col-12">
                    <h5 class="sm_heading">Search Result</h5>
                </div>
            </div>
        <div class="row">
                        <div class="col-12">
                            <?php
                                $k=0;
                                foreach($itemlist as $item){
                                $k++;
                                $this->db->select('*');
                                            $this->db->from('menu_add_on');
                                            $this->db->where('menu_id',$item->ProductsID);
                                            $query = $this->db->get();
                                            $getadons="";
                                            if ($query->num_rows() > 0) {
                                            $getadons = 1;
                                            }
                                            else{
                                                $getadons =  0;
                                                }
                            ?>
                            <div class="product product--card d-flex align-items-center">
                                <div class="product__thumbnail">
                                    <img src="<?php echo base_url(!empty($item->medium_thumb)?$item->medium_thumb:'assets/img/no-image.png'); ?>" class="hoverImg" alt="Product Image">
                                </div>
        
                                <div class="product_info">
        
                                    <div class="product-desc">
                                        <a href="<?php echo base_url().'app-details/'.$item->ProductsID.'/'.$item->variantid;?>" class="menu_title"><?php echo $item->ProductName?></a>
                                        <p><?php echo substr($item->descrip,0,60); ?></p>
                                    </div>
        
                                    <div class="price_area">
                                        <div class="d-flex align-items-center">
                                            <p class="price"><?php echo $item->price;?></p>
                                            <a href="#" class="variant_btn"><?php echo $item->variantName;?></a>
                                        </div>
                                        <?php if($restaurantisopen==1){
                                        if($getadons==1){?>
                                        <input name="sizeid" type="hidden" id="sizeid_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->variantid;?>" />
                                        <input type="hidden" name="catid" id="catid_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->CategoryID;?>">
                                        <input type="hidden" name="itemname" id="itemname_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->ProductName;?>">
                                        <input type="hidden" name="varient" id="varient_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->variantName;?>">
                                        <input type="hidden" name="cartpage" id="cartpage_<?php echo $item->CategoryID.$k;?>" value="1">
                                        <input name="itemprice" type="hidden" value="<?php echo $item->price;?>" id="itemprice_<?php echo $item->CategoryID.$k;?>" />
        
                                             <?php $myid2=$item->CategoryID.$item->ProductsID.$item->variantid;
                                            if(count($this->cart->contents())>0){
                                                    $allid2="";
                                                    foreach ($this->cart->contents() as $cartitem){	
                                                        if($cartitem['id']==$myid2){ $allid2.=$myid2.",";?>
                                                        <button class="simple_btn d-none" id="backadd<?php echo $item->CategoryID.$k;?>" onClick="addonsitemqr('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)">
                                            <span><?php echo display('add') ?></span>
                                        </button>
                                            <div class="cart_counter active" id="removeqtyb<?php echo $item->CategoryID.$k;?>">
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemreduce('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="reduced items-count" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" name="qty" id="sst<?php echo $item->CategoryID.$k;?>" maxlength="12" value="<?php echo $cartitem['qty'];?>" title="Quantity:" class="input-text qty" onchange="changeqty('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" readonly>
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemincrese('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="increase items-count" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                                    <?php } }
                                                    $str2 = implode(',',array_unique(explode(',', $allid2)));
                                                $myvalue2=trim($str2,',');
                                                if($myid2!=$myvalue2){?>
                                                <button class="simple_btn" id="backadd<?php echo $item->CategoryID.$k;?>" onClick="addonsitemqr('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)">
                                            <span><?php echo display('add') ?></span>
                                        </button>
                                        <div class="cart_counter hidden_cart" id="removeqtyb<?php echo $item->CategoryID.$k;?>">
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemreduce('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="reduced items-count" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" name="qty" id="sst<?php echo $item->CategoryID.$k;?>" maxlength="12" value="<?php echo $cartitem['qty'];?>" title="Quantity:" class="input-text qty" onchange="changeqty('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" readonly>
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemincrese('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="increase items-count" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                                <?php }
                                                }
                                                else{
                                            ?>
                                        <button class="simple_btn" id="backadd<?php echo $item->CategoryID.$k;?>" onClick="addonsitemqr('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)">
                                            <span><?php echo display('add') ?></span>
                                        </button>
                                        <div class="cart_counter hidden_cart" id="removeqtyb<?php echo $item->CategoryID.$k;?>">
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemreduce('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="reduced items-count" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" name="qty" id="sst<?php echo $item->CategoryID.$k;?>" maxlength="12" value="1" title="Quantity:" class="input-text qty" onchange="changeqty('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" readonly>
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemincrese('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="increase items-count" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <?php } }
                                        else{
                                        ?>
                                        <input name="sizeid" type="hidden" id="sizeid_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->variantid;?>" />
                                        <input type="hidden" name="catid" id="catid_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->CategoryID;?>">
                                        <input type="hidden" name="itemname" id="itemname_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->ProductName;?>">
                                        <input type="hidden" name="varient" id="varient_<?php echo $item->CategoryID.$k;?>" value="<?php echo $item->variantName;?>">
                                        <input type="hidden" name="cartpage" id="cartpage_<?php echo $item->CategoryID.$k;?>" value="1">
                                        <input name="itemprice" type="hidden" value="<?php echo $item->price;?>" id="itemprice_<?php echo $item->CategoryID.$k;?>" />
                                        <?php $myid=$item->CategoryID.$item->ProductsID.$item->variantid;
                                        if(count($this->cart->contents())>0){	
                                        //echo "hi";								
                                            $allid="";
                                            foreach ($this->cart->contents() as $cartitem){	
                                            //print_r($cartitem);									
                                                if($cartitem['id']==$myid){ $allid.=$myid.","; //echo $myid;?>
                                        <button class="simple_btn d-none" id="backadd<?php echo $item->CategoryID.$k;?>" onClick="appcart('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)">
                                            <span><?php echo display('add') ?></span>
                                        </button>
                                        <div class="cart_counter active" id="removeqtyb<?php echo $item->CategoryID.$k;?>">
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemreduce('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="reduced items-count" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" name="qty" id="sst<?php echo $item->CategoryID.$k;?>" maxlength="12" value="<?php echo $cartitem['qty'];?>" title="Quantity:" class="input-text qty" onchange="changeqty('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" readonly>
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemincrese('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="increase items-count" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <?php }else if($cartitem['id']!=$myid){}?>
                                                
                                                <?php  }
                                                $str = implode(',',array_unique(explode(',', $allid)));
                                                $myvalue=trim($str,',');
                                                if($myid!=$myvalue){?>
                                                <button class="simple_btn" id="backadd<?php echo $item->CategoryID.$k;?>" onClick="appcart('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)">
                                            <span><?php echo display('add') ?></span>
                                        </button>
                                        <div class="cart_counter hidden_cart" id="removeqtyb<?php echo $item->CategoryID.$k;?>">
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemreduce('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="reduced items-count" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" name="qty" id="sst<?php echo $item->CategoryID.$k;?>" maxlength="12" value="1" title="Quantity:" class="input-text qty" onchange="changeqty('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" readonly>
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemincrese('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="increase items-count" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                                <?php }
                                         }
                                        else{
                                            //echo "hello";
                                        ?>
                                        <button class="simple_btn" id="backadd<?php echo $item->CategoryID.$k;?>" onClick="appcart('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)">
                                            <span><?php echo display('add') ?></span>
                                        </button>
                                        <div class="cart_counter hidden_cart" id="removeqtyb<?php echo $item->CategoryID.$k;?>">
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemreduce('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="reduced items-count" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" name="qty" id="sst<?php echo $item->CategoryID.$k;?>" maxlength="12" value="1" title="Quantity:" class="input-text qty" onchange="changeqty('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" readonly>
                                            <button id="<?php echo $item->CategoryID.$k;?>" onclick="itemincrese('<?php echo $item->ProductsID;?>','<?php echo $item->variantid;?>',<?php echo $item->CategoryID.$k;?>)" class="increase items-count" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <?php } } }else{ ?>
                                        <a class="simple_btn"data-toggle="modal" data-target="#closenotice" data-dismiss="modal"> <span><?php echo display('add') ?></span></a>
                                        <?php } ?>
                                    </div>
        
                                </div>
                            </div>
                            
                            <?php } ?>
                            
                        </div>
                    </div>
    </div>
</div>