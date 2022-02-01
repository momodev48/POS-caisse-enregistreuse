"use strict";

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};

$('.btnPrevious').click(function() {
    $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

$("#first_name").on('keyup', function() {
    var inpfirstname = document.getElementById('first_name');
    if (inpfirstname.value.length === 0) return;
    document.getElementById("first_name").style.borderColor = "green";
});
$("#phone").on('keyup', function() {
    var inputphone = document.getElementById('phone');
    if (inputphone.value.length === 0) return;
    document.getElementById("phone").style.borderColor = "green";
});
$("#email").on('keyup', function() {
    var inpemail = document.getElementById('email');
    if (inpemail.value.length === 0) return;
    document.getElementById("email").style.borderColor = "green";
});
//hire date
$("#hiredate").on('change', function() {
    var inputhiredate = document.getElementById('hiredate');
    if (inputhiredate.value.length === 0) return;
    document.getElementById("hiredate").style.borderColor = "green";
});
$("#ohiredate").on('change', function() {
    var inputhiredate = document.getElementById('ohiredate');
    if (inputhiredate.value.length === 0) return;
    document.getElementById("ohiredate").style.borderColor = "green";
});
$("#designation").on('change', function() {
    var inputdesignaiton = document.getElementById('designation');
    if (inputdesignaiton.value.length === 0) return;
    document.getElementById("desig").innerHTML = "";
});
$("#division").on('change', function() {
    var inputdivision = document.getElementById('division');
    if (inputdivision.value.length === 0) return;
    document.getElementById("divis").innerHTML = "";
});
$("#rate_type").on('change', function() {
    var inputrate_type = document.getElementById('rate_type');
    if (inputrate_type.value.length === 0) return;
    document.getElementById("rat_tp").innerHTML = "";
});

$("#rate").on('keyup', function() {
    var inputrate = document.getElementById('rate');
    if (inputrate.value.length === 0) return;
    document.getElementById("rate").style.borderColor = "green";
});
$("#pay_frequency").on('change', function() {

    var inputpay_frequency = document.getElementById('pay_frequency');
    if (inputpay_frequency.value.length === 0) return;
    document.getElementById("frequ").innerHTML = "";
});
$("#dob").on('change', function() {
    var inputdob = document.getElementById('dob');
    if (inputdob.value.length === 0) return;
    document.getElementById("dob").style.borderColor = "green";
});
$("#gender").on('change', function() {
    var inputgender = document.getElementById('gender');
    if (inputgender.value.length === 0) return;
    document.getElementById("gend").innerHTML = "";
});
$("#ssn").on('keyup', function() {
    var inputssn = document.getElementById('ssn');
    if (inputssn.value.length === 0) return;
    document.getElementById("ssn").style.borderColor = "green";
});
$("#h_phone").on('keyup', function() {
    var inputh_phone = document.getElementById('h_phone');
    if (inputh_phone.value.length === 0) return;
    document.getElementById("h_phone").style.borderColor = "green";
});
$("#c_phone").on('keyup', function() {
    var inputc_phone = document.getElementById('c_phone');
    if (inputc_phone.value.length === 0) return;
    document.getElementById("c_phone").style.borderColor = "green";
});
$("#e_h_phone").on('keyup', function() {
    var inpute_h_phone = document.getElementById('e_h_phone');
    if (inpute_h_phone.value.length === 0) return;
    document.getElementById("e_h_phone").style.borderColor = "green";
});
$("#e_w_phone").on('keyup', function() {
    var inpute_w_phone = document.getElementById('e_w_phone');
    if (inpute_w_phone.value.length === 0) return;
    document.getElementById("e_w_phone").style.borderColor = "green";
});
$("#em_contact").on('keyup', function() {
    var inputem_contact = document.getElementById('em_contact');
    if (inputem_contact.value.length === 0) return;
    document.getElementById("em_contact").style.borderColor = "green";
});

function valid_inf() {
    var usernameInput = document.getElementById('first_name');
    var phoneInput = document.getElementById('phone');
    var emailInput = document.getElementById('email');
    var firstname = $('#first_name').val();
    var phone = $('#phone').val();
    var email = $('#email').val();
    if (firstname == "") {
        document.getElementById("first_name").style.borderColor = "red";

    } else {
        $("#first_name").on('keyup', function() {
            document.getElementById("first_name").style.borderColor = "green";
        });

    }
    if (phone == "") {
        document.getElementById("phone").style.borderColor = "red";

    } else {
        $("#phone").on('keyup', function() {
            document.getElementById("phone").style.borderColor = "green";
        });

    }
    if (email == "") {
        document.getElementById("email").style.borderColor = "red";
        return false;
    } else {
        $("#email").on('keyup', function() {
            document.getElementById("email").style.borderColor = "green";
        });
    }
    if (email !== "" && phone !== "" && firstname !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }
}

// second tab validation
function valid_inf2() {
    var hiredateInput = document.getElementById('hiredate');
    var ohiredateInput = document.getElementById('ohiredate');
    var divisionInput = document.getElementById('division');
    var designationInput = document.getElementById('designation');
    var rate_typeInput = document.getElementById('rate_type');
    var rateInput = document.getElementById('rate');
    var pay_frequencyInput = document.getElementById('pay_frequency');
    var hiredate = $('#hiredate').val();
    var ohiredate = $('#ohiredate').val();
    var designation = $('#designation').val();
    var division = $('#division').val();
    var rate_type = $('#rate_type').val();
    var rate = $('#rate').val();
    var pay_frequency = $('#pay_frequency').val();
    if (division == "") {
        document.getElementById("divis").style.color = "red";
        document.getElementById("divis").innerHTML = 'Division Field is Required';
    } else {
        $("#division").on('keyup', function() {
            document.getElementById("divis").style.color = "green";
        });

    }
    if (designation == "") {
        document.getElementById("desig").style.color = "red";
        document.getElementById("desig").innerHTML = 'Designation Field is Required';

    } else {
        $("#designation").on('keyup', function() {
            document.getElementById("designation").style.color = "green";
            document.getElementById("desig").innerHTML = '';
        });

    }

    if (hiredate == "") {
        document.getElementById("hiredate").style.borderColor = "red";
    } else {
        $("#hiredate").on('keyup', function() {
            document.getElementById("hiredate").style.borderColor = "green";
        });


    }
    if (ohiredate == "") {
        document.getElementById("ohiredate").style.borderColor = "red";

    } else {
        $("#ohiredate").on('keyup', function() {
            document.getElementById("ohiredate").style.borderColor = "green";
        });


    }
    if (rate_type == "") {
        document.getElementById("rat_tp").style.color = "red";
        document.getElementById("rat_tp").innerHTML = 'Rate Type Field is Required';
    } else {
        $("#rate_type").on('keyup', function() {
            document.getElementById("rat_tp").innerHTML = "";
        });


    }
    if (rate == "") {
        document.getElementById("rate").style.borderColor = "red";

    } else {
        $("#rate").on('keyup', function() {
            document.getElementById("rate").style.borderColor = "green";
        });


    }
    if (pay_frequency == "") {
        document.getElementById("frequ").style.color = "red";
        document.getElementById("frequ").innerHTML = 'Frequency Field is Required';
    } else {
        $("#pay_frequency").on('keyup', function() {
            document.getElementById("frequ").innerHTML = '';
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
    var dobInput = document.getElementById('dob');
    var genderInput = document.getElementById('gender');
    var ssnInput = document.getElementById('ssn');
    var dob = $('#dob').val();
    var gender = $('#gender').val();
    var ssn = $('#ssn').val();
    if (dob == "") {
        document.getElementById("dob").style.borderColor = "red";
    } else {
        $("#dob").on('keyup', function() {
            document.getElementById("dob").style.borderColor = "green";
        });


    }
    if (gender == "") {
        document.getElementById("gend").style.color = "red";
        document.getElementById("gend").innerHTML = 'Gender Field is Required';

    } else {
        $("#gender").on('keyup', function() {
            document.getElementById("gend").innerHTML = '';
        });


    }

    if (dob !== "" && gender !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }

}

function valid_inf6() {

    var h_phoneInput = document.getElementById('h_phone');
    var c_phoneInput = document.getElementById('c_phone');
    var h_phone = $('#h_phone').val();
    var c_phone = $('#c_phone').val();
    if (h_phone == "") {
        document.getElementById("h_phone").style.borderColor = "red";
    } else {
        $("#h_phone").on('keyup', function() {
            document.getElementById("h_phone").style.borderColor = "green";
        });

    }
    if (c_phone == "") {
        document.getElementById("c_phone").style.borderColor = "red";
    } else {
        $("#c_phone").on('keyup', function() {
            document.getElementById("c_phone").style.borderColor = "green";
        });

    }
    if (h_phone !== "" && c_phone !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }

}

function valid_inf7() {
    var em_contactInput = document.getElementById('em_contact');
    var em_contact = $('#em_contact').val();
    var e_h_phoneInput = document.getElementById('e_h_phone');
    var e_h_phone = $('#e_h_phone').val();
    var e_w_phoneInput = document.getElementById('e_w_phone');
    var e_w_phone = $('#e_w_phone').val();
    if (em_contact == "") {
        document.getElementById("em_contact").style.borderColor = "red";
    } else {
        $("#em_contact").on('keyup', function() {
            document.getElementById("em_contact").style.borderColor = "green";
        });

    }
    if (e_h_phone == "") {
        document.getElementById("e_h_phone").style.borderColor = "red";
    } else {
        $("#e_h_phone").on('keyup', function() {
            document.getElementById("e_h_phone").style.borderColor = "green";
        });

    }
    if (e_w_phone == "") {
        document.getElementById("e_w_phone").style.borderColor = "red";
    } else {
        $("#e_w_phone").on('keyup', function() {
            document.getElementById("e_w_phone").style.borderColor = "green";
        });

    }
    if (em_contact !== "" && e_h_phone !== "" && e_w_phone !== "") {
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    }

}

function valid_inf8() {

    document.getElementById("emp_form").submit();

}

function newcustomfield() {
    var objTo = document.getElementById('appendediv')
    var divtest = document.createElement("div");
    divtest.innerHTML =
        "<div class='row'><div class='col-sm-6'> <div class='form-group'><label for='c_f_name'>Custom Field Name</label><input type='text' class='form-control' id='c_f_name' name='c_f_name[]' placeholder='Custom Field Name'></div></div><div class='col-sm-6'><div class='form-group'><label for='c_f_type'>Custom Field Type</label><select name='c_f_type[]'  class='form-control'><option value='1'>Text</option><option value='2'>Date</option><option value='3'>Text Area</option></select></div></div><div class='col-sm-12'><div class='form-group'><label for='reports'>Custom Value</label><input type='text' name='customvalue[]' class='form-control' placeholder='custom value'></div> </div></div>"
    objTo.appendChild(divtest)
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
                allowClear: true
            });
        }
    });
}