<div class="modal fade" id="closenotice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo display('restaurant_closed'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo display('closed_msg'); ?> <?php echo $this->settinginfo->opentime; ?>- <?php echo $this->settinginfo->closetime; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo display('food_details'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body addonsinfo">
            </div>
        </div>
    </div>
</div>
<?php $iteminfo=(object)$iteminfo;?>
<!--start page header -->
<div class="product-details-content my-5">
    <div class="product-details-inner">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-8">
                    <h3><?php echo $iteminfo->ProductName; ?></h3>
                </div>
                <div class="col-lg-4 text-right">
                    <div class="social-links">
                        <a href="#" class="fb"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="tw"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="gp"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="li"><i class="fa fa-linkedin"></i></a>
                        <a href="#" class="pr"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                    <!-- /.End of social link -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="product_img">
                        <img src="<?php echo base_url(!empty($iteminfo->bigthumb) ? $iteminfo->bigthumb : 'dummyimage/555x370.jpg'); ?>" class="img-fluid" alt="<?php echo $iteminfo->ProductName; ?>">
                    </div>
                    <!--======== End Product zoom Area ========-->
                </div>
                <div class="col-md-6">
                    <div class="product-summary-content">
                        <div class="product-summary">
                            <div class="product-price row m-0">
                                <h1><?php if ($this->storecurrency->position == 1){
                                echo $this->storecurrency->curr_icon;
                                } ?><span id="vpricedt"><?php echo $iteminfo->price;?></span><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></h1>
                                
                            </div>
                        </div>
                        <p><span class="mr-2"><?php echo display('size')?>:</span> <select name="varientinfo" class="form-control details_w_50" required id="varientinfodt">
                        <?php foreach($varientlist as $thisvarient){?>
                        <option value="<?php echo $thisvarient->variantid;?>" data-title="<?php echo $thisvarient->variantName;?>" data-price="<?php echo $thisvarient->price;?>" <?php if($item->variantid==$thisvarient->variantid){ echo "selected";}?>><?php echo $thisvarient->variantName;?></option>
                        <?php }?>
                    </select></p>
                    <div class="short-description">
                        <p class="my-3"><?php echo $iteminfo->descrip; ?></p>
                    </div>
                    <div class="cart_counter">
                        <button onclick="var result = document.getElementById('sst6999_det'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                        <i class="fa fa-minus"></i>
                        </button>
                        <input type="number" name="qty" id="sst6999_det" min="1" maxlength="12" value="1" title="<?php echo display('quantity')?>:" class="input-text qty">
                        <input type="hidden" name="cartpage" id="cartpage">
                        <button onclick="var result = document.getElementById('sst6999_det'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                        <i class="fa fa-plus"></i>
                        </button>
                        <input name="sizeid" type="hidden" id="sizeid_999det" value="<?php echo $iteminfo->variantid; ?>" />
                        <input type="hidden" name="catid" id="catid_999det" value="<?php echo $iteminfo->CategoryID; ?>">
                        <input type="hidden" name="itemname" id="itemname_999det" value="<?php echo $iteminfo->ProductName; ?>">
                        <input type="hidden" name="varient" id="varient_999det" value="<?php echo $iteminfo->variantName; ?>">
                        <input type="hidden" name="cartpage" id="cartpage_999det" value="0">
                        <input name="itemprice" type="hidden" value="<?php echo $iteminfo->price; ?>" id="itemprice_999det" />
                        <input name="dpid" type="hidden" value="<?php echo $iteminfo->ProductsID; ?>" id="dpid" />
                    </div>
                    <?php
                    $openingtime = $this->settinginfo->opentime;
                    $closetime = $this->settinginfo->closetime;
                    if (strpos($openingtime, 'AM') !== false || strpos($openingtime, 'am') !== false) {
                    $starttime = strtotime($openingtime);
                    } else {
                    $starttime = strtotime($openingtime);
                    }
                    if (strpos($closetime, 'PM') !== false || strpos($closetime, 'pm') !== false) {
                    $endtime = strtotime($closetime);
                    } else {
                    $endtime = strtotime($closetime);
                    }
                    $comparetime = strtotime(date("h:i:s A"));
                    if (($comparetime >= $starttime) && ($comparetime < $endtime)) {
                    $restaurantisopen = 1;
                    } else {
                    $restaurantisopen = 1;
                    }
                    $this->db->select('*');
                    $this->db->from('menu_add_on');
                    $this->db->where('menu_id', $iteminfo->ProductsID);
                    $query = $this->db->get();
                    $getadons = "";
                    if ($query->num_rows() > 0) {
                    $getadons = 1;
                    } else {
                    $getadons =  0;
                    }?>
                    <input name="isaddons" type="hidden" value="<?php echo $getadons; ?>" id="isaddons" />
                    <?php $dayname = date('l');
                    $this->db->select('*');
                    $this->db->from('foodvariable');
                    $this->db->where('foodid', $iteminfo->ProductsID);
                    $this->db->where('availday', $dayname);
                    $query = $this->db->get();
                    $avail = $query->row();
                    $availavail = '';
                    $addtocart = 1;
                    if (!empty($avail)) {
                    $availabletime = explode("-", $avail->availtime);
                    $deltime1 = strtotime($availabletime[0]);
                    $deltime2 = strtotime($availabletime[1]);
                    $Time1 = date("h:i:s A", $deltime1);
                    $Time2 = date("h:i:s A", $deltime2);
                    $curtime = date("h:i:s A");
                    $gettime = strtotime(date("h:i:s A"));
                    if (($gettime > $deltime1) && ($gettime < $deltime2)) {
                    $availavail = '';
                    $addtocart = 1;
                    } else {
                    $availavail = '<h6 class="mt-4">Unavailable</h6>';
                    $addtocart = 0;
                    }
                    }
                    if ($restaurantisopen == 1) {
                    if ($addtocart == 1) {
                    if($getadons == 0) { ?>
                    <div id="snackbar<?php echo "999"; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                    <a onclick="addtocartitem(<?php echo $iteminfo->ProductsID; ?>,999,'det')" class="simple_btn mt-3" id="chng_<?php echo $iteminfo->ProductsID; ?>">
                        <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span></span>
                    </a>
                    <?php } else { ?>
                    <div id="snackbar<?php echo "999"; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                    <a onclick="addonsitem(<?php echo $iteminfo->ProductsID; ?>,<?php echo $iteminfo->variantid; ?>,'other')" id="chng_<?php echo $iteminfo->ProductsID; ?>" class="simple_btn mt-3" data-toggle="modal" data-target="#addons" data-dismiss="modal">
                        <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span></span>
                    </a>
                    
                    <?php }
                    } else {
                    echo $availavail;
                    }
                    } else {
                    ?>
                    <a class="simple_btn mt-3" data-toggle="modal" data-target="#closenotice" data-dismiss="modal"> <i class="ti-shopping-cart mr-2"></i><span>add to cart</span></a>
                    <?php } ?>
                    <div class="product-meta my-3">
                        <div class="posted-in">
                            <strong><?php echo display('category')?>: </strong>
                            <?php echo $category->Name; ?>
                        </div>
                        <div class="tag-as">
                            <strong><?php echo display('tag')?>: </strong>
                            <?php echo $iteminfo->component; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--end page header-->
