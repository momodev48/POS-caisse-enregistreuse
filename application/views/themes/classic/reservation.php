<?php if (!empty($seoterm)) {
	$seoinfo = $this->db->select('*')->from('tbl_seoption')->where('title_slug', $seoterm)->get()->row();
}?>
<div class="page_header">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="page_header_content">
                    <ul class="m-0 nav">
                        <li><a href="<?php echo base_url(); ?>"><?php echo display('home')?></a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li class="active"><a><?php echo $seoinfo->title; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    <?php echo form_open('#','method="post" class="main-reservaton-form"')?>
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_person"><i class="ti-face-smile"></i></label>
                                <input type="text" name="reservation_person" id="reservation_person" placeholder="<?php echo display('reservation_person')?>" autocomplete="off">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_date"><i class="ti-calendar"></i></label>
                                <input type="text" name="reservation_date" id="reservation_date" placeholder="<?php echo display('reservation_date')?>" class="datepickerreserve" autocomplete="off">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_time"><i class="ti-alarm-clock"></i></label>
                                <input type="text" name="reservation_time" id="reservation_time" placeholder="<?php echo display('reservation_time')?>" autocomplete="off">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="reservation_contact"><i class="fa fa-phone"></i></label>
                                <input type="text" name="reservation_contact" id="reservation_contact" placeholder="<?php echo display('reservation_contact')?>" autocomplete="off">
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
<!--Start Table Chart-->
<section class="table_chart" id="searchreservation">
    <div class="container">
        <div class="row table_chart_inner" id="addmargind">

        </div>
    </div>
</section>
<!-- Modal -->
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
<!--End Table Chart-->