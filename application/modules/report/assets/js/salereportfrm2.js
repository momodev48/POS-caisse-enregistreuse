"use strict";

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
	document.body.style.marginTop="0px";
	$("#myslreportsf_filter").hide();
	$(".dt-buttons btn-group").hide();
	$("#myslreportsf_info").hide();
	$("#myslreportsf_paginate").hide();
    window.print();
    document.body.innerHTML = originalContents;
}