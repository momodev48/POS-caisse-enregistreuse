// JavaScript Document
"use strict";    
$(document).on('click', '.sa-clicon', function() {
    swal.close();
});
$(document).on('change', '#varientinfo', function() {
    var id = $("#varientinfo").val();
    var name = $('#varientinfo option:selected').data('title');
    var price = $('#varientinfo option:selected').data('price');
    $("#sizeid_1other").val(id);
    $("#size_1other").val(name);
	$("#sizeid_1menu").val(id);
    $("#size_1menu").val(name);
    $("#itemprice_1other").val(price);
	$("#itemprice_1menu").val(price);
    $("#vprice").text(price);
});
$(document).on('change', '#varientinfodt', function() {
    var id = $("#varientinfodt").val();
    var name = $('#varientinfodt option:selected').data('title');
    var price = $('#varientinfodt option:selected').data('price');
    var pid = $("#dpid").val();
    var isaddons = $("#isaddons").val();
    $("#sizeid_999det").val(id);
    $("#varient_999det").val(name);
    $("#itemprice_999det").val(price);
    $("#vpricedt").text(price);
    if (isaddons == 1) {
        $("#chng_" + pid).attr('onclick', 'addonsitem(' + pid + ',' + id + ',"other")');
    }
});

function checkavailablity() {

    var getdate = $("#reservation_date").val();
    var time = $("#reservation_time").val();
    var people = $("#reservation_person").val();
    var geturl = $("#checkurl").val();
    var isopen = basicinfo.reservationopen;

    if (getdate == '') {
        alert(lang.select_date);
        return false;
    }
    if (time == '') {
        alert(lang.select_time);
        return false;
    }
    if (people == '' || people == 0) {
        alert(lang.enter_number_of_people);
        return false;
    }
    var currentDate = new Date();
    var intime = time.split(":");
    var day = currentDate.getDate()
    var month = currentDate.getMonth() + 1;
    var hours = currentDate.getHours();
    var year = currentDate.getFullYear()
    var currentday = Date.parse(year + '-' + month + '-' + day);
    var inutdate = Date.parse(getdate);

    if (currentday == inutdate) {

        var checkhour = currentDate.setHours(currentDate.getHours() + 1);
        var endTimeObject = new Date(checkhour);
        var inputtime = endTimeObject.setHours(intime[0], intime[1], 0);
    }
    if (checkhour >= inputtime) {
        swal("Invalid", lang.select_after_hour_current_time, "warning");
        return false;
    }


    var dataString = "getdate=" + getdate + "&time=" + time + "&people=" + people+'&csrf_test_name='+basicinfo.csrftokeng;
    // Call ajax for pass data to other place
    $.ajax({
        type: 'POST',
        url: geturl,
        data: dataString
    }).done(function(data, textStatus, jQxhr) {
        if (data == 1) {
            swal("Invalid", lang.no_free_seat_to_the_reservation, "warning");
        } else if (data == 2) {
            swal("Closed", lang.our_service_is_closed_on_this_date_and_time, "warning");
        } else {
            $('#searchreservation').html(data);
        }
    }).fail(function(jqXhr, textStatus, errorThrown) {
        alert(lang.posting_failed);
        console.log(errorThrown);
    });

}

function editreserveinfo(id) {
    var geturl = $("#url_" + id).val();
    var myurl = geturl + '/' + id;
    var sdate = $("#sldate").val();
    var sltime = $("#sltime").val();
    var people = $("#people").val();
    var dataString = "id=" + id + "&sdate=" + sdate + "&sltime=" + sltime + "&people=" + people+'&csrf_test_name='+basicinfo.csrftokeng;

    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('.editinfo').html(data);

            var input = $('#time, #reservation_time').clockpicker({
                placement: 'bottom',
                align: 'left',
                autoclose: true,
                'default': 'now'
            });
            $('#edit').modal('show');

            $(".datepicker4").datepicker({
                dateFormat: "dd-mm-yy"
            });

        }
    });
}

function addonsitem(id, sid, type) {
    var myurl = basicinfo.baseurl+'hungry/addonsitem/' + id;
    var dataString = "pid=" + id + "&sid=" + sid + '&type=' + type+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('.addonsinfo').html(data);
            $('#addons').modal('show');
        }
    });
}

