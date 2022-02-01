<div class="form-group text-right">
 <?php if($this->permission->method('purchase','create')->access()): ?>
<a href="<?php echo base_url("purchase/purchase/create")?>" class="btn btn-primary btn-md"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo display('purchase_add')?></a> 
<?php endif; ?>

</div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

            <div class="panel-body">
                <table width="100%" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo "Invoice no."; ?></th>
                            <th><?php echo display('supplier_name') ?></th>
                            <th><?php echo display('date') ?></th>
                            <th><?php echo display('price') ?></th>
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($purchaselist)) { ?>
                            <?php $sl = $pagenum+1; ?>
                            <?php foreach ($purchaselist as $items) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><a href="<?php echo base_url("purchase/purchase/purchaseinvoice/$items->purID") ?>"><?php echo $items->invoiceid; ?></a></td>
                                    <td><?php echo $items->supName; ?></td>
                                    <td><?php $originalDate = $items->purchasedate;
									echo $newDate = date("d-M-Y", strtotime($originalDate));
									 ?></td>
                                     <td><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $items->total_price; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                   <td class="center">
                                    <?php if($this->permission->method('setting','update')->access()): ?>
                                    <input name="url" type="hidden" id="url_<?php echo $items->purID; ?>" value="<?php echo base_url("purchase/purchase/updateintfrm") ?>" />
                                        <a href="<?php echo base_url("purchase/purchase/updateintfrm/$items->purID") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         <?php endif; 
										 ?>
                                         
                                         
                                    </td>
                                    
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
                <div class="text-right"><?php echo @$links?></div>
            </div>
        </div>
    </div>
</div>

     
