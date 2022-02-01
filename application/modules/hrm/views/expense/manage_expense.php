        <!-- Manage employee -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_expense') ?></h4>
                        </div>
                     
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <!--<th>id</th>-->
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('type') ?></th>
                                        <th><?php echo display('amount') ?></th>
                                      
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalam = 0;
                                    if ($expense_list) {
                                        foreach ($expense_list as $expense) {
                                            ?>
                                            <tr>
                                           
                                                <td><?php echo $expense['date']; ?></td>
                                                <td>
                                                   
                                                        <?php echo $expense['type'].' Expense'; ?>
                                                   
                                                </td>
                                                <td><?php echo $expense['amount'];
                                          $totalam += $expense['amount'];      
                                                ?></td>
                                              
                                                <td>
                                                    
        <?php if($this->permission->method('hrm','delete')->access()){ ?>
                                                      <a href="<?php echo base_url("hrm/Cexpense/delete_expense/".$expense['voucher_no']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a>
                                                    <?php }?>
                                                    
                                                </td>
                                            </tr>

         
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td><?php echo number_format($totalam,2)?></td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>
                            <div class="text-center"><?php echo $links ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
