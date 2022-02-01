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
<!--PAGE BARNER AREA END-->

<div class="office_area sect_mar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="media address-inner">
                    <img src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/img/location.png" class="mr-3 max-width-60" alt="location">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo display('office_addres1') ?></h5>
                        <?php echo $webinfo->address; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="media address-inner">
                    <img src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/img/call.png" class="mr-3 max-width-60" alt="location">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo display('call_us') ?></h5>
                        <?php echo $webinfo->phone; ?> <br>
                        <?php echo $webinfo->phone_optional; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="media address-inner">
                    <img src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/img/email.png" class="mr-3 max-width-60" alt="location">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo display('call_us') ?></h5>
                        <?php echo $webinfo->email; ?><br>
                        <?php echo $webinfo->email; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Area -->
<section class="contact_area sect_mar">
    <div class="container">
        <div class="row contact_inner">
            <div class="col-xl-5 px-0">
                <img src="<?php echo base_url(); ?><?php echo $contactimg->image; ?>" class="img-fluid hidden-lg" alt="">
            </div>
            <div class="col-xl-7">
                <div class="contact_form">
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
                    $contactsms = $this->db->select('*')->from('tbl_widget')->where('widgetid', 23)->where('status', 1)->get()->row();
                    if (!empty($contactsms)) {
                    ?>
                        <h3 class="mb-3"><?php echo $contactsms->widget_name; ?></h3>
                        <p class="mb-4"><?php echo $contactsms->widget_desc; ?></p>
                    <?php } ?>
                    <?php echo form_open('hungry/sendemail','method="post"')?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname"><?php echo display('first_name') ?></label>
                                <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname"><?php echo display('last_name') ?></label>
                                <input type="text" class="form-control" id="lastname" name="lastname" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone"><?php echo display('phone') ?></label>
                                <input type="number" class="form-control" id="phone" name="phone" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"><?php echo display('email') ?></label>
                                <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="comments"><?php echo display('write_comments')?></label>
                                <textarea class="form-control" id="comments" rows="4"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn simple_btn"><?php echo display('send') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->