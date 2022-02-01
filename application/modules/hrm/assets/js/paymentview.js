"use strict";

function Payment(salpayid, employee_id, TotalSalary, WorkHour, Period) {

    var sal_id = salpayid;
    var employee_id = employee_id;
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url: basicinfo.baseurl+"hrm/Employees/EmployeePayment/",
        method: 'post',
        dataType: 'json',
        data: {
            'sal_id': sal_id,
            'employee_id': employee_id,
            'totalamount': TotalSalary,
			'csrf_test_name':csrf,
        },
        success: function(data) {
            document.getElementById('employee_name').value = data.Ename;
            document.getElementById('employee_id').value = data.employee_id;
            document.getElementById('salType').value = salpayid;
            document.getElementById('total_salary').value = TotalSalary;
            document.getElementById('total_working_minutes').value = WorkHour;
            document.getElementById('working_period').value = Period;
            $("#PaymentMOdal").modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }

    });
}
function starcheck() {
    var star = $('#number_of_star').val();
    if (star > 5) {
        alert('You Can not input More Than five Star');
        document.getElementById('number_of_star').value = '';
    }
}
$(function() {
    "use strict";
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	$("#date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	$("#start_date").datepicker({
    dateFormat: 'Y-m-d'
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