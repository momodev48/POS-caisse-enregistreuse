   <?php $webinfo = $this->webinfo; 
if (!empty($seoterm)) {
	$seoinfo = $this->db->select('*')->from('tbl_seoption')->where('title_slug', $seoterm)->get()->row();
}
?>
    <!--Start About Us-->
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
                        <?php $story = $this->db->select('*')->from('tbl_widget')->where('widgetid', 9)->get()->row(); ?>
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
    <!--End About Us-->

    <!--TEAM AREA-->
    <?php $team = $this->db->select('*')->from('tbl_widget')->where('widgetid', 10)->where('status', 1)->get()->row();
    if (!empty($team)) {
    ?>
        <section class="team-area sect_pad2 bg_two">
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

    <!--Start About Us Area -->
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
                    <div class="aboutus_text">
                        <?php $ourmenu = $this->db->select('*')->from('tbl_widget')->where('widgetid', 7)->get()->row(); ?>
                        <p class="mb-4"> <?php echo $ourmenu->widget_desc; ?></p>
                        <a href="<?php echo $banner_menu[0]->slink; ?>" class="simple_btn"><?php echo display('view_full_menu')?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us Area -->