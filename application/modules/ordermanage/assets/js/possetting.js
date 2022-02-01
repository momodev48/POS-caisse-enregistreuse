  // JavaScript Document
  $(document).ready(function(){
  "use strict";
  if(basicinfo.segment4!=null){
  swal({
		  title: lang.ord_uodate_success,
		  text: lang.do_print_token,
		  type: "success",
		  showCancelButton: true,
		  confirmButtonColor: "#28a745",
		  confirmButtonText: "Yes",
		  cancelButtonText: "No",
		  closeOnConfirm: false,
		  closeOnCancel: true
	  },
  function (isConfirm) {
		  if (isConfirm) {
			window.location.href=basicinfo.baseurl+"ordermanage/order/postokengenerate/"+basicinfo.segment4+"/1";
		  } else {
			  window.location.href=basicinfo.baseurl+"ordermanage/order/pos_invoice";
		  }
	  });
  }
  });
  $( window ).load(function() {
	// Run code
	 "use strict";
	$(".sidebar-mini").addClass('sidebar-collapse');
	var myurl=basicinfo.baseurl+"ordermanage/order/cashregister";
	var csrf = $('#csrfhashresarvation').val();
	$.ajax({
			  type: "GET",
			  async: false,
			  url: myurl,
			  success: function(data) {
			  if(data==1){return false; }
				 $('#openclosecash').html(data);
				 $('#openregister').modal({
				 backdrop: 'static',
				 keyboard: false
				});
			  }
		  });
   var filename=basicinfo.baseurl+basicinfo.nofitysound;
	   var audio = new Audio(filename);
  });
  $(document).ready(function () {
	  "use strict";
	  // select 2 dropdown 
	  $("select.form-control:not(.dont-select-me)").select2({
		  placeholder: lang.sl_option,
		  allowClear: true
	  });
  
  
  
  
		//form validate
	  $("#validate").validate();
	  $("#add_category").validate();
	  $("#customer_name").validate();
  
	  $('.product-list').slimScroll({
		  size: '3px',
		  height: '345px',
		  allowPageScroll: true,
		  railVisible: true
	  });
  
	  $('.product-grid').slimScroll({
		  size: '3px',
		  height: 'calc(100vh - 180px)',
		  allowPageScroll: true,
		  railVisible: true
	  });
  
  var audio = new Audio(basicinfo.baseurl+'assets/beep-08b.mp3');
  });
  
  "use strict";
  function getslcategory(carid){
		  var product_name = $('#product_name').val();
		  var csrf = $('#csrfhashresarvation').val();
		  var category_id = carid;
		  var myurl= $('#posurl').val();
		  $.ajax({
			  type: "post",
			  async: false,
			  url: myurl,
			  data: {product_name: product_name,category_id:category_id,isuptade:0,csrf_test_name:csrf},
			  success: function(data) {
				  if (data == '420') {
					  $("#product_search").html('Product not found !');
				  }else{
					  $("#product_search").html(data); 
				  }
			  },
			  error: function() {
				  alert(lang.req_failed);
			  }
		  });
	   }
  //Product search button js
  $('body').on('click', '#search_button', function(){
		  var product_name = $('#product_name').val();
		  var category_id = $('#category_id').val();
		  var csrf = $('#csrfhashresarvation').val();
		  var myurl= $('#posurl').val();
		  $.ajax({
			  type: "post",
			  async: false,
			  url: myurl,
			  data: {product_name: product_name,category_id:category_id,csrf_test_name:csrf},
			  success: function(data) {
				  if (data == '420') {
					  $("#product_search").html('Product not found !');
				  }else{
					  $("#product_search").html(data); 
				  }
			  },
			  error: function() {
				  alert(lang.req_failed);
			  }
		  });
	  });    
  
  //Product search button js
  $('body').on('click', '.select_product', function(e){
		  e.preventDefault();
		  
		  var panel = $(this);
		  var pid = panel.find('.panel-body input[name=select_product_id]').val();
		  var sizeid = panel.find('.panel-body input[name=select_product_size]').val();
		  var totalvarient = panel.find('.panel-body input[name=select_totalvarient]').val();
		  var customqty = panel.find('.panel-body input[name=select_iscustomeqty]').val();
		  var isgroup = panel.find('.panel-body input[name=select_product_isgroup]').val();
		  var catid = panel.find('.panel-body input[name=select_product_cat]').val();
		  var itemname= panel.find('.panel-body input[name=select_product_name]').val();
		  var varientname=panel.find('.panel-body input[name=select_varient_name]').val();
		  var qty=1;
		  var price=panel.find('.panel-body input[name=select_product_price]').val();
		  var hasaddons=panel.find('.panel-body input[name=select_addons]').val();
		  var csrf = $('#csrfhashresarvation').val();
		  if(hasaddons==0 && totalvarient==1 && customqty==0){
			  /*check production*/
				  var productionsetting = $('#production_setting').val();
				  if(productionsetting == 1){
					 
					  var isselected = $('#productionsetting-'+pid+'-'+sizeid).length;
					
					  if(isselected ==1 ){
  
						  var checkqty = parseInt($('#productionsetting-'+pid+'-'+sizeid).text())+qty;
  
												 
					  }
					  else{
						  var checkqty = qty;
					  }
  
					   var checkvalue = checkproduction(pid,sizeid,checkqty);
  
						  if(checkvalue == false){
							  return false;
						  }
					  
				  }
			  /*end checking*/
		  var mysound=basicinfo.baseurl+"assets/";
		  var audio =["beep-08b.mp3"];
		  new Audio(mysound + audio[0]).play();
		  var dataString = "pid="+pid+'&itemname='+itemname+'&varientname='+varientname+'&qty='+qty+'&price='+price+'&catid='+catid+'&sizeid='+sizeid+'&isgroup='+isgroup+'&csrf_test_name='+csrf;
		  var myurl= $('#carturl').val();
		   $.ajax({
			   type: "POST",
			   url: myurl,
			   data: dataString,
			   success: function(data) {
					  $('#addfoodlist').html(data);
					  var total=$('#grtotal').val();
					  var totalitem=$('#totalitem').val();
					  $('#item-number').text(totalitem);
					  $('#getitemp').val(totalitem);
					  var tax=$('#tvat').val();
					  $('#vat').val(tax);
					  var discount=$('#tdiscount').val();
					  var tgtotal=$('#tgtotal').val();
					  $('#calvat').text(tax);
					  $('#invoice_discount').val(discount);
					  var sc=$('#sc').val();
					  $('#service_charge').val(sc);
					  $('#caltotal').text(tgtotal);
					  $('#grandtotal').val(tgtotal);
					  $('#orggrandTotal').val(tgtotal);
					  $('#orginattotal').val(tgtotal);
			   } 
		  });
		  }
	   else{
			   var geturl=$("#addonexsurl").val();
			   var myurl =geturl+'/'+pid;
			   var dataString = "pid="+pid+"&sid="+sizeid+'&csrf_test_name='+csrf;
			  $.ajax({
			   type: "POST",
			   url: geturl,
			   data: dataString,
			   success: function(data) {
					   $('.addonsinfo').html(data);
					   $('#edit').modal('show');
					   var totalitem=$('#totalitem').val();
					   var tax=$('#tvat').val();
					  var discount=$('#tdiscount').val();
					  var tgtotal=$('#tgtotal').val();
					  $('#vat').val(tax);
					  $('#calvat').text(tax);
					  $('#getitemp').val(totalitem);
					  $('#invoice_discount').val(discount);
					  $('#caltotal').text(tgtotal);
					  $('#grandtotal').val(tgtotal);
					  $('#orggrandTotal').val(tgtotal);
					  $('#orginattotal').val(tgtotal);
			   } 
		  });
		   }
	  });
  $(document).ready(function(){
	  "use strict";
		  $("#nonthirdparty").show();
		  $("#thirdparty").hide();
		  $("#delivercom").prop('disabled', true);
		  $("#waiter").prop('disabled', false);
		  $("#tableid").prop('disabled', false);
		  $("#cookingtime").prop('disabled', false);
		  $("#cardarea").hide();
		  
		  
		  $("#paidamount").on('keyup', function(){ 
			  var maintotalamount=$("#maintotalamount").val();
			  var paidamount=$("#paidamount").val();
			  var restamount=(parseFloat(paidamount))-(parseFloat(maintotalamount));
			  var changes=restamount.toFixed(2);
			  $("#change").val(changes);
		  });
		  
		  $(".payment_button").click(function(){
			  $(".payment_method").toggle();
  
			  //Select Option
			  $("select.form-control:not(.dont-select-me)").select2({
				  placeholder: lang.sl_option,
				  allowClear: true
			  });
		  });
		  
		  $("#card_typesl").on('change', function(){ 
			  var cardtype=$("#card_typesl").val();
			  
			  $("#card_type").val(cardtype);
			  if(cardtype==4){
			  $("#isonline").val(0);
			  $("#cardarea").hide();
			  $("#assigncard_terminal").val('');
			  $("#assignbank").val('');
			  $("#assignlastdigit").val('');
			  }
			  else if(cardtype==1){
			  $("#isonline").val(0);
			  $("#cardarea").show();
			  }
			  else{
				  $("#isonline").val(1);
				  $("#cardarea").hide();
				  $("#assigncard_terminal").val('');
				  $("#assignbank").val('');
				  $("#assignlastdigit").val('');
				  }
		   
		  });
		  $("#ctypeid").on('change', function(){ 
			  var customertype=$("#ctypeid").val();
			  if(customertype==3){
			  $("#delivercom").prop('disabled', false);
			  $("#waiter").prop('disabled', true);
			  $("#tableid").prop('disabled', true);
			  $("#cookingtime").prop('disabled', true);
			  $("#nonthirdparty").hide();
			  $("#thirdparty").show();
			  }
			  else if(customertype==4){
				  $("#nonthirdparty").show();
				  $("#thirdparty").hide();
				  $("#tblsec").hide();
				  $("#tblsecp").hide();
				  $("#delivercom").prop('disabled', true);
				  $("#waiter").prop('disabled', false);
				  $("#tableid").prop('disabled', true);
				  $("#cookingtime").prop('disabled', true);
			  }
			  else if(customertype==2){
				  $("#nonthirdparty").show();
				  $("#tblsecp").hide();
				  $("#tblsec").hide();
				  $("#thirdparty").hide();
				  $("#waiter").prop('disabled', false);
				  $("#tableid").prop('disabled', false);
				  $("#cookingtime").prop('disabled', false);
				  $("#delivercom").prop('disabled', true);
			  }
			  else{
				  $("#nonthirdparty").show();
				  $("#tblsecp").show();
				  $("#tblsec").show();
				  $("#thirdparty").hide();
				  $("#waiter").prop('disabled', false);
				  $("#tableid").prop('disabled', false);
				  $("#cookingtime").prop('disabled', false);
				  $("#delivercom").prop('disabled', true);
				  
				  }
		  });
		  $('[data-toggle="popover"]').popover({
  container: 'body' });
		  /*place order*/
		  Mousetrap.bind('shift+p', function() {
			   
				  placeorder();
			  });
		  /*quick order*/
		  Mousetrap.bind('shift+q',function(){
			  quickorder();
			});
		  /*select customer name*/
		  Mousetrap.bind('shift+c',function(){
			   $("#customer_name").select2('open');
			});
  
		   /*select customer type*/
		  Mousetrap.bind('shift+y',function(){
			   $("#ctypeid").select2('open');
			});
  
		  /*focus on discount*/
		  Mousetrap.bind('shift+d',function(){
			   $("#invoice_discount").focus();
			   return false;
			});
		  /*focus service charge*/
		  Mousetrap.bind('shift+r',function(){
			   $("#service_charge").focus();
			   return false;
			});
				 /*go ongoing order tab*/
		  Mousetrap.bind('shift+g',function(){
			   $(".ongord").trigger( "click" );
			});
		  /*go total order tab*/
		   Mousetrap.bind('shift+t',function(){
			   $(".torder").trigger( "click" );
			});
		  /*go online order tab*/
		  Mousetrap.bind('shift+o',function(){
			   $(".comorder").trigger( "click" );
			});
		  /*go new order tab*/
		  Mousetrap.bind('shift+n',function(){
			   $(".home").trigger( "click" );
			});
  
		  /*search unique product for cart*/
		  Mousetrap.bind('shift+s',function(){
					  $("#product_name").select2('open');
						 });
		  /*select item qty on addons modal*/
		  Mousetrap.bind('alt+q',function(){
					  $('#itemqty_1').focus();
					  return false;
						 });
			  /*add to cart on addons modal*/
		  Mousetrap.bind('shift+a',function(){
					   $("#add_to_cart").trigger( "click" );
						 });
			  /*edit on going order*/
		  Mousetrap.bind('shift+e',function(e){
					 $('[id*=table-]').focus();
					
						 });
		 
			/*table search*/
		  Mousetrap.bind('shift+x',function(e){
			  $("input[aria-controls=onprocessing]").focus();
			   return false;
			});
		  /*table search*/
		  Mousetrap.bind('shift+v',function(e){
			  $("input[aria-controls=Onlineorder]").focus();
			   return false;
			});
		   /*edit on going order*/
		  Mousetrap.bind('shift+m',function(e){
			   $('[id*=table-today-]').focus();
					
						 });
			/*select cooking time*/
		  Mousetrap.bind('alt+k',function(){
					  $('#cookedtime').focus();
					  return false;
						 });
		   /*select waiter*/
		  Mousetrap.bind('shift+w',function(){
					 $('#waiter').select2('open');
					  return false;
						 });
		   /*select table*/
		  Mousetrap.bind('shift+b',function(){
					  $('#tableid').select2('open');
					  return false;
						 });
		  /*select uniqe table on going order*/
		  Mousetrap.bind('alt+t',function(){
				   $("#ongoingtable_name").select2('open');
						 });
		  /*update srotcut*/
		  /*select update order list*/
		  Mousetrap.bind('alt+s',function(){
					  $("#update_product_name").select2('open');
						 });
		  /*select customer name*/
		  Mousetrap.bind('alt+c',function(){
			   $("#customer_name_update").select2('open');
			});
  
		   /*select customer type*/
		  Mousetrap.bind('alt+y',function(){
			   $("#ctypeid_update").select2('open');
			});
		   /*select waiter*/
		  Mousetrap.bind('alt+w',function(){
					 $('#waiter_update').select2('open');
					  return false;
						 });
		   /*select table*/
		  Mousetrap.bind('alt+b',function(){
					  $('#tableid_update').select2('open');
					  return false;
						 });
			 /*focus on discount*/
		  Mousetrap.bind('alt+d',function(){
			   $("#invoice_discount_update").focus();
			   return false;
			});
		  /*focus service charge*/
		  Mousetrap.bind('alt+r',function(){
			   $("#service_charge_update").focus();
			   return false;
			});
		   /*submit  update order*/
		  Mousetrap.bind('alt+u',function(){
					   $("#update_order_confirm").trigger( "click" );
						 });
		  /*end update sort cut*/
		  /*quick paid modal*/
		   /*select payment type name*/
		  Mousetrap.bind('alt+m',function(){
			   $(".card_typesl").select2('open');
			});
			/*type paid amount*/
		  Mousetrap.bind('alt+a',function(){
			   $('.number').focus();
				//window.prevFocus = $('.number');
			   return false;
			});
			/*print bill paid amount*/
		  Mousetrap.bind('alt+p',function(){
			   $('#pay_bill').trigger( "click" );
			});
			/*print bill paid amount*/
		  Mousetrap.bind('alt+x',function(){
			   $('.close').trigger( "click" );
			});
  
	  $('.search-field').select2({
		  placeholder: lang.sl_product,
		   minimumInputLength: 1,
		  ajax: {
			url: 'getitemlistdroup',
			dataType: 'json',
			delay: 250,
			//data:{csrf_test_name:basicinfo.csrftokeng},
			processResults: function (data) {
			  return {
				results:  $.map(data, function (item) {
					  return {
						  text: item.text+'-'+item.variantName,
						  id: item.id+'-'+item.variantid
					  }
				  })
			  };
			},
			cache: true
		  }
		});
	  
	  /*all ongoingorder product as ajax*/
	  $(document).on('click','#ongoingorder',function(){
			var url= 'getongoingorder';
			var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#onprocesslist').html(data);
		  }
  
		  }); 
		  });
	   /*all ongoingorder product as ajax*/
	  $(document).on('click','#kitchenorder',function(){
			var url= 'kitchenstatus';
			var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#kitchen').html(data);
		  }
  
		  }); 
  
  
		  });
	   /*all todayorder product as ajax*/
	  $(document).on('click','#todayorder',function(){
			var url= 'showtodayorder';
			var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#messages').html(data);
		  }
  
		  }); 
  
  
		  });
			/*all todayorder product as ajax*/
	  $(document).on('click','#todayonlieorder',function(){
  
			var url= 'showonlineorder';
			var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#settings').html(data);
		  }
  
		  }); 
  
  
		  });
				 /*all todayorder product as ajax*/
	  $(document).on('click','#todayqrorder',function(){
  
			var url= 'showqrorder';
			var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#qrorder').html(data);
		  }
  
		  }); 
  
  
		  });
	  
	  });
  /*unique table data*/
  "use strict";
  $(document).on('change','#ongoingtable_name',function(){
		   var id = $(this).children("option:selected").val();
			var url= 'getongoingorder'+'/'+id;
			var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#onprocesslist').html(data);
  
		  }
  
		  }); 
		   $('#table-'+id).focus();
  
		  });
  $(document).on('change','#ongoingtable_sr',function(){
		   var id = $(this).children("option:selected").val();
			var url= 'getongoingorder'+'/'+id+'/table';
			var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#onprocesslist').html(data);
  
		  }
  
		  }); 
		   $('#table-'+id).focus();
  
		  });
  /*select product from list*/
  $(document).on('change','#product_name', function(){
  
			  var tid = $(this).children("option:selected").val();
			  var idvid=tid.split('-');
			  var id=idvid[0];
			  var vid=idvid[1];
			  var url= 'srcposaddcart'+'/'+id;
			  var csrf = $('#csrfhashresarvation').val();
			  /*check production*/
			  /*please fixt count total counting*/
				  var productionsetting = $('#production_setting').val();
				  if(productionsetting == 1){
						  var checkqty = 1;
					   var checkvalue = checkproduction(id,vid,checkqty);
  
						  if(checkvalue == false){
							   $('#product_name').html('');
							  return false;
						  }
					  
				  }
			  /*end checking*/
			  $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
		
				   console.log(data);
				   var myurl ="adonsproductadd"+'/'+id;
				  $.ajax({
			   type: "GET",
			   url: myurl,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
					   $('.addonsinfo').html(data);
					   $('#edit').modal('show');
					  var totalitem=$('#totalitem').val();
					  var tax=$('#tvat').val();
					  var discount=$('#tdiscount').val();
					  var tgtotal=$('#tgtotal').val();
					  $('#vat').val(tax);
					  $('#calvat').text(tax);
					  var sc=$('#sc').val();
					  $('#service_charge').val(sc);
					  $('#getitemp').val(totalitem);
					  $('#invoice_discount').val(discount);
					  $('#caltotal').text(tgtotal);
					  $('#grandtotal').val(tgtotal);
					  $('#orggrandTotal').val(tgtotal);
					  $('#orginattotal').val(tgtotal);
					  $('#product_name').html('');
					  
				  } 
				  });
			   } 
		  });
  
	 });
  function printRawHtml(view) {
		printJS({
		  printable: view,
		  type: 'raw-html',
		  
		});
	  }
  function placeorder(){
		var ctypeid=$("#ctypeid").val();
		var waiter="";
		var isdelivary="";
		var thirdinvoiceid="";
		var tableid="";
		var customer_name=$("#customer_name").val();
		var cardtype=4;
		var isonline=0;
		var order_date=$("#order_date").val();
		var grandtotal=$("#grandtotal").val();
		var customernote="";
		var invoice_discount=$("#invoice_discount").val();
		var service_charge=$("#service_charge").val();
		var vat=$("#vat").val();
		var orggrandTotal=$("#subtotal").val();
		var isonline=$("#isonline").val();
		var isitem=$("#totalitem").val();
		var cookedtime=$("#cookedtime").val();
		var multiplletaxvalue = $('#multiplletaxvalue').val();
		var csrf = $('#csrfhashresarvation').val();
		var errormessage = '';
		  if(customer_name == ''){ errormessage = errormessage+'<span>Please Select Customer Name.</span>';
			  alert("Please Select Customer Name!!!");
			  return false;
		  }
		  if(ctypeid == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
			  alert("Please Select Customer Type!!!");
			  return false;
		  }
		  if(isitem == '' || isitem==0){ errormessage = errormessage+'<span>Please add Some Food</span>';
			  alert("Please add Some Food!!!");
			  return false;
		  }
		  if(ctypeid==3){
				   var isdelivary=$("#delivercom").val();
				   var thirdinvoiceid=$("#thirdinvoiceid").val();
				   if(isdelivary == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
					  alert("Please Select Delivar Company!!!");
					  return false;
				  }
			  }
		  else if(ctypeid==4 || ctypeid==2){
			   if(possetting.waiter==1){
				   var waiter=$("#waiter").val();
				   if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
					  alert("Please Select Waiter!!!");
					  return false;
				  }
				 }
			  }
		  else{
			  var waiter=$("#waiter").val();
			   var tableid=$("#tableid").val();
			   var table_member_multi = $('#table_member_multi').val();
			   var table_member_multi_person = $('#table_member_multi_person').val();
			   var table_member=$("#table_member").val();//table member 02/11
			   if(possetting.waiter==1){
				  if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
					  $("#waiter").select2('open');
					  return false;
				  }
			   } 
			   if(possetting.tableid==1){
				  if(tableid == ''){
					   $("#tableid").select2('open');
					  toastr.warning("Please Select Table", 'Warning');
					  return false;
				  }
				   if(possetting.tablemaping==1){
				  
				  if(tableid == ''||!$.isNumeric($('#table_person').val())){ 	toastr.warning("Please Select Table or number person", 'Warning');
						  return false;
					  }
					} } 
			  }
		  if(errormessage==''){
				order_date=encodeURIComponent(order_date);
				customernote=encodeURIComponent(customernote);
				var errormessage = '<span style="color:#060;">Signup Completed Successfully.</span>';
				var dataString = 'customer_name='+customer_name+'&ctypeid='+ctypeid+'&waiter='+waiter+'&tableid='+tableid+'&card_type='+cardtype+'&isonline='+isonline+'&order_date='+order_date+'&grandtotal='+grandtotal+'&customernote='+customernote+'&invoice_discount='+invoice_discount+'&service_charge='+service_charge+'&vat='+vat+'&subtotal='+orggrandTotal+'&assigncard_terminal=&assignbank=&assignlastdigit=&delivercom='+isdelivary+'&thirdpartyinvoice='+thirdinvoiceid+'&cookedtime='+cookedtime+'&tablemember='+table_member+'&table_member_multi='+table_member_multi+'&table_member_multi_person='+table_member_multi_person+'&multiplletaxvalue='+multiplletaxvalue+'&csrf_test_name='+csrf;
					  $.ajax({
						  type: "POST",
						  url: basicinfo.baseurl+"ordermanage/order/pos_order",
						  data: dataString,
						  success: function(data){
							  $('#addfoodlist').empty();
							  $("#getitemp").val('0');
							  $('#calvat').text('0');
							  $('#vat').val('0');
							  $('#invoice_discount').val('0');
							  $('#caltotal').text('');
							  $('#grandtotal').val('');
							  $('#thirdinvoiceid').val('');
							  $('#orggrandTotal').val('');
							  $('#waiter').select2('data', null);
							  $('#tableid').select2('data', null);
							  $('#waiter').val('');
						 
							  $('#table_member').val('');
							  $('#table_person').val(lang.person);
							  $('#table_member_multi').val(0);
							  $('#table_member_multi_person').val(0);
  
							  var err = data;
							  if(err=="error"){
								  swal({
								  title: lang.ord_failed,
								  text: lang.failed_msg,
								  type: "warning",
								  showCancelButton: true,
								  confirmButtonColor: "#DD6B55",
								  confirmButtonText: "Yes, Cancel!",
								  closeOnConfirm: true
								  },
								  function () {
								
								  });
								  }
							 else{
							  swal({
								  title: lang.ord_succ,
								  text: "Do you Want to Print Token No.???",
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
									  printRawHtml(data);							   
								  } else {
									  $('#waiter').select2('data', null);
									  $('#tableid').select2('data', null);
									  $('#waiter').val('');
									  $('#tableid').val('');
								  }
							  });
							 }
						  }
					  });
			  }
	  }
 function postokenprint(id){
	  var csrf = $('#csrfhashresarvation').val();
	  var url= 'paidtoken'+'/'+id+'/';
	  $.ajax({
			   type: "POST",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
			   printRawHtml(data);
		  }
	    });
	  }
  function editposorder(id,view){
			var url= 'updateorder'+'/'+id;
  			var csrf = $('#csrfhashresarvation').val();
			if(view == 1){
			  var vid = $("#onprocesslist");
			}
			else if(view == 2){
			  var vid = $("#messages");
			}
			else if(view == 4){
				var vid = $("#qrorder");
				}
			else{
			  var vid = $("#settings");
			}
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				vid.html(data);
		  }
	  });
	  }
  function quickorder(){
		var ctypeid=$("#ctypeid").val();
		var waiter="";
		var isdelivary="";
		var thirdinvoiceid="";
		var tableid="";
		var customer_name=$("#customer_name").val();
		var cardtype=4;
		var isonline=0;
		var order_date=$("#order_date").val();
		var grandtotal=$("#grandtotal").val();
		var customernote="";
		var invoice_discount=$("#invoice_discount").val();
		var service_charge=$("#service_charge").val();
		var vat=$("#vat").val();
		var orggrandTotal=$("#subtotal").val();
		
		var isitem=$("#totalitem").val();
		var cookedtime=$("#cookedtime").val();
		var multiplletaxvalue = $('#multiplletaxvalue').val();
		var csrf = $('#csrfhashresarvation').val();
		var errormessage = '';
		  if(customer_name == ''){ errormessage = errormessage+'<span>Please Select Customer Name.</span>';
			  alert("Please Select Customer Name!!!");
			  return false;
		  }
		  if(ctypeid == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
			  alert("Please Select Customer Type!!!");
			  return false;
		  }
		  if(isitem == '' || isitem==0){ errormessage = errormessage+'<span>Please add Some Food</span>';
			  alert("Please add Some Food!!!");
			  return false;
		  }
		  if(ctypeid==3){
				   var isdelivary=$("#delivercom").val();
				   var thirdinvoiceid=$("#thirdinvoiceid").val();
				   if(isdelivary == ''){ errormessage = errormessage+'<span>Please Select Customer Type.</span>';
					  alert("Please Select Delivar Company!!!");
					  return false;
				  }
			  }
		  else if(ctypeid==4 || ctypeid==2){
				   var waiter=$("#waiter").val();
				   if(quickordersetting.waiter==1){
				   if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
				   $("#waiter").select2('open');
					  
					  return false;
				  }
				  } 
			  }
		  else{
			   var waiter=$("#waiter").val();
			   var tableid=$("#tableid").val();
			   var table_member_multi = $('#table_member_multi').val();
			   var table_member_multi_person = $('#table_member_multi_person').val();
			   var table_member=$("#table_member").val();//table member 02/11
			   if(quickordersetting.waiter==1){
				  if(waiter == ''){ errormessage = errormessage+'<span>Please Select Waiter.</span>';
					  $("#waiter").select2('open');
					  return false;
				  }
			  }
			  if(quickordersetting.tableid==1){             
				  if(tableid == ''){
					   $("#tableid").select2('open');
					  toastr.warning("Please Select Table", 'Warning');
					  return false;
				  }
				  if(quickordersetting.tablemaping==1){ 				
				  if(tableid == ''||!$.isNumeric($('#table_person').val())){ 	toastr.warning("Please Select Table or number person", 'Warning');
						  return false;
					  }
				  } }
			  }
			  
		  
		  if(errormessage==''){
				order_date=encodeURIComponent(order_date);
				customernote=encodeURIComponent(customernote);
				var errormessage = '<span style="color:#060;">Signup Completed Successfully.</span>';
				var dataString = 'customer_name='+customer_name+'&ctypeid='+ctypeid+'&waiter='+waiter+'&tableid='+tableid+'&card_type='+cardtype+'&isonline='+isonline+'&order_date='+order_date+'&grandtotal='+grandtotal+'&customernote='+customernote+'&invoice_discount='+invoice_discount+'&service_charge='+service_charge+'&vat='+vat+'&subtotal='+orggrandTotal+'&assigncard_terminal=&assignbank=&assignlastdigit=&delivercom='+isdelivary+'&thirdpartyinvoice='+thirdinvoiceid+'&cookedtime='+cookedtime+'&tablemember='+table_member+'&table_member_multi='+table_member_multi+'&table_member_multi_person='+table_member_multi_person+'&multiplletaxvalue='+multiplletaxvalue+'&csrf_test_name='+csrf;
				 
					  $.ajax({
						  type: "POST",
						  url: basicinfo.baseurl+"ordermanage/order/pos_order/1",
						  data: dataString,
						  success: function(data){
							  $('#addfoodlist').empty();
							  $("#getitemp").val('0');
							  $('#calvat').text('0');
							  $('#vat').val('0');
							  $('#invoice_discount').val('0');
							  $('#caltotal').text('');
							  $('#grandtotal').val('');
							  $('#thirdinvoiceid').val('');
							  $('#orggrandTotal').val('');
							  $('#waiter').select2('data', null);
							  $('#tableid').select2('data', null);
							  $('#waiter').val('');
						   
							  $('#table_member').val('');
							  $('#table_person').val(lang.person);
							  $('#table_member_multi').val(0);
							  $('#table_member_multi_person').val(0);
							  var err = data;
							  if(err=="error"){
								  swal({
								  title: lang.ord_failed,
								  text: lang.failed_msg,
								  type: "warning",
								  showCancelButton: true,
								  confirmButtonColor: "#DD6B55",
								  confirmButtonText: "Yes, Cancel!",
								  closeOnConfirm: true
								  },
								  function () {
								
								  });
								  }
							 else{
							  swal({
								  title: lang.ord_places,
								  text: lang.do_print_in,
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
								  createMargeorder(data,1)
								   
								  } else {
									  $('#waiter').select2('data', null);
									  $('#tableid').select2('data', null);
									  $('#waiter').val('');
									  $('#tableid').val('');
									
								  }
							  });
							 }
						  }
					  });
			  }
	  }
  function printJobComplete() {
	$("#kotenpr").empty();
	}	 
  function printRawHtmlupdate(view,id) {
		printJS({
		  printable: view,
		  type: 'raw-html',
		  onPrintDialogClose: function () {
			  $.ajax({
			   type: "GET",
			   url: "tokenupdate/"+id,
			   data:{csrf_test_name:csrftokeng},
			   success: function(data) {
					  console.log("done");
			   }
			});
		  }
		});
	  }
  function postupdateorder_ajax(){
	  var form = $('#insert_purchase');
	  var url = form.attr('action');
	  var data = form.serialize();
	  
	  $.ajax({
			  url:url,
			  type:'POST',
			  data:data,
			  dataType: 'json',
			
			  beforeSend:function(xhr){
			  
			  $('span.error').html('');
			  },
			
			  success:function(result){
				  swal({
				  title: result.msg,
				  text: result.tokenmsg,
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
					  $.ajax({
			   type: "GET",
			   url: "postokengenerateupdate/"+result.orderid+"/1",
			   success: function(data) {
					  printRawHtml(data);
			   } 
		  });
				  } else {
				  
					  $.ajax({
						   type: "GET",
						   url: "tokenupdate/"+result.orderid,
						   success: function(data) {
								  console.log("done");
						   }
						});
				  }
			  });
			  setTimeout(function () {
				  toastr.options = {
				  closeButton: true,
				  progressBar: true,
				  showMethod: 'slideDown',
				  timeOut: 4000,
					 
		  };
		  toastr.success(result.msg, 'Success');
		  prevsltab.trigger( "click" );
  
  
	  }, 300); 
				//console.log(result)          
			  },error:function(a){
					
			  }
		  });
  }
  function payorderbill(status,orderid,totalamount){
	  $('#paidbill').attr('onclick','orderconfirmorcancel('+status+','+orderid+')');
	  $('#maintotalamount').val(totalamount);
	  $('#totalamount').val(totalamount);
	  $('#paidamount').attr("max", totalamount);
	  $('#payprint').modal('show');
	  }
  function onlinepay(){
	   $("#onlineordersubmit").submit();
	  }   
  function orderconfirmorcancel(status,orderid){
	  mystatus=status;
	  if(status==9 || status==10){
		  status=4;
		  var pval=$("#paidamount").val();
		  if(pval<1 ||pval==''){
			  alert("Please Insert Paid Amount!!!");
			  return false;
		  }
	  }
	  var carttype='';
	  var cterminal='';
	  var mybank='';
	  var mydigit='';
	  var paid='';
	  if(status==4){
		   var carttype=$("#card_typesl").val();
		   var cterminal=$("#card_terminal").val();
			var mybank=$("#bank").val();
			var mydigit=$("#last4digit").val();
			var paid=$('#paidamount').val();
  			
		   if(carttype==''){
			   alert("Please Select Payment Method!!!");
			   return false;
			   }
			  if(carttype==1){
				if(cterminal==''){
					 alert("Please Select Card Terminal!!!");
					 return false;
					}
			  }
		  }
  		var csrf = $('#csrfhashresarvation').val();
	   var dataString = 'status='+status+'&orderid='+orderid+'&paytype='+carttype+'&cterminal='+cterminal+'&mybank='+mybank+'&mydigit='+mydigit+'&paid='+paid+'&csrf_test_name='+csrf;
	   $.ajax({
			  type: "POST",
			  url: basicinfo.baseurl+"ordermanage/order/changestatus",//workingnow
			  data: dataString,
			  success: function(data){
				  $("#onprocesslist").html(data);
				  if(mystatus=="9"){
					  window.location.href=basicinfo.baseurl+"ordermanage/order/orderinvoice/"+orderid;
					  }
				 else if(mystatus=="10"){
				  $('#payprint').modal('hide');
				
				  prevsltab.trigger( "click" );
				 }
				 else if(mystatus==4){
							  swal({
								  title: lang.ord_complte,
								  text: lang.ord_com_sucs,
								  type: "success",
								  showCancelButton: false,
								  confirmButtonColor: "#28a745",
								  confirmButtonText: "Yes",
								  closeOnConfirm: true
								  },
							  function () {
								   prevsltab.trigger( "click" );
								   $('#paidamount').val('');
								  $('#payprint').modal('hide');
								  });
					 }
			  }
		  });
	  }
   function paysound(){
	   var filename=basicinfo.baseurl+basicinfo.nofitysound;
	   var audio = new Audio(filename);
	   audio.play();
	   }
  
   function load_unseen_notification(view = ''){   
   			    var csrf = $('#csrfhashresarvation').val();			
				var myAudio = document.getElementById("myAudio");
				var soundenable=possetting.soundenable;
				$.ajax({
				 url: "notification",
				 method:"POST",
				 data:{csrf_test_name:csrf,view:view},
				 dataType:"json",
				 success:function(data)
				 {
				  if(data.unseen_notification > 0)
				  {
					  $('.count').html(data.unseen_notification);
					  if(soundenable==1){
						myAudio.play();
					  }
				  }else{
					  if(soundenable==1){
						   myAudio.pause();
						  }
					   $('.count').html(data.unseen_notification);
					  }
				  
				 }
				});
   }
   var intervalc=0;
   setInterval(function(){ 
	load_unseen_notification(intervalc); 
   }, 700);
   
	function load_unseen_notificationqr(view = '')
   {
	var csrf = $('#csrfhashresarvation').val();	
	var myAudio = document.getElementById("myAudio");
	var soundenable=possetting.soundenable;
	$.ajax({
	 url: basicinfo.baseurl+"ordermanage/order/notificationqr",
	 method:"POST",
	 data:{csrf_test_name:csrf,view:view},
	 dataType:"json",
	 success:function(data)
	 {
	  if(data.unseen_notificationqr > 0)
	  {
		   $('.count2').html(data.unseen_notificationqr);
		  if(soundenable==1){
			myAudio.play();
		  }
	  }
	  else{
		  if(soundenable==1){
			  myAudio.pause();
		  }
		$('.count2').html(data.unseen_notification);
	  }
	 }
	});
   }
   setInterval(function(){ 
   $('li.active').trigger('click');
	load_unseen_notificationqr(); 
   }, 700);
  function detailspop(orderid){
	  	var csrf = $('#csrfhashresarvation').val();
		var myurl=basicinfo.baseurl+'ordermanage/order/orderdetailspop/'+orderid;
		   var dataString = "orderid="+orderid+'&csrf_test_name='+csrf;
			$.ajax({
			   type: "POST",
			   url: myurl,
			   data: dataString,
			   success: function(data) {
				   $('.orddetailspop').html(data);
				   $('#orderdetailsp').modal('show');
			   } 
		  });
	   
   }
	function pospageprint(orderid){
		var csrf = $('#csrfhashresarvation').val();
	   var datavalue = 'customer_name='+customer_name+'&csrf_test_name='+csrf;
					  $.ajax({
							  type: "POST",
							  url: basicinfo.baseurl+"ordermanage/order/posprintview/"+orderid,
							  data: datavalue,
							  success: function(printdata){											
								  $("#kotenpr").html(printdata);
								  const style = '@page { margin:0px;font-size:18px; }';
								  printJS({
									  printable: 'kotenpr',
									  onPrintDialogClose: printJobComplete,
									  type: 'html',
									  font_size: '25px',
									  style: style,
									  scanStyles: false												
									})
								  }
									  });
	   }
   function printPosinvoice(id){
	      var csrf = $('#csrfhashresarvation').val();
		  var url = 'posorderinvoice/'+id;
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				printRawHtml(data);
  
		  }
  
		  });
   }
   function pos_order_invoice(id){
	      var csrf = $('#csrfhashresarvation').val();
		  var url= 'pos_order_invoice/'+id;
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#messages').html(data);
		  }
  
		  }); 
  
   }
   function orderdetails_post(id){
	   	  var csrf = $('#csrfhashresarvation').val();
		  var url= 'orderdetails_post/'+id;
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#messages').html(data);
		  }
  
		  }); 
  
   }
	function orderdetails_onlinepost(id){
		  var url= 'orderdetails_post/'+id;
		  var csrf = $('#csrfhashresarvation').val();
		   $.ajax({
			   type: "GET",
			   url: url,
			   data:{csrf_test_name:csrf},
			   success: function(data) {
				$('#settings').html(data);
		  }
  
		  }); 
  
   }
   
   load_unseen_notification();
  
   
  function createMargeorder(orderid,value=null){
	  var csrf = $('#csrfhashresarvation').val();
	  var url = 'showpaymentmodal/'+orderid;
	  callback = function(a){
		  $("#modal-ajaxview").html(a);
		  $('#get-order-flag').val('2');
	  };
	  if(value == null){
		 
	  getAjaxModal(url);
	  }
	  else{
		  getAjaxModal(url,callback); 
	  }
	 }
