// JavaScript Document
"use strict";
	function calcNumbers(result){
        if(result=="C"){
            calc.displayResult.value='';
        }
        else{
        calc.displayResult.value=calc.displayResult.value+result;
        }
        
    }
     function inputNumbers(result){
        if(result=="C"){
            var totalpaid=0;
            $("#paidamount").val('');
            $("#change").val('');
        }
        else{
            var paidamount=$("#paidamount").val();
            var totalpaid=paidamount+result;
            $("#paidamount").val(totalpaid);
            var maintotalamount=$("#maintotalamount").val();
            var restamount=(parseFloat(totalpaid))-(parseFloat(maintotalamount));
            var changes=restamount.toFixed(2);
            $("#change").val(changes);
        }
        
     
    }
    function givefocus(element){
         window.prevFocus = $(element);
    }
	function giveselecttab(element){
		$("#uidupdateid").val('');
		$('#onprocesslist').empty();
         window.prevsltab = $(element);
    }
    function inputNumbersfocus(result){
           if(result=="C"){
            var totalpaid=0;
            prevFocus.val(0);
            changedueamount()
          }
        else{
            if(prevFocus.val() == 0){
                prevFocus.val("")
            }
            var paidamount= prevFocus.val();
            var totalpaid=paidamount+result;
            prevFocus.val(totalpaid);
             changedueamount()
           
         
        }
    }