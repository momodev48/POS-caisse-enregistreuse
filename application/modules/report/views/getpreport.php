<link href="<?php echo base_url('application/modules/report/assets/css/getpreport.css'); ?>" rel="stylesheet" type="text/css"/>

<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo "Purchase Date"; ?></th>
											<th><?php echo "Invoice no."; ?></th>
											<th><?php echo display('supplier_name') ?></th>
											<th><?php echo display('total_ammount') ?></th>
										</tr>
									</thead>
									<tbody class="getpreport">
									<?php 
									$totalprice=0;
									if($preport) { 
									foreach($preport as $pitem){
										$totalprice=$totalprice+$pitem->total_price;
									?>
											<tr>
												<td><?php $originalDate = $pitem->purchasedate;
									echo $newDate = date("d-M-Y", strtotime($originalDate));
									 ?></td>
												<td>
													<?php echo $pitem->invoiceid;?>
												</td>
												<td><?php echo $pitem->supName;?></td>
												<td class="total_ammount"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $pitem->total_price;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
											</tr>
									<?php } 
									}
									?>
									</tbody>
									<tfoot  class="getpreport-footer">
										<tr>
											<td class="total_purchase" colspan="3" align="right">&nbsp; <b><?php echo display('total_purchase') ?> </b></td>
											<td class="totalprice"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>