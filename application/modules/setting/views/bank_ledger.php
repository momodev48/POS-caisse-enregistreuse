<!-- Stock report start -->
<script src="<?php echo base_url('application/modules/setting/assets/js/bank_ledger.js'); ?>" type="text/javascript"></script>

		<div class="row">
            <div class="col-sm-12">
                <div class="column">
              <?php if($this->permission->method('setting','create')->access()){ ?>
                  	<a href="<?php echo base_url('setting/bank_list/bank_transaction')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i> <?php echo display('bank_transaction')?> </a>
                   <?php }?>
                <?php if($this->permission->method('setting','read')->access()){ ?>   
                  	<a href="<?php echo base_url('setting/bank_list')?>" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('manage_bank')?> </a>
                  	<?php }?>

                </div>
            </div>
        </div>

		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('bank_ledger') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		            
			            <div class="text-right">
			            	<button  class="btn btn-warning text-right" href="#" onclick="printDiv('printableArea')"><?php echo display('print') ?></button>
			            </div>
		            	
						<div class="bank-ledger" id="printableArea">
							<div class="text-center">
								<?php if ($intinfo) { 
								
								?>
									
									<h3><?php echo $intinfo->bank_name;?></h3>
									<h5><?php echo display('ac_no') ?> : <?php echo $intinfo->ac_number;?></h5>
									<h5 ><?php echo display('branch') ?> : <?php echo $intinfo->branch;?></h5>
								
								<?php } ?>
									<span> <?php echo display('print_date') ?>: <?php echo date("d/m/Y h:i:s"); ?> </span>
							</div>
				

			                <div class="table-responsive">
			                    <table id="" class="table table-bordered table-striped table-hover">
			                        <thead>
										<tr>
											<th class="text-center"><?php echo display('date') ?></th>
											<th class="text-center"><?php echo display('description') ?></th>
											<th class="text-center"><?php echo display('withdraw_deposite_id') ?></th>
											<th class="text-center"><?php echo display('debit_plus') ?></th>
											<th class="text-center"><?php echo display('credit_minus') ?></th>
											<th class="text-center"><?php echo display('balance') ?></th>
										</tr>
									</thead>
									<tbody>
									<?php if ($bank_list) { 
									$total_ammount = 0;
									$debit= 0;
									$credit = 0;
							
									$balance = 0;
									$total_debit = 0;
									$total_credit = 0;
									foreach($bank_list as $bankledger){
										if($bankledger->ac_type == "Debit(+)") {
											$total_debit =$total_debit + $bankledger->dr;
											$debit=$bankledger->dr;
											$credit = 0;
											
										}
										else{
											$total_credit =$total_credit + $bankledger->cr;
											$credit = $bankledger->cr;
											$debit=0;
										}
									$balanc=$total_debit - $total_credit;	
								?>
										<tr>
											<td><?php echo $bankledger->date;?></td>
											<td><?php echo $bankledger->description;?></td>
											<td align="center"><?php echo $bankledger->deposite_id;?></td>
											<td align="right"><?php echo (($currency->position==0)?"$currency->curr_icon $debit":"$debit $currency->curr_icon") ?></td>
											<td align="right"><?php echo (($currency->position==0)?"$currency->curr_icon $credit":"$credit $currency->curr_icon") ?></td>
											<td align="right"><?php echo (($currency->position==0)?"$currency->curr_icon $bankledger->ammount":"$bankledger->ammount $currency->curr_icon") ?></td>
										</tr>
									<?php
										} }
									?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="3" align="right"><b><?php echo display('grand_total')?>:</b></td>
											<td align="right"><b><?php echo (($currency->position==0)?"$currency->curr_icon $total_debit":"$total_debit $currency->curr_icon") ?></b></td>
											<td align="right"><b><?php echo (($currency->position==0)?"$currency->curr_icon $total_credit":"$total_credit $currency->curr_icon") ?></b></td>
											<td align="right"><b><?php echo (($currency->position==0)?"$currency->curr_icon $balanc":"$balanc $currency->curr_icon") ?></b></td>
											
										</tr>
									</tfoot>
			                    </table>
			                </div>
			            </div>
		                <div class="text-center">
		                	<?php if (isset($link)) { echo $link ;} ?>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
