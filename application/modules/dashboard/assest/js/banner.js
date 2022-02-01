// JavaScript Document
"use strict";
function editbanner(id){
	var csrf = $('#csrfhashresarvation').val();
	   var myurl =basicinfo.baseurl+'dashboard/web_setting/updateintfrm/'+id;
	    var dataString = "id="+id+'&csrf_test_name='+csrf;

		 $.ajax({
		 type: "GET",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('.editbanner').html(data);
			 $('#edit').modal('show');
		 } 
	});
	}
function edittype(typename,typeid){
	$("#bannertype").val(typename);
	$("#btnchnage").text("Update");
	$('#typeurl').attr('action', basicinfo.baseurl+"dashboard/web_setting/edittype/"+typeid);
	}
function editmenu(menuname,menuurl,status,parent,menuid){
	$("#menuname").val(menuname);
	$("#Menuurl").val(menuurl);
	$("#menuid").val(parent).trigger('change');
	$("#status").select2("val", status);
	$("#btnchnage").text("Update");
	$("#upbtn").show();
	$('#menuurl').attr('action', basicinfo.baseurl+"dashboard/web_setting/editmenu/"+menuid);
	}
function editwidget(id){
	 var csrf = $('#csrfhashresarvation').val();
	 var myurl =basicinfo.baseurl+'dashboard/web_setting/updatewidget/'+id;
	  var dataString = "id="+id+'&csrf_test_name='+csrf;
	  $(window).scrollTop(0);
	  $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 tinymce.remove();
			$('#updatecontent').html(data);
			tinymce.init({
			  selector: '.tinymce',
			  height: 150,
			  theme: 'modern',
			  plugins: ["advlist autolink lists link image charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code fullscreen", "insertdatetime media nonbreaking save table contextmenu directionality", "emoticons template paste textcolor colorpicker textpattern"],
					toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
					toolbar2: "print preview media | forecolor backcolor emoticons | fontsizeselect",
					image_advtab: true,
			 });
		 } 
		});
	  
	
	}

	 
	 var edit = $(".edit");
        edit.click(function()
        {
            var template = $(this).parent().prev().text();
            var type = $(this).parent().prev().prev().text();
            var name = $(this).parent().prev().prev().prev().text();
            var id = $(this).data('id');


            $("#id").val(id);
            $("#template_name").val(name); 
            $('select#type option[value='+type+']').attr("selected", "selected");  
            $("#message").html(template);

            $(".tit").text(lang.sms_template_setup);
            $("#MyForm").attr("action", basicinfo.baseurl+'dashboard/smsetting/template_update');
            $(".sav_btn").text(lang.update); 
        });