
<link href="<?php echo base_url('application/modules/report/assets/css/ajaxsalereportunpaid.css'); ?>" rel="stylesheet" type="text/css"/>    
    
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th class="text-center"><?php echo $name; ?></th>
                                            <th class="text-center"><?php echo "Total amount"; ?></th>
                                            <th class="text-center"><?php echo display('action');?><button class="btn btn-success pull-right" onclick="mergeorderlist()">Merge Order</button></th> 
											
										</tr>
									</thead>
									<tbody class="ajaxsalereportunpaid">
									<?php 
									$totalprice=0;
									
									if($items) { 
									foreach($items as $item){
										
									?>
								
											<tr>
																					
                                                <td class="order_id"><?php  echo $item->order_id;?></td>
												
												<td class="total_amount"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo ($item->totalamount);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												  <td class="margeorder"><div class="pull-right kitchen-tab">
                                                    <input id='chkbox-<?php echo $item->order_id;?>' type='checkbox' class="individual" name="margeorder" value="<?php echo $item->order_id;?>"/>
                                                <label for='chkbox-<?php echo $item->order_id;?>'>
                                                
                                                    <span class="radio-shape">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    
                                                </label>
                                                    </div> </td>
											</tr>
									<?php 
									
									$totalprice=$totalprice+$item->totalamount;
									}
									
									}
									
									?>
									</tbody>
									<tfoot class="ajaxsalereportunpaid-footer">
										<tr>
											<td class="ajaxsalereportunpaid-fo-total-sale" colspan="1"  align="right">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td class="fo-total-sale"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                