/*all ongoingorder product as ajax*/
    $(document).on('click','#add_new_payment_type',function(){
		var gtotal=$("#grandtotal").val();
		var total = 0;
				$( ".pay" ).each( function(){
				  total += parseFloat( $( this ).val() ) || 0;
				});
		if(total==gtotal){
			alert("Paid amount is exceed to Total amount.");
			$("#pay-amount").text('0'); 
			return false;
			}
        var orderid = $('#get-order-id').val();
		var csrf = $('#csrfhashresarvation').val();
          var url= 'showpaymentmodal/'+orderid+'/1';
         $.ajax({
             type: "GET",
             url: url,
			 data:{csrf_test_name:csrf},
             success: function(data) {
              $('#add_new_payment').append(data);
              var length = $(".number").length;
              $(".number:eq("+(length-1)+")").val(parseFloat($("#pay-amount").text()));
			  
				
        }
        }); 
        });
    $(document).on('click','.close_div',function(){
        $(this).parent('div').remove();
        changedueamount();
    });
    /*show due invoice*/
    $(document).on('click','.due_print',function(){
         var id = $(this).children("option:selected").val();
         var url= $(this).attr("data-url");
		 var csrf = $('#csrfhashresarvation').val();
         $.ajax({
             type: "GET",
             url: url,
			 data:{csrf_test_name:csrf},
             success: function(data) {
             printRawHtml(data);
           }
        }); 
   });
	$(document).on('click','.due_mergeprint',function(){
         var id = $(this).children("option:selected").val();
         var url= $(this).attr("data-url");
		 var csrf = $('#csrfhashresarvation').val();
         $.ajax({
             type: "GET",
             url: url,
			 data:{csrf_test_name:csrf},
             success: function(data) {
             printRawHtml(data);
        	}
        }); 
    });
	 function printmergeinvoice(id){
	 var id=atob(id);
	 var csrf = $('#csrfhashresarvation').val();
        var url = basicinfo.baseurl+'ordermanage/order/checkprint/'+id;
         $.ajax({
             type: "GET",
             url: url,
			 data:{csrf_test_name:csrf},
             success: function(data) {
              printRawHtml(data);

        }

        });
 	}

    function showhidecard(element){
        var cardtype = $(element).val();
        var data = $(element).closest('div.row').next().find('div.cardarea');
      
            if(cardtype==4){
            $("#isonline").val(0);
            $(element).closest('div.row').next().find('div.cardarea').addClass("display-none");
            $("#assigncard_terminal").val('');
            $("#assignbank").val('');
            $("#assignlastdigit").val('');
            }
            else if(cardtype==1){
            $("#isonline").val(0);
            $(element).closest('div.row').next().find('div.cardarea').removeClass("display-none");
            }
            else{
                $("#isonline").val(1);
                $(element).closest('div.row').next().find('div.cardarea').addClass("display-none");
                $("#assigncard_terminal").val('');
                $("#assignbank").val('');
                $("#assignlastdigit").val('');
                }
    }

    function submitmultiplepay(){
            var thisForm = $('#paymodal-multiple-form');
             var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
        if(inputval<parseFloat(maintotalamount)){
            
            setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                    
        };
        toastr.error("Pay full amount ", 'Error');
        }, 100); 
        return false;
    }
    var formdata = new FormData(thisForm[0]);
  
        $.ajax({
        type: "POST",
        url: basicinfo.baseurl+"ordermanage/order/paymultiple",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            var value = $('#get-order-flag').val();
            if(value ==1){
                 setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                  
        };
        toastr.success("payment taken successfully", 'Success');
        $('#payprint_marge').modal('hide');
		$('#modal-ajaxview').empty();
        prevsltab.trigger( "click" );


    }, 100); }
                 else{
                    $('#payprint_marge').modal('hide');
					 $('#modal-ajaxview').empty();
                    printRawHtml(data);
                    prevsltab.trigger( "click" );
                 }
            
        },
  
    });
    }
    function changedueamount(){
        var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
       
           restamount=(parseFloat(maintotalamount))-(parseFloat(inputval));
            var changes=restamount.toFixed(3);
            if(changes <=0){
                $("#change-amount").text(Math.abs(changes));
                $("#pay-amount").text(0);
            }
            else{
                $("#change-amount").text(0);
                $("#pay-amount").text(changes);
            }
            
    }
