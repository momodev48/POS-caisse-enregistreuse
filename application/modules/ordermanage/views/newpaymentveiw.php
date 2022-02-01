       <div class="row no-gutters" >
        <button type="button" class="close close_div col-md-12 text-right" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
<div class="row no-gutters">
       <div class="form-group col-md-6">
                            <label for="payments" class="col-form-label pb-2"><?php echo display('paymd');?></label>
                           
                                 <?php $card_type=4;
                                  echo form_dropdown('paytype[]',$paymentmethod,'','class="card_typesl postform resizeselect form-control " onchange="showhidecard(this)"') ?>
                          
                        </div>
                   
                       
                        <div class="form-group col-md-6">
                            <label for="4digit" class="col-form-label pb-2"><?php echo display('cuspayment');?></label>
                            
                                  <input type="number"  class="form-control number pay" id="paidamount_marge" name="paidamount[]" value="0"  placeholder="0" onkeyup="changedueamount()" onfocus="givefocus(this)" />
                          
                        </div>
                      </div>
                      <div class="row no-gutters">

                             <div class="cardarea wpr_100 display-none">
                        <div class="form-group col-md-6">
                            <label for="card_terminal" class="col-form-label"><?php echo display('crd_terminal');?></label>
                            
                                 <?php echo form_dropdown('card_terminal[]',$terminalist,'','class="postform resizeselect form-control" ') ?>
                          
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bank" class="col-form-label"><?php echo display('sl_bank');?></label>
                          
                                 <?php echo form_dropdown('bank[]',$banklist,'','class="postform resizeselect form-control" ') ?>
                           
                        </div>
                        <div class="form-group col-md-6">
                            <label for="4digit" class="col-form-label"><?php echo display('lstdigit');?></label>
                           
                                  <input type="text" class="form-control"  name="last4digit[]" value="" />
                            
                        </div>
                      </div>
                       
                        </div>
         </div>
            <script type="text/javascript">
                $(document).ready(function () {
    "use strict";
    // select 2 dropdown 
    $("select.form-control:not(.dont-select-me)").select2({
        placeholder: "Select option",
        allowClear: true
    });
}); </script>