"use strict";
$("input").attr("autocomplete", "off");
var baseurl=basicinfo.baseurl;
$(document).ready(function () {
	"use strict";
$(document).on('click', '.sa-clicon', function(){
 swal.close();
 });
$(document).on('click', '.onprocessg', function(){
	"use strict";
	var csrf = $('#csrfhashresarvation').val();
  var datavalue = 'onprocess=1&csrf_test_name='+csrf;
  $.ajax({
	type: "POST",
	url: basicinfo.baseurl+"ordermanage/order/onprocessajax",
	data: datavalue,
	success: function(data){
		$("#onprocesslist").html(data);
		}
	});
 });	    
var todayorderlist=$('#onprocessing').DataTable({ 
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
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
			
        ],
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :basicinfo.baseurl+"ordermanage/order/todayallorder", // json datasource
					type: "post",  // type of method  ,GET/POST/DELETE
					"data": function ( data ) {
						data.csrf_test_name = $('#csrfhashresarvation').val();
					}
				  },
		    "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 			var pageTotal = pageTotal.toFixed(2); 
 			var total = total.toFixed(2); 
            // Update footer
            $( api.column( 7 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
        }
    		});
$(document).on('click', '.todlist', function(){
  todayorderlist.ajax.reload();
  
 });
var onlineoredrlist=$('#Onlineorder').DataTable({ 
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
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :basicinfo.baseurl+"ordermanage/order/onlinellorder", // json datasource
					type: "post",  // type of method  ,GET/POST/DELETE
					"data": function ( data ) {
						data.csrf_test_name = $('#csrfhashresarvation').val();
					}
				  },
	    "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api

                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 			var pageTotal = pageTotal.toFixed(2); 
 			var total = total.toFixed(2); 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
        }
    		});


			
$(document).on('click', '.seelist', function(){
  onlineoredrlist.ajax.reload();
  
 });
var qroredrlist=$('#myqrorder').DataTable({ 
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
        "createdRow": function ( row, data, index ) {
                      
						if( data[10] == 1 ){
                                $(row).css('background-color', '#e5cc34c4');
                            }
						else{
                                $(row).css('background-color', '#ffffff');
                            }
                    },
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :basicinfo.baseurl+"qrapp/qrmodule/allqrorder", // json datasource
					type: "post",  // type of method  ,GET/POST/DELETE
					"data": function ( data ) {
						data.csrf_test_name = $('#csrfhashresarvation').val();
					}
				  },
	    "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 			var pageTotal = pageTotal.toFixed(2); 
 			var total = total.toFixed(2); 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
        }
    		});
$(document).on('click', '#todayqrorder', function(){
	
  qroredrlist.ajax.reload();
 
 
 });
$(document).on('click', '#cancelreason', function(){ 
				$("#cancelord").modal('hide');
				var ordid=$("#mycanorder").val();
				var reason=$("#canreason").val();
				var csrf = $('#csrfhashresarvation').val();
				var dataString = 'status=1&onprocesstab=1&acceptreject=0&reason='+reason+'&orderid='+ordid+'&csrf_test_name='+csrf;
				$.ajax({
						type: "POST",
						url: basicinfo.baseurl+"ordermanage/order/acceptnotify",
						data: dataString,
						success: function(data){
							$("#onprocesslist").html(data);
							
							conlose.log(prevsltab);
							swal("Rejected", "Your Order is Cancel", "success");
							prevsltab.trigger('click');
							load_unseen_notification();
							
							 
						}
					});
			});

$(document).on('click', '.aceptorcancel', function(){ 
        		var ordid= $(this).attr("data-id");
				var csrf = $('#csrfhashresarvation').val();
                var dataovalue = 'orderid='+ordid+'&csrf_test_name='+csrf;
                 var productionsetting = $('#production_setting').val();
                  var message = "Are You Accept Or Reject this Order??";
                if(productionsetting == 1){
                    var check =true;

                   $.ajax({
                            type: "POST",
                            url: basicinfo.baseurl+"ordermanage/order/checkstock",
                            data: dataovalue,
                            async: false,
                            global: false,
                             success: function(data){
                                 if(data !=1){
                                    message=data;
                                    return false;
                                    }
                            }
                        });
                 
                   
                }
                if(message !='Are You Accept Or Reject this Order??'){
                   $("#cancelord").modal('show');
                $("#canordid").html(ordid);
                $("#mycanorder").val(ordid);
                $("#canreason").val(message);
                   return false; 
                }
        swal({
      title: "Order Confirmation",
      text: message,
      type: "success",      
      showCancelButton: true,      
      confirmButtonColor: "#28a745",
      confirmButtonText: "Accept",
      cancelButtonText: "Reject",
      closeOnConfirm: false,
      closeOnCancel: true,
      showCloseButton: true,
    },
       function (isConfirm) {
      if (isConfirm) {
        var dataString = 'status=1&acceptreject=1&reason=&orderid='+ordid+'&csrf_test_name='+csrf;
           $.ajax({
              type: "POST",
              url: basicinfo.baseurl+"ordermanage/order/acceptnotify",
              data: dataString,
              success: function(data){
                swal("Accepted", "Your Order is Accepted", "success");
                prevsltab.trigger('click');

                 load_unseen_notification();

              }
            });
      } else {
        $("#cancelord").modal('show');
        $("#canordid").html(ordid);
        $("#mycanorder").val(ordid);
            
      }
    });
      });
			
