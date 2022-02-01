<link href="<?php echo base_url('application/modules/report/assets/css/ajaxsalereportdelivery.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo $name; ?></th>
                                            <th><?php echo "Total amount"; ?></th>
											
										</tr>
									</thead>
									<tbody class="ajaxsalereportdelivery">
									<?php 
									$totalprice=0;
									$td4 = 0;
									
									if($items) { 
										
									foreach($items as $item){
										$totalprice=$item->totalamount+$totalprice;
									
									if($item->ProductName == 2){
										$td1 = "Pick up";
										$td2 = $item->totalamount; 
									}
									else{
										$td3 = "Dinning";
										$td4 = $td4+$item->totalamount; 
									}

											
									 }
									 if(isset($td1)):
									 	?>
									<tr>
																					
                                                <td><?php echo $td1;?></td>
												
												<td class="order_total"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $td2;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												
											</tr>
										<?php endif; 
										if(isset($td3)):?>
											<tr>
																					
                                                <td><?php echo $td3;?></td>
												
												<td class="total_ammount" ><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $td4;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												
											</tr>
											<?php endif; ?>
											<?php
										
									}
									?>
									</tbody>
									<tfoot class="ajaxsalereportdelivery-footer">
										<tr>
											<td class="ajaxsalereportdelivery-fo-total-sale" colspan="1" align="right">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td class="fo-total-sale"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                