//all js 
$(document).ready(function(){
	  "use strict";
        $('#isoffer').click(function(){
            if($(this).prop("checked") == true){
               $("#offeractive").show();
            }
            else if($(this).prop("checked") == false){
                $("#offeractive").hide();
            }
        });
    });

"use strict";
function adonseditinfo(id){
	   var myurl =baseurl+'itemmanage/menu_addons/assignaddonsupdateinfo/'+id;
	   var csrf = $('#csrfhashresarvation').val();
	    var dataString = "unitid="+id+"&csrf_test_name="+csrf;
	 
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

function editvarient(id){
	   var myurl =baseurl+'itemmanage/item_food/updateintfrm/'+id;
	   var csrf = $('#csrfhashresarvation').val();
	    var dataString = "varient="+id+"&csrf_test_name="+csrf;

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
function editavailable(id){
	   var myurl =baseurl+'itemmanage/item_food/updateavailfrm/'+id;
	   var csrf = $('#csrfhashresarvation').val();
	    var dataString = "varient="+id+"&csrf_test_name="+csrf;

		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editinfo').html(data);
			 $('.timepicker2').timepicker({
				timeFormat: 'HH:mm:ss',
				stepMinute: 5,
				stepSecond: 15
			});
			 $('#edit').modal('show');
		 } 
	});
	}