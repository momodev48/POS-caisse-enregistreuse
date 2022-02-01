<input type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf" />
<table width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('ingredient_name') ?></th>
                            <th><?php echo display('quantity') ?></th>
                            <th><?php echo display('price') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  if($cart = $this->cart->contents()){  ?>
                            <?php $sl = 1; ?>
                            <?php  foreach ($cart as $item){ 
							?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['qty']." ".$item['unit']; ?></td>
                                    <td align="right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item['price']; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>
     
