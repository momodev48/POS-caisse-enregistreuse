<?php $webinfo = $this->webinfo; 
if (!empty($seoterm)) {
	$seoinfo = $this->db->select('*')->from('tbl_seoption')->where('title_slug', $seoterm)->get()->row();
}
?>
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