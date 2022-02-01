<link href="<?php echo base_url('application/modules/hrm/assets/css/loan_report_style.css') ?>" rel="stylesheet"
    type="text/css" />
<?php
$total = 0;

?>

<table class="table table-striped" width="100%">

    <div class="form-group text-center loanreport-css1">
        <?php echo display('loan_report') ?>

    </div>
    <div class="row">
        <span class="form-group text-center col-sm-5">
            <?php
            echo img($emp->picture); ?>
        </span>
        <div class="col-sm-7">
            <div class="form-group text-left loanreport-css2">

                <?php echo display('name'); ?>:<?php
                                                echo $emp->first_name . " " . $emp->last_name; ?>
            </div>

            <div class="form-group text-left loanreport-css3">

                ID NO: <?php

                        echo $emp->employee_id;

                        ?>
            </div>
            <div class="form-group text-left loanreport-css3">

                <?php echo display('designation'); ?>: <?php
                                                        echo $emp->position_name;

                                                        ?>
            </div>
        </div>
    </div>

</table>
<table class="table table-striped" width="100%">
    <tr>
        <th><?php echo display('sl'); ?></th>
        <th><?php echo display('loan_issue_id'); ?></th>
        <th><?php echo display('date'); ?></th>
        <th><?php echo display('amount'); ?></th>
        <th><?php echo display('repayment'); ?></th>
        <th><?php echo display('installment'); ?></th>
    </tr>
    <?php
    $x = 1;
    foreach ($ab as $qr) { ?>
    <tr>
        <td><?php echo $x++; ?></td>
        <td><a href="<?php echo base_url("hrm/Loan/details_view/$qr->loan_id"); ?>"><?php echo $qr->loan_id ?></a></td>
        <td><?php echo $qr->date_of_approve ?></td>
        <td><?php echo $qr->amount ?>$</td>
        <td><?php echo $qr->repayment_amount ?>$</td>
        <td><?php echo $qr->installment ?>$</td>
    </tr>
    <?php } ?>

</table>

<script src="<?php echo base_url('application/modules/hrm/assets/js/loan.js'); ?>" type="text/javascript"></script>