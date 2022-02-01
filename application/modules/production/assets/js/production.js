//all js 
"use strict";
function product_list(sl) {
    var foodid = $('#foodid').val();
	 var geturl=$("#url").val();

    if (foodid == 0 || foodid=='') {
        alert('Please select Desiger Food !');
        return false;
    }

    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
        var product_name = $('#product_name_'+sl).val();
		var csrf = $('#csrfhashresarvation').val();
        $.ajax( {
          url: geturl,
          method: 'post',
          dataType: "json",
          data: {
			product_name:product_name,csrf_test_name: csrf
          },
          success: function( data ) {
            response( data );

		
          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);

           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
            
           
            $('#unit-total_'+sl).val(ui.item.uprice);
            var product_id          = ui.item.value;
         	var  foodid=$('#foodid').val();
            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keydown.autocomplete', '.product_name', function() {
       $(this).autocomplete(options);
   });
}
var count = 2;
var limits = 500;
function addmore(divName){
        if (count == limits)  {
            alert("You have reached the limit of adding " + count + " inputs");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="product_name_"+count;
             var tabindex = count * 4;
            var newdiv = document.createElement("tr");
            var tab1 = tabindex + 1;
            var tab2 = tabindex + 2;
			var tab3 = tabindex + 3;
            var tab4 = tabindex + 4;
  newdiv.innerHTML ='<td class="span3 supplier"><input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_list('+ count +');" placeholder="Item Name" id="product_name_'+ count +'" tabindex="'+tab1+'" > <input type="hidden" class="autocomplete_hidden_value product_id_'+ count +'" name="product_id[]" id="SchoolHiddenId"/><td class="text-right"><input type="text" name="product_quantity[]" tabindex="'+tab2+'" required  id="cartoon_'+ count +'" class="form-control text-right store_cal_' + count + '" onkeyup="calprice(this)"  placeholder="0.00" value="" min="0"/>  </td><td class="text-right"><input type="text" tabindex="'+tab2+'" id="price_'+ count +'" class="form-control text-right store_cal_' + count + '"  placeholder="0.00" value="" min="0" readonly/>  </td><td> <input type="hidden" id="total_discount_1" class="" /> <input type="hidden" id="unit-total_'+count+'" class="" /><input type="hidden" id="all_discount_1" class="total_discount" /><button class="btn btn-danger red text-right" class="btn btn-danger red" type="button" value="Delete" onclick="deleteRow(this)" tabindex="8">Delete</button></td>';
            document.getElementById(divName).appendChild(newdiv);
            document.getElementById(tabin).focus();
            document.getElementById("add_invoice_item").setAttribute("tabindex", tab3);
            document.getElementById("add_purchase").setAttribute("tabindex", tab4);
           
            count++;

            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
        }
    }
function calprice(element){
      var id = element.id.replace('cartoon_', '');
      var ingrden = $('#product_name_'+id).val();
       if (ingrden == 0 || ingrden=='') {
        $(element).val('');
        alert('Please select Item!');

        return false;
    }
    else{
      var toatalval = $('#unit-total_'+id).val();
      var qty = $(element).val();
        $('#price_'+id).val(parseFloat(toatalval).toFixed(2)*parseFloat(qty).toFixed(2));

    }

    }
function checkavailablity(){
		var foodid=$("#foodid").val();
		var foodvarientid=$("#foodvarientid").val();
		var servingqty=$("#pro_qty").val();
		var csrf = $('#csrfhashresarvation').val();
		if(servingqty=='' || servingqty==0){
		$('#add_production').prop("disabled", true);
		return false;	
		}
		
		if(foodid==''){
			alert("Select Food Item!!");
			$("#pro_qty").val('');
			return false;
			}
		var myurl =basicinfo.baseurl+'production/production/ingredientcheck';
	    var dataString = "foodid="+foodid+'&qty='+servingqty+'&vid='+foodvarientid+'&csrf_test_name='+csrf;

		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
           
			if(data==1){
                $('#add_production').prop("disabled", false);
				
				}
			else{
				$('#add_production').prop("disabled", true);
                alert(data);
                $("#pro_qty").val('');
				}
		 } 
	});
		}
$(document).ready(function() {
"use strict";
$('#add_production').prop("disabled", true);
});
$(document).on('change','#foodid',function(){
         "use strict";
          var id = $(this).children("option:selected").val();
		  var csrf = $('#csrfhashresarvation').val();
		  var datastring="csrf_test_name="+csrf
          var url= 'getfoodfarient'+'/'+id;
         $.ajax({
             type: "GET",
             url: url,
			 data:datastring,
             success: function(data) {
              $('#foodvarientid').html(data);
        	}
        }); 
     });

"use strict";
$('input[type="checkbox"]').click(function(){
	var csrf = $('#csrfhashresarvation').val();
            if($(this).is(":checked")){
               var menuid=$(this).val();
			   var ischeck=1;
			   var dataString = 'menuid='+menuid+'&status=1&csrf_test_name='+csrf;
            }
            else if($(this).is(":not(:checked)")){
                var menuid=$(this).val();
				var ischeck=0;
				var dataString = 'menuid='+menuid+'&status=0&csrf_test_name='+csrf;
            }
                $.ajax({
				type: "POST",
				url: basicinfo.baseurl+"ordermanage/order/settingenable",
				data: dataString,
				success: function(data){
					if(ischeck==1){
						swal("Enable", "Enable This Option to show on Production auto complete", "success");
						}
						else{
						swal("Disable", "Make This Field Is Optional On Production auto complete.", "warning");
						}
				    }
			    });
        });
