<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends MY_Controller {

    protected $FILE_PATH;
    private $phrase = "phrase";
    public function __construct()
    {
            parent::__construct();
            $this->load->model('App_desktop_model');
            $this->load->dbforge();
			$this->load->helper('language');
            $this->FILE_PATH = base_url('assets/img/user');
    }

    public function index()
    {
            redirect('myurl');
    }

    public function sign_in()
    {
            // TO DO / Email or Phone only one required
           $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                $data['email']      = $this->input->post('email', TRUE);
                $data['password']   = $this->input->post('password', TRUE);
           

                $IsReg = $this->App_desktop_model->checkEmailOrPhoneIsRegistered('user', $data);

                if(!$IsReg) {
                    return $this->respondUserNotReg('This email or phone number has not been registered yet.');
                }
                $result = $this->App_desktop_model->authenticate_user('user', $data);

                
                if ($result != FALSE) {
					$str = substr($result->image, 2);
					$result->{"UserPictureURL"}=base_url().$str;
                    return $this->respondWithSuccess('You have successfully logged in.', $result);
                } else {
                    return $this->respondWithError('The email and password you entered don\'t match.',$result);
                }
            }
    }
	public function sign_up()
    {
          // TO DO / Email or Phone only one required
		  $this->load->library('form_validation');
		  $this->form_validation->set_rules('customer_name','Customer Name','required|max_length[100]');
		  $this->form_validation->set_rules('email','Email','required|is_unique[customer_info.customer_email]');
		  $this->form_validation->set_rules('mobile', 'Mobile','required|is_unique[customer_info.customer_phone]');
		  $this->form_validation->set_rules('password','Password','required');
		  $this->form_validation->set_message('is_unique', 'Sorry, this %s address has already been used!');
		     
			 $coa = $this->App_desktop_model->headcode();
				if($coa->HeadCode!=NULL){
					$headcode=$coa->HeadCode+1;
				}
				else{
					$headcode="102030101";
				}
				$lastid=$this->db->select("*")->from('customer_info')->order_by('cuntomer_no','desc')->get()->row();
				$sl=$lastid->cuntomer_no;
				if(empty($sl)){
				$sl = "cus-0001"; 
				}
				else{
				$sl = $sl;  
				}
				$supno=explode('-',$sl);
				$nextno=$supno[1]+1;
				$si_length = strlen((int)$nextno); 
				
				$str = '0000';
				$cutstr = substr($str, $si_length); 
				$sino = $supno[0]."-".$cutstr.$nextno; 
				
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
                $URL = base_url('assets/img/user/');
				// File Uplaod
                if ( !empty($_FILES['UserPicture']) ) 
                {
                    $config['upload_path']      = 'assets/img/user/';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg';
                    $config['max_size']         = '5120';
                    $config['file_name']        =  mt_rand() . '_' . time();
                    $config['remove_spaces']    = TRUE;
                    
                    $this->load->library('upload', $config);

                    if ( !$this->upload->do_upload('UserPicture') ) {
                        return $this->respondWithError($this->upload->display_errors('', ''));
                    } 

                    $upload_data = $this->upload->data();

                    //resize
                    $config['source_image']     = $upload_data['full_path'];
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 350;
                    $config['height']           = 265;

                    $this->load->library('image_lib', $config); 
                    $this->image_lib->resize();
                    
                    $data['customer_picture'] = $upload_data['file_name'];
                    
                    $this->image_lib->clear();
                }
				else{
					 $data['customer_picture']='';
					}
				
				$data['cuntomer_no']                = $sino;
                $data['customer_name']    			= $this->input->post('customer_name', TRUE);
                $data['customer_email']  			= $this->input->post('email', TRUE);
                $data['password']            		= md5($this->input->post('password', TRUE));
                $data['customer_address']    		= $this->input->post('Address', TRUE);
                $data['customer_phone']      		= $this->input->post('mobile', TRUE);
             
                $data['favorite_delivery_address']  = $this->input->post('favouriteaddress', TRUE);
                $insert_ID = $this->App_desktop_model->insert_data('customer_info', $data);
                if ($insert_ID) {
                    $output = $this->App_desktop_model->read("*", 'customer_info', array('customer_id' => $insert_ID));
                    $output->{"UserPictureURL"} = $this->_get_user_profile_picture_url($output);
                     $c_name = $this->input->post('customer_name');
					   $c_acc=$sino.'-'.$c_name;
					   $createdate=date('Y-m-d H:i:s');
					    $postData1 = array(
							 'HeadCode'         => $headcode,
							 'HeadName'         => $c_acc,
							 'PHeadName'        => 'Customer Receivable',
							 'HeadLevel'        => '4',
							 'IsActive'         => '1',
							 'IsTransaction'    => '1',
							 'IsGL'             => '0',
							 'HeadType'         => 'A',
							 'IsBudget'         => '0',
							 'IsDepreciation'   => '0',
							 'DepreciationRate' => '0',
							 'CreateBy'         => $insert_ID,
							 'CreateDate'       => $createdate,
						);
						$this->App_desktop_model->insert_data('acc_coa', $postData1);
					 return $this->respondWithSuccess('You have successfully registered .', $output);
                } else {
                    return $this->respondWithError('Sorry, Registration canceled. An error occurred during registration. Please try again later.');
                }
            }
    }
	 public function _get_user_profile_picture_url($data)
    {
               
                return $this->FILE_PATH . '/' . $data->customer_picture;
    }

	public function _sendingForgotPassMail($data)
    {
		    $Password =$this->generateNumericOTP(6);
            $this->App_desktop_model->update_date('customer_info', array('password' => md5($Password)), 'customer_id', $data->customer_id);
		   
		    $email_config = $this->App_desktop_model->read('*', 'email_config', array('email_config_id' => 1));
            
            $config = array(
                'protocol'  => $email_config->protocol,
                'smtp_host' => $email_config->smtp_host,
                'smtp_port' => $email_config->smtp_port,
                'smtp_user' => $email_config->sender,
                'smtp_pass' => $email_config->smtp_password,
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'wordwrap'  => TRUE,
                'newline'   => '\r\n',
                'crlf'      => '\r\n'
            );
			
            $subject    = 'Login Credential';
            $fromEmail  = $email_config->sender;
            $message    = "Upon your request, we have sent your login credential -
                            <br><br>
                            Username: <strong>$data->customer_email</strong><br>
                            Password: <strong>$Password</strong><br>
                           
                            <br>
                            Thanking you,<br>
                            <br>";

            $this->load->library('email', $config);
            $this->email->to($data->customer_email);
            $this->email->from($email_config->sender, $data->customer_name);
            $this->email->subject($subject);

            $this->email->message($message);

            return $this->email->send();
    }
	public function generateNumericOTP($n) { 
			$generator = "AZR1BRT3CDS5QWLK7PFJM9IXY2VU4GE6HN8"; 
			$result = ""; 
			for ($i = 1; $i <= $n; $i++) { 
				$result .= substr($generator, (rand()%(strlen($generator))), 1); 
			} 
			return $result; 
		} 
	public function categorylist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $categorylist=$this->App_desktop_model->categorylist();	
				if($categorylist != FALSE) {
						  $i=0;
						 foreach ($categorylist as $list) {
						 $output['categoryfo'][$i]['CategoryID']                   = $list->CategoryID;
						 $output['categoryfo'][$i]['Name']               	       = $list->Name;
						 $output['categoryfo'][$i]['CategoryImage']                = $list->CategoryImage;
						 $output['categoryfo'][$i]['Position']                     = $list->Position;
						 $output['categoryfo'][$i]['CategoryIsActive']             = $list->CategoryIsActive;
						 $output['categoryfo'][$i]['offerstartdate']               = $list->offerstartdate;
						 $output['categoryfo'][$i]['offerendate']                  = $list->offerendate;
						 $output['categoryfo'][$i]['isoffer']                      = $list->isoffer;
						 $output['categoryfo'][$i]['parentid']                     = $list->parentid;
						 $output['categoryfo'][$i]['UserIDInserted']               = $list->UserIDInserted;
						 $output['categoryfo'][$i]['UserIDUpdated']                = $list->UserIDUpdated;
						 $output['categoryfo'][$i]['UserIDLocked']                 = $list->UserIDLocked;
						 $output['categoryfo'][$i]['DateInserted']                 = $list->DateInserted;
						 $output['categoryfo'][$i]['DateUpdated']                  = $list->DateUpdated;
						 $output['categoryfo'][$i]['DateLocked']                   = $list->DateLocked;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Category List.', $output);
					}
				else{
						return $this->respondWithError('Category Not Found.!!!',$output);
					}
			}
		}
	public function foodlist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->foodlist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['foodinfo'][$i]['ProductsID']                     = $list->ProductsID;
						 $output['foodinfo'][$i]['CategoryID']               	   = $list->CategoryID;
						 $output['foodinfo'][$i]['ProductName']                    = $list->ProductName;
						 $output['foodinfo'][$i]['ProductImage']                   = $list->ProductImage;
						 $output['foodinfo'][$i]['bigthumb']                       = $list->bigthumb;
						 $output['foodinfo'][$i]['medium_thumb']                   = $list->medium_thumb;
						 $output['foodinfo'][$i]['small_thumb']                    = $list->small_thumb;
						 $output['foodinfo'][$i]['component']                      = $list->component;
						 $output['foodinfo'][$i]['descrip']                        = $list->descrip;
						 $output['foodinfo'][$i]['itemnotes']                      = $list->itemnotes;
						 $output['foodinfo'][$i]['productvat']                     = $list->productvat;
						 $output['foodinfo'][$i]['special']                        = $list->special;
						 $output['foodinfo'][$i]['OffersRate']                     = $list->OffersRate;
						 $output['foodinfo'][$i]['offerIsavailable']               = $list->offerIsavailable;
						 $output['foodinfo'][$i]['offerstartdate']                 = $list->offerstartdate;
						 $output['foodinfo'][$i]['offerendate']                    = $list->offerendate;
						 $output['foodinfo'][$i]['Position']                       = $list->Position;
						 $output['foodinfo'][$i]['ProductsIsActive']               = $list->ProductsIsActive;
						 $output['foodinfo'][$i]['UserIDInserted']                 = $list->UserIDInserted;
						 $output['foodinfo'][$i]['UserIDUpdated']                  = $list->UserIDUpdated;
						 $output['foodinfo'][$i]['UserIDLocked']                   = $list->UserIDLocked;
						 $output['foodinfo'][$i]['DateInserted']                   = $list->DateInserted;
						 $output['foodinfo'][$i]['DateUpdated']                    = $list->DateUpdated;
						 $output['foodinfo'][$i]['DateLocked']                     = $list->DateLocked;
						 $i++;
                     	}
					return $this->respondWithSuccess('All Food List.', $output);
					}
				else{
						return $this->respondWithError('Food Not Found.!!!',$output);
					}
			}
		}
	
	public function varientlist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->verientlist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['foodvarientinfo'][$i]['variantid']                    = $list->variantid;
						 $output['foodvarientinfo'][$i]['menuid']               	    = $list->menuid;
						 $output['foodvarientinfo'][$i]['variantName']                  = $list->variantName;
						 $output['foodvarientinfo'][$i]['price']                        = $list->price;
						 $i++;
                     	}
					return $this->respondWithSuccess('All Varient List.', $output);
					}
				else{
						return $this->respondWithError('Food Varient Not Found.!!!',$output);
					}
			}
		}
	    public function addonslist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->addonslist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['addonsinfo'][$i]['add_on_id']             = $list->add_on_id;
						 $output['addonsinfo'][$i]['add_on_name']           = $list->add_on_name;
						 $output['addonsinfo'][$i]['price']                 = $list->price;
						 $output['addonsinfo'][$i]['is_active']             = $list->is_active;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Addons List.', $output);
					}
				else{
						return $this->respondWithError('Addons Not Found.!!!',$output);
					}
			}
		}
		public function addonsassignlist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->addonsassignlist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['addonsinfo'][$i]['row_id']                    = $list->row_id;
						 $output['addonsinfo'][$i]['menu_id']               	= $list->menu_id;
						 $output['addonsinfo'][$i]['add_on_id']                 = $list->add_on_id;
						 $output['addonsinfo'][$i]['is_active']                 = $list->is_active;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Addons List.', $output);
					}
				else{
						return $this->respondWithError('Addons Not Found.!!!',$output);
					}
			}
		}
		public function placeorder(){
		    $this->load->library('form_validation');
		    $this->form_validation->set_rules('customer_id', 'Customer ID', 'required|xss_clean|trim');
            $this->form_validation->set_rules('full_name', 'Full Name', 'required|xss_clean|trim');
			$this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean|trim');
			$this->form_validation->set_rules('billing_address', 'billing address', 'xss_clean|required|trim');
			$this->form_validation->set_rules('Pay_type', 'Payment method', 'xss_clean|required|trim');
			$this->form_validation->set_rules('SubtotalTotal', 'Subtotal', 'xss_clean|required|trim');
			$this->form_validation->set_rules('vat', 'vat', 'xss_clean|required|trim');
			$this->form_validation->set_rules('table', 'table', 'xss_clean|trim');
			$this->form_validation->set_rules('waiter', 'waiter', 'xss_clean|trim');
			$this->form_validation->set_rules('cookingtime', 'cookingtime', 'xss_clean|trim');
			$this->form_validation->set_rules('grandtotal', 'Grand Total', 'xss_clean|required|trim');
			$this->form_validation->set_rules('CartData', 'CartData', 'xss_clean|required|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
		$output = $categoryIDs = array();
		
		$customerinfo=$this->db->select("*")->from('customer_info')->where('customer_id',$this->input->post('customer_id'))->get()->row();
		$sino =$customerinfo->cuntomer_no;
		//insert Customer
		$user['cuntomer_no']=$sino;
		$user['password']=md5($this->input->post('password'));
		$user['customer_name']=$this->input->post('full_name');
		$user['customer_email']=$this->input->post('email');
		$user['customer_phone']=$this->input->post('phone');
		$user['customer_address']=$this->input->post('billing_address');
		$user['favorite_delivery_address']="Order form ios";
		$user['is_active']=1;
		$customerid=$customerinfo->customer_id;
		
		//Order insert
		$newdate= date('Y-m-d');
		$lastorderid=$this->db->select("*")->from('customer_order')->order_by('order_id','desc')->Limit(1)->get()->row();
		if(empty($lastorderid)){
		$ordsl = 1; 
		}
		else{
		$ordsl=$lastorderid->order_id;
		$ordsl = $ordsl+1;  
		}
		$ordsi_length = strlen((int)$ordsl); 
		$ordstr = '0000';
		$cutordstr = substr($ordstr, $ordsi_length); 
		$ordsino = $cutordstr.$ordsl;
		
		
		
		$orderinfo['customer_id']   	=$customerid;
		$orderinfo['saleinvoice']   	=$ordsino;
		$orderinfo['cutomertype']   	=1;
		$orderinfo['waiter_id']   		=$this->input->post('waiter');
		$orderinfo['cookedtime']   		=$this->input->post('cookingtime');
		$orderinfo['order_date']  		=$newdate;
		$orderinfo['order_time'] 		=date('H:i:s');
		$orderinfo['totalamount']   	=$this->input->post('grandtotal');
		$orderinfo['table_no']  		=$this->input->post('table');
		$orderinfo['customer_note'] 	=$this->input->post('ordre_notes');
		$orderinfo['order_status'] 		=1;
		
		$orderid=$this->App_desktop_model->insert_data('customer_order', $orderinfo);
		
		if(!empty($this->input->post('CouponCode'))){
		    $coupon['orderid']   			=$orderid;
			$coupon['couponcode']   		=$this->input->post('CouponCode');
			$coupon['couponrate']   	    =$this->input->post('CouponPrice');
			$this->App_desktop_model->insert_data('usedcoupon', $coupon);
		}
		
		//insert bill for online customer
		$bill['orderid']=$orderid;
		$bill['firstname']=$this->input->post('full_name');
		$bill['lastname']="-";
		$bill['companyname']=NULL;
		$bill['country']=NULL;
		$bill['email']=$this->input->post('email');
		$bill['address']=$this->input->post('billing_address');
		$bill['address2']=$this->input->post('address2');
		$bill['city']=$this->input->post('city');
		$bill['district']=$this->input->post('district');
		$bill['zip']=$this->input->post('postcode');
		$bill['phone']=$this->input->post('phone');
		$bill['DateInserted']=date('Y-m-d H:i:s');
		$this->App_desktop_model->insert_data('tbl_billingaddress', $bill);
		

		$isdiffship=$this->input->post('ISshiping');
		//insert ship for online customer
		$ship['orderid']=$orderid;
		$ship['firstname']=$this->input->post('full_name');
		$ship['lastname']='-';
		$ship['companyname']=NULL;
		$ship['country']=NULL;
		$ship['email']=$this->input->post('email');
		$ship['address']=$this->input->post('billing_address');
		$ship['city']=$this->input->post('city');
		$ship['district']=$this->input->post('district');
		$ship['zip']=NULL;
		$ship['phone']=$this->input->post('phone');
		$ship['DateInserted']=date('Y-m-d H:i:s');
		if($isdiffship==1){
		$this->App_desktop_model->insert_data('tbl_shippingaddress', $ship);
		}
		else{
			$this->App_desktop_model->insert_data('tbl_shippingaddress', $bill);
			}
			
		//Order transaction
		$paymentsatus=$this->input->post('Pay_type');
		if($this->App_desktop_model->orderitem($orderid,$customerid)) { 
		

		 $settinginfo=$this->App_desktop_model->read('*', 'setting', array('id' => 2));
		$currencyinfo=$this->App_desktop_model->read('*', 'currency', array('currencyid' => $settinginfo->currency));
		$paymentsetup=$this->App_desktop_model->read('*', 'paymentsetup', array('paymentid' => $paymentsatus));
		$output['Pay_type']=$paymentsatus;
		$output['Orderid']=$orderid;
		
		  if($paymentsatus==5){
			 if($paymentsetup->Islive==1){
				$output['action_url']="https://securepay.sslcommerz.com/gwprocess/v3/process.php";
				 }
			else{
				$output['action_url']="https://sandbox.sslcommerz.com/gwprocess/v3/process.php";
				$output['action_url_attribute']="testbox";
				}
			 $output['success_url']=base_url()."android/successful/".$orderid;
			 $output['cancel_url']=base_url()."android/cancilorder/".$orderid;
			 $output['fail_url']=base_url()."android/fail/".$orderid;
			 $output['store_id']=$paymentsetup->marchantid;
			 $output['tran_id']=$orderid;
			 $output['currency']=$paymentsetup->currency;
			 $output['card_issuer']=$this->input->post('full_name');
			 $output['total_amount']=$this->input->post('grandtotal');
			
				
			 return $this->respondWithSuccess('Order Placed Successfully', $output);		
			 }
		 else if($paymentsatus==3){
			 if($paymentsetup->Islive==1){
				$output['action_url']="https://www.paypal.com/cgi-bin/webscr";
				 }
			else{
				$output['action_url']="https://www.sandbox.paypal.com/cgi-bin/webscr";
				}
			 $output['return']=base_url()."android/successful/".$orderid;
			 $output['cancel_return']=base_url()."android/cancilorder/".$orderid;
			 $output['business']=$paymentsetup->email;
			 $output['item_number']=$orderid;
			 $output['cmd']="_xclick";
			 $output['currency_code']=$paymentsetup->currency;
			 $output['first_name']=$this->input->post('full_name');
			 $output['amount']=$this->input->post('grandtotal');
			 
			 return $this->respondWithSuccess('Order Placed Successfully', $output);		
			 }
		 else if($paymentsatus==2){
				if($paymentsetup->Islive==1){
				$output['action_url']="https://www.2checkout.com/checkout/purchase";
				 }
			else{
				$output['action_url']="https://sandbox.2checkout.com/checkout/purchase";
				}
			 $output['x_receipt_link_url']=base_url()."android/successful2/".$orderid;
			 $output['sid']=$paymentsetup->marchantid;
			 $output['mode']="2CO";
			 $output['li_0_type']="product";
			 $output['li_0_name']=$orderid;
			 $output['cmd']="_xclick";
			 $output['street_address']=$this->input->post('billing_address');
			 $output['street_address2']=$this->input->post('billing_address');
			 $output['email']=$this->input->post('email');
			 $output['phone']=$this->input->post('phone');
			 $output['city']="NA";
			 $output['state']="NA";
			 $output['zip']="NA";
			 $output['country']="NA";
			 $output['card_holder_name']=$this->input->post('full_name');
			 $output['li_0_price']=$this->input->post('grandtotal');
			 
			 return $this->respondWithSuccess('Order Placed Successfully', $output);		
			 }
		 else{
		     
			 $output['CustomerName']=$this->input->post('full_name');
			 $output['amount']=$this->input->post('grandtotal');
			 $output['OrderID']=$orderid;
			 $output['email']=$this->input->post('email');
			 $output['phone']=$this->input->post('phone');
			 $output['address']=$this->input->post('billing_address');
			 
       /*Push Notification*/
			   $condition="user.waiter_kitchenToken!='' AND employee_history.pos_id=6";
		$this->db->select('user.*,employee_history.emp_his_id,employee_history.employee_id,employee_history.pos_id ');
		$this->db->from('user');
		$this->db->join('employee_history', 'employee_history.emp_his_id = user.id', 'left');
		$this->db->where($condition);
		$query = $this->db->get();
		$allemployee = $query->result();
		$senderid=array();
		foreach($allemployee as $mytoken){
			$senderid[]=$mytoken->waiter_kitchenToken;
			}
		$newmsg=array
				(
					'tag'						=> "incoming_request",
					'orderid'					=> $orderid,
					'amount'					=> $this->input->post('grandtotal')
				);
		$message = json_encode( $newmsg );	
		define( 'API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX' );
				$registrationIds = $senderid;
				$msg = array
				(
					'message' 					=> "Orderid:".$orderid.", Amount:".$this->input->post('grandtotal'),
					'title'						=> "New Order Placed",
					'subtitle'					=> "TSET",
					'tickerText'				=> "TSET",
					'vibrate'					=> 1,
					'sound'						=> 1,
					'largeIcon'					=> "TSET",
					'smallIcon'					=> "TSET"
				);
				$fields2 = array
				(
					'registration_ids' 	=> $registrationIds,
					'data'			=> $msg
				);
				 
				$headers2 = array
				(
					'Authorization: key=' . API_ACCESS_KEY,
					'Content-Type: application/json'
				);
				 
				$ch2 = curl_init();
				curl_setopt( $ch2,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
				curl_setopt( $ch2,CURLOPT_POST, true );
				curl_setopt( $ch2,CURLOPT_HTTPHEADER, $headers2 );
				curl_setopt( $ch2,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch2,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch2,CURLOPT_POSTFIELDS, json_encode( $fields2 ) );
				$result2 = curl_exec($ch2 );
				curl_close( $ch2 );
				/*End Notification*/
			
		return $this->respondWithSuccess('Order Placed Successfully', $output);		
		 }
		} else {
		  return $this->respondWithError('Order Not Placed!!!',$output);
		}
			}
		
		}
		public function customerlist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->customerlist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['customerinfo'][$i]['customer_id']                    = $list->customer_id;
						 $output['customerinfo'][$i]['cuntomer_no']               	= $list->cuntomer_no;
						 $output['customerinfo'][$i]['customer_name']                 = $list->customer_name;
						 $output['customerinfo'][$i]['customer_email']                 = $list->customer_email;
						 $output['customerinfo'][$i]['customer_phone']                   = $list->customer_phone;
						 $output['customerinfo'][$i]['customer_address']                 = $list->customer_address;
						 $output['customerinfo'][$i]['favorite_delivery_address']        = $list->favorite_delivery_address;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Customer List.', $output);
					}
				else{
						return $this->respondWithError('Customer Not Found.!!!',$output);
					}
			}
		}
		public function tablelist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->tablelist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['tableinfo'][$i]['tableid']                    = $list->tableid;
						 $output['tableinfo'][$i]['tablename']                  = $list->tablename;
						 $output['tableinfo'][$i]['person_capicity']            = $list->person_capicity;
						 $output['tableinfo'][$i]['table_icon']                 = $list->table_icon;
						 $output['tableinfo'][$i]['status']                     = $list->status;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Table List.', $output);
					}
				else{
						return $this->respondWithError('Table Not Found.!!!',$output);
					}
			}
		}
		public function customertypelist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->ctypelist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['customertypeinfo'][$i]['customer_type_id']          = $list->customer_type_id;
						 $output['customertypeinfo'][$i]['customer_type']             = $list->customer_type;
						 $output['customertypeinfo'][$i]['ordering']                  = $list->ordering;
						 
						 $i++;
                     	}
						return $this->respondWithSuccess('All Table List.', $output);
					}
				else{
						return $this->respondWithError('Table Not Found.!!!',$output);
					}
			}
		}
		
	public function waiterlist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->waiterlist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['waiterinfo'][$i]['emp_his_id']                    = $list->emp_his_id;
						 $output['waiterinfo'][$i]['employee_id']                   = $list->employee_id;
						 $output['waiterinfo'][$i]['pos_id']                        = $list->pos_id;
						 $output['waiterinfo'][$i]['first_name']                    = $list->first_name;
						 $output['waiterinfo'][$i]['last_name']                     = $list->last_name;
						 $output['waiterinfo'][$i]['email']                         = $list->email;
						 $output['waiterinfo'][$i]['phone']                         = $list->phone;
						 $output['waiterinfo'][$i]['alter_phone']                   = $list->alter_phone;
						 $output['waiterinfo'][$i]['present_address']               = $list->present_address;
						 $output['waiterinfo'][$i]['parmanent_address']             = $list->parmanent_address;
						 $output['waiterinfo'][$i]['picture']                       = $list->picture;
						 $output['waiterinfo'][$i]['degree_name']                   = $list->degree_name;
						 $output['waiterinfo'][$i]['university_name']               = $list->university_name;
						 $output['waiterinfo'][$i]['cgp']                           = $list->cgp;
						 $output['waiterinfo'][$i]['passing_year']                  = $list->passing_year;
						 $output['waiterinfo'][$i]['company_name']                  = $list->company_name;
						 $output['waiterinfo'][$i]['working_period']                = $list->working_period;
						 $output['waiterinfo'][$i]['duties']                        = $list->duties;
						 $output['waiterinfo'][$i]['supervisor']                    = $list->supervisor;
						 $output['waiterinfo'][$i]['signature']                     = $list->signature;
						 $output['waiterinfo'][$i]['is_admin']                      = $list->is_admin;
						 $output['waiterinfo'][$i]['dept_id']                       = $list->dept_id;
						 $output['waiterinfo'][$i]['division_id']                   = $list->division_id;
						 $output['waiterinfo'][$i]['maiden_name']                   = $list->maiden_name;
						 $output['waiterinfo'][$i]['state']                         = $list->state;
						 $output['waiterinfo'][$i]['city']                          = $list->city;
						 $output['waiterinfo'][$i]['zip']                           = $list->zip;
						 $output['waiterinfo'][$i]['citizenship']                   = $list->citizenship;
						 $output['waiterinfo'][$i]['duty_type']                     = $list->duty_type;
						 $output['waiterinfo'][$i]['hire_date']                     = $list->hire_date;
						 $output['waiterinfo'][$i]['original_hire_date']            = $list->original_hire_date;
						 $output['waiterinfo'][$i]['termination_date']              = $list->termination_date;
						 $output['waiterinfo'][$i]['termination_reason']            = $list->termination_reason;
						 $output['waiterinfo'][$i]['voluntary_termination']         = $list->voluntary_termination;
						 $output['waiterinfo'][$i]['rehire_date']                   = $list->rehire_date;
						 $output['waiterinfo'][$i]['rate_type']                     = $list->rate_type;
						 $output['waiterinfo'][$i]['rate']                          = $list->rate;
						 $output['waiterinfo'][$i]['pay_frequency']                 = $list->pay_frequency;
						 $output['waiterinfo'][$i]['pay_frequency_txt']             = $list->pay_frequency_txt;
						 $output['waiterinfo'][$i]['hourly_rate2']                  = $list->hourly_rate2;
						 $output['waiterinfo'][$i]['hourly_rate3']                  = $list->hourly_rate3;
						 $output['waiterinfo'][$i]['home_department']               = $list->home_department;
						 $output['waiterinfo'][$i]['department_text']               = $list->department_text;
						 $output['waiterinfo'][$i]['class_code']                    = $list->class_code;
						 $output['waiterinfo'][$i]['class_code_desc']               = $list->class_code_desc;
						 $output['waiterinfo'][$i]['class_acc_date']                = $list->class_acc_date;
						 $output['waiterinfo'][$i]['class_status']                  = $list->class_status;
						 $output['waiterinfo'][$i]['is_super_visor']                = $list->is_super_visor;
						 $output['waiterinfo'][$i]['super_visor_id']                = $list->super_visor_id;
						 $output['waiterinfo'][$i]['supervisor_report']             = $list->supervisor_report;
						 $output['waiterinfo'][$i]['dob']                           = $list->dob;
						 $output['waiterinfo'][$i]['gender']                        = $list->gender;
						 $output['waiterinfo'][$i]['country']                       = $list->country;
						 $output['waiterinfo'][$i]['marital_status']                = $list->marital_status;
						 $output['waiterinfo'][$i]['ethnic_group']                  = $list->ethnic_group;
						 $output['waiterinfo'][$i]['eeo_class_gp']                  = $list->eeo_class_gp;
						 $output['waiterinfo'][$i]['ssn']                           = $list->ssn;
						 $output['waiterinfo'][$i]['work_in_state']                 = $list->work_in_state;
						 $output['waiterinfo'][$i]['live_in_state']                 = $list->live_in_state;
						 $output['waiterinfo'][$i]['home_email']                    = $list->home_email;
						 $output['waiterinfo'][$i]['business_email']                = $list->business_email;
						 $output['waiterinfo'][$i]['home_phone']                    = $list->home_phone;
						 $output['waiterinfo'][$i]['business_phone']                = $list->business_phone;
						 $output['waiterinfo'][$i]['cell_phone']                    = $list->cell_phone;
						 $output['waiterinfo'][$i]['emerg_contct']                  = $list->emerg_contct;
						 $output['waiterinfo'][$i]['emrg_h_phone']                  = $list->emrg_h_phone;
						 $output['waiterinfo'][$i]['emrg_w_phone']                  = $list->emrg_w_phone;
						 $output['waiterinfo'][$i]['emgr_contct_relation']          = $list->emgr_contct_relation;
						 $output['waiterinfo'][$i]['alt_em_contct']                 = $list->alt_em_contct;
						 $output['waiterinfo'][$i]['alt_emg_h_phone']               = $list->alt_emg_h_phone;
						 $output['waiterinfo'][$i]['alt_emg_w_phone']               = $list->alt_emg_w_phone;
						 
						 
						 $i++;
                     	}
						$k=0;
						 foreach ($foodlist as $user) {
						 $output['userinfo'][$k]['id']                            = $user->emp_his_id;
						 $output['userinfo'][$k]['firstname']                     = $user->first_name;
						 $output['userinfo'][$k]['lastname']                      = $user->last_name;
						 $output['userinfo'][$k]['email']                         = $user->email;
						 $output['userinfo'][$k]['password']                      = md5(123456);
						 $k++;
                     	}
						return $this->respondWithSuccess('All User List.', $output);
					}
				else{
						return $this->respondWithError('Table Not Found.!!!',$output);
					}
			}
		}
    public function foodvariable(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->foodavailablelist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['foodavailableinfo'][$i]['availableID']             = $list->availableID;
						 $output['foodavailableinfo'][$i]['foodid']                  = $list->foodid;
						 $output['foodavailableinfo'][$i]['availtime']               = $list->availtime;
						 $output['foodavailableinfo'][$i]['availday']                = $list->availday;
						 $output['foodavailableinfo'][$i]['is_active']               = $list->is_active;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Available Food List.', $output);
					}
				else{
						return $this->respondWithError('Food Not Found.!!!',$output);
					}
			}
		}
	public function thirdpartylist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->allthirdpartylist();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['thirdpartyinfo'][$i]['companyId']             = $list->companyId;
						 $output['thirdpartyinfo'][$i]['company_name']          = $list->company_name;
						 $output['thirdpartyinfo'][$i]['address']               = $list->address;
						 $output['thirdpartyinfo'][$i]['commision']             = $list->commision;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Thirdparty List.', $output);
					}
				else{
						return $this->respondWithError('Thirdparty Not Found.!!!',$output);
					}
			}
		}
	public function paymentlist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->paymentmethod();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['paymentinfo'][$i]['payment_method_id']       = $list->payment_method_id;
						 $output['paymentinfo'][$i]['payment_method']          = $list->payment_method;
						 $output['paymentinfo'][$i]['is_active']               = $list->is_active;
						 $i++;
                     	}
						return $this->respondWithSuccess('All payment Method List.', $output);
					}
				else{
						return $this->respondWithError('payment Method Not Found.!!!',$output);
					}
			}
		}
	public function banklist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->allbank();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['bankinfo'][$i]['bankid']                      = $list->bankid;
						 $output['bankinfo'][$i]['bank_name']                   = $list->bank_name;
						 $output['bankinfo'][$i]['ac_name']                     = $list->ac_name;
						 $output['bankinfo'][$i]['ac_number']                   = $list->ac_number;
						 $output['bankinfo'][$i]['branch']                      = $list->branch;
						 $output['bankinfo'][$i]['signature_pic']               = $list->signature_pic;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Bank List.', $output);
					}
				else{
						return $this->respondWithError('Bank Not Found.!!!',$output);
					}
			}
		}
	public function cardterminallist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $foodlist=$this->App_desktop_model->allcardterminal();	
				if($foodlist != FALSE) {
						  $i=0;
						 foreach ($foodlist as $list) {
						 $output['bankinfo'][$i]['card_terminalid']                 = $list->card_terminalid;
						 $output['bankinfo'][$i]['terminal_name']                   = $list->terminal_name;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Card Terminal List.', $output);
					}
				else{
						return $this->respondWithError('All Card Terminal List.!!!',$output);
					}
			}
		}
	public function ordersync(){
		     $this->load->library('form_validation');
		     $this->form_validation->set_rules('orderinfo','orderinfo','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
           $orderinfo= $this->input->post('orderinfo');   
		if ($orderinfo){ 
		$getdata=json_decode($orderinfo);
		
		$output=array();
		$x=0;
 		foreach($getdata->orderinfo as $orderlist){
	       
	        $cuntomer_no=$orderlist->customer_id;
	        $customername=$orderlist->customer_name;
	        $customer_email=$orderlist->customer_email;
	        $customer_phone=$orderlist->customer_phone;
	        $password=$orderlist->password;
	        $customer_address=$orderlist->customer_address;
			$customer_token=$orderlist->customer_token;
			$customer_picture=$orderlist->customer_picture;
	        $favorite_delivery_address=$orderlist->favorite_delivery_address;
			$ismargeorder=$orderlist->marge_order_id;
			$ismultiplepay=$orderlist->ismultipay;
	        $is_active=$orderlist->is_active;
	        foreach($orderlist->menu as $item){
				
	            $item->menu_id;
	            $item->menuqty;
	            $item->add_on_id;
	            $item->addonsqty;
	            $item->varientid;
	            
	        }
	       $existcustomer= $this->db->select("*")->from('customer_info')->where('customer_id',$cuntomer_no)->get()->row();

		   $lastid=$this->db->select("*")->from('customer_info')->order_by('cuntomer_no','desc')->get()->row();
		   $sl=$lastid->cuntomer_no;
			if(empty($sl)){
			$sl = "cus-0001"; 
			}
			else{
			$sl = $sl;  
			}
			$supno=explode('-',$sl);
			$nextno=$supno[1]+1;
			$si_length = strlen((int)$nextno); 
			
			$str = '0000';
			$cutstr = substr($str, $si_length); 
			$gensino = $supno[0]."-".$cutstr.$nextno; 
	        //customer headcode
			 $coa = $this->App_desktop_model->headcode();
				if($coa->HeadCode!=NULL){
					$headcode=$coa->HeadCode+1;
				}
				else{
					$headcode="102030101";
				}
	        if(empty($existcustomer)){
			    $postData =array(
				   'cuntomer_no'     	          => $gensino,
				   'customer_name'     	          => $customername, 
				   'customer_email'               => $customer_email,
				   'customer_phone'               => $customer_phone,
				   'password'     		          => $password,
				   'customer_address'             => $customer_address,
				   'customer_token'               => $customer_token,
				   'customer_picture'             => $customer_picture,
				   'favorite_delivery_address'    =>$favorite_delivery_address, 
				   'is_active'                    => 1,
				  );
    			$this->db->insert('customer_info',$postData);
    			$sinolast=$this->db->insert_id();
    			$getlastcus= $this->db->select("*")->from('customer_info')->where('customer_id',$sinolast)->get()->row();
    			$cidor=$getlastcus->customer_id;
    			$sino=$getlastcus->cuntomer_no;
    			$c_name = $customername;
    			$c_acc=$sino.'-'.$c_name;
				$existcoa=$this->db->select("*")->from('acc_coa')->where('HeadName',$c_acc)->get()->row();
    			$createdate=date('Y-m-d H:i:s');
				if(empty($existcoa)){
				 $postData1 = array(
    				 'HeadCode'         => $headcode,
    				 'HeadName'         => $c_acc,
    				 'PHeadName'        => 'Customer Receivable',
    				 'HeadLevel'        => '4',
    				 'IsActive'         => '1',
    				 'IsTransaction'    => '1',
    				 'IsGL'             => '0',
    				 'HeadType'         => 'A',
    				 'IsBudget'         => '0',
    				 'IsDepreciation'   => '0',
    				 'DepreciationRate' => '0',
    				 'CreateBy'         => $sino,
    				 'CreateDate'       => $createdate,
    				);
    			$this->db->insert('acc_coa',$postData1);
				}
    			}
    			else{
    			  $sino=$existcustomer->cuntomer_no;
    			  $cidor=$existcustomer->customer_id;
    			}
    			
				//Order insert
				$newdate= date('Y-m-d');
				$lastid=$this->db->select("*")->from('customer_order')->order_by('order_id','desc')->get()->row();
				$sl=$lastid->order_id;
				if(empty($sl)){
				$sl = 1; 
				}
				else{
				$sl = $sl+1;  
				}
		
				$si_length = strlen((int)$sl); 
				
				$str = '0000';
				$str2 = '0000';
				$cutstr = substr($str, $si_length); 
				$ordsino = $cutstr.$sl;
				$todaydate=date('Y-m-d');
				$todaystoken=$this->db->select("*")->from('customer_order')->where('order_date',$todaydate)->order_by('order_id','desc')->get()->row();
				
				if(empty($todaystoken)){
					$mytoken=1;
				}
				else{
				    if(empty($todaystoken->tokenno)){
				        $tokenlastnum=0;
				    }
				    else{
				        $tokenlastnum=$todaystoken->tokenno;
				    }
					 $mytoken= $tokenlastnum+1;
					}
		       
		        	$orderinfo=array(
        				'customer_id'				=>	$cidor,
        				'saleinvoice'		        =>	$ordsino,
						'marge_order_id'			=>	$ismargeorder,
        				'cutomertype'	        	=>	$orderlist->cutomertype,
        				'waiter_id'	        	    =>	$orderlist->waiter_id,
        				'isthirdparty'	        	=>	$orderlist->isthirdparty,
        				'order_date'		    	=>	$orderlist->order_date,
        				'order_time'		        =>	$orderlist->order_time,
        				'cookedtime'		        =>	$orderlist->cookedtime,
        				'totalamount'	        	=>	$orderlist->totalamount,
        				'table_no'	        	    =>	$orderlist->table_no,
        				'customer_note'	        	=>	$orderlist->customer_note,
        				'tokenno'		    	    =>	$orderlist->tokenno,
        				'order_status'		        =>	$orderlist->order_status
        			);
        		
				$getorderid=$this->App_desktop_model->insert_data('customer_order', $orderinfo);
			$neworder2=$this->db->select("*")->from('customer_order')->where('order_id',$getorderid)->get()->row();
			$orderid =$neworder2->order_id;
			$salesno =$neworder2->saleinvoice;
			
			//final part
			$cusifo = $this->db->select('*')->from('customer_info')->where('customer_id',$cuntomer_no)->get()->row();
		
		$saveid=$cusifo->customer_id;
		$cid=$cuntomer_no;
		$newdate= date('Y-m-d');
		
		foreach($orderlist->menu as $item){
			$data3=array(
				'order_id'				=>	$orderid,
				'menu_id'		        =>	$item->menu_id,
				'menuqty'	        	=>	$item->menuqty,
				'add_on_id'	        	=>	$item->add_on_id,
				'addonsqty'	        	=>	$item->addonsqty,
				'varientid'		    	=>	$item->varientid,
				'food_status'		    =>	$item->food_status,
			);
			$this->db->insert('order_menu',$data3);
		}
		$discount=$orderlist->discount;
		$scharge=$orderlist->service_charge;
		$vat=$orderlist->VAT;
		$billinfo=array(
			'customer_id'			=>	$cid,
			'order_id'		        =>	$orderid,
			'total_amount'	        =>	$orderlist->total_amount,
			'discount'	            =>	$discount,
			'service_charge'	    =>	$scharge,
			'VAT'		 	        =>  $vat,
			'bill_amount'		    =>	$orderlist->bill_amount,
			'bill_date'		        =>	$orderlist->bill_date,
			'bill_time'		        =>	$orderlist->bill_time,
			'bill_status'		    =>	$orderlist->bill_status,
			'payment_method_id'		=>	$orderlist->payment_method_id,
			'create_by'		        =>	$saveid,
			'create_date'		    =>	date('Y-m-d')
		);
		
	    $this->db->insert('bill',$billinfo);
	  	$billid = $this->db->insert_id();
		if($orderlist->bill_status==1){
			$mpayid="";
			foreach($orderlist->Pay_type as $multiinfo){
						$payment_type_id=$multiinfo->payment_type_id;
						if($ismultiplepay==1){
						$mpayinfo=array(
								'order_id'			    =>	$orderid,
								'multipayid'		    =>	$ismargeorder,
								'payment_type_id'		=>	$payment_type_id,
								'amount'	        	=>	$multiinfo->amount
							);
							$this->db->insert('multipay_bill',$mpayinfo);
							$mpayid = $this->db->insert_id();
						}
						if($payment_type_id==1){
							foreach($multiinfo->cardpinfo as $cinfo){
							$cardinfo=array(
								'bill_id'			    =>	$billid,
								'card_no'		        =>	$cinfo->card_no,
								'multipay_id'		    =>	$mpayid,
								'terminal_name'	        =>	$cinfo->terminal_name,
								'bank_name'	            =>	$cinfo->Bank
							);
							$this->db->insert('bill_card_payment',$cardinfo);
							}
						}
					}
		}
		 $output['orderinfo'][$x]['ordering'] =	$orderid;
		 $output['orderinfo'][$x]['billid'] =	$billid;
				
				// Find the acc COAID for the Transaction
				
				$headn = $cusifo->cuntomer_no.'-'.$cusifo->customer_name;
				$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
				$customer_headcode = $coainfo->HeadCode;
				
				//Customer debit for Product Value
				$invoice_no=$salesno;
				$cosdr = array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  $customer_headcode,
				  'Narration'      =>  'Customer debit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  $orderlist->bill_amount,
				  'Credit'         =>  0,
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				); 
				 $this->db->insert('acc_transaction',$cosdr);
				 //Store credit for Product Value
				  $sc =array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  10107,
				  'Narration'      =>  'Inventory Credit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  0,
				  'Credit'         =>  $orderlist->bill_amount,
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				);  
				 $this->db->insert('acc_transaction',$sc);
				 
				 // Customer Credit for paid amount.
				  $cc =array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  $customer_headcode,
				  'Narration'      =>  'Customer Credit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  0,
				  'Credit'         =>  $orderlist->bill_amount,
				  'StoreID'        =>  0,
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				);  
				 $this->db->insert('acc_transaction',$cc);
				
				 //Cash In hand Debit for paid value
				 $cdv = array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  1020101,
				  'Narration'      =>  'Cash in hand Debit For Invoice#'.$invoice_no,
				  'Debit'          =>  $orderlist->bill_amount,
				  'Credit'         =>  0,
				  'StoreID'        =>  0,
				  'IsPosted'       =>  1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				); 
				 $this->db->insert('acc_transaction',$cdv);
				 $x++;
				}
			return $this->respondWithSuccess('All Order is syncronize.', $output);	
		}
		 else{ return $this->respondWithError('Order not syncronize!!!',$output);}
			}
		}
	public function billpayments(){
			$this->load->library('form_validation');
		     $this->form_validation->set_rules('orderid','orderid','required');
			 $this->form_validation->set_rules('payamount','payamount','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				$output=array();
				$orderid=$this->input->post('orderid');
				$payamount=$this->input->post('payamount');
				$paymentmethod=$this->input->post('paymentmethod');
				$cardterminal=$this->input->post('cardterminal');
				$bankid=$this->input->post('bankid');
				$lastfdigit=$this->input->post('lastfdigit');
				$ismultiplepay=$this->input->post('ismultipay');
				$ismargeorder=$this->input->post('marge_order_id');
				$payinfo=$this->input->post('Pay_type');
				$getmpay=json_decode($payinfo);
				
				
				$orderinfo=$this->db->select("*")->from('customer_order')->where('order_id',$orderid)->order_by('order_id','desc')->get()->row();
				$billinfo=$this->db->select("*")->from('bill')->where('order_id',$orderid)->order_by('order_id','desc')->get()->row();
				$cusinfo = $this->db->select('*')->from('customer_info')->where('customer_id',$orderinfo->customer_id)->get()->row();
				  $updatetData = array(
				   'order_status'     => 4,
				   'customerpaid'     =>$payamount
				  );
		        $this->db->where('order_id',$orderid);
				$this->db->update('customer_order',$updatetData);
				//Update Bill Table
				$updatetbill = array(
				   'bill_status'           => 1,
				   'payment_method_id'     => $paymentmethod,
				  );
		        $this->db->where('order_id',$orderid);
				$this->db->update('bill',$updatetbill);
				$mpayid="";
					foreach($getmpay as $multiinfo){
						$payment_type_id=$multiinfo->payment_type_id;
						if($ismultiplepay==1){
						$mpayinfo=array(
								'order_id'			    =>	$orderid,
								'multipayid'		    =>	$ismargeorder,
								'payment_type_id'		=>	$payment_type_id,
								'amount'	        	=>	$multiinfo->amount
							);
							$this->db->insert('multipay_bill',$mpayinfo);
							$mpayid = $this->db->insert_id();
						}
						if($payment_type_id==1){
							foreach($multiinfo->cardpinfo as $cinfo){
							$cardinfo=array(
								'bill_id'			    =>	$billinfo->bill_id,
								'card_no'		        =>	$cinfo->card_no,
								'multipay_id'		    =>	$mpayid,
								'terminal_name'	        =>	$cinfo->terminal_name,
								'bank_name'	            =>	$cinfo->Bank
							);
							$this->db->insert('bill_card_payment',$cardinfo);
							}
						}
					}
			    // Income for company
				 $saveid=$billinfo->create_by;
				 $income = array(
				  'VNo'            => $orderinfo->saleinvoice,
				  'Vtype'          => 'Sales Products',
				  'VDate'          =>  $orderinfo->order_date,
				  'COAID'          => 303,
				  'Narration'      => 'Sale Income For '.$cusinfo->cuntomer_no.'-'.$cusinfo->customer_name,
				  'Debit'          => 0,
				  'Credit'         => $orderinfo->totalamount,//purchase price asbe
				  'IsPosted'       => 1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $orderinfo->order_date,
				  'IsAppove'       => 1
				); 
				$this->db->insert('acc_transaction',$income);
				return $this->respondWithSuccess('Payments Successfully Completed!!.', $output);
			}
		}
	public function allonlineorder(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				$orderinfo=$this->db->select("*")->from('customer_order')->where('cutomertype',2)->get()->result();
		$output =array();
		$i=0;
		foreach($orderinfo as $order){
			 $orderid =$order->order_id;
			 $invoice =$order->saleinvoice;
			 $customer_id =$order->customer_id;
			 $cutomertype =$order->cutomertype;
			 $isthirdparty =$order->isthirdparty;
			 $waiter_id =$order->waiter_id;
			 $kitchen =$order->kitchen;
			 $order_date =$order->order_date;
			 $order_time =$order->order_time;
			 $cookedtime =$order->cookedtime;
			 $table_no =$order->table_no;
			 $tokenno =$order->tokenno;
			 $totalamount =$order->totalamount;
			 $customerpaid =$order->customerpaid;
			 $customer_note =$order->customer_note;
			 $anyreason =$order->anyreason;
			 $customer_note =$order->customer_note;
			 $order_status =$order->order_status;
			 $customerinfo= $this->db->select("*")->from('customer_info')->where('customer_id',$customer_id)->get()->row();
			
			 
			 $output['orderinfo'][$i]['orderd']=$orderid;
			 $output['orderinfo'][$i]['invoice']=$invoice;
			 $output['orderinfo'][$i]['customer_id']=$customer_id;
			 $output['orderinfo'][$i]['cutomertype']=$cutomertype;
			 $output['orderinfo'][$i]['thirdparty']=$isthirdparty;
			 $output['orderinfo'][$i]['waiter_id']=$waiter_id;
			 $output['orderinfo'][$i]['kitchen']=$kitchen;
			 $output['orderinfo'][$i]['order_date']=$order_date;
			 $output['orderinfo'][$i]['order_time']=$order_time;
			 $output['orderinfo'][$i]['cooked_time']=$cookedtime;
			 $output['orderinfo'][$i]['table_no']=$table_no;
			 $output['orderinfo'][$i]['token']=$tokenno;
			 $output['orderinfo'][$i]['totalamount']=$totalamount;
			 $output['orderinfo'][$i]['paidamount']=$customerpaid;
			 $output['orderinfo'][$i]['customer_note']=$customer_note;
			 $output['orderinfo'][$i]['reason']=$anyreason;
			 $output['orderinfo'][$i]['order_status']=$order_status;
			 //Customer info
			 $output['orderinfo'][$i]['customerinfo']['customer_id']=$customerinfo->customer_id;
			 $output['orderinfo'][$i]['customerinfo']['cuntomer_no']=$customerinfo->cuntomer_no;
			 $output['orderinfo'][$i]['customerinfo']['customer_name']=$customerinfo->customer_name;
			 $output['orderinfo'][$i]['customerinfo']['customer_email']=$customerinfo->customer_email;
			 $output['orderinfo'][$i]['customerinfo']['customer_phone']=$customerinfo->customer_phone;
			 $output['orderinfo'][$i]['customerinfo']['password']=$customerinfo->password;
			 $output['orderinfo'][$i]['customerinfo']['customertoken']=$customerinfo->customer_token;
			 $output['orderinfo'][$i]['customerinfo']['customerpicture']=$customerinfo->customer_picture;
			 $output['orderinfo'][$i]['customerinfo']['customer_address']=$customerinfo->customer_address;
			 $output['orderinfo'][$i]['customerinfo']['favorite_delivery_address']=$customerinfo->favorite_delivery_address;
			 $output['orderinfo'][$i]['customerinfo']['is_active']=1;
			 $billing=$this->db->select("*")->from('bill')->where('order_id',$orderid)->get()->row();
			 //Bill info
			    $output['orderinfo'][$i]['billinfo']['bill_id']=$billing->bill_id;
				$output['orderinfo'][$i]['billinfo']['customer_id']=$customer_id;
				$output['orderinfo'][$i]['billinfo']['order_id']=$billing->order_id;
				$output['orderinfo'][$i]['billinfo']['total_amount']=$billing->total_amount;
				$output['orderinfo'][$i]['billinfo']['discount']=$billing->discount;
				$output['orderinfo'][$i]['billinfo']['service_charge']=$billing->service_charge;
				$output['orderinfo'][$i]['billinfo']['shipping_type']=$billing->shipping_type;
				$output['orderinfo'][$i]['billinfo']['delivarydate']=$billing->delivarydate;
				$output['orderinfo'][$i]['billinfo']['VAT']=$billing->VAT;
				$output['orderinfo'][$i]['billinfo']['bill_amount']=$billing->bill_amount;
				$output['orderinfo'][$i]['billinfo']['bill_date']=$billing->bill_date;
				$output['orderinfo'][$i]['billinfo']['bill_time']=$billing->bill_time;
				$output['orderinfo'][$i]['billinfo']['bill_status']=$billing->bill_status;
				$output['orderinfo'][$i]['billinfo']['payment_method_id']=$billing->payment_method_id;
				$output['orderinfo'][$i]['billinfo']['create_by']=$billing->create_by;
				$output['orderinfo'][$i]['billinfo']['create_date']=$billing->create_date;
				$output['orderinfo'][$i]['billinfo']['update_by']=$billing->update_by;
				$output['orderinfo'][$i]['billinfo']['update_date']=$billing->update_date;
				
				//bill card payment info
				if($billing->payment_method_id==1){
					$billpay=$this->db->select("*")->from('bill_card_payment')->where('bill_id',$billing->bill_id)->get()->row();
					$output['orderinfo'][$i]['billpayinfo']['row_id']=$billpay->row_id;
					$output['orderinfo'][$i]['billpayinfo']['bill_id']=$billpay->bill_id;
					$output['orderinfo'][$i]['billpayinfo']['card_no']=$billpay->card_no;
					$output['orderinfo'][$i]['billpayinfo']['terminal_name']=$billpay->terminal_name;
					$output['orderinfo'][$i]['billpayinfo']['bank_name']=$billpay->bank_name;
				}
			 
			 $menuinfo=$this->db->select("*")->from('order_menu')->where('order_id',$orderid)->get()->result();
			 $k=0;
			foreach ($menuinfo as $item){
				  $output['orderinfo'][$i]['menu'][$k]['row_id']=$item->row_id;
				  $output['orderinfo'][$i]['menu'][$k]['order_id']=$item->order_id;
				  $output['orderinfo'][$i]['menu'][$k]['menu_id']=$item->menu_id;
				  $output['orderinfo'][$i]['menu'][$k]['menuqty']=$item->menuqty;
				  $output['orderinfo'][$i]['menu'][$k]['add_on_id']=$item->add_on_id;
				  $output['orderinfo'][$i]['menu'][$k]['addonsqty']=$item->addonsqty;
				  $output['orderinfo'][$i]['menu'][$k]['varientid']=$item->varientid;
				  $output['orderinfo'][$i]['menu'][$k]['food_status']=$item->food_status;
				  $k++;
				 }

			$i++;
			}
			return $this->respondWithSuccess('All Online Order', $output);
		    }
	}
	public function allofflineorder(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				$crdate=date('Y-m-d');
				$offlineo="cutomertype!=2 AND order_date='".$crdate."'";
				$orderinfo=$this->db->select("*")->from('customer_order')->where('cutomertype!=',2)->get()->result();
		$output =array();
		$i=0;
		foreach($orderinfo as $order){
			 $orderid =$order->order_id;
			 $invoice =$order->saleinvoice;
			 $customer_id =$order->customer_id;
			 $cutomertype =$order->cutomertype;
			 $isthirdparty =$order->isthirdparty;
			 $waiter_id =$order->waiter_id;
			 $kitchen =$order->kitchen;
			 $order_date =$order->order_date;
			 $order_time =$order->order_time;
			 $cookedtime =$order->cookedtime;
			 $table_no =$order->table_no;
			 $tokenno =$order->tokenno;
			 $totalamount =$order->totalamount;
			 $customerpaid =$order->customerpaid;
			 $customer_note =$order->customer_note;
			 $anyreason =$order->anyreason;
			 $customer_note =$order->customer_note;
			 $order_status =$order->order_status;
			 $customerinfo= $this->db->select("*")->from('customer_info')->where('customer_id',$customer_id)->get()->row();
			
			 
			 $output['orderinfo'][$i]['orderd']=$orderid;
			 $output['orderinfo'][$i]['invoice']=$invoice;
			 $output['orderinfo'][$i]['customer_id']=$customer_id;
			 $output['orderinfo'][$i]['cutomertype']=$cutomertype;
			 $output['orderinfo'][$i]['thirdparty']=$isthirdparty;
			 $output['orderinfo'][$i]['waiter_id']=$waiter_id;
			 $output['orderinfo'][$i]['kitchen']=$kitchen;
			 $output['orderinfo'][$i]['order_date']=$order_date;
			 $output['orderinfo'][$i]['order_time']=$order_time;
			 $output['orderinfo'][$i]['cooked_time']=$cookedtime;
			 $output['orderinfo'][$i]['table_no']=$table_no;
			 $output['orderinfo'][$i]['token']=$tokenno;
			 $output['orderinfo'][$i]['totalamount']=$totalamount;
			 $output['orderinfo'][$i]['paidamount']=$customerpaid;
			 $output['orderinfo'][$i]['customer_note']=$customer_note;
			 $output['orderinfo'][$i]['reason']=$anyreason;
			 $output['orderinfo'][$i]['order_status']=$order_status;
			 //Customer info
			 $output['orderinfo'][$i]['customerinfo']['customer_id']=$customerinfo->customer_id;
			 $output['orderinfo'][$i]['customerinfo']['cuntomer_no']=$customerinfo->cuntomer_no;
			 $output['orderinfo'][$i]['customerinfo']['customer_name']=$customerinfo->customer_name;
			 $output['orderinfo'][$i]['customerinfo']['customer_email']=$customerinfo->customer_email;
			 $output['orderinfo'][$i]['customerinfo']['customer_phone']=$customerinfo->customer_phone;
			 $output['orderinfo'][$i]['customerinfo']['password']=$customerinfo->password;
			 $output['orderinfo'][$i]['customerinfo']['customertoken']=$customerinfo->customer_token;
			 $output['orderinfo'][$i]['customerinfo']['customerpicture']=$customerinfo->customer_picture;
			 $output['orderinfo'][$i]['customerinfo']['customer_address']=$customerinfo->customer_address;
			 $output['orderinfo'][$i]['customerinfo']['favorite_delivery_address']=$customerinfo->favorite_delivery_address;
			 $output['orderinfo'][$i]['customerinfo']['is_active']=1;
			 $billing=$this->db->select("*")->from('bill')->where('order_id',$orderid)->get()->row();
			 //Bill info
			    $output['orderinfo'][$i]['billinfo']['bill_id']=$billing->bill_id;
				$output['orderinfo'][$i]['billinfo']['customer_id']=$customer_id;
				$output['orderinfo'][$i]['billinfo']['order_id']=$billing->order_id;
				$output['orderinfo'][$i]['billinfo']['total_amount']=$billing->total_amount;
				$output['orderinfo'][$i]['billinfo']['discount']=$billing->discount;
				$output['orderinfo'][$i]['billinfo']['service_charge']=$billing->service_charge;
				$output['orderinfo'][$i]['billinfo']['shipping_type']=$billing->shipping_type;
				$output['orderinfo'][$i]['billinfo']['delivarydate']=$billing->delivarydate;
				$output['orderinfo'][$i]['billinfo']['VAT']=$billing->VAT;
				$output['orderinfo'][$i]['billinfo']['bill_amount']=$billing->bill_amount;
				$output['orderinfo'][$i]['billinfo']['bill_date']=$billing->bill_date;
				$output['orderinfo'][$i]['billinfo']['bill_time']=$billing->bill_time;
				$output['orderinfo'][$i]['billinfo']['bill_status']=$billing->bill_status;
				$output['orderinfo'][$i]['billinfo']['payment_method_id']=$billing->payment_method_id;
				$output['orderinfo'][$i]['billinfo']['create_by']=$billing->create_by;
				$output['orderinfo'][$i]['billinfo']['create_date']=$billing->create_date;
				$output['orderinfo'][$i]['billinfo']['update_by']=$billing->update_by;
				$output['orderinfo'][$i]['billinfo']['update_date']=$billing->update_date;
				
				//bill card payment info
				if($billing->payment_method_id==1){
					$billpay=$this->db->select("*")->from('bill_card_payment')->where('bill_id',$billing->bill_id)->get()->row();
					$output['orderinfo'][$i]['billpayinfo']['row_id']=$billpay->row_id;
					$output['orderinfo'][$i]['billpayinfo']['bill_id']=$billpay->bill_id;
					$output['orderinfo'][$i]['billpayinfo']['card_no']=$billpay->card_no;
					$output['orderinfo'][$i]['billpayinfo']['terminal_name']=$billpay->terminal_name;
					$output['orderinfo'][$i]['billpayinfo']['bank_name']=$billpay->bank_name;
				}
			 
			 $menuinfo=$this->db->select("*")->from('order_menu')->where('order_id',$orderid)->get()->result();
			 $k=0;
			foreach ($menuinfo as $item){
				  $output['orderinfo'][$i]['menu'][$k]['row_id']=$item->row_id;
				  $output['orderinfo'][$i]['menu'][$k]['order_id']=$item->order_id;
				  $output['orderinfo'][$i]['menu'][$k]['menu_id']=$item->menu_id;
				  $output['orderinfo'][$i]['menu'][$k]['menuqty']=$item->menuqty;
				  $output['orderinfo'][$i]['menu'][$k]['add_on_id']=$item->add_on_id;
				  $output['orderinfo'][$i]['menu'][$k]['addonsqty']=$item->addonsqty;
				  $output['orderinfo'][$i]['menu'][$k]['varientid']=$item->varientid;
				  $output['orderinfo'][$i]['menu'][$k]['food_status']=$item->food_status;
				  $k++;
				 }

			$i++;
			}
			return $this->respondWithSuccess('All Online Order', $output);
		    }
	}
	public function languagelist(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 if ($this->db->table_exists('language')) { 

                $fields = $this->db->field_data('language');
                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 2)
                    $output[$field->name] = ucfirst($field->name);
                }

                if (!empty($output)) return $this->respondWithSuccess('All Language List.', $output);
 

        } else {
                   return $this->respondWithError('Language Not Found.!!!',$output);
                 }
			}
		}
	public function addLanguage()
    { 
             $this->load->library('form_validation');
		     $this->form_validation->set_rules('language','language','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				$output = array();
				$language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->input->post('language',true));
				$language = strtolower($language);
		
				if (!empty($language)) {
					if (!$this->db->field_exists($language, 'language')) {
						$this->dbforge->add_column('language', array(
							$language => array(
								'type' => 'TEXT'
							)
						));
						return $this->respondWithSuccess('Language Added Successfully.', $output); 
					}
					else{
						return $this->respondWithError('Language Already Exist.!!!',$output);
						} 
				} else {
					return $this->respondWithError('Language Not Added.!!!',$output);
				}
			}
    }
    public function addPhrase() { 
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('phrase[]','phrase','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            { 
			$output = array();
        $lang = $this->input->post('phrase'); 
        if (sizeof($lang) > 0) {
            if ($this->db->table_exists('language')) {
                if ($this->db->field_exists($this->phrase, 'language')) {
                    foreach ($lang as $value) {
                        $value = preg_replace('/[^a-zA-Z0-9_]/', '', $value);
                        $value = strtolower($value);
                        if (!empty($value)) {
                            $num_rows = $this->db->get_where('language',array($this->phrase => $value))->num_rows();
                            if ($num_rows == 0) { 
                                $this->db->insert('language',array($this->phrase => $value));
								return $this->respondWithSuccess('Phrase added successfully.', $output);  
                            } else {
								return $this->respondWithError('Phrase already exists!',$output);
                            }
                        }   
                    }  
                }  
            }
        } 
        return $this->respondWithError('Please try again',$output);
	  }
    }
  public function addLebel() {
		 $this->load->library('form_validation');
			  $this->form_validation->set_rules('language','language','required');
			  $this->form_validation->set_rules('phrase[]','phrase','required');
			  $this->form_validation->set_rules('lang[]','Label','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {  
				$output = array();
				$language = $this->input->post('language', true);
				$phrase   = $this->input->post('phrase', true);
				$lang     = $this->input->post('lang', true);
				if(!empty($language)) {
					if ($this->db->table_exists('language')) {
						if ($this->db->field_exists($language, 'language')) {
							if (sizeof($phrase) > 0)
							for ($i = 0; $i < sizeof($phrase); $i++) {
								$this->db->where($this->phrase, $phrase[$i])
									->set($language,$lang[$i])
									->update('language'); 
							}
							return $this->respondWithSuccess('Label added successfully!', $output);  
						}  
					}
				} 
				return $this->respondWithError('Please try again',$output);
			}
    }
    public function editPhrase(){
			 $this->load->library('form_validation');
			  $this->form_validation->set_rules('language','language','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            { 
				$output = array();
				$language = $this->input->post('language'); 
				if ($this->db->table_exists('language')) {
					if ($this->db->field_exists($this->phrase, 'language')) {
						$allphase=$this->db->order_by($this->phrase,'asc')->get('language')->result();
				
						$i=0;
						foreach($allphase as $singlephase){
						 
							$output['phrase'][$i]=$singlephase->phrase;
							$output['label'][$i]=$singlephase->$language;
							$i++;
							}
					
					}  
				return $this->respondWithSuccess('All Phase And Label for '.$language, $output);	
        		} 
			}
		}
    public function phaseslist() {
		 $this->load->library('form_validation');
			  $this->form_validation->set_rules('android','android','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {  
				$output = array();
				$phaseslist=$this->App_desktop_model->allanguage();	
			
				if($phaseslist != FALSE) {
						  $i=0;
						 foreach ($phaseslist as $list) {
						 $output['Phasesinfo'][$i]['phase']                = $list->phrase;
						 $i++;
                     	}
						return $this->respondWithSuccess('Phases List.', $output);
					}
				else{
						return $this->respondWithError('Phases Not Found.!!!',$output);
					}
			}
    }
	public function setinginfo() {
		 $this->load->library('form_validation');
			  $this->form_validation->set_rules('android','android','required');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {  
				$output = array();
				$setting=$this->App_desktop_model->resseting();	
				if($setting != FALSE) {
						  $i=0;
						 foreach ($setting as $list) {
						 $output['setinginfo'][$i]['title']                = $list->title;
						 $output['setinginfo'][$i]['storename']             = $list->storename;
						 $output['setinginfo'][$i]['address']                  = $list->address;
						 $output['setinginfo'][$i]['email']                = $list->email;
						 $output['setinginfo'][$i]['phone']             = $list->phone;
						 $output['setinginfo'][$i]['logo']                  = $list->logo;
						 $output['setinginfo'][$i]['opentime']                = $list->opentime;
						 $output['setinginfo'][$i]['closetime']             = $list->closetime;
						 $output['setinginfo'][$i]['vat']                  = $list->vat;
						 $output['setinginfo'][$i]['discount_type']                = $list->discount_type;
						 $output['setinginfo'][$i]['service_chargeType']             = $list->service_chargeType;
						 $output['setinginfo'][$i]['currencyname']                  = $list->currencyname;
						 $output['setinginfo'][$i]['curr_icon']                  = $list->curr_icon;
						 $output['setinginfo'][$i]['position']                = $list->position;
						 $output['setinginfo'][$i]['curr_rate']             = $list->curr_rate;
						 $output['setinginfo'][$i]['min_prepare_time']                  = $list->min_prepare_time;
						 $output['setinginfo'][$i]['language']                = $list->language;
						 $output['setinginfo'][$i]['timezone']             = $list->timezone;
						 $output['setinginfo'][$i]['dateformat']                  = $list->dateformat;
						 $output['setinginfo'][$i]['site_align']                = $list->site_align;
						 $output['setinginfo'][$i]['powerbytxt']             = $list->powerbytxt;
						 $output['setinginfo'][$i]['footer_text']                  = $list->footer_text;
						 
						 $i++;
                     	}
						return $this->respondWithSuccess('Setting Information.', $output);
					}
				else{
						return $this->respondWithError('Setting Not Found.!!!',$output);
					}
			}
    }
	public function posetting(){
			 $this->load->library('form_validation');
		     $this->form_validation->set_rules('android','android','required|max_length[100]');
			 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				 $output = array();
				 $posseting=$this->db->select("*")->from('tbl_posetting')->get()->result();;	
				if($posseting != FALSE) {
						  $i=0;
						 foreach ($posseting as $list) {
						 $output['posetting'][$i]['waiter']                    = $list->waiter;
						 $output['posetting'][$i]['tableid']                  = $list->tableid;
						 $output['posetting'][$i]['cooktime']            = $list->cooktime;
						 $i++;
                     	}
						return $this->respondWithSuccess('All Pos setting.', $output);
					}
				else{
						return $this->respondWithError('Pos setting Not Found.!!!',$output);
					}
			}
		}
}
				