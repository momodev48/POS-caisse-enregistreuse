// JavaScript Document
$( window ).load(function() {
  // Run code
   "use strict";
  $(".sidebar-mini").addClass('sidebar-collapse');
   setInterval(function(){ 
  window.location.href = basicinfo.baseurl+"ordermanage/order/allkitchen";
 }, 300000);
 setInterval(function(){ 
  load_unseen_notification(); 
 }, 700);
 setInterval(function(){ 
  window.location.href = basicinfo.baseurl+"ordermanage/order/kitchen";
 }, 600000);
});
"use strict";
function printJobComplete() {
  $("#kotenpr").empty();
}
$('input[type="checkbox"]').click(function(){
             var csrf = $('#csrfhashresarvation').val();
            if($(this).is(":checked")){
               var menuid=$(this).val();
			   var orderid=$(this).attr('usemap');
			   var varient=$(this).attr('title');
			   var isaccept=$(this).attr('alt');
			   var dataString = 'orderid='+orderid+'&menuid='+menuid+'&varient='+varient+'&status=1&csrf_test_name='+csrf;
            }
            else if($(this).is(":not(:checked)")){
                 var menuid=$(this).val();
				 var orderid=$(this).attr('usemap');
				  var varient=$(this).attr('title');
				  var isaccept=$(this).attr('alt');
				  var dataString = 'orderid='+orderid+'&menuid='+menuid+'&varient='+varient+'&status=0&csrf_test_name='+csrf;
            }
           if(isaccept==1){
                $.ajax({
				type: "POST",
				url: basicinfo.baseurl+"ordermanage/order/itemisready",
				data: dataString,
				success: function(data){
					
				    }
			    });
            }
          
        });
function orderaccept(ordid,kitid){
	var values = $('input[name="item'+ordid+kitid+'"]:checked').map(function() {
      return $(this).val();
    }).get().join(',');
var varient = $('input[name="item'+ordid+kitid+'"]:checked').map(function() {
      		return $(this).attr('title');
    		}).get().join(',');	
var allvarient=varient+',';
if(values==''){
	swal("Check Item", "Please check at least one item!!", "warning");
	return false;
	}
			 var csrf = $('#csrfhashresarvation').val();
			 var dataString = 'orderid='+ordid+'&kitid='+kitid+'&itemid='+values+'&varient='+allvarient+'&csrf_test_name='+csrf;
			$.ajax({
				type: "POST",
				url: basicinfo.baseurl+"ordermanage/order/itemacepted",
				data: dataString,
				success: function(data){
					if(data==1){
					$('input[name="item'+ordid+kitid+'"]:checked').removeAttr('disabled');
					$("#topsec"+ordid+kitid).removeClass("pending");
					$("#isprepare"+ordid+kitid).removeClass("display-none");
					$("#isprepare"+ordid+kitid).addClass("display-block");
					$("#isongoing"+ordid+kitid).removeClass("display-block");
					$("#isongoing"+ordid+kitid).addClass("display-none");
					$('input[name="item'+ordid+kitid+'"]:checked').attr('alt',1);
					$('input[name="item'+ordid+kitid+'"]:checked').removeAttr('checked');
					}
					else{
						$('input[name="item'+ordid+kitid+'"]:checked').attr('alt',1);
						$('input[name="item'+ordid+kitid+'"]:checked').prop( "disabled", true );
						}
					
					}
				});
			}
	function ordercancel(ordid,kitid){
		$('#cancelord').modal('show');
		var values = $('input[name="item'+ordid+kitid+'"]:checked:not(:disabled)').map(function() {
      		return $(this).val();
    		}).get().join(',');
		var varient = $('input[name="item'+ordid+kitid+'"]:checked:not(:disabled)').map(function() {
      		return $(this).attr('title');
    		}).get().join(',');	
		$("#canordid").text(ordid);
		$("#mycanorder").val(ordid);
		$("#mykid").val(kitid);
		$("#mycanitem").val(values);
		$("#myvarient").val(varient+',');
	}
	function itemcancel(){

	
	}
	  $('body').on('click', '#itemcancel', function() {
		  	var ordid=$("#mycanorder").val();
			var kid=$("#mykid").val();
			var itemid=$("#mycanitem").val();
			var varient=$("#myvarient").val();
			var reason=$("#canreason").val();
			var csrf = $('#csrfhashresarvation').val();
			var dataString = 'reason='+reason+'&item='+itemid+'&orderid='+ordid+'&varient='+varient+'&kid='+kid+'&csrf_test_name='+csrf;
			$.ajax({
			type: "POST",
			url: basicinfo.baseurl+"ordermanage/order/cancelitem",
			data: dataString,
			success: function(data){
				$('#cancelord').modal('hide');
				$("#singlegrid"+ordid+kid).html(data);
				if (!$('#singlegrid'+ordid+kid).text().length) {
				}
				if($('#singlegrid'+ordid+kid).html().toString().replace(/ /g,'') == "") {
				$("#singlegrid"+ordid+kid).remove();
				var $container = $('.grid');
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.grid-col',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        });

        $('a[data-toggle=tab]').each(function() {
            var $this = $(this);

            $this.on('shown.bs.tab', function() {

                $container.imagesLoaded(function() {
                    $container.masonry({
                        itemSelector: '.grid-col',
                        columnWidth: '.grid-sizer',
                        percentPosition: true
                    });
                });

            });
        });
				}
				
			}
		});
		  });
		 
