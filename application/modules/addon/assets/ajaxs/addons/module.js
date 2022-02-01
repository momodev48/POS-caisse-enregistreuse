"use strict";
 $(".delete_item").on('click', function(e){
    e.preventDefault();
    var action_url = $(this).attr('href');
	var csrf = $('#csrfhashresarvation').val();
    var CSRF_TOKEN = $('#csrfhashresarvation').val();
    var base_url = $("#base_url").val();
	
	swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover this module!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#3085d6",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel plx!",
		  closeOnConfirm: true,
		  closeOnCancel: true
	  },
	  function (isConfirm) {
		  if (isConfirm) {
		  window.location.href = action_url;
		   
		  } else {
			 swal("Cancelled", "Your module file is safe :)", "success");
			
		  }
	  });

 });