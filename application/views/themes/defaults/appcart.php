<?php $webinfo = $this->webinfo;
$storeinfo = $this->settinginfo;
$currency = $this->storecurrency;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;
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
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/animate-css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/metismenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/clockpicker/clockpicker.min.css" rel="stylesheet">

    <!--====== Custom CSS Files ======-->
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/new.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/responsive.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/jquery-3.3.1.min.js"></script>
     <link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/appcart.css" rel="stylesheet">
  
 
</head>

<body>

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
                                <a href="<?php echo base_url() . 'apporedrlist'; ?>" class='appcart_pointer' >
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

    <section class="item_cart only-sm mt-4">
        <div class="container-fluid">
            <div class="row">
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
                <?php } ?>
                <div class="col-12" id="mycartlist">
                    <h6 class="cart_heading"><?php echo display('cartlist') ?></h6>
                    <?php $totalqty = 0;
                    if (!empty($this->cart->contents())) {
                        $totalqty = count($this->cart->contents());
                    }; ?>
                    <?php
                    $calvat = 0;
                    $discount = 0;
                    $itemtotal = 0;
                    $pvat = 0;
                    $totalamount = 0;
                    $subtotal = 0;
                    if ($cart = $this->cart->contents()) {

                        $totalamount = 0;
                        $subtotal = 0;
                        $pvat = 0;

                    ?>
                        <ul class="list-unstyled cart_list">
                            <?php $i = 0;
                            foreach ($cart as $item) {
                                $itemprice = $item['price'] * $item['qty'];
                                $iteminfo = $this->hungry_model->getiteminfo($item['pid']);
                                $vatcalc = $itemprice * $iteminfo->productvat / 100;
                                $pvat = $pvat + $vatcalc;
                                if ($iteminfo->OffersRate > 0) {
                                    $discal = $itemprice * $iteminfo->OffersRate / 100;
                                    $discount = $discal + $discount;
                                } else {
                                    $discount = $discount;
                                }
                                if (!empty($item['addonsid'])) {
                                    $nittotal = $item['addontpr'];
                                    $itemprice = $itemprice + $item['addontpr'];
                                } else {
                                    $nittotal = 0;
                                    $itemprice = $itemprice;
                                }
                                $totalamount = $totalamount + $nittotal;
                                $subtotal = $subtotal + $item['price'] * $item['qty'];
                                $i++;
                            ?>
                                <li>
                                    <h6><?php echo $item['name'];
                                        if (!empty($item['addonsid'])) {
                                            echo "<br>";
                                            echo $item['addonname'] . ' -' . display('qty') . ':' . $item['addonsqty'];
                                        } ?> <span>(<?php if ($this->storecurrency->position == 1) {
                                                            echo $this->storecurrency->curr_icon;
                                                        } ?><?php echo $item['price']; ?><?php if ($this->storecurrency->position == 2) {
														echo $this->storecurrency->curr_icon;
													}
													if (!empty($item['addonsid'])) {
														echo "+";
														if ($this->storecurrency->position == 1) {
															echo $this->storecurrency->curr_icon;
														}
														echo $item['addontpr'];
														if ($this->storecurrency->position = 2) {
															echo $this->storecurrency->curr_icon;
														}
													}
													?>)</span></h6>
                                    <div class="d-flex">
                                        <div class="cart_counter d-flex">
                                            <button onclick="updatecart('<?php echo $item['rowid'] ?>',<?php echo $item['qty']; ?>,'del')" class="reduced items-count" type="button">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" name="qty" id="sst3" maxlength="12" value="<?php echo $item['qty']; ?>" title="<?php echo display('qty')?>:" class="input-text qty">
                                            <button onclick="updatecart('<?php echo $item['rowid'] ?>',<?php echo $item['qty']; ?>,'add')" class="increase items-count" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <button class="btn dlt_btn" onclick="removetocart('<?php echo $item['rowid'] ?>')"><i class="fa fa-trash"></i></button>
                                    </div>
                                </li>
                            <?php } ?>
                            <li>
                                <h6><?php echo display('subtotal') ?></h6>
                                <p> <?php if (!empty($this->cart->contents())) {
                                        $itemtotal = $totalamount + $subtotal;
                                        if ($this->settinginfo->vat > 0) {
                                            $calvat = $itemtotal * $this->settinginfo->vat / 100;
                                        } else {
                                            $calvat = $pvat;
                                        }
                                    ?><input type="hidden" class="form-control" id="cartamount" value="<?php echo $totalamount + $calvat - $discount; ?>">

                                        <?php if ($this->storecurrency->position == 1) {
                                            echo $this->storecurrency->curr_icon;
                                        } ?><?php echo $itemtotal; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                                                                    } ?><?php } ?></p>
                            </li>
                        </ul>

                    <?php } ?>
                    <?php $totalqty = 0;
                    $totalamount = 0;
                    $pvat = 0;
                    $discount = 0;
                    if ($this->cart->contents() > 0) {
                        $totalqty = count($this->cart->contents());
                        $itemprice = 0;
                        $pvat = 0;
                        $discount = 0;
                        foreach ($this->cart->contents() as $item) {
                            $itemprice = $item['price'] * $item['qty'];
                            $iteminfo = $this->hungry_model->getiteminfo($item['pid']);
                            $vatcalc = $itemprice * $iteminfo->productvat / 100;
                            $pvat = $pvat + $vatcalc;
                            if ($iteminfo->OffersRate > 0) {
                                $discal = $itemprice * $iteminfo->OffersRate / 100;
                                $discount = $discal + $discount;
                            } else {
                                $discount = $discount;
                            }
                            if (!empty($item['addonsid'])) {
                                $itemprice = $itemprice + $item['addontpr'];
                            } else {
                                $itemprice = $itemprice;
                            }
                            $totalamount = $itemprice + $totalamount;
                        }

                        if ($this->settinginfo->vat > 0) {
                            $calvat = $totalamount * $this->settinginfo->vat / 100;
                        } else {
                            $calvat = $pvat;
                        }
                        if ($this->settinginfo->service_chargeType == 1) {
                            $servicecharge = $totalamount * $this->settinginfo->servicecharge / 100;
                        } else {
                            $servicecharge = $this->settinginfo->servicecharge;
                        }
                        $coupon = 0;
                        if (!empty($this->session->userdata('couponcode'))) {
                            $coupon = $this->session->userdata('couponprice');
                        }
                    ?>
                        <ul class="list-unstyled cart_list">
                            <li>
                                <h6><?php echo display('vat_tax'); ?></h6>
                                <p><?php if ($this->storecurrency->position == 1) {
                                        echo $this->storecurrency->curr_icon;
                                    } ?><?php echo $calvat; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                echo $this->storecurrency->curr_icon;
                                                                                                                                            } ?></p>
                            </li>
                            <li>
                                <h6><?php echo display('service_chrg') ?></h6>
                                <p><?php if ($this->storecurrency->position == 1) {
                                        echo $this->storecurrency->curr_icon;
                                    } ?><?php echo $servicecharge; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                                                                    } ?></p>
                            </li>
                            <li>
                                <h6><?php echo display('discount') ?></h6>
                                <p><?php if ($this->storecurrency->position == 1) {
                                        echo $this->storecurrency->curr_icon;
                                    } ?><?php echo $discount + $coupon; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                                                                        } ?></p>
                            </li>
                            <li>
                                <h6><?php echo display('total') ?></h6>
                                <p><?php if ($this->storecurrency->position == 1) {
                                        echo $this->storecurrency->curr_icon;
                                    } ?><?php echo $itemtotal + $calvat + $servicecharge - ($discount + $coupon); ?><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                                echo $this->storecurrency->curr_icon;
                                                                                                                                                                                            } ?></p>
                            </li>
                        </ul>
                    <?php } ?>
                     <?php echo form_open('hungry/checkcouponqr','method="post" class="coupon"')?>
                        <div class="form-group appcart_dispaly">
                            <input type="text" class="form-control app_cart_redius" id="couponcode" name="couponcode" placeholder="<?php echo display('enter_coupon_code')?>" required autocomplete="off" >
                            <input name="coupon" class="btn app_cart_btn_bg" type="submit" value="Apply" />
                        </div>

                </div>

                </form>
            </div>
        </div>
        <?php echo form_open('hungry/placeorderqr','method="post" class="order_form"')?>
            <input name="vat" id="vat" type="hidden" value="<?php echo $calvat; ?>" />
            <input name="invoice_discount" id="invoice_discount" type="hidden" value="<?php echo $discount + $coupon; ?>" />
            <input name="service_charge" id="servicecharge" type="hidden" value="<?php echo $servicecharge; ?>" />
            <input name="orggrandTotal" id="orggrandTotal" type="hidden" value="<?php echo $totalamount; ?>" />
            <input type="hidden" readonly class="form-control-plaintext text-right" id="table" value="<?php echo $this->session->userdata('tableid'); ?>">
            <div class="row m-0">
                <div class="col-12">
                    <div class="form-group row m-0 align-items-center justify-content-between">
                        <h6 class="app_cart_h3" ><?php echo display('table') ?>: <?php echo $this->session->userdata('tableid'); ?></h6>
                        <div class="d-flex align-items-center">
                            <div class="form-group t-radio mb-0 ml-2">
                                <input type="radio" id="dinein" name="shippingtype" value="3" checked />
                                <label for="dinein"><?php echo display('dine_in')?></label>
                            </div>
                            <div class="form-group t-radio mb-0 ml-2">
                                <input type="radio" id="pickup" name="shippingtype" value="2" />
                                <label for="pickup"><?php echo display('pickup')?></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="orderNotes" class="col-form-label"><?php echo display('ordnote') ?></label>
                        <textarea type="text" class="form-control" id="orderNotes" name="ordernote"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="customerName" class="col-form-label"><?php echo display('customer_name') ?></label>
                        <input type="text" class="form-control" id="customerName" name="customerName" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-form-label"><?php echo display('phone') ?></label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                        <input type="hidden" class="form-control" id="grandtotal" name="grandtotal" value="<?php echo $totalamount + $calvat + $servicecharge - ($discount + $coupon); ?>">
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-12">
                    <div class="check_order appcart_order_check">
                        <h6 class="my-3"><?php echo display('placeorder') ?></h6>
                        <!-- /.End of product list table -->
                        <div class="payment-block" id="payment">
                            <?php if (!empty($shippinginfo)) {
                                $p = 0;
                                foreach ($shippinginfo as $payment) {
                                    $p++;
                            ?>
                                    <div class="payment-item t-radio">
                                        <input type="radio" name="card_type" id="payment_method_cre<?php echo $p; ?>" data-parent="#payment" data-target="#description_cre<?php echo $p; ?>" value="<?php echo $payment->payment_method_id; ?>" <?php if ($payment->payment_method_id == 4) {
                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                } ?> class="">
                                        <label for="payment_method_cre<?php echo $p; ?>"> <?php echo $payment->payment_method; ?> </label>
                                    </div>
                            <?php }
                            } ?>

                        </div>
                        <!-- /.End of payment method -->

                        <div class="fixed_area only-sm appcart_order_padding">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-success btn-block appcart_b"  name="" type="submit"><img src="<?php echo base_url(); ?>assets/img/online-order.png" alt="" width="20"> <?php echo display('placeorder') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </section>


    <!--====== SCRIPTS JS ======-->
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

    <script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/returnpolicyqr.js"></script>
</body>

</html>