<!--Start Product Review-->
<div class="product_review bg_two sect_pad" id="review">
<div class="container">
    <div class="product_review_inner">
        <div class="row pb-3">
            <div class="col-md-3 align-self-center">
                <div class="product_review_left">
                    <a href="#"><?php echo display('review')?> (<?php echo $totalreview->totalrate; ?>)</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="product_review_right pb-4">
                    <h5><?php echo display('review_rating')?></h5>
                    <div class="row mb-5">
                        <div class="col-lg-6">
                            <div class="rating-block text-center">
                                <h6><?php echo display('average_user_rating')?></h6>
                                <div class="rating-point center-block">
                                    <img src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/images/star.png" alt="">
                                    <h4 class="rating-count"><?php echo number_format($average->averagerating, 1); ?></h4>
                                </div>
                                <div><?php echo $totalrating->totalrate; ?> <?php echo display('rating')?> &amp;</div>
                                <div><?php echo $totalreview->totalrate; ?> <?php echo display('review')?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="rating-position">
                                <h6><?php echo display('rating_breakdown')?></h6>
                                <div class="rating-dimension">
                                    <div class="rating-quantity">
                                        <div>5 <i class="ti-star"></i></div>
                                    </div>
                                    <div class="rating-percent">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success details_w_100" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" >
                                                <span class="sr-only"><?php echo display('complete_success')?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-rating"><?php echo $rate5 = $this->db->select('*')->from('tbl_rating')->where('proid', $iteminfo->ProductsID)->where('rating>', 4.4)->get()->num_rows(); ?></div>
                                    </div><!-- /.End of rating dimension -->
                                    <div class="rating-dimension">
                                        <div class="rating-quantity">
                                            <div>4 <i class="ti-star"></i></div>
                                        </div>
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary details_w_80" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5">
                                                    <span class="sr-only"><?php echo display('80_complete_primary')?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-rating"><?php echo $rate4 = $this->db->select('*')->from('tbl_rating')->where('proid', $iteminfo->ProductsID)->where('rating >', 3.4)->where('rating <', 4.5)->get()->num_rows(); ?></div>
                                        </div><!-- /.End of rating dimension -->
                                        <div class="rating-dimension">
                                            <div class="rating-quantity">
                                                <div>3 <i class="ti-star"></i></div>
                                            </div>
                                            <div class="rating-percent">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-info details_w_60" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" >
                                                        <span class="sr-only"><?php echo display('60_complete_info')?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-rating"><?php echo $rate3 = $this->db->select('*')->from('tbl_rating')->where('proid', $iteminfo->ProductsID)->where('rating >', 2.4)->where('rating <', 3.5)->get()->num_rows(); ?></div>
                                            </div><!-- /.End of rating dimension -->
                                            <div class="rating-dimension">
                                                <div class="rating-quantity">
                                                    <div>2 <i class="ti-star"></i></div>
                                                </div>
                                                <div class="rating-percent">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning details_w_40" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" >
                                                            <span class="sr-only"><?php echo display('40_complete_warning')?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="user-rating"><?php echo $rate2 = $this->db->select('*')->from('tbl_rating')->where('proid', $iteminfo->ProductsID)->where('rating >', 1.4)->where('rating <', 2.5)->get()->num_rows(); ?></div>
                                                </div><!-- /.End of rating dimension -->
                                                <div class="rating-dimension">
                                                    <div class="rating-quantity">
                                                        <div>1 <i class="ti-star"></i></div>
                                                    </div>
                                                    <div class="rating-percent">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-danger details_w_20" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" >
                                                                <span class="sr-only"><?php echo display('20_complete_danger')?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="user-rating"><?php echo $rate2 = $this->db->select('*')->from('tbl_rating')->where('proid', $iteminfo->ProductsID)->where('rating >', 0)->where('rating <', 1.5)->get()->num_rows(); ?></div>
                                                    </div><!-- /.End of rating dimension -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <?php if ($this->session->flashdata('message')) { ?>
                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo $this->session->flashdata('message') ?>
                                            </div>
                                            <?php } ?>
                                            <?php if ($this->session->flashdata('exception')) { ?>
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo $this->session->flashdata('exception') ?>
                                            </div>
                                            <?php } ?>
                                            <?php if (validation_errors()) { ?>
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <?php echo validation_errors() ?>
                                            </div>
                                            <?php }
                                            
                                            if ($this->session->userdata('CusUserID') == TRUE) {
                                            if ($isgivenreview == 1) {
                                            ?>
                                            <div class="rating-area mb-3">
                                                <p><?php echo display('rate_it')?>:</p>
                                                <div class="rateyo-readonly-widg"></div>
                                            </div>
                                            <?php echo form_open('hungry/reviewsubmit','method="post" class="review-form"')?>
                                                <input type="hidden" id="rating" name="rating" value="">
                                                <input type="hidden" id="productid" name="productid" value="<?php echo $iteminfo->ProductsID; ?>">
                                                <input type="hidden" id="varientid" name="varientid" value="<?php echo $iteminfo->variantid; ?>">
                                                <div class="form-group">
                                                    <label><?php echo display('title')?></label>
                                                    <input type="text" class="form-control" id="title" name="title" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo display('name')?></label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php if (!empty($customerinfo)) { echo $customerinfo->customer_name; } ?>" readonly="readonly" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo display('email')?></label>
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php if (!empty($customerinfo)) { echo $customerinfo->customer_email; } ?>" readonly="readonly" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo display('review')?></label>
                                                    <textarea class="form-control" rows="5" name="review"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-success btn-sm"><?php echo display('review_submit')?></button>
                                            </form>
                                            <?php }
                                            } ?>
                                        </div>
                                        <div class="reviewer_area mt-4">
                                            <?php
                                            if (!empty($readreview)) {
                                            foreach ($readreview as $myreview) { ?>
                                            <div class="review-block">
                                                <div class="row m-0 review-block-rate">
                                                    <button type="button" class="btn btn-success btn-sm mb-2" aria-label="Left Align"><?php echo $x = round($myreview->rating / 5) * 5; ?> <i class="ti-star" aria-hidden="true"></i></button>
                                                    <h6 class="ml-0 ml-sm-3"><?php echo $myreview->title; ?></h6>
                                                </div>
                                                <p><?php echo $myreview->reviewtxt; ?></p>
                                                <div class="review-meta-row">
                                                    <div class="review-meta-inner">
                                                        <span class="review-block-name mr-4"><?php echo $myreview->name; ?></span>
                                                        <i class="ti-alarm-clock" aria-hidden="true"></i>
                                                        <span class="review-block-date"> <?php echo $newDate = date("F ,d, Y", strtotime($myreview->ratetime)); ?> <?php echo $Defference = time_elapsed($myreview->ratetime); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Product Review-->
                <!--Start Offer Area-->
                <?php if (!empty($related)) { ?>
                <section class="offer_area sect_pad">
                    <div class="container">
                        <div class="sect_title mb-4">
                            <h2><?php echo display('related_items')?></h2>
                        </div>
                        <div class="row offer_inner">
                            <div class="offer_slider owl-carousel">
                                <?php $id = 0;
                                foreach ($related as $relateditem) {
                                                        $relateditem=(object)$relateditem;
                                $id++;
                                $this->db->select('*');
                                $this->db->from('menu_add_on');
                                $this->db->where('menu_id', $relateditem->ProductsID);
                                $query = $this->db->get();
                                $getadons = "";
                                if ($query->num_rows() > 0) {
                                $getadons = 1;
                                } else {
                                $getadons =  0;
                                }
                                $dayname = date('l');
                                $this->db->select('*');
                                $this->db->from('foodvariable');
                                $this->db->where('foodid', $relateditem->ProductsID);
                                $this->db->where('availday', $dayname);
                                $query = $this->db->get();
                                $avail = $query->row();
                                $availavail = '';
                                $addtocart = 1;
                                if (!empty($avail)) {
                                $availabletime = explode("-", $avail->availtime);
                                $deltime1 = strtotime($availabletime[0]);
                                $deltime2 = strtotime($availabletime[1]);
                                $Time1 = date("h:i:s A", $deltime1);
                                $Time2 = date("h:i:s A", $deltime2);
                                $curtime = date("h:i:s A");
                                $gettime = strtotime(date("h:i:s A"));
                                if (($gettime > $deltime1) && ($gettime < $deltime2)) {
                                $availavail = '';
                                $addtocart = 1;
                                } else {
                                $availavail = '<h6 class="mt-4">Unavailable</h6>';
                                $addtocart = 0;
                                }
                                }
                                ?>
                                <div class="item">
                                    <div class="img_area">
                                        <img src="<?php echo base_url(!empty($relateditem->medium_thumb) ? $relateditem->medium_thumb : 'dummyimage/268x223.jpg'); ?>" alt="<?php echo $relateditem->ProductName ?>">
                                    </div>
                                    <div class="item_content text-center pb-4">
                                        <input name="sizeid" type="hidden" id="sizeid_<?php echo $id; ?>rel" value="<?php echo $relateditem->variantid; ?>" />
                                        <input type="hidden" name="qty" id="sst6<?php echo $id; ?>_rel" value="1">
                                        <input type="hidden" name="catid" id="catid_<?php echo $id; ?>rel" value="<?php echo $relateditem->CategoryID; ?>">
                                        <input type="hidden" name="itemname" id="itemname_<?php echo $id; ?>rel" value="<?php echo $relateditem->ProductName; ?>">
                                        <input type="hidden" name="varient" id="varient_<?php echo $id; ?>rel" value="<?php echo $relateditem->variantName; ?>">
                                        <input type="hidden" name="cartpage" id="cartpage_<?php echo $id; ?>rel" value="0">
                                        <input name="itemprice" type="hidden" value="<?php echo $relateditem->price; ?>" id="itemprice_<?php echo $id; ?>rel" />
                                        <?php if ($relateditem->OffersRate > 0) { ?>
                                        <span class="top_side">-<?php echo $relateditem->OffersRate; ?>%</span>
                                        <?php } ?>
                                        <a href="<?php echo base_url() . 'details/' . $relateditem->ProductsID . '/' . $relateditem->variantid; ?>" class="item_name"><?php echo $relateditem->ProductName ?></a>
                                        <p><?php if ($this->storecurrency->position == 1) {
                                            echo $this->storecurrency->curr_icon;
                                            } ?><?php echo $relateditem->price; ?><?php if ($this->storecurrency->position == 2) {
                                            echo $this->storecurrency->curr_icon;
                                        } ?></p>
                                        <?php
                                        if ($restaurantisopen == 1) {
                                        if ($addtocart == 1) {
                                        if($getadons == 0 && $relateditem->totalvarient==1) { ?>
                                        <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                        <a onclick="addtocartitem(<?php echo $relateditem->ProductsID; ?>,<?php echo $id; ?>,'rel')" class="simple_btn">
                                            <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span>
                                        </a>
                                        <?php } else { ?>
                                        <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                        <a onclick="addonsitem(<?php echo $relateditem->ProductsID; ?>,<?php echo $relateditem->variantid; ?>,'other')" class="simple_btn" data-toggle="modal" data-target="#addons" data-dismiss="modal">
                                            <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span>
                                        </a>
                                        <?php }
                                        } else {
                                        echo $availavail;
                                        }
                                        } else {
                                        ?>
                                        <a class="simple_btn" data-toggle="modal" data-target="#closenotice" data-dismiss="modal"> <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!--start for hidden cart-->
                <div id="cartitem" class="cartlist_display_none" ></div>
                <?php } ?>
                <!--End Offer Area-->
                <script type="text/javascript" src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/js/jquery.rateyo.js"></script>
   <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/js/details.js"></script>
               
