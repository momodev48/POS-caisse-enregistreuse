 "use strict"; 
function editreserveinfo(id){
	    var geturl=$("#url_"+id).val();
	    var myurl =geturl+'/'+id;
	    var sdate=$("#sldate").val();
	    var sltime=$("#sltime").val();
	    var people=$("#people").val();
		var csrf = $('#csrfhashresarvation').val();
	    var dataString = "id="+id+"&sdate="+sdate+"&sltime="+sltime+"&people="+people+"&csrf_test_name="+csrf;

		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editinfo').html(data);
			 
			  
			   $('.timepicker').timepicker({
				timeFormat: 'HH:mm:ss',
				stepMinute: 5,
				stepSecond: 15
			});
			 $('#edit').modal('show');
			
			  $(".datepicker4").datepicker({
        		dateFormat: "dd-mm-yy"
    		}); 
			
		 } 
	});
	}
function edituninfo(id){
	   var geturl=$("#url_"+id).val();
	   var myurl =geturl+'/'+id;
	   var csrf = $('#csrfhashresarvation').val();
	    var dataString = "id="+id+"&csrf_test_name="+csrf;

		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editinfo').html(data);
			  
			 $('#edit').modal('show');
		 } 
	});
	}
function checkavail(){
		var getdate=$("#date").val();
		var time=$("#time").val();
		var people=$("#people").val();
		var geturl=$("#checkurl").val();
		var csrf = $('#csrfhashresarvation').val();
		if(getdate==''){
			alert("Please select date!!!");
			return false;
			}
		if(time==''){
			alert("Please select Time!!!");
			return false;
			}
		if(people=='' || people==0){
			alert("Please enter number of people!!!");
			return false;
			}
		 var dataString = "getdate="+getdate+'&time='+time+'&people='+people+"&csrf_test_name="+csrf;
			 $.ajax({
			 type: "POST",
			 url: geturl,
			 data: dataString,
			 success: function(data) {
				 $('#availabletable').html(data);
			 } 
			});
	}