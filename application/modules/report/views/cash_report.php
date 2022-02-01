
<link href="<?php echo base_url('application/modules/report/assets/css/cash_report.css'); ?>" rel="stylesheet" type="text/css"/>        
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo display('sl');?></th>
                                            <th><?php echo display('date');?></th>
                                            <th><?php echo display('user');?></th>
                                            <th><?php echo display('counter_no');?></th>
                                            <th><?php echo display('opening_balance');?></th>
                                            <th><?php echo display('closing_balance');?></th>
                                            <th><?php echo display('action');?></th>
											
										</tr>
									</thead>
									<tbody>
									<?php 
									$totalopen=0;
									$totalclose=0;
									$i=0;
										foreach ($cashreport as $item) {
										$i++;																											
									?>
											<tr>
																					
                                                <td><?php echo $i;?></td>
                                                <td><?php echo $item->openclosedate;?></td>
                                                <td><?php echo $item->firstname.' '.$item->lastname;?></td>
                                                <td><?php echo $item->counter_no;?></td>
                                                <td align="right"><?php echo $item->opening_balance;?></td>
                                                <td align="right"><?php echo $item->closing_balance;?></td>
                                                <td><a href="javascript:;" onclick="detailscash('<?php echo $item->opendate;?>','<?php echo $item->closedate;?>',<?php echo $item->userid;?>)" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Details"><i class="fa fa-eye"></i></a></td>
											</tr>

								<?php $totalopen = $totalopen+$item->opening_balance;  
								$totalclose = $totalclose+$item->closing_balance;
								} ?>
									</tbody>
									<tfoot class="cash-report-footer">
											<tr>
											<td class="cash-report-total" colspan="4" align="right">&nbsp; <b><?php echo display('total') ?> </b></td>
											<td class="cash-totalopen"><b> <?php echo number_format($totalopen,3);?></b></td>
                                            <td class="cash-totalclose"><b> <?php echo number_format($totalclose,3);?></b></td>
                                            <td>&nbsp;</td>
										</tr>
									</tfoot>
			                    </table>
</div>                                