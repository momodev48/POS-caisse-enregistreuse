$(document).ready(function () {
    "use strict"; // Start of use strict

    //back to top
    $('body').append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>');
    $(window).on("scroll", function () {
        if ($(this).scrollTop() !== 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });

    $('#toTop').on("click", function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

    //lobipanel
    $('.lobidrag').lobiPanel({
        sortable: true,
        editTitle: {
            icon: 'ti-pencil'
        },
        unpin: {
            icon: 'ti-move'
        },
        reload: {
            icon: 'ti-reload'
        },
        minimize: {
            icon: 'ti-minus',
            icon2: 'ti-plus'
        },
        close: {
            icon: 'ti-close'
        },
        expand: {
            icon: 'ti-fullscreen',
            icon2: 'ti-fullscreen'
        }
    });

    $('.lobidisable').lobiPanel({
        reload: false,
        close: false,
        editTitle: false,
        sortable: true,
        unpin: {
            icon: 'ti-move'
        },
        minimize: {
            icon: 'ti-minus',
            icon2: 'ti-plus'
        },
        expand: {
            icon: 'ti-fullscreen',
            icon2: 'ti-fullscreen'
        }
    });

    //datatable
    $('.datatable').DataTable({ 
        responsive: true, 
		"language": {
        "sProcessing":     lang.Processingod,
        "sSearch":         lang.search,
        "sLengthMenu":     lang.sLengthMenu,
        "sInfo":           lang.sInfo,
        "sInfoEmpty":      lang.sInfoEmpty,
        "sInfoFiltered":   "",
        "sInfoPostFix":    "",
        "sLoadingRecords": lang.sLoadingRecords,
        "sZeroRecords":    lang.sZeroRecords,
        "sEmptyTable":     lang.sEmptyTable,
		"paginate": {
				"first":      lang.sFirst,
				"last":       lang.sLast,
				"next":       lang.sNext,
				"previous":   lang.sPrevious
			},
        "oAria": {
            "sSortAscending":  ": "+lang.sSortAscending,
            "sSortDescending": ": "+lang.sSortDescending
        },
        "select": {
                "rows": {
                    "_": lang._sign,
                    "0": lang._0sign,
                    "1": lang._0sign
                } 
        },
		buttons: {
                copy: lang.copy,
				csv: lang.csv,
				excel: lang.excel,
				pdf: lang.pdf,
				print: lang.print,
				colvis: lang.colvis
            }
    },
        dom: "<'row'<'col-lg-4 'l><'col-lg-4  text-center'B><'col-lg-4 'f>>tp", 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ] 
    });
    
    $('.datatable2').DataTable({ 
        responsive: true, 
        paging: false,
		"language": {
        "sProcessing":     lang.Processingod,
        "sSearch":         lang.search,
        "sLengthMenu":     lang.sLengthMenu,
        "sInfo":           lang.sInfo,
        "sInfoEmpty":      lang.sInfoEmpty,
        "sInfoFiltered":   "",
        "sInfoPostFix":    "",
        "sLoadingRecords": lang.sLoadingRecords,
        "sZeroRecords":    lang.sZeroRecords,
        "sEmptyTable":     lang.sEmptyTable,
		"paginate": {
				"first":      lang.sFirst,
				"last":       lang.sLast,
				"next":       lang.sNext,
				"previous":   lang.sPrevious
			},
        "oAria": {
            "sSortAscending":  ": "+lang.sSortAscending,
            "sSortDescending": ": "+lang.sSortDescending
        },
        "select": {
                "rows": {
                    "_": lang._sign,
                    "0": lang._0sign,
                    "1": lang._1sign
                } 
        },
		buttons: {
                copy: lang.copy,
				csv: lang.csv,
				excel: lang.excel,
				pdf: lang.pdf,
				print: lang.print,
				colvis: lang.colvis
            }
    },
		dom: "<'row'<'col-sm-8'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ]
    });
    //datatable2
    $('.datatable3').DataTable({ 
        responsive: true, 
        paging: false,
        dom: "<'row'<'col-sm-8'B><'col-sm-4'f>>tp", 
        "lengthMenu": [[ 25, 50, 100, 150, 200, 500, -1], [ 25, 50, 100, 150, 200, 500, "All"]], 
        buttons: [  
            {extend: 'copy', className: 'btn-sm'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm', title: 'exportTitle'}, 
            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'}, 
            {extend: 'print', className: 'btn-sm'} 
        ],
		"language": {
        "sProcessing":     lang.Processingod,
        "sSearch":         lang.search,
        "sLengthMenu":     lang.sLengthMenu,
        "sInfo":           lang.sInfo,
        "sInfoEmpty":      lang.sInfoEmpty,
        "sInfoFiltered":   "",
        "sInfoPostFix":    "",
        "sLoadingRecords": lang.sLoadingRecords,
        "sZeroRecords":    lang.sZeroRecords,
        "sEmptyTable":     lang.sEmptyTable,
		"paginate": {
				"first":      lang.sFirst,
				"last":       lang.sLast,
				"next":       lang.sNext,
				"previous":   lang.sPrevious
			},
        "oAria": {
            "sSortAscending":  ": "+lang.sSortAscending,
            "sSortDescending": ": "+lang.sSortDescending
        },
        "select": {
                "rows": {
                    "_": lang._sign,
                    "0": lang._0sign,
                    "1": lang._0sign
                } 
        },
		buttons: {
                copy: lang.copy,
				csv: lang.csv,
				excel: lang.excel,
				pdf: lang.pdf,
				print: lang.print,
				colvis: lang.colvis
            }
    },
		"searching": false 
    });

    // select 2 dropdown 
    $("select.form-control:not(.dont-select-me)").select2({
        placeholder: "Select option",
        allowClear: true
    });
	
	
	$("#category_id").select2({
        placeholder: "Select Food",
        allowClear: true
    });

    //datepicker
    $(".datepicker").datepicker({
        dateFormat: "dd-mm-yy"
    }); 
   //datepicker
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });
	//datepicker
    $(".datepicker5").datepicker({
        dateFormat: "yy-mm-dd"
    }); 
 //datepicker
 $('.datepicker3').datepicker({
	 dateFormat: "yy-mm",
	changeMonth: true,
    changeYear: true,
	yearRange: "-100:+0",
});
$('.datepickerjs').datepicker({
	dateFormat: "mm-dd-yy"
});


    //timepicker
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm:ss',
        stepMinute: 5,
        stepSecond: 15
    });
	 //timepicker
	 var myControl=  {
	create: function(tp_inst, obj, unit, val, min, max, step){
		$('<input class="ui-timepicker-input" value="'+val+'" style="width:50%">')
			.appendTo(obj)
			.spinner({
				min: min,
				max: max,
				step: step,
				change: function(e,ui){ // key events
						// don't call if api was used and not key press
						if(e.originalEvent !== undefined)
							tp_inst._onTimeChange();
						tp_inst._onSelectHandler();
					},
				spin: function(e,ui){ // spin events
						tp_inst.control.value(tp_inst, obj, unit, ui.value);
						tp_inst._onTimeChange();
						tp_inst._onSelectHandler();
					}
			});
		return obj;
	},
	options: function(tp_inst, obj, unit, opts, val){
		if(typeof(opts) == 'string' && val !== undefined)
			return obj.find('.ui-timepicker-input').spinner(opts, val);
		return obj.find('.ui-timepicker-input').spinner(opts);
	},
	value: function(tp_inst, obj, unit, val){
		if(val !== undefined)
			return obj.find('.ui-timepicker-input').spinner('value', val);
		return obj.find('.ui-timepicker-input').spinner('value');
	}
};
    $('.timepicker3').timepicker({
       controlType: myControl
    });
	//timepicker
    $('.timepicker2').timepicker({
        timeFormat: 'HH:mm:ss',
        stepMinute: 5,
        stepSecond: 15
    });

		// Message
			$('.message_inner').slimScroll({
				size: '3px',
				height: '435px'
			});
			$('.message_inner1').slimScroll({
				size: '3px',
				height: '300'
			});
    //tinymce editor
    tinymce.init({
      selector: '.tinymce',
      height: 150,
      theme: 'modern',
	  extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",
      plugins: ["advlist autolink lists link image charmap print preview hr anchor pagebreak", "searchreplace wordcount visualblocks visualchars code fullscreen", "insertdatetime media nonbreaking save table contextmenu directionality", "emoticons template paste textcolor colorpicker textpattern"],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons | fontsizeselect",
            image_advtab: true,
     });

tinymce.init({
  selector: '.tinymce2',
  plugins: 'code',
  toolbar: 'code',
  height: 80,
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
    //ends tinymce
 
    
});