function mergeorderlist(){
	var values = $('input[name="margeorder"]:checked').map(function() {
		  return $(this).val();
		}).get().join(',');
		var csrf = $('#csrfhashresarvation').val();
    	var dataString = 'orderid='+values+'&csrf_test_name='+csrf;
    	$.ajax({
		   url: basicinfo.baseurl+"ordermanage/order/mergemodal",
		   method:"POST",
		   data: dataString,
		   success:function(data){
			$("#payprint_marge").modal('show');
			$("#modal-ajaxview").html(data);
			$('#get-order-flag').val('2');
		   }
		  });
   }
function duemergeorder(orderid,mergeid){
	var allorderid=$("#allmerge_"+mergeid).val();
	var csrf = $('#csrfhashresarvation').val();
    var dataString = 'orderid='+orderid+'&mergeid='+mergeid+'&allorderid='+allorderid+'&csrf_test_name='+csrf;
    	$.ajax({
		   url: basicinfo.baseurl+"ordermanage/order/duemergemodal",
		   method:"POST",
		   data: dataString,
		   success:function(data){
			$("#payprint_marge").modal('show');
			$("#modal-ajaxview").html(data);
			$('#get-order-flag').val('2');
		   }
		  });
   }
function margeorderconfirmorcancel(){
 
    var thisForm = $('#paymodal-multiple-form');
    var formdata = new FormData(thisForm[0]);
  
        $.ajax({
        type: "POST",
        url: basicinfo.baseurl+"ordermanage/order/changeMargeorder",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            $('#payprint_marge').modal('hide');
			printRawHtml(data);
			prevsltab.trigger( "click" );
        },
  
    });
    }
