// JavaScript Document
$(document).ready(function(){
    //bar chart
	"use strict";
	var monthname=$("#monthname").val();
	var onlinesaleamount=$("#onlinesaleamount").val();
	var onlinesaleorder=$("#onlinesaleorder").val();
	var offlinesaleamount=$("#offlinesaleamount").val();
	var offlinesaleorder=$("#offlinesaleorder").val();
	var monthlysaleamount=$("#monthlysaleamount").val();
	var monthlysaleorder=$("#monthlysaleorder").val();
	var str2 = onlinesaleamount.substring(0, onlinesaleamount.length - 2);
    var onlinesaleamount2 = str2.split(',');
	
	var str3 = onlinesaleorder.substring(0, onlinesaleorder.length - 1);
    var onlinesaleorder2 = str3.split(',');
	
	var str4 = offlinesaleamount.substring(0, offlinesaleamount.length - 1);
    var offlinesaleamount2 = str4.split(',');
	
	var str5 = offlinesaleorder.substring(0, offlinesaleorder.length - 1);
    var offlinesaleorder2 = str5.split(',');
	
	var str6 = monthlysaleamount.substring(0, monthlysaleamount.length - 1);
    var monthlysaleamount2 = str6.split(',');
	
	var str7 = monthlysaleorder.substring(0, monthlysaleorder.length - 1);
    var monthlysaleorder2 = str7.split(',');
	
	var str8 = monthname.substring(0, monthname.length - 0);
    var monthnamelist = str8.split(',');
	
	var salesChartCanvas = document.getElementById('barChart').getContext('2d');
    var salesChartData = {
    labels  : [chartinfo.monthname],
    datasets: [
                {
                    label: lang.onlinesamnt,
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: "rgba(55, 160, 0, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(55, 160, 0, 0.5)"
                },
                {
                    label: lang.onlineordnum,
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: "rgba(0,0,0,0.09)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0,0,0,0.07)"
                },
                {
                    label: lang.offsalamnt,
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: "rgba(55,160,0,0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(55,160,0,0.9)"
                },
                {
                    label: lang.offlordnum,
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: "rgba(125,134,255,0.09)",
                    borderWidth: "0",
                    backgroundColor: "rgba(125,134,255,0.4)"
                }
            ]
  }
    /*console.log(salesChartData);*/
    salesChartData.labels = monthnamelist;
	salesChartData.datasets[0].data = onlinesaleamount2;
	salesChartData.datasets[1].data = onlinesaleorder2;
	salesChartData.datasets[2].data = offlinesaleamount2;
	salesChartData.datasets[3].data = offlinesaleorder2;
 

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : true,
        }
      }],
      yAxes: [{
        gridLines : {
          display : true,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
      type: 'bar', 
      data: salesChartData, 
      options: salesChartOptions
    })
	
  var myChartsales = document.getElementById('lineChart').getContext('2d');
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
function searchmonth(){
	var monthyear=$("#datepicker3").val();
	var csrf = $('#csrfhashresarvation').val();
	 var myurl =basicinfo.baseurl+'dashboard/home/checkmonth';
	    var dataString = "monthyear="+monthyear+'&csrf_test_name='+csrf;
		 $.ajax({
		 type: "POST",
		 url: myurl,
		 data: dataString,
		 success: function(data) {
			 $('#salechart').html(data);
		 } 
	});
	
	
	}