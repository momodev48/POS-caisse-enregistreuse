"use strict";

$(function() {
    $("#repayment_start_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#date_of_approve").datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
$(document).ready(function(e) {
    function calculation() {
        var loan = Number($('#amount').val());
        var payl = Number($('#interest_rate').val());
        var inssdsd = Number($('#installment_period').val());


        var date1 = new Date($('#repayment_start_date').val());


        var date2 = new Date($('#date_of_approve').val());
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil((timeDiff / (1000 * 3600 * 24)) / 30);


        var totalp = Math.round((loan + (loan * payl / 100)).toFixed(2));

        var ab = Math.round((totalp) / inssdsd.toFixed(2));

        $('#repayment_amount').val(totalp);
        $('#installment').val(ab);


    }
    $('#amount,#interest_rate,#repayment_amount,#installment,#installment_period,#repayment_start_date,date_of_approve')
        .keyup(calculation)


});