function duemargebill(){
 
    var thisForm = $('#paymodal-multiple-form');
    var formdata = new FormData(thisForm[0]);
  
        $.ajax({
        type: "POST",
        url: basicinfo.baseurl+"ordermanage/order/changeMargedue",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            $('#payprint_marge').modal('hide');
			printRawHtml(data);
			prevsltab.trigger( "click" );
        },
  
    });
    }
function margeorder(){
        var totaldue = 0;
        $(".marg-check").each(function() {
            if ($(this).is(":checked")){
                var id = $(this).val();
               totaldue = parseFloat($('#due-'+id).text())+totaldue;
               
            }
            $('#due-amount').text(totaldue);
            $('#totalamount_marge').text(totaldue); 
            $('#paidamount_marge').val(totaldue);
            });
     }
function checktable(id=null){

        if(id !=null){
        var select = '#person-'+id;
        var valu =  $(select).val();
                $('#table_member').val(valu);
                var url= 'checktablecap/'+id;
                }
                else{
                   idd = $('#tableid').val();
                   var url= 'checktablecap/'+idd; 
                }
                var order_person = $('#table_member').val();
             
            
             if(order_person != ""){
		 var csrf = $('#csrfhashresarvation').val(); 
         $.ajax({
             type: "GET",
             url: url,
			 data:{csrf_test_name:csrf},
             success: function(data) {
                if(order_person > data ){
                    
            setTimeout(function () {
                 
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000,
                    
                    };
        toastr.warning('table capacity overflow', 'Warning');
        


    }, 300);
        }
        else{
          if(id !=null){
            $('#tableid').val(id).trigger('change');
             $('#table_member_multi').val(0);
            $('#table_member_multi_person').val(0);
            $('#table_person').val(order_person);
            $('#tablemodal').modal('hide');
            }
       
            return false;

        }
             
        }

        }); 
     }
     else{
       
          setTimeout(function () {
             $("#table_member").focus();
         
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000,
                    
                    };
        toastr.error('Please type Number of person', 'Error');
        


    }, 300);
         

     }
     }

