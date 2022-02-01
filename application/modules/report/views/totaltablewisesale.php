
<link href="<?php echo base_url('application/modules/report/assets/css/totaltablewisesale.css'); ?>" rel="stylesheet" type="text/css"/>

<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										 <tr>
				                          
				                           <th><?php echo display('table')?></th>
				                           <th><?php echo display('total')?></th>
				                           <th><?php echo display('view')?></th>
				                        </tr>
									</thead>
									<tbody>
										
										<?php $totalprice=0;
										foreach ($showcommision as $commission) {
											$totalprice= $commission->totalamount+$totalprice;
										?>
									
										<tr>
												
											<td>
												<a href="<?php echo base_url('report/reports/payroll_commission/').$commission->tableid?>"><?php echo $commission->tablename;?></a>
											</td>
											<td class="text-right">
												<?php echo $commission->totalamount;
													
												?>
											</td>
											<td>  <a  href="<?php echo base_url('report/reports/payroll_commission/').$commission->tableid?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" title="<?php echo display('view').' '.display('commission') ?>"><i class="fa fa-window-maximize" aria-hidden="true"></i></a> </td>
										</tr>
								<?php }?>
									</tbody>
									<tfoot class="totaltablewisesale-foot">
										<tr>
											<td class="total_sale" colspan="1" align="right">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td class="totalprice"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                