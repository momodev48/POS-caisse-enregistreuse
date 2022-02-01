
<link href="<?php echo base_url('application/modules/report/assets/css/showcommision.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										 <tr>
				                          
				                           <th><?php echo display('waiter')?></th>
				                           <th><?php echo display('total')?></th>
				                           <th><?php echo display('commission')?></th>
				                           
				                        </tr>
									</thead>
									<tbody>
										
										<?php $totalprice=0;
										foreach ($showcommision as $commission) {
											$totalprice= ($commission->totalamount*$commissionRate->rate/100)+$totalprice;
										?>
										<tr>
											
											<td>
												<?php echo $commission->WaiterName;?>
											</td>
											<td class="text-right">
												<?php echo $commission->totalamount;?>
											</td>
											<td class="text-right">
												<?php echo $commission->totalamount*$commissionRate->rate/100;
													
												?>
											</td>
										</tr>
								<?php }?>
									</tbody>
									<tfoot class="showcommision-foot">
										<tr>
											<td class="showcommision-total-sale" colspan="2" align="right">&nbsp; <b><?php echo display('total_sale').' '.display('commission'); ?> </b></td>
											<td class="showcommision-totalprice"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                