function showTablemodal(){
    var url = "showtablemodal";
    getAjaxModal(url,false,'#table-ajaxview','#tablemodal');
	
   }
function showfloor(floorid){
		 var csrf = $('#csrfhashresarvation').val();
		 var geturl='fllorwisetable';
		  var dataString = "floorid="+floorid+'&csrf_test_name='+csrf;
		  $.ajax({
		 	 type: "POST",
			 url: geturl,
			 data: dataString,
			 success: function(data) {
				 $('#floor'+floorid).html(data);
			 } 
		});
	}
function deleterow_table(id,tableid=null)
{
    var csrf = $('#csrfhashresarvation').val();
	 var dataString = 'csrf_test_name='+csrf;
	if(tableid==null){
    var url = 'delete_table_details/'+id;
    $.ajax({
             type: "GET",
             url: url,
			 data:dataString,
             success: function(data) {
                if(data ==1){
                    $('#table-tr-'+id).remove(); 
                }
                }
        }); 
    }
    else{
           var url = 'delete_table_details_all/'+tableid;
    $.ajax({
             type: "GET",
             url: url,
			 data:dataString,
             success: function(data) {
                if(data ==1){
                    $('#table-tbody-'+tableid).empty();

                }
                }
        });
    }

    }

    function multi_table(){
       var arr =  $('input[name="add_table[]"]:checked').map(function() {
    return this.value;
            }).get();
        $('#table_member_multi').val(arr);
        var value =[];
        var order_person_t =0;
        for(i=0; i < arr.length; i++){
           value[i] = $('#person-'+arr[i]).val();
           order_person_t +=parseInt($('#person-'+arr[i]).val());
        }
       
        
         $('#table_member').val($('#person-'+arr[0]).val());
        $('#table_person').val(order_person_t);
        $('#table_member_multi_person').val(value);
        
        $('#tablemodal').modal('hide');
        $('#tableid').val(arr[0]).trigger('change');
    }
        $(document).on('change','#update_product_name', function(){
			var tid = $(this).children("option:selected").val();
			var idvid=tid.split('-');
			var id=idvid[0];
			var vid=idvid[1];
			var csrf = $('#csrfhashresarvation').val();
            var updateid=$("#saleinvoice").val();
            var url= 'addtocartupdate_uniqe'+'/'+id+'/'+updateid;
			var dataString = 'csrf_test_name='+csrf;
             /*check production*/
             /*please fixt cart total counting*/
                var productionsetting = $('#production_setting').val();
                if(productionsetting == 1){
                   
                    var checkqty = 1;
                    var checkvalue = checkproduction(id,vid,checkqty);

                        if(checkvalue == false){
                             $('#update_product_name').html('');
                            return false;
                        }
                    
                }
            /*end checking*/
            $.ajax({
             type: "GET",
             url: url,
			 data:dataString,
             success: function(data) {
            
                 
                 var myurl ="adonsproductadd"+'/'+id;
                $.ajax({
             type: "GET",
             url: myurl,
			 data:dataString,
             success: function(data) {
                      $('.addonsinfo').html(data);
                     $('#edit').modal('show');
                     var tax=$('#tvat').val();
                    var discount=$('#tdiscount').val();
                    var tgtotal=$('#tgtotal').val();
                    $('#vat').val(tax);
                    $('#calvat').text(tax);
					var sc=$('#sc').val();
					$('#service_charge').val(sc);
                    $('#invoice_discount').val(discount);
                    $('#caltotal').text(tgtotal);
                    $('#grandtotal').val(tgtotal);
                    $('#orggrandTotal').val(tgtotal);
                    $('#orginattotal').val(tgtotal);
                     $('#update_product_name').html('');

                } 
                });

               
                   
                   

             } 
        });


});
$(function($){
$("#customer_name").select2();
var barcodeScannerTimer;
var barcodeString = '';

$('#customer_name').on("select2:open", function () { 
document.getElementsByClassName('select2-search__field')[0].onkeypress = function(evt) { 
barcodeString = barcodeString + String.fromCharCode(evt.charCode);
    clearTimeout(barcodeScannerTimer);
    barcodeScannerTimer = setTimeout(function () {
        processbarcodeGui();
    }, 300);
}
});
function processbarcodeGui() {
    if (barcodeString != '') {
        var customerid = Number(barcodeString).toString();
		if(Math.floor(customerid) == customerid && $.isNumeric(customerid)){ 
		$("#customer_name").select2().val(customerid).trigger('change');
		}
		$('#customer_name').val(customerid);
    } else {
        alert('barcode is invalid: ' + barcodeString);
    }

    barcodeString = ''; 
}
});

