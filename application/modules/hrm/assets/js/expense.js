"use strict";
function bank_paymet(val) {
    if (val == 2) {
        var style = 'block';
    } else {
        var style = 'none';
    }
    document.getElementById('bank_div').style.display = style;
}
function printDiv() {
    var divName = "printArea";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    // document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
"use strict";

function SelectToLoad(id) {
	var csrf = $('#csrfhashresarvation').val();
    //Ajax Load data from ajax
    $.ajax({
        url: basicinfo.baseurl+"hrm/Candidate_select/select_interviewlist/" + id,
        type: "GET",
        dataType: "JSON",
		data:{csrf_test_name:csrf},
        success: function(data) {
            $('[name="job_adv_id"]').val(data.job_adv_id);
            $('[name="interview_date"]').val(data.interview_date);
            $('[name="position_name"]').val(data.position_name);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
function SelectToLoadsl(id) {
		var csrf = $('#csrfhashresarvation').val();
    //Ajax Load data from ajax
    $.ajax({
        url: basicinfo.baseurl+"hrm/Candidate_select/select_interviewlist/" + id,
        type: "GET",
        dataType: "JSON",
		data:{csrf_test_name:csrf},
        success: function(data) {
            $('[name="pos_id"]').val(data.job_adv_id);
            $('[name="pos_name"]').val(data.position_name);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}
$(document).ready(function(e) {
    "use strict";

    function calculation() {

        var date1 = new Date($('#start_date').val());


        var date2 = new Date($('#end_date').val());
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        $('#no_of_days').val(diffDays + 1);

    }
    $('#end_date').change(calculation)


});
$(document).ready(function() {
    "use strict";

    $('.txt').on('keyup', function() {

        var sum = 0;

        $(".txt").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $("#total_marks").val(sum.toFixed());

    });

});
$(function() {
    "use strict";
    $("#date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	 $("#interview_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	$("#notice_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
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