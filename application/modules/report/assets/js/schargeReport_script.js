"use strict";
var today = $("#today").val();

	$(document).ready(function(){
		
		"use strict";
		var csrf = $('#csrfhashresarvation').val();
		var myurl =baseurl+'report/reports/schargeReport';
	    var dataString = 'from_date='+today&'to_date='+today+"&csrf_test_name="+csrf+'&orderid=';
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('#getresult2').html(data);
		 }
	});
});