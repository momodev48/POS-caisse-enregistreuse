<script src="<?php echo base_url('application/modules/hrm/assets/js/hrcommon.js'); ?>" type="text/javascript"></script>
<div id="pr">
    <button onclick="myFunction()"><i class="fa fa-print" aria-hidden="true"></i>
    </button>
</div>


<?php
$total = 0;


foreach ($ab as $ca) {
} ?>



<table class="table table-striped" width="100%">


    <div class="form-group text-center att_reportview-css1">

        <?php echo display('attendance_report') ?>


    </div>
    <div class="row">
        <div class="col-sm-4 text-center">
            <?php echo "<img src='" . base_url() . $ca->picture . "' width=120px; height=120px;>"; ?>
        </div>
        <div class="col-sm-8">

            <div class="form-group text-left att_reportview-css2">

                <?php echo display('name') ?>:<?php



                                                echo $ca->first_name . " " . $ca->last_name; ?>

            </div>
            <div class="form-group text-left att_reportview-css3">

                ID NO: <?php

                        echo $ca->employee_id;


                        ?>
            </div>

            <div class="form-group text-left att_reportview-css3">

                <?php echo display('designation') ?>: <?php echo $ca->pos_id; ?>
            </div>
        </div>
    </div>
</table>
<table class="table table-striped" width="100%">
    <tr>
        <th> <?php echo display('sl') ?></th>
        <th> <?php echo display('date') ?></th>
        <th> <?php echo display('checkin') ?></th>
        <th> <?php echo display('checkout') ?></th>
        <th> <?php echo display('work_hour') ?></th>
    </tr>
    <?php
    $x = 1;
    foreach ($query as $qr) { ?>
    <tr>
        <td><?php echo $x++; ?></td>
        <td><?php echo $qr->date ?></td>
        <td><?php echo $qr->sign_in ?></td>
        <td><?php echo $qr->sign_out ?></td>
        <td><?php echo $qr->staytime ?></td>
    </tr>
    <?php } ?>

</table>