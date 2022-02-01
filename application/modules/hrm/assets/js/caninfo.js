"use strict";
$('.btnPrevious').click(function() {
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});
$('.btnNext').click(function() {
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
});

$("#first_name").on('keyup', function() {
    var inpfirstname = document.getElementById('first_name');
    if (inpfirstname.value.length === 0) return;
    $("#first_name").css("border-color", "green");
});

$("#email").on('keyup', function() {
    var email = document.getElementById('email');
    if (email.value.length === 0) return;
    $("#email").css("border-color", "green");
});

$("#phone").on('keyup', function() {
    var phone = document.getElementById('phone');
    if (phone.value.length === 0) return;
    $("#phone").css("border-color", "green");
});


function validation1() {

    var f_name = $('#first_name').val();
    if (f_name == "") {
        $("#first_name").css("border-color", "red");
    }
    var email = $('#email').val();
    if (email == "") {
        $("#email").css("border-color", "red");
    }

    var phone = $('#phone').val();
    if (phone == "") {
        $("#phone").css("border-color", "red");
    }


    if (f_name !== "" && email !== "" && phone !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }

}

function validation2() {
    $('.nav-tabs > .active').next('li').find('a').trigger('click');
}
$(document).ready(function() {

    "use strict";

    // choose text for the show/hide link - can contain HTML (e.g. an image)
    var showText = 'Add more Info';
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

        $(this).parent().next('.toggle').toggle('slow');

        // return false so any link destination is not followed
        return false;

    });
});
$(document).ready(function() {
    "use strict";
    $(document).on('click', '#getUser', function(e) {

        e.preventDefault();
        var base_url = basicinfo.baseurl;
        var csrf = $('#csrfhashresarvation').val();
        var id = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show(); // load ajax loader

        $.ajax({
                url: basicinfo.baseurl + 'hrm/Candidate/view_details',
                type: 'POST',
                data: 'id=' + id+'&csrf_test_name='+csrf,
                dataType: 'html'
            })
            .done(function(data) {
                console.log(data);
                $('#dynamic-content').html('');
                $('#dynamic-content').html(data); // load response 
                $('#modal-loader').hide(); // hide ajax loader   
            })
            .fail(function() {
                $('#dynamic-content').html(
                    '<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...'
                );
                $('#modal-loader').hide();
            });

    });
});
"use strict";

$(function() {
    $("#tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
    $("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
});
