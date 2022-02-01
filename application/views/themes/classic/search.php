               <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div class="show_results">
                            <h6 class="mb-0"><?php echo $showing;?></h6>
                        </div>
                        <div class="gl-buttons">
                            <button class="grid">
                                <i class="ti-layout-grid3"></i>
                            </button>
                            <button class="list">
                                <i class="ti-view-list-alt"></i>
                            </button>
                        </div>
                    </div>
                    <ul class="list-unstyled grid-container">
			   <?php 
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
					?>
                        <li class="single_item">
                        <div id="snackbar<?php echo $id;?>" class="snackbar">Item has been successfully added</div>
                            <div class="row mb-3">
                                <div class="item_img">
                                    <img src="<?php echo base_url(!empty($menuitem->medium_thumb)?$menuitem->medium_thumb:'assets/img/no-image.png'); ?>" class="img-fluid" alt="<?php echo $menuitem->ProductName?>">
                                </div>
                                <div class="item_details">
                                    <a href="<?php echo base_url().'details/'.$menuitem->ProductsID.'/'.$menuitem->variantid;?>" class="item_title"><?php echo $menuitem->ProductName?></a>
                                    <div class="grid_only">
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
                                        <h6 class="mb-0"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $menuitem->price;?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></h6>
                                    </div>
                                    <div class="xs_only">
                                        <h6 class="mb-0 text-center"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $menuitem->price;?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></h6>
                                    </div>
                                    <?php if(!empty($menuitem->descrip)){?><p>(<?php echo substr($menuitem->descrip,0,50);?>)</p><?php } ?>
                                    <?php if($addtocart==1){
												if($getadons == 0 && $menuitem->totalvarient==1){?>
                                                <div class="d-flex align-items-center mt-2">
                                    <input name="sizeid" type="hidden" id="sizeid_<?php echo $id;?>other" value="<?php echo $menuitem->variantid;?>" />
                        <input type="hidden" name="catid" id="catid_<?php echo $id;?>other" value="<?php echo $menuitem->CategoryID;?>">
                        <input type="hidden" name="itemname" id="itemname_<?php echo $id;?>other" value="<?php echo $menuitem->ProductName;?>">
                        <input type="hidden" name="varient" id="varient_<?php echo $id;?>other" value="<?php echo $menuitem->variantName;?>">
                        <input type="hidden" name="cartpage" id="cartpage_<?php echo $id;?>other" value="0">
                         <input name="itemprice" type="hidden" value="<?php echo $menuitem->price;?>" id="itemprice_<?php echo $id;?>other" />
                            
                          <a onclick="addtocartitem(<?php echo $menuitem->ProductsID;?>,<?php echo $id;?>,'other')" class="simple_btn mt-0 mr-2 text-white">add to cart</a>
                                            <div class="cart_counter">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $id;?>_other'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="text" name="qty" id="sst6<?php echo $id;?>_other" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $id;?>_other'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                               
                                </div>
                                </div>                                    
                                   <?php } else{?> 
                                    <div class="d-flex align-items-center mt-2">
                                        <a onclick="addonsitem(<?php echo $menuitem->ProductsID;?>,<?php echo $menuitem->variantid;?>,'other')" class="simple_btn mt-0 mr-2 text-white" data-toggle="modal" data-target="#addons" data-dismiss="modal">add to cart</a>
                                        <div class="cart_counter">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $id;?>_other'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst >= 1 ) result.value--;return false;" class="reduced items-count" type="button">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input type="text" name="qty" id="sst6<?php echo $id;?>_other" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                                <button onclick="var result = document.getElementById('sst6<?php echo $id;?>_other'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                    </div>
                                 <?php } } ?>
                                 </div>
                                <div class="item_info text-center">
                                    <h5 class="mb-0"><?php if($this->storecurrency->position==1){echo $this->storecurrency->curr_icon;}?><?php echo $menuitem->price;?><?php if($this->storecurrency->position==2){echo $this->storecurrency->curr_icon;}?></h5>
                                    <?php $ratingpt=$this->hungry_model->read_average('tbl_rating','rating','proid',$menuitem->ProductsID);
							if(!empty($ratingpt)){
								$averageratingt=round(number_format($ratingpt->averagerating,1));
							?>
                                    <div class="rating_area">
                                        <div class="rate-container">
                                	<?php if($averageratingt==5){?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <?php }
									if($averageratingt==4){
									 ?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php }
									if($averageratingt==3){
									 ?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php } if($averageratingt==2){?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php } if($averageratingt==1){?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php } 
									if($averageratingt<1){?>
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
							if($addtocart==1){echo "";}
								else{
							?>
                                    <h6>Unavailable</h6>
                                    <?php }?>
                                </div>
                            </div>
                        </li>
                        <?php } } else{ ?>
                        <li class="single_item">
                            <div class="row mb-3">
                                <a href="<?php echo base_url().'menu';?>" class="item_title"><?php echo "No Result Found!!!!";?></a>
                            </div>
                        </li>
                        <?php } ?>
                  </ul>
                    <nav><?php echo $links;?>
                       
                    </nav>
