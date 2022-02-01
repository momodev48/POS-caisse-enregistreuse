<link href="<?php echo base_url('application/modules/report/assets/css/salebydate.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo display('date'); ?></th>
                                            <th><?php echo display('item_name')?></th>
											<th><?php echo display('varient_name')?></th>
                                            <th><?php echo display('quantity'); ?></th>
                                            <th><?php echo display('price'); ?></th>
											<th><?php echo display('total_ammount'); ?></th>
										</tr>
									</thead>
									<tbody class="salebydate">
									<?php 
									$totalprice=0;
									if($preport) { 
									foreach($preport as $pitem){
										if($pitem->isgroup==1){
											
											$condition="$daterange AND order_menu.groupmid=$pitem->groupmid AND order_menu.groupvarient=$pitem->groupvarient";
											$sql="SELECT  DISTINCT(order_menu.groupmid) as menu_id,order_menu.qroupqty,order_menu.isgroup,customer_order.order_date FROM order_menu LEFT JOIN customer_order ON customer_order.order_id=order_menu.order_id WHERE {$condition} AND order_menu.isgroup=1 Group BY order_menu.order_id";
											$query=$this->db->query($sql);
											$myqtyinfo=$query->result();
											$mqty=0;
											foreach($myqtyinfo as $myqty){
												$mqty=$mqty+$myqty->qroupqty;
											}
											if($pitem->price>0){
												$itemprice=$pitem->price;
											}else{
												$itemprice=$pitem->mprice;
												}
											$itemqty=$mqty;
											$totalprice=$totalprice+($itemqty*$itemprice);
											}
										else{
											if($pitem->price>0){
												$itemprice=$pitem->price;
											}else{
												$itemprice=$pitem->mprice;
												}
											$itemqty=$pitem->qty;
										$totalprice=$totalprice+($pitem->qty*$itemprice);
										}
										
									?>
											<tr>
												<td><?php $originalDate = $pitem->order_date;
									echo $newDate = date("d-M-Y", strtotime($originalDate));
									 ?></td>
												<td><?php echo $pitem->ProductName;?></td>
                                                <td><?php echo $pitem->variantName;?></td>
												<td><?php echo $itemqty;?></td>
												<td class="order-total"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                                <td class="total_ammount"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $itemprice*$itemqty;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
											</tr>
									<?php } 
									}
									?>
									</tbody>
									<tfoot class="salebydate-footer">
										<tr>
											<td class="total_sale" colspan="5" align="right">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td class="totalprice"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                