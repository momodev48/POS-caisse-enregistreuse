"use strict";
function summary() {
    var addper = 0;
    $(".addamount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (addper += parseFloat(this.value))
    });
    if (addper > 100) {
        alert('You Can Not input more than 100%');
    }
    var b = parseInt($('#basic').val());
    var add = 0;
    var deduct = 0;
    $(".addamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (add += parseFloat(value * basic /
            100))
    });
    $(".deducamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (deduct += parseFloat(value * basic /
            100))
    });
    document.getElementById('grsalary').value = add + b - (deduct);
}

function handletax(checkbox) {
    var deduct = 0;
    var add = 0;
    var b = parseInt($('#basic').val());
    $(".deducamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (deduct += parseFloat(value * basic /
            100))
    });
    $(".addamount").each(function() {
        var value = this.value;
        var basic = parseInt($('#basic').val());
        isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (add += parseFloat(value * basic /
            100))
    });

    var amount = b - deduct;
    var tax = parseInt($('#taxinput').val());
    var netamount = amount + tax;
    if (checkbox.checked == true) {
		var csrf = $('#csrfhashresarvation').val();
        $.ajax({
            url: basicinfo.baseurl+'hrm/Payroll/salarywithtax/',
            method: 'post',
            dataType: 'json',
            data: {
                'amount': amount,
                'tax': tax,
				'csrf_test_name':csrf
            },
            success: function(data) {
                document.getElementById('grsalary').value = add + b - data - deduct;
                document.getElementById('taxinput').value = '';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    } else {
        var b = parseInt($('#basic').val());
        var add = 0;
        var deduct = 0;
        $(".addamount").each(function() {
            var value = this.value;
            var basic = parseInt($('#basic').val());
            isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (add += parseFloat(value *
                basic / 100))
        });
        $(".deducamount").each(function() {
            var value = this.value;
            var basic = parseInt($('#basic').val());
            isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (deduct += parseFloat(value *
                basic / 100))
        });
        document.getElementById('grsalary').value = add + b - (deduct);
    }
}
//onchange empoyee id information
function employechange(id) {
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url: basicinfo.baseurl+"hrm/Payroll/employeebasic/",
        method: 'post',
        dataType: 'json',
        data: {
            'employee_id': id,
			'csrf_test_name':csrf
        },
        success: function(data) {
            document.getElementById('basic').value = data.rate;
            document.getElementById('sal_type').value = data.rate_type;
            document.getElementById('sal_type_name').value = data.stype;
            document.getElementById('grsalary').value = '';
            if (data.rate_type == 1) {
                document.getElementById("taxinput").disabled = true;
                document.getElementById("taxmanager").checked = true;
                document.getElementById("taxmanager").setAttribute('disabled', 'disabled');
            } else {
                document.getElementById("taxinput").disabled = false;
                document.getElementById("taxmanager").checked = false;
                document.getElementById("taxmanager").removeAttribute('disabled');
            }
            var i;
            var count = $('#add tr').length;
            for (i = 0; i < count; i++) {
                document.getElementById('add_' + i).value = '';
            }

            var dt = $('#dduct tr').length;
            alert(dt);
            for (i = 0; i < dt; i++) {
                document.getElementById('dd_' + i).value = '';
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
$(function() {
    "use strict";

    $("#start_date").datepicker({
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