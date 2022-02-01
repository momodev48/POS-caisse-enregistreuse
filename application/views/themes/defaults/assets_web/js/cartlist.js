// JavaScript Document
"use strict";    
$('.datepickerreserve').datepicker({
				autoclose: true,
				format: "yyyy-m-d",
				startDate: '-0d',
			});
			$('#reservation_time').clockpicker({
				placement: 'bottom',
				align: 'left',
				autoclose: true,
				'default': 'now'
			});
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
}