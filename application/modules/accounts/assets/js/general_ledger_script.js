    $(document).ready(function(){
    	"use strict";
        $('#cmbGLCode').on('change',function(){
		  var csrf = $('#csrfhashresarvation').val();
           var Headid=$(this).val();
            $.ajax({
                 url: basicinfo.baseurl+'accounts/accounts/general_led',
                type: 'POST',
                data: {
                    Headid: Headid,csrf_test_name:csrf
                },
                success: function (data) {
                   $("#ShowmbGLCode").html(data);
                }
            });

        });
    });

     $(function(){
     	"use strict";
        $(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });
       
    });