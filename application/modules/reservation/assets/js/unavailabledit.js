$(document).ready(function () {
     "use strict"; 
    $("#unavaildate2").datepicker({
        		dateFormat: "yy-mm-dd"
    		}); 
		});
	
    $('.timepicker2').timepicker({
        timeFormat: 'HH:mm:ss',
        stepMinute: 5,
        stepSecond: 15
    });