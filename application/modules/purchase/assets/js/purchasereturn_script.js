function getinvoice(){
	 var geturl=$("#invoiceurl").val();
	 var suplierid=$("#supplier_id").val();
	 var csrf = $('#csrfhashresarvation').val();
	    var dataString = "id="+suplierid+'&status=1&csrf_test_name='+csrf;

		 $.ajax({
		 type: "POST",
		 url: geturl,
		 data: dataString,
		 success: function(data) {
	
			 $('#invoicelist').html(data);
			 $('select#invoice').select2({});
		 } 
	});
	
	}
	
function showinvoice(){
	 var geturl=$("#serachurl").val();
	 var invoice=$("#invoice").val();
	 var csrf = $('#csrfhashresarvation').val();
	 var myurl= geturl+"/"+invoice;
	    var dataString = "invoice="+invoice+'&status=1&csrf_test_name='+csrf;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('#itemlist').html(data);
			  $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    }); 
		 } 
	});
	
	}
function calculate_store(sl) {
       
        var gr_tot = 0;
        var item_ctn_qty    = $("#quantity_"+sl).val();
        var vendor_rate = $("#product_rate_"+sl).val();
        var discount    = $("#discount_"+sl).val();
        var total_price     = (item_ctn_qty * vendor_rate)-discount;
        $("#total_price_"+sl).val(total_price.toFixed(2));

       
        //Total Price
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }
 function checkboxcheck(sl){
        var check_id    ='check_id_'+sl;
        var total_qntt  ='quantity_'+sl;
        var product_rate ='product_rate_'+sl;
        var store_id ='store_id_'+sl;
        var product_id ='product_id_'+sl;
       var grandTotal ='grandTotal';
        if($('#'+check_id).prop("checked") == true){
            document.getElementById(total_qntt).setAttribute("required","required");
            document.getElementById(total_qntt).setAttribute("name","total_qntt[]");
            document.getElementById(product_rate).setAttribute("name","product_rate[]");
            document.getElementById(product_id).setAttribute("name","product_id[]");
            document.getElementById(grandTotal).setAttribute("name","grand_total_price");
        }
        else if($('#'+check_id).prop("checked") == false){
            document.getElementById(total_qntt).removeAttribute("required");
            document.getElementById(total_qntt).removeAttribute("name");
            document.getElementById(product_id).removeAttribute("name");
            document.getElementById(product_rate).removeAttribute("name");
             document.getElementById(grandTotal).removeAttribute("name");
        }
    };
 function checkrequird(sl) {
   var  quantity=$('#total_qntt_'+sl).val();
   var check_id    ='check_id_'+sl;
    if (quantity == null || quantity == 0 || quantity == ''){
    document.getElementById(check_id).removeAttribute("required");
    }else{
       
         document.getElementById(check_id).setAttribute("required","required");
    }
}
 function checkqty(sl)
{
   var order_qty = $('#orderqty_'+sl).val();
  var quant=$('#quantity_'+sl).val();
  var vendor_rate =$("#product_rate_"+sl).val();
  var discount    = $("#discount_"+sl).val();
  var total_price     = (quant * vendor_rate)-discount;
  var diductprice= total_price.toFixed(2);  
  var grtotal=$("#grandTotal").val();
  
  if (isNaN(quant)) 
  {
    alert("Must input numbers");
    document.getElementById("quantity_"+sl).value = '';
    document.getElementById("total_price_"+sl).value = '';
    return false;
  }
  if (parseFloat(quant) <= 0) 
  {
    alert("You Can Not Return Less than 0");
      document.getElementById("quantity_"+sl).value = '';
        document.getElementById("total_price_"+sl).value = '';
    return false;
  }
  if (parseFloat(quant) > parseFloat(order_qty)) 
  {
	   var diductprice= total_price.toFixed(2);  
       var grtotal=$("#grandTotal").val();
	   if(grtotal>0){
	   var restprice=parseFloat(grtotal)-parseFloat(diductprice);
	   $("#grandTotal").val(restprice.toFixed(2));
	   }
     
	 setTimeout(function(){
	   alert("You Can Not return More than Order quantity");
	   document.getElementById("quantity_"+sl).value = '';
	   document.getElementById("total_price_"+sl).value = '';
      }, 500);
    return false;
  }
  
}