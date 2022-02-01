 <div class="form-group text-right">
     <?php if ($this->permission->method('hrm', 'create')->access()) : ?>
     <button type="button" class="btn btn-primary btn-md" data-target="#add0" data-toggle="modal"><i
             class="fa fa-plus-circle" aria-hidden="true"></i>
         <?php echo display('add_salary_setup') ?></button>
     <?php endif; ?>
     <?php if ($this->permission->method('hrm', 'read')->access()) : ?>
     <a href="<?php echo base_url(); ?>hrm/Payroll/salary_setup_view"
         class="btn btn-primary"><?php echo display('manage_salary_setup') ?></a>
     <?php endif; ?>
 </div>


 <div id="add0" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <strong><?php echo display('salary_setup') ?></strong>
             </div>
             <div class="modal-body">


                 <div class="row">
                     <div class="col-sm-12 col-md-12">
                         <div class="panel">

                             <div class="panel-body">

                                 <?php echo  form_open('hrm/Payroll/create_s_setup') ?>
                                 <div class="form-group row">
                                     <label for="employee_id"
                                         class="col-sm-3 col-form-label"><?php echo display('employee_name') ?>
                                         *</label>
                                     <div class="col-sm-9">
                                         <?php echo form_dropdown('employee_id', $employee, null, 'class="form-control width-615-px" id="employee_id" onchange="employechange(this.value)"') ?>
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="payment_period"
                                         class="col-sm-3 col-form-label"><?php echo display('salary_type_id') ?>
                                         *</label>
                                     <div class="col-sm-9">
                                         <input type="text" class="form-control" name="sal_type_name" id="sal_type_name"
                                             readonly="">
                                         <input type="hidden" class="form-control" name="sal_type" id="sal_type">
                                     </div>
                                 </div>
                                 <table border="1" width="100%">
                                     <div class="row">

                                         <td class="col-sm-6 text-center">
                                             <h4 class="salary-setup-form-css1">
                                                 <?php echo display('addition') ?></h4><br>
                                             <table id="add">
                                                 <tr>
                                                     <th class="padding-10-px"><?php echo display('basic') ?></th>
                                                     <td><input type="text" id="basic" name="basic" class="form-control"
                                                             disabled=""></td>
                                                 </tr>
                                                 <?php
                          $x = 0;
                          foreach ($slname as $ab) {
                          ?>
                                                 <tr>
                                                     <th class="padding-10-px"><?php echo $ab->sal_name; ?>(%)</th>
                                                     <td><input type="text"
                                                             name="amount[<?php echo $ab->salary_type_id; ?>]"
                                                             class="form-control addamount" onkeyup="summary()"
                                                             id="add_<?php echo $x; ?>"></td>
                                                 </tr>
                                                 <?php
                            $x++;
                          }
                          ?>
                                             </table>
                                         </td>
                                         <td class="col-sm-6 text-center">
                                             <h4 class="salary-setup-form-css2">
                                                 <?php echo display('deduction') ?></h4><br>
                                             <table id="dduct">
                                                 <?php
                          $y = 0;
                          foreach ($sldname as $row) {
                          ?>
                                                 <tr>
                                                     <th class="padding-10-px"><?php echo $row->sal_name; ?> (%)</th>
                                                     <td><input type="text"
                                                             name="amount[<?php echo $row->salary_type_id; ?>]"
                                                             onkeyup="summary()" class="form-control deducamount"
                                                             id="dd_<?php echo $y; ?>"></td>
                                                 </tr><?php
                                $y++;
                              }
                                ?>
                                                 <tr>
                                                     <th class="padding-10-px"><?php echo display('tax') ?> (%)</th>
                                                     <td><input type="text" name="amount[]" onkeyup="summary()"
                                                             class="form-control deducamount" id="taxinput"></td>
                                                     <td class="padding-10-px"><input type="checkbox" name="tax_manager"
                                                             id="taxmanager" onchange='handletax(this);' value="1">Tax
                                                         Manager</td>
                                                 </tr>

                                             </table>

                                         </td>

                                     </div>

                                 </table>
                             </div>
                             <div class="form-group row">
                                 <label for="payable"
                                     class="col-sm-3 col-form-label text-center"><?php echo display('gross_salary') ?></label>
                                 <div class="col-sm-9">
                                     <input type="text" class="form-control" name="gross_salary" id="grsalary"
                                         readonly="">
                                 </div>
                             </div>

                             <div class="form-group text-right">
                                 <button type="reset"
                                     class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                 <button type="submit"
                                     class="btn btn-success w-md m-b-5"><?php echo display('set') ?></button>
                             </div>
                             <?php echo form_close() ?>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <!--  table area -->
     <div class="col-sm-12">

         <div class="panel panel-default thumbnail">

             <div class="panel-body">
                 <table width="100%" class="datatable table table-striped table-bordered table-hover">
                     <thead>
                         <tr>
                             <th><?php echo display('cid') ?></th>
                             <th>Employee Name</th>
                             <th><?php echo display('employee_id') ?></th>
                             <th><?php echo display('sal_type') ?></th>
                             <th>Date</th>

                         </tr>
                     </thead>
                     <tbody>
                         <?php if (!empty($emp_sl_setup)) { ?>
                         <?php $sl = 1; ?>
                         <?php foreach ($emp_sl_setup as $que) { ?>
                         <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                             <td><?php echo $sl; ?></td>
                             <td><?php echo $que->first_name . ' ' . $que->last_name; ?></td>
                             <td><?php echo $que->employee_id; ?></td>
                             <td><?php echo $que->sal_type; ?></td>
                             <td><?php echo $que->create_date; ?></td>
                         </tr>
                         <?php $sl++; ?>
                         <?php } ?>
                         <?php } ?>
                     </tbody>
                 </table> <!-- /.table-responsive -->
             </div>
         </div>
     </div>
 </div>
<script src="<?php echo base_url('application/modules/hrm/assets/js/salarysetup.js'); ?>" type="text/javascript"></script>