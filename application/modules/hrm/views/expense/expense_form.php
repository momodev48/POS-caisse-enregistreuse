<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                        <?php echo display('add_expense') ?>
                    </h4>
                </div>
            </div>
            <div class="panel-body">
                <?php echo  form_open_multipart('hrm/Cexpense/create_expense') ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?>
                                <i class="text-danger">*</i>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker5"
                                    value="<?php echo date('Y-m-d'); ?>">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" id="payment_from_1">
                        <div class="form-group row">
                            <label for="expense_type" class="col-sm-4 col-form-label"><?php
                                                                                        echo display('expense_type');
                                                                                        ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <select name="expense_type" class="form-control" required="">
                                    <option value="">Select Expense Type</option>
                                    <?php foreach ($expense_item as $item) { ?>
                                    <option value="<?php echo $item['expense_item_name'] ?>">
                                        <?php echo $item['expense_item_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12" id="payment_from_1">
                        <div class="form-group row">
                            <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                                                                        echo display('payment_type');
                                                                                        ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <select name="paytype" class="form-control" id="paytype"
                                    onchange="bank_paymet(this.value)" required="">
                                    <option value="">Select Payment Option</option>
                                    <option value="1">Cash Payment</option>
                                    <option value="2">Bank Payment</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 display-none" id="bank_div">
                        <div class="form-group row">
                            <label for="payment_type" class="col-sm-4 col-form-label"><?php
                                                                                        echo display('bank_name');
                                                                                        ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <select name="bank_id" class="form-control width-100" id="bank">
                                    <option value="">Select Payment Option</option>
                                    <?php foreach ($bank_list as $banks) { ?>
                                    <option value="<?php echo $banks['bankid'] ?>"><?php echo $banks['bank_name'] ?>
                                    </option>
                                    <?php } ?>

                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12" id="payment_from_1">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('amount') ?><i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <input type="text" name="amount" id="amount" class="form-control" required="">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label for="action" class="col-sm-4 col-form-label">&nbsp;</label>
                            <div class="col-sm-8">
                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save"
                                    value="<?php echo display('save') ?>" tabindex="9" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url('application/modules/hrm/assets/js/expense.js'); ?>" type="text/javascript"></script>