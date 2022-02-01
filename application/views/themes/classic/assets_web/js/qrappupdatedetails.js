// JavaScript Document
"use strict";
        $('.category_slider').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            nav: false,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            responsive: {
                0: {
                    items: 4
                },
                400: {
                    items: 4
                },
                480: {
                    items: 5
                },
                650: {
                    items: 6
                }
            }
        });

        function scrollNav() {
            $('.goto').click(function() {
                $(".active").removeClass("active");
                $(this).addClass("active");

                $('html, body').stop().animate({
                    scrollTop: $($(this).attr('href')).offset().top - 200
                }, 300);
                return false;
            });
        }
        scrollNav();

        function appcart(pid, vid, id) {
            var itemname = $("#itemname_999" + id).val();
            var sizeid = $("#sizeid_999" + id).val();
            var varientname = $("#varient_999" + id).val();
            var qty = $("#sst6999_" + id).val();
            var price = $("#itemprice_999" + id).val();
            var catid = $("#catid_999" + id).val();
            var reduce = "insert";
            var myurl = basicinfo.baseurl+'hungry/addtocartqr2/';
            var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&Udstatus=' + reduce+'&csrf_test_name='+basicinfo.csrftokeng;
            $.ajax({
                type: "POST",
                url: myurl,
                dataType: "text",
                async: false,
                data: dataString,
                success: function(data) {
                
                    $("#cartitemandprice").html(data);
                    $("#fixedarea").show();
                }
            });
        }

        function addonsitemqr(id, sid, type) {
            var myurl = basicinfo.baseurl+'hungry/addonsitemqr/' + id;
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
            var mid = $("#mainqrid").val();
      		
            var catid = $("#catid_1" + mid).val();
            var itemname = $("#itemname_1" + mid).val();
            var sizeid = $("#sizeid_1" + mid).val();
            var varientname = $("#varient_1" + mid).val();
            var qty = $("#sst61_" + mid).val();
            var price = $("#itemprice_1" + mid).val();
            var myurl = basicinfo.baseurl+'hungry/addtocartqr2/';
            var dataString = "pid=" + pid + '&itemname=' + itemname + '&varientname=' + varientname + '&qty=' + qty + '&price=' + price + '&catid=' + catid + '&sizeid=' + sizeid + '&addonsid=' + addons + '&allprice=' + allprice + '&adonsunitprice=' + adonsprice + '&adonsqty=' + adonsqty + '&adonsname=' + adonsname+'&csrf_test_name='+basicinfo.csrftokeng;
            $.ajax({
                type: "POST",
                url: myurl,
                data: dataString,
                success: function(data) {
                    $("#backadd" + mid).addClass("d-none");
                    $('#addons').modal('hide');
                    $("#cartitemandprice").html(data);
                    $("#fixedarea").show();
                }
            });

        }