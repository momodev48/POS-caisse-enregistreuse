        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_expense_item') ?></h4>
                        </div>
                     
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('expense_item_name') ?></th>
                                    <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($expense_item_list) {
                                        $sl=1;
                                        foreach ($expense_item_list as $expense) {
                                            ?>
                                            <tr>
                                            <td><?php echo $sl;?></td>
                                            <td><?php echo $expense['expense_item_name']; ?></td>
                                                <td>
                                                    
                                        <a href="<?php echo base_url("hrm/Cexpense/delete_expense_item/".$expense['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
                                                   
                                                    
                                                </td>
                                            </tr>

         
                                            <?php $sl++;
                                        }
                                    }else{
                                    ?>
                                    <tr><td colspan="3" class="text-center"> No Record Found </td></tr>
                                <?php } ?>
                                </tbody>

                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
