        <!-- New expense -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('expense_statement_form') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">

                                 <?php echo form_open('hrm/Cexpense/expense_statement', array('class' => 'form-inline', 'method' => 'get')) ?>
                        <?php
                        $today = date('Y-m-d');
                        ?>
                        <div class="form-group">
                             <label for="expense"><?php echo display('expense_item_name') ?><i class="text-danger">*</i></label>
                           
                              <select class="form-control" name="expense_id">
                                <option value="">Select One</option>
                                <?php foreach($item_list as $expenses){?>
                                  <option value="<?php echo $expenses['expense_item_name']?>"><?php echo $expenses['expense_item_name']?></option>
                              <?php }?>
                              </select>
                           
                        </div>
                        <div class="form-group">
                            <label class="" for="from_date"><?php echo display('start_date') ?></label>
                            <input type="text" name="from_date" class="form-control datepicker5" id="from_date" placeholder="<?php echo display('start_date') ?>" value="<?php echo (!empty($from_date)?$from_date:$today) ?>">
                        </div> 

                        <div class="form-group">
                            <label class="" for="to_date"><?php echo display('end_date') ?></label>
                            <input type="text" name="to_date" class="form-control datepicker5" id="to_date" placeholder="<?php echo display('end_date') ?>" value="<?php echo (!empty($to_date)?$to_date:$today) ?>">
                        </div>  

                        <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                        <a  class="btn btn-warning" href="#" onclick="printDiv('purchase_div')"><?php echo display('print') ?></a>
                        <?php echo form_close() ?>
                
                        
                    </div>
                    
                </div>
            </div>
        </div>