function searchmenu(id) {
    $("#loadingcon").show();
    var myurl = basicinfo.baseurl+'searchitem/';
    var dataString = "catid=" + id+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $("#loadingcon").hide();
            $('#loaditem').html(data);
        }
    });
}

function addtocartitem(pid, id, type) {
    var itemname = $("#itemname_" + id + type).val();
    var sizeid = $("#sizeid_" + id + type).val();
    var varientname = $("#varient_" + id + type).val();
    var qty = $("#sst6" + id + "_" + type).val();
    var price = $("#itemprice_" + id + type).val();
    var catid = $("#catid_" + id + type).val();
    var ismenupage = $("#cartpage" + id + type).val();
    var myurl = basicinfo.baseurl+'hungry/addtocart/';
    var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty +
        '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid+'&csrf_test_name='+basicinfo.csrftokeng;

    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            if (ismenupage == 0) {
                $('#cartitem').html(data);
                var items = $("#totalitem").val();

                $(".my-cart-badge").html(items);
            } else {
                $('#cartitem').html(data);
                var items = $("#totalitem").val();
                $(".my-cart-badge").html(items);
            }
            var x = document.getElementById("snackbar" + id);
            x.className = "snackbar show";
            setTimeout(function() {
                x.className = x.className.replace("snackbar show", "snackbar");
            }, 3000);
        }
    });
}

function addonsfoodtocart(pid, id, type) {
    var addons = [];
    var adonsqty = [];
    var allprice = 0;
    var adonsprice = [];
    var adonsname = [];
    $('input[name="addons"]:checked').each(function() {
        var adnsid = $(this).val();
        var adsqty = $('#addonqty_' + adnsid).val();
        adonsqty.push(adsqty);
        addons.push($(this).val());

        allprice += parseFloat($(this).attr('role')) * parseInt(adsqty);
        adonsprice.push($(this).attr('role'));
        adonsname.push($(this).attr('title'));
    });
    var catid = $("#catid_" + id + type).val();
    var itemname = $("#itemname_" + id + type).val();
    var sizeid = $("#sizeid_" + id + type).val();
    var varientname = $("#varient_" + id + type).val();
    var qty = $("#sst6" + id + "_" + type).val();
    var price = $("#itemprice_" + id + type).val();
    var ismenupage = $("#cartpage" + id + type).val();
    var myurl = basicinfo.baseurl+'hungry/addtocart/';
    var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty +
        '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&addonsid=' + addons + '&allprice=' +
        allprice + '&adonsunitprice=' + adonsprice + '&adonsqty=' + adonsqty + '&adonsname=' + adonsname+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            if (ismenupage == 0) {
                $('#cartitem').html(data);
                $('#addons').modal('hide');
                var items = $("#totalitem").val();
                $(".my-cart-badge").html(items);
            } else {
                $('#cartitem').html(data);
                $('#addons').modal('hide');
                var items = $("#totalitem").val();
                $(".my-cart-badge").html(items);
            }
            var x = document.getElementById("snackbar" + id);
            x.className = "snackbar show";
            setTimeout(function() {
                x.className = x.className.replace("snackbar show", "snackbar");
            }, 3000);
        }
    });

}

function addonsitem2(id, sid, type) {
    var myurl = basicinfo.baseurl+'hungry/addonsitem/' + id;
    var dataString = "pid=" + id + "&sid=" + sid + '&type=' + type+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('.addonsinfo').html(data);
            $('#addons').modal('show');
        }
    });
}

function addtocartitem2(pid, id, type) {
    var itemname = $("#itemname2_" + id + type).val();

    var sizeid = $("#sizeid2_" + id + type).val();
    var varientname = $("#varient2_" + id + type).val();
    var qty = $("#sst6" + id + "_" + type).val();
    var price = $("#itemprice2_" + id + type).val();
    var catid = $("#catid2_" + id + type).val();
    var ismenupage = $("#cartpage2" + id + type).val();
    var myurl = basicinfo.baseurl+'hungry/addtocart/';
    var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty +
        '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid+'&csrf_test_name='+basicinfo.csrftokeng;

    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            if (ismenupage == 0) {
                $('#cartitem').html(data);
                var items = $("#totalitem").val();
                $(".my-cart-badge").html(items);
            } else {
                $('#cartitem').html(data);
                var items = $("#totalitem").val();
                $(".my-cart-badge").html(items);
            }
            var x = document.getElementById("snackbar" + id);
            x.className = "snackbar show";
            setTimeout(function() {
                x.className = x.className.replace("snackbar show", "snackbar");
            }, 3000);
        }
    });
}

