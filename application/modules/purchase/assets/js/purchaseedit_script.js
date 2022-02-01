var row = $("#purchaseTable tbody tr").length;
var count = row+1;
var limits = 500;

function product_list(sl) {
    var supplier_id = $('#suplierid').val();
	 var geturl=$("#url").val();
	 var csrf_token=$("#setcsrf").val();
	var csrfname=$("#csrfname").val();
	var csrf = $('#csrfhashresarvation').val();
	
    if (supplier_id == 0 || supplier_id=='') {
        alert('Please select Supplier !');
        return false;
    }

    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
        var product_name = $('#product_name_'+sl).val();
        $.ajax( {
          url: geturl,
          method: 'post',
          dataType: "json",
          data: {
            csrf_test_name:csrf,
			product_name:product_name
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
            var sl = $(this).parent().parent().find(".sl").val(); 
            var product_id          = ui.item.value;
         	var  supplier_id=$('#supplier_id').val();
            var available_quantity    = 'available_quantity_'+sl;
            var product_rate    = 'product_rate_'+sl;
			var csrf = $('#csrfhashresarvation').val();
            $.ajax({
                type: "POST",
                url: baseurl+"purchase/purchase/purchasequantity",
                 data: {product_id:product_id,csrf_test_name:csrf},
                cache: false,
                success: function(data)
                {
                    console.log(data);
                    obj = JSON.parse(data);
                   $('#'+available_quantity).val(obj.total_product);
                    $('#'+product_rate).val(obj.supplier_price);
                  
                } 
            });

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keydown.autocomplete', '.product_name', function() {
       $(this).autocomplete(options);
   });
}

    function addmore(divName){
		var row = $("#purchaseTable tbody tr").length;
var count = row+1;
        if (count == limits)  {
            alert("You have reached the limit of adding " + count + " inputs");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="product_name_"+count;
             tabindex = count * 4 ,
             newdiv = document.createElement("tr");
            tab1 = tabindex + 1;
            
            tab2 = tabindex + 2;
            tab3 = tabindex + 3;
            tab4 = tabindex + 4;
            tab5 = tabindex + 5;
            tab6 = tab5 + 1;
            tab7 = tab6 +1;
           


  newdiv.innerHTML ='<td class="span3 supplier"><input type="text" name="product_name" required class="form-control product_name productSelection" onkeypress="product_list('+ count +');" placeholder="Item Name" id="product_name_'+ count +'" tabindex="'+tab1+'" > <input type="hidden" class="autocomplete_hidden_value product_id_'+ count +'" name="product_id[]" id="SchoolHiddenId"/>  <input type="hidden" class="sl" value="'+ count +'">  </td><td class="wt"> <input type="text" id="available_quantity_'+ count +'" class="form-control text-right stock_ctn_'+ count +'" placeholder="0.00" readonly/> </td><td class="text-right"><input type="number" step="0.0001" name="product_quantity[]" tabindex="'+tab2+'" required  id="cartoon_'+ count +'" class="form-control text-right store_cal_' + count + '" onkeyup="calculate_store(' + count + ');" onchange="calculate_store(' + count + ');" placeholder="0.00" value="" min="0"/>  </td><td class="test"><input type="number" step="0.0001" name="product_rate[]" onkeyup="calculate_store('+ count +');" onchange="calculate_store('+ count +');" id="product_rate_'+ count +'" class="form-control product_rate_'+ count +' text-right" placeholder="0.00" value="" tabindex="'+tab3+'"/></td><td class="text-right"><input class="form-control total_price text-right total_price_'+ count +'" type="text" name="total_price[]" id="total_price_'+ count +'" value="0.00" readonly="readonly" /> </td><td> <input type="hidden" id="total_discount_1" class="" /><input type="hidden" id="all_discount_1" class="total_discount" /><button  class="btn btn-danger red text-right" type="button" value="Delete" onclick="purchasetdeleteRow(this)" tabindex="8">Delete</button></td>';
            document.getElementById(divName).appendChild(newdiv);
            document.getElementById(tabin).focus();
            document.getElementById("add_invoice_item").setAttribute("tabindex", tab5);
            document.getElementById("add_purchase").setAttribute("tabindex", tab6);
           
            count++;

            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
        }
    }
    //Calculate store product
    function calculate_store(sl) {
       
        var gr_tot = 0;
        var item_ctn_qty    = $("#cartoon_"+sl).val();
        var vendor_rate = $("#product_rate_"+sl).val();

        var total_price     = item_ctn_qty * vendor_rate;
        $("#total_price_"+sl).val(total_price.toFixed(2));

       
        //Total Price
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }
    function purchasetdeleteRow(e) {
        var t = $("#purchaseTable > tbody > tr").length;
        if (1 == t) alert(lang.cantdel);
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculate_store()
    }
function bank_paymet(id){
			var csrf = $('#csrfhashresarvation').val();
		    var dataString = 'bankid='+id+'&status=1&csrf_test_name='+csrf;
		if(id==2){
			$("#showbank").show();
			$('#bankid').attr('required', true);   
        	$.ajax({
			 url: baseurl+"purchase/purchase/banklist",
			 dataType:'json',
			  type: "POST",
			  data: dataString,
			  async:true,
			  success: function(data) {
					var options = data.map(function(val, ind){
    					return $("<option></option>").val(val.bankid).html(val.bank_name);
					});
					$('#bankid').append(options);
				  }

		   });
		}
		else{
			$("#showbank").hide();
			$('#bankid').attr('required', false);  
			}
	}