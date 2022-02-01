"use strict";

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	document.body.style.marginTop="0px";
    window.print();
    document.body.innerHTML = originalContents;
}

function getreport(){
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();
	var kitchen_id = $('#kitchen').val();
	var view_name=$('#view_name').val();

	if(from_date==''){
		alert("Please select from date");
		return false;
		}
	
		if(to_date==''){
		alert("Please select To date");
		return false;
		}
	var myurl =baseurl+'report/reports/'+view_name;
	var csrf = $('#csrfhashresarvation').val();
	    var dataString = "from_date="+from_date+'&to_date='+to_date+'&csrf_test_name='+csrf;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('#getresult2').html(data);
			  $('#respritbl').DataTable({ 
        responsive: true, 
        paging: true,
        dom: 'Bfrtip', 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm',footer: true}, 
            {extend: 'csv', title: 'Report', className: 'btn-sm',footer: true,exportOptions: {columns: ':visible'}}, 
            {extend: 'excel', title: 'Report', className: 'btn-sm', title: 'exportTitle',footer: true,exportOptions: {columns: ':visible'}}, 
            {extend: 'pdf', title: 'Report', className: 'btn-sm',footer: true,exportOptions: {columns: ':visible'}}, 
            {extend: 'print', className: 'btn-sm',footer: true,exportOptions: {columns: ':visible'}},
			{extend: 'colvis', className: 'btn-sm',footer: true}  
        ],
		"searching": true,
		  "processing": true,
		
    		});
		 } 
	});
	}
function generatereport(){
	var from_date=$('#from_date').val();
	var to_date=$('#to_date').val();
	var csrf = $('#csrfhashresarvation').val();
	if(from_date==''){
		alert("Please select from date");
		return false;
		}
	if(to_date==''){
		alert("Please select To date");
		return false;
		}
	var myurl =baseurl+'report/reports/generaterpt';
	    var dataString = "from_date="+from_date+'&to_date='+to_date+'&csrf_test_name='+csrf;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			
		 } 
	});
	}


$(document).ready(function(){
	
		"use strict";

		getreport();

});
