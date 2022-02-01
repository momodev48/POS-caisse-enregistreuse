 <?php $currency=$this->storecurrency;
 $webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;
 ?>
<link href="<?php echo base_url('application/views/themes/'.$acthemename.'/assets_web/css/myorderlist.css') ?>" rel="stylesheet" type="text/css"/>
   
    
        <div class="container wow fadeIn">
            <div class="row">
                <div class="col-xl-3 col-md-4 sidebar">
                    <div class="category_choose p-3 mb-3">
                        <div class="card-header">
                                 <div  class="text-center"> <img src="<?php echo base_url(!empty($customerinfo->customer_picture)?$customerinfo->customer_picture:'assets/img/icons/default.jpg'); ?>" width="100px;" height="100px;" class="img-circle"></div>
                        </div>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><a href="<?php echo base_url();?>myprofile" class="accordion-toggle">My Profile</a></h6>
                                    <h6 class="panel-title"><a href="<?php echo base_url();?>myorderlist" class="accordion-toggle">My Order List</a></h6>
                                    <h6 class="panel-title"><a href="<?php echo base_url();?>myoreservationlist" class="accordion-toggle">My Reservation</a></h6>
                                    <h6 class="panel-title"><a href="<?php echo base_url();?>hungry/logout" class="accordion-toggle">Logout</a></h6>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="need_booking py-4 px-3 mb-3 text-center">
                     <?php $help=$this->db->select('*')->from('tbl_widget')->where('widgetid',11)->get()->row();?>
                        <h6 class="mb-3"><?php echo $help->widget_title;?></h6>
                        <div class="need_booking_inner">
                            <?php echo $help->widget_desc;?>
                        </div>
                    </div>
                   
                </div>
                <div class="col-xl-9 col-md-8">
                <div class="col-sm-12 col-md-12 rating-block myinfotable">
<center class="text-center orderlistfont" >My Order List</center>
          <table class="table datatable2 table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                                <thead>
                                     <tr>
                                            <th class="text-center">SI. </th>
                                            <th class="text-center">Invoice id </th>
                                            <th class="text-center">Status</th> 
                                            <th class="text-center">Order Date</th>
                                            <th class="text-right">Amount</th>
                                            <th class="text-center">Action</th>  
                                        </tr>
                                </thead>
                                <tbody>
                                <?php $i=0;
								foreach($iteminfo as $item){
									$i++;
									?>
                                	<tr>
                                    	<td class="text-center"><?php echo $i;?></td>
                                        <td class="text-center"><?php echo $item->order_id;?></td>
                                        <td class="text-center">
                                        <?php if($item->order_status==1){echo "Pending";}
										if($item->order_status==2){echo "Processing";}
										if($item->order_status==3){echo "Ready";}
										if($item->order_status==4){echo "Served";}
										if($item->order_status==5){echo "Cancel";}
										 ?>
                                       </td>
                                         <td class="text-center"><?php $originalDate = $item->order_date;
											echo $newDate = date("d-M-Y", strtotime($originalDate));?></td>
                                        <td class="text-right"><?php if($currency->position==1){echo $currency->curr_icon;}?> <?php echo $item->totalamount;?> <?php if($currency->position==2){echo $currency->curr_icon;}?> </td>
                                    	<td class="text-center">
                                         <a href="<?php echo base_url();?>vieworder/<?php echo $item->order_id;?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Invoice"><i class="ti-eye" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>      

</div>
                </div>
                
            </div>
        </div>
    
   