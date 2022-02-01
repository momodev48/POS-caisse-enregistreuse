// JavaScript Document
"use strict";
        $('.category_slider').owlCarousel({
            loop: false,
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

        $(".simple_btn").click(function() {
            $(this).addClass("d-none");
            $(this).siblings(".cart_counter").addClass("active");
			
        });
		$(".adonsclose").click(function() {
			var id= $("#mainqrid").val();
           $("#backadd"+id).removeClass("d-none");    
		   $("#removeqtyb"+id).removeClass("active");
		   $("#removeqtyb"+id).addClass("hidden_cart"); 
        });
function addextra(pid,vid,id,orderid) {
    var result = document.getElementById('sst' + id);
    var sstid = result.value;
    if (!isNaN(sstid)) {
        result.value++;
    }
		 var reduce="addstatus";
 		 var itemname=$("#itemname_"+id).val();
		 var sizeid=$("#sizeid_"+id).val();
		 var varientname=$("#varient_"+id).val();
		 var qty=$("#sst"+id).val();
		 var price=$("#itemprice_"+id).val();
		 var catid=$("#catid_"+id).val();
	     var myurl =basicinfo.baseurl+'hungry/updateorder/';
		 var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&orderid='+orderid+'&Udstatus='+reduce+'&csrf_test_name='+basicinfo.csrftokeng;
		 $.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {
			     $("#cartitemandprice").html(data);
				alert("Update Done!!!");
			 } 
		});
}
function addonsitemqr(id,sid,type,orderid){
		 var myurl=basicinfo.baseurl+'hungry/addonsitemqr2/'+id;
		 var dataString = "pid="+id+"&sid="+sid+'&type='+type+'&orderid='+orderid+'&csrf_test_name='+basicinfo.csrftokeng;
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
function addextra2(pid,id,type,orderid){
	var addons = [];
	var adonsqty=[];
	 var allprice = 0;
	 var adonsprice = [];
	 var adonsname=[];
				$('input[name="addons"]:checked').each(function() {
					var adnsid=$(this).val();
					var adsqty=$('#addonqty_'+adnsid).val();
					adonsqty.push(adsqty);
				  	addons.push($(this).val());
					
					allprice += parseFloat($(this).attr('role'))*parseInt(adsqty);
					adonsprice.push($(this).attr('role'));
					adonsname.push($(this).attr('title'));
				});
	 var mid= $("#mainqrid").val();	
		
	 var catid=$("#catid_1"+mid).val();
	 var itemname=$("#itemname_1"+mid).val();
	 var sizeid=$("#sizeid_1"+mid).val();
	 var varientname=$("#varient_1"+mid).val();
	 var qty=$("#sst61_"+mid).val();
	 var price=$("#itemprice_1"+mid).val();	
	 var myurl =basicinfo.baseurl+'hungry/updateorder/';
	 var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&addonsid='+addons+'&allprice='+allprice+'&adonsunitprice='+adonsprice+'&adonsqty='+adonsqty+'&adonsname='+adonsname+'&orderid='+orderid+'&csrf_test_name='+basicinfo.csrftokeng;
		$.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {				 
				 $("#backadd"+mid).addClass("d-none");
				 $('#addons').modal('hide');  
				 $("#cartitemandprice").html(data);
				 	alert("Update Done!!!");
				 } 
		});

	}