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
<div class="page_header">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="page_header_content">
                    <ul class="m-0 nav">
                        <li><a href="<?php echo base_url(); ?>"><?php echo display('home')?></a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li class="active"><a><?php echo $title; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--start product Details -->
<?php $iteminfo=(object)$iteminfo;?>
<div class="product-details-content sect_pad">
    <div class="product-details-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="demo">
                        <div class="item">
                            <div class="clearfix">
                                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                    <li data-thumb="<?php echo base_url(!empty($iteminfo->bigthumb) ? $iteminfo->bigthumb : 'dummyimage/555x370.jpg'); ?>">
                                        <img src="<?php echo base_url(!empty($iteminfo->bigthumb) ? $iteminfo->bigthumb : 'dummyimage/555x370.jpg'); ?>" alt="<?php echo $iteminfo->ProductName; ?>">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--======== End Product zoom Area ========-->
                </div>
                <div class="col-md-6">
                    <div class="product-summary-content">
                        <h2 class="font-roboto"><?php echo $iteminfo->ProductName; ?></h2>
                        <?php $ratingp = $this->hungry_model->read_average('tbl_rating', 'rating', 'proid', $iteminfo->ProductsID);
                        if (!empty($ratingp)) {
                            $averagerating = round(number_format($ratingp->averagerating, 1));
                        ?>
                            <div class="rating_area">
                                <div class="rate-container">
                                    <?php if ($averagerating == 5) { ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    <?php }
                                    if ($averagerating == 4) {
                                    ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    <?php }
                                    if ($averagerating == 3) {
                                    ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    <?php }
                                    if ($averagerating == 2) { ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    <?php }
                                    if ($averagerating == 1) { ?>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    <?php }
                                    if ($averagerating < 1) { ?>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>

                        <div class="product-summary">
                            <div class="product-price row m-0">
                                <h4 class="my-3"><?php if ($this->storecurrency->position == 1) { echo $this->storecurrency->curr_icon; } ?><span id="vpricedt"><?php echo $iteminfo->price;?></span><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></h4>
                            </div>
                        </div>
                        <div class="short-description">
                            <p><?php echo substr($iteminfo->descrip, 0, 180); ?></p>
                        </div>
                        <div class="product-meta my-3">
                            <div class="posted-in font-roboto">
                                <strong><?php echo display('category')?>: </strong>
                                <?php echo $category->Name; ?>
                            </div>
                            <div class="tag-as font-roboto">
                                <strong><?php echo display('tag')?>: </strong>
                                <?php echo $iteminfo->component; ?>
                            </div>
                            <div class="font-roboto">
                                <strong><?php echo display('size')?>: </strong>                               
                                <select name="varientinfo" class="form-control" required id="varientinfodt" style="display:inline; width:50%">
                                        <?php foreach($varientlist as $thisvarient){?>
                                                 <option value="<?php echo $thisvarient->variantid;?>" data-title="<?php echo $thisvarient->variantName;?>" data-price="<?php echo $thisvarient->price;?>" <?php if($item->variantid==$thisvarient->variantid){ echo "selected";}?>><?php echo $thisvarient->variantName;?></option>
                                        <?php }?>
                                        </select>
                            </div>
                        </div>
                        <div class="cart_counter">
                            <button onclick="var result = document.getElementById('sst6999_det'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input type="text" name="qty" id="sst6999_det" maxlength="12" value="1" title="<?php echo display('quantity')?>:" class="input-text qty">
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
                        <div class="mt-3 action_btn">
                            <?php $this->db->select('*');
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
                            if ($addtocart == 1) {
                                if($getadons == 0) { ?>
                                    <div id="snackbar<?php echo "999"; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                    <a onclick="addtocartitem(<?php echo $iteminfo->ProductsID; ?>,999,'det')" id="chng_<?php echo $iteminfo->ProductsID; ?>" class="simple_btn btn2 mt-0 mr-2 mb-2 text-white">
                                        <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span>
                                    </a>
                                <?php } else { ?>                                    
                                    <div id="snackbar<?php echo "999"; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                    <a onclick="addonsitem(<?php echo $iteminfo->ProductsID; ?>,<?php echo $iteminfo->variantid; ?>,'other')" id="chng_<?php echo $iteminfo->ProductsID; ?>" class="simple_btn btn2 mt-0 mr-2 mb-2 text-white" data-toggle="modal" data-target="#addons" data-dismiss="modal">
                                        <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span>
                                    </a>
                            <?php }
                            } else {
                                echo $availavail;
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end product Details-->

<!--Start Product Review-->
<div class="product_review bg_two sect_pad">
    <div class="container">
        <div class="product_review_inner">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a data-toggle="pill" class="nav-link active" href="#details"><?php echo display('description')?></a></li>
                        <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#review"><?php echo display('review')?> (<?php echo $totalreview->totalrate; ?>)</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="details" class="tab-pane fade show active">
                            <?php echo $iteminfo->descrip; ?>
                        </div>
                        <div id="review" class="tab-pane fade">
                            <div class="row pb-3">
                                <div class="col-12">
                                    <div class="product_review_right pb-4">
                                        <h4 class="mb-4"><?php echo display('review_rating')?></h4>
                                        <div class="row mb-5">
                                            <div class="col-lg-6">
                                                <div class="rating-block text-center">
                                                    <h6><?php echo display('average_user_rating')?></h6>
                                                    <div class="rating-point center-block">
                                                        <img src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/img/star.png" alt="">
                                                        <h4 class="rating-count"><?php echo number_format($average->averagerating, 1); ?></h4>
                                                    </div>
                                                    <div><?php echo $totalrating->totalrate; ?> <?php echo display('rating')?> &amp;</div>
                                                    <div><?php echo $totalreview->totalrate; ?> <?php echo display('review')?></div>
                                                </div>

                                                <div class="reviewer_area mt-4">
                                                    <?php if (!empty($readreview)) {
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
                                                                        <span class="review-block-date"><?php echo $newDate = date("F ,d, Y", strtotime($myreview->ratetime)); ?> <?php echo $Defference = time_elapsed($myreview->ratetime); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php }
                                                    } ?>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="rating-position mb-5">
                                                    <h6><?php echo display('rating_breakdown')?></h6>
                                                    <div class="rating-dimension">
                                                        <div class="rating-quantity">
                                                            <div>5 <i class="ti-star"></i></div>
                                                        </div>
                                                        <div class="rating-percent">
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 100%">
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
                                                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 80%">
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
                                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 60%">
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
                                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 40%">
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
                                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: 20%">
                                                                    <span class="sr-only"><?php echo display('20_complete_danger')?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="user-rating"><?php echo $rate2 = $this->db->select('*')->from('tbl_rating')->where('proid', $iteminfo->ProductsID)->where('rating >', 0)->where('rating <', 1.5)->get()->num_rows(); ?></div>
                                                    </div><!-- /.End of rating dimension -->
                                                </div>
                                                <h5 class="mb-4"><?php echo display('french_chicken_burger_tomato_sauce')?></h5>
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
                                                    //echo $isgivenreview;
                                                    if ($this->session->userdata('CusUserID') == TRUE) {
                                                        if ($isgivenreview == 1) {
                                                        ?>
                                                            <div class="rating-area">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        if(!empty($avail)) {
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
                                <p><?php if ($this->storecurrency->position == 1) { echo $this->storecurrency->curr_icon;
                                    } ?><?php echo $relateditem->price; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></p>
                                <?php if ($addtocart == 1) {
                                    if($getadons == 0 && $relateditem->totalvarient==1) { ?>
                                    	<div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                        <a onclick="addtocartitem(<?php echo $relateditem->ProductsID; ?>,<?php echo $id; ?>,'rel')" class="simple_btn text-white">
                                            <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span>
                                        </a>
                                    <?php } else { ?>
                                        <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                        <a onclick="addonsitem(<?php echo $relateditem->ProductsID; ?>,<?php echo $relateditem->variantid; ?>,'other')" class="simple_btn text-white" data-toggle="modal" data-target="#addons" data-dismiss="modal">
                                            <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span>
                                        </a>
                                <?php }
                                } else {
                                    echo $availavail;
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <div id="cartitem" style="display:none;"></div>
<?php } ?>
<!--End Offer Area-->
<!--End Offer Area-->
<script type="text/javascript" src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/js/jquery.rateyo.js"></script>
<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/js/details.js"></script>
