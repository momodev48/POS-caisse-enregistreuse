 "use strict"; 
function editunit(unitid){
	   var myurl =baseurl+'units/unitmeasurement/updateunitfrm/'+unitid;
	   var csrf = $('#csrfhashresarvation').val();
	    var dataString = "unitid="+unitid+"&csrf_test_name="+csrf;
	
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editunit').html(data);
			 $('#edit').modal('show');
		 } 
	});
	}
function editingredient(inid){
	var csrf = $('#csrfhashresarvation').val();
	   var myurl =baseurl+'units/ingradient/updateintfrm/'+inid;
	    var dataString = "unitid="+inid+"&csrf_test_name="+csrf;
	 
		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editunit').html(data);
			 $('#edit').modal('show');
		 } 
	});
	}		