/*for split order js*/
     function showsplitmodal(orderid,option=null){
          var url = 'showsplitorder/'+orderid;
    callback = function(a){
        $("#modal-ajaxview").html(a);
      
    };
    if(option == null){
       
       getAjaxModal(url,false,'#table-ajaxview','#tablemodal');
    }
    else{
        getAjaxModal(url,callback); 
    }
     }

    function showsuborder(element){
        var val = $(element).val();
        var url = $(element).attr('data-url')+val;
        var orderid = $(element).attr('data-value');
		var csrf = $('#csrfhashresarvation').val();
        var datavalue = 'orderid='+orderid;
        getAjaxView(url,"show-sub-order",false,datavalue,'post');

    } 

  function getAjaxView(url,ajaxclass,callback=false,data='',method='get')
    {
        var csrf = $('#csrfhashresarvation').val();
		var fulldata=data+'&csrf_test_name='+csrf;
		$.ajax({
            url:url,
            type:method,
            data:fulldata,
            beforeSend:function(xhr){
                
            },
            success:function(result){
                if(callback){
                    callback(result);
                return;
                }
                $('#'+ajaxclass).html(result);
            },
            error:function(a){
            }
        });
        return false;
    }

    function selectelement(element){

        $( ".split-item" ).each(function( index ) {
            
      $(this).removeClass('split-selected');
    });
         $(element).toggleClass('split-selected');
    }

    function addintosuborder(menuid,orderid,element){
        var presentvalue = $(element).find("td:eq(1)").text();
        var isselected = $('.split-selected').length;
        if(presentvalue != 0 && isselected == 1){
        var suborderid = $('.split-selected').attr('data-value');
        var service_chrg = $('#service-'+suborderid).val();
 		var csrf = $('#csrfhashresarvation').val();
       var datavalue = 'orderid='+orderid+'&menuid='+menuid+'&suborderid='+suborderid+'&qty='+1+'&service_chrg='+service_chrg;
       var url = $(element).attr('data-url');
       var id = 'table-tbody-'+orderid+'-'+suborderid;
        getAjaxView(url,id,false,datavalue,'post');
      
        var nowvalue = parseInt(presentvalue)-1;
        $(element).find("td:eq(1)").text(nowvalue);
    }


    }

    function paySuborder(element){
            var id = $(element).attr('id').replace('subpay-','');
            var url = $(element).attr('data-url');
		var vat = $('#vat-'+id).val();
		 if($('#vat-'+id).length){
            
            var service = $('#service-'+id).val();
            var total = $('#total-sub-'+id).val();
            var customerid = $('#customer-'+id).val();
             $('#tablemodal').modal('hide');
			 $("#modal-ajaxview").empty();
            var data = 'sub_id='+id+'&vat='+vat+'&service='+service+'&total='+total+'&customerid='+customerid;
        getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split',data,'post')
		 }
		else{
		return false;
		}
    }

    function submitmultiplepaysub(subid){
            var thisForm = $('#paymodal-multiple-form');
             var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
        if(inputval<parseFloat(maintotalamount)){
            
            setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                    
        };
        toastr.error("Pay full amount ", 'Error');
        }, 100); 
        return false;
    }
       var formdata = new FormData(thisForm[0]);
        $.ajax({
        type: "POST",
        url: basicinfo.baseurl+"ordermanage/order/paymultiplsub",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
            var value = $('#get-order-flag').val();
            
                 setTimeout(function () {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
                  
        };
        toastr.success("payment taken successfully", 'Success');
        $('#payprint_split').modal('hide');
            $('#subpay-'+subid).hide();
					 $("#modal-ajaxview-split").empty();
             printRawHtml(data);
                    prevsltab.trigger( "click" );

    }, 100); 
                 
            
        },
  
    });

    }

    function showsplit(orderid){
        var url = basicinfo.baseurl+'ordermanage/order/showsplitorderlist/'+orderid;
        getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split');
    }

    function possubpageprint(orderid){
   					var csrf = $('#csrfhashresarvation').val();
                    $.ajax({
                            type: "GET",
                            url: basicinfo.baseurl+"ordermanage/order/posprintdirectsub/"+orderid,
                            data:{csrf_test_name:csrf},
                            success: function(printdata){                                           
                                 printRawHtml(printdata);
                                }
                                    });
     }
