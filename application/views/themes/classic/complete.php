<?php if (!empty($seoterm)) {
	$seoinfo = $this->db->select('*')->from('tbl_seoption')->where('title_slug', $seoterm)->get()->row();
}
$webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;?>
<link href="<?php echo base_url('themes/'.$acthemename.'/assets_web/css/complete.css') ?>" rel="stylesheet" type="text/css"/>
 <!--Start Menu Area-->
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
 <!--PAGE HEADER AREA-->
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
 <!--Start Menu Area-->
 <section class="menu_area sect_pad menu_page">
     <div class="container wow fadeIn">
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
         
         <div class="row">
             <div class="col-xl-3 col-md-4 sidebar leftSidebar">
                 <form class="form-inline mb-3" action="<?php echo base_url() . 'menu'; ?>" method="post">
                     <input type="text" class="form-control productSelection" onkeypress="producstList();" name="product_name" id="product_name" placeholder="<?php echo display('search') ?>" aria-required="true"> <input class="autocomplete_hidden_value" name="product_id" id="SchoolHiddenId" type="hidden">
                     <button class="btn btn-success" type="submit"><i class="ti-search"></i></button>
                 </form>
                 <div class="category_choose p-3 mb-3">
                     <h6 class="mb-3 text-center"><?php echo display('item_available') ?></h6>
                     <div class="panel-group" id="accordion">
                         <?php $op = 0;
                            foreach ($categorylist as $category) {
                                $op++;
                                $Productsnum = "SELECT Count(CategoryID) as totalcat FROM item_foods Where CategoryID={$category->CategoryID}";
                                $pnumQuery = $this->db->query($Productsnum);
                                $pnumResult = $pnumQuery->row();
                                $ProdcutQTY = $pnumResult->totalcat;
                                $getcat = str_replace(' ', '', $category->Name);
                                $hcategoryname = preg_replace("/[^a-zA-Z0-9\s]/", "", $getcat);
                            ?>
                             <div class="panel panel-default">
                                 <div class="panel-heading">
                                     <h6 class="panel-title">
                                         <a href="#<?php echo $hcategoryname; ?>" class="accordion-toggle" data-toggle="collapse" aria-expanded="false"><?php echo $category->Name; ?></a>
                                     </h6>
                                 </div>
                                 <div id="<?php echo $hcategoryname; ?>" class="panel-collapse collapse <?php if ($op == 1) {
                                                                                                            echo "show";
                                                                                                        } ?>" data-parent="#accordion">
                                     <div class="panel-body">
                                         <a onclick="searchmenu('<?php echo $category->CategoryID; ?>')" style="cursor:pointer;"><i class="ti-minus mr-2"></i><?php echo $category->Name; ?><span>(<?php echo $ProdcutQTY; ?>)</span></a>
                                         <?php foreach ($category->sub as $subcat) {
                                                $Productsnumsub = "SELECT Count(CategoryID) as totalcat FROM item_foods Where CategoryID={$subcat->CategoryID}";
                                                $pnumQuerysub = $this->db->query($Productsnumsub);
                                                $pnumResultsub = $pnumQuerysub->row();
                                                $ProdcutQTYsub = $pnumResultsub->totalcat;
                                            ?>
                                             <a onclick="searchmenu('<?php echo $subcat->CategoryID; ?>')" class="serach"><i class="ti-minus mr-2"></i><?php echo $subcat->Name; ?><span>(<?php echo $ProdcutQTYsub; ?>)</span></a>
                                         <?php } ?>
                                     </div>
                                 </div>
                             </div>
                         <?php } ?>


                     </div>
                 </div>
                 <div class="sidebar_box p-2 mb-3 text-center sidebar_schedule">
                     <div class="text-center">
                         <div class="schedule">
                             <h4 class="contact_title"><?php echo display('opening_time') ?></h4>
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
             </div>
             <div class="col-xl-6 col-md-8 mainContent">
                 <div id="loaditem">
                     <div id="loadingcon" class="completecss"><img src="<?php echo base_url(); ?>/view/themes/<?php echo $acthemename; ?>/assets_web/images/loader.gif" alt="loader" width="180" /></div>
                     <div class="mb-3 d-flex align-items-center justify-content-between">
                         <div class="show_results">
                             <h6 class="mb-0"><?php echo $showing; ?></h6>
                         </div>
                         <div class="gl-buttons">
                             <button class="grid">
                                 <i class="ti-layout-grid3"></i>
                             </button>
                             <button class="list">
                                 <i class="ti-view-list-alt"></i>
                             </button>
                         </div>
                     </div>
                     <ul class="list-unstyled grid-container">
                         <?php
                            if (!empty($searchresult)) {
                                $id = 0;
                                foreach ($searchresult as $menuitem) {
									$menuitem=(object)$menuitem;
                                    $id++;
                                    $this->db->select('*');
                                    $this->db->from('menu_add_on');
                                    $this->db->where('menu_id', $menuitem->ProductsID);
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
                                    $this->db->where('foodid', $menuitem->ProductsID);
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
                                            $availavail = '<h6>Unavailable</h6>';
                                            $addtocart = 0;
                                        }
                                    }
                            ?>
                                 <li class="single_item">
                                     <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                     <div class="row mb-3">
                                         <div class="item_img">
                                             <img src="<?php echo base_url(!empty($menuitem->medium_thumb) ? $menuitem->medium_thumb : 'assets/img/no-image.png'); ?>" class="img-fluid" alt="<?php echo $menuitem->ProductName ?>">
                                         </div>
                                         <div class="item_details">
                                             <a href="<?php echo base_url() . 'details/' . $menuitem->ProductsID . '/' . $menuitem->variantid; ?>" class="item_title"><?php echo $menuitem->ProductName ?></a>
                                             <div class="grid_only">
                                                 <?php $ratingp = $this->hungry_model->read_average('tbl_rating', 'rating', 'proid', $menuitem->ProductsID);
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
                                                 <h6 class="mb-0"><?php if ($this->storecurrency->position == 1) {
                                                                        echo $this->storecurrency->curr_icon;
                                                                    } ?><?php echo $menuitem->price; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                        } ?></h6>
                                             </div>
                                             <div class="xs_only">
                                                 <h6 class="mb-0 text-center"><?php if ($this->storecurrency->position == 1) {
                                                                                    echo $this->storecurrency->curr_icon;
                                                                                } ?><?php echo $menuitem->price; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                                    } ?></h6>
                                             </div>
                                             <?php if (!empty($menuitem->descrip)) { ?><p>(<?php echo substr($menuitem->descrip, 0, 50); ?>)</p><?php } ?>
                                             <?php if ($addtocart == 1) {
                                                    if($getadons == 0 && $menuitem->totalvarient==1) { ?>
                                                    <div class="d-flex align-items-center mt-2">
                                                         <input name="sizeid" type="hidden" id="sizeid_<?php echo $id; ?>other" value="<?php echo $menuitem->variantid; ?>" />
                                                         <input type="hidden" name="catid" id="catid_<?php echo $id; ?>other" value="<?php echo $menuitem->CategoryID; ?>">
                                                         <input type="hidden" name="itemname" id="itemname_<?php echo $id; ?>other" value="<?php echo $menuitem->ProductName; ?>">
                                                         <input type="hidden" name="varient" id="varient_<?php echo $id; ?>other" value="<?php echo $menuitem->variantName; ?>">
                                                         <input type="hidden" name="cartpage" id="cartpage_<?php echo $id; ?>other" value="0">
                                                         <input name="itemprice" type="hidden" value="<?php echo $menuitem->price; ?>" id="itemprice_<?php echo $id; ?>other" />

                                                         <a onclick="addtocartitem(<?php echo $menuitem->ProductsID; ?>,<?php echo $id; ?>,'other')" class="simple_btn mt-0 mr-2 text-white"><?php echo display('add_to_cart')?></a>
                                                         <div class="cart_counter">
                                                             <button onclick="var result = document.getElementById('sst6<?php echo $id; ?>_other'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                                                 <i class="fa fa-minus"></i>
                                                             </button>
                                                             <input type="text" name="qty" id="sst6<?php echo $id; ?>_other" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                                             <button onclick="var result = document.getElementById('sst6<?php echo $id; ?>_other'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                                                 <i class="fa fa-plus"></i>
                                                             </button>

                                                         </div>
                                                     </div>
                                                     
                                                 <?php } else { ?>
                                                     <div class="d-flex align-items-center mt-2">
                                                         <a onclick="addonsitem(<?php echo $menuitem->ProductsID; ?>,<?php echo $menuitem->variantid; ?>,'other')" class="simple_btn mt-0 mr-2 text-white" data-toggle="modal" data-target="#addons" data-dismiss="modal"><?php echo display('add_to_cart')?></a>
                                                         <div class="cart_counter">
                                                             <button onclick="var result = document.getElementById('sst6<?php echo $id; ?>_other'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst >= 1 ) result.value--;return false;" class="reduced items-count" type="button">
                                                                 <i class="fa fa-minus"></i>
                                                             </button>
                                                             <input type="text" name="qty" id="sst6<?php echo $id; ?>_other" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                                             <button onclick="var result = document.getElementById('sst6<?php echo $id; ?>_other'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                                                 <i class="fa fa-plus"></i>
                                                             </button>
                                                         </div>
                                                     </div>
                                             <?php }
                                                } ?>
                                             <div class="grid_only">
                                                 <h6 class="mb-0"><?php if ($addtocart == 0) { echo display('not_available'); } ?></h6>
                                             </div>
                                         </div>
                                         <div class="item_info text-center">
                                             <h5 class="mb-0"><?php if ($this->storecurrency->position == 1) {
                                                                    echo $this->storecurrency->curr_icon;
                                                                } ?><?php echo $menuitem->price; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                    } ?></h5>
                                             <?php $ratingpt = $this->hungry_model->read_average('tbl_rating', 'rating', 'proid', $menuitem->ProductsID);
                                                if (!empty($ratingpt)) {
                                                    $averageratingt = round(number_format($ratingpt->averagerating, 1));
                                                ?>
                                                 <div class="rating_area">
                                                     <div class="rate-container">
                                                         <?php if ($averageratingt == 5) { ?>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                         <?php }
                                                            if ($averageratingt == 4) {
                                                            ?>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star-o"></i>
                                                         <?php }
                                                            if ($averageratingt == 3) {
                                                            ?>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                         <?php }
                                                            if ($averageratingt == 2) { ?>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                         <?php }
                                                            if ($averageratingt == 1) { ?>
                                                             <i class="fa fa-star"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                         <?php }
                                                            if ($averageratingt < 1) { ?>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                             <i class="fa fa-star-o"></i>
                                                         <?php } ?>

                                                     </div>
                                                 </div>
                                             <?php } ?>
                                             <p><?php echo $menuitem->variantName ?></p>
                                             <?php
                                                if ($addtocart == 1) {
                                                    echo "";
                                                } else {
                                                ?>
                                                 <h6><?php echo display('unavailable') ?></h6>
                                             <?php } ?>
                                         </div>
                                     </div>
                                 </li>
                             <?php }
                            } else { ?>
                             <li class="single_item">
                                 <div class="row mb-3">
                                     <a href="<?php echo base_url() . 'menu'; ?>" class="item_title"><?php echo display('no_data_found') ?></a>
                                 </div>
                             </li>
                         <?php } ?>

                     </ul>
                     <nav>
                         <?php echo $links; ?>
                     </nav>
                 </div>
             </div>
             <div class="col-xl-3 d-none d-xl-block rightSidebar">
                 <ul class="cart-box" id="cartitem">
                     <li class="cart-header text-center">
                         <h6><?php echo display('cart') ?></h6>
                     </li>
                     <?php
                        $calvat = 0;
                        $discount = 0;
                        $itemtotal = 0;
                        $pvat = 0;
                        $multiplletax = array();
                        if ($cart = $this->cart->contents()) {
                            //print_r($cart);
                            $i = 0;
                            $totalamount = 0;
                            $subtotal = 0;
                            $pvat = 0;
                            foreach ($cart as $item) {
                                $itemprice = $item['price'] * $item['qty'];
                                $iteminfo = $this->hungry_model->getiteminfo($item['pid']);
                                $mypdiscountprice = 0;
                                if (!empty($taxinfos)) {
                                    $tx = 0;
                                    if ($iteminfo->OffersRate > 0) {
                                        $mypdiscountprice = $iteminfo->OffersRate * $itemprice / 100;
                                    }
                                    $itemvalprice =  ($itemprice - $mypdiscountprice);
                                    foreach ($taxinfos as $taxinfo) {
                                        $fildname = 'tax' . $tx;
                                        if (!empty($iteminfo->$fildname)) {
                                            $vatcalc = $itemvalprice * $iteminfo->$fildname / 100;
                                            $multiplletax[$fildname] = $multiplletax[$fildname] + $vatcalc;
                                        } else {
                                            $vatcalc = $itemvalprice * $taxinfo['default_value'] / 100;
                                            $multiplletax[$fildname] = $multiplletax[$fildname] + $vatcalc;
                                        }

                                        $pvat = $pvat + $vatcalc;
                                        $vatcalc = 0;
                                        $tx++;
                                    }
                                } else {
                                    $vatcalc = $itemprice * $iteminfo->productvat / 100;
                                    $pvat = $pvat + $vatcalc;
                                }
                                if ($iteminfo->OffersRate > 0) {
                                    $discal = $itemprice * $iteminfo->OffersRate / 100;
                                    $discount = $discal + $discount;
                                } else {
                                    $discal = 0;
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
                                $subtotal = $subtotal - $discal + $item['price'] * $item['qty'];
                                $i++;
                        ?>
                             <li class="cart-content row">
                                 <div class="img-box">
                                     <img src="<?php echo base_url(!empty($iteminfo->small_thumb) ? $iteminfo->small_thumb : 'assets/img/no-image.png'); ?>" class="img-fluid" alt="<?php echo $item['name']; ?>">
                                 </div>
                                 <div class="content">
                                     <h6><?php echo $item['name']; ?></h6>
                                     <p><?php echo $item['qty']; ?> X <?php if ($this->storecurrency->position == 1) {
                                                                            echo $this->storecurrency->curr_icon;
                                                                        } ?><?php echo $item['price']; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                                echo $this->storecurrency->curr_icon;
                                                                                                            } ?></p>
                                 </div>
                                 <div class="delete_box">
                                     <a onclick="removecart('<?php echo $item['rowid']; ?>')" class="serach">
                                         <i class="fa fa-trash"></i>
                                     </a>
                                 </div>
                             </li>
                         <?php }
                            $itemtotal = $totalamount + $subtotal;
                            /*check $taxsetting info*/
                            if (empty($taxinfos)) {
                                if ($this->settinginfo->vat > 0) {
                                    $calvat = $itemtotal * $this->settinginfo->vat / 100;
                                } else {
                                    $calvat = $pvat;
                                }
                            } else {
                                $calvat = $pvat;
                            }
                            $multiplletaxvalue = htmlentities(serialize($multiplletax));
                            ?>

                         <li>
                             <table class="table total-cost">
                                 <tbody>
                                     <tr>
                                         <td><?php echo display('subtotal') ?></td>
                                         <td><?php if ($this->storecurrency->position == 1) {
                                                    echo $this->storecurrency->curr_icon;
                                                } ?><?php echo $itemtotal; ?><?php if ($this->storecurrency->position == 2) {
                                                                                    echo $this->storecurrency->curr_icon;
                                                                                } ?></td>
                                     </tr>
                                     <tr>
                                         <td><?php echo display('vat') ?></td>
                                         <td><?php if ($this->storecurrency->position == 1) {
                                                    echo $this->storecurrency->curr_icon;
                                                } ?><?php echo $calvat; ?><?php if ($this->storecurrency->position == 2) {
                                                                                echo $this->storecurrency->curr_icon;
                                                                            } ?></td>
                                     </tr>
                                     <tr>
                                         <td><?php echo display('discount') ?></td>
                                         <td><?php if ($this->storecurrency->position == 1) {
                                                    echo $this->storecurrency->curr_icon;
                                                } ?><?php echo $discount; ?><?php if ($this->storecurrency->position == 2) {
                                                                                echo $this->storecurrency->curr_icon;
                                                                            } ?></td>
                                     </tr>

                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <td><?php echo display('total') ?></td>
                                         <td><?php if ($this->storecurrency->position == 1) {
                                                    echo $this->storecurrency->curr_icon;
                                                } ?><?php echo $calvat + $itemtotal - $discount; ?><?php if ($this->storecurrency->position == 2) {
                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                    } ?></td>
                                     </tr>
                                 </tfoot>
                             </table>
                         </li>
                         <li class="cart-footer text-right">
                             <div class="checkout-box">
                                 <a href="<?php echo base_url(); ?>cart" class="simple_btn mt-0"><?php echo display('go_to_checkout') ?></a>
                             </div>
                         </li>
                     <?php }
                        ?>

                 </ul>
                 <div class="ad_area">
                     <a href="<?php $offerimg->slink; ?>">
                         <img src="<?php echo base_url(); ?><?php echo $offerimg->image; ?>" alt="">
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!--End Menu Area-->
    <?php 			$html='';
					$wtapp = $this->db->select('*')->from('whatsapp_settings')->get()->row();
					$storeinfo = $this->hungry_model->read('*', 'setting', array('id' => 2));
					$currencysign = $this->hungry_model->read('*', 'currency', array('currencyid' => $storeinfo->currency));
					$wporderinfo = $this->hungry_model->read('*', 'customer_order', array('order_id' => $orderid));
					$customerinfo = $this->hungry_model->read('*', 'customer_info', array('customer_id' => $wporderinfo->customer_id));
					$alliteminfo =  $this->hungry_model->customerorder($orderid);
					$storename=$storeinfo->storename;
					$html.='Hi! I would Like To Place An Order %0a--------------------------------------- %0a*Order ID꞉ '.$orderid.' || Order Time꞉ '.$wporderinfo->order_time.'*%0a Customer Name꞉ '.$customerinfo->customer_name.'%0a Customer Address꞉ '.$customerinfo->customer_address.'%0a---------------------------------------%0a';
					foreach($alliteminfo as $items){
							$html.='🖋️ '.$items->menuqty.' X '.$items->ProductName.'('.$items->variantName.')  -'.$currencysign->curr_icon.$items->price.'%0a';	
							if(!empty($items->add_on_id)){
								$addons=explode(",",$items->add_on_id);
							    $addonsqty=explode(",",$items->addonsqty);
								$y=0;
								foreach($addons as $addonsid){
									$adonsinfo=$this->hungry_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
									$html.='➖ '.$addonsqty[$y].' X '.$adonsinfo->add_on_name.'     '.$currencysign->curr_icon.$adonsinfo->price.'%0a';
									$y++;
									}
							}
							$html.='--------------------------------------%0a';
						}
					$html.="*Total Price:                          ".$currencysign->curr_icon.$wporderinfo->totalamount.'*%0a';
					
	?>
    <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js" type="text/javascript"></script>
     <script>
                            swal({
                                title: "<?php echo display('order_successfully_placed');?>",
                                text: "<?php echo display('whatsorderplace');?>",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "Yes",
                                cancelButtonText: "No",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                                window.open("https://api.whatsapp.com/send?phone=<?php echo $wtapp->whatsapp_number;?>&text=<?php echo $html;?>","_blank");
                                 
                                } else {
                                    window.location.href="<?php echo base_url()?>menu";
                                }
                            });
                            </script>