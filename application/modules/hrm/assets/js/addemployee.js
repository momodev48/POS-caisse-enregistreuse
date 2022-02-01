"use strict";

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};

$('.btnPrevious').click(function() {
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

$("#first_name").on('keyup', function() {
    var errfirstname = document.getElementById('first_name-error');
    var inpfirstname = document.getElementById('first_name');
    if (inpfirstname.value.length === 0) return;
    errfirstname.style.display = 'none';
    inpfirstname.className = 'form-control';
});
$("#phone").on('keyup', function() {
    var errphone = document.getElementById('phone-error');
    var inputphone = document.getElementById('phone');
    if (inputphone.value.length === 0) return;
    errphone.style.display = 'none';
    inputphone.className = 'form-control';
});
$("#email").on('keyup', function() {
    var erremail = document.getElementById('email-error');
    var inpemail = document.getElementById('email');
    if (inpemail.value.length === 0) return;
    erremail.style.display = 'none';
    inpemail.className = 'form-control';
});
//hire date
$("#hiredate").on('change', function() {
    var errhiredate = document.getElementById('hiredate-error');
    var inputhiredate = document.getElementById('hiredate');
    if (inputhiredate.value.length === 0) return;
    errhiredate.style.display = 'none';
    inputhiredate.className = 'form-control';
});
$("#ohiredate").on('change', function() {
    var errhiredate = document.getElementById('ohiredate-error');
    var inputhiredate = document.getElementById('ohiredate');
    if (inputhiredate.value.length === 0) return;
    errhiredate.style.display = 'none';
    inputhiredate.className = 'form-control';
});
$("#designation").on('change', function() {
    var errdesignaiton = document.getElementById('designation-error');
    var inputdesignaiton = document.getElementById('designation');
    if (inputdesignaiton.value.length === 0) return;
    errdesignaiton.style.display = 'none';

});
$("#division").on('change', function() {
    var errdivision = document.getElementById('division-error');
    var inputdivision = document.getElementById('division');
    if (inputdivision.value.length === 0) return;
    errdivision.style.display = 'none';

});
$("#rate_type").on('change', function() {
    var errrate_type = document.getElementById('rate_type-error');
    var inputrate_type = document.getElementById('rate_type');
    if (inputrate_type.value.length === 0) return;
    errrate_type.style.display = 'none';

});

$("#rate").on('keyup', function() {
    var errrate = document.getElementById('rate-error');
    var inputrate = document.getElementById('rate');
    if (inputrate.value.length === 0) return;
    errrate.style.display = 'none';

});
$("#pay_frequency").on('change', function() {
    var errpay_frequency = document.getElementById('pay_frequency-error');
    var inputpay_frequency = document.getElementById('pay_frequency');
    if (inputpay_frequency.value.length === 0) return;
    errpay_frequency.style.display = 'none';

});
$("#dob").on('change', function() {
    var errdob = document.getElementById('dob-error');
    var inputdob = document.getElementById('dob');
    if (inputdob.value.length === 0) return;
    errdob.style.display = 'none';
    inputdob.className = 'form-control';
});
$("#gender").on('change', function() {
    var errgender = document.getElementById('gender-error');
    var inputgender = document.getElementById('gender');
    if (inputgender.value.length === 0) return;
    errgender.style.display = 'none';
    inputgender.className = 'form-control';
});
$("#ssn").on('keyup', function() {
    var errssn = document.getElementById('ssn-error');
    var inputssn = document.getElementById('ssn');
    if (inputssn.value.length === 0) return;
    errssn.style.display = 'none';
    inputssn.className = 'form-control';
});
$("#h_phone").on('keyup', function() {
    var errh_phone = document.getElementById('h_phone-error');
    var inputh_phone = document.getElementById('h_phone');
    if (inputh_phone.value.length === 0) return;
    errh_phone.style.display = 'none';
    inputh_phone.className = 'form-control';
});
$("#c_phone").on('keyup', function() {
    var errc_phone = document.getElementById('c_phone-error');
    var inputc_phone = document.getElementById('c_phone');
    if (inputc_phone.value.length === 0) return;
    errc_phone.style.display = 'none';
    inputc_phone.className = 'form-control';
});
$("#e_h_phone").on('keyup', function() {
    var erre_h_phone = document.getElementById('e_h_phone-error');
    var inpute_h_phone = document.getElementById('e_h_phone');
    if (inpute_h_phone.value.length === 0) return;
    erre_h_phone.style.display = 'none';
    inpute_h_phone.className = 'form-control';
});
$("#e_w_phone").on('keyup', function() {
    var erre_w_phone = document.getElementById('e_w_phone-error');
    var inpute_w_phone = document.getElementById('e_w_phone');
    if (inpute_w_phone.value.length === 0) return;
    erre_w_phone.style.display = 'none';
    inpute_w_phone.className = 'form-control';
});
$("#em_contact").on('keyup', function() {
    var errem_contact = document.getElementById('em_contact-error');
    var inputem_contact = document.getElementById('em_contact');
    if (inputem_contact.value.length === 0) return;
    errem_contact.style.display = 'none';
    inputem_contact.className = 'form-control';
});

function valid_inf() {
    var errorUsername = document.getElementById('first_name-error');
    var usernameInput = document.getElementById('first_name');
    var errphone = document.getElementById('phone-error');
    var phoneInput = document.getElementById('phone');
    var erroremail = document.getElementById('email-error');
    var emailInput = document.getElementById('email');
    var firstname = $('#first_name').val();
    var phone = $('#phone').val();
    var email = $('#email').val();
    if (firstname == "") {
        errorUsername.style.display = 'block';
        usernameInput.className = 'form__input form__input--red rounded-4';

    } else {
        $("#first_name").on('keyup', function() {
            errorUsername.style.display = 'none';
            usernameInput.className = 'form__input rounded-4';
        });

    }
    if (phone == "") {
        errphone.style.display = 'block';
        phoneInput.className = 'form__input form__input--red rounded-4';

    } else {
        $("#phone").on('keyup', function() {
            errphone.style.display = 'none';
            phoneInput.className = 'form__input rounded-4';
        });

    }
    if (email == "") {
        erroremail.style.display = 'block';
        emailInput.className = 'form__input form__input--red rounded-4';
        return false;
    } else {
        $("#email").on('keyup', function() {
            erroremail.style.display = 'none';
            emailInput.className = 'form__input rounded-4';
        });
    }
    if (email !== "" && phone !== "" && firstname !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
}

// second tab validation
function valid_inf2() {
    var errorhiredate = document.getElementById('hiredate-error');
    var hiredateInput = document.getElementById('hiredate');
    var oerrorhiredate = document.getElementById('ohiredate-error');
    var ohiredateInput = document.getElementById('ohiredate');
    var errordivision = document.getElementById('division-error');
    var divisionInput = document.getElementById('division');
    var errordesignation = document.getElementById('designation-error');
    var designationInput = document.getElementById('designation');
    var errorrate_type = document.getElementById('rate_type-error');
    var rate_typeInput = document.getElementById('rate_type');
    var errorrate = document.getElementById('rate-error');
    var rateInput = document.getElementById('rate');
    var errorpay_frequency = document.getElementById('pay_frequency-error');
    var pay_frequencyInput = document.getElementById('pay_frequency');

    var hiredate = $('#hiredate').val();
    var ohiredate = $('#ohiredate').val();
    var designation = $('#designation').val();
    var division = $('#division').val();
    var rate_type = $('#rate_type').val();
    var rate = $('#rate').val();
    var pay_frequency = $('#pay_frequency').val();
    if (division == "") {
        errordivision.style.display = 'block';
        divisionInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#division").on('keyup', function() {
            errordivision.style.display = 'none';
            divisionInput.className = 'form__input rounded-4';
        });

    }
    if (designation == "") {
        errordesignation.style.display = 'block';
        designationInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#designation").on('keyup', function() {
            errordesignation.style.display = 'none';
            designationInput.className = 'form__input rounded-4';
        });

    }

    if (hiredate == "") {
        errorhiredate.style.display = 'block';
        hiredateInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#hiredate").on('keyup', function() {
            errorhiredate.style.display = 'none';
            hiredateInput.className = 'form__input rounded-4';
        });


    }
    if (ohiredate == "") {
        oerrorhiredate.style.display = 'block';
        ohiredateInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#ohiredate").on('keyup', function() {
            oerrorhiredate.style.display = 'none';
            ohiredateInput.className = 'form__input rounded-4';
        });


    }
    if (rate_type == "") {
        errorrate_type.style.display = 'block';
        rate_typeInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#rate_type").on('keyup', function() {
            errorrate_type.style.display = 'none';
            rate_typeInput.className = 'form__input rounded-4';
        });


    }
    if (rate == "") {
        errorrate.style.display = 'block';
        rateInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#rate").on('keyup', function() {
            errorrate.style.display = 'none';
            rateInput.className = 'form__input rounded-4';
        });


    }
    if (pay_frequency == "") {
        errorpay_frequency.style.display = 'block';
        pay_frequencyInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#pay_frequency").on('keyup', function() {
            errorpay_frequency.style.display = 'none';
            pay_frequencyInput.className = 'form__input rounded-4';
        });


    }
    if (division !== "" && designation !== "" && hiredate !== "" && ohiredate !== "" && rate_type !== "" && rate !==
        "" && pay_frequency !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
}

