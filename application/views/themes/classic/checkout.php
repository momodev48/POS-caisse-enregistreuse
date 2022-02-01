<?php if (!empty($seoterm)) {
	$seoinfo = $this->db->select('*')->from('tbl_seoption')->where('title_slug', $seoterm)->get()->row();
}?>
<div class="modal fade" id="lostpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo display('forgot_password'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body passwordupdate">
                <div class="form-group">
                    <label class="control-label" for="user_email"><?php echo display('email'); ?></label>
                    <input type="text" id="user_email2" class="form-control" name="user_email2">
                </div>
                <a onclick="lostpassword();" class="btn btn-success btn-sm lost-pass"><?php echo display('submit'); ?></a>
            </div>

        </div>
    </div>
</div>
<div class="page_header">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="page_header_content">
                    <ul class="m-0 nav">
                        <li><a href="<?php echo base_url(); ?>"><?php echo display('home'); ?></a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li class="active"><a><?php echo $seoinfo->title; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="checkout_area sect_pad">
    <div class="container">
        <div class="row">
            <?php if ($this->session->flashdata('exception')) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('exception') ?>
                </div>
            <?php } ?>
            <?php echo form_open('hungry/placeorder','method="post" class="row"')?>
                <div class="col-xl-8 col-lg-7">
                    <?php if (empty($this->session->userdata('CusUserID'))) { ?>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title">
                                        <i class="fa fa-question-circle"></i> <?php echo display('returning_customer') ?><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <?php echo display('click_login') ?></a>
                                    </h6>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p><?php echo display('checkout_msg') ?></p>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="user_email"><?php echo display('username_or_email') ?></label>
                                                    <input type="text" id="user_email" class="form-control" name="user_email">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="u_pass"><?php echo display('password') ?> <abbr class="required" title="required">*</abbr></label>
                                                    <input type="password" id="u_pass" class="form-control" name="u_pass">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="checkbox checkbox-success">
                                                    <input id="brand1" type="checkbox">
                                                    <label for="brand1"><?php echo display('remember_me') ?></label>
                                                </div>
                                                <?php $facrbooklogn = $this->db->where('directory', 'facebooklogin')->where('status', 1)->get('module')->num_rows();
                                                if ($facrbooklogn == 1) {
                                                ?>
                                                    <a class="btn btn-primary search text-white" href="<?php echo base_url('facebooklogin/facebooklogin/index') ?>"><i class="fa fa-facebook pr-1"></i><?php echo display('facebook_login') ?></a>
                                                <?php } ?>
                                                <a class="btn simple_btn mt-0 text-white" onclick="logincustomer();"><?php echo display('login') ?></a>
                                                <a class="lost-pass" data-toggle="modal" data-target="#lostpassword" data-dismiss="modal"><?php echo display('forgot_password') ?></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="billing-form mt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="billing-title"><?php echo display('billing_address') ?></h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-error">
                                        <label class="control-label" for="f_name"><?php echo display('first_name') ?> <abbr class="required" title="required">*</abbr></label>
                                        <?php
                                        $cusfname = "";
                                        $cusfname = $this->session->has_userdata('cusfname') ? $this->session->userdata('cusfname') : NULL; ?>
                                        <input type="text" id="f_name" class="form-control" name="f_name" value="<?php echo ((!empty($billinginfo->firstname) || !empty($cusfname)) ? $cusfname : null) ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="l_name"><?php echo display('last_name') ?> <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" id="l_name" class="form-control" name="l_name" value="<?php echo (!empty($billinginfo->lastname) ? $billinginfo->lastname : null) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label"><?php echo display('country') ?></label>
                                        <select name="country" id="country">
                                            <option value=""><?php echo display('select_country') ?></option>
                                            <?php if (!empty($countryinfo)) {
                                                foreach ($countryinfo as $mcountry) {
                                            ?>
                                                    <option value="<?php echo $mcountry->countryname; ?>" data-id="<?php echo $mcountry->countryid; ?>"><?php echo $mcountry->countryname; ?></option>
                                            <?php }
                                            }  ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="email"><?php echo display('email') ?> <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo (!empty($billinginfo->email) ? $billinginfo->email : null) ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="district"><?php echo display('state') ?> <abbr class="required" title="required">*</abbr></label>
                                        <select name="district" id="district">
                                            <option value=""><?php echo display('select_state') ?></option>
                                            <option value="<?php echo (!empty($billinginfo->district) ? $billinginfo->district : null) ?>" data-stateid=''><?php echo (!empty($billinginfo->district) ? $billinginfo->district : null) ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="town"><?php echo display('town_city')?></label>
                                        <select name="town" id="town">
                                            <option value=""><?php echo display('select_city')?></option>
                                            <option value="<?php echo (!empty($billinginfo->city) ? $billinginfo->city : null) ?>" data-city=''><?php echo (!empty($billinginfo->city) ? $billinginfo->city : null) ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?php echo display('street_address')?></label>
                                        <input type="text" id="billing_address_1" class="form-control" name="billing_address_1" value="<?php echo (!empty($billinginfo->address) ? $billinginfo->address : null) ?>">
                                    </div>



                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="postcode"><?php echo display('postcode_zip')?></label>
                                                <input type="text" id="postcode" class="form-control" name="postcode" value="<?php echo (!empty($billinginfo->zip) ? $billinginfo->zip : null) ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="phone"><?php echo display('phone')?> <abbr class="required" title="required">*</abbr></label>
                                                <input type="text" id="phone" class="form-control" value="<?php echo (!empty($billinginfo->phone) ? $billinginfo->phone : null) ?>" placeholder="Add Country Code" name="phone" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (empty($this->session->userdata('CusUserID'))) { ?>
                                <div class="checkbox checkbox-success" data-toggle="collapse" data-target="#account-pass">
                                    <input id="creat_ac" type="checkbox" name="isaccount">
                                    <label for="creat_ac"><?php echo display('create_account')?></label>
                                </div>
                                <div class="collapse" id="account-pass">
                                    <div class="form-group">
                                        <label class="control-label" for="ac_pass"><?php echo display('create_account_password')?></label>
                                        <input type="text" class="form-control" id="ac_pass" name="password">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="shipping_address2">
                                <label for="shipping_address2" data-toggle="collapse" data-target="#billind-different-address"><?php echo display('shipping_different_address')?></label>
                            </div>
                            <div class="collapse" id="billind-different-address">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group has-error">
                                            <label class="control-label" for="f_name3"><?php echo display('first_name')?> <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" id="f_name3" class="form-control" name="f_name3" value="<?php echo (!empty($shippinginfo->firstname) ? $shippinginfo->firstname : null) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="l_name2"><?php echo display('last_name')?> <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" id="l_name2" class="form-control" name="l_name2" value="<?php echo (!empty($shippinginfo->lastname) ? $shippinginfo->lastname : null) ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label"><?php echo display('country')?></label>
                                            <select name="country2" id="country2">
                                                <option value=""><?php echo display('select_country')?></option>
                                                <?php if (!empty($countryinfo)) {
                                                    foreach ($countryinfo as $mcountry) {
                                                ?>
                                                        <option value="<?php echo $mcountry->countryname; ?>" data-id="<?php echo $mcountry->countryid; ?>"><?php echo $mcountry->countryname; ?></option>
                                                <?php }
                                                }  ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="email2"><?php echo display('email')?> <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" id="email2" name="email2" class="form-control" value="<?php echo (!empty($shippinginfo->email) ? $shippinginfo->email : null) ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label" for="district2"><?php echo display('state')?> <abbr class="required" title="required">*</abbr></label>
                                            <select name="district2" id="district2">
                                                <option value=""><?php echo display('select_state')?></option>
                                                <option value="<?php echo (!empty($billinginfo->district) ? $billinginfo->district : null) ?>" data-stateid=''><?php echo (!empty($billinginfo->district) ? $billinginfo->district : null) ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="town2"><?php echo display('town_city')?></label>
                                            <select name="town2" id="town2">
                                                <option value=""><?php echo display('select_city')?></option>
                                                <option value="<?php echo (!empty($billinginfo->city) ? $billinginfo->city : null) ?>" data-stateid=''><?php echo (!empty($billinginfo->city) ? $billinginfo->city : null) ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"><?php echo display('street_address')?></label>
                                            <input type="text" id="billing_address_3" class="form-control" name="billing_address_3" value="<?php echo (!empty($shippinginfo->address) ? $shippinginfo->address : null) ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="postcode2"><?php echo display('postcode_zip')?></label>
                                                    <input type="text" id="postcode2" class="form-control" name="postcode2" value="<?php echo (!empty($shippinginfo->zip) ? $shippinginfo->zip : null) ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="phone2"><?php echo display('phone')?> <abbr class="required" title="required">*</abbr></label>
                                                    <input type="text" id="phone2" class="form-control" name="phone2" value="<?php echo (!empty($shippinginfo->phone) ? $shippinginfo->phone : null) ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="ordre_notes"><?php echo display('ordnote')?></label>
                                <textarea class="form-control" id="ordre_notes" rows="5" name="ordre_notes"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-8">
                    <div class="check_order">
                        <h5 class="text-center"><?php echo display('your_order')?></h5>
                        <?php
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
                        $multiplletax = array();
                        if ($cart = $this->cart->contents()) {

                            $totalamount = 0;
                            $subtotal = 0;
                            $pvat = 0;

                        ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-name"><?php echo display('product')?></th>
                                        <th class="product-total"><?php echo display('total')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
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
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <?php echo $item['name'];
                                                if (!empty($item['addonsid'])) {
                                                    echo "<br>";
                                                    echo $item['addonname'] . ' -Qty:' . $item['addonsqty'];
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
                                                }
                                                ?>
                                                <strong class="product-sum">× <?php echo $item['qty']; ?></strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                    } ?></span><?php echo $itemprice; ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                                                                                                        } ?></span></span>
                                            </td>
                                        </tr>
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
                                    //print_r($multiplletax);
                                    $multiplletaxvalue = htmlentities(serialize($multiplletax));
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th><?php echo display('subtotal')?></th>
                                        <td>
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                    } ?></span><?php echo $itemtotal; ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                                                                                                        } ?></span></span>
                                            </strong>
                                            <input name="orggrandTotal" type="hidden" value="<?php echo $itemtotal; ?>" />
                                        </td>
                                    </tr>
                                    <?php if (empty($taxinfos)) { ?>
                                        <tr class="order-total">
                                            <th><?php echo display('total_vat')?></th>
                                            <td>
                                                <strong>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                        } ?></span><?php echo $calvat; ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                                                                                                        } ?></span></span>
                                                </strong>
                                                <input name="vat" type="hidden" value="<?php echo $calvat; ?>" />
                                            </td>
                                        </tr>
                                        <?php } else {
                                        $i = 0;
                                        foreach ($taxinfos as $mvat) {
                                            if ($mvat['is_show'] == 1) {
                                        ?>
                                                <tr class="order-total">
                                                    <th><?php echo $mvat['tax_name']; ?></th>
                                                    <td>
                                                        <strong>
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                                    echo $this->storecurrency->curr_icon;
                                                                                                                } ?></span><?php echo $multiplletax['tax' . $i]; ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                                                                                                                                    } ?></span></span>
                                                        </strong>
                                                    </td>
                                                </tr>
                                        <?php $i++;
                                            }
                                        } ?>
                                        <input name="vat" type="hidden" value="<?php echo $calvat; ?>" />
                                    <?php } ?>
                                    <tr class="order-total">
                                        <th><?php echo display('discount')?></th>
                                        <td>
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                    } ?></span><?php echo 0; //$discount;
                                                                                                                ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                                                                                    } ?></span></span>
                                            </strong>
                                        </td>
                                    </tr>
                                    <?php $coupon = 0;
                                    if (!empty($this->session->userdata('couponcode'))) { ?>
                                        <tr class="order-total">
                                            <th><?php echo display('coupon_discount')?></th>
                                            <td>
                                                <strong>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                        } ?></span><?php echo $coupon = $this->session->userdata('couponprice'); ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                                                                                                                                                    } ?></span></span>
                                                </strong>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <input name="invoice_discount" type="hidden" value="<?php echo $discount + $coupon; ?>" />
                                    <tr class="order-total">
                                        <th><?php echo display('service')?></th>
                                        <td>
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                    } ?></span><?php echo $this->session->userdata('shippingrate'); ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                                                            echo $this->storecurrency->curr_icon;
                                                                                                                                                                                                                        } ?></span></span>
                                            </strong>
                                            <input name="service_charge" type="hidden" value="<?php echo $this->session->userdata('shippingrate'); ?>" />
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th><?php echo display('total')?></th>
                                        <td>
                                            <strong>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 1) {
                                                                                                        echo $this->storecurrency->curr_icon;
                                                                                                    } ?></span><?php echo ($calvat + $itemtotal + $this->session->userdata('shippingrate')) - ($coupon); ?><span class="woocommerce-Price-currencySymbol"><?php if ($this->storecurrency->position == 2) {
                                                                                                                                                                                                                                                                echo $this->storecurrency->curr_icon;
                                                                                                                                                                                                                                                            } ?></span></span>
                                            </strong><input name="grandtotal" type="hidden" value="<?php echo ($calvat + $itemtotal + $this->session->userdata('shippingrate')) - ($coupon); ?>" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        <?php } ?>
                        <!-- /.End of product list table -->
                        <div class="payment-block" id="payment">

                            <?php if (!empty($paymentinfo)) {
                                foreach ($paymentinfo as $payment) {
                            ?>
                                    <div class="payment-item">
                                        <input type="radio" name="card_type" id="payment_method_cre<?php echo $payment->payment_method_id; ?>" data-parent="#payment" data-target="#description_cre" value="<?php echo $payment->payment_method_id; ?>" class="" <?php if ($payment->payment_method_id == 4) {
                                                                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                                                                    } ?>>
                                        <label for="payment_method_cre<?php echo $payment->payment_method_id; ?>"><?php echo $payment->payment_method; ?></label>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                        <!-- /.End of payment method -->
                        <input class="btn simple_btn btn-block mt-0" name="" type="submit" value="<?php echo display('placeorder')?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>application/views/themes/<?php echo $this->themeinfo->themename; ?>/assets_web/js/checkout.js"></script>