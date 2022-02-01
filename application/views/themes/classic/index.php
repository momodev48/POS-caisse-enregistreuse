<?php $webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;
if ($title != "Menu") {
	$this->session->unset_userdata('product_id');
	$this->session->unset_userdata('categoryid');
}
if (!empty($seoterm)) {
	$seoinfo = $this->db->select('*')->from('tbl_seoption')->where('title_slug', $seoterm)->get()->row();
}
/*for whatsapp modules*/
$WhatsApp = $this->db->where('directory', 'whatsapp')->where('status', 1)->get('module');
$whatsapp_count = $WhatsApp->num_rows();
/*end whatsmoudles*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $seoinfo->description; ?>">
	<meta name="keywords" content="<?php echo $seoinfo->keywords; ?>">

	<title><?php echo $seoinfo->title; ?></title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url((!empty($this->settinginfo->favicon) ? $this->settinginfo->favicon : 'application/views/themes/' . $acthemename . '/assets_web/images/favicon.png')) ?>">

	<!--====== Plugins CSS Files =======-->
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/themify-icons/themify-icons.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/animate-css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/lightslider-master/dist/css/lightslider.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/fancybox/dist/jquery.fancybox.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/metismenu/metisMenu.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/clockpicker/clockpicker.min.css" rel="stylesheet">

	<!--====== Custom CSS Files ======-->
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/responsive.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/custome.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/css/jquery.rateyo.min.css" />
	<link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/product.js.php"></script>
	<script src="<?php echo base_url(); ?>assets/js/category.js.php"></script>
	<!-- for whatsapp modules -->
	<?php if ($whatsapp_count  == 1) {
		$whatsapp_data = $WhatsApp->row();
		$whatsapp_url =  str_replace("/images/thumbnail.jpg", " ", $whatsapp_data->image);
	?>
		<link href="<?php echo base_url() . $whatsapp_url; ?>/css/floating-wpp.min.css" rel="stylesheet">
		<script src="<?php echo base_url() . $whatsapp_url; ?>/js/floating-wpp.min.js"></script>

	<?php
	} ?>
</head>

<body>

	<!-- Preloader -->
	<div class="preloader">
		<div class="loader4"></div>
		<img src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/img/loader.png" class="loader-img" alt="">
	</div>

	<!--START HEADER TOP-->
	<header class="header_top_area">
		<div class="header_top">
			<div class="container">
				<nav class="navbar navbar-expand-lg">
					<a class="" href="<?php echo base_url(); ?>">
						<img src="<?php echo base_url(!empty($webinfo->logo) ? $webinfo->logo : 'dummyimage/168x65.jpg'); ?>" alt="">
					</a>
					<div class="sidebar-toggle-btn">
						<a class="nav-link classic-home-top" href="<?php echo base_url(); ?>cart" id="navbarDropdown3">
							<i class="ti-shopping-cart"></i><span class="badge badge-notify my-cart-badge classic-badge"><?php $totalqty = 0; if ($this->cart->contents() > 0) { $totalqty = count($this->cart->contents());} echo $totalqty; ?></span>
						</a>

						<button type="button" id="sidebarCollapse" class="btn">
							<i class="ti-menu"></i>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
						<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
							<?php $allmenu = $this->allmenu;
							foreach ($allmenu as $menu) {
								$dropdown = '';
								$dropdownassest = '';
								$dropdownaclass = '';
								$activeclass = '';
								if ($menu->menu_name == 'Home') {
									$activeclass = 'active';
									$href = base_url() . $menu->menu_slug;
								} else {
									$activeclass = '';
									$href = base_url() . $menu->menu_slug;
								}
								if (!empty($menu->sub)) {
									$dropdown = 'dropdown';
									$dropdownassest = 'id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
									$dropdownaclass = 'dropdown-toggle';
									$href = '#';
								}
							?>
								<li class="nav-item <?php echo $dropdown; ?> <?php echo $activeclass; ?>">
									<a class="nav-link <?php echo $dropdownaclass; ?>" href="<?php echo $href; ?>" <?php echo $dropdownassest; ?>><?php echo $menu->menu_name; ?></a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<?php if (!empty($menu->sub)) {
											foreach ($menu->sub as $submenu) {
												$menurl = $submenu->menu_slug;
												$menuname = $submenu->menu_name;
												if ($submenu->menu_slug == 'logout') {
													$myid = $this->session->userdata('CusUserID');
													if (empty($myid)) {
														$menurl = "mylogin";
														$menuname = "Login";
													}
												}
										?>
												<a class="dropdown-item" href="<?php echo base_url() . $menurl; ?>"><?php echo $menuname; ?></a>
										<?php }
										}  ?>
									</div>

								</li>
							<?php } ?>

							<li class="nav-item">
								<a class="nav-link" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-search"></i>
								</a>
								<div class="dropdown-menu search_box" aria-labelledby="navbarDropdown2">
									 <?php echo form_open('','method="post" class="card card-sm"')?>
										<div class="card-body row no-gutters align-items-center">
											<div class="col">
												<input class="form-control form-control-lg form-control-borderless" type="search" placeholder="<?php echo display('search_topics_or_keywords')?>">
											</div>
											<!--end of col-->
											<div class="col-auto">
												<button class="btn btn-lg btn-success" type="submit"><?php echo display('search')?></button>
											</div>
											<!--end of col-->
										</div>
									</form>
								</div>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url(); ?>cart" id="navbarDropdown3">
									<i class="ti-shopping-cart"></i><span class="badge badge-notify my-cart-badge" id="itemnum"><?php $totalqty = 0; if ($this->cart->contents() > 0) { $totalqty = count($this->cart->contents());}echo $totalqty; ?></span>
								</a>
							</li>
						</ul>
					</div>
				</nav>
				<!-- /. Navbar -->
				<nav id="sidebar" class="sidebar-nav">
					<div id="dismiss">
						<i class="ti-close"></i>
					</div>
					<ul class="metismenu list-unstyled" id="mobile-menu">
						<?php foreach ($allmenu as $menu) {
							if ($menu->menu_name == 'Home') {
								$activeclass = 'active';
								$mobile = '';
								$href = base_url() . $menu->menu_slug;
							} else {
								$activeclass = '';
								$href = base_url() . $menu->menu_slug;
							}
							if (!empty($menu->sub)) {
								$mobile = 'aria-expanded="false"';
								$href = '#';
							}
						?>
							<li>
								<a href="<?php echo $href; ?>" <?php echo $mobile; ?>><?php echo $menu->menu_name; ?> <?php if (!empty($menu->sub)) { ?><span class="fa arrow"></span><?php } ?></a>
								<?php if (!empty($menu->sub)) { ?>
									<ul aria-expanded="false">
										<?php foreach ($menu->sub as $submenu) {
											$menurl = $submenu->menu_slug;
											$menuname = $submenu->menu_name;
											if ($submenu->menu_slug == 'logout') {
												$myid = $this->session->userdata('CusUserID');
												if (empty($myid)) {
													$menurl = "mylogin";
													$menuname = "Login";
												}
											}
										?>
											<li><a href="<?php echo base_url() . $menurl; ?>"><?php echo $menuname; ?></a></li>
										<?php } ?>
									</ul>
								<?php }  ?>
							</li>
						<?php }  ?>

					</ul>
				</nav>
				<div class="overlay"></div>
			</div>
		</div>
	</header>
	<!--END HEADER TOP-->

	<?php if (isset($content)) {
		echo $content;
	} ?>
	<!--Footer Area-->
	<div class="footer-area">
		<div class="container">
			<div class="row footer-inner">
				<div class="col-lg-5">
					<div class="footer-logo-area mb-5 mb-lg-0">
						<div class="footer-logo">
							<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(!empty($webinfo->logo_footer) ? $webinfo->logo_footer : 'dummyimage/168x65.jpg'); ?>" alt=""></a>
						</div>
						<div class="footer_widget_body">
							<div class="footer-address">
								<p><?php echo display('call_reservation') ?>:</p>
								<p><?php echo $webinfo->phone; ?></p>
								<p><?php echo $webinfo->phone_optional; ?></p>
								<p><?php echo display('email') ?>:<a href="#"><?php echo $webinfo->email; ?></a></p>
							</div>
						</div>
						<div class="footer-social-bookmark">
							<ul>
								<?php 
								foreach ($this->sociallink as $slink) {
									$icon = substr($slink->icon, 4);
								?>
									<li><a href="<?php echo $slink->socialurl; ?>"><i class="fa <?php echo $icon; ?>"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-7 map_area">
					<div class="map"><?php $googlemap = $this->db->select('*')->from('tbl_widget')->where('widgetid', 14)->where('status', 1)->get()->row(); if(!empty($googlemap)){ echo htmlspecialchars_decode($googlemap->widget_desc); ?><?php } ?></div>
				</div>
			</div>
		</div>
	</div>
	<!--End Footer Area-->

	<a href="#0" class="cd-top">
		<i class="ti-arrow-up"></i>
	</a>
	<?php
	$openingtimerv = strtotime($this->settinginfo->reservation_open);
	$closetimerv = strtotime($this->settinginfo->reservation_close);
	$compareretime = strtotime(date("H:i:s A"));
	if (($compareretime >= $openingtimerv) && ($compareretime < $closetimerv)) {
		$reservationopen = 1;
	} else {
		$reservationopen = 0;
	}
	?>
	<!-- for whatsapp modules -->
	<?php if ($whatsapp_count  == 1) {
		$whatsapp_data = $WhatsApp->row();
		$whatsapp_url =  str_replace("/images/thumbnail.jpg", " ", $whatsapp_data->image);
		$wtapp = $this->db->select('*')->from('whatsapp_settings')->get()->row();
		if($wtapp->chatenable==1){
	?>
		<div id="WAButton"></div>
		<script type="text/javascript">
			$(function() {
				$('#WAButton').floatingWhatsApp({
					phone: '<?php echo $this->settinginfo->whatsapp_number; ?>', //WhatsApp Business phone number
					headerTitle: '<?php echo display('whatsapp_chat') ?>', //Popup Title
					popupMessage: '<?php echo display('hello,_how_can_we_help_you?') ?>', //Popup Message
					showPopup: true, //Enables popup display
					buttonImage: '<img src="<?php echo base_url() . $whatsapp_url; ?>/images/whatsapp.png" />', //Button Image
					//headerColor: 'crimson', //Custom header color
					//backgroundColor: 'crimson', //Custom background button color
					position: "left" //Position: left | right

				});
			});
		</script>

	<?php }
	} ?>
	<!-- end whatsapp modules -->
	<!--====== SCRIPTS JS ======-->
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<link href="<?php echo base_url(); ?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('/ordermanage/order/showljslang') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('/ordermanage/order/basicjs') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/lightslider-master/dist/js/lightslider.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/metismenu/metisMenu.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/fancybox/dist/jquery.fancybox.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/wow/wow.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/clockpicker/clockpicker.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/theia-sticky-sidebar/dist/ResizeSensor.min.js"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js"></script>
	<?php if ($this->settinginfo->site_align == 'RTL') { ?>
		<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/plugins/bootstrap-4.1.3-dist/js/bootstrap-rtl.js"></script>
		<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/custom-rtl.js"></script>
	<?php } else {
	?>
		<!--===== ACTIVE JS=====-->
		<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/custom.js"></script>
	<?php } ?>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/customescript.js"></script>
	<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $acthemename; ?>/assets_web/js/classic_theme.js"></script>
    
</body>
</html>