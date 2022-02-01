<?php $webinfo = $this->webinfo; ?>
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
<!--END HEADER TOP-->
<?php if ($title2 == 'Welcome to Hungry') { ?>
    <!--START SLIDER PART-->
    <div class="main_slider owl-carousel">
        <?php foreach ($slider_info as $slider) { ?>
            <div class="item">
                <img src="<?php echo base_url(!empty($slider->image) ? $slider->image : 'dummyimage/1920x902.jpg'); ?>" alt="<?php echo $slider->title ?>">
                <div class="item_caption animated_caption">
                    <h3 class="pre_title"><?php echo $slider->title ?></h3>
                    <h2><?php echo $slider->subtitle ?></h2>
                    <a href="<?php echo $slider->slink ?>" class="btn1"><?php echo display('see_more')?></a>
                </div>
            </div>
        <?php } ?>

    </div>
    <!--END SLIDER PART -->
<?php } ?>
<!--Start About Us-->
<?php $history = $this->db->select('*')->from('tbl_widget')->where('widgetid', 17)->where('status', 1)->get()->row();
if (!empty($history)) {
?>
    <section class="about_us sect_pad position-relative bg-img-hero">
        <div class="container">
            <div class="row about_inner align-items-center wrap-reverse-md">
                <div class="col-xl-5 col-lg-6">
                    <div class="sect_title mb-4">
                        <h3 class="big_title"><?php echo $history->widget_title; ?> <span><?php echo $history->widget_name; ?></span></h3>
                    </div>
                    <div class="aboutus_text">
                        <?php echo $history->widget_desc; ?>
                    </div>
                </div>
                <div class="col-lg-6 offset-xl-1">
                    <div class="img_part mb-5 mb-lg-0" data-wow-delay="0.4s">
                        <?php foreach ($foodhistory as $historyimg) { ?>
                            <img src="<?php echo base_url(!empty($historyimg->image) ? $historyimg->image : 'dummyimage/541x516.jpg'); ?>" class="img-fluid" alt="">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<!--End About Us-->
<?php $testymenu = $this->db->select('*')->from('tbl_widget')->where('widgetid', 16)->where('status', 1)->get()->row();
if (!empty($testymenu)) {
?>
    <section class="menu_area pb-5">
        <div class="food_menu_topper">
            <div class="text-center">
                <h2 class="food_menu_title"><?php echo $testymenu->widget_name; ?></h2>
                <h4 class="food_menu_title2"><?php echo $testymenu->widget_title; ?> </h4>
            </div>
            <div class="container">
                <div class="menu-tab-nav position-relative mt-5">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <?php $tm = 0;
                        foreach ($todaymenu_menu as $tmenu) {
                            $tm++; ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?php if ($tm == 1) {echo "active";} ?>" id="pills-home-tab<?php echo $tm; ?>" data-toggle="pill" href="#pills-<?php echo $tmenu->menutypeid; ?>" onclick="showfood(<?php echo $tmenu->menutypeid; ?>)">
                                    <img src="<?php echo base_url(!empty($tmenu->menu_icon) ? $tmenu->menu_icon : 'assets/img/icons/default.jpg'); ?>" alt="">
                                    <h6><?php echo $tmenu->menutype ?></h6>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="tab-content menu-tab-content" id="pills-tabContent">
                <?php $tm = 0;
                foreach ($todaymenu_menu as $tmenu2) {
                    $tm++; ?>
                    <div class="tab-pane fade show active" id="pills-<?php echo $tmenu2->menutypeid; ?>" role="tabpanel">

                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>
<?php $reservation = $this->db->select('*')->from('tbl_widget')->where('widgetid', 6)->where('status', 1)->get()->row();
if (!empty($reservation)) {
?>
    <!--Reservation Area-->
    <section class="reservation-area sect_pad">
        <div class="container">
            <div class="row reservation-inner">
                <div class="col-xl-5 col-lg-6 show-lg">
                    <?php
                    foreach ($reservation_sl as $reslider) { ?>
                        <img src="<?php echo base_url(!empty($reslider->image) ? $reslider->image : 'dummyimage/470x548.jpg'); ?>" class="img-fluid" alt="">
                    <?php } ?>
                </div>
                <div class="col-xl-7 col-lg-6 text-center">
                    <div class="sect_title mb-5 text-center">
                        <h2 class="curve_title"><?php echo $reservation->widget_name; ?></h2>
                        <h3 class="mb-3 big_title"><?php echo $reservation->widget_title; ?></h3>
                    </div>
                    <form class="main-reservaton-form" action="#" method="post">
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_person"><i class="ti-face-smile"></i></label>
                                <input type="text" name="reservation_person" id="reservation_person" placeholder="Total Person" autocomplete="off">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_date"><i class="ti-calendar"></i></label>
                                <input type="text" name="reservation_date" id="reservation_date" placeholder="Expected Date" class="datepickerreserve" autocomplete="off">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_time"><i class="ti-alarm-clock"></i></label>
                                <input type="text" name="reservation_time" id="reservation_time" placeholder="Expected Time" autocomplete="off">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_contact"><i class="fa fa-phone"></i></label>
                                <input type="text" name="reservation_contact" id="reservation_contact" placeholder="Contact No." autocomplete="off">
                            </div>
                            <div class="col-lg-12">
                                <input name="checkurl" id="checkurl" type="hidden" value="<?php echo base_url("hungry/checkavailablity"); ?>" />
                                <button type="button" class="simple_btn" onclick="checkavailablity()"><?php echo display('book_table')?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--End Reservation Area-->
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
<section class="table_chart" id="searchreservation" style="background:#f6f6f6;">
    <div class="container">
        <div class="row table_chart_inner" id="addmargind">

        </div>
    </div>
</section>
<!--End Table Chart-->
<!--Start Gallery Area-->
<?php $photogallery = $this->db->select('*')->from('tbl_widget')->where('widgetid', 21)->where('status', 1)->get()->row();
if (!empty($photogallery)) {
?>
    <section class="gallery_area sect_pad">
        <div class="container">
            <div class="sect_title mb-5 text-center wow fadeIn">
                <h2 class="curve_title"><?php echo $photogallery->widget_name; ?></h2>
                <h3 class="big_title"><?php echo $photogallery->widget_title; ?></h3>
            </div>
            <div class="gallery_inner row">
                <?php foreach ($gallery as $image) { ?>
                    <div class="col-md-4 col-6">
                        <div class="item mb-4">
                            <a data-fancybox="gallery" href="<?php echo base_url(!empty($image->image) ? $image->image : 'dummyimage/363x363.jpg'); ?>">
                                <img src="<?php echo base_url(!empty($image->image) ? $image->image : 'dummyimage/363x363.jpg'); ?>" class="img-fluid" alt="gallery_image">
                            </a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
<?php } ?>
<!--End Gallery Area -->
<?php $history = $story = $this->db->select('*')->from('tbl_widget')->where('widgetid', 22)->where('status', 1)->get()->row();
if (!empty($history)) {
?>
    <section class="contact sect_pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center">
                    <h4 class="contact_title"><?php echo display('contact_us') ?></h4>
                    <div class="footer_widget_body">
                        <div class="footer-address">
                            <h3><?php echo $webinfo->phone; ?></h3>
                            <h3><a href="#"><?php echo $webinfo->phone_optional; ?></a></h3>
                            <h3><?php echo display('email') ?>: <a href="#"><?php echo $webinfo->email; ?></a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-5 mb-lg-0 text-center">
                        <h4 class="contact_title"><?php echo display('opening_time') ?></h4>
                        <div class="schedul_footer">
                            <?php foreach ($openclosetime as $timeshedule) {
                                if ($timeshedule->opentime != "Closed") {
                            ?>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p><strong><?php echo $timeshedule->dayname; ?></strong></p>
                                        <p><?php echo $timeshedule->opentime; ?> - <?php echo $timeshedule->closetime; ?></p>
                                    </div>
                                <?php } else { ?>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p><strong><?php echo $timeshedule->dayname; ?></strong></p>
                                        <p><?php echo $timeshedule->opentime; ?></p>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-5 mb-lg-0 text-center">
                        <h4 class="contact_title"><?php echo display('ourstore') ?></h4>
                        <?php echo $webinfo->address; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<div id="cartitem" style="display:none;"></div>