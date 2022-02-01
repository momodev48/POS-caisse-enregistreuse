            $(document).ready(function () {
                "use strict"; // Start of use strict
                
                $.fn.extend({
                    treed: function (o) {

                        var openedClass = 'fa-folder-open-o';
                        var closedClass = 'fa-folder-o';

                        if (typeof o !== 'undefined') {
                            if (typeof o.openedClass !== 'undefined') {
                                openedClass = o.openedClass;
                            }
                            if (typeof o.closedClass !== 'undefined') {
                                closedClass = o.closedClass;
                            }
                        }
                        ;

                        //initialize each of the top levels
                        var tree = $(this);
                        tree.addClass("tree");
                        tree.find('li').has("ul").each(function () {
                            var branch = $(this); //li with children ul
                            branch.prepend("<i class='indicator fa " + closedClass + "'></i>");
                            branch.addClass('branch');
                            branch.on('click', function (e) {
                                if (this === e.target) {
                                    var icon = $(this).children('i:first');
                                    icon.toggleClass(openedClass + " " + closedClass);
                                    $(this).children().children().toggle();
                                }
                            });
                            branch.children().children().toggle();
                        });
                        //fire event from the dynamically added icon
                        tree.find('.branch .indicator').each(function () {
                            $(this).on('click', function () {
                                $(this).closest('li').click();
                            });
                        });
                        //fire event to open branch if the li contains an anchor instead of text
                        tree.find('.branch>a').each(function () {
                            $(this).on('click', function (e) {
                                $(this).closest('li').click();
                                e.preventDefault();
                            });
                        });
                        //fire event to open branch if the li contains a button instead of text
                        tree.find('.branch>button').each(function () {
                            $(this).on('click', function (e) {
                                $(this).closest('li').click();
                                e.preventDefault();
                            });
                        });
                    }
                });

                //Initialization of treeviews
            
                $('#tree3').treed({openedClass: 'fa-folder-open-o', closedClass: 'fa-folder'});

            });



"use strict";
function loadData(id){
	var csrf = $('#csrfhashresarvation').val();
    $.ajax({
        url : basicinfo.baseurl+'accounts/accounts/selectedform/' + id,
        type: "GET",
        dataType: "json",
		data:{csrf_test_name:csrf},
        success: function(data)
        {
            $('#newform').html(data);
             $('#btnSave').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(lang.errorajdata);
        }
    });
}

    "use strict";

    function newdata(id){
	 var csrf = $('#csrfhashresarvation').val();
     $.ajax({
        url : basicinfo.baseurl+'accounts/accounts/newform/' + id,
        type: "GET",
        dataType: "json",
		data:{csrf_test_name:csrf},
        success: function(data)
        {
         
           var headlabel = data.headlabel;
           $('#txtHeadCode').val(data.headcode);
            document.getElementById("txtHeadName").value = '';
            $('#txtPHead').val(data.rowdata.HeadName);
            $('#txtHeadLevel').val(headlabel);
            $('#btnSave').prop("disabled", false);
             $('#btnSave').show();
            $('#btnUpdate').hide();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(lang.errorajdata);
        }
    });
}
function selectparenthead(){
	    var phead=$("#coahead").val();
		var headtype = $('#coahead option:selected').data('lebel');
		var headlebel = $('#coahead option:selected').data('pheadlevel');
		var headcode = $('#coahead option:selected').data('headcode');
		$('#headcode').val(headcode);
		$('#pheadcode').val(phead);
		$('#headlebel').val(headlebel);
		$('#headtype').val(headtype);
		var csrf = $('#csrfhashresarvation').val();
		var myurl =basicinfo.baseurl+'accounts/accounts/selectphead';
	    var dataString = "phead="+phead+'&csrf_test_name='+csrf;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('#Parentcategory').html(data);
		 } 
	});
	}
	
function getheadcode(){
	var headleabel=$('#Parentcategory option:selected').data('id');
	var phead=$('#Parentcategory option:selected').data('phead');
	var headcode=  $('#Parentcategory').val();
	$('#headcode').val(headcode);
	$('#pheadcode').val(phead);
	$('#headlebel').val(headleabel);

	}