                <?php $openingtime=$this->settinginfo->opentime;
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
					$restaurantisopen=1;
					}
				if(!empty($searchresult)){
					$id=0;
				foreach($searchresult as $menuitem){
					$menuitem=(object)$menuitem;
					$id++;
									$this->db->select('*');
									$this->db->from('menu_add_on');
									$this->db->where('menu_id',$menuitem->ProductsID);
									$query = $this->db->get();
									$getadons="";
									if ($query->num_rows() > 0) {
									$getadons = 1;
									}
									else{
										$getadons =  0;
										}
					?>
                    <div class="single_item row mb-3">
                        <div class="item_img col-sm-3">
                            <img src="<?php echo base_url(!empty($menuitem->medium_thumb)?$menuitem->medium_thumb:'assets/img/no-image.png'); ?>" class="img-fluid" alt="<?php echo $menuitem->ProductName?>">
                        </div>
                        <div class="item_details col-lg-6 col-sm-5 pl-0">
                            <a href="<?php echo base_url().'details/'.$menuitem->ProductsID.'/'.$menuitem->variantid;?>" class="item_title"><?php echo $menuitem->ProductName?></a>
                            <?php $ratingp=$this->hungry_model->read_average('tbl_rating','rating','proid',$menuitem->ProductsID);
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
                            <p><?php echo $menuitem->variantName?></p>
                            <?php 
									$dayname= date('l');
									$this->db->select('*');
									$this->db->from('foodvariable');
									$this->db->where('foodid',$menuitem->ProductsID);
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
														$availavail='<h6>Unavailable</h6>';
														$addtocart=0;
														}
										}
							if($restaurantisopen==1){
							if($addtocart==1){
							if($getadons == 0 && $menuitem->totalvarient==1){?>
                            <input name="sizeid" type="hidden" id="sizeid2_<?php echo $id;?>menu" value="<?php echo $menuitem->variantid;?>" />
                            <input type="hidden" name="catid" id="catid2_<?php echo $id;?>menu" value="<?php echo $menuitem->CategoryID;?>">
                            <input type="hidden" name="itemname" id="itemname2_<?php echo $id;?>menu" value="<?php echo $menuitem->ProductName;?>">
                            <input type="hidden" name="varient" id="varient2_<?php echo $id;?>menu" value="<?php echo $menuitem->variantName;?>">
                            <input type="hidden" name="cartpage" id="cartpage2_<?php echo $id;?>menu" value="1">
                             <input name="itemprice" type="hidden" value="<?php echo $menuitem->price;?>" id="itemprice2_<?php echo $id;?>menu" />
                          <div id="snackbar<?php echo $id;?>" class="snackbar">Item has been successfully added</div>
                            <a onclick="addtocartitem2(<?php echo $menuitem->ProductsID;?>,<?php echo $id;?>,'menu')" class="simple_btn mt-1">add to cart</a>
                            <?php } else{?>
                            <a onclick="addonsitem2(<?php echo $menuitem->ProductsID;?>,<?php echo $menuitem->variantid;?>,'menu')" class="simple_btn mt-1"data-toggle="modal" data-target="#addons" data-dismiss="modal">add to cart</a>
                            <?php } 
							}
							}else{
							?>
                            <a class="simple_btn mt-1"data-toggle="modal" data-target="#closenotice" data-dismiss="modal"> <i class="ti-shopping-cart mr-2"></i><span>add to cart</span></a>
								<?php }
							?>
                        </div>
                        <div class="item_info col-lg-3 col-sm-4 text-center">
                            <h4><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $menuitem->price;?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></h4>
                            
                           <?php echo $availavail;?>
                            <div class="cart_counter">
                                <button onclick="var result = document.getElementById('sst6<?php echo $id;?>_menu'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" name="qty" id="sst6<?php echo $id;?>_menu" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                <button onclick="var result = document.getElementById('sst6<?php echo $id;?>_menu'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                 <?php } } else{ ?>
                 <div class="single_item row mb-3">
                        <div class="item_details col-lg-6 col-sm-5 pl-0 text-center">
                            <a href="<?php echo base_url().'menu';?>" class="item_title"><?php echo "No Result Found!!!!";?></a>
                            
                        </div>
                    </div>
                 <?php } ?>
                    <nav><?php echo $links;?>
                       
                    </nav>