// third tab validation
function valid_inf3() {

    $('.nav-tabs > .active').next('li').find('a').trigger('click');

}

// third tab validation
function valid_inf4() {


    $('.nav-tabs > .active').next('li').find('a').trigger('click');

}

function valid_inf5() {
    var errordob = document.getElementById('dob-error');
    var dobInput = document.getElementById('dob');
    var errorgender = document.getElementById('gender-error');
    var genderInput = document.getElementById('gender');
    var errorssn = document.getElementById('ssn-error');
    var ssnInput = document.getElementById('ssn');
    var dob = $('#dob').val();
    var gender = $('#gender').val();
    var ssn = $('#ssn').val();
    if (dob == "") {
        errordob.style.display = 'block';
        dobInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#dob").on('keyup', function() {
            errordob.style.display = 'none';
            dobInput.className = 'form__input rounded-4';
        });


    }
    if (gender == "") {
        errorgender.style.display = 'block';
        genderInput.className = 'form-control form__input--red rounded-4';

    } else {
        $("#gender").on('keyup', function() {
            errorgender.style.display = 'none';
            genderInput.className = 'form__input rounded-4';
        });


    }

    if (dob !== "" && gender !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }

}

function valid_inf6() {

    var errh_phone = document.getElementById('h_phone-error');
    var h_phoneInput = document.getElementById('h_phone');
    var errc_phone = document.getElementById('c_phone-error');
    var c_phoneInput = document.getElementById('c_phone');
    var h_phone = $('#h_phone').val();
    var c_phone = $('#c_phone').val();
    if (h_phone == "") {
        errh_phone.style.display = 'block';
        h_phoneInput.className = 'form__input form__input--red rounded-4';

    } else {
        $("#h_phone").on('keyup', function() {
            errh_phone.style.display = 'none';
            h_phoneInput.className = 'form__input rounded-4';
        });

    }
    if (c_phone == "") {
        errc_phone.style.display = 'block';
        c_phoneInput.className = 'form__input form__input--red rounded-4';

    } else {
        $("#c_phone").on('keyup', function() {
            errc_phone.style.display = 'none';
            c_phoneInput.className = 'form__input rounded-4';
        });

    }
    if (h_phone !== "" && c_phone !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }

}

