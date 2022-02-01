<?php

if (!function_exists('http_post'))
{

    function http_post($url, $data)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);

        curl_close($ch);
        return $output;
    }

}

if (!function_exists('RandomPassword'))
{
function RandomPassword(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while($i <= 7){
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass.$tmp;
			$i++;
		}
		return $pass;
	}
}
if (!function_exists('time_elapsed'))
{

    function time_elapsed($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k)
            {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            }
            else
            {
                unset($string[$k]);
            }
        }

        if (!$full)
        {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
if (!function_exists('SubscribeEmail'))
{
	function SubscribeEmail($email){
	   
$emailcontent='<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Subscription/Contact</title>
    <style>
    @media only screen and (max-width: 620px) {
      table[class=body] h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }
      table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
        font-size: 16px !important;
      }
      table[class=body] .wrapper,
            table[class=body] .article {
        padding: 10px !important;
      }
      table[class=body] .content {
        padding: 0 !important;
      }
      table[class=body] .container {
        padding: 0 !important;
        width: 100% !important;
      }
      table[class=body] .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      table[class=body] .btn table {
        width: 100% !important;
      }
      table[class=body] .btn a {
        width: 100% !important;
      }
      table[class=body] .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }

    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      .btn-primary table td:hover {
        background-color: #34495e !important;
      }
      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    </style>
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$email.',</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks for your subscription</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                          <tbody>
                            
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>';
	   
	return $emailcontent;
	}
}
if (!function_exists('SendorderEmail'))
{
	function SendorderEmail($orderid,$customerid){
	   $ci =& get_instance();
	   $ordersql = $ci->db->query("SELECT * FROM customer_order where order_id='".$orderid."'");	
	   $orderinfo= $ordersql->row();
       $rowdt = $ci->db->query("SELECT order_menu.*,item_foods.ProductsID,item_foods.ProductName,item_foods.ProductImage,variant.variantid,variant.variantName,variant.price FROM order_menu Left Join item_foods ON order_menu.menu_id=item_foods.ProductsID Left Join variant ON order_menu.varientid=variant.variantid where order_menu.order_id='".$orderid."'");	
	   $oredritem= $rowdt->result();
	   $resql = $ci->db->query("SELECT * FROM customer_info where customer_id='".$customerid."'");	
	   $resinfo= $resql->row();
	   $bill = $ci->db->query("SELECT * FROM bill where order_id='".$orderid."'");	
	   $billinfo= $bill->row();
	   $items='';
	   $subtotal=0;
	   foreach($oredritem as $item){
		   $getitemin= $ci->db->query("SELECT item_foods.ProductsID,item_foods.ProductName,variant.variantid,variant.variantName,variant.price FROM item_foods Left Join variant ON item_foods.ProductsID=variant.menuid where item_foods.ProductsID='".$item->menu_id."' AND variant.variantid='".$item->varientid."'");
		   $itemininfo= $getitemin->row();	
		   if(!empty($item->add_on_id)){
			   
			   $addons=explode(",",$item->add_on_id);
			   $addonsqtym=explode(",",$item->addonsqty);
			     $x=0;
				 $addonsname='';
				 $addonsprice='';
				 $addonsqty='';
				 $adstotalprice='';
				 foreach($addons as $addonsid){
					  $getaddons = $ci->db->query("SELECT * FROM add_ons where add_on_id='".$addonsid."'");	
	                  $adonsinfo= $getaddons->row();
					  $addonsname.=$adonsinfo->add_on_name.',';
					  $addonsprice.=$adonsinfo->price.',';
					  $addonsqty.=$addonsqtym[$x].',';
					  $adstotalprice=$adonsinfo->price*$addonsqtym[$x];
					  $x++;
				 }
				  $addonsname=trim($addonsname,',');
				  $addonsprice=trim($addonsprice,',');
				  $addonsqty=trim($addonsqty,',');
				  $isaddons='Addons:'.$addonsname.' - price:'.$adstotalprice;
				  $totalp=($item->menuqty*$itemininfo->price)+$adstotalprice;
			   }
			else{
				$isaddons="";
				$adstotalprice="";
				$totalp=$item->menuqty*$itemininfo->price;
				}
	   $subtotal=$subtotal+$totalp;
	   $items.='<tr><td>'.$itemininfo->ProductName.' '.$isaddons.'</td><td>'.$itemininfo->variantName.'</td><td>'.$item->menuqty.'</td><td>'.$itemininfo->price.'</td><td>'.$totalp.'</td></tr>';
	   }
	   
$emailcontent='<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Subscription/Contact</title>
    <style>
    @media only screen and (max-width: 620px) {
      table[class=body] h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }
      table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
        font-size: 16px !important;
      }
      table[class=body] .wrapper,
            table[class=body] .article {
        padding: 10px !important;
      }
      table[class=body] .content {
        padding: 0 !important;
      }
      table[class=body] .container {
        padding: 0 !important;
        width: 100% !important;
      }
      table[class=body] .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      table[class=body] .btn table {
        width: 100% !important;
      }
      table[class=body] .btn a {
        width: 100% !important;
      }
      table[class=body] .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }

    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      .btn-primary table td:hover {
        background-color: #34495e !important;
      }
      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    </style>
  </head>
  <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
      <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
          <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                    <tr>
                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$resinfo->customer_name.',</p>
                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks for Order.Below Your order Item information.</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                          <tbody>
                            <tr>
								<td>Item Name</td>
								<td>Varient</td>
								<td>quantity</td>
								<td align="right">Unit Price</td>
								<td align="right">Total Price</td>
							</tr>
							'.$items.'
							<tr>
								<td colspan="4" align="right">Subtotal</td>
								<td align="right">'.$subtotal.'</td>
							</tr>
                             <tr>
								<td colspan="4" align="right">Vat/Tax</td>
								<td align="right">'.$billinfo->VAT.'</td>
							</tr>
                            <tr>
								<td colspan="4" align="right">Discount</td>
								<td align="right">'.$billinfo->discount.'</td>
							</tr>
                            <tr>
								<td colspan="4" align="right">Service charge</td>
								<td align="right">'.$billinfo->service_charge.'</td>
							</tr>
                            <tr>
								<td colspan="4" align="right">Grand Total</td>
								<td align="right">'.$orderinfo->totalamount.'</td>
							</tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>';
	   
	return $emailcontent;
	}
}
if (!function_exists('SendSMS'))
{

    function SendSMS($Phone, $SMS)
    {
				// Login Info
				
    }

}
if (!function_exists('generateRandomStr'))
{
function generateRandomStr($length = 4) {
        $UpperStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $LowerStr = "abcdefghijklmnopqrstuvwxyz";
        $numbers = "0123456789";
        
        $characters = $numbers;
        $charactersLength = strlen($characters);
        $randomStr = null;
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomStr;
    }
}
