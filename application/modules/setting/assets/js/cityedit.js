"use strict"; 
function getcountry(){
	var country=$('#state2 option:selected').data('title');
	$("#country2").val(country);
	}