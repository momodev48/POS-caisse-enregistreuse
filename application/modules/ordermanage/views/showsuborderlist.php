<div class="modal-content">
            
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo display('split_order');?></h4>
                    </div>
         
            <div class="modal-body editinfo"><div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
			                        <thead>
										<tr>
											<th class="text-center"><?php echo display('invoice');?> </th>
                                            <th class="text-center"><?php echo display('customer_name');?></th>
											<th class="text-right"><?php echo display('amount');?></th>
                                                <th class="text-center"><?php echo display('action');?></th>
											
										</tr>
									</thead>
									<tbody>
										<?php foreach($suborder_info as $item){
											$total= $item->s_charge+$item->vat+$item->total_price;
											?>

											<tr>
												<td><?php echo $item->sub_id;?></td>
												<td><?php echo $item->customer_name;?></td>
                                                <td><?php echo $total?></td>
												<td><a href="javascript:;" onclick="possubpageprint('<?php echo $item->sub_id; ?>')" class="btn btn-xs btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="left" title="" data-original-title="Pos Invoice"><i class="fa fa-window-maximize"></i></a></td>
												
											</tr>
										<?php }?>
																				
																		</tbody>
									
			                    </table>
</div>                                </div>
     
            </div>