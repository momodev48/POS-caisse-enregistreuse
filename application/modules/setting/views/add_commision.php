<div class="row">
    <!--  table area -->
    <div class="col-sm-12">

        <div class="panel panel-default thumbnail"> 

          <div class="panel-body">
            <div class="table_content table_contentpost" >
              <div class="table_content_booking"> <span class="table_booking_header"><?php
                           echo display('payroll')."&nbsp"; echo display('commission')."&nbsp"; echo display('setting'); ?>
             </span>
                <div class="row" id="showcom">
                    <div class="form-group text-right">
                     <button type="button" class="btn btn-primary btn-md" onclick="showcom()"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <?php
                           echo display('payroll')."&nbsp"; echo display('commission')."&nbsp"; echo display('setting'); ?>
                   </button> 

                  </div>
                   </div>
              
              <div class="row" id="availabletable">
                       
                <!--  table area -->
                <div class="col-sm-12">
                    <?php
                    if (!empty($commissions)) {
                             $sl = 1; 
                           ?>
                <table width="100%" class="datatable2 table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo display('Sl') ?></th>
                            <th><?php echo display('position')?></th>
                            <th><?php echo display('commission')?></th>
                            
                           
                            <th><?php echo display('action') ?></th> 
                           
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($commissions as $commission) 
                      {
                        ?>
                        <tr>
                          <td>
                            <?php 
                            echo $sl;
                            ?>
                          </td>
                          <td>
                            <?php 
                            echo $commission->position_name;
                            ?>
                          </td>
                          <td>
                            <?php 
                             echo $commission->rate.'%';
                            ?>
                          </td>
                            <td class="center">
                                    
                                 
                                        <a onclick="showcom('<?php echo $commission->id; ?>')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                         
                                        <a href="<?php echo base_url("hrm/payroll/delete/$commission->id") ?>" onclick="return confirm('<?php echo display("are_you_sure") ?>')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="fa fa-trash-o" aria-hidden="true"></i></a>  
                                       
                                    </td>
                        </tr>
                        <?php
                        $sl++; 
                        }
                      }
                      ?>
                        
                    </tbody>
                </table>  <!-- /.table-responsive -->
                
                
            </div>
          </div>
                 
              </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/setting/assets/js/add_commision_script.js'); ?>" type="text/javascript"></script>
