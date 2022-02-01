<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lsoft_setting
{
 //sms config update form for sending sms
    public function sms_configuration_form(){
        $CI =& get_instance();
        $CI->load->model('dashboard/Sms_model','sms_model');
        $setting_detail = $CI->sms_model->retrieve_sms_editdata();
        return $setting_detail;
    } 
	public function payment_by_orange_money_lib($order, $customer, $paymentid){
        $CI =& get_instance();
        $orderinfo = $CI->db->select("*")->from('customer_order')->where('order_id',$order)->get()->row();
		$paymentinfo = $CI->db->select("*")->from('paymentsetup')->where('paymentid',$paymentid)->get()->row();
		$customerinfo = $CI->db->select("*")->from('customer_info')->where('customer_id',$customer)->get()->row();
     

        require_once(APPPATH . 'libraries/monetbil-php-master/monetbil.php');
      

        Monetbil::setServiceKey($paymentinfo->marchantid);
        Monetbil::setServiceSecret($paymentinfo->password);
        // To use responsive widget, set version to 'v2.1'
        Monetbil::setWidgetVersion('v2.1');
        Monetbil::setAmount($orderinfo->totalamount);
        Monetbil::setCurrency('XAF');
        Monetbil::setLocale('en'); // Display language fr or en
        Monetbil::setPhone($customerinfo->customer_phone);
        Monetbil::setCountry('CM');
        Monetbil::setItem_ref('2222');
        Monetbil::setPayment_ref(md5(uniqid()));
        Monetbil::setUser($customerinfo->cuntomer_no);
        Monetbil::setFirst_name($customerinfo->customer_name);
        Monetbil::setLast_name($customerinfo->customer_name);
        Monetbil::setEmail($customerinfo->customer_email);
        Monetbil::setLogo('https://www.monetbil.com/assets/img/10968676_866299023433198_1949262999_o.png');

        $return_url = base_url('hungry/successful/'.$orderid);
        $notify_url = base_url('menu');
        Monetbil::setReturn_url($return_url);
        Monetbil::setNotify_url($notify_url);

        // Start a payment
        // You will be redirected to the payment page
        Monetbil::startPayment();

    }
	//send sms after order completed
    public function send_sms($order_no=null,$customer_id=null,$type=null){

        $CI =& get_instance();
        $CI->load->model('dashboard/Sms_model','sms_model');
        $gateway =    $CI->sms_model->retrieve_active_getway();
        $sms_template = $CI->db->select('*')->from('sms_template')->where('type',$type)->get()->row();
        $sms = $CI->db->select('*')->from('sms_configuration')->get()->row();
		$customer_info=$CI->db->select('customer_phone')->from('customer_info')->where('customer_id',$customer_id)->get()->row();
		$recipients = $customer_info->customer_phone;
		
		 $sms_type= strtolower($sms_template->type);
         if($sms_type == "neworder" || $sms_type == "completeorder" || $sms_type == "processing" || $sms_type == "cancel"){             
             $message= str_replace('{id}', $order_no,  $sms_template->message);
         }
        if(1 == $gateway->id ){


         /****************************
        * SMSRank Gateway Setup
        ****************************/
         $CI =& get_instance();
         $url      = "http://api.smsrank.com/sms/1/text/singles";      
         $username = $gateway->user_name;
         $password=base64_encode($gateway->password); 
         $message=base64_encode($message);
         $curl = curl_init();

         curl_setopt($curl, CURLOPT_URL, "$url?username=$username&password=$password&to=$recipients&text=$message");
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
         curl_setopt($curl, CURLOPT_USERAGENT, $agent);
         $output = json_decode(curl_exec($curl), true);
         return  true;
         curl_close($curl);
        }
        if( 2 == $gateway->id ){
        /****************************
        * nexmo Gateway Setup
        ****************************/
        $api = $gateway->user_name;
        $secret_key = $gateway->password;
        $message  =   $message;
        $from       = $gateway->sms_from; 

        $data = array(
            'from'     => $from,
            'text'     => $message,
            'to'       => $recipients
        );
        require_once APPPATH.'libraries/nexmo/vendor/autoload.php';
        $basic  = new \Nexmo\Client\Credentials\Basic($api, $secret_key);
        $client = new \Nexmo\Client($basic);
        $message = $client->message()->send($data);
        if(!$message) 
        {      
            return json_encode(array(
                'status'      => false,
                'message'     => 'Curl error: '
            ));
        } else {    
            return json_encode(array(
                'status'      => true,
                'message'     => "success: "
            ));  
        }
    }

    if( 3 == $gateway->id ){
        /****************************
        * budgetsms Gateway Setup
        ****************************/
        $message          = $message;
        $from             = $gateway->sms_from; 
        $userid           = $gateway->userid; 
        $username         = $gateway->user_name; 
        $handle           = $gateway->password; 

        $data = array(
            'handle'   => $handle,
            'username' => $username,
            'userid'   => $userid,
            'from'     => $from,
            'msg'      => $message,
            'to'       => $recipients
        );
				
		$url      = "https://api.budgetsms.net/sendsms/?";   

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl); 
		  
        if(curl_errno($curl)) 
        {      
            return json_encode(array(
                'status'      => false,
                'message'     => 'Curl error: ' . curl_error($curl)
            ));
        } else {    
            return json_encode(array(
                'status'      => true,
                'message'     => "success: ". $response
            ));  
        }   

        curl_close($curl);


    }

}
   


}

