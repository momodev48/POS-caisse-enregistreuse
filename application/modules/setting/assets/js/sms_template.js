$(document).ready(function(){
        "use strict"; 
        var edit = $(".edit");
        edit.click(function()
        {
            var base_url = $("#base_url").val();
            var update = $("#update").val();
            var sms_template_setup = $("#sms_template_setup").val();

            var template = $(this).parent().prev().text();
            var type = $(this).parent().prev().prev().text();
            var name = $(this).parent().prev().prev().prev().text();
            var id = $(this).data('id');


            $("#id").val(id);
            $("#template_name").val(name); 
            $('select#type option[value='+type+']').attr("selected", "selected");  
            $("#message").html(template);

            $(".tit").text(sms_template_setup);
            $("#MyForm").attr("action", base_url+'setting/smsetting/template_update');
            $(".sav_btn").text(update);
        });
    });