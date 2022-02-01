<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Android extends MY_Controller {

    protected $FILE_PATH;
    
    public function __construct()
    {
            parent::__construct();
            $this->load->model('Api_v2_model');
            
            $this->FILE_PATH = base_url('assets/img/user');
    }

    public function index()
    {
            redirect('myurl');
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
		     
			 $coa = $this->Api_v2_model->headcode();
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
				$scan = scandir('application/modules/');
				$pointsys="";
				foreach($scan as $file) {
					if($file=="loyalty"){
						if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
							$pointsys=1;
							$data['membership_type'] = 1;
						}
					}
				} 
				$imagedata=$this->input->post('UserPicture', TRUE);
				if(!empty($imagedata)){
				$image=$this->base64ToImage($imagedata);
				}else{
				   $image='';
				}
				$data['cuntomer_no']                = $sino;
                $data['customer_name']    			= $this->input->post('customer_name', TRUE);
                $data['customer_email']  			= $this->input->post('email', TRUE);
                $data['password']            		= md5($this->input->post('password', TRUE));
                $data['customer_address']    		= $this->input->post('Address', TRUE);
                $data['customer_phone']      		= $this->input->post('mobile', TRUE);
				$data['crdate']    					= date('Y-m-d');
				$data['is_active']    				= 1;
                $data['customer_picture']    		= $image;
                $data['favorite_delivery_address']  = $this->input->post('favouriteaddress', TRUE);
                $insert_ID = $this->Api_v2_model->insert_data('customer_info', $data);
                if ($insert_ID) {
                    if(!empty($pointsys)){
					$pointstable = array(
					   'customerid'   => $customerid,
					   'amount'       => 0,
					   'points'       => 10
					  );
					$this->Api_v2_model->insert_data('tbl_customerpoint', $pointstable);
                    }
					
                    $output = $this->Api_v2_model->read("*", 'customer_info', array('customer_id' => $insert_ID));
                    $output->{"UserPictureURL"} = base_url().$image;
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
						$this->Api_v2_model->insert_data('acc_coa', $postData1);
					 return $this->respondWithSuccess('You have successfully registered .', $output);
                } else {
                    return $this->respondWithError('Sorry, Registration canceled. An error occurred during registration. Please try again later.');
                }
            }
    }
    public function base64ToImage($imageData){
        $URL = 'assets/img/user/';
        $image_base64 = base64_decode($imageData);
        $file = $URL . uniqid() . '.png';
        file_put_contents($file, $image_base64);
        return $file;
    }
	 public function _get_user_profile_picture_url($data)
    {
                //print_r($data->customer_picture);
                return $this->FILE_PATH . '/' . $data->customer_picture;
    }
     public function _get_user_profile_picture($data)
    {
                //print_r($data->customer_picture);
                return base_url().$data->customer_picture;
    }
	public function updateprofile(){
            $this->load->library('form_validation');
			$this->form_validation->set_rules('Customerid','Customer ID','required');
		    $this->form_validation->set_rules('customer_name','Customer Name','required|max_length[100]');
		    $this->form_validation->set_rules('email','Email','required');
		    $this->form_validation->set_rules('mobile', 'Mobile','required');
			//$this->form_validation->set_rules('oldpassword', 'Old Password','required');
		    $this->form_validation->set_message('is_unique', 'Sorry, this %s address has already been used!');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationregisError($errors);
            }
            else
            {
				$output=array();
				$Customerid=$this->input->post('Customerid');
				$custinfo = $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $Customerid));
			    $imagedata=$this->input->post('UserPicture', TRUE);
				if(!empty($imagedata)){
				$image=$this->base64ToImage($imagedata);
				}else{
				   $image= $custinfo ->customer_picture;
				}
				if(!empty($custinfo)){
					if($custinfo->customer_phone==$this->input->post('mobile')){
						 
					   if($this->input->post('password')==''){
						$psaaword=$custinfo->password;
						}
					else{
						$mypassword=md5($this->input->post('oldpassword'));
							if($custinfo->password==$mypassword){
							  $psaaword=md5($this->input->post('password'));
							}
							else{
								 return $this->respondWithSuccess('Your Old Password Not Match.', $output);
								 exit;
								}
						}
				$customernum=$custinfo->cuntomer_no;
				 $headname=$custinfo->cuntomer_no.'-'.$custinfo->customer_name;
				$coa = $this->Api_v2_model->read('*', 'acc_coa', array('HeadName' => $headname));
		
			     $coaheadid=$coa->HeadCode;
			    
				$updatetData['customer_id']    			    = $Customerid;
				$updatetData['customer_name']    			= $this->input->post('customer_name', TRUE);
                $updatetData['customer_email']  			= $this->input->post('email', TRUE);
                $updatetData['password']            		= $psaaword;
                $updatetData['customer_address']    		= $this->input->post('Address', TRUE);
                $updatetData['customer_phone']      		= $this->input->post('mobile', TRUE);
                $updatetData['favorite_delivery_address']   = $this->input->post('favouriteaddress', TRUE);
                $updatetData['customer_picture']            = $image;
                
				$update = $this->Api_v2_model->update_date('customer_info', $updatetData, 'customer_id', $custinfo ->customer_id);
	
				 if ($update){
				    $output = $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $custinfo ->customer_id));
				   // print_r($output);
                    $output->{"UserPictureURL"} = base_url().$image;
					$newhead=$customernum.'-'.$this->input->post('customer_name');
					$coa_update=array('HeadName'        => $newhead);
					$this->db->where('HeadCode',$coaheadid);
					$this->db->update('acc_coa',$coa_update);
                    return $this->respondWithSuccess('Your profile has been updated successfully.', $output);
                } 
                 else {
                    return $this->respondWithSuccess('Sorry, Nothing was changed. Please try again later.',$output);
                 }
					
					}
					else{
						$existphone = $this->Api_v2_model->readnum('*', 'customer_info', array('customer_phone' => $this->input->post('mobile')));
					    if($existphone>=1){
						return $this->respondWithSuccess('Sorry, Phone Number Can\'t Be Duplicate.',$output);
						}
						else{
							
					   if($this->input->post('password')==''){
						$psaaword=$custinfo->password;
						}
					else{
						$mypassword=md5($this->input->post('oldpassword'));
							if($custinfo->password==$mypassword){
							  $psaaword=md5($this->input->post('password'));
							}
							else{
								 return $this->respondWithSuccess('Your Old Password Not Match.', $output);
								 exit;
								}
						}
				$customernum=$custinfo->cuntomer_no;
				 $headname=$custinfo->cuntomer_no.'-'.$custinfo->customer_name;
				$coa = $this->Api_v2_model->read('*', 'acc_coa', array('HeadName' => $headname));
		
			     $coaheadid=$coa->HeadCode;
			    
				$updatetData['customer_id']    			    = $Customerid;
				$updatetData['customer_name']    			= $this->input->post('customer_name', TRUE);
                $updatetData['customer_email']  			= $this->input->post('email', TRUE);
                $updatetData['password']            		= $psaaword;
                $updatetData['customer_address']    		= $this->input->post('Address', TRUE);
                $updatetData['customer_phone']      		= $this->input->post('mobile', TRUE);
                $updatetData['favorite_delivery_address']  = $this->input->post('favouriteaddress', TRUE);
                $updatetData['customer_picture']            = $image;
                
				$update = $this->Api_v2_model->update_date('customer_info', $updatetData, 'customer_id', $custinfo ->customer_id);
	
				 if ($update){
				    $output = $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $custinfo ->customer_id));
				   // print_r($output);
                    $output->{"UserPictureURL"} = base_url().$image;
					$newhead=$customernum.'-'.$this->input->post('customer_name');
					$coa_update=array('HeadName'        => $newhead);
					$this->db->where('HeadCode',$coaheadid);
					$this->db->update('acc_coa',$coa_update);
                    return $this->respondWithSuccess('Your profile has been updated successfully.', $output);
                } 
                 else {
                    return $this->respondWithSuccess('Sorry, Nothing was changed. Please try again later.',$output);
                 }
					
							}
						}
			  }
			}
		}
	public function customerinfo()
    {
		
			$this->load->library('form_validation');
            $this->form_validation->set_rules('Customerid', 'Customerid', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$output=array();
				$Customerid=$this->input->post('Customerid');
				$custinfo = $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $Customerid));
				if(!empty($custinfo)){
				    $output['customer_id']=$custinfo->customer_id;
					$output['customer_name']=$custinfo->customer_name;
					$output['customer_email']=$custinfo->customer_email;
					$output['customer_address']=$custinfo->customer_address;
					$output['customer_phone']=$custinfo->customer_phone;
					$output['UserPictureURL']=base_url().$custinfo->customer_picture;
				return $this->respondWithSuccess('Customer information:', $output);
				}
				else{
					return $this->respondWithError('Customer information Not found!!!',$output);
					}
			}
		
	}
	public function forgot_password()
       {
           $this->form_validation->set_rules('customer_email', 'customer Email', 'required|xss_clean|trim');

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                $output=array();
				$data['customer_email']   = $this->input->post('customer_email', TRUE);
                $IsReg = $this->Api_v2_model->checkEmailOrPhoneIsRegistered('customer_info', $data);
               
                if(!$IsReg) {
                    return $this->respondWithError('Email has not been registered yet.');
                }
				else{
                    $this->_sendingForgotPassMail($IsReg);
                    return $this->respondWithSuccess("We have been sent a email to this ($IsReg->customer_email) Email Address. Please check. Thank you.",$output);
				}
            }
    }
	public function _sendingForgotPassMail($data)
    {
		    $Password =$this->generateNumericOTP(6);
            $this->Api_v2_model->update_date('customer_info', array('password' => md5($Password)), 'customer_id', $data->customer_id);
		   
		    $email_config = $this->Api_v2_model->read('*', 'email_config', array('email_config_id' => 1));
            
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
	 public function foodlist()
     {
            // TO DO /
            $this->load->library('form_validation');
			$this->form_validation->set_rules('android', 'android', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$CategoryID=$this->input->post('CategoryID');
				$allfoods = $this->Api_v2_model->allfooditem($CategoryID);
				$customerid=$this->input->post('customer_id'); 

				 $output = $categoryIDs = array();
                if ($allfoods != FALSE) {
					$restinfo = $this->Api_v2_model->read('vat,currency,servicecharge', 'setting', array('id' => 2));
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
					 $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";
					 $output['servicecharge']  = $restinfo->servicecharge;
						 }
					else{
					 $currencyinfo = $this->Api_v2_model->read('currencyname,curr_icon', 'currency', array('currencyid' => $restinfo->currency));
					 if(!empty($currencyinfo)){
					 $output['Currency']  = $currencyinfo->currencyname;
					 $output['CurrencyIcon']  = $currencyinfo->curr_icon;
					 }
					 else{
					    $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";  
					 }
					 $output['Restaurantvat']  = $restinfo->vat;
					 $output['servicecharge']  = $restinfo->servicecharge;
						}
					 $shipinfo = $this->Api_v2_model->read_all('*', 'shipping_method', 'is_active', 1, 'ship_id', 'ASC');
						 if ($shipinfo != FALSE) {
							 $i=0;
							   foreach($shipinfo as $shipment){
								    $output['shippinginfo'][$i]['ship_id']	             = $shipment->ship_id;
								    $output['shippinginfo'][$i]['ShippingName']	         = $shipment->shipping_method;
									$output['shippinginfo'][$i]['Shippingrate']	         = $shipment->shippingrate;
								    $output['shippinginfo'][$i]['shiptype']	             = $shipment->shiptype;
									$i++;
								   }
							 }
					$k = 0;
					 foreach ($allfoods as $productlist) {
						 $image = $productlist->medium_thumb;
						 $addonsinfo= $this->Api_v2_model->findaddons($productlist->ProductsID);
						 $totalreview= $this->Api_v2_model->read_rating('tbl_rating','reviewtxt','proid',$productlist->ProductsID);
						 $average= $this->Api_v2_model->read_average('tbl_rating','rating','proid',$productlist->ProductsID);
						 $scan = scandir('application/modules/');
                    		$habittest="";
                    		foreach($scan as $file) {
                    		   if($file=="testhabit"){
                    			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
                    			   $habittest=1;
                    			   }
                    			   }
                    		}
						 if($habittest==1){
						 $lastnote=$this->Api_v2_model->habitrecord($productlist->ProductsID,$customerid,$productlist->variantid);
						 }else{
						    $lastnote=array('habit'=>''); 
						 }
						 
			
						 $rating=round($average->averagerating);
						if(empty($productlist->price)){
						     $proprice=0;
						 }
						 else{
						    $proprice=$productlist->price; 
						 }
						 $output['iteminfo'][$k]['review']	         = $totalreview->totalrate;
						 $output['iteminfo'][$k]['rating']           = $rating;
						 $output['iteminfo'][$k]['count']	         = 1;
						 $output['iteminfo'][$k]['total']            = $proprice;
						 $output['iteminfo'][$k]['itemnote']         = $lastnote->habit;
						 $output['iteminfo'][$k]['ProductsID']       = $productlist->ProductsID;
						 $output['iteminfo'][$k]['ProductName']      = $productlist->ProductName;
						 $output['iteminfo'][$k]['ProductImage']     =  base_url().$image;
						 $output['iteminfo'][$k]['component']  	 	 = $productlist->component;
						 $output['iteminfo'][$k]['itemnotes']  	 	 = $productlist->itemnotes;
						 $output['iteminfo'][$k]['Description']  	 = $productlist->descrip;
						 $output['iteminfo'][$k]['productvat'] 		 = $productlist->productvat;
						 $output['iteminfo'][$k]['OffersRate'] 		 = $productlist->OffersRate;
						 $output['iteminfo'][$k]['offerIsavailable'] = $productlist->offerIsavailable;
						 $output['iteminfo'][$k]['offerstartdate'] 	 = $productlist->offerstartdate;
						 $output['iteminfo'][$k]['offerendate']		 = $productlist->offerendate;
						 $output['iteminfo'][$k]['variantid'] 		 = $productlist->variantid;
						 $output['iteminfo'][$k]['variantName'] 	 = $productlist->variantName;
						 $output['iteminfo'][$k]['price'] 			 = $productlist->price;
						 if ($addonsinfo != FALSE) {
						 $output['iteminfo'][$k]['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['iteminfo'][$k]['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['iteminfo'][$k]['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['iteminfo'][$k]['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
								$output['iteminfo'][$k]['addonsinfo'][$x]['count']         = 0;
								$output['iteminfo'][$k]['addonsinfo'][$x]['total']         = 0;
								$x++;
							 }
						 	}
						else{
							$output['iteminfo'][$k]['addons'] 			 = 0;
							}
						 $k++;
						 }
                    return $this->respondWithSuccess('All  Food List.', $output);
                } else {
                    return $this->respondWithError('Food Not Found.!!!',$output);
                }
            }
    }
	
	public function fooddetails()
     {
            // TO DO /
            $this->load->library('form_validation');
			$this->form_validation->set_rules('ProductsID', 'ProductsID', 'required|xss_clean|trim');
			$this->form_validation->set_rules('variantid', 'variantid', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$productid=$this->input->post('ProductsID');
				$variantid=$this->input->post('variantid');
				$customerid=$this->input->post('customer_id');
				$iteminfo = $this->Api_v2_model->readfooditem($productid,$variantid);
				$scan = scandir('application/modules/');
                    		$habittest="";
                    		foreach($scan as $file) {
                    		   if($file=="testhabit"){
                    			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
                    			   $habittest=1;
                    			   }
                    			   }
                    		}
						 if($habittest==1){
						$lastnote=$this->Api_v2_model->habitrecord($productid,$customerid,$variantid);
						 }else{
						    $lastnote=array('habit'=>''); 
						 }
				
				
				 $output = $categoryIDs = array();
                if ($iteminfo != FALSE) {
						 $image = $iteminfo->ProductImage;
						 $addonsinfo= $this->Api_v2_model->findaddons($productid);
						 $restinfo = $this->Api_v2_model->read('vat,currency,servicecharge', 'setting', array('id' => 2));
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
					  $output['Currency']  = "";
					 $output['CurrencyIcon']  = ""; 
					 $output['servicecharge']  = $restinfo->servicecharge;
						 }
					else{
					 $currencyinfo = $this->Api_v2_model->read('currencyname,curr_icon', 'currency', array('currencyid' => $restinfo->currency));
					 if(!empty($currencyinfo)){
					 $output['Currency']  = $currencyinfo->currencyname;
					 $output['CurrencyIcon']  = $currencyinfo->curr_icon;
					 }
					 else{
					    $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";  
					 }
					 $output['Restaurantvat']  = $restinfo->vat;
					 $output['servicecharge']  = $restinfo->servicecharge;
						}
						 $shipinfo = $this->Api_v2_model->read_all('*', 'shipping_method', 'is_active', 1, 'ship_id', 'ASC');
						 if ($shipinfo != FALSE) {
							 $i=0;
							   foreach($shipinfo as $shipment){
								   
								    $output['shippinginfo'][$i]['ship_id']	             = $shipment->ship_id;
								    $output['shippinginfo'][$i]['ShippingName']	         = $shipment->shipping_method;
									$output['shippinginfo'][$i]['Shippingrate']	         = $shipment->shippingrate;
									$output['shippinginfo'][$i]['shiptype']	             = $shipment->shiptype;
									$i++;
								   }
							 }
						 $exitcustomerinfo = $this->Api_v2_model->read('customer_email', 'customer_info', array('customer_id' => $customerid));
						 $reviewexists = $this->Api_v2_model->read('*', 'tbl_rating', array('proid' => $iteminfo->ProductsID,'email'=>$exitcustomerinfo->customer_email));
						 if(!empty($reviewexists)){
						     $output['isexistreview']	         = 1;
						 }
						 else{
						     $output['isexistreview']	         = 0;
						 }
						 $totalreview= $this->Api_v2_model->read_rating('tbl_rating','reviewtxt','proid',$iteminfo->ProductsID);
						 $average= $this->Api_v2_model->read_average('tbl_rating','rating','proid',$iteminfo->ProductsID);
						 $rating=round($average->averagerating);
						  if(!empty($customerid)){
							  $allorderbycustomer= $this->Api_v2_model->read_all('*','customer_order','customer_id',$customerid,'order_id','ASC');
							  if(!empty($allorderbycustomer)){
								  	foreach($allorderbycustomer as $buyorder){
											$existbuy = $this->db->select('*')->from('order_menu')->where('order_id',$buyorder->order_id)->where('menu_id',$iteminfo->ProductsID)->get()->row();
											if(!empty($existbuy)){
												$output['isgivenreview']	         = 1;
												}
											 else{
												 $output['isgivenreview']	         = 0;
												 }
										}
								  }
							  else{
								  $output['isgivenreview']	         = 0;
								  }
							  
							 }
						  else{
							  $output['isgivenreview']	         = 0;
							  }
							  
						
						if(empty($iteminfo->price)){
						     $proprice=0;
						 }
						 else{
						    $proprice=$iteminfo->price; 
						 }
						 $output['review']	         = $totalreview->totalrate;
						 $output['rating']           = $rating;
						 $output['ProductsID']       = $iteminfo->ProductsID;
						 $output['count']	         = 1;
						 $output['total']            = $proprice;
						 $output['itemnote']         = $lastnote->habit;
						 $output['ProductName']      = $iteminfo->ProductName;
						 $output['ProductImage']     =  base_url().$image;
						 $output['component']  	 	 = $iteminfo->component;
						 $output['itemnotes']  	 	 = $iteminfo->itemnotes;
						 $output['Description']  	 = $iteminfo->descrip;
						 $output['productvat'] 		 = $iteminfo->productvat;
						 $output['OffersRate'] 		 = $iteminfo->OffersRate;
						 $output['offerIsavailable'] = $iteminfo->offerIsavailable;
						 $output['offerstartdate'] 	 = $iteminfo->offerstartdate;
						 $output['offerendate']		 = $iteminfo->offerendate;
						 $output['variantid'] 		 = $iteminfo->variantid;
						 $output['variantName'] 	 = $iteminfo->variantName;
						 $output['price'] 			 = $iteminfo->price;
						 if ($addonsinfo != FALSE) {
						 $output['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
								$output['addonsinfo'][$x]['count']         = 0;
								$output['addonsinfo'][$x]['total']         = 0;
								$x++;
							 }
						 	}
						else{
							$output['addons'] 			 = 0;
							}
					
                    return $this->respondWithSuccess('Food Information.', $output);
                } else {
                    return $this->respondWithError('Food Not Found.!!!',$output);
                }
            }
    }
	public function categorylist()
     {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('android', 'android', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                 $result = $this->Api_v2_model->categorylist($catid);
                 
				 $sliderlist = $this->Api_v2_model->sliderlist();
				 $settinginfo = $this->Api_v2_model->read('*', 'setting', array('id' => 2));
				
                 $output = array();

				  if (!empty($sliderlist)) {
					  $k=0;
					  foreach($sliderlist as $slider){
						           $image2 = $slider->image;
						           $output['sliderinfo'][$k]['title']  		    = $slider->title;
							$output['sliderinfo'][$k]['subtitle']  	    = $slider->subtitle;
							$output['sliderinfo'][$k]['link']  	    = $slider->slink;
						           $output['sliderinfo'][$k]['sliderimage']  	    = base_url().$image2;
								$k++;
						  }
					  
					  }
				
                if ($result != FALSE) {
					 $i = 0;
					 foreach ($result as $list) {
						$image = substr($list->CategoryImage, 2);
						$output["Category"][$i]['CategoryID']     = $list->CategoryID;
						$output["Category"][$i]['Name']           = $list->Name;
						$output["Category"][$i]['categoryimage']  = base_url().$image;
						$i++;
                            }
				    if(!empty($settinginfo)){
					$output['powertxt']  = $settinginfo->powerbytxt;
					}else{
					$output['powertxt']  = "";
					}
                    return $this->respondWithSuccess('All Category List And Slider.', $output);
                } else {
					
                    return $this->respondWithError('No Category Found.!!!',$output);
                }
            }
    }
   

   public function searchproduct()
     {
            $this->load->library('form_validation');
	$this->form_validation->set_rules('ProductName', 'ProductName', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$ProductName=$this->input->post('ProductName');
				$allfoods = $this->Api_v2_model->searchfood($ProductName);
				 $output = $categoryIDs = array();
                if ($allfoods != FALSE) {
					$restinfo = $this->Api_v2_model->read('vat,currency,servicecharge', 'setting', array('id' => 2));
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
					 $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";
					 $output['servicecharge']  = $restinfo->servicecharge;
						 }
					else{
					 $currencyinfo = $this->Api_v2_model->read('currencyname,curr_icon', 'currency', array('currencyid' => $restinfo->currency));
					 if(!empty($currencyinfo)){
					 $output['Currency']  = $currencyinfo->currencyname;
					 $output['CurrencyIcon']  = $currencyinfo->curr_icon;
					 }
					 else{
					    $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";  
					 }
					 $output['Restaurantvat']  = $restinfo->vat;
					 $output['servicecharge']  = $restinfo->servicecharge;
					}
					 $shipinfo = $this->Api_v2_model->read_all('*', 'shipping_method', 'is_active', 1, 'ship_id', 'ASC');
						 if ($shipinfo != FALSE) {
							 $i=0;
							   foreach($shipinfo as $shipment){
								   
								    $output['shippinginfo'][$i]['ship_id']	             = $shipment->ship_id;
									$output['shippinginfo'][$i]['ShippingName']	         = $shipment->shipping_method;
									$output['shippinginfo'][$i]['Shippingrate']	         = $shipment->shippingrate;
									$output['shippinginfo'][$i]['shiptype']	             = $shipment->shiptype;
									$i++;
								   }
							 }
					$k = 0;
					 foreach ($allfoods as $productlist) {
						 $image = $productlist->ProductImage;
						 $addonsinfo= $this->Api_v2_model->findaddons($productlist->ProductsID);
						 $totalreview= $this->Api_v2_model->read_rating('tbl_rating','reviewtxt','proid',$productlist->ProductsID);
						 $average= $this->Api_v2_model->read_average('tbl_rating','rating','proid',$productlist->ProductsID);
						 $rating=round($average->averagerating);
						 $output['iteminfo'][$k]['review']	         = $totalreview->totalrate;
						 $output['iteminfo'][$k]['rating']           = $rating;
						 $output['iteminfo'][$k]['count']	         = 1;
						 $output['iteminfo'][$k]['total']            = $productlist->price;
						 $output['iteminfo'][$k]['ProductsID']       = $productlist->ProductsID;
						 $output['iteminfo'][$k]['ProductName']      = $productlist->ProductName;
						 $output['iteminfo'][$k]['ProductImage']     =  base_url().$image;
						 $output['iteminfo'][$k]['component']  	 	 = $productlist->component;
						 $output['iteminfo'][$k]['itemnotes']  	 	 = $productlist->itemnotes;
						 $output['iteminfo'][$k]['Description']  	 = $productlist->descrip;
						 $output['iteminfo'][$k]['productvat'] 		 = $productlist->productvat;
						 $output['iteminfo'][$k]['OffersRate'] 		 = $productlist->OffersRate;
						 $output['iteminfo'][$k]['offerIsavailable'] = $productlist->offerIsavailable;
						 $output['iteminfo'][$k]['offerstartdate'] 	 = $productlist->offerstartdate;
						 $output['iteminfo'][$k]['offerendate']		 = $productlist->offerendate;
						 $output['iteminfo'][$k]['variantid'] 		 = $productlist->variantid;
						 $output['iteminfo'][$k]['variantName'] 	 = $productlist->variantName;
						 $output['iteminfo'][$k]['price'] 			 = $productlist->price;
						 if ($addonsinfo != FALSE) {
						 $output['iteminfo'][$k]['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['iteminfo'][$k]['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['iteminfo'][$k]['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['iteminfo'][$k]['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
								$output['iteminfo'][$k]['addonsinfo'][$x]['count']         = 0;
								$output['iteminfo'][$k]['addonsinfo'][$x]['total']         = 0;

								$x++;
							 }
						 	}
						else{
							$output['iteminfo'][$k]['addons'] 			 = 0;
							}
						 $k++;
						 }
                    return $this->respondWithSuccess('All  Food List.', $output);
                } else {
                    return $this->respondWithError('Food Not Found.!!!',$output);
                }
            }
    }
	public function popularitem()
     {
            // TO DO /
            $this->load->library('form_validation');
			$this->form_validation->set_rules('android', 'android', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$allfoods = $this->Api_v2_model->bestseller();
				 $output = $categoryIDs = array();
                if ($allfoods != FALSE) {
					$restinfo = $this->Api_v2_model->read('vat,currency,servicecharge', 'setting', array('id' => 2));
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
					 $output['Currency']  = "";
					    $output['CurrencyIcon']  = "";
					     $output['servicecharge']  = $restinfo->servicecharge;
						 }
					else{
					 $currencyinfo = $this->Api_v2_model->read('currencyname,curr_icon', 'currency', array('currencyid' => $restinfo->currency));
					 if(!empty($currencyinfo)){
					 $output['Currency']  = $currencyinfo->currencyname;
					 $output['CurrencyIcon']  = $currencyinfo->curr_icon;
					 }
					 else{
					    $output['Currency']  = "";
					    $output['CurrencyIcon']  = "";  
					 }
					 $output['Restaurantvat']  = $restinfo->vat;
					 $output['servicecharge']  = $restinfo->servicecharge;
						}
					 $shipinfo = $this->Api_v2_model->read_all('*', 'shipping_method', 'is_active', 1, 'ship_id', 'ASC');
						 if ($shipinfo != FALSE) {
							 $i=0;
							   foreach($shipinfo as $shipment){
								    $output['shippinginfo'][$i]['ship_id']	             = $shipment->ship_id;
								    $output['shippinginfo'][$i]['ShippingName']	         = $shipment->shipping_method;
									$output['shippinginfo'][$i]['Shippingrate']	         = $shipment->shippingrate;
									$output['shippinginfo'][$i]['shiptype']	             = $shipment->shiptype;
									$i++;
								   }
							 }
					$k = 0;
					 foreach ($allfoods as $productlist) {
						 $image = $productlist->ProductImage;
						 $addonsinfo= $this->Api_v2_model->findaddons($productlist->ProductsID);
						 $totalreview= $this->Api_v2_model->read_rating('tbl_rating','reviewtxt','proid',$productlist->ProductsID);
						 $average= $this->Api_v2_model->read_average('tbl_rating','rating','proid',$productlist->ProductsID);
						 $scan = scandir('application/modules/');
                    		$habittest="";
                    		foreach($scan as $file) {
                    		   if($file=="testhabit"){
                    			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
                    			   $habittest=1;
                    			   }
                    			   }
                    		}
						 if($habittest==1){
						$lastnote=$this->Api_v2_model->habitrecord($productlist->ProductsID,$CategoryID,$productlist->variantid);
						 }else{
						    $lastnote=array('habit'=>''); 
						 }
						 
						 $rating=round($average->averagerating);
						 $output['iteminfo'][$k]['review']	         = $totalreview->totalrate;
						 $output['iteminfo'][$k]['rating']           = $rating;
						 $output['iteminfo'][$k]['count']	         = 1;
						 $output['iteminfo'][$k]['total']            = $productlist->price;
						 $output['iteminfo'][$k]['ProductsID']       = $productlist->ProductsID;
						 $output['iteminfo'][$k]['ProductName']      = $productlist->ProductName;
						 $output['iteminfo'][$k]['ProductImage']     =  base_url().$image;
						 $output['iteminfo'][$k]['component']  	 	 = $productlist->component;
						 $output['iteminfo'][$k]['itemnotes']  	 	 = $productlist->itemnotes;
						 $output['iteminfo'][$k]['Description']  	 = $productlist->descrip;
						 $output['iteminfo'][$k]['productvat'] 		 = $productlist->productvat;
						 $output['iteminfo'][$k]['OffersRate'] 		 = $productlist->OffersRate;
						 $output['iteminfo'][$k]['offerIsavailable'] = $productlist->offerIsavailable;
						 $output['iteminfo'][$k]['offerstartdate'] 	 = $productlist->offerstartdate;
						 $output['iteminfo'][$k]['offerendate']		 = $productlist->offerendate;
						 $output['iteminfo'][$k]['variantid'] 		 = $productlist->variantid;
						 $output['iteminfo'][$k]['variantName'] 	 = $productlist->variantName;
						 $output['iteminfo'][$k]['price'] 			 = $productlist->price;
						 if ($addonsinfo != FALSE) {
						 $output['iteminfo'][$k]['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['iteminfo'][$k]['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['iteminfo'][$k]['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['iteminfo'][$k]['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
								$output['iteminfo'][$k]['addonsinfo'][$x]['count']         = 0;
								$output['iteminfo'][$k]['addonsinfo'][$x]['total']         = 0;

								$x++;
							 }
						 	}
						else{
							$output['iteminfo'][$k]['addons'] 			 = 0;
							}
						 $k++;
						 }
                    return $this->respondWithSuccess('All  Food List.', $output);
                } else {
                    return $this->respondWithError('Food Not Found.!!!',$output);
                }
            }
    }
	public function offeritem()
     {
            // TO DO /
            $this->load->library('form_validation');
			$this->form_validation->set_rules('android', 'android', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            { 
				 $customerid=$this->input->post('customer_id');
				 $allfoods = $this->Api_v2_model->offeritem();
				 $output = $categoryIDs = array();
                if ($allfoods != FALSE) {
					 $restinfo = $this->Api_v2_model->read('vat,currency,servicecharge', 'setting', array('id' => 2));
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
					 $output['Currency']  = "";
					    $output['CurrencyIcon']  = "";
					    $output['servicecharge']  = $restinfo->servicecharge;
						 }
					else{
					 $currencyinfo = $this->Api_v2_model->read('currencyname,curr_icon', 'currency', array('currencyid' => $restinfo->currency));
					 if(!empty($currencyinfo)){
					 $output['Currency']  = $currencyinfo->currencyname;
					 $output['CurrencyIcon']  = $currencyinfo->curr_icon;
					 }
					 else{
					    $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";  
					 }
					 $output['Restaurantvat']  = $restinfo->vat;
					 $output['servicecharge']  = $restinfo->servicecharge;
						}
					 $shipinfo = $this->Api_v2_model->read_all('*', 'shipping_method', 'is_active', 1, 'ship_id', 'ASC');
						 if ($shipinfo != FALSE) {
							 $i=0;
							   foreach($shipinfo as $shipment){
								   
								    $output['shippinginfo'][$i]['ship_id']	             = $shipment->ship_id;
								    $output['shippinginfo'][$i]['ShippingName']	         = $shipment->shipping_method;
									$output['shippinginfo'][$i]['Shippingrate']	         = $shipment->shippingrate;
									$output['shippinginfo'][$i]['shiptype']	             = $shipment->shiptype;
									$i++;
								   }
							 }
					$k = 0;
					 foreach ($allfoods as $productlist) {
						 $image = $productlist->ProductImage;
						 $addonsinfo= $this->Api_v2_model->findaddons($productlist->ProductsID);
						 $totalreview= $this->Api_v2_model->read_rating('tbl_rating','reviewtxt','proid',$productlist->ProductsID);
						 $average= $this->Api_v2_model->read_average('tbl_rating','rating','proid',$productlist->ProductsID);
						 
						 $scan = scandir('application/modules/');
                    		$habittest="";
                    		foreach($scan as $file) {
                    		   if($file=="testhabit"){
                    			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
                    			   $habittest=1;
                    			   }
                    			   }
                    		}
						 if($habittest==1){
						$lastnote=$this->Api_v2_model->habitrecord($productlist->ProductsID,$customerid,$productlist->variantid);
						 }else{
						    $lastnote=array('habit'=>''); 
						 }
						 $rating=round($average->averagerating);
						 if(empty($productlist->price)){
						     $proprice=0;
						 }
						 else{
						    $proprice=$productlist->price; 
						 }
						 $output['iteminfo'][$k]['review']	         = $totalreview->totalrate;
						 $output['iteminfo'][$k]['rating']           = $rating;
						 $output['iteminfo'][$k]['count']	         = 1;
						 $output['iteminfo'][$k]['itemnote']         = $lastnote->habit;
						 $output['iteminfo'][$k]['total']            = $proprice;
						 $output['iteminfo'][$k]['ProductsID']       = $productlist->ProductsID;
						 $output['iteminfo'][$k]['ProductName']      = $productlist->ProductName;
						 $output['iteminfo'][$k]['ProductImage']     =  base_url().$image;
						 $output['iteminfo'][$k]['component']  	 	 = $productlist->component;
						 $output['iteminfo'][$k]['itemnotes']  	 	 = $productlist->itemnotes;
						 $output['iteminfo'][$k]['Description']  	 = $productlist->descrip;
						 $output['iteminfo'][$k]['productvat'] 		 = $productlist->productvat;
						 $output['iteminfo'][$k]['OffersRate'] 		 = $productlist->OffersRate;
						 $output['iteminfo'][$k]['offerIsavailable'] = $productlist->offerIsavailable;
						 $output['iteminfo'][$k]['offerstartdate'] 	 = $productlist->offerstartdate;
						 $output['iteminfo'][$k]['offerendate']		 = $productlist->offerendate;
						 $output['iteminfo'][$k]['variantid'] 		 = $productlist->variantid;
						 $output['iteminfo'][$k]['variantName'] 	 = $productlist->variantName;
						 $output['iteminfo'][$k]['price'] 			 = $productlist->price;
						 if ($addonsinfo != FALSE) {
						 $output['iteminfo'][$k]['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['iteminfo'][$k]['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['iteminfo'][$k]['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['iteminfo'][$k]['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
								$output['iteminfo'][$k]['addonsinfo'][$x]['count']         = 0;
								$output['iteminfo'][$k]['addonsinfo'][$x]['total']         = 0;

								$x++;
							 }
						 	}
						else{
							$output['iteminfo'][$k]['addons'] 			 = 0;
							}
						 $k++;
						 }
                    return $this->respondWithSuccess('All  Food List.', $output);
                } else {
                    return $this->respondWithError('Food Not Found.!!!',$output);
                }
            }
    }
	public function Categorywisefoodlist()
     {
            // TO DO /
            $this->load->library('form_validation');
			$this->form_validation->set_rules('CategoryID', 'CategoryID', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                $CategoryID=$this->input->post('CategoryID');
				$output = $categoryIDs = array();
				$result = $this->Api_v2_model->foodlist($CategoryID);
                if ($result != FALSE) {
					 $restinfo = $this->Api_v2_model->read('vat,currency,servicecharge', 'setting', array('id' => 2));
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
					 $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";
					 $output['servicecharge']  = $restinfo->servicecharge;
						 }
					else{
					 $currencyinfo = $this->Api_v2_model->read('currencyname,curr_icon', 'currency', array('currencyid' => $restinfo->currency));
					 if(!empty($currencyinfo)){
					 $output['Currency']  = $currencyinfo->currencyname;
					 $output['CurrencyIcon']  = $currencyinfo->curr_icon;
					 }
					 else{
					    $output['Currency']  = "";
					 $output['CurrencyIcon']  = "";  
					 }
					 $output['Restaurantvat']  = $restinfo->vat;
					 $output['servicecharge']  = $restinfo->servicecharge;
						}
					
					 $k=0;
					 foreach ($result as $productlist) {
						 $image = $productlist->ProductImage;
						 $addonsinfo= $this->Api_v2_model->findaddons($productlist->ProductsID);
						 $output['foodinfo'][$k]['count']	         = 1;
						 $output['foodinfo'][$k]['total']            = $productlist->price;
						 $output['foodinfo'][$k]['ProductName']      = $productlist->ProductName;
						 $output['foodinfo'][$k]['ProductImage']     =  base_url().$image;
						 $output['foodinfo'][$k]['component']  	 	 = $productlist->component;
						 $output['foodinfo'][$k]['destcription']  	 = "";
						 $output['foodinfo'][$k]['itemnotes']  	 	 = $productlist->itemnotes;
						 $output['foodinfo'][$k]['Description']  	 = $productlist->descrip;
						 $output['foodinfo'][$k]['productvat'] 		 = $productlist->productvat;
						 $output['foodinfo'][$k]['OffersRate'] 		 = $productlist->OffersRate;
						 $output['foodinfo'][$k]['offerIsavailable'] = $productlist->offerIsavailable;
						 $output['foodinfo'][$k]['offerstartdate'] 	 = $productlist->offerstartdate;
						 $output['foodinfo'][$k]['offerendate']		 = $productlist->offerendate;
						 $output['foodinfo'][$k]['variantid'] 		 = $productlist->variantid;
						 $output['foodinfo'][$k]['variantName'] 	 = $productlist->variantName;
						 $output['foodinfo'][$k]['price'] 			 = $productlist->price;
						 if ($addonsinfo != FALSE) {
						 $output['foodinfo'][$k]['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['foodinfo'][$k]['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['foodinfo'][$k]['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['foodinfo'][$k]['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
								$output[$k]['addonsinfo'][$x]['count']         = 0;
								$output[$k]['addonsinfo'][$x]['total']         = 0;
								$x++;
							 }
						 	}
						else{
							$output['foodinfo'][$k]['addons'] 			 = 0;
							}
						 $k++;
						 }
                    return $this->respondWithSuccess('All Category Food List.', $output);
                } else {
                    return $this->respondWithError('Food Not Found.!!!',$output);
                }
            }
    }

	
    //reservation
	public function reservationtime(){
			 $this->load->library('form_validation');
			$this->form_validation->set_rules('android', 'android', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
				$errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {	$output=array();
				$setting = $this->Api_v2_model->read('opentime,closetime,min_prepare_time', 'setting', array('id' => 2));
				if(!empty($setting)){
					$output['Opentime']=$setting->opentime;
					$output['closetime']=$setting->closetime;
					$output['DelivarTime']=$setting->min_prepare_time;
				 return $this->respondWithSuccess('Restaurant info.', $output);
				}
				else{
					return $this->respondWithError('Restaurant info..!!!',$output);
					}
			}
		}
	public function myreservation(){
		    $this->load->library('form_validation');
			$this->form_validation->set_rules('customer_id', 'customer id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
				$errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$cid=$this->input->post('customer_id');
				$tableinfo=$this->db->select("tblreservation.*,rest_table.tablename")->from('tblreservation')->join('rest_table','rest_table.tableid=tblreservation.tableid','left')->where('tblreservation.cid',$cid)->order_by('tblreservation.reserveid','desc')->limit('15')->get()->result();
				$output = $categoryIDs = array();
                if ($cid != FALSE) {
					$k = 0;
					 foreach ($tableinfo as $mytable) {
						 $output['reserveinfo'][$k]['TableName']             = $mytable->tablename;
						 $output['reserveinfo'][$k]['Capacity']              = $mytable->person_capicity;
						 $output['reserveinfo'][$k]['formtime']              = $mytable->formtime;
						 $output['reserveinfo'][$k]['totime']                = $mytable->totime;
						 $output['reserveinfo'][$k]['reserveday']            = $mytable->reserveday;
						 $output['reserveinfo'][$k]['status']                = $mytable->status;
						 $k++;
						 }
                    return $this->respondWithSuccess('My Reserver List.', $output);
                } else {
                    return $this->respondWithError('Reserver Not Found.!!!',$output);
                }
            }
		}
	public function reservation(){
		    $this->load->library('form_validation');
			$this->form_validation->set_rules('person', 'person', 'required|xss_clean|trim');
			$this->form_validation->set_rules('reservedate', 'reservedate', 'required|xss_clean|trim');
			$this->form_validation->set_rules('reservetime', 'reservetime', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
				$errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$person=$this->input->post('person');
				$reservedate=$this->input->post('reservedate');
				$reservetime=$this->input->post('reservetime');
				$gettable = $this->Api_v2_model->checkavailtable($person,$reservedate,$reservetime);
				$tableinfo=$this->Api_v2_model->checkfree($gettable,$person);
				$output = $categoryIDs = array();
                if ($tableinfo != FALSE) {
					$k = 0;
					 foreach ($tableinfo as $freetable) {
						 
						 $output['tableinfo'][$k]['TableID']	           = $freetable->tableid;
						 $output['tableinfo'][$k]['TableName']             = $freetable->tablename;
						 $output['tableinfo'][$k]['Capacity']            	= $freetable->person_capicity;
						 $output['tableinfo'][$k]['TableImage']              = base_url().$freetable->table_icon;
						 $k++;
						 }
                    return $this->respondWithSuccess('All  Free Table.', $output);
                } else {
                    return $this->respondWithError('Table Not Found.!!!',$output);
                }
            }
		}
	public function booking(){
		    $this->load->library('form_validation');
			$this->form_validation->set_rules('customer_id', 'customer id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('person', 'person', 'required|xss_clean|trim');
			$this->form_validation->set_rules('reservedate', 'reservedate', 'required|xss_clean|trim');
			$this->form_validation->set_rules('reservetime', 'reservetime', 'required|xss_clean|trim');
			$this->form_validation->set_rules('endtime', 'endtime', 'required|xss_clean|trim');
			$this->form_validation->set_rules('Name', 'Name', 'required|xss_clean|trim');
			$this->form_validation->set_rules('Phone', 'Phone', 'required|xss_clean|trim');
			$this->form_validation->set_rules('Tableid', 'Tableid', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
				$errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else{
				$person=$this->input->post('person');
				$reservedate=$this->input->post('reservedate');
				$reservetime=$this->input->post('reservetime');
				$endtime=$this->input->post('endtime');
				$Name=$this->input->post('Name');
				$Phone=$this->input->post('Phone');
				$email=$this->input->post('email');
				$tableid=$this->input->post('Tableid');
				$customerid=$this->input->post('customer_id');
				    $status=1;
					$udata = array('status'       => 1);
					
				 $rerturnid=$customerid;
				  $postData =array(
				   'cid' 	 			 => $rerturnid,
				   'tableid' 	 		 => $tableid,
				   'person_capicity' 	 => $person,
				   'formtime' 	 		 => $reservetime,
				   'totime' 	 		 => $endtime,
				   'reserveday' 	 	 => $reservedate,
				   'customer_notes'      => $this->input->post('message'),
				   'status' 	 	     => 1,
				  );
				
				  $this->db->insert('tblreservation',$postData);
				   $reserveid=$this->db->insert_id();
	  				
					if(!empty($reserveid)) { 
					 $this->db->where('tableid',$tableid);
					 $this->db->update('rest_table',$udata);
					$output = $categoryIDs = array();
					$customerinfo=$this->db->select("*")->from('customer_info')->where('customer_id',$rerturnid)->get()->row();
					$reservationinfo= $this->Api_v2_model->bookinginfo($reserveid);
					 if ($reservationinfo != FALSE) {
									 $output['TableID']	             = $reservationinfo->tableid;
									 $output['TableName']             = $reservationinfo->tablename;
									 $output['Capacity']              = $reservationinfo->person_capicity;
									 $output['Reservedate']           = $reservationinfo->reserveday;
									 $output['Starttime']	           = $reservationinfo->formtime;
									 $output['Endtime']               = $reservationinfo->totime;
									 $output['customer_notes']        = $reservationinfo->customer_notes;
									 /*PUSH Notification For Customer*/			 
									 $icon=base_url('assets/img/applogo.png');
									$content = array(
										"en" => "Dear Sir/Madam ".$customerinfo->customer_name." Table:".$reservationinfo->tablename." Your Reservation Under Process...",
									);
									$title = array(
										"en" => "New Reservation",
									);
									$fields = array(
										'app_id' => "208455d9-baca-4ed2-b6be-12b466a2efbd",
										'include_player_ids' => array($customerinfo->customer_token), 
										'data' => array(
										'type' => "order place",
										'logo' => $icon
										),
										'contents' => $content,
										'headings' => $title,
									);

									$fields = json_encode($fields);
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
									curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
									curl_setopt($ch, CURLOPT_HEADER, FALSE);
									curl_setopt($ch, CURLOPT_POST, TRUE);
									curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
									$response = curl_exec($ch);
									curl_close($ch);
								  /*Push Notification*/
								return $this->respondWithSuccess('Reservation Information.', $output);
							} else {
								return $this->respondWithError('Not Reserve.!!!',$output);
							}
					}
				
		}
	}
	
	public function paymentmethod(){
		$output = $categoryIDs = array();
		 $paymentmethod = $this->Api_v2_model->read_all('*', 'payment_method', 'is_active', 1, 'payment_method_id', 'ASC');
			 if(!empty($paymentmethod)){
				 $i=0;
			 	foreach($paymentmethod as $method){
					if($method->payment_method_id!=1){
						 $output[$i]['Pay_type']=$method->payment_method_id;
						 $output[$i]['Pay_name']=$method->payment_method;
						 $i++;
						}
					}
				 return $this->respondWithSuccess('All  Payment Method', $output);	
			 }
			 else{
				  return $this->respondWithError('Payment Method Not Found.!!!',$output);
				 }
		}
	public function coupon(){
			$this->load->library('form_validation');
		    $this->form_validation->set_rules('CouponCode', 'Coupon Code', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
		    $output = array();
		    $couponcode=$this->input->post('CouponCode');
			$couponinfo=$this->Api_v2_model->read('*', 'tbl_token', array('tokencode' => $couponcode));
			
		    if(!empty($couponinfo)){
				$startdate = strtotime($couponinfo->tokenstartdate);
				$enddate = strtotime($couponinfo->tokenendate);
				$today = date('Y-m-d');
				$date_timestamp = strtotime($today);
				if(($date_timestamp>=$startdate) && ($date_timestamp<$enddate)){
					$output['CouponPrice']=$couponinfo->tokenrate;
					$output['CouponCode']=$couponinfo->tokencode;
					
					return $this->respondWithSuccess('Coupon Found', $output);	
					}
				 else{
				     
					 return $this->respondWithError('Coupon Not Valid!!', $output);
					 }
				}
			else{
				 return $this->respondWithError('Coupon Not Found!!',$output);
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
		
		//insert Coa for Customer Receivable

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
		$orderinfo['cutomertype']   	=2;
		$orderinfo['waiter_id']   		='';
		$orderinfo['order_date']  		=$newdate;
		$orderinfo['order_time'] 		=date('H:i:s');
		$orderinfo['totalamount']   	=$this->input->post('grandtotal');
		$orderinfo['table_no']  		=0;
		$orderinfo['customer_note'] 	=$this->input->post('ordre_notes');
		$orderinfo['order_status'] 		=1;
		$orderid=$this->Api_v2_model->insert_data('customer_order', $orderinfo);
		
		if(!empty($this->input->post('CouponCode'))){
		    $coupon['orderid']   			=$orderid;
			$coupon['couponcode']   		=$this->input->post('CouponCode');
			$coupon['couponrate']   	    =$this->input->post('CouponPrice');
			$this->Api_v2_model->insert_data('usedcoupon', $coupon);
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
		$this->Api_v2_model->insert_data('tbl_billingaddress', $bill);
		

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
		$this->Api_v2_model->insert_data('tbl_shippingaddress', $ship);
		}
		else{
			$this->Api_v2_model->insert_data('tbl_shippingaddress', $bill);
			}
			
		//Order transaction
		$paymentsatus=$this->input->post('Pay_type');
		if($this->Api_v2_model->orderitem($orderid,$customerid)) { 
		

		 $settinginfo=$this->Api_v2_model->read('*', 'setting', array('id' => 2));
		$currencyinfo=$this->Api_v2_model->read('*', 'currency', array('currencyid' => $settinginfo->currency));
		$paymentsetup=$this->Api_v2_model->read('*', 'paymentsetup', array('paymentid' => $paymentsatus));
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
		    $scan = scandir('application/modules/');
		    $pointsys="";
			 foreach($scan as $file) {
				 if($file=="loyalty"){
					 if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
						 $pointsys=1;
					 }
				 }
			 }  
			 $output['CustomerName']=$this->input->post('full_name');
			 $output['amount']=$this->input->post('grandtotal');
			 $output['OrderID']=$orderid;
			 $output['email']=$this->input->post('email');
			 $output['phone']=$this->input->post('phone');
			 $output['address']=$this->input->post('billing_address');
			
			/*PUSH Notification For Customer*/
			 $gtotal=$this->input->post('grandtotal', TRUE);
			 $icon=base_url('assets/img/applogo.png');
            $content = array(
                "en" => "Order ID: ".$orderid." Order amount:".number_format($gtotal,2),
            );
            $title = array(
                "en" => "New Order Placed",
            );
            $fields = array(
                'app_id' => "208455d9-baca-4ed2-b6be-12b466a2efbd",
                'include_player_ids' => array($customerinfo->customer_token), 
                'data' => array(
                'type' => "order place",
                'logo' => $icon
                ),
                'contents' => $content,
                'headings' => $title,
            );

            $fields = json_encode($fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $response = curl_exec($ch);
            curl_close($ch);        
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
		define( 'API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX');
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
			 /*PUSH Notification For Waiter ios*/			
            $content = array(
                "en" => "Order ID: ".$orderid." Order amount:".number_format($gtotal,2),
            );
            $title = array(
                "en" => "New Order Placed",
            );
            $fields = array(
                'app_id' => "208455d9-baca-4ed2-b6be-12b466a2efbd",
                "included_segments"=> array("All"),
                'data' => array(
                'type' => "order place",
                'logo' => $icon
                ),
                'contents' => $content,
                'headings' => $title,
            );

            $fields = json_encode($fields);
            $ch3 = curl_init();
            curl_setopt($ch3, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
            curl_setopt($ch3, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch3, CURLOPT_HEADER, FALSE);
            curl_setopt($ch3, CURLOPT_POST, TRUE);
            curl_setopt($ch3, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, FALSE);
            $response = curl_exec($ch3);
            curl_close($ch3);        
       /*Push Notification*/
		return $this->respondWithSuccess('Order Placed Successfully', $output);		
		 }
		} else {
		  return $this->respondWithError('Order Not Placed!!!',$output);
		}
			}
		
		}
    public function onlinepayment(){
			  $this->load->library('paypal_lib'); 
			 
				
			$orderid=$this->input->get('Orderid');
			$paymentsatus=$this->input->get('Paymentid');
			$billinfo = $this->Api_v2_model->read('*', 'bill', array('order_id' => $orderid));
			$customer = $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $billinfo->customer_id));
			$settinginfo=$this->Api_v2_model->read('*', 'setting', array('id' => 2));
		    $currencyinfo=$this->Api_v2_model->read('*', 'currency', array('currencyid' => $settinginfo->currency));
		    $paymentsetup=$this->Api_v2_model->read('*', 'paymentsetup', array('paymentid' => $paymentsatus));
			$commonsetting=$this->Api_v2_model->read('*', 'common_setting', array('id' => 1));

			if($paymentsatus==5){
				 
			$full_name = $customer->customer_name;
			$email = $customer->customer_email;
			$phone = $customer->customer_phone;
			$amount =  $billinfo->bill_amount;
			$transactionid = $orderid;
			$address = $customer->customer_address;
			
			$post_data = array();
			$post_data['store_id'] = SSLCZ_STORE_ID;
			$post_data['store_passwd'] = SSLCZ_STORE_PASSWD;
			$post_data['total_amount'] =  $billinfo->bill_amount;
			$post_data['currency'] = $paymentsetup->currency;
			$post_data['tran_id'] = $orderid;
			$post_data['success_url'] =  base_url()."android/successful/".$orderid;
			$post_data['fail_url'] = base_url()."android/fail/".$orderid;
			$post_data['cancel_url'] = base_url()."android/cancilorder/".$orderid;
			

			# CUSTOMER INFORMATION
			$post_data['cus_name'] = $customer->customer_name;
			$post_data['cus_email'] = $customer->customer_email;
			$post_data['cus_add1'] = $customer->customer_address;
			$post_data['cus_add2'] = "";
			$post_data['cus_city'] = "";
			$post_data['cus_state'] = "";
			$post_data['cus_postcode'] = "";
			$post_data['cus_country'] = "";
			$post_data['cus_phone'] = $customer->customer_phone;
			$post_data['cus_fax'] = "";

			# SHIPMENT INFORMATION
			$post_data['ship_name'] = "";
			$post_data['ship_add1 '] = "";
			$post_data['ship_add2'] = "";
			$post_data['ship_city'] = "";
			$post_data['ship_state'] = "";
			$post_data['ship_postcode'] = "";
			$post_data['ship_country'] = "";

			# OPTIONAL PARAMETERS
			$post_data['value_a'] = "";
			$post_data['value_b '] = "";
			$post_data['value_c'] = "";
			$post_data['value_d'] = "";

			$this->load->library('session');
			$session = array(
				'tran_id' => $post_data['tran_id'],
				'amount' => $post_data['total_amount'],
				'currency' => $post_data['currency']
			);
			$this->session->set_userdata('tarndata', $session);


			$this->load->library('sslcommerz');
			echo "<h3>Wait...SSLCOMMERZ Payment Processing....</h3>";
	
			if($this->sslcommerz->RequestToSSLC($post_data, false))
			{
				

				redirect('android/fails');
			}
				
				}
		    else if($paymentsatus==3){
            $item_name = "Food List";
            // ---------------------
            //Set variables for paypal form
            $returnURL = base_url()."android/successful/".$orderid; //payment success url
            $cancelURL = base_url()."android/cancilorder/".$orderid; //payment cancel url
            $notifyURL = base_url('android/ipn'); //ipn url
           
             // set form auto fill data
            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);

            // item information
            $this->paypal_lib->add_field('item_number',  $orderid);
            $this->paypal_lib->add_field('item_name', $item_name);
            $this->paypal_lib->add_field('amount', $billinfo->bill_amount);  
            $this->paypal_lib->add_field('quantity', 1);    
     

            // additional information 
            $this->paypal_lib->add_field('custom', 'paynow');
            $this->paypal_lib->image(base_url($commonsetting->logo));
            // generates auto form
            $this->paypal_lib->paypal_auto_form();
			 }
		    else if($paymentsatus==2){
				if($paymentsetup->Islive==1){
				$action_url="https://www.2checkout.com/checkout/purchase";
				 }
			else{
				$action_url="https://sandbox.2checkout.com/checkout/purchase";
				}
			 ?>
			  <form id="payment_gw" name="payment_gw" method="POST" action="<?php echo $action_url;?>">
			 <input type='hidden' name='sid' value='<?php echo $paymentsetup->marchantid;?>' />
            <input type='hidden' name='mode' value='2CO' />
            <input type='hidden' name='li_0_type' value='product' />
            <input type='hidden' name='li_0_name' value='<?php echo $orderid;?>' />
            <input type='hidden' name='x_receipt_link_url' value='<?php echo base_url();?>android/successful2/<?php echo $orderid;?>' /> 
            <input type='hidden' name='li_0_price' value='<?php echo $billinfo->bill_amount;?>' />
            <input type='hidden' name='card_holder_name' value='<?php echo $customer->customer_name;?>' />
            <input type='hidden' name='street_address' value='<?php echo $customer->customer_address;?>' />
            <input type='hidden' name='street_address2' value='<?php echo $customer->customer_address;?>' />
            <input type='hidden' name='city' value='NA' />
            <input type='hidden' name='state' value='NA' />
            <input type='hidden' name='zip' value='NA' />
            <input type='hidden' name='country' value='NA' />
            <input type='hidden' name='email' value='<?php echo $customer->customer_email;?>' />
            <input type='hidden' name='phone' value='<?php echo $customer->customer_phone;?>' />
            <input name='pay' class="btn btn-success btn-large cusbtn" type='submit' value='Checkout' style="display:none;" />
            </form>
				<?php 
				 echo "<script>
            window.onload = function(){
              document.forms['payment_gw'].submit()
            }        
        </script>";
				}
			
			}
	public function ipn(){
				//paypal return transaction details array
				$paypalInfo    = $this->input->post(); 
				$data['user_id']        = $paypalInfo['custom'];
				$data['product_id']     = $paypalInfo["item_number"];
				$data['txn_id']         = $paypalInfo["txn_id"];
				$data['payment_gross']  = $paypalInfo["mc_gross"];
				$data['currency_code']  = $paypalInfo["mc_currency"];
				$data['payer_email']    = $paypalInfo["payer_email"];
				$data['payment_status'] = $paypalInfo["payment_status"];
		
				$paypalURL = $this->paypal_lib->paypal_url;     
				$result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
				
				
			}
	public function successful($orderid){
		   $billinfo = $this->Api_v2_model->read('*', 'bill', array('order_id' => $orderid));
		   $orderinfo  	       = $this->Api_v2_model->read('*', 'customer_order', array('order_id' => $orderid));
		   $customerid 	   = $orderinfo->customer_id;
		   $scan = scandir('application/modules/');
			$getcus="";
			foreach($scan as $file) {
			   if($file=="loyalty"){
				   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
				   $getcus=$customerid;
				   }
				   }
			}
			$totalgrtotal=round($orderinfo->totalamount);
			if(!empty($getcus)){
			    $isexitscusp=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$customerid)->get()->row();
			    	$checkpointcondition="$totalgrtotal BETWEEN amountrangestpoint AND amountrangeedpoint";
			$getpoint=$this->db->select("*")->from('tbl_pointsetting')->get()->row();
			$calcpoint=$getpoint->earnpoint/$getpoint->amountrangestpoint;
			$thisordpoint=$calcpoint*$totalgrtotal;
					 if(empty($isexitscusp)){
						$updateum = array('membership_type' => 1);
					    $this->db->where('customer_id',$customerid);
					    $this->db->update('customer_info',$updateum);
					  $pointstable2 = array(
					   'customerid'   => $customerid,
					   'amount'       => $totalgrtotal,
					   'points'       => $thisordpoint+10
					  );
					  $this->Api_v2_model->insert_data('tbl_customerpoint', $pointstable2);
					 }
					 else{
						 	$pamnt=$isexitscusp->amount+$totalgrtotal;
							$tpoints=$isexitscusp->points+$thisordpoint;
						 	$updatecpoint = array('amount' => $pamnt,'points'=>$tpoints);
							$this->db->where('customerid',$customerid);
							$this->db->update('tbl_customerpoint',$updatecpoint);
						 }
					 $updatemember=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$customerid)->get()->row();
					 $lastupoint=$updatemember->points;
					 $updatecond="'".$lastupoint."' BETWEEN startpoint AND endpoint";
					 $checkmembership=$this->db->select("*")->from('membership')->where($updatecond)->get()->row();
					 if(!empty($checkmembership)){
						 $updatememsp = array('membership_type' => $checkmembership->id);
					     $this->db->where('customer_id',$customerid);
					     $this->db->update('customer_info',$updatememsp);						 
						 }
				  }
		   
		    $updatetData = array('bill_status'     => 1,'create_at'=> date('Y-m-d H:i:s'));
			$this->db->where('order_id',$orderid);
			$this->db->update('bill',$updatetData);
			
			$updatetData2 = array('order_status'     => 4);
			$this->db->where('order_id',$orderid);
			$this->db->update('customer_order',$updatetData2);
			$customerinfo= $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $customerid));
		   
			$output = $categoryIDs = array();
		     /*PUSH Notification For Customer*/
			 
			 $icon=base_url('assets/img/applogo.png');
            $content = array(
                "en" => "Order ID: ".$orderid." Order amount:".number_format($orderinfo->totalamount,2),
            );
            $title = array(
                "en" => "New Order Placed",
            );
            $fields = array(
                'app_id' => "208455d9-baca-4ed2-b6be-12b466a2efbd",
                'include_player_ids' => array($customerinfo->customer_token), 
                'data' => array(
                'type' => "order place",
                'logo' => $icon
                ),
                'contents' => $content,
                'headings' => $title,
            );

            $fields = json_encode($fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $response = curl_exec($ch);
            curl_close($ch);        
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
					'amount'					=> $orderinfo->totalamount
				);
		$message = json_encode( $newmsg );	
		define( 'API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX' );
				$registrationIds = $senderid;
				$msg = array
				(
					'message' 					=> "Orderid:".$orderid.", Amount:".$orderinfo->totalamount,
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
			echo '<img style="inline-size: 100%;" src="'.base_url().'/assets/img/icons/order1.jpg"/>';
					
		}	
	public function successful2(){
		$orderid=$this->input->post('li_0_name');
		
		   $billinfo = $this->Api_v2_model->read('*', 'bill', array('order_id' => $orderid));
		   $orderinfo  	       = $this->Api_v2_model->read('*', 'customer_order', array('order_id' => $orderid));
		   $customerid 	   = $orderinfo->customer_id;
		   $scan = scandir('application/modules/');
			$getcus="";
			foreach($scan as $file) {
			   if($file=="loyalty"){
				   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
				   $getcus=$customerid;
				   }
				   }
			}
		
			$totalgrtotal=round($orderinfo->totalamount);
		
			if(!empty($getcus)){
			    	$isexitscusp=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$customerid)->get()->row();
			$checkpointcondition="$totalgrtotal BETWEEN amountrangestpoint AND amountrangeedpoint";
			$getpoint=$this->db->select("*")->from('tbl_pointsetting')->get()->row();
			$calcpoint=$getpoint->earnpoint/$getpoint->amountrangestpoint;
			$thisordpoint=$calcpoint*$totalgrtotal;
					 if(empty($isexitscusp)){
						$updateum = array('membership_type' => 1);
					    $this->db->where('customer_id',$customerid);
					    $this->db->update('customer_info',$updateum);
					  $pointstable2 = array(
					   'customerid'   => $customerid,
					   'amount'       => $totalgrtotal,
					   'points'       => $thisordpoint+10
					  );
					  $this->Api_v2_model->insert_data('tbl_customerpoint', $pointstable2);
					 }
					 else{
						 	$pamnt=$isexitscusp->amount+$totalgrtotal;
							$tpoints=$isexitscusp->points+$thisordpoint;
						 	$updatecpoint = array('amount' => $pamnt,'points'=>$tpoints);
							$this->db->where('customerid',$customerid);
							$this->db->update('tbl_customerpoint',$updatecpoint);
						 }
					 $updatemember=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$customerid)->get()->row();
					 $lastupoint=$updatemember->points;
					 $updatecond="'".$lastupoint."' BETWEEN startpoint AND endpoint";
					 $checkmembership=$this->db->select("*")->from('membership')->where($updatecond)->get()->row();
					 if(!empty($checkmembership)){
						 $updatememsp = array('membership_type' => $checkmembership->id);
					     $this->db->where('customer_id',$customerid);
					     $this->db->update('customer_info',$updatememsp);						 
						 }
				  }
		   $updatetData = array('bill_status'     => 1);
		   $this->db->where('order_id',$orderid);
		   $this->db->update('bill',$updatetData);
		
		$updatetData2 = array('order_status'     => 4);
		$this->db->where('order_id',$orderid);
		$this->db->update('customer_order',$updatetData2);
		$customerinfo= $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $customerid));
		    
			$output = $categoryIDs = array();
			/*PUSH Notification For Customer*/
			 
			 $icon=base_url('assets/img/applogo.png');
            $content = array(
                "en" => "Order ID: ".$orderid." Order amount:".number_format($orderinfo->totalamount,2),
            );
            $title = array(
                "en" => "New Order Placed",
            );
            $fields = array(
                'app_id' => "208455d9-baca-4ed2-b6be-12b466a2efbd",
                'include_player_ids' => array($customerinfo->customer_token), 
                'data' => array(
                'type' => "order place",
                'logo' => $icon
                ),
                'contents' => $content,
                'headings' => $title,
            );

            $fields = json_encode($fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $response = curl_exec($ch);
            curl_close($ch);        
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
					'amount'					=> $orderinfo->totalamount
				);
		$message = json_encode( $newmsg );	
		define( 'API_ACCESS_KEY', 'AAAAW3kqYNI:AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX' );
				$registrationIds = $senderid;
				$msg = array
				(
					'message' 					=> "Orderid:".$orderid.", Amount:".$orderinfo->totalamount,
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
		
		$output = $categoryIDs = array();
		echo '<img style="inline-size: 100%;" src="'.base_url().'/assets/img/icons/order1.jpg"/>';
		
		}		
	public function fail($orderid){
		  $output = $categoryIDs = array();
		  echo '<img style="inline-size: 100%;" src="'.base_url().'/assets/img/icons/ordercancel1.jpg"/>';
		  	
		}	
	public function cancilorder($orderid){
		$output = $categoryIDs = array();
		echo '<img style="inline-size: 100%;" src="'.base_url().'/assets/img/icons/ordercancel1.jpg"/>';
				
		}
   public function customerorderlist(){
		    $this->load->library('form_validation');
            $this->form_validation->set_rules('Customerid', 'Customerid', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$output=array();
				$Customerid=$this->input->post('Customerid');
				$custinfo = $this->Api_v2_model->read('*', 'customer_info', array('customer_id' => $Customerid));
				$orderlist= $this->Api_v2_model->customerorder($custinfo->customer_id);
				if(!empty($orderlist)){
					$i=0;
					foreach($orderlist as $list){
					$status='';
					if($list->order_status==1){
						$status="Pending";
						}
					else if($list->order_status==2){
						$status="Processing";
						}
					else if($list->order_status==3){
						$status="Ready";
						}
					else if($list->order_status==4){
						$status="Served";
						}
					else if($list->order_status==5){
						$status="Cancel";
						}
						$output['orderinfo'][$i]['saleinvoice']=$list->saleinvoice;
						$output['orderinfo'][$i]['Orderamount']=$list->totalamount;
						$output['orderinfo'][$i]['orderdate']=$list->order_date;
						
						$output['orderinfo'][$i]['discount']=$list->discount;
						$output['orderinfo'][$i]['servicecharge']=$list->service_charge;
						$output['orderinfo'][$i]['VAT']=$list->VAT;
						$output['orderinfo'][$i]['cancelreason']=$list->anyreason;
						$output['orderinfo'][$i]['status']=$status;
					    $orderinvoice=$list->order_id;
						$fooditem= $this->Api_v2_model->customerfoodlist($orderinvoice);
						
						if(!empty($fooditem)){
							  $k=0;
							  foreach($fooditem as $foodlist){
								  if(empty($foodlist->OffersRate)){
								  $offerrate=0;
								  }
								  else{
								   $offerrate=$foodlist->OffersRate;
								  }
								  $foodinfo=$this->Api_v2_model->productvarient($foodlist->menu_id,$foodlist->varientid);
								  if(!empty($foodinfo)){
								  $output['orderinfo'][$i]['foodlist'][$k]['ProductName']=$foodinfo->ProductName;
								  $output['orderinfo'][$i]['foodlist'][$k]['qty']=$foodlist->menuqty;
								  $output['orderinfo'][$i]['foodlist'][$k]['OffersRate']=$offerrate;
								  $output['orderinfo'][$i]['foodlist'][$k]['variantName']=$foodinfo->variantName;
								  $output['orderinfo'][$i]['foodlist'][$k]['variantPrice']=$foodinfo->price;
								 if(!empty($foodlist->add_on_id)){
									 $output['orderinfo'][$i]['foodlist'][$k]['addons'] 			 = 1;
									  $addons=explode(",",$foodlist->add_on_id);
									 
									  $addonsqtym=explode(",",$foodlist->addonsqty);
									 
										 $x=0;
										 $addonsname='';
										 $addonsprice='';
										 $addonsqty='';
										 foreach($addons as $addonsid){
										     
											$adonsinfo=$this->Api_v2_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
											 
											$addonsname.=$adonsinfo->add_on_name.',';
											$addonsprice.=$adonsinfo->price.',';
											$addonsqty.=$addonsqtym[$x].',';
											$x++;
										 }
										 $addonsname=trim($addonsname,',');
										 $addonsprice=trim($addonsprice,',');
										 $addonsqty=trim($addonsqty,',');
										 $output['orderinfo'][$i]['foodlist'][$k]['add_on_name']=$addonsname;
										 $output['orderinfo'][$i]['foodlist'][$k]['addonsprice']=$addonsprice;
										 $output['orderinfo'][$i]['foodlist'][$k]['add_on_qty']=$foodlist->addonsqty;
										 
										}
								 else{
									 $output['orderinfo'][$i]['foodlist'][$k]['addons'] 			 = 0;
									 }
									 $k++;
								  }
								  }
							}
							$i++;
					}
					return $this->respondWithSuccess('Order History.', $output);
					}
				else{
				    return $this->respondWithError('Order not fount!!!',$output);
					
				}
				
			}
		}
	public function customer_review()
    {
          // TO DO / Email or Phone only one required
		  $this->load->library('form_validation');
		  $this->form_validation->set_rules('email','Email','required');
		  $this->form_validation->set_rules('name', 'Nmae','required');
			
				
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$data['title']                      = $this->input->post('title', TRUE);
                $data['name']    			        = $this->input->post('name', TRUE);
                $data['reviewtxt']  			    = $this->input->post('reviewtxt', TRUE);
                $data['proid']            		    = $this->input->post('ProductID', TRUE);
                $data['rating']    		            = $this->input->post('Rating', TRUE);
                $data['status']      		        = 1;
				$data['email']      		        = $this->input->post('email', TRUE);
				$data['ratetime']      		        = date('Y-m-d H:i:s');
                $insert_ID = $this->Api_v2_model->insert_data('tbl_rating', $data);
                if ($insert_ID) {
                    $output = $this->Api_v2_model->read("*", 'tbl_rating', array('ratingid' => $insert_ID));
					return $this->respondWithSuccess('You have successfully Review This Product', $output);
                } else {
                    return $this->respondWithError('Sorry, Review not Submitted!!!');
                }
            }
    }
    public function customer_reviewlist()
    {
          // TO DO / Email or Phone only one required
		  $this->load->library('form_validation');
		  $this->form_validation->set_rules('ProductsID','ProductsID','required');
		  $this->form_validation->set_rules('Limit', 'Limit','required');
			
				
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				 $output =array();
			     $proid=$this->input->post('ProductsID', TRUE);
			     $limit=$this->input->post('Limit', TRUE);
                $myreview = $this->Api_v2_model->allreviewlist($proid,$limit);
                if ($myreview) {
                    $i=0;
                   foreach($myreview as $review){
                       $myemail=$review->email;
                       $customerinfo=$this->db->select("*")->from('customer_info')->where('customer_email',$myemail)->get()->row();
                        $output['Reviewlist'][$i]['rating'] = round($review->rating);
                        $output['Reviewlist'][$i]['title'] =$review->title;
                        $output['Reviewlist'][$i]['name'] =$review->name;
                        $output['Reviewlist'][$i]['reviewtext'] =$review->reviewtxt;
                        $output['Reviewlist'][$i]['email'] =$review->email;
                        $output['Reviewlist'][$i]['time'] =date("F ,d, Y", strtotime($review->ratetime));
                        $output['Reviewlist'][$i]['picture'] = $customerinfo->customer_picture;
                        $output['Reviewlist'][$i]['fullpicturepath'] = $this->_get_user_profile_picture_url($customerinfo);
                        
                       $i++;
                   }
                 
					return $this->respondWithSuccess('Found Review List', $output);
                } else {
                    return $this->respondWithError('Sorry, Review not Found!!!');
                }
            }
    }
     public function pointing(){
          $this->load->library('form_validation');
		  $this->form_validation->set_rules('customer_id','customer_id','required');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
               $output =array();
			   $customer=$this->input->post('customer_id', TRUE); 
			   $customerinfo=$this->db->select("*")->from('customer_info')->where('customer_id',$customer)->get()->row();
			   $scan = scandir('application/modules/');
			   $getcus="";
			   foreach($scan as $file) {
			   if($file=="loyalty"){
				   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
				   $getcus=$customerid;
				   }
				   }
			}
			if(!empty($getcus)){
			   $customerpoint=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$customer)->get()->row();
			   $customerlabel=$this->db->select("*")->from('membership')->where('id',$customerinfo->membership_type)->get()->row();
				if(!empty($customerpoint)){
				 $output['pointssystem']="Enable";
				 $output['points']=$customerpoint->points;
				 $output['membershiplabel']=$customerlabel->membership_name;
                 $output['DiscountRate']=$customerlabel->discount;
				}
				else{
				 $output['pointssystem']="Enable";
				 $output['points']=0;
				 $output['membershiplabel']=$customerlabel->membership_name;
                 $output['DiscountRate']=0;
				}
			}else{
			     $output['pointssystem']="Disable";
			     $output['points']=0;
				 $output['membershiplabel']="";
                 $output['DiscountRate']=0;
			}
				return $this->respondWithSuccess('Customer Point Information', $output);
            }
        
    }
}
				