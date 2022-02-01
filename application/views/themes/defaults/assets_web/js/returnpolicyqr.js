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
	  function updatecart(id,qty,status){
		if(status=="del" && qty==0){
			return false;
			}
		else{
		 var geturl=basicinfo.baseurl+'hungry/cartupdateqr';
		 var dataString = "CartID="+id+"&qty="+qty+"&Udstatus="+status+'&csrf_test_name='+basicinfo.csrftokeng;
		  $.ajax({
		 	 type: "POST",
			 url: geturl,
			 data: dataString,
			 success: function(data) {
				 $('#mycartlist').html(data);
				 var cartamount=$("#cartamount").val();
				 var totalvat=$("#totalvat").val();
				 var subtotal=$("#mainsubtotal").val();
				 var totaldiscount=$("#totaldiscount").val();
				 $("#grandtotal").val(cartamount);
				 $("#vat").val(totalvat);
				 $("#invoice_discount").val(totaldiscount);
				 $("#orggrandTotal").val(subtotal);
			 } 
		});
		}
	}
	function removetocart(rid){
		 var geturl=basicinfo.baseurl+'hungry/removetocartdetailsqr';
		 var dataString = "rowid="+rid+'&csrf_test_name='+basicinfo.csrftokeng;
		  $.ajax({
		 	 type: "POST",
			 url: geturl,
			 data: dataString,
			 success: function(data) {
				 $('#mycartlist').html(data);
				var cartamount=$("#cartamount").val();
				 var totalvat=$("#totalvat").val();
				 var totaldiscount=$("#totaldiscount").val();
				 var subtotal=$("#mainsubtotal").val();
				 $("#grandtotal").val(cartamount);
				 $("#vat").val(totalvat);
				 $("#invoice_discount").val(totaldiscount);
				 $("#orggrandTotal").val(subtotal);
					
			 } 
		});
		}
		
function changeqty(pid,vid,id) {
    var getqty = $("#sst" + id).val();
    var dataString = "CartID=" + rowid + '&qty=' + getqty+'&csrf_test_name='+basicinfo.csrftokeng;
    var myurl = basicinfo.baseurl+ 'cartupdate';
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function (data) {
           
        }
    });
}
function itemreduce(pid,vid,id) {
    var result = document.getElementById('sst' + id);
    var sstid = result.value;
    if (!isNaN(sstid) && sstid > 0) {
        result.value--;
     
    }
	if(sstid<=1){

		$("#sst"+ id).val(1);
	 $("#backadd"+id).removeClass("d-none");
	 $("#removeqtyb"+id).removeClass("active");
	 $("#removeqtyb"+id).addClass("hidden_cart");
	}
	     var reduce="del";
		  var qty=sstid;
         var itemname=$("#itemname_"+id).val();
		 var sizeid=$("#sizeid_"+id).val();
		 var varientname=$("#varient_"+id).val();
		 var price=$("#itemprice_"+id).val();
		 var catid=$("#catid_"+id).val();
	     var myurl =basicinfo.baseurl+'hungry/deltocartqr/';
		 var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&Udstatus='+reduce+'&csrf_test_name='+basicinfo.csrftokeng;
		 $.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {
				  $("#cartitemandprice").html(data);
				  $("#fixedarea").show();
			 } 
		});
}
function itemincrese(pid,vid,id) {
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
	     var myurl =basicinfo.baseurl+'addtocartqr/';
		 var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&Udstatus='+reduce+'&csrf_test_name='+basicinfo.csrftokeng;
		 $.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {
				  $("#cartitemandprice").html(data);
				  $("#fixedarea").show();
			 } 
		});
}
function appcart(pid,vid,id){
		 $("#sst"+ id).val(1);
	     var itemname=$("#itemname_"+id).val();
		 var sizeid=$("#sizeid_"+id).val();
		 var varientname=$("#varient_"+id).val();
		 var qty=$("#sst"+id).val();
		 var price=$("#itemprice_"+id).val();
		 var catid=$("#catid_"+id).val();
		 var reduce="insert";
	     var myurl =basicinfo.baseurl+'addtocartqr/';
		 var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&Udstatus='+reduce+'&csrf_test_name='+basicinfo.csrftokeng;
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
function addonsitemqr(id,sid,type){
		 var myurl=basicinfo.baseurl+'hungry/addonsitemqr/'+id;
		 var dataString = "pid="+id+"&sid="+sid+'&type='+type+'&csrf_test_name='+basicinfo.csrftokeng;
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
function addonsfoodtocart(pid,id,type){
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
	 var reduce="insert";
	 var catid=$("#catid_1"+mid).val();
	 var itemname=$("#itemname_1"+mid).val();
	 var sizeid=$("#sizeid_1"+mid).val();
	 var varientname=$("#varient_1"+mid).val();
	 var qty=$("#sst61_"+mid).val();
	 var price=$("#itemprice_1"+mid).val();	
	 var myurl =basicinfo.baseurl+'addtocartqr/';
	 var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&addonsid='+addons+'&allprice='+allprice+'&adonsunitprice='+adonsprice+'&adonsqty='+adonsqty+'&adonsname='+adonsname+'&Udstatus='+reduce+'&csrf_test_name='+basicinfo.csrftokeng;
		$.ajax({
		 	 type: "POST",
			 url: myurl,
			 data: dataString,
			 success: function(data) {				 
				 $("#backadd"+mid).addClass("d-none");
				 $('#addons').modal('hide');  
				 $("#cartitemandprice").html(data);
				 $("#fixedarea").show();
				 } 
		});

	}