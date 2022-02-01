<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>

                    </h4>
                </div>
            </div>
            <div class="panel-body">

                <div class="row" id="">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="sales_date" placeholder="<?php echo display('date') ?>" class="datepicker form-control serach_date">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5" id="btnSerach"><?php echo display('find') ?></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
                <div class="">
                    <table class="datatable2 table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th><?php echo display('voucher_no') ?></th>
                            <th><?php echo display('remarks') ?></th>
                            <th><?php echo display('amount') ?></th>
                            <th><?php echo display('date') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                     <?php
                     $date=date('Y-m-d');
                     ?>
                              <tr id="show_vouchar">
                                  <td>
                                     <a href="<?php echo base_url("accounts/accounts/vouchar_cash/".$date) ?>">
                                          <?php echo "CV-BAC-".$date;?>
                                     </a>
                                  </td>
                                  <td>Aggregated Cash Credit Voucher of <?php echo $date;?></td>
                                  <td><?php if($get_cash->Amount==''){
                                           echo '0.00';
                                      }else{
                                          echo $get_cash->Amount;
                                      } ?></td>
                                  <td><?php  echo $date; ?></td>
                              </tr>
                          <?php
                          foreach($get_vouchar as $v_data){

                              ?>
                              <tr>
                                  <td><a href="<?php echo base_url("accounts/accounts/vouchar_view/$v_data->VNo") ?>"><?php echo $v_data->VNo;;?></a></td>
                                  <td><?php echo $v_data->Narration;?></td>
                                  <td><?php echo number_format($v_data->Amount); ?></td>
                                  <td><?php echo $v_data->VDate;?></td>
                              </tr>
                          <?php
                          }
                          ?>

                        </tbody>
                    </table>

            </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('application/modules/accounts/assets/js/coa_script.js'); ?>" type="text/javascript"></script>


