    <?php echo form_open('','method="get" class="navbar-search" id="paymodal-multiple-form"')?>
       <div class="modal-content">
			 <input name="csrf_test_name" id="csrf_test_name" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('sl_payment');?></strong>
            </div>
            <div class="modal-body">
                <div class="row">
        <div class="panel">
            <div class="panel-body">
                  <div class="col-md-8 row ">
                  <div class="row no-gutters">
                        <div class="col-md-4">
                        	
                        	<div class="form-group">
                            <label for="discounttt" class="col-form-label pb-2"><?php echo display('discount_type');?></label>
                            <select name="discountttch" class="form-control" id="discountttch" onchange="changetype()">
                            <option value="1">Percent(%)</option>
                            <option value="0">Amount</option>
                            </select>
                            </div>
                            
                            
                        </div>
                        <div class="col-md-4">
                        	<div class="form-group">
                             <label for="discount" class="col-form-label pb-2"><?php echo display('discount');?>(<span id="chty"><?php if($settinginfo->discount_type==0){echo $currency->curr_icon;}else{ echo "%";}?></span>)</label>
                             <input type="hidden" id="discounttype" value="<?php echo $settinginfo->discount_type;?>"/>
                             <input type="hidden" id="ordertotal" value="<?php echo $totaldue;?>"/>
                             <input type="hidden" id="orderdue" value="<?php echo $totaldue;?>"/>
                             <input type="number" class="form-control" id="discount"  name="discount" value="" placeholder="0"/>
                             <input type="hidden" id="grandtotal" name="grandtotal" value="<?php echo $totaldue;?>"/>
                             <input type="hidden" id="granddiscount" name="granddiscount" value=""/>
                             <input type="hidden" id="isredeempoint" name="isredeempoint" value=""/> 
                             </div>
                        </div>
                        <div class="col-md-4">
                        	<?php if($pointsys==1 && $membership>1){
								$customerpoints=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$customerid)->get()->row();
								?>
                        	<div class="form-group">
                        	<label for="redempoint" class="col-form-label pb-2 text-left wpr_100 pl-15">Points: <?php echo $customerpoints->points;?></label>
                            <div class="kitchen-tab"><input id="chkbox-red" type="checkbox" class="individual" name="redeemit" value="<?php echo $customerid;?>">
                            <label for="chkbox-red" class="mb-0"> Redeem It? &nbsp;&nbsp;
            				<span class="radio-shape mr-0"> <i class="fa fa-check"></i> </span></label>
                            </div>  
                            </div>
                            <?php } ?>
                            <div class="form-group" style="padding-top:<?php if($pointsys==1 && $membership>1){echo "35px";}else{ echo "28px";}?>">  
                        	<button type="button" id="paymentnow" class="btn btn-success w-md m-b-5" ><?php echo display('payment');?></button>   
                            </div>             	
                        </div>
                    </div>
                    <div id="adddiscount display-none">
                    <div class="row no-gutters">
                        <div class="form-group col-md-6">
                            <label for="payments" class="col-form-label pb-2"><?php echo display('paymd');?></label>
                           
                                 <?php $card_type=4;
                                  echo form_dropdown('paytype[]',$paymentmethod,(!empty($card_type)?$card_type:null),'class="card_typesl postform resizeselect form-control " onchange="showhidecard(this)"') ?>
                          
                        </div>
                       
                       
                        <div class="form-group col-md-6">
                            <label for="4digit" class="col-form-label pb-2"><?php echo display('cuspayment');?></label>
                            
                                  <input type="number"  class="form-control number"  name="paidamount[]" value="<?php echo $totaldue; ?>" onkeyup="changedueamount()"  placeholder="0" onclick="givefocus(this)" />
                          
                        </div>
                    </div>
                    <div class="row no-gutters">
                         <div class="cardarea w-100 no-gutters display-none">
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
                    <div class="row col-md-12 m-0" id="add_new_payment" >
                             
                     </div>
                    <div class="form-group text-right">
                            <div class="col-sm-12 pr-0">
                            <button type="button" id="add_new_payment_type" class="btn btn-success w-md m-b-5" ><?php echo display('add_new_payment_type');?></button>
                            </div>
                        </div>
                    </div>  
                     
                     </div>
                     <div class="col-md-4">
                        <table class="table table-fixed table-bordered table-hover bg-white wpr_100">
                            <tr>
                                <td>
                                    Total Amount
                                </td>
                                <td id="tamount">
                                    <?php echo $totaldue; ?>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    Total Due
                                </td>
                                <td id="due-amount">
                                    <?php echo $totaldue; ?>
                                </td>
                                </tr>
                                <tr>
                                 <td>
                                    Payable amout 
                                </td>
                                <td id="pay-amount" >
                                    0
                                </td>
                            </tr>
                            <tr>
                                 <td>
                                    Change Amount 
                                </td>
                                <td  id="change-amount">
                                   
                                </td>
                            </tr>
                                  
                                </table>

                        <div class="grid-container">
                        <input type="button" class="grid-item" name="n1" value="1" onClick="inputNumbersfocus(n1.value)">
                        <input type="button" class="grid-item" name="n2" value="2" onClick="inputNumbersfocus(n2.value)">
                        <input type="button" class="grid-item" name="n3" value="3" onClick="inputNumbersfocus(n3.value)">
                        <input type="button" class="grid-item" name="n4" value="4" onClick="inputNumbersfocus(n4.value)">
                        <input type="button" class="grid-item" name="n5" value="5" onClick="inputNumbersfocus(n5.value)">
                        <input type="button" class="grid-item" name="n6" value="6" onClick="inputNumbersfocus(n6.value)">
                        <input type="button" class="grid-item" name="n7" value="7" onClick="inputNumbersfocus(n7.value)">
                        <input type="button" class="grid-item" name="n8" value="8" onClick="inputNumbersfocus(n8.value)">
                        <input type="button" class="grid-item" name="n9" value="9" onClick="inputNumbersfocus(n9.value)">                         
                        <input type="button" class="grid-item" name="n0" value="0" onClick="inputNumbersfocus(n0.value)"> 
                        <input type="button" class="grid-item" name="n00" value="00" onClick="inputNumbersfocus(n00.value)"> 
                        <input type="button" class="grid-item" name="c0" value="C" placeholder="0" onClick="inputNumbersfocus(c0.value)">   
                       
                        </div>
                       
                        <div class="form-group text-right mt-3">
                            <div class="col-sm-12 pr-0 mt-15">
                            <button type="button" class="btn btn-success w-md m-b-5" id="paybutton-sub-<?php echo $sub_id; ?>" onclick="submitmultiplepaysub('<?php echo $sub_id; ?>')"><?php echo display('pay_print');?></button>
                            </div>
                        </div>
                     </div>
                     <input type="hidden" id="get-order-id" name="orderid" value="<?php echo $sub_id; ?>">
                </div>  
            </div>
        </div>
    </div>
</div>
</form>      
<input type="hidden" id="get-order-flag" name="orderid" value="1">
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/suborder.js'); ?>" type="text/javascript"></script>
            