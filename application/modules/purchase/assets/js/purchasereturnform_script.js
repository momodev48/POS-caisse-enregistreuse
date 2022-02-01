      $(document).ready(function() {
      $('input[type=checkbox]').each(function() {
        if(this.nextSibling.nodeName != 'label') {
          $(this).after('<label for="'+this.id+'"></label>')
        }
      })
    })
	
	
    $('input:checkbox').click(function() {
    var check=$('[name="retrn[]"]:checked').length;
        if (check > 0) {
            
            $('#add_return').prop("disabled", false);
        } else {
        if (check < 1){

            $('#add_return').attr('disabled',true);}
        }
});