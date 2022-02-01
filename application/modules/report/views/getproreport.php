<table id="respritbl" class="table table-bordered table-striped table-hover">
			                        <thead>
										<tr>
											<th class="text-center"><?php echo display('item_name') ?></th>
											<th class="text-center"><?php echo display('in_quantity') ?></th>
											<th class="text-center"><?php echo display('out_quantity') ?></th>
											<th class="text-center"><?php echo display('stock') ?></th>
										</tr>
									</thead>
									<tbody>
                                     <?php foreach($allproduct as $stockinfo){?>
									<tr>
											<td><?php echo $stockinfo['ProductName'];?></td>
                                            <td><?php echo $stockinfo['In_Qnty'];?></td>
                                            <td><?php echo $stockinfo['Out_Qnty'];?></td>
                                            <td><?php echo $stockinfo['Stock'];?></td>
                                    </tr>
                                    <?php } ?>
									</tbody>
									
			                    </table>