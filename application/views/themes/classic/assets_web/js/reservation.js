// JavaScript Document
"use strict";    
function submitreserve(){
		var tableno=$("#selecttable").val();
		var capacity= $("#tablicapacity").val();
		var bookdate=$("#bookdate").val();
		var booktimestart=$("#booktime").val();
		var reservation_time=$("#reservation_time").val();
		var name=$("#name").val();
		var phone=$("#phone").val();
		var mail=$("#mail").val();
		var message=$("#message").val();
		if(reservation_time==''){
			alert("Please select End Time!!!");
			return false;
			}
		if(name==''){
			alert("Please Enter Your Name!!!");
			return false;
			}
		if(phone=='' || phone==0){
			alert("Please enter Mobile!!!");
			return false;
			}
		if(mail==''){
			alert("Please enter Email!!");
			return false;
			}
		var dataString = "email="+mail+'&csrf_test_name='+basicinfo.csrftokeng;
		var actionurl =basicinfo.baseurl+'hungry/checkemailisexits';
			 $.ajax({
				 type: "POST",
				 url: actionurl,
				 data: dataString,
				 success: function(data) {
					var err = data;
						if(err=='404'){
							alert("Failed: Your Email Already Exits!!! Please Try to Login or Use Another Email Address!!!");
							window.location.href= basicinfo.baseurl+'mylogin';
							}						   
						else{
							 $("#reservesubmit").submit();
					   }
				 } 
			});
		}
