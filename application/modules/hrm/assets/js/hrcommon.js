(function($){
"use strict";
    $("#repayment_start_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#date_of_approve").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	$("#date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd'
    }).bind("change", function() {
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate());
        $("#end_date").datepicker("option", "minDate", minValue);
    });
	$('input[name="working_period"]').daterangepicker();
	$("#start_date").datepicker({
    dateFormat: 'yy-mm-dd'
	});
	$("#end_date").datepicker({
		dateFormat: 'yy-mm-dd'
	});
	$("#a_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#b_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#c_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	 $("#a").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#b").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#c").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#d").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#e").datepicker({
        dateFormat: 'yy-mm-dd'
    });
	$("#f").datepicker({
        dateFormat: 'yy-mm-dd'
    });
})(jQuery);

"use strict";

function printDiv() {
    var divName = "printArea";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
function bank_paymet(val) {
    if (val == 2) {
        var style = 'block';

    } else {
        var style = 'none';

    }

    document.getElementById('bank_div').style.display = style;
}

function starcheck() {
    var star = $('#number_of_star').val();
    if (star > 5) {
        alert('You Can not input More Than five Star');
        document.getElementById('number_of_star').value = '';
    }
}

function myFunction() {
    window.print();

    function hide() {
        document.getElementById('pr').style.display = "none";

    }
}
function applicationcalculation() {

        var date1 = new Date($('.leave_aprv_strt_date').val());


        var date2 = new Date($('.leave_aprv_end_date').val());
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));




        $('.num_aprv_day').val(diffDays);



    }
    $('.leave_aprv_strt_date,.leave_aprv_end_date,.num_aprv_day').keyup(applicationcalculation);
	function signoutmodal(id, signin) {
    $("#signout").modal('show');
    document.getElementById('att_id').value = id;
    document.getElementById('sign_in').value = signin;
}
$(document).ready(function() {

    "use strict";

    // choose text for the show/hide link - can contain HTML (e.g. an image)
    var showText = 'ADD More';
    var hideText = 'Hide';

    // initialise the visibility check
    var is_visible = false;

    // append show/hide links to the element directly preceding the element with a class of "toggle"
    $('.toggle').prev().append(' (<a href="#" class="toggleLink">' + showText + '</a>)');

    // hide all of the elements with a class of 'toggle'
    $('.toggle').hide();

    // capture clicks on the toggle links
    $('a.toggleLink').click(function() {

        // switch visibility
        is_visible = !is_visible;

        // change the link depending on whether the element is shown or hidden
        $(this).html((!is_visible) ? showText : hideText);

        // toggle the display - uncomment the next line for a basic "accordion" style
        //$('.toggle').hide();$('a.toggleLink').html(showText);
        $(this).parent().next('.toggle').toggle('slow');

        // return false so any link destination is not followed
        return false;

    });
});

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {

    var indianTimeZoneVal = new Date().toLocaleString('en-US', {
        timeZone: basicinfo.timezone
    });
    var today = new Date(indianTimeZoneVal);
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var ap = "AM";
    if (h > 11) {
        ap = "PM";
    }
    if (h > 12) {
        h = h - 12;
    }
    if (h == 0) {
        h = 12;
    }
    if (h < 10) {
        h = "0" + h;
    }
    if (m < 10) {
        m = "0" + m;
    }
    if (s < 10) {
        s = s;
    }

    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock').innerHTML = h + ":" + m + ":" + s + " " + ap;
    t = setTimeout(function() {
        startTime()
    }, 500);
}
startTime();