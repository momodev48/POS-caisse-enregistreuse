<?php $storeinfo=$this->settinginfo;
$currency=$this->storecurrency;
?>
<?php $webinfo = $this->webinfo;
$activethemeinfo = $this->themeinfo;
$acthemename = $activethemeinfo->themename;?>
<link href="<?php echo base_url('application/views/themes/'.$acthemename.'/assets_web/css/myreservation.css') ?>" rel="stylesheet" type="text/css"/>


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
                <center class="myreservation_font text-center" >My Reservation List</center>
                <table class="table datatable2 table-fixed table-bordered table-hover bg-white" id="purchaseTable">
                    <thead>
                        <tr>
                            <th class="text-center">SI. </th>
                            <th class="text-center">Table No. </th>
                            <th class="text-center">Capacity </th>
                            <th class="text-center">Reserve Time </th>
                            <th class="text-center">Reserve Date</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;
                                                        foreach($reserveinfo as $item){
                                                            $i++;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i;?></td>
                            <td class="text-center"><?php echo $item->tableid;?></td>
                            <td class="text-center"><?php echo $item->person_capicity;?></td>
                            <td class="text-center"><?php echo $item->formtime.' - '.$item->totime;?></td>
                            <td class="text-center"><?php $originalDate = $item->reserveday;
                            echo $newDate = date("d-M-Y", strtotime($originalDate));?></td>
                            
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