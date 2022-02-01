<?php $webinfo = $this->webinfo;
$storeinfo = $this->settinginfo;
$currency = $this->storecurrency;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;
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
    $restaurantisopen = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $seoinfo->description; ?>">
    <meta name="keywords" content="<?php echo $seoinfo->keywords; ?>">

    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo base_url((!empty($this->settinginfo->favicon) ? $this->settinginfo->favicon : 'application/views/themes/' . $acthemename . '/assets_web/images/favicon.png')) ?>">

    <!--====== Plugins CSS Files =======-->
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/jquery-3.3.1.min.js"></script>
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/animate-css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/metismenu/metisMenu.min.css" rel="stylesheet">

    <!--====== Custom CSS Files ======-->
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/new.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/responsive.css" rel="stylesheet">   

    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/appupdatedetails.css" rel="stylesheet">

 

</head>

<body>
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
            <div class="modal-content modal-addons">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo display('food_details')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body addonsinfo">
                </div>

            </div>
        </div>
    </div>

    <!-- Preloader -->
    <div class="preloader"></div>

    <!--START HEADER TOP-->
    <header class="header_top_area only-sm">

        <div class="header_top light" style="background:<?php if (!empty($webinfo->backgroundcolorqr)) {
                                                            echo $webinfo->backgroundcolorqr;
                                                        } ?>;">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg">
                    <div class="sidebar-toggle-btn">
                        <button type="button" id="sidebarCollapse" class="btn">
                            <i class="ti-menu" style="color:<?php if (!empty($webinfo->qrheaderfontcolor)) {
                                                                echo $webinfo->qrheaderfontcolor;
                                                            } ?>;"></i>
                        </button>
                    </div>
                    <a class="" href="<?php echo base_url(); ?>qr-menu">
                        <img src="<?php echo base_url(!empty($webinfo->logo) ? $webinfo->logo : 'dummyimage/168x65.jpg'); ?>" alt="">
                    </a>
                    <div class="act-icon">
                        <?php 
                        if ($this->session->userdata('CusUserID') != "") { ?>
                            <div class="noti-part">
                                <a href="<?php echo base_url() . 'apporedrlist'; ?>"  class="appupdatedetails_pointer">
                                    <svg id="ordericon" style="fill:<?php if (!empty($webinfo->qrheaderfontcolor)) {
                                                                        echo $webinfo->qrheaderfontcolor;
                                                                    } ?>" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <g>
                                                <path d="m69.012 203.499h77.488c5.522 0 10-4.478 10-10s-4.478-10-10-10h-77.488c-5.522 0-10 4.478-10 10s4.477 10 10 10z" />
                                                <path d="m69.012 272.745h77.488c5.522 0 10-4.478 10-10s-4.478-10-10-10h-77.488c-5.522 0-10 4.478-10 10s4.477 10 10 10z" />
                                                <path d="m165.01 440.359c-2.097-5.029-8.012-7.498-13.06-5.409-5.033 2.083-7.487 8.033-5.4 13.06 2.09 5.035 8.011 7.491 13.05 5.41 5.03-2.077 7.502-8.035 5.41-13.061z" />
                                                <path d="m509.317 285.619-118.944-127.68 36.418-36.333c6.325-6.255 9.809-14.601 9.809-23.5 0-8.775-3.398-17.035-9.563-23.256-12.753-12.88-33.744-13.046-46.794-.367-.032.031-.063.062-.095.093l-49.931 49.811h-18.656v-38.403c0-5.522-4.478-10-10-10h-52.953v-8.169c0-5.522-4.478-10-10-10s-10 4.478-10 10v8.169h-36.531v-8.169c0-5.522-4.478-10-10-10s-10 4.478-10 10v8.169h-36.532v-8.169c0-5.522-4.478-10-10-10s-10 4.478-10 10v8.169h-36.533v-8.169c0-5.522-4.478-10-10-10s-10 4.478-10 10v8.169h-49.012c-5.522 0-10 4.478-10 10v358.2c0 5.522 4.478 10 10 10h102.072c5.522 0 10-4.478 10-10s-4.478-10-10-10h-92.072v-338.2h39.012v9.073c0 5.522 4.478 10 10 10s10-4.478 10-10v-9.073h36.532v9.073c0 5.522 4.478 10 10 10s10-4.478 10-10v-9.073h36.532v9.073c0 5.522 4.478 10 10 10s10-4.478 10-10v-9.073h36.531v9.073c0 5.522 4.478 10 10 10s10-4.478 10-10v-9.073h42.953v28.459c-17.962.73-35.116 8.315-47.852 20.98l-73.591 73.59c-4.447 4.447-3.621 12.064 1.64 15.469 8.286 5.359 17.574 8.824 27.279 10.221 3.235.466 6.516.702 9.823.702.016 0 .031-.001.046-.001l-11.479 11.452c-.833.832-1.494 1.8-1.983 2.845l-32.079 48.184c-2.891 4.342-4.071 9.299-3.639 14.105h-90.713c-5.522 0-10 4.478-10 10s4.478 10 10 10h112.623c4.328 0 8.693-1.443 12.257-3.865l48.759-33.131c.577-.378 1.134-.824 1.622-1.31l22.615-22.562 24.673 24.619v128.443h-91.508c-5.522 0-10 4.478-10 10s4.478 10 10 10h101.508c5.522 0 10-4.478 10-10v-118.922c12.642 10.499 28.404 16.222 45.048 16.222h39.897c8.297 0 16.342 3.441 22.021 9.387l76.19 80.967c6.06 6.441 17.282 2.003 17.282-6.853v-132.55c.001-2.529-.958-4.965-2.682-6.816zm-251.465-126.053c9.686-9.686 22.95-15.181 36.648-15.181h15.667l-62.305 62.155c-5.765 5.535-11.222 10.959-18.605 14.381-10.894 5.049-23.551 5.855-35.004 2.242zm136.366-70.776c5.217-5.026 13.55-4.973 18.61.136 2.432 2.454 3.771 5.714 3.771 9.18 0 3.516-1.375 6.811-3.902 9.311l-104.51 104.266-5.036-5.037c-4.716-4.716-10.667-8.18-17.094-9.957zm-211.567 232.793c-.856.582-1.654.515-2.396-.221-1.106-1.096-.545-1.939-.243-2.393l26.132-39.251 15.437 15.413zm54.568-39.112-18.553-18.553 19.054-19.012c1.799 6.511 5.363 12.455 10.131 17.222l4.879 4.869zm254.781 117.296-58.958-62.654c-9.485-9.932-22.802-15.628-36.536-15.628h-39.897c-13.509 0-26.212-5.249-35.767-14.779l-58.885-58.756c-8.501-6.375-6.602-20.508.003-27.216 7.421-7.222 19.79-7.207 27.048.053l47.842 47.842c3.849 3.847 10.292 3.848 14.143 0 3.905-3.905 3.905-10.237 0-14.143l-28.663-28.663 53.876-53.75 115.794 124.299z" />
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </nav>
                <nav id="sidebar" class="sidebar-nav">
                    <div id="dismiss">
                        <i class="ti-close"></i>
                    </div>
                    <ul class="metismenu list-unstyled" id="mobile-menu">
                        <li><a href="<?php echo base_url() . 'app-terms'; ?>"><?php echo display('terms_condition') ?></a></li>
                        <li><a href="<?php echo base_url() . 'app-refund-policty'; ?>"><?php echo display('refundp') ?></a></li>
                        <?php
                        if ($this->session->userdata('CusUserID') != "") { ?>
                            <li><a href="<?php echo base_url() . 'apporedrlist'; ?>"><?php echo display('morderlist') ?></a></li>
                        <?php } ?>
                    </ul>
                </nav>
                <div class="overlay"></div>
            </div>
        </div>

    </header>
    <!--END HEADER TOP-->

    <section class="item_details only-sm mt-4">
        <div class="container-fluid">
            <div class="row appupdatedetails_page">
                <div class="col-12">
                    <div class="img_part">
                        <img src="<?php echo base_url(!empty($iteminfo->bigthumb) ? $iteminfo->bigthumb : 'dummyimage/555x370.jpg'); ?>" class="img-fluid" alt="<?php echo $iteminfo->ProductName; ?>">
                    </div>
                    <div class="item_info">
                        <h6 class="mt-3"><?php echo $iteminfo->ProductName; ?></h6>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <p class="mb-0"><i class="fa fa-clock-o mr-2"></i><?php echo display('00_15_min') ?></p>
                                <a href="#" class="variant_btn"><?php echo $iteminfo->variantName ?></a>
                            </div>
                            <div class="">
                                <p class="price"><?php if ($this->storecurrency->position == 1) {
                                                        echo $this->storecurrency->curr_icon;
                                                    } ?><?php echo $iteminfo->price; ?><?php if ($this->storecurrency->position == 2) {
                                                                                            echo $this->storecurrency->curr_icon;
                                                                                        } ?></p>
                            </div>
                        </div>

                        <p><?php echo $iteminfo->descrip; ?></p>

                        <div class="d-flex align-items-center justify-content-between my-4">
                            <div class="cart_counter d-flex">
                                <button onclick="var result = document.getElementById('sst6999_det'); var sst = result.value; if( !isNaN( sst ) && sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="text" name="qty" id="sst6999_det" maxlength="12" value="1" title="<?php echo display('qty')?>:" class="input-text qty">
                                <button onclick="var result = document.getElementById('sst6999_det'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <input name="sizeid" type="hidden" id="sizeid_999det" value="<?php echo $iteminfo->variantid; ?>" />
                            <input type="hidden" name="catid" id="catid_999det" value="<?php echo $iteminfo->CategoryID; ?>">
                            <input type="hidden" name="itemname" id="itemname_999det" value="<?php echo $iteminfo->ProductName; ?>">
                            <input type="hidden" name="varient" id="varient_999det" value="<?php echo $iteminfo->variantName; ?>">
                            <input type="hidden" name="cartpage" id="cartpage_999det" value="0">
                            <input name="itemprice" type="hidden" value="<?php echo $iteminfo->price; ?>" id="itemprice_999det" />
                            <?php $this->db->select('*');
                            $this->db->from('menu_add_on');
                            $this->db->where('menu_id', $iteminfo->ProductsID);
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
                                    $availavail = '<h6 class="mt-4">'.display('unavailable').'</h6>';
                                    $addtocart = 0;
                                }
                            }
                            if ($restaurantisopen == 1) {
                                if ($addtocart == 1) {
                                    if ($getadons == 1) { ?>
                                        <button class="simple_btn" onclick="addonsitemqr(<?php echo $iteminfo->ProductsID; ?>,<?php echo $iteminfo->variantid; ?>,'other')" data-toggle="modal" data-target="#addons" data-dismiss="modal">
                                            <span><?php echo display('add')?></span>
                                        </button>
                                    <?php } else { ?>
                                        <button class="simple_btn" onclick="appcart(<?php echo $iteminfo->ProductsID; ?>,999,'det')">
                                            <span><?php echo display('add')?></span>
                                        </button>
                                <?php }
                                } else {
                                    echo $availavail;
                                }
                            } else { ?>
                                <a class="simple_btn" data-toggle="modal" data-target="#closenotice" data-dismiss="modal"> <span><?php echo display('add') ?></span></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($this->cart->total() > 0) {
                $display = "block";
            } else {
                $display = "none";
            }
            ?>
            <div class="fixed_area only-sm" id="fixedarea" style="display:<?php echo $display; ?>;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="cart_sm" id="cartitemandprice">
                                    <?php $totalqty = 0;
                                    $totalamount = 0;
                                    if ($this->cart->contents() > 0) {
                                        $totalqty = count($this->cart->contents());
                                        $itemprice = 0;
                                        foreach ($this->cart->contents() as $item) {
                                            if (!empty($item['addonsid'])) {
                                                $itemprice = $itemprice + $item['addontpr'];
                                            } else {
                                                $itemprice = $itemprice;
                                            }
                                        }
                                        $totalamount = $itemprice + $this->cart->total();
                                        echo '<p>' . $totalqty . ' Item(s) in cart</p>
                                <h6 class="mb-0">' . $totalamount . '</h6>';
                                    } ?>
                                </div>
                                <a href="<?php echo base_url(); ?>update-summery/<?php echo $orderinfo->order_id; ?>" class="btn mr-2"><?php echo display('upsummery')?> <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--====== SCRIPTS JS ======-->
    <!--====== SCRIPTS JS ======-->
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url('/ordermanage/order/showljslang') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('/ordermanage/order/basicjs') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/wow/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/clockpicker/clockpicker.min.js"></script>
    <!--===== ACTIVE JS=====-->
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/qrappupdatedetails.js"></script>
</body>

</html>