// JavaScript Document
"use strict";
function editmenu(title,keyword,desc,sid){
	$("#stitle").val(title);
	$("#keywords").val(atob(keyword));
	$("#descp").val(atob(desc));
	
	$("#btnchnage").show();
	$("#btnchnage").text("Update");
	$("#upbtn").show();
	$('#menuurl').attr('action', basicinfo.baseurl+"dashboard/web_setting/editseo/"+sid);
	$(window).scrollTop(0);
	}
