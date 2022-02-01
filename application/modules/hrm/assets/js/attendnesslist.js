(function($){
"use strict";
     $("#a_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#b_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#c_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd'
    }).bind("change", function() {
        var minValue = $(this).val();
        minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
        minValue.setDate(minValue.getDate());
        $(".end_date").datepicker("option", "minDate", minValue);
    });
})(jQuery);

