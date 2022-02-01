"use strict";
  function load_code(id,sl){
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url : basicinfo.baseurl+'accounts/accounts/supplier_headcode/' + id,
        type: "GET",
        dataType: "json",
		data:{csrf_test_name:csrf},
        success: function(data)
        {
          
           $('#txtCode_'+sl).val(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(lang.errorajdata);
        }
    });
}
    function addaccount(divName){
    var supplier = $('#cntra').html();
    var row = $("#debtAccVoucher tbody tr").length;
    var count = row + 1;
    var limits = 500;
    var tabin = 0;
    if (count == limits) alert("'"+lang.total+"'" + count + "'"+lang.inpt+"'");
    else {
          var newdiv = document.createElement('tr');
          var tabin="cmbCode_"+count;
          var tabindex = count * 2;
          newdiv = document.createElement("tr");
           
          newdiv.innerHTML ="<td> <select name='supplier_id[]' id='supplier_id_"+ count +"' class='form-control' onchange='load_code(this.value,"+ count +")' required><option value=''>'"+lang.slsuplier+"'</option>"+supplier+"</select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='number' name='txtAmount[]' class='form-control total_price text-right' id='txtAmount_"+ count +"' onkeyup='calculation("+ count +")' required></td><td><button class='btn btn-danger red text-right' type='button' value='"+lang.delete+"' onclick='supplierdeleteRow(this)'><i class='fa fa-trash-o'></i></button></td>";
          document.getElementById(divName).appendChild(newdiv);
          document.getElementById(tabin).focus();
          count++;
           
          $("select.form-control:not(.dont-select-me)").select2({
              placeholder: "Select option",
              allowClear: true
          });
        }
    }

function calculation(sl) {
       
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

        $("#grandTotal").val(gr_tot.toFixed(2,2));
    }

    function supplierdeleteRow(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert(lang.cantdel);
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculation()
    }
function bank_paymet(id){
	var csrf = $('#csrfhashresarvation').val();
		    var dataString = 'bankid='+id+'&csrf_test_name='+csrf;
		if(id==2){
			$("#showbank").show();
			$('#bankid').attr('required', true);   
        	$.ajax({
			 url: baseurl+"accounts/accounts/banklist",
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

    
     $(function(){
     	"use strict";
        $(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });
       
    });