/*end split order js*/
function itemnote(rowid,notes,qty,isupdate,isgroup=null){
		  $("#foodnote").val(notes);
		  $("#foodqty").val(qty);
		  $("#foodcartid").val(rowid);
		  $("#foodgroup").val(isgroup);
		  if(isupdate==1){
			  $("#notesmbt").text("Update Note");
			  $("#notesmbt").attr("onclick","addnotetoupdate()");
		  }
		  else{
			  $("#notesmbt").text("Update Note");
			  $("#notesmbt").attr("onclick","addnotetoitem()");
			  }
		  $('#vieworder').modal('show');
	}
	
	function addnotetoitem(){
		  var rowid=$("#foodcartid").val();
		  var note=$("#foodnote").val();
		  var foodqty=$("#foodqty").val();
		  var csrf = $('#csrfhashresarvation').val();
		  var geturl=basicinfo.baseurl+'ordermanage/order/additemnote';
		  var dataString = "foodnote="+note+'&rowid='+rowid+'&qty='+foodqty+'&csrf_test_name='+csrf;
		  $.ajax({
		 	 type: "POST",
			 url: geturl,
			 data: dataString,
			 success: function(data) {
				 setTimeout(function () {
					toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
					};
				toastr.success("Note Added Successfully", 'Success');
			   $('#addfoodlist').html(data);
			   $('#vieworder').modal('hide');
			   }, 100); 
				 
			 } 
		});
	}
	function addnotetoupdate(){
		  var rowid=$("#foodcartid").val();
		  var note=$("#foodnote").val();
		  var orderid=$("#foodqty").val();
		  var group=$("#foodgroup").val();
		  var csrf = $('#csrfhashresarvation').val();
		  var geturl=basicinfo.baseurl+'ordermanage/order/addnotetoupdate';
		  var dataString = "foodnote="+note+'&rowid='+rowid+'&orderid='+orderid+'&group='+group+'&csrf_test_name='+csrf;
		  $.ajax({
		 	 type: "POST",
			 url: geturl,
			 data: dataString,
			 success: function(data) {
				 setTimeout(function () {
					toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
					};
				toastr.success("Note Added Successfully", 'Success');
			   $('#updatefoodlist').html(data);
			   $('#vieworder').modal('hide');
			   }, 100); 
				 
			 } 
		});
	}
