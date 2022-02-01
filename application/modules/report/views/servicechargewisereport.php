
<link href="<?php echo base_url('application/modules/report/assets/css/servicechargewisereport.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo $name; ?></th>
                                            <th><?php echo "Service Charge"; ?></th>
											
										</tr>
									</thead>
									<tbody class="servicechargewisereport">
									<?php 
									$totalprice=0;
									foreach($allservicecharge as $servicecharge){	
											$totalprice=$servicecharge->service_charge+$totalprice;					
									?>
											<tr>
																					
                                                <td><?php echo $servicecharge->orderid;?></td>
												
												<td class="service_charge"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $servicecharge->service_charge;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												
											</tr>
                                            <?php } ?>

								
									</tbody>
									<tfoot class="servicechargewisereport-foter">
										<tr>
											<td class="total_sale" colspan="1" align="right">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td class="totalprice"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                