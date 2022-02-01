     "use strict";
  function load_code(id,sl){
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url : basicinfo.baseurl+'accounts/accounts/debtvouchercode/' + id,
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
    var cntra = $('#cntra').html();
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
           
          newdiv.innerHTML ="<td> <select name='cmbCode[]' id='cmbCode_"+ count +"' class='form-control' onchange='load_code(this.value,"+ count +")'>"+ cntra +"</select></td><td><input type='text' name='txtCode[]' class='form-control'  id='txtCode_"+ count +"' ></td><td><input type='text' name='txtAmount[]' class='form-control total_price' value='0' id='txtAmount_"+ count +"' onkeyup='calculation("+ count +")'></td><td><input type='text' name='txtAmountcr[]' class='form-control total_price1' id='txtAmount1_"+ count +"' value='0' onkeyup='calculation("+ count +")'></td><td><button class='text-right btn btn-danger red' type='button' value='"+lang.delete+"' onclick='contradeleteRow(this)'><i class='fa fa-trash-o'></i></button></td>";
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
        var gr_tot1=0;
        var gr_tot = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot += parseFloat(this.value))
        });

 $(".total_price1").each(function() {
            isNaN(this.value) || 0 == this.value.length || (gr_tot1 += parseFloat(this.value))
        });
        $("#grandTotal").val(gr_tot.toFixed(2,2));
         $("#grandTotal1").val(gr_tot1.toFixed(2,2));
    }

    function contradeleteRow(e) {
        var t = $("#debtAccVoucher > tbody > tr").length;
        if (1 == t) alert(lang.cantdel);
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculation()
    }


    
     $(function(){
     	"use strict";
        $(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });
       
    });