	"use strict"; 
 function resetdata(){
	 	$("#resetdata").modal('show');
	 }
	function confirmreset(){
		var pass=$('#checkpassword').val();
		var csrf = $('#csrfhashresarvation').val();
		var datavalue="password="+pass+"&csrf_test_name="+csrf;
		$.ajax({
				type: "POST",
				url: basicinfo.baseurl+"setting/setting/checkpassword",
				data: datavalue,
				success: function(data){
					if(data==0){
					swal("Warming", "Your Password is Not match", "warning");	
					}
					else{
						swal({
                                title: "success",
                                text: "Reset Completed",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#28a745",
                                confirmButtonText: "OK",
                                closeOnConfirm: true,
                                closeOnCancel: false
                            },
                            function (isConfirm) {
                                if (isConfirm) {
                               		window.location.href=basicinfo.baseurl+"dashboard/home";
                                }
                            });
						}
				}
			});
		}