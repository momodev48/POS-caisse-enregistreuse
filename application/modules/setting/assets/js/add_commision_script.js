       "use strict"; 
        function savedata(id = null){

      var rate=$("#commission").val();
      var position=$("#poslist").val();
     var csrf = $('#csrfhashresarvation').val();
      if(id == null){
      var url = basicinfo.baseurl+"setting/Commissionsetting/payroll_commission"
      }
      else{
         var url = basicinfo.baseurl+"setting/Commissionsetting/payroll_commission/"+id;

      }
      var errormessage = '';

        if(errormessage==''){
           var dataString = 'rate='+rate+'&position='+position+"&csrf_test_name="+csrf;
              
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: dataString,
                        success: function(data){
                          if(data == 'insert'){
                            window.location.reload();
                          }
                        }
                    });
              
            
            }
        
      
    }


      function showcom(id = null)
        {
          var csrf = $('#csrfhashresarvation').val();
		  if(id == null){
                var url= 'edit_commission';
              }
              else{
                var url= 'edit_commission/'+id;
              }
         $.ajax({
             type: "GET",
             url: url,
			 data:{csrf_test_name:csrf},
             success: function(data) {
              $('#showcom').html(data);
        }

        });


        }