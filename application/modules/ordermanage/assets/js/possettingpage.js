  // JavaScript Document
  "use strict";
$('input.placeord[type="checkbox"]').click(function(){
			var csrf = $('#csrfhashresarvation').val();
            if($(this).is(":checked")){
               var menuid=$(this).val();
			   var ischeck=1;
			   var dataString = 'menuid='+menuid+'&status=1&csrf_test_name='+csrf;
            }
            else if($(this).is(":not(:checked)")){
                var menuid=$(this).val();
				var ischeck=0;
				var dataString = 'menuid='+menuid+'&status=0&csrf_test_name='+csrf;
            }
                $.ajax({
				type: "POST",
				url: basicinfo.baseurl+"ordermanage/order/settingenable",
				data: dataString,
				success: function(data){
					if(ischeck==1){
						swal("Enable", "Enable This Option to show on Pos Invoice", "success");
						}
						else{
						swal("Disable", "Make This Field Is Optional On Pos Page.", "warning");
						}
				    }
			    });
        });
$('input.quick[type="checkbox"]').click(function(){
	var csrf = $('#csrfhashresarvation').val();
            if($(this).is(":checked")){
               var menuid=$(this).val();
			   var ischeck=1;
			   var dataString = 'menuid='+menuid+'&status=1&csrf_test_name='+csrf;
            }
            else if($(this).is(":not(:checked)")){
                var menuid=$(this).val();
				var ischeck=0;
				var dataString = 'menuid='+menuid+'&status=0&csrf_test_name='+csrf;
            }
                $.ajax({
				type: "POST",
				url: basicinfo.baseurl+"ordermanage/order/quicksetting",
				data: dataString,
				success: function(data){
					if(ischeck==1){
						swal("Enable", "Enable This Option to show on Pos Invoice", "success");
						}
						else{
						swal("Disable", "Make This Field Is Optional On Pos Page.", "warning");
						}
				    }
			    });
        })