function removecart(rid) {
    var geturl = basicinfo.baseurl+'hungry/removetocart';
    var dataString = "rowid=" + rid+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: geturl,
        data: dataString,
        success: function(data) {

            $('#cartitem').html(data);

            var items = $("#totalitem").val();
            $(".my-cart-badge").html(items);

        }
    });
}

function updatecart(id, qty, status) {
    if (status == "del" && qty == 0) {
        return false;
    } else {
        var geturl = basicinfo.baseurl+'hungry/cartupdate';
        var dataString = "CartID=" + id + "&qty=" + qty + "&Udstatus=" + status+'&csrf_test_name='+basicinfo.csrftokeng;
        $.ajax({
            type: "POST",
            url: geturl,
            data: dataString,
            success: function(data) {
                $('#reloadcart').html(data);
            }
        });
    }
}

function removetocart(rid) {
    var geturl = basicinfo.baseurl+'hungry/removetocartdetails';
    var dataString = "rowid=" + rid+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: geturl,
        data: dataString,
        success: function(data) {
            $('#reloadcart').html(data);

        }
    });
}

function getcheckbox(price, name) {
    var servicecharge = price;
    $("#scharge").text(servicecharge);
    $("#servicename").val(name);
    $("#getscharge").val(servicecharge);
    var vat = $("#vat").text();
    var discount = $("#discount").text();
    var totalprice = $("#subtotal").text();
    var coupondis = $("#coupdiscount").text();
    var grandtotal = (parseFloat(totalprice) + parseFloat(vat) + parseFloat(servicecharge)) - (parseFloat(
        discount) + parseFloat(coupondis));
    var grandtotal = grandtotal.toFixed(2);
    $("#grtotal").text(grandtotal);
    var geturl = basicinfo.baseurl+'hungry/setshipping';
    var dataString = "shippingcharge=" + price + '&shipname=' + name+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: geturl,
        data: dataString,
        success: function(data) {}
    });
}

function gotocheckout() {
    var error = 0;
    var getdate = $("#orderdate").val();
    var time = $("#reservation_time").val();
    var isopen = 0;
    var dataString = "getdate=" + getdate + '&time=' + time+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        async: false,
        type: "POST",
        global: false,
        dataType: 'json',
        url: basicinfo.baseurl+'hungry/checkopenclose',
        data: dataString,
        success: function(data) {
            isopen = data.isopen;
        }
    });
    if (isopen == 0) {
        swal("Closed",lang.closed_msg+" "+basicinfo.opentime+" - "+ basicinfo.closetime,"warning");
        return false;
    }
    if ($('input[name="payment_method"]:checked').length === 0) {
         error = 1
        alert(lang.please_select_shipping_method);
        return false;
    }
    if (error == 0) {
        window.location.href = basicinfo.baseurl+'checkout';
    }
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function subscribeemail() {
    var email = $("#youremail").val();
    if (email == '') {
        alert(lang.please_enter_your_email);
        return false;
    }
    if (!IsEmail(email)) {
        alert(lang.please_enter_valid_email);
        return false;
    }
    var geturl = basicinfo.baseurl+'hungry/subscribe';
    var dataString = "email=" + email+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: geturl,
        data: dataString,
        success: function(data) {
			swal("Success", lang.thanks_for_subscription, "success");
        }
    });
}

function itemnote(rowid, notes) {
    $("#foodnote").val(notes);
    $("#foodcartid").val(rowid);
    $('#vieworder').modal('show');
}

function addnotetoitem() {
    var rowid = $("#foodcartid").val();
    var note = $("#foodnote").val();
    var geturl = basicinfo.baseurl+'hungry/additemnote';
    var dataString = "foodnote=" + note + '&rowid=' + rowid+'&csrf_test_name='+basicinfo.csrftokeng;
    $.ajax({
        type: "POST",
        url: geturl,
        data: dataString,
        success: function(data) {
            alert(lang.note_added);
            $('#reloadcart').html(data);
            $('#vieworder').modal('hide');
        }
    });
}