function onprepare(ordid,kitid){
	var values = $('input[name="item'+ordid+kitid+'"]:checked').map(function() {
      		return $(this).val();
    		}).get().join(',');
		var varient = $('input[name="item'+ordid+kitid+'"]:checked').map(function() {
      		return $(this).attr('title');
    		}).get().join(',');	
		var allvarient=varient+',';
		if(values==''){
		swal("Check Item", "Please check at least one item!!", "warning");
		return false;
		}
		var csrf = $('#csrfhashresarvation').val();
		var dataString = 'item='+values+'&orderid='+ordid+'&varient='+allvarient+'&kid='+kitid+'&csrf_test_name='+csrf;
		$.ajax({
			type: "POST",
			url: basicinfo.baseurl+"ordermanage/order/markasdone",
			data: dataString,
			success: function(data){
				var numberOfChecked =$('input[name="item'+ordid+kitid+'"]:checkbox:checked').length;
				var totalCheckboxes = $('input[name="item'+ordid+kitid+'"]:checkbox').length;
				var delonefromall=totalCheckboxes-1;
				if(delonefromall==numberOfChecked || totalCheckboxes==numberOfChecked){
				$("#singlegrid"+ordid+kitid).remove();
				var $container = $('.grid');
        		$container.imagesLoaded(function() {
					$container.masonry({
						itemSelector: '.grid-col',
						columnWidth: '.grid-sizer',
						percentPosition: true
					});
				});
        		$('a[data-toggle=tab]').each(function() {
						var $this = $(this);
			
						$this.on('shown.bs.tab', function() {
			
							$container.imagesLoaded(function() {
								$container.masonry({
									itemSelector: '.grid-col',
									columnWidth: '.grid-sizer',
									percentPosition: true
								});
							});
			
						});
					});
				}
			}
        });
	}
function printtoken(ordid,kitid){
	var values = $('input[name="item'+ordid+kitid+'"]:checked').map(function() {
      		return $(this).val();
    		}).get().join(',');
		var varient = $('input[name="item'+ordid+kitid+'"]:checked').map(function() {
      		return $(this).attr('title');
    		}).get().join(',');	
		var allvarient=varient+',';
		var csrf = $('#csrfhashresarvation').val();
		var dataString = 'orderid='+ordid+'&kid='+kitid+'&varient='+allvarient+'&itemid='+values+'&csrf_test_name='+csrf;
		$.ajax({
			type: "POST",
			url: basicinfo.baseurl+"ordermanage/order/printtoken",
			data: dataString,
			success: function(data){
				$("#kotenpr").html(data);
				const style = '@page { margin-top: 0px;font-size:18px; }';
				printJS({
					printable: 'kotenpr',
					onPrintDialogClose: printJobComplete,
					type: 'html',
					font_size: '32px;',
					style: style,
					scanStyles: false												
				  })
			}
        });
	}
	
//kitchen
function oredrready(orderid){
	var csrf = $('#csrfhashresarvation').val();
	var dataString = 'orderid='+orderid+'&csrf_test_name='+csrf;
	 $.ajax({
			type: "POST",
			url: basicinfo.baseurl+"ordermanage/order/checkorder",
			data: dataString,
			success: function(data){
				$('.addonsinfo').html(data);
				$('#edit').modal('show');
			}
		});
	}
function oredrisready(orderid){
	var csrf = $('#csrfhashresarvation').val();
	var dataString = 'orderid='+orderid+'&csrf_test_name='+csrf;
	 $.ajax({
			type: "POST",
			url: basicinfo.baseurl+"ordermanage/order/orderisready",
			data: dataString,
			success: function(data){
				$('#kitchenload').html(data);
				$('#edit').modal('hide');
			}
		});
	}
 function load_unseen_notification()
 {
	 var csrf = $('#csrfhashresarvation').val();
	 var view=''
  $.ajax({
   url: basicinfo.baseurl+"ordermanage/order/notification",
   method:"POST",
   data:{view:view,csrf_test_name:csrf},
   dataType:"json",
   success:function(data)
   {
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }