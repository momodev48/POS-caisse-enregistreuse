// JavaScript Document
"use strict";
    $("form :input").attr("autocomplete", "off");
	
$(document).on('change','#user_id',function(){
			  var id =$("#user_id").val();
			  var csrf = $('#csrfhashresarvation').val();
			  var roleid=$('input[name="role[]"]:checked').val();
			  var dataString = 'userid='+id+'&role='+roleid+'&csrf_test_name='+csrf;
			  $.ajax({
					type: "POST",
					url: basicinfo.baseurl+"dashboard/role/userisassign",
					data: dataString,
					success: function(data){
						if(data==404){
							$('input[name="role[]"]:checked').prop("checked", false);
							toastr.warning("This user is already Assign this role", 'Warning');
						}
					}
					});

        });
		
$('input[type="checkbox"]').click(function(){
            if($(this).is(":checked")){
				  var currentstate=$(this);
				  var id =$("#user_id").val();
				  var csrf = $('#csrfhashresarvation').val();
				  var roleid=$('input[name="role[]"]:checked').val();
				  var dataString = 'userid='+id+'&role='+roleid+'&csrf_test_name='+csrf;
				  $.ajax({
						type: "POST",
						url: basicinfo.baseurl+"dashboard/role/userisassign",
						data: dataString,
						success: function(data){
							if(data==404){
								currentstate.prop("checked", false);
								toastr.warning("This user is already Assign this role", 'Warning');
							}
						}
						});
            }
           
        });
$('.allcheck').click(function(event) {
      var acname=$(this).attr('title');
	  var mid=$(this).attr('usemap');
	  var myclass=acname+'_'+mid;
	  $("."+myclass).prop('checked', $(this).prop("checked"));
    });
	
 var form     = $("#brFrm");  
    var message  = $("#message");

    //upload process
    form.on('submit', function(e) {
        e.preventDefault(); 

        var x = confirm(lang.are_you_sure);
        if (!x) return false; 
        $.ajax({
            url     : $(this).attr('action'),
            method  : $(this).attr('method'),
            dataType: 'json', 
            data    : $(this).serialize(), 
            beforeSend:function()
            {
                message.html('<i class="ti-settings fa fa-spin"></i> '+lang.please_wait).removeClass('hide').addClass('alert-info');  
            }, 
            success:function(data) 
            {
                if (data.success) {
                    message.html('<i class="fa fa-check"></i> '+data.success).removeClass('alert-info').removeClass('alert-danger').addClass('alert-success'); 
                } else {
                   message.html('<i class="fa fa-times"></i> '+data.error).removeClass('alert-success').removeClass('alert-info').addClass('alert-danger');  
                } 
                setTimeout(function(){
                    location.reload();
                }, 3000);
            }, 
            error: function()
            {
                message.html('<i class="fa fa-times"></i> '+lang.ooops_something_went_wrong).removeClass('alert-success').removeClass('alert-info').addClass('alert-danger');
                setTimeout(function(){
                    location.reload();
                }, 3000);
            }
        });   
    });
	
	 function checkserver(){
		 var csrf = $('#csrfhashresarvation').val();
	var datavalue = 'check=0&csrf_test_name='+csrf;
	$.ajax({
			type: "POST",
			url: basicinfo.baseurl+"dashboard/autoupdate/checkserver",
			data: datavalue,
			success: function(data){
				if(data==0){
				swal("Warming", "Your php allow_url_fopen is currently Disable.Check Your server php allow_url_fopen is enable,memory Limit More than 100M and max execution time is 300 or more", "warning");	
				}
				else{
					$("#checkserver").hide();
					$("#serverok").show();
					}
			}
		});
	 }
function downloaddb(){
	var csrf = $('#csrfhashresarvation').val();
var datavalue = 'status=0&csrf_test_name='+csrf;
$.ajax({
		type: "POST",
		url: basicinfo.baseurl+"dashboard/autoupdate/download_backup",
		data: datavalue,
		success: function(data){
			if(data==0){
			swal("Warming", "Your php allow_url_fopen is currently Disable.Check Your server php allow_url_fopen is enable,memory Limit More than 100M and max execution time is 300 or more", "warning");	
			}
			else{
				$("#checkserver").hide();
				$("#serverok").show();
				}
		}
	});
}
function autoupdateoff(latestv){
	var r = confirm("are you sure want to Off Auto Update Notification?");
	if (r == true) {
	 var csrf = $('#csrfhashresarvation').val();
		var datavalue = 'version='+latestv+'&csrf_test_name='+csrf;
			$.ajax({
				type: "POST",
				url: basicinfo.baseurl+"dashboard/autoupdate/notifyoff",
				data: datavalue,
				success: function(data){
					if(data==0){
					swal("Warming", "Your Auto update notification button is disable now.", "success");	
					}
					else{
						$("#checkserver").hide();
						$("#serverok").show();
						}
				}
			});
	} else {
	  return false;
	}
	
	
	}