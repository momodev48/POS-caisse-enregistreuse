// JavaScript Document
$(function() {
		"use strict";
		
		var rating = 0;
		$(".counter").text(rating);
		$(".rateyo-readonly-widg").rateYo({
		rating: rating,
		numStars: 5,
		precision: 1,
		minValue: 1,
		maxValue: 5
	}).on("rateyo.change", function(e, data) {

	$("#rating").val(data.rating);
	  console.log(data.rating);
    	});
	});