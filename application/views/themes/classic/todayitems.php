
<div class="row">
<?php 
if(!empty($todaymenu_food)){
	$id=0;
foreach($todaymenu_food as $tmenuf){
	$tmenuf=(object)$tmenuf;
$id++;
$this->db->select('*');
									$this->db->from('menu_add_on');
									$this->db->where('menu_id',$tmenuf->ProductsID);
									$query = $this->db->get();
									$getadons="";
									if ($query->num_rows() > 0) {
									$getadons = 1;
									}
									else{
										$getadons =  0;
										}
									$dayname= date('l');
									$this->db->select('*');
									$this->db->from('foodvariable');
									$this->db->where('foodid',$tmenuf->ProductsID);
									$this->db->where('availday',$dayname);
									$query = $this->db->get();
									$avail=$query->row();
									$availavail='';
									$addtocart=1;
									if(!empty($avail)){
												  $availabletime=explode("-",$avail->availtime);
												    $deltime1 =strtotime($availabletime[0]);
													$deltime2 =strtotime($availabletime[1]);
													$Time1=date("h:i:s A", $deltime1);
													$Time2=date("h:i:s A", $deltime2);
													$curtime=date("h:i:s A");
													$gettime = strtotime(date("h:i:s A"));
													if(($gettime>$deltime1) && ($gettime<$deltime2)){
														$availavail='';
														$addtocart=1;
														}
													else{
														$availavail='<h6 class="mt-4">Unavailable</h6>';
														$addtocart=0;
														}
										}	
?>
                        <div class="col-xl-6 offset-xl-0 col-lg-8 offset-lg-2">
                            <div class="single_item">
                                <div class="row mb-3">
                                <div id="snackbar<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>" class="snackbar">Item has been successfully added</div>
                                    <div class="item_img col-sm-3">
                                        <img src="<?php echo base_url(!empty($tmenuf->small_thumb)?$tmenuf->small_thumb:'dummyimage/250x250.jpg'); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="item_details col-sm-6 pl-0">
                                        <a href="<?php echo base_url().'details/'.$tmenuf->ProductsID.'/'.$tmenuf->variantid;?>" class="item_title"><?php echo $tmenuf->ProductName;?></a>
                                        <h5 class="d-sm-none d-block"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $tmenuf->price;?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></h5>
                                        <?php if(!empty($tmenuf->descrip)){?><p>(<?php echo substr($tmenuf->descrip,0,50);?>)</p><?php } ?>
                                        <div class="d-flex align-items-center jc-xs mt-2">
                                        	<?php if($addtocart==1){
												if($getadons==0  && $tmenuf->totalvarient==1){?>
                                                <input name="sizeid" type="hidden" id="sizeid_<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>other" value="<?php echo $tmenuf->variantid;?>" />
                        <input type="hidden" name="catid" id="catid_<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>other" value="<?php echo $tmenuf->CategoryID;?>">
                        <input type="hidden" name="itemname" id="itemname_<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>other" value="<?php echo $tmenuf->ProductName;?>">
                        <input type="hidden" name="varient" id="varient_<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>other" value="<?php echo $tmenuf->variantName;?>">
                        <input type="hidden" name="cartpage" id="cartpage_<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>other" value="0">
                         <input name="itemprice" type="hidden" value="<?php echo $tmenuf->price;?>" id="itemprice_<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>other" />
                            
                          <a onclick="addtocartitem(<?php echo $tmenuf->ProductsID;?>,<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>,'other')" class="simple_btn mt-0 mr-2 text-white">add to cart</a>
                                            <div class="cart_counter">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>_other'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="text" name="qty" id="sst6<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>_other" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>_other'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            
                                            <?php } else{?>
                                            <a onclick="addonsitem(<?php echo $tmenuf->ProductsID;?>,<?php echo $tmenuf->variantid;?>,'other')" class="simple_btn mt-0 mr-2 text-white" data-toggle="modal" data-target="#addons" data-dismiss="modal">add to cart</a>
                                            <div class="cart_counter">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>_other'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst >= 1 ) result.value--;return false;" class="reduced items-count" type="button">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="text" name="qty" id="sst6<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>_other" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $tmenuf->ProductsID.$tmenuf->variantid.$mtype;?>_other'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>                        
                                            <?php } 
												}
												else{
												echo $availavail;
												 } ?>
                                        </div>
                                    </div>
                                    <div class="item_info col-sm-3 text-center">
                                        <h5 class="mb-0"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $tmenuf->price;?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></h5>
                                        <?php $ratingp=$this->hungry_model->read_average('tbl_rating','rating','proid',$deals->ProductsID);
							if(!empty($ratingp)){
								$averagerating=round(number_format($ratingp->averagerating,1));
							?>
                                        <div class="rating_area">
                                            <div class="rate-container">
                                                <?php if($averagerating==5){?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <?php }
                                                if($averagerating==4){
                                                 ?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php }
                                                if($averagerating==3){
                                                 ?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php } if($averagerating==2){?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php } if($averagerating==1){?>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php } 
                                                if($averagerating<1){?>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <?php } ?>
                                               
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <p><?php echo $tmenuf->variantName;?></p>
                                        <?php if($addtocart==1){echo "";}else{?>
                                        <h6>Unavailable</h6>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } }?>
                    </div>
                    <div id="load_data_message"></div>