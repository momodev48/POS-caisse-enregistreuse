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
<section class="menu_area sect_pad">
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
            <div class="col-xl-3 col-md-4 sidebar">
                <?php echo form_open('menu','method="post" class="form-inline mb-3"')?>
                    <input type="text" class="form-control productSelection" onkeypress="producstList();" name="product_name" id="product_name" placeholder="<?php echo display('search') ?>" aria-required="true"> <input class="autocomplete_hidden_value" name="product_id" id="SchoolHiddenId" type="hidden">
                    <button class="btn btn-success" type="submit"><i class="ti-search"></i></button>
                </form>
                <div class="category_choose p-3 mb-3">
                    <h6 class="mb-3 text-center"><?php echo display('item_available')?></h6>
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
                                <?php 
                                ?>
                                <div id="<?php echo $hcategoryname; ?>" class="panel-collapse collapse <?php if ($op == 1) { echo "show"; } ?>" data-parent="#accordion">
                                    <div class="panel-body">
                                        <a onclick="searchmenu('<?php echo $category->CategoryID; ?>')" class="serach"><i class="ti-minus mr-2"></i><?php echo $category->Name; ?><span>(<?php echo $ProdcutQTY; ?>)</span></a>
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
                                <?php 
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="need_booking py-4 px-3 mb-3 text-center">
                    <?php $help = $this->db->select('*')->from('tbl_widget')->where('widgetid', 11)->get()->row(); ?>
                    <h6 class="mb-3"><?php echo $help->widget_title; ?></h6>
                    <div class="need_booking_inner">
                        <?php echo $help->widget_desc; ?>
                    </div>
                </div>
                <?php
                if (!empty($deals)) {
                ?>
                    <div class="sidebar_box py-4 px-3 mb-3 text-center">
                        <h6 class="mb-3"><?php echo display('deal_of_the_day')?></h6>
                        <div class="sidebar_content">
                            <figure>
                                <a href="<?php echo base_url() . 'details/' . $deals->ProductsID . '/' . $deals->variantid; ?>">
                                    <img src="<?php echo base_url(!empty($deals->medium_thumb) ? $deals->medium_thumb : 'assets/img/no-image.png'); ?>" class="img-fluid" alt="<?php echo $deals->ProductName ?>">
                                </a>
                            </figure>
                            <a href="<?php echo base_url() . 'details/' . $deals->ProductsID . '/' . $deals->variantid; ?>" class="h6"><?php echo $deals->ProductName ?></a>
                            <?php $ratingp = $this->hungry_model->read_average('tbl_rating', 'rating', 'proid', $deals->ProductsID);
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
                            <p><?php if ($this->storecurrency->position == 1) {
                                    echo $this->storecurrency->curr_icon;
                                } ?><?php echo $deals->price; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-xl-6 col-md-8">
                <div id="loaditem">
                    <div id="loadingcon"  class="completecss"><img src="<?php echo base_url(); ?>/view/themes/<?php echo $acthemename; ?>/assets_web/images/loader.gif" alt="loader" width="180" /></div>
                    <?php
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
                        $restaurantisopen = 1;
                    }
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
                    ?>
                            <div class="single_item row mb-3">
                                <div class="item_img col-sm-3">
                                    <img src="<?php echo base_url(!empty($menuitem->medium_thumb) ? $menuitem->medium_thumb : 'assets/img/no-image.png'); ?>" class="img-fluid" alt="<?php echo $menuitem->ProductName ?>">
                                </div>
                                <div class="item_details col-lg-6 col-sm-5 pl-0">
                                    <a href="<?php echo base_url() . 'details/' . $menuitem->ProductsID . '/' . $menuitem->variantid; ?>" class="item_title"><?php echo $menuitem->ProductName ?></a>
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
                                    <p><?php echo $menuitem->variantName ?></p>
                                    <?php
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
                                    if ($restaurantisopen == 1) {
                                        if ($addtocart == 1) {
                                            if($getadons == 0 && $menuitem->totalvarient==1) { ?>
                                            <input name="sizeid" type="hidden" id="sizeid_<?php echo $id; ?>menu" value="<?php echo $menuitem->variantid; ?>" />
                                                <input type="hidden" name="catid" id="catid_<?php echo $id; ?>menu" value="<?php echo $menuitem->CategoryID; ?>">
                                                <input type="hidden" name="itemname" id="itemname_<?php echo $id; ?>menu" value="<?php echo $menuitem->ProductName; ?>">
                                                <input type="hidden" name="varient" id="varient_<?php echo $id; ?>menu" value="<?php echo $menuitem->variantName; ?>">
                                                <input type="hidden" name="cartpage" id="cartpage_<?php echo $id; ?>menu" value="1">
                                                <input name="itemprice" type="hidden" value="<?php echo $menuitem->price; ?>" id="itemprice_<?php echo $id; ?>menu" />
                                                <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                                <a onclick="addtocartitem(<?php echo $menuitem->ProductsID; ?>,<?php echo $id; ?>,'menu')" class="simple_btn mt-1"><?php echo display('add_to_cart')?></a>
											<?php } else { ?>
                                               <div id="snackbar<?php echo $id; ?>" class="snackbar"><?php echo display('item_has_been_successfully_added')?></div>
                                                <a onclick="addonsitem(<?php echo $menuitem->ProductsID; ?>,<?php echo $menuitem->variantid; ?>,'menu')" class="simple_btn mt-1" data-toggle="modal" data-target="#addons" data-dismiss="modal">add to cart</a> 
                                        <?php }
                                        }
                                    } else { ?>
                                        <a class="simple_btn mt-1" data-toggle="modal" data-target="#closenotice" data-dismiss="modal"> <i class="ti-shopping-cart mr-2"></i><span><?php echo display('add_to_cart')?></span></a>
                                    <?php }
                                    ?>
                                </div>
                                <div class="item_info col-lg-3 col-sm-4 text-center">
                                    <h4><?php if ($this->storecurrency->position == 1) {
                                            echo $this->storecurrency->curr_icon;
                                        } ?><?php echo $menuitem->price; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></h4>

                                    <?php echo $availavail; ?>
                                    <div class="cart_counter">
                                        <button onclick="var result = document.getElementById('sst6<?php echo $id; ?>_menu'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input type="text" name="qty" id="sst6<?php echo $id; ?>_menu" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                        <button onclick="var result = document.getElementById('sst6<?php echo $id; ?>_menu'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="single_item row mb-3">
                            <div class="item_details col-lg-6 col-sm-5 pl-0 text-center">
                                <a href="<?php echo base_url() . 'menu'; ?>" class="item_title"><?php echo display('no_data_found') ?></a>

                            </div>
                        </div>
                    <?php } ?>
                    <nav><?php echo $links; ?></nav>
                </div>
            </div>
            <div class="col-xl-3 d-none d-xl-block">
                <ul class="cart-box" id="cartitem">
                    <?php
                    $calvat = 0;
                    $discount = 0;
                    $itemtotal = 0;
                    $pvat = 0;
                    $multiplletax = array();
                    if ($cart = $this->cart->contents()) {
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
                                if (!empty($taxinfos)) {

                                    $addonsarray = explode(',', $item['addonsid']);
                                    $addonsqtyarray = explode(',', $item['addonsqty']);
                                    $getaddonsdatas = $this->db->select('*')->from('add_ons')->where_in('add_on_id', $addonsarray)->get()->result_array();
                                    $addn = 0;
                                    foreach ($getaddonsdatas as $getaddonsdata) {
                                        $tax = 0;

                                        foreach ($taxinfos as $taxainfo) {

                                            $fildaname = 'tax' . $tax;

                                            if (!empty($getaddonsdata[$fildaname])) {

                                                $avatcalc = ($getaddonsdata['price'] * $addonsqtyarray[$addn]) * $getaddonsdata[$fildaname] / 100;
                                                $multiplletax[$fildaname] = $multiplletax[$fildaname] + $avatcalc;
                                            } else {
                                                $avatcalc = ($getaddonsdata['price'] * $addonsqtyarray[$addn]) * $taxainfo['default_value'] / 100;
                                                $multiplletax[$fildaname] = $multiplletax[$fildaname] + $avatcalc;
                                            }

                                            $pvat = $pvat + $avatcalc;

                                            $tax++;
                                        }
                                        $addn++;
                                    }
                                }
                                $nittotal = $item['addontpr'];
                                $itemprice = $itemprice + $item['addontpr'];
                            } else {
                                $nittotal = 0;
                                $itemprice = $itemprice;
                            }
                            $totalamount = $totalamount + $nittotal;
                            $subtotal = $subtotal - $discal + ($item['price'] * $item['qty']);
                            $i++;
                    ?>



                            <li class="cart-content row">
                                <div class="img-box">
                                    <img src="<?php echo base_url(!empty($iteminfo->small_thumb) ? $iteminfo->small_thumb : 'assets/img/no-image.png'); ?>" class="img-fluid" alt="<?php echo $item['name']; ?>">
                                </div>
                                <div class="content">
                                    <h6><?php echo $item['name']; ?></h6>
                                    <p><?php echo $item['qty']; ?> X <?php if($this->storecurrency->position == 1){ echo $this->storecurrency->curr_icon; } ?><?php echo $item['price'] - $discal; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></p>
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
                                            } ?><?php echo $itemtotal; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo display('vat') ?></td>
                                        <td><?php if ($this->storecurrency->position == 1) {
                                                echo $this->storecurrency->curr_icon;
                                            } ?><?php echo $calvat; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo display('discount') ?></td>
                                        <td><?php if ($this->storecurrency->position == 1) {
                                                echo $this->storecurrency->curr_icon;
                                            } ?><?php echo $discount; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><?php echo display('total') ?></td>
                                        <td><?php if ($this->storecurrency->position == 1) {
                                                echo $this->storecurrency->curr_icon;
                                            } ?><?php echo $calvat + $itemtotal - $discount; ?><?php if ($this->storecurrency->position == 2) { echo $this->storecurrency->curr_icon; } ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </li>
                        <li class="cart-footer text-right">
                            <div class="checkout-box">
                                <a href="<?php echo base_url(); ?>cart" class="simple_btn mt-0"><?php echo display('go_to_checkout') ?></a>
                            </div>
                        </li>
                    <?php } else {
                    ?>
                        <li class="cart-header text-center">
                            <h6><?php echo display('cart') ?></h6>
                        </li>
                    <?php } ?>

                </ul>
                <div class="ad_area">
                    <a href="<?php $ads->slink; ?>">
                        <img src="<?php echo base_url() . $ads->image; ?>" alt="<?php $ads->title; ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Menu Area