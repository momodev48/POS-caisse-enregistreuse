<!-- Stock report start -->

        <!-- Alert Message -->
        <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <a href="<?php echo base_url('purchase/supplierlist/index') ?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('manage_supplier') ?> </a>

                    <a href="<?php echo base_url('purchase/supplierlist/supplier_ledger_report') ?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('supplier_sales_details') ?> </a>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
                        <?php echo form_open('purchase/supplierlist/supplier_ledger_report', array('class' => '', 'id' => 'validate')) ?>
                        <?php $today = date('Y-m-d'); ?>

                        <div class="form-group row">
                            <label for="supplier_name" class="col-sm-3 col-form-label"><?php echo display('select_supplier') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select name="supplier_id"  class="form-control" required="">
                                    <option value=""></option>
                                    <?php if($supplierlist) { 
									foreach($supplierlist as $supplier){?>
                                        <option value="<?php echo $supplier->supid;?>"><?php echo $supplier->supName;?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>

                    
                        <div class="" id="datebetween">
                            <div class="form-group row">
                                <label for="from_date " class="col-sm-3 col-form-label"> <?php echo display('from') ?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="from_date"  value="<?php echo $today; ?>" class="datepicker form-control" id="from_date"/>
                                </div>
                            </div>      

                            <div class="form-group row">
                                <label for="to_date" class="col-sm-3 col-form-label"> <?php echo display('end_date') ?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="to_date" value="<?php echo $today; ?>" class="datepicker form-control" id="to_date"/>
                                </div>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="details" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6 text-center">
                                <button type="submit" class="btn btn-success "><i class="fa fa-search-plus" aria-hidden="true"></i> <?php echo display('generate') ?></button>
                                <button type="button"  class="btn btn-warning" href="javascript:void(0)" onclick="printDiv('printableArea')"><?php echo display('print') ?></button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Supplier ledger -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('supplier_ledger') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="printableArea" class="supplier_ledger_mr_left">

                            <?php if ($Supplierinfo) { ?>
                                <div class="text-center">
                                    <h3> <?php echo $Supplierinfo->supName; ?> </h3>
                                    <h4><?php echo display('address') ?> : <?php echo $Supplierinfo->supAddress; ?> </h4>
                                    <h4> <?php echo display('print_date') ?>: <?php echo date("d/m/Y h:i:s"); ?> </h4>
                                </div>
                            <?php } ?>

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><?php echo display('date') ?></th>
                                            <th class="text-center"><?php echo display('description') ?></th>
                                            <th class="text-center"><?php echo display('invoice_no') ?></th>
                                            <th class="text-center"><?php echo display('deposite_id') ?></th>
                                            <th class="text-right"><?php echo display('debit') ?></th>
                                            <th class="text-right"><?php echo display('credit') ?></th>
                                            <th class="text-right"><?php echo display('balance') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($supplierledger) {

                                            $sl = 0;
                                            $debit = $credit = $balance = 0;
                                            foreach ($supplierledger as $ledger) {
                                                $sl++;
												$purchaseinfo=$this->db->select("*")->from('purchaseitem')->where('invoiceid',$ledger->transaction_id)->get()->row();
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $ledger->date; ?></td>
                                                    <td><?php echo $ledger->description; ?></td>
                                                    <td><?php if($ledger->chalan_no!='Adjustment '){?><a href="<?php echo base_url(); ?>purchase/purchase/purchaseinvoice/<?php echo (!empty($purchaseinfo->purID)?$purchaseinfo->purID:null); ?>"><?php echo $ledger->chalan_no; ?></a><?php } else{ echo $ledger->chalan_no;}?></td>
                                                    <td><?php echo @$ledger->deposit_no; ?></td>
                                                    <td align="right">
                                                        <?php
                                                        if ($ledger->d_c == 'd') {
                                                            echo (($position == 0) ? "$currency " : " $currency");
                                                            echo number_format($ledger->amount, 2, '.', ',');
                                                            $debit += $ledger->amount;

                                                        } else {
                                                            $debit += '0.00';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align="right">
                                                        <?php
                                                        if ($ledger->d_c == 'c') {
                                                            echo (($position == 0) ? "$currency " : " $currency");
                                                            echo number_format($ledger->amount, 2, '.', ',');
                                                            $credit += $ledger->amount;
                                                        } else {
                                                            $credit += '0.00';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td align='right'>
                                                        <?php
                                                        $balance = $debit - $credit;
                                                        echo (($position == 0) ? "$currency " : " $currency");
                                                        echo number_format($balance, 2, '.', ',');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" align="right"><b><?php echo display('grand_total') ?>:</b></td>
                                            <td align="right"><b><?php
                                                    echo (($position == 0) ? "$currency " : "$currency");
                                                    echo number_format((@$debit), 2, '.', ',');
                                                    ?></b>
                                            </td>
                                            <td align="right"><b><?php
                                                    echo (($position == 0) ? "$currency " : "$currency");
                                                    echo number_format((@$credit), 2, '.', ',');
                                                    ?></b>
                                            </td>
                                            <td align="right"><b><?php
                                                    echo (($position == 0) ? "$currency " : "$currency");
                                                    echo number_format((@$balance), 2, '.', ',');
                                                    ?></b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="text-right"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Supplier Ledger End  -->
<script src="<?php echo base_url('application/modules/purchase/assets/js/supplier_ledger_script.js'); ?>" type="text/javascript"></script>

