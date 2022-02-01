<link href="<?php echo base_url('application/modules/report/assets/css/kicanwiseReport.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo $name; ?></th>
                                            <th><?php echo "Total amount"; ?></th>
											
										</tr>
									</thead>
									<tbody class="kicanwisereport">
									<?php 
									$totalprice=0;
										foreach ($items as $item) {
																				# code...
																											
									?>
											<tr>
																					
                                                <td><?php echo $item['kiname'];?></td>
												
												<td class="kicanwisereport-head-cell"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item['totalprice'];?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												
											</tr>

								<?php $totalprice = $totalprice+$item['totalprice'];  } ?>
									</tbody>
									<tfoot class="kicanwisereport-foot">
											<tr>
											<td class="kicanwisereport-first-cell" colspan="1" align="right">&nbsp; <b><?php echo display('subtotal') ?> </b></td>
											<td class="kicanwisereport-sec-cell"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($totalprice,3);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
										<tr>
											<td class="kicanwisereport-first-cell" colspan="1" align="right">&nbsp; <b><?php echo "Service Charge+VAT" ?> </b></td>
											<td class="kicanwisereport-sec-cell"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($vatsd,3);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
										<tr>
											<td class="kicanwisereport-first-cell" colspan="1" align="right">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td class="kicanwisereport-sec-cell"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo number_format($totalprice+$vatsd,3);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                