// JavaScript Document
"use strict";
    function logincustomer(){
	var email=$('#user_email').val();
	var pass=$('#u_pass').val();
	var errormessage = '';
	  if(email == ''){ errormessage = errormessage+'<span>Please enter your Phone Or Email.</span>';
			alert("Enter Your Email!!");
			return false;
		}
	if(pass == ''){ errormessage = errormessage+'<span>Password Not Empty.</span>';
		alert("Enter Your Email!!");
			return false;
	}
				var dataString = 'email='+email +'&pass1='+pass+'&csrf_test_name='+basicinfo.csrftokeng;
					$.ajax({
						type: "POST",
						url:basicinfo.baseurl+'hungry/userlogin',
						data: dataString,
						success: function(data){
							var err = data;
							if(err=='404'){
								alert("Failed Login: Check your Email and password!");
								}						   
							else{
							window.location.href= basicinfo.baseurl+'menu';
						   }
						}
					});
	}
	"use strict";
	function lostpassword(){
	var email=$('#user_email2').val();
	var errormessage = '';
	  if(email == ''){ errormessage = errormessage+'<span>Please enter your Phone Or Email.</span>';
			alert("Enter Your Email!!");
			return false;
		}
	
				var dataString = 'email='+email+'&csrf_test_name='+basicinfo.csrftokeng;
					$.ajax({
						type: "POST",
						url:basicinfo.baseurl+'hungry/passwordrecovery',
						data: dataString,
						success: function(data){
							var err = data;
							if(err=='404'){
								alert("Failed: Email has not been registered yet.!!!");
								}						   
							else{
							alert("Success: We have been sent a email to this "+email+" Email Address. Please check your New Password..!!!");
							window.location.href= basicinfo.baseurl+'checkout';
						   }
						}
					});
	}