	"use strict"; 
function edittype(typename,typeid){
	$("#floor").val(typename);
	$("#floorid").val(typeid);
	$("#btnchnage").text("Update");
	$('#typeurl').attr('action', basicinfo.baseurl+"setting/restauranttable/createfloor/");
	}