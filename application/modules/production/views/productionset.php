<!-- work of this file -->
<div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel">
               
                <div class="panel-body">
                   
                    <fieldset class="border p-2">
                       <legend  class="w-auto"><?php echo display('production_set') ?></legend>
                    </fieldset>
                    <div class="row">
                             <div class="col-sm-8">
                               <div class="form-group row">
                                    <div class="col-sm-10">
                                     <strong><?php echo display('production_set_for') ?></strong> <?php echo $productioninfo->ProductName;?>
                                    </div>
                                </div> 
                            </div>
                             
                        </div>
                     <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                            <th class="text-center"><?php echo display('qty') ?></th>
                                             <th class="text-center"><?php echo display('price');?></th>
                                        </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                <?php $i=0;
                                $totalcost=0;
								foreach($iteminfo as $item){
									$i++;
                                    $totalcost = $item->uprice*$item->qty+$totalcost;
									?>
                                    <tr>
                                        <td class="text-center"><?php echo $item->ingredient_name;?></td>
                                            <td class="text-right"><?php echo $item->qty." ".$item->uom_short_code;?></td>
                                            <td class="text-right"><?php echo number_format($item->uprice*$item->qty,3);?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                        <tr>
                                            <td colspan="2" align="right"  class="productionset_right">&nbsp; <b><?php echo display('total');?> </b></td>
                                            <td  class="text-right"><b><?php echo $totalcost; //total?> </b></td>
                                        </tr>
                                    </tfoot>
                                
                            </table>
                     
                </div> 
            </div>
        </div>
    </div>