$(document).on('click', '.cancelorder', function(){ 
				var ordid= $(this).attr("data-id");
				$("#cancelord").modal('show');
				$("#canordid").html(ordid);
				$("#mycanorder").val(ordid);
			});  
var allsalesreport=$('#myslreportsf').DataTable({ 
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
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :basicinfo.baseurl+"report/reports/allsellrpt", // json datasource
					type: "post",
					"data": function ( data ) {
						data.ctypeoption = $('#ctypeoption').val();
						data.status = $('#status').val();
						data.date_fr = $('#from_date').val();
						data.date_to = $('#to_date').val();
						data.csrf_test_name = $('#csrfhashresarvation').val();
					},
					dataSrc: function ( data ) {
           				var TotalCardPayment = data.cardpayments;
						 var OnlinePayment = data.Onlinepayment;
						 var CashPayment = data.Cashpayment;
           				return data.data;
        			 } 
				  },
		drawCallback: function( settings ) {
        var api = this.api();
		var alldata=this.api().ajax.json();
        $( api.column(0).footer() ).html(
          'Total Card Payments: '+alldata.cardpayments+'<br/>  Total Online Payments: '+alldata.Onlinepayment+'<br/>  Total Cash Payments: '+alldata.Cashpayment
            );			
        },
	    "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
			//discount
			 totaldiscount = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            discountTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			var discountTotal = discountTotal.toFixed(2); 
 			var totaldiscount = totaldiscount.toFixed(2); 
			//thirdparty
			totalcommision = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            commisionTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			var commisionTotal = commisionTotal.toFixed(2); 
 			var totalcommision = totalcommision.toFixed(2);
			//Total Amount	
            total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 			var pageTotal = pageTotal.toFixed(2); 
 			var total = total.toFixed(2); 
            // Update footer
			$( api.column( 5 ).footer() ).html(
                discountTotal +' ( '+ totaldiscount +' total)'
            );
			$( api.column( 6 ).footer() ).html(
                commisionTotal +' ( '+ totalcommision +' total)'
            );
            $( api.column( 7 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
        }
    		});
			
$('#mysreport').click(function(){ 
				allsalesreport.ajax.reload();  
			});

