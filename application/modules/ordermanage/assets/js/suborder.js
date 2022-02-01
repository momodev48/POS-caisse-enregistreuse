// JavaScript Document
$(document).ready(function () {
	"use strict";
	// select 2 dropdown 
	$("select.form-control:not(.dont-select-me)").select2({
	placeholder: "Select option",
	allowClear: true
	});
});
"use strict";
function changetype(){
	var distypech=$("#discountttch").val();
	if(distypech==0){
		var thistype=basicinfo.curr_icon;
	}
	else{
		var thistype="%";
		}
	$("#chty").text(thistype);
	$("#discounttype").val(distypech);
	$("#discount").val('');
	$( "#discount" ).trigger("change");
	}
$(document).on('change','#discount', function(){
            var discount = $("#discount").val();
			var distype=$("#discounttype").val();
			var total=$("#ordertotal").val();
			var due=$("#orderdue").val();
			if(discount=='' || discount==0){
				 $("#tamount").text(total);
				 $("#due-amount").text(due);
				 $("#grandtotal").val(total);
				 $("#granddiscount").val(0);
				}
			 else{
				  if(distype==1){
					 var totaldis=discount*total/100;
				  }else{
					  var totaldis=discount;
					  }
					 var afterdiscount=parseFloat(total-totaldis);
					 var newtotal=afterdiscount.toFixed(2);
					 var granddiscount=parseFloat(totaldis);
				 $("#tamount").text(newtotal);
				 $("#paidamount_marge").val(newtotal);
				 $("#grandtotal").val(newtotal);
				 $("#due-amount").text(newtotal);
				 $("#granddiscount").val(granddiscount.toFixed(2));				 
				 }
		$("#adddiscount").hide();
		$("#add_new_payment").empty();
            
});
$(document).on('click','#paymentnow',function(){
         $("#adddiscount").show();
        });
$('input[type="checkbox"]').click(function(){
			if($(this).is(":checked")){
				var test =$('input[name="redeemit"]:checked').val();
				$("#isredeempoint").val(test);
				}
			else{
				$("#isredeempoint").val('');
				}		
		});