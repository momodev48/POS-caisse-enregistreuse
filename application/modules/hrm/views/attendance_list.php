<script src="<?php echo base_url('assets/js/jquery-ui.min.js');?>" type="text/javascript"></script>
<div class="form-group text-right">

    <?php
    $add0 = array(
        'type' => 'button',
        'class' => "btn btn-primary btn-md",
        'data-target' => "#add0",
        'data-toggle' => "modal",
        'value' => 'Report By Date',
        'style' => 'align="center";'
    );
    $add = array(
        'type' => 'button',
        'class' => "btn btn-primary btn-md",
        'data-target' => "#add",
        'data-toggle' => "modal",
        'value' => ' Report By Id',
        'style' => 'align="center";'
    );
    $add3 = array(
        'type' => 'button',
        'class' => "btn btn-primary btn-md",
        'data-target' => "#add2",
        'data-toggle' => "modal",
        'value' => 'Report By Date & Time',
        'style' => 'align="center";'
    );
    echo form_input($add0);

    echo form_input($add);
    echo form_input($add3);


    ?>
</div>
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail">

            <div class="panel-body">

                <table width="100%" class="datatable table table-striped table-bordered table-hover example">
                    <caption>Report view</caption>
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Date</th>
                            <th>SignIn</th>
                            <th>SignOut</th>
                            <th>Stay</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($addressbook)) : ?>

                        
                        <?php $sl = 1; ?>
                        <?php foreach ($addressbook as $row) : ?>
                        <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                            <td><?php echo $row['employee_id']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['sign_in']; ?></td>
                            <td><?php echo $row['sign_out']; ?></td>
                            <td><?php echo $row['staytime']; ?></td>

                        </tr>
                        <?php $sl++; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>


                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>

<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong> Report By Id</strong>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4><?php echo display('attendance_report') ?></h4>
                                </div>
                            </div>
                            <div class="panel-body">

                                <?php echo  form_open('hrm/Home/AtnReport_view', 'name="myForm"') ?>

                                <div class="form-group row">
                                    <label for="employee_id"
                                        class="col-sm-3 col-form-label"><?php echo display('employee_id') ?> *</label>
                                    <div class="col-sm-9">
                                        <input name="employee_id" class="form-control" type="text" placeholder="<?php echo display('employee_id_se') ?>" id="employee_id" onblur="check_if_exists();">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date"
                                        class="col-sm-3 col-form-label"><?php echo display('start_date') ?> *</label>
                                    <div class="col-sm-9">
                  <input name="s_date" class="datepicker form-control" type="text" placeholder="<?php echo display('start_date') ?>" id="a_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date"
                                        class="col-sm-3 col-form-label"><?php echo display('end_date') ?> *</label>
                                    <div class="col-sm-9">
                                        <input name="e_date" class="datepicker form-control" type="text" placeholder="<?php echo display('end_date') ?>" id="b_date">
                                    </div>
                                </div>


                                <div class="form-group text-right">
                                    <button type="submit"
                                        class="btn btn-success w-md m-b-5"><?php echo display('request') ?></button>
                                </div>
                                <?php echo form_close() ?>

                            </div>

                        </div>
                    </div>
                </div>



            </div>

        </div>
        <div class="modal-footer">

        </div>

    </div>

</div>



<div id="add0" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('attendance_report') ?></strong>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4><?php echo display('attendance_report') ?></h4>
                                </div>
                            </div>
                            <div class="panel-body">

                                <?php echo  form_open('hrm/Home/report_view') ?>

                                <div class="form-group row">
                                    <label for="date"
                                        class="col-sm-3 col-form-label"><?php echo display('start_date') ?> *</label>
                                    <div class="col-sm-9">
                                        <input name="start_date" class="datepicker form-control" type="text" placeholder="<?php echo display('start_date') ?>" id="start_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date"
                                        class="col-sm-3 col-form-label"><?php echo display('end_date') ?> *</label>
                                    <div class="col-sm-9">
                                        <input name="end_date" class="datepicker form-control" type="text" placeholder="<?php echo display('end_date') ?>" id="end_date">
                                    </div>
                                </div>


                                <div class="form-group text-right">
                                    <button type="submit"
                                        class="btn btn-success w-md m-b-5"><?php echo display('request') ?></button>
                                </div>
                                <?php echo form_close() ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<div id="add2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong><?php echo display('attendance_report') ?></strong>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4><?php echo display('attendance_report') ?></h4>
                                </div>
                            </div>
                            <div class="panel-body">

                                <?php echo  form_open('hrm/Home/AtnTimeReport_view', 'name="myForm"') ?>

                                <div class="form-group row">
                                    <label for="date" class="col-sm-3 col-form-label"><?php echo display('date') ?>
                                        *</label>
                                    <div class="col-sm-9">
                                        <input name="date" class="datepicker form-control " type="text"
                                            placeholder="<?php

                                                                                                                        echo display('date') ?>" id="c_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="s_time" class="col-sm-3 col-form-label"><?php echo display('s_time') ?>
                                        *</label>
                                    <div class="col-sm-9">
                                        <input name="s_time" class="timepicker form-control" type="text"
                                            placeholder="<?php

                                                                                                                        echo display('s_time') ?>" id="s_time">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="e_time" class="col-sm-3 col-form-label"><?php echo display('e_time') ?>
                                        *</label>
                                    <div class="col-sm-9">
                                        <input name="e_time" class="timepicker form-control" type="text"
                                            placeholder="<?php
                                                                                                                        echo display('e_time') ?>" id="e_time">
                                    </div>
                                </div>


                                <div class="form-group text-right">
                                    <button type="submit"
                                        class="btn btn-success w-md m-b-5"><?php echo display('request') ?></button>
                                </div>
                                <?php echo form_close() ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

<script src="<?php echo base_url('application/modules/hrm/assets/js/attendnesslist.js'); ?>" type="text/javascript"></script>