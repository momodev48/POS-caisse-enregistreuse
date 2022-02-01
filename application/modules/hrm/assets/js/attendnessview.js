"use strict";
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

    });});
	
	
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
    var t = setTimeout(function() {
        startTime();
    }, 500);
}
startTime();
