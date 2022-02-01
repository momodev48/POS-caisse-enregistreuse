    $(document).ready(function(){
    	"use strict";
        $('#btnSerach').on('click',function(){
            var vouchar=$("#sales_date").val();
			var csrf = $('#csrfhashresarvation').val();
            $.ajax({
                url: basicinfo.baseurl+'accounts/accounts/voucher_report_serach',
                type: 'POST',
                data: {
                    vouchar: vouchar,csrf_test_name:csrf
                },
                success: function (data) {
                    $("#show_vouchar").html(data);
                }
            });

        });
    });


     $(function(){
     	"use strict";
        $(".datepicker").datepicker({ dateFormat:'yy-mm-dd' });
       
    });