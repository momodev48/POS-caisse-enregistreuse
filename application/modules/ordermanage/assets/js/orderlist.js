// JavaScript Document
$(document).ready(function () {
"use strict";
     $('#tallorder').DataTable({ 
        responsive: true, 
        paging: true,
		"language": {
			"sProcessing":     lang.Processingod,
			"sSearch":         lang.search,
			"sLengthMenu":     lang.sLengthMenu,
			"sInfo":           lang.sInfo,
			"sInfoEmpty":      lang.sInfoEmpty,
			"sInfoFiltered":   lang.sInfoFiltered,
			"sInfoPostFix":    "",
			"sLoadingRecords": lang.sLoadingRecords,
			"sZeroRecords":    lang.sZeroRecords,
			"sEmptyTable":     lang.sEmptyTable,
			"oPaginate": {
				"sFirst":      lang.sFirst,
				"sPrevious":   lang.sPrevious,
				"sNext":       lang.sNext,
				"sLast":       lang.sLast
			},
			"oAria": {
				"sSortAscending":  ":"+lang.sSortAscending+'"',
				"sSortDescending": ":"+lang.sSortDescending+'"'
			},
				"select": {
						"rows": {
							"_": lang._sign,
							"0": lang._0sign,
							"1": lang._1sign
						}  
		},
			buttons: {
					copy: lang.copy,
					csv: lang.csv,
					excel: lang.excel,
					pdf: lang.pdf,
					print: lang.print,
					colvis: lang.colvis
				}
		},
        dom: 'Bfrtip', 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',exportOptions: {columns: ':visible'}}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',exportOptions: {columns: ':visible'}}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',exportOptions: {columns: ':visible'}}, 
            {extend: 'print', className: 'btn-sm',exportOptions: {columns: ':visible'}},
			{extend: 'colvis', className: 'btn-sm'}  
			
        ],
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :basicinfo.baseurl+"ordermanage/order/allorderlist",
					type: "post",
					"data": function ( data ) {
						data.csrf_test_name = $('#csrfhashresarvation').val();
					}
				  },
    		});
});
"use strict";
function noteCheck(id){
	 var ordstatus=$("#status").val();
	 var myurl =basicinfo.baseurl+'ordermanage/order/ajaxupdateoreder/';
	 var dataString = "orderid="+id+"&status="+ordstatus;
	}
 function printRawHtml(view) {
      printJS({
        printable: view,
        type: 'raw-html',
        
      });
    }
function createMargeorder(orderid,value=null){
    var url = basicinfo.baseurl+'ordermanage/order/showpaymentmodal/'+orderid;
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
        $(".home").trigger( "click" );


    }, 100); }
                 else{
                    $('#payprint_marge').modal('hide');
					var ordid=$("#get-order-id").val();
                    printRawHtml(data);
                    $("#hidecombtn_"+ordid).hide();
                 }
            
        },
  
    });
    }
 function printPosinvoice(id){
	    var csrf = $('#csrfhashresarvation').val();
        var url = basicinfo.baseurl+'ordermanage/order/posorderinvoice/'+id;
         $.ajax({
             type: "GET",
             url: url,
			 data:{csrf_test_name:csrf},
             success: function(data) {
              printRawHtml(data);

        }

        });
 }
 function printmergeinvoice(id){
	 var csrf = $('#csrfhashresarvation').val();
	 var id=atob(id);
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
$(document).on('click','#add_new_payment_type',function(){
        var orderid = $('#get-order-id').val()
          var url= 'showpaymentmodal/'+orderid+'/1';
		  var csrf = $('#csrfhashresarvation').val();
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
function changedueamount(){
        var inputval = parseFloat(0);
        var maintotalamount = $('#due-amount').text();
        
        $(".number").each(function(){
           var inputdata= parseFloat($(this).val());
            inputval = inputval+inputdata;

        });
       
           restamount=(parseFloat(maintotalamount))-(parseFloat(inputval));
            var changes=restamount.toFixed(2);
            if(changes <=0){
                $("#change-amount").text(Math.abs(changes));
                $("#pay-amount").text(0);
            }
            else{
                $("#change-amount").text(0);
                $("#pay-amount").text(changes);
            }
            
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
 function showsplit(orderid){
        var url = basicinfo.baseurl+'ordermanage/order/showsplitorderlist/'+orderid;
        getAjaxModal(url,false,'#modal-ajaxview-split','#payprint_split');
    }
"use strict";
	  function showhide(id){
		   $('div.food_select').not("#item"+id).removeClass('active');
		   $('div i').not(".thisrotate"+id).removeClass("left");
		   $("#item"+id).toggleClass("active");
		   $('.thisrotate'+id+'.rotate').toggleClass("left");
		   $('#circlek'+id).css('z-index','9');
		   var csrf = $('#csrfhashresarvation').val();
		   var isVisible = $( '#item'+id ).is(".active");
			if (isVisible === true ){
				var dataString = 'orderid='+id+'&csrf_test_name='+csrf;
				$.ajax({
				type: "POST",
				url: basicinfo.baseurl+"ordermanage/order/itemlist",
				data: dataString,
				success: function(data){
					$('#item'+id).html(data);
					
					}
				});
			}
			else{
				$('#circlek'+id).css('z-index','3');
				}
			
		}
