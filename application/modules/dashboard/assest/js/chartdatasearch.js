// JavaScript Document
$(document).ready(function(){
    //bar chart
	"use strict";
	var monthname=$("#monthnamesr").val();
	var monthlysaleamount=$("#monthlysaleamountsr").val();
	var monthlysaleorder=$("#monthlysaleordersr").val();
	
	
	var str6 = monthlysaleamount.substring(0, monthlysaleamount.length - 1);
    var monthlysaleamount2 = str6.split(',');
	
	var str7 = monthlysaleorder.substring(0, monthlysaleorder.length - 1);
    var monthlysaleorder2 = str7.split(',');
	
	var str8 = monthname.substring(0, monthname.length - 0);
    var monthnamelist = str8.split(',');
	
	
	
  var myChartsales = document.getElementById('lineChart2').getContext('2d');
    var salesorderChartData = {
    labels  : [chartinfo.monthname],
    datasets: [
                {
                    label: lang.saleamnt,
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                },
                {
                    label: lang.ordnumb,
                    borderColor: "rgba(55, 160, 0, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(55, 160, 0, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }
            ]
  }
    salesorderChartData.labels = monthnamelist;
	salesorderChartData.datasets[0].data = monthlysaleamount2;
	salesorderChartData.datasets[1].data = monthlysaleorder2;
	
 

  var salesChartOptions2 = {
    responsive : true,
    tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart2 = new Chart(myChartsales, { 
      type: 'line', 
      data: salesorderChartData, 
      options: salesChartOptions2
    })
	
});