function valid_inf7() {
    var errem_contact = document.getElementById('em_contact-error');
    var em_contactInput = document.getElementById('em_contact');
    var em_contact = $('#em_contact').val();
    var erre_h_phone = document.getElementById('e_h_phone-error');
    var e_h_phoneInput = document.getElementById('e_h_phone');
    var e_h_phone = $('#e_h_phone').val();
    var erre_w_phone = document.getElementById('e_w_phone-error');
    var e_w_phoneInput = document.getElementById('e_w_phone');
    var e_w_phone = $('#e_w_phone').val();
    if (em_contact == "") {
        errem_contact.style.display = 'block';
        em_contactInput.className = 'form__input form__input--red rounded-4';

    } else {
        $("#em_contact").on('keyup', function() {
            errem_contact.style.display = 'none';
            em_contactInput.className = 'form__input rounded-4';
        });

    }
    if (e_h_phone == "") {
        erre_h_phone.style.display = 'block';
        e_h_phoneInput.className = 'form__input form__input--red rounded-4';

    } else {
        $("#e_h_phone").on('keyup', function() {
            erre_h_phone.style.display = 'none';
            e_h_phoneInput.className = 'form__input rounded-4';
        });

    }
    if (e_w_phone == "") {
        erre_w_phone.style.display = 'block';
        e_w_phoneInput.className = 'form__input form__input--red rounded-4';

    } else {
        $("#e_w_phone").on('keyup', function() {
            erre_w_phone.style.display = 'none';
            e_w_phoneInput.className = 'form__input rounded-4';
        });

    }
    if (em_contact !== "" && e_h_phone !== "" && e_w_phone !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }

}

function valid_inf8() {

    document.getElementById("emp_form").submit();

}

$(document).ready(function() {

    // choose text for the show/hide link - can contain HTML (e.g. an image)
    var showText = '<span class="btn btn-primary" >Add More</span>';
    var hideText = '<span class="btn btn-danger" >Close</span>';

    // initialise the visibility check
    var is_visible = false;

    // append show/hide links to the element directly preceding the element with a class of "toggle"
    $('.toggle').prev().append(' <a href="#" class="toggleLink">' + showText + '</a>');

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

function getstate() {
    var country = $("#country").val();
	var csrf = $('#csrfhashresarvation').val();
    var myurl = basicinfo.baseurl+'hrm/Employees/statelist';
    var dataString = "country=" + country+'&csrf_test_name='+csrf;
    $.ajax({
        type: "POST",
        url: myurl,
        data: dataString,
        success: function(data) {
            $('#state').html(data);
            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select State",
                allowClear: true
            });
        }
    });
}