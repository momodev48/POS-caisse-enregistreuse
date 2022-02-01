"use strict";

function SelectToLoad(id) {
    //Ajax Load data from ajax
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url: basicinfo.baseurl+"hrm/Loan/select_to_load/",
        method: 'post',
        dataType: 'json',
        data: {
            'employee_id': id,'csrf_test_name':csrf
        },
        success: function(data) {

            document.getElementById("loan_id").innerHTML = data;

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function SelectToname(id) {
    //Ajax Load data from ajax
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url: basicinfo.baseurl+"hrm/Loan/select_to_install/" + id,
        type: "GET",
        dataType: "JSON",
		data:{csrf_test_name:csrf},
        success: function(data) {
            $('[name="installment_amount"]').val(data.installment);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function SelectAuto(id) {
    //Ajax Load data from ajax
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url: basicinfo.baseurl+"hrm/Loan/select_to_autoincrement/" + id,
        type: "GET",
        dataType: "JSON",
		data:{csrf_test_name:csrf},
        success: function(data) {
            var installment = parseInt(data) + 1;
            $('[name="installment_no"]').val(installment);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
$(function() {
	"use strict";
    $("#date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	$(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd'
    }).bind("change", function() {
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate());
        $("#end_date").datepicker("option", "minDate", minValue);
    })
});