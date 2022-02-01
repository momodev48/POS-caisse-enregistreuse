<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Printable area start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Invoice</title>
<script type="text/javascript">
   var pstatus="<?php echo $this->uri->segment(5);?>";
   if(pstatus==0){
       var returnurl="<?php echo base_url('ordermanage/order/pos_invoice'); ?>";
   }
   else{
      var returnurl="<?php echo base_url('ordermanage/order/pos_invoice'); ?>?tokenorder=<?php echo $orderinfo->order_id;?>"; 
   }
   window.print();
          setInterval(function(){
          document.location.href = returnurl;
           }, 3000);
	  
	
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/modules/ordermanage/assets/css/pos_token.css'); ?>">
</head>

<body>
<div id="printableArea" class="print_area">
	                    <div class="panel-body">
	                        <div class="table-responsive m-b-20">
	                            <table border="0" class="font-18 wpr_100" style="width:100%; font-size:18px;">
      <tr>
        <td>

          <table border="0" class="wpr_100" style="width:100%">
            
            <tr>
              <td align="center"><nobr><date><?php echo display('token_no')?>:<?php echo $orderinfo->tokenno;?></nobr><br/><?php echo $customerinfo->customer_name;?></td>
            </tr>
          </table>
          <table width="100%">
            <tr>
              <td>Q</th>
              <td><?php echo display('item')?></td>
              <td><?php echo display('size')?></td>
            </tr>
            <?php $i=0; 
				  $totalamount=0;
					  $subtotal=0;
					  $total=$orderinfo->totalamount;
					  
					foreach ($iteminfo as $item){
						$i++;
						$itemprice= $item->price*$item->menuqty;
						$discount=0;
						$adonsprice=0;
						if(!empty($item->add_on_id)){
							$addons=explode(",",$item->add_on_id);
							$addonsqty=explode(",",$item->addonsqty);
							$x=0;
							foreach($addons as $addonsid){
									$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
									$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$x];
									$x++;
								}
							$nittotal=$adonsprice;
							$itemprice=$itemprice;
							}
						else{
							$nittotal=0;
							$text='';
							}
						 $totalamount=$totalamount+$nittotal;
						 $subtotal=$subtotal+$item->price*$item->menuqty;
					?>
            <tr>
			  <td align="left"><?php echo $item->menuqty;?></td>
              <td align="left"><?php echo $item->ProductName;?><br><?php echo $item->notes;?></td>
              <td align="left"><?php echo $item->variantName;?></td>
			</tr>
             <?php 
			if(!empty($item->add_on_id)){
				$y=0;
					foreach($addons as $addonsid){
							$adonsinfo=$this->order_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
							$adonsprice=$adonsprice+$adonsinfo->price*$addonsqty[$y];?>
							<tr>
								<td colspan="2">
								<?php echo $adonsinfo->add_on_name;?>
								</td>
								<td class="text-right"><?php echo $addonsqty[$y];?></td>
							 </tr>
			<?php $y++;
						}
				 }
			}
			 $itemtotal=$totalamount+$subtotal;
			 $calvat=$itemtotal*15/100;
			 
			 $servicecharge=0; 
			 if(empty($billinfo)){ $servicecharge;} 
			 else{$servicecharge=$billinfo->service_charge;}
			 ?>
             <?php 
			foreach ($exitsitem as $exititem){
			    $isexitsitem=$this->order_model->readupdate('tbl_updateitems.*,SUM(tbl_updateitems.qty) as totalqty', 'tbl_updateitems', array('ordid' =>$orderinfo->order_id,'menuid'=>$exititem->menu_id,'varientid'=>$exititem->varientid,'addonsuid'=>$exititem->addonsuid));
			
						if(!empty($isexitsitem)){
							if($isexitsitem->qty>0){
						    $itemprice= $exititem->price*$isexitsitem->qty;
						?>
			<tr>
			  <td align="left"><?php echo $isexitsitem->isupdate;?> <?php echo $isexitsitem->totalqty;?></td>
              <td align="left"><?php echo $exititem->ProductName;?><br><?php echo $exititem->notes;?></td>
              <td align="left"><?php echo $exititem->variantName;?></td>
			</tr>
						<?php } }
						else{}
			}
			?>
            <tr>
            	<td colspan="5" class="border-top-gray"><nobr></nobr></td>
            </tr>  
          </table>
        </td>
      </tr>
      <tr>
      	<td align="center"><?php if(!empty($tableinfo)){ echo display('table').': '.$tableinfo->tablename;}?> | <?php echo display('ord_number');?>:<?php echo $orderinfo->order_id;?></td>
      </tr>
    </table>
        </div>
    </div>
</div>
</body>
</html>
