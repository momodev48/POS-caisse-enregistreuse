<link href="<?php echo base_url('application/modules/report/assets/css/ajaxsalereportitems.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" id="respritbl">
			                        <thead>
										<tr>
											<th><?php echo $name; ?></th>
											<?php if($name=="Items Name"){?>
                                            <th><?php echo "Varient Name"; ?></th>
											<th><?php echo "Quantity"; ?></th>
											<?php }?>
                                            <th><?php echo "Total amount"; ?></th>
											
										</tr>
									</thead>
									<tbody class="ajaxsalereportitems">
									<?php 
									$totalprice=0;
									if($items) { 
										if($name == "Items Name"){
									foreach($items as $item){
										if($item->isgroup==1){
											$isgrouporid="'".implode("','",$allorderid)."'";
											$condition="order_id IN($isgrouporid) AND groupmid=$item->groupmid AND groupvarient=$item->groupvarient";
											$sql="SELECT  DISTINCT(groupmid) as menu_id,qroupqty,isgroup FROM order_menu WHERE {$condition} AND isgroup=1 Group BY order_id";
											$query=$this->db->query($sql);
											$myqtyinfo=$query->result();
											$mqty=0;
											foreach($myqtyinfo as $myqty){
												$mqty=$mqty+$myqty->qroupqty;
											}
											if($item->price>0){
												$itemprice=$item->price;
											}else{
												$itemprice=$item->mprice;
												}
											$itemqty=$mqty;
											$totalprice=$totalprice+($itemqty*$itemprice);
											}
										else{
											if($item->price>0){
												$itemprice=$item->price;
											}else{
												$itemprice=$item->mprice;
												}
											$itemqty=$item->totalqty;
										$totalprice=$totalprice+($item->totalqty*$itemprice);
										}
									?>
											<tr>
																					
                                                <td><?php echo $item->ProductName;?></td>
                                                <td><?php echo $item->variantName;?></td>
												<td><?php echo $itemqty;?></td>
												<td class="order_total"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo ($itemqty*$itemprice);?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												
											</tr>
									<?php }
									}
									else{
										foreach($items as $item){
										$totalprice=$totalprice+$item->totalamount
									?>
											<tr>
																					
                                                <td><?php echo $item->ProductName;?></td>
												
												<td class="total_ammount"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item->totalamount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
												
											</tr>

										<?php 
										} 
									}
									}
									?>
									</tbody>
									<tfoot class="ajaxsalereportitems-footer">
										<tr>
											<td class="ajaxsalereportitems-fo-total-sale" colspan="<?php if($name=="Items Name"){ echo 3;}else{ echo 1;}?>" align="right">&nbsp; <b><?php echo display('total_sale') ?> </b></td>
											<td class="fo-total-sale"><b><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $totalprice;?> <?php if($currency->position==2){echo $currency->curr_icon;}?></b></td>
										</tr>
									</tfoot>
			                    </table>
</div>                                