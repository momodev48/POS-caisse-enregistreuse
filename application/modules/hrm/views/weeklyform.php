   <div id="add0" class="modal fade" role="dialog">
       <div class="modal-dialog modal-md">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <strong><?php echo display('weekly_holiday') ?></strong>
               </div>
               <div class="modal-body">


                   <div class="row">
                       <div class="col-sm-12 col-md-12">
                           <div class="panel">
                               <div class="panel-heading">
                                   <div class="panel-title">

                                   </div>
                               </div>
                               <div class="panel-body">

                                   <?php echo  form_open('hrm/Leave/create_weekleave') ?>



                                   <div class="form-group row">

                                       <label for="dayname" class="col-sm-12 col-form-label weeklyform-css1">Select
                                           Weekly Leave Day</label>
                                   </div>
                                   <div class="form-group row">
                                       <div class="col-sm-12 font-size-25">
                                           <ul class="weeklyform-css2">
                                               <li>
                                                   <input type="checkbox" name="dayname[]" value="Friday"
                                                       checked="checked"> Friday
                                               </li>
                                               <li>
                                                   <input type="checkbox" name="dayname[]" checked="checked"
                                                       value="Satarday"> Satarday
                                               </li>
                                               <li>
                                                   <input type="checkbox" checked="checked" name="dayname[]"
                                                       value="Sunday"> Sunday
                                               </li>
                                           </ul>

                                       </div>
                                   </div>



                                   <div class="form-group text-right">
                                       <button type="reset"
                                           class="btn btn-primary w-md m-b-5"><?php echo display('reset') ?></button>
                                       <button type="submit"
                                           class="btn btn-success w-md m-b-5"><?php echo display('ad') ?></button>
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

   <div class="row">
       <!--  table area -->
       <div class="col-sm-12">

           <div class="panel panel-default thumbnail">

               <div class="panel-body">
                   <table width="100%" class="datatable table table-striped table-bordered table-hover">
                       <thead>
                           <tr>
                               <th><?php echo display('Sl') ?></th>
                               <th><?php echo display('dayname') ?></th>

                               <th><?php echo display('action') ?></th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php if (!empty($weeklev)) { ?>
                           <?php $sl = 1; ?>
                           <?php foreach ($weeklev as $que) { ?>
                           <tr class="<?php echo ($sl & 1) ? "odd gradeX" : "even gradeC" ?>">
                               <td><?php echo $sl; ?></td>
                               <td><?php echo $que->dayname; ?></td>

                               <td class="center">
                                   <a href="<?php echo base_url("hrm/Leave/update_weekleave_form/$que->wk_id") ?>"
                                       class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>

                               </td>
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