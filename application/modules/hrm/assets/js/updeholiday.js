$(function() {
	"use strict";
	//$('input[name="working_period"]').daterangepicker();
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
$(document).ready(function(e) {
    function calculation() {
        var date1 = new Date($('#start_date').val());
        var date2 = new Date($('#end_date').val());
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        $('#no_of_days').val(diffDays + 1);

    }
    $('#end_date').change(calculation)
});