"use strict"; 
function getcountry(){
	var country=$('#state option:selected').data('title');
	$("#country").val(country);
	}