function opencashregister(){
	var form = $('#cashopenfrm')[0];
		var formdata = new FormData(form);
        $.ajax({
        type: "POST",
        url: basicinfo.baseurl+"ordermanage/order/addcashregister",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
			if(data==1){
			$("#openregister").modal('hide');
			}
			else{
				alert("Something Wrong!!! .Please Select Counter Number!!");
				}
        }
  
    });
	}
function closeopenresister(){
var closeurl=basicinfo.baseurl+"ordermanage/order/cashregisterclose";
var csrf = $('#csrfhashresarvation').val();
  $.ajax({
            type: "GET",
            async: false,
            url: closeurl,
			data:{csrf_test_name:csrf},
            success: function(data) {
			    $('#openclosecash').html(data);
				var htitle=$("#rpth").text();
				var counter=$("#pcounter").val();
				var puser=$("#puser").val();
				var fullheader = "Cash Register In"+htitle+"\n" + "Counter:"+counter+"\n"+puser;
				$("#openregister").modal('show');
				$('#RoleTbl').DataTable({ 
				responsive: true, 
				paging: true,
				dom: 'Bfrtip',
				"lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
				buttons: [  
					{extend: 'csv', title: 'Open-Close Cash Register', className: 'btn-sm',footer: true,header: true,orientation: 'landscape',messageTop: fullheader}, 
					{extend: 'excel', title: 'Open-Close Cash Register', className: 'btn-sm', title: 'exportTitle',messageTop: fullheader,footer: true,header: true,orientation: 'landscape'}, 
					{extend: 'pdfHtml5', title: 'Open-Close Cash Register',className: 'btn-sm',footer: true,header: true,orientation: 'landscape',messageTop: fullheader,customize: function (doc) {
    					doc.defaultStyle.alignment = 'center';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');}
					} 
				],
				"searching": true,
				  "processing": true,
				
					});
            }
        });
	   
	}
function closecashregister(){
		var form = $('#cashopenfrm')[0];
		var formdata = new FormData(form);
        $.ajax({
        type: "POST",
        url: basicinfo.baseurl+"ordermanage/order/closecashregister",
        data: formdata,
        processData: false,
        contentType: false,
        success:function(data){
			if(data==1){
			$("#openregister").modal('hide');
			window.location.href=basicinfo.baseurl+"dashboard/home";
			}else{
				alert("Something Wrong On Cash Closing!!!");
				}
        }
  
    });
	}
	
	$('.lang_box').on('click', function(event) {
		var submenu = $(this).next('.lang_options');
  		 submenu.slideToggle(400, function(){
        
    });
});
