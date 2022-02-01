<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/owl.theme.default.min.css">


<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <strong></strong>
            </div>
            <div class="modal-body addonsinfo">
            
    		</div>
     
            </div>
            <div class="modal-footer">

            </div>

        </div>

    </div>
    <?php $totalorder=0;
	if(!empty($counterorder)){$totalorder=count($counterorder);}
	if($totalorder>10){
		$length=ceil($totalorder/10);
		$reloadtime=$length*12000;
	}
	else{
		$length=1;
		$reloadtime=60000;
		}
		$this->load->model('ordermanage/order_model',	'ordermodel');
		
		
	?>
<div class="row">
                   <div class="panel">
                     <div class="panel-body">
                     <h2 class="text-center"><?php echo display('ordtcoun');?></h2>
                     <div class="owl-carousel owl-theme">
                      <?php for($k=0;$k<=$length-1;$k++){
						 if($k==0){
						 $start=0;
						 $limit=10;
						 }
						 else{
							 $start=$k*10;
						     $limit=10;
							 }
					
						 
						 ?>
                      <div> <table class="table table-bordered table-hover bg-white wpr_100">
                                    <thead>
                                         <tr class="tr-bg">
                                                <th class="text-center"><?php echo display('tabltno');?></th>
                                                <th class="text-center"><?php echo display('ord_num');?></th>
                                                <th class="text-center"><?php echo display('ordtime');?></th> 
                                                <th class="text-center"><?php echo display('remtime');?></th>
                                                <th class="text-center"><?php echo display('status');?></th> 
                                                
                                            </tr>
                                    </thead>
                                   
                                    <?php 
									$tableinfo=$this->ordermodel->counter_ongoingorderlimit($limit,$start);
									if(!empty($counterorder)){
									
										 if(($onprocess->orderacceptreject==0 || empty($onprocess->orderacceptreject)) && ($onprocess->cutomertype==2)){}
										 else{
										$i=0;
										foreach($tableinfo as $myorder){
											$i++;
										
											if($myorder->order_status==1 || $myorder->order_status==2){
												$status="Processing";
												}
											else{
												$status="Ready";
												}
												$online='';
											if($myorder->cutomertype==2){
												$online='(Online Order)';
												}
												$curtime=date("i");
												$currentday=date('Y-m-d');
												$actualtime=date('H:i:s');
					                            $sortactualtime = strtotime($actualtime);
												$cookedtime = date("i", strtotime($myorder->cookedtime)); 
												$ordertime = date("i", strtotime($myorder->order_time)); 
                                                $newlogoutTime = date("H:i:s",strtotime($myorder->order_time." +".$cookedtime." minutes"));
										        $estimatedtime=strtotime($newlogoutTime);
										 
										
										if(($currentday==$myorder->order_date) && ($sortactualtime<$estimatedtime)){
											 $mins = date("i:s",strtotime($newlogoutTime." -".$curtime." minutes"));
											$st=1;?>
                                            <script>
                                            var timer<?php echo $i;?> = "<?php echo $mins;?>";
										var interval<?php echo $i;?> = setInterval(function() {
										
										
										  var timer = timer<?php echo $i;?>.split(':');
										  //by parsing integer, I avoid all extra string processing
										  var minutes = parseInt(timer[0], 10);
										  var seconds = parseInt(timer[1], 10);
										  --seconds;
										  minutes = (seconds < 0) ? --minutes : minutes;
										  seconds = (seconds < 0) ? 59 : seconds;
										  seconds = (seconds < 10) ? '0' + seconds : seconds;
										  //minutes = (minutes < 10) ?  minutes : minutes;
										  $('.countdown_<?php echo $i;?>').html(minutes + ':' + seconds);
										  if (minutes < 0) clearInterval(interval<?php echo $i;?>);
										  //check if both minutes and seconds are 0
										  if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval<?php echo $i;?>);
										  timer<?php echo $i;?> = minutes + ':' + seconds;
										}, 1000);
                                            </script>
											<?php }
										else{
											//$mins ="00:00";
											$st=0;
											}
										
										
										?>
                                       <tr>
                                       	  <td><strong><?php echo $myorder->table_no;?></strong></td>
                                          <td><strong><?php echo $myorder->order_id.' '.$online;?></strong></td>
                                          <td><strong><?php echo $myorder->order_time;?></strong></td>
                                          <td class="font-weight"><?php if($st==1){?><div class="countdown_<?php echo $i;?>"></div><?php }else{ echo "Time Over";}?></td>
                                          <td><?php echo $status;?></td>
                                       </tr>
                                    <?php } } } ?>
                                   
                                </table> </div>
                       <?php } ?>
                    </div>
                          
                      </div>
                   </div>
   <input name="reloadordtime" type="hidden" id="reloadordtime" value="<?php echo $reloadtime;?>" />           
   </div>
<input name="base" type="hidden" id="base" value="<?php echo base_url();?>" /> 
<script src="<?php echo base_url('application/modules/ordermanage/assets/js/counter.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>