<div class="form-group text-right">
 <?php if($this->permission->method('purchase','create')->access()): ?>
<a href="<?php echo base_url("purchase/purchase/return_form")?>" class="btn btn-primary btn-md"><i class="fa fa-plus-circle" aria-hidden="true"></i>
<?php echo "Add Return";?></a> 
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
                        <?php if (!empty($invoicelist)) { ?>
                            <?php $sl = $pagenum+1; ?>
                            <?php foreach ($invoicelist as $items) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo $items->po_no; ?></td>
                                    <td><?php echo $items->supName; ?></td>
                                    <td><?php $originalDate = $items->return_date;
									echo $newDate = date("d-M-Y", strtotime($originalDate));
									 ?></td>
                                     <td><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $items->totalamount; ?> <?php if($currency->position==2){echo $currency->curr_icon;}?></td>
                                   <td class="center">
                                         <?php if($this->permission->method('purchase','read')->access()): ?>
                                        <a href="<?php echo base_url("purchase/purchase/returnview/$items->preturn_id") ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="right" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                         <?php endif; ?>
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

     
