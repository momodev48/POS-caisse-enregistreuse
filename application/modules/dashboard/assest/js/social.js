// JavaScript Document
"use strict";
function editmenu(title,surl,status,icon,sid){
	$("#stitle").val(title);
	$("#url_link").val(surl);
	$("#sicon").val(icon);
	$("#status").select2("val", status);
	$("#btnchnage").text("Update");
	$("#upbtn").show();
	$('#menuurl').attr('action', basicinfo.baseurl+"dashboard/web_setting/editslink/"+sid);
	}
function edittype(dayname,opent,closet,optime){
	$("#btnchnage").show();
	$("#dayname").val(dayname);
	$("#opentime").val(opent);
	$("#closetime").val(closet);
	$("#btnchnage").text("Update");
	$('#typeurl').attr('action', basicinfo.baseurl+"dashboard/web_setting/editstoretime/"+optime);
	}