var allsalesreportgt=$('#myslreportsf2').DataTable({ 
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
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
				 "serverSide": true,
				 "ajax":{
					url :basicinfo.baseurl+"report/reports/allsellgtrpt", // json datasource
					type: "post",
					"data": function ( data ) {
						data.ctypeoption = $('#ctypeoption').val();
						data.status = $('#status').val();
						data.date_fr = $('#from_date').val();
						data.date_to = $('#to_date').val();
						data.csrf_test_name = $('#csrfhashresarvation').val();
					},
					dataSrc: function ( data ) {
           				var TotalCardPayment = data.cardpayments;
						 var OnlinePayment = data.Onlinepayment;
						 var CashPayment = data.Cashpayment;
           				return data.data;
        			 } 
				  },
		drawCallback: function( settings ) {
        var api = this.api();
 		var alldata=this.api().ajax.json();
        $( api.column(0).footer() ).html(
          'Total Card Payments: '+alldata.cardpayments+'<br/>  Total Online Payments: '+alldata.Onlinepayment+'<br/>  Total Cash Payments: '+alldata.Cashpayment
            );
        },
	    "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
			//discount
			 totaldiscount = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            discountTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			var discountTotal = discountTotal.toFixed(2); 
 			var totaldiscount = totaldiscount.toFixed(2); 
			//thirdparty
			totalcommision = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            commisionTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			var commisionTotal = commisionTotal.toFixed(2); 
 			var totalcommision = totalcommision.toFixed(2);
			//Total Amount	
            total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 			var pageTotal = pageTotal.toFixed(2); 
 			var total = total.toFixed(2); 
            // Update footer
			$( api.column( 5 ).footer() ).html(
                discountTotal +' ( '+ totaldiscount +' total)'
            );
			$( api.column( 6 ).footer() ).html(
                commisionTotal +' ( '+ totalcommision +' total)'
            );
            $( api.column( 7 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
        }
    		});
$('#mysreport2').click(function(){ 
				allsalesreportgt.ajax.reload();  
			});
	});


	 $('.social-icon').iconpicker();
  function load_unseen_reservation(view = ''){
	  var csrf = $('#csrfhashresarvation').val();
  $.ajax({
   url: basicinfo.baseurl+"reservation/reservation/notification",
   method:"POST",
   data:{csrf_test_name:csrf,view:view},
   dataType:"json",
   success:function(data)
   {
    if(data.unseen_reservation > 0){
     $('.reservenotif').html(data.unseen_reservation);
    }
   }
  });
 }
	  load_unseen_reservation();
	 setInterval(function(){ 
	  load_unseen_reservation(); 
	 }, 1000);

                        $('#fullscreen').on('click', function () {
                            $('.pe-7s-expand1').toggleClass('fullscreen-active');
                        });
                        //Fullscreen API
                        $(function () {
                            var requestFullscreen = function (ele) {
                                if (ele.requestFullscreen) {
                                    ele.requestFullscreen();
                                } else if (ele.webkitRequestFullscreen) {
                                    ele.webkitRequestFullscreen();
                                } else if (ele.mozRequestFullScreen) {
                                    ele.mozRequestFullScreen();
                                } else if (ele.msRequestFullscreen) {
                                    ele.msRequestFullscreen();
                                } else {
                                    console.log("Fullscreen API is not supported.");
                                }
                            };
                            var exitFullscreen = function () {
                                if (document.exitFullscreen) {
                                    document.exitFullscreen();
                                } else if (document.webkitExitFullscreen) {
                                    document.webkitExitFullscreen();
                                } else if (document.mozCancelFullScreen) {
                                    document.mozCancelFullScreen();
                                } else if (document.msExitFullscreen) {
                                    document.msExitFullscreen();
                                } else {
                                    console.log("Fullscreen API is not supported.");
                                }
                            };

                            var fsDocButton = document.getElementById("fullscreen");
                            var fsExitDocButton = document.getElementById("fullscreen");

                            fsDocButton.addEventListener("click", function (e) {
                                e.preventDefault();
                                requestFullscreen(document.documentElement);
                            });

                            fsExitDocButton.addEventListener("click", function (e) {
                                e.preventDefault();
                                exitFullscreen();
                            });
                        });
		$(function() {

        var $container = $('.grid');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.grid-col',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        });

        //Reinitialize masonry inside each panel after the relative tab link is clicked - 
        $('a[data-toggle=tab]').each(function() {
            var $this = $(this);

            $this.on('shown.bs.tab', function() {

                $container.imagesLoaded(function() {
                    $container.masonry({
                        itemSelector: '.grid-col',
                        columnWidth: '.grid-sizer',
                        percentPosition: true
                    });
                });

            }); //end shown
        }); //end each

    });

    $(function() {
        $(".selectall").click(function() {
            $(this).parent().parent().siblings().find(".individual").prop("checked", $(this).prop("checked"));
        });
    });
		$('#respritbl').DataTable({ 
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
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'Report', className: 'btn-sm',footer: true}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm', title: 'exportTitle',footer: true}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm',footer: true}, 
            {extend: 'print', className: 'btn-sm',footer: true},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true
    		});
    $(function() {
var segment4=$("#segment4").val();
          var languagelist=$('#langtab').DataTable({ 
        responsive: false, 
        paging: true,
         dom: 'Bfrtip', 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  ],
		"searching": true,
		  "processing": true,
            "serverSide": true,
				 "ajax":{
					url :basicinfo.baseurl+"setting/language/searchlang/"+segment4, // json datasource
					type: "post",
					"data": function ( data ) {
					data.csrf_test_name = $('#csrfhashresarvation').val();
					}
					
				  },
				  "oSearch": {
            "bSmart": false, 
            "bRegex": true,
            "sSearch": ""                
        }
    		}); 
		});
			
	$( "#item_list" ).autocomplete({ 
        source: function( request, response ) {
		var csrf = $('#csrfhashresarvation').val();
        $.ajax({
        type: "POST",
          url: basicinfo.baseurl+"itemmanage/item_food/checkfood",
          dataType: "json",
          data: {q:request.term,csrf_test_name: csrf},
          success: function( data ) {
            response( data );
          }
        });
      },
        minLength:1,
            select: function (event, ui){
                $("#item_list").val('');
				var foodname=ui.item.ProductName;
				var foodid=ui.item.value;
				var varient=ui.item.varientid
				var varientname=ui.item.variantName
				var price=ui.item.price
				var myitemv=foodid+varient;
				var getpid=$("#allid").val();
				var isexists=0;
				if(getpid!=''){
				var pidarray = getpid.split(",");
				var joinpid=getpid+','+myitemv;
				if(jQuery.inArray(myitemv, pidarray) >= 0){
					isexists=1;
					alert("This Item Already Added");
					}
				var setpid=$("#allid").val(joinpid);
				}else{
					var pidarray = getpid.split(",");
					var joinpid=myitemv;
					var setpid=$("#allid").val(joinpid);
					}
				
				
				if(isexists==0){
				var trid1 = $('#mytble tr:last').attr('id');
				var trid=trid1.replace("test", "");
				var mytrid = (parseInt(trid)) + (parseInt(1));
				var new_html_img1='<tr id="test'+mytrid+'"><td><input name="itemidvid" class="itemidvid" type="hidden" value="'+varient+foodid+'"><input name="itemid[]" id="itemid" type="hidden" value="'+foodid+'">'+foodname+'</td><td><input name="varientid[]" id="varientid" type="hidden" value="'+varient+'">'+varientname+'</td><td><input name="myprice" class="myprice" type="hidden" id="pr'+varient+foodid+'" value="'+price+'">'+price+'</td><td style="width:100px;"><button onclick="decrese('+mytrid+','+price+','+varient+foodid+')" class="reduced items-count" type="button"><i class="fa fa-minus"></i></button><input type="text" style="width:25px;" name="qty[]" id="sst'+mytrid+'" maxlength="12" value="1" class="input-text qty" readonly="readonly"><button onclick="increse('+mytrid+','+price+','+varient+foodid+')" class="increase items-count" type="button"><i class="fa fa-plus"></i></button></td><td><a onClick="rem_values('+mytrid+')" style="cursor:pointer;">Remove</a></td></tr>';
				$("#mygroupitem").append(new_html_img1);
				var allprice = 0;
				$(".myprice").each(function() {
				   allprice=parseFloat(allprice)+parseFloat($(this).val());
				});
				$("#price").val(allprice);
				}
				 this.value = "";
          		return false;
             }    
    });
	function rem_values(mid){
		$('#test'+mid).remove();
		var current = 1;
		$("#mygroupitem tr").each(function() {
			var newcr="test"+current;
		   $(this).attr('id', newcr);
		   current++;
		});
		var m=1;
		$("#mygroupitem tr td a").each(function() {
		   $(this).attr("onClick", "rem_values("+m+")");
		   m++;
		});
		var allVals = [];
		$(".itemidvid").each(function() {
		   allVals.push($(this).val());
		});
		$("#allid").val(allVals);
		var allprice = 0;
				$(".myprice").each(function() {
				   allprice=parseFloat(allprice)+parseFloat($(this).val());
				});
				$("#price").val(allprice);
		}
	function increse(mid,price,pvid){
			var sst = $("#sst"+mid).val(); 
			var newst=parseInt(sst)+1;
			var newprice=parseFloat(newst)*parseFloat(price);
			$("#pr"+pvid).val(newprice);
			$("#sst"+mid).val(newst);
			var allprice = 0;
				$(".myprice").each(function() {
				   allprice=parseFloat(allprice)+parseFloat($(this).val());
				});
				$("#price").val(allprice);
			
        }
	function decrese(mid,price,pvid){
			var sst = $("#sst"+mid).val();
			if(sst<=0){
				$("#pr"+pvid).val(price)
				$("#sst"+mid).val(1);
				}
			else{
				var newst=parseInt(sst)-1;
				var newprice=parseFloat(newst)*parseFloat(price);
				$("#pr"+pvid).val(newprice);
				$("#sst"+mid).val(newst);
				}
			var allprice = 0;
				$(".myprice").each(function() {
				   allprice=parseFloat(allprice)+parseFloat($(this).val());
				});
				$("#price").val(allprice);
        }
		function addlang(element){
       var csrf = $('#csrfhashresarvation').val();
	   var dataString = 'csrf_test_name='+csrf;
        var url = $(element).attr('data-url');
              $.ajax({
             type: "GET",
             url: url,
			 data:dataString,
             success: function(data) {
                 location.reload();
             } 
        });
      
    }
