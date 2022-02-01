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
<div class="search_box mt-5 mt-lg-0">
    <div class="container">
        <div class="search_box_inner">
            <?php echo form_open('menu','method="post"')?>
                <div class="form-row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="sr-only" for="itemsearch"><?php echo display('food_name')?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="ti-search"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control productSelection" onkeypress="producstList();" name="product_name" id="product_name" placeholder="<?php echo display('search_food_item')?>" aria-required="true"> <input class="autocomplete_hidden_value" name="product_id" id="SchoolHiddenId" type="hidden">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="sr-only" for="location"><?php echo display('category')?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-cutlery"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control categorySelection" onkeypress="allcategoryList();" name="category_name" id="category_name" placeholder="<?php echo display('search_category')?>"><input class="autocomplete_hidden_value2" name="category_id" id="SchoolHiddenId2" type="hidden">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success"><?php echo display('search')?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Start About Us-->
<?php $story = $story = $this->db->select('*')->from('tbl_widget')->where('widgetid', 9)->where('status', 1)->get()->row();
if (!empty($story)) {
?>
    <section class="about_us sect_pad bg_img_area">
        <div class="bg_img_left wow fadeIn" data-wow-delay="0.5s"></div>
        <div class="container">
            <div class="row about_inner">
                <div class="col-lg-5 col-xl-6 text-center wow fadeIn">
                    <div class="sect_title mb-4">
                        <h2 class="curve_title"><?php echo $banner_story[0]->title; ?></h2>
                        <h3 class="big_title"><?php echo $banner_story[0]->subtitle; ?></h3>
                    </div>
                    <div class="aboutus_text mb-lg-0 mb-5">
                        <p class="mb-4"> <?php echo $story->widget_desc; ?></p>
                        <a href="<?php echo $banner_story[0]->slink; ?>" class="simple_btn"><?php echo display('read_more')?></a>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-6">
                    <div class="row">
                        <?php foreach ($banner_story as $story) { ?>
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                <div class="img_part mb-4 mb-sm-0 wow fadeIn" data-wow-delay="0.4s">
                                    <img src="<?php echo base_url(!empty($story->image) ? $story->image : 'dummyimage/263x332.jpg'); ?>" class="img-fluid" alt="<?php echo $story->title ?>">
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!--End About Us-->

<!--Start Offer Area-->
<?php $carousal = $this->db->select('*')->from('tbl_widget')->where('widgetid', 15)->where('status', 1)->get()->row();
if (!empty($carousal)) {
?>
    <section class="offer_area bg_two sect_pad">
        <div class="container">
            <div class="sect_title mb-5 text-center wow fadeIn">
                <h2 class="curve_title"><?php echo display('exclusive'); ?></h2>
                <h3 class="big_title"><?php echo display('best_Offers'); ?></h3>
            </div>
            <div class="row offer_inner wow fadeIn" data-wow-delay="0.5s">
                <div class="offer_slider owl-carousel">
                    <?php $openingtime = $this->settinginfo->opentime;
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
                    $id = 0;
                    foreach ($best_seller as $best) {
						$best=(object)$best;
                        $id++;
                        $this->db->select('*');
                        $this->db->from('menu_add_on');
                        $this->db->where('menu_id', $best->ProductsID);
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
                        $this->db->where('foodid', $best->ProductsID);
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
                                <img src="<?php echo base_url(!empty($best->medium_thumb) ? $best->medium_thumb : 'dummyimage/268x223.jpg'); ?>" alt="<?php echo $best->ProductName ?>">
                            </div>
                            <div class="item_content text-center pb-4">
                                <?php if ($best->OffersRate > 0) { ?>
                                    <span class="top_side">-<?php echo $best->OffersRate; ?>%</span>
                                <?php } ?>
                                <a href="<?php echo base_url() . 'details/' . $best->ProductsID . '/' . $best->variantid; ?>" class="item_name"><?php echo $best->ProductName ?></a>
                                <p><?php if ($this->storecurrency->position == 1) {echo $this->storecurrency->curr_icon;} ?><?php echo $best->price; ?><?php if ($this->storecurrency->position == 2) {echo $this->storecurrency->curr_icon;} ?></p>
                                <?php if ($restaurantisopen == 1) {
                                    if ($addtocart == 1) {
                                        if($getadons == 0 && $menuitem->totalvarient==1) { ?>                                            
                                        	<input type="hidden" name="qty" id="sst6<?php echo $id; ?>_other" value="1">
                                            <input name="sizeid" type="hidden" id="sizeid_<?php echo $id; ?>other" value="<?php echo $best->variantid; ?>" />
                                            <input type="hidden" name="catid" id="catid_<?php echo $id; ?>other" value="<?php echo $best->CategoryID; ?>">
                                            <input type="hidden" name="itemname" id="itemname_<?php echo $id; ?>other" value="<?php echo $best->ProductName; ?>">
                                            <input type="hidden" name="varient" id="varient_<?php echo $id; ?>other" value="<?php echo $best->variantName; ?>">
                                            <input type="hidden" name="cartpage" id="cartpage_<?php echo $id; ?>other" value="0">
                                            <input name="itemprice" type="hidden" value="<?php echo $best->price; ?>" id="itemprice_<?php echo $id; ?>other" />
                                            <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                            <a onclick="addtocartitem(<?php echo $best->ProductsID; ?>,<?php echo $id; ?>,'other')" class="simple_btn"> <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span></a>
										<?php } else { ?>
                                            <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                            <a onclick="addonsitem(<?php echo $best->ProductsID; ?>,<?php echo $best->variantid; ?>,'other')" class="simple_btn" data-toggle="modal" data-target="#addons" data-dismiss="modal"> <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span></a>
                                    <?php }
                                    } else {
                                        echo $availavail;
                                    }
                                } else { ?>
                                    <a class="simple_btn" data-toggle="modal" data-target="#closenotice" data-dismiss="modal"> <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span></a>
                                <?php }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!--End Offer Area -->

<!-- Start About Us Area-->
<section class="about_us sect_pad bg_img_area">
    <div class="bg_img_right bg_overlay"></div>
    <div class="container">
        <div class="row about_inner">
            <div class="col-xl-6 col-lg-7 mb-lg-0 wow fadeIn">
                <div class="row">
                    <?php $b = 0;
                    $twocolumn = '';
                    foreach ($banner_menu as $bimage) {
                        $b++;
                        if ($b == 1) {
                    ?>
                            <div class="col-sm-6">
                                <div class="img_part mb-4 mb-md-0">
                                    <a href="<?php echo $bimage->slink; ?>"><img src="<?php echo base_url(!empty($bimage->image) ? $bimage->image : 'dummyimage/263x374.jpg'); ?>" class="img-fluid" alt="<?php echo $bimage->title; ?>"></a>
                                </div>
                            </div>
                            <?php } else {
                            $twocolumn .= '<div class="img_part mb-4"><a href="' . $bimage->slink . '"><img src="' . base_url(!empty($bimage->image) ? $bimage->image : 'dummyimage/263x177.jpg') . '" class="img-fluid" alt="' . $bimage->title . '"></a></div>';
                            ?><?php }
                    } ?>
                            <div class="col-sm-6">
                                <?php echo $twocolumn; ?>
                            </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5 text-center pl-lg-5 px-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="sect_title my-4">
                    <h2 class="curve_title"><?php echo $banner_menu[0]->title; ?></h2>
                    <h3 class="big_title"><?php echo $banner_menu[0]->subtitle; ?></h3>
                </div>
                <?php $ourmenu = $this->db->select('*')->from('tbl_widget')->where('widgetid', 7)->where('status', 1)->get()->row();
                if (!empty($ourmenu)) {
                ?>
                    <div class="aboutus_text">
                        <p class="mb-4"> <?php echo $ourmenu->widget_desc; ?></p>
                        <a href="<?php echo $banner_menu[0]->slink; ?>" class="simple_btn"><?php echo display('view_full_menu')?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!--End About Us Area-->

<!--Reservation Area-->
<?php $reservation = $this->db->select('*')->from('tbl_widget')->where('widgetid', 6)->where('status', 1)->get()->row();
if (!empty($reservation)) {
?>
    <section class="reservation-area sect_pad bg_two">
        <div class="container">
            <div class="sect_title mb-5 text-center">
                <h2 class="curve_title"><?php echo $reservation->widget_name; ?></h2>
                <h3 class="mb-3 big_title"><?php echo $reservation->widget_title; ?></h3>
                <?php echo $reservation->widget_desc; ?>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                     <?php echo form_open('#','method="post" class="main-reservaton-form"')?>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                                <label for="reservation_person"><i class="ti-face-smile"></i></label>
                                <input type="number" name="reservation_person" id="reservation_person" placeholder="Total Person" autocomplete="off">
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                                <label for="reservation_date"><i class="ti-calendar"></i></label>
                                <input type="text" name="reservation_date" id="reservation_date" placeholder="Expected Date" class="datepickerreserve" autocomplete="off">
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                                <label for="reservation_time"><i class="ti-alarm-clock"></i></label>
                                <input type="text" name="reservation_time" id="reservation_time" placeholder="Expected Time" autocomplete="off">
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <input name="checkurl" id="checkurl" type="hidden" value="<?php echo base_url("hungry/checkavailablity"); ?>" />
                                <button type="button" class="simple_btn" onclick="checkavailablity()"><?php echo display('check_availablity')?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo display('reserve_table')?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body editinfo">

            </div>
        </div>
    </div>
</div>
<!--End Reservation Area-->
<!--Start Table Chart-->
<section class="table_chart" id="searchreservation">
    <div class="container">
        <div class="row table_chart_inner py-5">

        </div>
    </div>
</section>
<!--End Table Chart-->
<!--Menu AREA-->
<?php $special = $this->db->select('*')->from('tbl_widget')->where('widgetid', 8)->where('status', 1)->get()->row();
if (!empty($special)) {
?>
    <section class="menu_area sect_pad3 bg_img_area">
        <div class="bg_img_left img_2 bg_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 wow fadeIn">
                    <div class="sect_title mt-lg-5 mt-0">
                        <h2 class="curve_title"><?php echo $special->widget_name; ?></h2>
                        <h3 class="big_title"><?php echo $special->widget_title; ?></h3>
                        <?php echo $special->widget_desc; ?>
                    </div>
                </div>
                <div class="col-lg-8 wow fadeIn">
                    <div class="menu_slider owl-carousel">
                        <?php foreach ($special_menu as $special) { ?>
                            <div class="menu_item">
                                <div class="menu_info">
                                    <a href="<?php echo base_url() . 'details/' . $special->ProductsID . '/' . $special->variantid; ?>" class="h1 d-block mb-3"><?php echo $special->ProductName ?></a>
                                    <p><?php echo $special->descrip ?></p>
                                    <h2><?php if ($this->storecurrency->position == 1) {
                                            echo $this->storecurrency->curr_icon;
                                        } ?><?php echo $special->price; ?><?php if ($this->storecurrency->position == 2) {echo $this->storecurrency->curr_icon;} ?></h2>
                                    <a href="#" class="simple_btn"><i class="ti-shopping-cart"></i><span><?php echo display('add_to_cart')?></span></a>
                                </div>
                                <div class="menu_img">
                                    <img src="<?php echo base_url(!empty($special->small_thumb) ? $special->small_thumb : 'dummyimage/253x263.jpg'); ?>" alt="<?php echo $special->ProductName ?>">
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!--Menu AREA END-->

<!--TEAM AREA-->
<?php $team = $this->db->select('*')->from('tbl_widget')->where('widgetid', 10)->where('status', 1)->get()->row();
if (!empty($team)) {
?>
    <section class="team-area sect_pad2">
        <div class="container">
            <div class="sect_title mb-5 text-center">
                <h2 class="curve_title"><?php echo $team->widget_name; ?></h2>
                <h3 class="big_title"><?php echo $team->widget_title; ?></h3>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 team_slider owl-carousel">
                    <?php 
                    foreach ($ourteam as $team) { ?>
                        <div class="single-team-member text-center">
                            <div class="team-member-img ">
                                <img src="<?php echo base_url(!empty($team->picture) ? $team->picture : 'dummyimage/363x363.jpg'); ?>" alt="">
                            </div>
                            <div class="member-details">
                                <h5><?php echo $team->first_name . ' ' . $team->last_name; ?></h5>
                                <p class="member_title"><?php echo $team->custom_field; ?></p>
                                <p><?php echo $team->custom_data; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!--TEAM AREA END-->

<!--start for hidden cart-->
<div id="cartitem" class="cartlist_display_none" ></div>