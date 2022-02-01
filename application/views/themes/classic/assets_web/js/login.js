// JavaScript Document
     "use strict";
     function logincustomer() {
         var email = $('#user_email').val();
         var pass = $('#u_pass').val();
         var errormessage = '';
         if (email == '') {
             errormessage = errormessage + '<span>'+lang.please_enter_your_email+'</span>';
             alert(lang.please_enter_your_email);
             return false;
         }
         if (pass == '') {
             errormessage = errormessage + '<span>'+lang.please_enter_your_email+'</span>';
             alert(lang.please_enter_your_email);
             return false;
         }
         var dataString = 'email=' + email + '&pass1=' + pass+'&csrf_test_name='+basicinfo.csrftokeng;
         $.ajax({
             type: "POST",
             url: basicinfo.baseurl+'hungry/userlogin',
             data: dataString,
             success: function(data) {
                 var err = data;
                 if (err == '404') {
                     alert(lang.failed_login_msg);
                 } else {
                     window.location.href =  basicinfo.baseurl+'menu';
                 }
             }
         });
     }

     function lostpassword() {
         var email = $('#user_email2').val();
         var errormessage = '';
         if (email == '') {
             errormessage = errormessage + '<span>'+lang.enter_your_phone_or_email+'</span>';
             alert(lang.please_enter_your_email);
             return false;
         }

         var dataString = 'email=' + email+'&csrf_test_name='+basicinfo.csrftokeng;
         $.ajax({
             type: "POST",
             url: basicinfo.baseurl+'hungry/passwordrecovery',
             data: dataString,
             success: function(data) {
                 var err = data;
                 if (err == '404') {
                     alert(lang.email_not_registered_msg);
                 } else {
                     alert(lang.have_been_sent_email+" " + email + " "+lang.check_your_new_password);
                     window.location.href = basicinfo.baseurl+'checkout';
                 }
             }
         });
     }