<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class V1 extends MY_Controller {

    protected $FILE_PATH;
    
    public function __construct()
    {
            parent::__construct();
			$this->load->library('lsoft_setting');
            $this->load->model('Api_v1_model');
            
            $this->FILE_PATH = base_url('upload/');
    }

    public function index()
    {
            redirect('myurl');
    }

    public function sign_in()
    {
            // TO DO / Email or Phone only one required
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
            $this->form_validation->set_rules('token', 'token', 'xss_clean|trim');
            

            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                $data['email']      = $this->input->post('email', TRUE);
                $data['password']   = $this->input->post('password', TRUE);
           

                $IsReg = $this->Api_v1_model->checkEmailOrPhoneIsRegistered('user', $data);

                if(!$IsReg) {
                    return $this->respondUserNotReg('This email or phone number has not been registered yet.');
                }
                $result = $this->Api_v1_model->authenticate_user('user', $data);
                
          
				$updatetData['waiter_kitchenToken']    			= $this->input->post('token', TRUE);
				$this->Api_v1_model->update_date('user', $updatetData, 'id', $result->id);
          
				$webseting =$this->Api_v1_model->read('powerbytxt,currency,servicecharge,service_chargeType', 'setting', array('id' => 2));
				$currencyinfo = $this->Api_v1_model->read('currencyname,curr_icon', 'currency', array('currencyid' => $webseting->currency));
				
                
                if ($result != FALSE) {
					$str = substr($result->picture, 2);
					$result->{"UserPictureURL"}=base_url().$str;
					$result->{"PowerBy"}=$webseting->powerbytxt;
					$result->{"currencycode"}=$currencyinfo->currencyname;
					$result->{"currencysign"}=$currencyinfo->curr_icon;
					$result->{"servicecharge"}=$webseting->servicecharge;
					$result->{"service_chargeType"}=$webseting->service_chargeType;
                    return $this->respondWithSuccess('You have successfully logged in.', $result);
                } else {
                    return $this->respondWithError('The email and password you entered don\'t match.',$result);
                }
            }
    }
public function categorylist()
     {
            // TO DO / Email or Phone only one required
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				$catid=$this->input->post('Name', TRUE);
                $result = $this->Api_v1_model->categorylist($catid);
				 $output = $categoryIDs = array();
                if ($result != FALSE) {
					 $i = 0;
					 foreach ($result as $list) {
						$image = substr($list->CategoryImage, 2);
						$output[$i]['CategoryID']  		= $list->CategoryID;
						$output[$i]['Name']  	   		= $list->Name;
						$output[$i]['categoryimage']  	= base_url().$image;
						
						$i++;
                            }
                    return $this->respondWithSuccess('All Category List.', $output);
                } else {
					
                    return $this->respondWithError('No Category Found.!!!',$output);
                }
            }
    }
    public function checktable(){
         $this->load->library('form_validation'); 
		 $this->form_validation->set_rules('tableid','Table No','required');
		 if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
              $output=array();
			  $tableid=$this->input->post('tableid');
			  $custinfo = $this->Api_v1_model->read('*', 'rest_table', array('tableid' => $tableid));
			  if(!empty($custinfo)){ 
			      $output['table_no']=$tableid;
			      return $this->respondWithSuccess('Table Exists.', $output);
			  }
			  else{
			   $output['table_no']="";
			   return $this->respondWithError('Table Not found!!!',$output);   
			  }
            }
    }
	 public function foodlist()
     {
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('CategoryID', 'CategoryID', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else{
                $CategoryID=$this->input->post('CategoryID', TRUE);
				$allcategory = $this->Api_v1_model->allsublist($CategoryID);
				 $output = $categoryIDs = array();
                
					if ($allcategory != FALSE) {
						$allcarlist='';
						 foreach ($allcategory as $catid) {
							 	 $allcarlist.= $catid->CategoryID.',';
							 }
							$allcarlist=$allcarlist.$CategoryID; 
							
						$result = $this->Api_v1_model->foodlistallcat($allcarlist);	
						}
					else{
						$result = $this->Api_v1_model->foodlist($CategoryID);
						}
					 if ($result != FALSE) {
					 $restinfo = $this->Api_v1_model->read('vat', 'setting', array('id' => 2));
					 $output['PcategoryID']  = $CategoryID;
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
						 }
					 else{
					 $output['Restaurantvat']  = $restinfo->vat;
						}
					$i = 1;
				
					 $output['categoryinfo'][0]['CategoryID']  = $CategoryID;
					 $output['categoryinfo'][0]['Name']  = "All";
					 foreach ($allcategory as $list) {
						 $output['categoryinfo'][$i]['CategoryID']  = $list->CategoryID;
						 $output['categoryinfo'][$i]['Name']  = $list->Name;
						 $i++;
                     }
					
					 $k=0;
					 foreach ($result as $productlist) {
						 $productlist=(object)$productlist;
						 if(!empty($productlist->ProductImage)){
						     $image = $productlist->ProductImage;
						 }
						 else{
						    $image ="assets/img/no-image.png"; 
						 }
						 $addonsinfo= $this->Api_v1_model->findaddons($productlist->ProductsID);
						 $output['foodinfo'][$k]['ProductsID']      = $productlist->ProductsID;
						 $output['foodinfo'][$k]['ProductName']      = $productlist->ProductName;
						 $output['foodinfo'][$k]['ProductImage']     =  base_url().$image;
						 $output['foodinfo'][$k]['component']  	 	 = $productlist->component;
						 $output['foodinfo'][$k]['destcription']  	 = $productlist->descrip;
						 $output['foodinfo'][$k]['itemnotes']  	 	 = $productlist->itemnotes;
						 $output['foodinfo'][$k]['productvat'] 		 = $productlist->productvat;
						 $output['foodinfo'][$k]['OffersRate'] 		 = $productlist->OffersRate;
						 $output['foodinfo'][$k]['offerIsavailable'] = $productlist->offerIsavailable;
						 $output['foodinfo'][$k]['offerstartdate'] 	 = $productlist->offerstartdate;
						 $output['foodinfo'][$k]['offerendate']		 = $productlist->offerendate;
						 $output['foodinfo'][$k]['variantid'] 		 = $productlist->variantid;
						 $output['foodinfo'][$k]['variantName'] 	 = $productlist->variantName;
						 $output['foodinfo'][$k]['price'] 			 = $productlist->price;
						 $output['foodinfo'][$k]['totalvariant'] 	 = $productlist->totalvarient;
						 if($productlist->totalvarient>1){
							 	$allvarients= $this->Api_v1_model->read_all('*','variant','menuid',$productlist->ProductsID,'menuid','ASC');
								$v=0;
								foreach($allvarients as $varientlist){
									$output['foodinfo'][$k]['varientlist'][$v]['multivariantid'] = $varientlist->variantid;
									$output['foodinfo'][$k]['varientlist'][$v]['multivariantName'] = $varientlist->variantName;
									$output['foodinfo'][$k]['varientlist'][$v]['multivariantPrice'] = $varientlist->price;
									$v++;
									}
							 }
						 else{
							 $output['foodinfo'][$k]['varientlist'][0]['multivariantid'] = '';
							 $output['foodinfo'][$k]['varientlist'][0]['multivariantName'] = '';
							 $output['foodinfo'][$k]['varientlist'][0]['multivariantPrice'] = '';
							 }
						 if ($addonsinfo != FALSE) {
						 $output['foodinfo'][$k]['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['foodinfo'][$k]['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['foodinfo'][$k]['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['foodinfo'][$k]['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
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
	 public function foodsearchbycategory()
     {
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('CategoryID', 'CategoryID', 'required|xss_clean|trim');
			$this->form_validation->set_rules('PcategoryID', 'Parent Category', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                $CategoryID=$this->input->post('CategoryID', TRUE);
				$PcategoryID=$this->input->post('PcategoryID', TRUE);
				$allcategory = $this->Api_v1_model->allsublist($PcategoryID);
				 $output = $categoryIDs = array();
					 $result = $this->Api_v1_model->foodlist($CategoryID);
					 $restinfo = $this->Api_v1_model->read('vat', 'setting', array('id' => 2));
					 $output['PcategoryID']  = $CategoryID;
					 if($restinfo==FALSE){
					 $output['Restaurantvat']  = 0;
						 }
					else{
					 $output['Restaurantvat']  = $restinfo->vat;
						}
					
					
					 $output['PcategoryID']  = $PcategoryID;
					 $output['categoryinfo'][0]['CategoryID']  = $PcategoryID;
					 $output['categoryinfo'][0]['Name']  = "All";
					 $i = 1;
					 foreach ($allcategory as $list) {
						 $output['categoryinfo'][$i]['CategoryID']  = $list->CategoryID;
						 $output['categoryinfo'][$i]['Name']  = $list->Name;
						 $i++;
                     }
					 if ($result != FALSE) {
					 $k=0;
					 if($result==FALSE){
						  $output['foodinfo']=array();
						 }
					 else{
					 foreach ($result as $productlist) {
						 $productlist=(object)$productlist;
						 if(!empty($productlist->ProductImage)){
						     $image = $productlist->ProductImage;
						 }
						 else{
						    $image ="assets/img/no-image.png"; 
						 }
						 $addonsinfo= $this->Api_v1_model->findaddons($productlist->ProductsID);
						 $output['foodinfo'][$k]['ProductsID']       = $productlist->ProductsID;
						 $output['foodinfo'][$k]['ProductName']      = $productlist->ProductName;
						 $output['foodinfo'][$k]['ProductImage']     =  base_url().$image;
						 $output['foodinfo'][$k]['component']  	 	 = $productlist->component;
						 $output['foodinfo'][$k]['destcription']  	 = $productlist->descrip;
						 $output['foodinfo'][$k]['itemnotes']  	 	 = $productlist->itemnotes;
						 $output['foodinfo'][$k]['productvat'] 		 = $productlist->productvat;
						 $output['foodinfo'][$k]['OffersRate'] 		 = $productlist->OffersRate;
						 $output['foodinfo'][$k]['offerIsavailable'] = $productlist->offerIsavailable;
						 $output['foodinfo'][$k]['offerstartdate'] 	 = $productlist->offerstartdate;
						 $output['foodinfo'][$k]['offerendate']		 = $productlist->offerendate;
						 $output['foodinfo'][$k]['variantid'] 		 = $productlist->variantid;
						 $output['foodinfo'][$k]['variantName'] 	 = $productlist->variantName;
						 $output['foodinfo'][$k]['price'] 			 = $productlist->price;
						 $output['foodinfo'][$k]['totalvariant'] 	 = $productlist->totalvarient;
						 if($productlist->totalvarient>1){
							 	$allvarients= $this->Api_v1_model->read_all('*','variant','menuid',$productlist->ProductsID,'menuid','ASC');
								$v=0;
								foreach($allvarients as $varientlist){
									$output['foodinfo'][$k]['varientlist'][$v]['multivariantid'] = $varientlist->variantid;
									$output['foodinfo'][$k]['varientlist'][$v]['multivariantName'] = $varientlist->variantName;
									$output['foodinfo'][$k]['varientlist'][$v]['multivariantPrice'] = $varientlist->price;
									$v++;
									}
							 }
						 else{
							 $output['foodinfo'][$k]['varientlist'][0]['multivariantid'] = '';
							 $output['foodinfo'][$k]['varientlist'][0]['multivariantName'] = '';
							 $output['foodinfo'][$k]['varientlist'][0]['multivariantPrice'] = '';
							 }
						 if ($addonsinfo != FALSE) {
						 $output['foodinfo'][$k]['addons'] 			 = 1;
							 $x=0;
							 foreach($addonsinfo as $alladdons){
						 		$output['foodinfo'][$k]['addonsinfo'][$x]['addonsid']   	= $alladdons->add_on_id;
								$output['foodinfo'][$k]['addonsinfo'][$x]['add_on_name']   = $alladdons->add_on_name;
								$output['foodinfo'][$k]['addonsinfo'][$x]['addonsprice']   = $alladdons->price;
								$x++;
							 }
						 	}
						else{
							$output['foodinfo'][$k]['addons'] 			 = 0;
							}
						 $k++;
						 }
					 }
                    return $this->respondWithSuccess('All Category Food List.', $output);
                } else {
                    return $this->respondWithError('Food Not Found.!!!',$output);
                }
            }
    }
	
	public function tablelist(){
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                 
				 $alltable = $this->Api_v1_model->get_all('*', 'rest_table','tableid');
				 $output = $categoryIDs = array();
                if ($alltable != FALSE) {
					$i = 0;
					 foreach ($alltable as $table) {
						 $output[$i]['TableId']  = $table->tableid;
						 $output[$i]['TableName']  = $table->tablename;
						 $i++;
                     }
				
                    return $this->respondWithSuccess('All Table List.', $output);
                } else {
                    return $this->respondWithError('Table Not Found.!!!',$output);
                }
            }
    }
	public function customerlist(){
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                 $memberidID=(int)$this->input->post('id', TRUE);
				 $customer = $this->Api_v1_model->read('*', 'customer_info', array('customer_id' => $memberidID,'is_active'=>1));
				 $output = $categoryIDs = array();
                if ($customer != FALSE) {
						 $output['customer_id']  = $customer->customer_id;
						 $output['CustomerName']  = $customer->customer_name;
				
                    return $this->respondWithSuccess('Customer Info.', $output);
                } else {
                     $output['customer_id']  ="";
                     $output['CustomerName']="";
                    return $this->respondWithError('Customer ID Not Found OR Bolcked!!!',$output);
                }
            }
    }
    public function customerfullist(){
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {                
				 $customerlist = $this->Api_v1_model->read_all('*','customer_info','is_active','1','customer_id','ASC');
				
				 $output = $categoryIDs = array();
                if ($customerlist != FALSE) {						
				         $i = 0;
						 foreach ($customerlist as $customer) {
							 $output[$i]['customer_id']  = $customer->customer_id;
							 $output[$i]['CustomerName']  = $customer->customer_name;
							 $i++;
						 }
                    return $this->respondWithSuccess('Customer Info.', $output);
                } else {
                     $output['customer_id']  ="";
                     $output['CustomerName']="";
                    return $this->respondWithError('Member ID Not Found OR Bolcked!!!',$output);
                }
            }
    }
	
	public function customertype(){
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
                 
				 $customer = $this->Api_v1_model->read('*', 'customer_type', array('customer_type_id' => 1));
				 $output = $categoryIDs = array();
                if ($customer != FALSE) {
						 $output['TypeID']    = $customer->customer_type_id;
						 $output['TypeName']  = $customer->customer_type;
				
                    return $this->respondWithSuccess('Customer Type.', $output);
                } else {
                    return $this->respondWithError('Type Not Found.!!!',$output);
                }
            }
    }
	
	 public function foodcart()
     {
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
            $this->form_validation->set_rules('VatAmount', 'Total VAT', 'xss_clean|required|trim');
			$this->form_validation->set_rules('TableId', 'TableId', 'xss_clean|required|trim');
			$this->form_validation->set_rules('CustomerID', 'CustomerID', 'xss_clean|required|trim');
			
			$this->form_validation->set_rules('Total', 'Cart Total', 'xss_clean|required|trim');
			$this->form_validation->set_rules('Grandtotal', 'Grand Total', 'xss_clean|required|trim');
			$this->form_validation->set_rules('foodinfo', 'foodinfo', 'xss_clean|required|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				 $json = $this->input->post('foodinfo', TRUE);
          
                $gtotal=$this->input->post('Grandtotal', TRUE);
				$ID                 = $this->input->post('id', TRUE);
				$VAT                = $this->input->post('VAT', TRUE);
				$VatAmount          = $this->input->post('VatAmount', TRUE);
				$TableId        	= $this->input->post('TableId', TRUE);
				$CustomerID      	= $this->input->post('CustomerID', TRUE);
				$TypeID      		= 1;
				$ServiceCharge      = $this->input->post('ServiceCharge', TRUE);
				$Discount 			= $this->input->post('Discount', TRUE);
				$Total        		= $this->input->post('Total', TRUE);
				$Grandtotal        	= $this->input->post('Grandtotal', TRUE);
				$customernote       = $this->input->post('CustomerNote', TRUE);
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
				$sino = $cutstr.$sl;
				
				$todaydate=date('Y-m-d');
        		$todaystoken=$this->db->select("*")->from('customer_order')->where('order_date',$todaydate)->order_by('order_id','desc')->get()->row();
        		if(empty($todaystoken)){
        			$mytoken=1;
        		}
        		else{
        			$mytoken=$todaystoken->tokenno+1;
        			}
        		$token_length = strlen((int)$mytoken); 
        		$tokenstr = '00';
        		$newtoken = substr($tokenstr, $token_length); 
        		$tokenno = $newtoken.$mytoken;
				//Inser Order information 
					$data2=array(
						'customer_id'			=>	$CustomerID,
						'saleinvoice'			=>	$sino,
						'cutomertype'		    =>	$TypeID,
						'waiter_id'	        	=>	$ID,
						'order_date'	        =>	$newdate,
						'order_time'	        =>	date('H:i:s'),
						'totalamount'		 	=>  $Grandtotal,
						'table_no'		    	=>	$TableId,
						'tokenno'		        =>	$tokenno,
						'customer_note'		    =>	$customernote,
						'order_status'		    =>	1
					);
			
				$this->db->insert('customer_order',$data2);
				$orderid = $this->db->insert_id();
				
				
				
	
				 $cartArray = json_decode($json);
				 $output = $categoryIDs = array();
				 
				  foreach ($cartArray as $cart) {
				      $fooditeminfo=$this->db->select("kitchenid")->from('item_foods')->where('ProductsID',$cart->ProductsID)->get()->row();
					  $addonsid="";
					  $addonsqty="";
					  $addonsprice=0;
					  if(@$cart->addons==1){
					  	foreach($cart->addonsinfo as $adonsinfo){
							
							 if($adonsinfo->addonsquantity>0){
							 $addprice=$adonsinfo->addonsquantity*$adonsinfo->addonsprice;
							 $addonsid.=$adonsinfo->addonsid.',';
							 $addonsqty.=$adonsinfo->addonsquantity.',';
							  $addonsprice=$addonsprice+$addprice;
							 }
							}
					  }
					  $alladdons=trim($addonsid,',');
					  $alladdonsqty=trim($addonsqty,',');
					  //Insert Item information
					$data3=array(
						'order_id'				=>	$orderid,
						'menu_id'		        =>	$cart->ProductsID,
						'menuqty'	        	=>	$cart->quantitys,
						'notes'                 =>  $cart->itemNote,
						'add_on_id'	        	=>	$alladdons,
						'addonsqty'	        	=>	$alladdonsqty,
						'varientid'		    	=>	$cart->variantid,
					);
					$this->db->insert('order_menu',$data3);
					$this->db->where('waiterid',$ID)->where('ProductsID',$cart->ProductsID)->where('variantid',$cart->variantid)->delete('tbl_waiterappcart');
				  }
				  $billinfo=array(
					'customer_id'			=>	$CustomerID,
					'order_id'		        =>	$orderid,
					'total_amount'	        =>	$Total,
					'discount'	            =>	$Discount,
					'service_charge'	    =>	$ServiceCharge,
					'VAT'		 	        =>  $VatAmount,
					'bill_amount'		    =>	$Grandtotal,
					'bill_date'		        =>	$newdate,
					'bill_time'		        =>	date('H:i:s'),
					'bill_status'		    =>	0,
					'payment_method_id'		=>	4,
					'create_by'		        =>	$ID,
					'create_date'		    =>	date('Y-m-d')
				);
				$this->db->insert('bill',$billinfo);
				$billid = $this->db->insert_id();
				$cardinfo=array(
					'bill_id'			    =>	$billid,
					'card_no'		        =>	"",
					'issuer_name'	        =>	""
				);
				
				/*Push Notification*/
		$senderid=array();
		$kinfo=$this->kitcheninfo($orderid);
		    foreach($kinfo as $kitcheninfo){
		           $allemployee =$this->db->select('user.*,tbl_assign_kitchen.userid')->from('tbl_assign_kitchen')->join('user','user.id=tbl_assign_kitchen.userid','left')->where('tbl_assign_kitchen.kitchen_id',$kitcheninfo->kitchenid)->get()->result(); 
			       foreach($allemployee as $mytoken){
			            $senderid[]=$mytoken->waiter_kitchenToken;
		            }
		     }
		$newmsg=array
				(
					'tag'						=> "New Order Placed",
					'orderid'					=> $orderid,
					'amount'					=> $Grandtotal
				);
		$message = json_encode( $newmsg );	
		define( 'API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX');
				$registrationIds = $senderid;
				$msg = array
				(
					'message' 					=> "Orderid: ".$orderid.", Amount:".number_format($gtotal,2),
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
				
                if (!empty($orderid)) {
                    return $this->respondWithSuccess('Order Place Successfully.', $output);
                } else {
                    return $this->respondWithError('Order Not placed!!!',$output);
                }
            }
    }
	public function kitcheninfo($orderid){
	    $this->db->select('order_menu.order_id,item_foods.ProductsID,item_foods.kitchenid');
	    $this->db->from('order_menu');
	    $this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
	    $this->db->where('order_menu.order_id',$orderid);
	    $this->db->group_by('item_foods.kitchenid');
	    $query = $this->db->get();

		return $kitcheninfo =$query->result();
		print_r($kitcheninfo);
	}
	 public function pendingorder(){
		 $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
		 if ($this->form_validation->run() == FALSE){
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else{
                 $waiterid=$this->input->post('id', TRUE);
				 $orderlist = $this->Api_v1_model->orderlist($waiterid,$status=1);
				 $output = $categoryIDs = array();
                if ($orderlist != FALSE) {
					$i=0;
					 foreach($orderlist as $order){
						 $output[$i]['order_id']        = $order->order_id;
						 $output[$i]['CustomerName']    = $order->customer_name;
						 $output[$i]['TableName']       = $order->tablename;
						 $output[$i]['OrderDate']       = $order->order_date;
						 $output[$i]['TotalAmount']     = $order->totalamount;
						 $i++;
					 }
				
                    return $this->respondWithSuccess('Pending Order List.', $output);
                } else {
                    return $this->respondWithError('Order Not Found.!!!',$output);
                }
		}
	 }
	 public function processingorder(){
			$this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
				else{
					 $waiterid=$this->input->post('id', TRUE);
					 $orderlist = $this->Api_v1_model->orderlist($waiterid,$status=2);
					 $output = $categoryIDs = array();
					if ($orderlist != FALSE) {
						$i=0;
						 foreach($orderlist as $order){
							 $output[$i]['order_id']        = $order->order_id;
							 $output[$i]['CustomerName']    = $order->customer_name;
							 $output[$i]['TableName']       = $order->tablename;
							 $output[$i]['OrderDate']       = $order->order_date;
							 $output[$i]['TotalAmount']     = $order->totalamount;
							 $i++;
						 }
					
						return $this->respondWithSuccess('Pending Order List.', $output);
					} else {
						return $this->respondWithError('Order Not Found.!!!',$output);
					}
			}
		}
	public function readyorder(){
			$this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('start', 'start', 'required|xss_clean|trim');
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
				else{
					 $waiterid=$this->input->post('id', TRUE);
					 $start=$this->input->post('start', TRUE);
					 if($start==0){
					 $orderlist = $this->Api_v1_model->orderlist($waiterid,$status=3,$limit=20);
					  }
					 else{
						$orderlist = $this->Api_v1_model->allorderlist($waiterid,$status=3,$start,$limit=20); 
						 }
					 $totalorder = $this->Api_v1_model->count_comorder($waiterid,$status=3);
					 $output = $categoryIDs = array();
					if ($orderlist != FALSE) {
						 $output['totalorder']        = $totalorder;
						$i=0;
						 foreach($orderlist as $order){
							 $personinfo=$this->db->select("SUM(total_people) as totalperson")->from('table_details')->where('order_id',$order->order_id)->get()->row(); 							
							 $output['orderinfo'][$i]['order_id']        = $order->order_id;
							 $output['orderinfo'][$i]['total_people']    = $personinfo->totalperson;
							 $output['orderinfo'][$i]['CustomerName']    = $order->customer_name;
							 $output['orderinfo'][$i]['TableName']       = $order->tablename;
							 $output['orderinfo'][$i]['OrderDate']       = $order->order_date;
							 $output['orderinfo'][$i]['TotalAmount']     = $order->totalamount;
							 $i++;
						 }
					
						return $this->respondWithSuccess('Pending Order List.', $output);
					} else {
						return $this->respondWithError('Order Not Found.!!!',$output);
					}
			}

		}
	public function completeorder(){
			$this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('start', 'start', 'required|xss_clean|trim');
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
				else{
					 $waiterid=$this->input->post('id', TRUE);
					 $start=$this->input->post('start', TRUE);
					 if($start==0){
					 $orderlist = $this->Api_v1_model->allorderlist($waiterid,$status=4,$limit=20);
					 }
					 else{
						$orderlist = $this->Api_v1_model->allorderlist($waiterid,$status=4,$start,$limit=20); 
						 }
					 $totalorder = $this->Api_v1_model->count_comorder($waiterid,$status=4);
					 $output = $categoryIDs = array();
					if ($orderlist != FALSE) {
						 $output['totalorder']        = $totalorder;
						$i=0;
						 foreach($orderlist as $order){
							 $output['orderinfo'][$i]['order_id']        = $order->order_id;
							 $output['orderinfo'][$i]['CustomerName']    = $order->customer_name;
							 $output['orderinfo'][$i]['TableName']       = $order->tablename;
							 $output['orderinfo'][$i]['OrderDate']       = $order->order_date;
							 $output['orderinfo'][$i]['TotalAmount']     = $order->totalamount;
							 $i++;
						 }
					
						return $this->respondWithSuccess('Pending Order List.', $output);
					} else {
						return $this->respondWithError('Order Not Found.!!!',$output);
					}
			}

		}
	public function cancelorder(){
		    $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('start', 'start', 'required|xss_clean|trim');
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
				else{
					 $waiterid=$this->input->post('id', TRUE);
					 $start=$this->input->post('start', TRUE);
					 if($start==0){
					 $orderlist = $this->Api_v1_model->allorderlist($waiterid,$status=5,$limit=20);
					 }
					 else{
						$orderlist = $this->Api_v1_model->allorderlist($waiterid,$status=5,$start,$limit=20); 
						 }
					 $totalorder = $this->Api_v1_model->count_comorder($waiterid,$status=5);
					 $output = $categoryIDs = array();
					if ($orderlist != FALSE) {
						 $output['totalorder']        = $totalorder;
						$i=0;
						 foreach($orderlist as $order){
							 $output['orderinfo'][$i]['order_id']        = $order->order_id;
							 $output['orderinfo'][$i]['CustomerName']    = $order->customer_name;
							 $output['orderinfo'][$i]['TableName']       = $order->tablename;
							 $output['orderinfo'][$i]['OrderDate']       = $order->order_date;
							 $output['orderinfo'][$i]['TotalAmount']     = $order->totalamount;
							 $i++;
						 }
					
						return $this->respondWithSuccess('Pending Order List.', $output);
					} else {
						return $this->respondWithError('Order Not Found.!!!',$output);
					}
			}
		}
		
 public function weaitercart(){
	 		 $this->form_validation->set_rules('cartdata', 'cartdata', 'required|xss_clean|trim');
			 $this->form_validation->set_rules('waiterid', 'waiterid', 'required|xss_clean|trim');
			 $waiterid=$this->input->post('waiterid', TRUE);
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
			 else{
					$waiterid=$this->input->post('waiterid', TRUE);
					$json = $this->input->post('cartdata', TRUE);
                    $cartArray = json_decode($json);
					$ProductsID=$cartArray->foodinfo['0']->ProductsID;
					$variantid=$cartArray->foodinfo['0']->variantid;
					$addonsinfo=$cartArray->foodinfo['0']->addonsinfo;
					$addonsexist=$cartArray->foodinfo['0']->addons;
				$exitsdata=$this->db->select('*')->from('tbl_waiterappcart')->where('waiterid',$waiterid)->where('ProductsID',$ProductsID)->where('variantid',$variantid)->get()->row(); 
						 $output = $categoryIDs = array();
						if(!empty($exitsdata)){
							$this->db->where('waiterid',$waiterid)->where('ProductsID',$ProductsID)->where('variantid',$variantid)->delete('tbl_waiterappcart');
							}
						if($addonsexist==1){
						for($i=0;$i<count($addonsinfo);$i++){
							$data3=array(
							    'waiterid'						    =>	$waiterid,
								'alladdOnsName'						=>	$cartArray->foodinfo['0']->addOnsName,
								'total_addonsprice'		        	=>	$cartArray->foodinfo['0']->addOnsTotal,
								'totaladdons'	        			=>	$cartArray->foodinfo['0']->addons,
								'addons_name'	        			=>	$addonsinfo[$i]->add_on_name,
								'addons_id'	        				=>	$addonsinfo[$i]->addonsid,
								'addons_price'		    			=>	$addonsinfo[$i]->addonsprice,
								'addonsQty'							=>	$addonsinfo[$i]->addonsquantity,
								'component'		        			=>	$cartArray->foodinfo['0']->component,
								'destcription'	        			=>	$cartArray->foodinfo['0']->destcription,
								'itemnotes'	        				=>	$cartArray->foodinfo['0']->itemnotes,
								'offerIsavailable'	        		=>	$cartArray->foodinfo['0']->offerIsavailable,
								'offerstartdate'		    		=>	$cartArray->foodinfo['0']->offerstartdate,
								'OffersRate'						=>	$cartArray->foodinfo['0']->OffersRate,
								'offerendate'		        		=>	$cartArray->foodinfo['0']->offerendate,
								'price'	        					=>	$cartArray->foodinfo['0']->price,
								'ProductsID'	        			=>	$cartArray->foodinfo['0']->ProductsID,
								'ProductImage'	        			=>	$cartArray->foodinfo['0']->ProductImage,
								'ProductName'		    			=>	$cartArray->foodinfo['0']->ProductName,
								'productvat'						=>	$cartArray->foodinfo['0']->productvat,
								'quantity'		        			=>	$cartArray->foodinfo['0']->quantity,
								'variantName'	        			=>	$cartArray->foodinfo['0']->variantName,
								'variantid'	        				=>	$cartArray->foodinfo['0']->variantid,
							);
							$this->db->insert('tbl_waiterappcart',$data3);
						}
						}
						else{
							$data3=array(
							    'waiterid'						    =>	$waiterid,
								'alladdOnsName'						=>	$cartArray->foodinfo['0']->addOnsName,
								'total_addonsprice'		        	=>	$cartArray->foodinfo['0']->addOnsTotal,
								'totaladdons'	        			=>	$cartArray->foodinfo['0']->addons,
								'addons_name'	        			=>	NULL,
								'addons_id'	        				=>	NULL,
								'addons_price'		    			=>	0.00,
								'addonsQty'							=>	NULL,
								'component'		        			=>	$cartArray->foodinfo['0']->component,
								'destcription'	        			=>	$cartArray->foodinfo['0']->destcription,
								'itemnotes'	        				=>	$cartArray->foodinfo['0']->itemnotes,
								'offerIsavailable'	        		=>	$cartArray->foodinfo['0']->offerIsavailable,
								'offerstartdate'		    		=>	$cartArray->foodinfo['0']->offerstartdate,
								'OffersRate'						=>	$cartArray->foodinfo['0']->OffersRate,
								'offerendate'		        		=>	$cartArray->foodinfo['0']->offerendate,
								'price'	        					=>	$cartArray->foodinfo['0']->price,
								'ProductsID'	        			=>	$cartArray->foodinfo['0']->ProductsID,
								'ProductImage'	        			=>	$cartArray->foodinfo['0']->ProductImage,
								'ProductName'		    			=>	$cartArray->foodinfo['0']->ProductName,
								'productvat'						=>	$cartArray->foodinfo['0']->productvat,
								'quantity'		        			=>	$cartArray->foodinfo['0']->quantity,
								'variantName'	        			=>	$cartArray->foodinfo['0']->variantName,
								'variantid'	        				=>	$cartArray->foodinfo['0']->variantid,
							);
							$this->db->insert('tbl_waiterappcart',$data3);
							}
						return $this->respondWithSuccess('Add to cart SuccessfyllyCart', $output);
					}
	 }
	
 	public function cartdata(){
		 $this->form_validation->set_rules('waiterid', 'waiterid', 'required|xss_clean|trim');
		 $waiterid=$this->input->post('waiterid', TRUE);
		 if ($this->form_validation->run() == FALSE){
				$errors = $this->form_validation->error_array();
				return $this->respondWithValidationError($errors);
			}
		 else{
			$waiterid=$this->input->post('waiterid', TRUE);
			$getcartdata=$this->db->select('*')->from('tbl_waiterappcart')->where('waiterid',$waiterid)->group_by('ProductsID')->group_by('variantid')->get()->result(); 
		
			$output = $categoryIDs = array();
			$i=0;
			foreach($getcartdata as $cart){
						$output['foodinfo'][$i]['addOnsName']=$cart->alladdOnsName;
						$output['foodinfo'][$i]['addOnsTotal']=$cart->total_addonsprice;
						$output['foodinfo'][$i]['addons']=$cart->totaladdons;
						$addonsfood=$this->db->select('addons_name,addons_id,addons_price,addonsQty')->from('tbl_waiterappcart')->where('waiterid',$waiterid)->where('ProductsID',$cart->ProductsID)->where('variantid',$cart->variantid)->get()->result();
						$k=0;
						foreach($addonsfood as $addonsitem){
							$output['foodinfo'][$i]['addonsinfo'][$k]['addonsid']=$addonsitem->addons_id;
							$output['foodinfo'][$i]['addonsinfo'][$k]['add_on_name']=$addonsitem->addons_name;
							$output['foodinfo'][$i]['addonsinfo'][$k]['addonsprice']=$addonsitem->addons_price;
							$output['foodinfo'][$i]['addonsinfo'][$k]['addonsquantity']=$addonsitem->addonsQty;
							$k++;
							} 
						$output['foodinfo'][$i]['component']=$cart->component;
						$output['foodinfo'][$i]['destcription']=$cart->destcription;
						$output['foodinfo'][$i]['itemnotes']=$cart->itemnotes;
						$output['foodinfo'][$i]['offerIsavailable']=$cart->offerIsavailable;
						$output['foodinfo'][$i]['offerstartdate']=$cart->offerstartdate;
						$output['foodinfo'][$i]['OffersRate']=$cart->OffersRate;
						$output['foodinfo'][$i]['offerendate']=$cart->offerendate;
						$output['foodinfo'][$i]['price']=$cart->price;
						$output['foodinfo'][$i]['ProductsID']=$cart->ProductsID;
						$output['foodinfo'][$i]['ProductImage']=$cart->ProductImage;
						$output['foodinfo'][$i]['ProductName']=$cart->ProductName;
						$output['foodinfo'][$i]['productvat']=$cart->productvat;
						$output['foodinfo'][$i]['quantity']=$cart->quantity;
						$output['foodinfo'][$i]['variantName']=$cart->variantName;
						$output['foodinfo'][$i]['variantid']=$cart->variantid;
				$i++;
				}
			return $this->respondWithSuccess('All Item in Cart List', $output);
			}
	 }
	public function completeorcancel(){
		$this->form_validation->set_rules('Orderstatus', 'Orderstatus', 'required|xss_clean|trim');
		$this->form_validation->set_rules('Orderid', 'Orderid', 'required|xss_clean|trim');
		$this->form_validation->set_rules('waiterid', 'waiterid', 'required|xss_clean|trim');
		 	if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
			else{
		 $orderstatus=$this->input->post('Orderstatus', TRUE);
		 $orderid=$this->input->post('Orderid', TRUE);
		 $waiterid=$this->input->post('waiterid', TRUE);
		 $output = $categoryIDs = array();
		 $customerorder=$this->Api_v1_model->read('*', 'customer_order', array('order_id' => $orderid));
		 
		 $customerinfo=$this->Api_v1_model->read('*', 'customer_info', array('customer_id' => $customerorder->customer_id));
		 $tableinfo=$this->Api_v1_model->read('*', 'rest_table', array('tableid' => $customerorder->table_no));
		 $typeinfo=$this->Api_v1_model->read('*', 'customer_type', array('customer_type_id' => $customerorder->cutomertype));
		
		  $orderdetails=$this->db->select('order_menu.*,item_foods.ProductsID,item_foods.ProductName,variant.variantid,variant.variantName,variant.price')->from('order_menu')->join('customer_order','order_menu.order_id=customer_order.order_id','left')->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left')->join('variant','order_menu.varientid=variant.variantid','left')->where('order_menu.order_id',$orderid)->where('customer_order.waiter_id',$waiterid)->where('customer_order.order_status',$orderstatus)->order_by('customer_order.order_id','desc')->get()->result();
		   //
		 $billinfo=$this->Api_v1_model->read('*', 'bill', array('order_id' => $orderid));
		
		 if(!empty($orderdetails)){
			 $output['CustomerName']=$customerinfo->customer_name;  
			 $output['CustomerPhone']=$customerinfo->customer_phone;
			 $output['CustomerEmail']=$customerinfo->customer_email;
			 $output['CustomerType']=$typeinfo->customer_type;
			 $output['TableName']=$tableinfo->tablename;
			 $i=0;
			  
			 foreach($orderdetails as $item){
			     if($item->food_status==1){
			         $statusinfo="Ready";
			     }
			     else if($customerorder->order_status==4){
			         $statusinfo="Completed";
			     }
			    
			     else{
			         $statusinfo="Processing!";
			     }
				 $output['iteminfo'][$i]['ProductsID']     =$item->ProductsID;
				 $output['iteminfo'][$i]['ProductName']    =$item->ProductName;
				 $output['iteminfo'][$i]['price']    	   =$item->price;
				 $output['iteminfo'][$i]['Varientname']    =$item->variantName;
				 $output['iteminfo'][$i]['Varientid']      =$item->variantid;
				 $output['iteminfo'][$i]['Itemqty']        =$item->menuqty;
				 $output['iteminfo'][$i]['status']         =$statusinfo;
				 $output['iteminfo'][$i]['Itemtotal']      =number_format(($item->menuqty*$item->price),2);
				 if(!empty($item->add_on_id)){
				  $output['iteminfo'][$i]['addons']        =1;
					 $addons=explode(",",$item->add_on_id);
					 $addonsqty=explode(",",$item->addonsqty);
					 $x=0;
					foreach($addons as $addonsid){
							$adonsinfo=$this->Api_v1_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
							$output['iteminfo'][$i]['addonsinfo'][$x]['addonsName']     =$adonsinfo->add_on_name;
							$output['iteminfo'][$i]['addonsinfo'][$x]['add_on_id']      =$adonsinfo->add_on_id;
							$output['iteminfo'][$i]['addonsinfo'][$x]['price']      	=number_format($adonsinfo->price,2,'.','');
							$output['iteminfo'][$i]['addonsinfo'][$x]['add_on_qty']     =$addonsqty[$x];
							$x++;
						}
				}
			     else{ $output['iteminfo'][$i]['addons']        =0;}
				 
				 $i++;
				 }   
			 $output['Subtotal']              =$billinfo->total_amount;
			 $output['discount']              =$billinfo->discount;
			 $output['service_charge']        =$billinfo->service_charge;
			 $output['VAT']        			  =$billinfo->VAT;
			 $output['order_total']           =$billinfo->bill_amount;
			 $output['orderdate']             =$billinfo->bill_date;
			 
			return $this->respondWithSuccess('Order Details', $output);
		 }
		 else{
			return $this->respondWithError('Order Not Found.!!!',$output); 
			 }
		 }
		}
	public function pendingorprocess(){
		$this->form_validation->set_rules('waiterid', 'waiterid', 'required|xss_clean|trim');
		 	if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
			else{
		 $waiterid=$this->input->post('waiterid', TRUE);
		 $output = $categoryIDs = array();
		 $getcartdata=$this->db->select('count(order_id) as cnt')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->get()->row();
			 
		 $getamount=$this->db->select('Sum(totalamount) as total')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->get()->row(); 
		 if(!empty($getamount->total)){
			 $overall=$getamount->total;
			 }
		else{
			$overall=0;
			}
			
		 $where="order_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
		 $lastweekorder=$this->db->select('count(order_id) as cnt')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->where($where)->get()->row();
		$lastweekamount=$this->db->select('Sum(totalamount) as total')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->where($where)->get()->row();
		if(!empty($lastweekamount->total)){
			 $lasttotal=$lastweekamount->total;
			 }
		else{
			$lasttotal=0;
			}
			$output['Overallorder']=$getcartdata->cnt;  
			$output['Overallamount']=$overall;  
			$output['lastweekorder']=$lastweekorder->cnt;  
			$output['lastweekamount']=$lasttotal;  
			return $this->respondWithSuccess('Order History', $output);
		 }
		}
	public function orderhistory(){
		$this->form_validation->set_rules('waiterid', 'waiterid', 'required|xss_clean|trim');
		 	if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
			else{
		 $waiterid=$this->input->post('waiterid', TRUE);
		 $output = $categoryIDs = array();
		 $getcartdata=$this->db->select('count(order_id) as cnt')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->get()->row();
			 
		 $getamount=$this->db->select('Sum(totalamount) as total')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->get()->row(); 
		 if(!empty($getamount->total)){
			 $overall=$getamount->total;
			 }
		else{
			$overall=0;
			}
			
		 $where="order_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
		 $lastweekorder=$this->db->select('count(order_id) as cnt')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->where($where)->get()->row();
		$lastweekamount=$this->db->select('Sum(totalamount) as total')->from('customer_order')->where('waiter_id',$waiterid)->where('order_status!=',5)->where($where)->get()->row();
		if(!empty($lastweekamount->total)){
			 $lasttotal=$lastweekamount->total;
			 }
		else{
			$lasttotal=0;
			}
			$output['Overallorder']=$getcartdata->cnt;  
			$output['Overallamount']=$overall;  
			$output['lastweekorder']=$lastweekorder->cnt;  
			$output['lastweekamount']=$lasttotal;  
			return $this->respondWithSuccess('Order History', $output);
		 }
		}
	public function updateorder(){
		$this->form_validation->set_rules('Orderid', 'Orderid', 'required|xss_clean|trim');
		 	if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
			else{
		$orderid=$this->input->post('Orderid', TRUE);
		 $output = $categoryIDs = array();
		 $customerorder=$this->Api_v1_model->read('*', 'customer_order', array('order_id' => $orderid));
		 $customerinfo=$this->Api_v1_model->read('*', 'customer_info', array('customer_id' => $customerorder->customer_id));
		 $tableinfo=$this->Api_v1_model->read('*', 'rest_table', array('tableid' => $customerorder->table_no));
		 $typeinfo=$this->Api_v1_model->read('*', 'customer_type', array('customer_type_id' => $customerorder->cutomertype));
		
		  $orderdetails=$this->db->select('order_menu.*,item_foods.*,variant.variantid,variant.variantName,variant.price')->from('order_menu')->join('customer_order','order_menu.order_id=customer_order.order_id','left')->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left')->join('variant','order_menu.varientid=variant.variantid','left')->where('order_menu.order_id',$orderid)->get()->result();
		   //
		 $billinfo=$this->Api_v1_model->read('*', 'bill', array('order_id' => $orderid));
		
		 if(!empty($orderdetails)){
			 $output['orderid']        =$orderid;  
			 $output['Grandtotal']     =$billinfo->bill_amount;  
			 $output['Servicecharge']  =$billinfo->service_charge;  
			 $output['discount']       =$billinfo->discount;  
			 $output['vat']            =$billinfo->VAT; 
			 $output['Table']          =$tableinfo->tableid; 
			 $output['customername']   =$customerinfo->customer_name; 
			 $i=0;
			  
			 foreach($orderdetails as $item){
				 $output['iteminfo'][$i]['ProductsID']     =$item->ProductsID;
				 $output['iteminfo'][$i]['ProductName']    =$item->ProductName;
				 $output['iteminfo'][$i]['price']    		=$item->price;
				 $output['iteminfo'][$i]['component']      =$item->component;
				 $output['iteminfo'][$i]['destcription']   =$item->descrip;
				 $output['iteminfo'][$i]['itemnotes']      =$item->itemnotes;
				 $output['iteminfo'][$i]['productvat']      =$item->productvat;
				 $output['iteminfo'][$i]['offerIsavailable'] =$item->offerIsavailable;
				 $output['iteminfo'][$i]['offerstartdate']  =$item->offerstartdate;
				 $output['iteminfo'][$i]['OffersRate']      =$item->OffersRate;
				 $output['iteminfo'][$i]['offerendate']      =$item->offerendate;
				 $output['iteminfo'][$i]['ProductImage']     =base_url().$item->ProductImage;
				 $output['iteminfo'][$i]['Varientname']    =$item->variantName;
				 $output['iteminfo'][$i]['Varientid']      =$item->variantid;
				 $output['iteminfo'][$i]['Itemqty']        =$item->menuqty;
				 if(!empty($item->add_on_id)){
				 $output['iteminfo'][$i]['addons']         =1;
					 $addons=explode(",",$item->add_on_id);
					 $addonsqty=explode(",",$item->addonsqty);
					 $x=0;
					foreach($addons as $addonsid){
							$adonsinfo=$this->Api_v1_model->read('*', 'add_ons', array('add_on_id' => $addonsid));
							$output['iteminfo'][$i]['addonsinfo'][$x]['add_on_name']     =$adonsinfo->add_on_name;
							$output['iteminfo'][$i]['addonsinfo'][$x]['addonsid']      =$adonsinfo->add_on_id;
							$output['iteminfo'][$i]['addonsinfo'][$x]['addonsprice']          =$adonsinfo->price;
							$output['iteminfo'][$i]['addonsinfo'][$x]['addonsquantity']     =$addonsqty[$x];
							$x++;
						}
				}
				else{
					$output['iteminfo'][$i]['addons']         =0;
					}
				 
				 $i++;
				 }   
			
			return $this->respondWithSuccess('Order Details', $output);
		 }
		 else{
			return $this->respondWithError('Order Not Found.!!!',$output); 
			 }
		 }
		}
		
	public function updateinsert(){
			 $this->form_validation->set_rules('cartdata', 'cartdata', 'required|xss_clean|trim');
			 $this->form_validation->set_rules('waiterid', 'waiterid', 'required|xss_clean|trim');
			 $this->form_validation->set_rules('Orderid', 'Orderid', 'required|xss_clean|trim');
			 $waiterid=$this->input->post('waiterid', TRUE);
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
			 else{
					$waiterid=$this->input->post('waiterid', TRUE);
					$Orderid=$this->input->post('Orderid', TRUE);
					$json = $this->input->post('cartdata', TRUE);
                    $cartArray = json_decode($json);
					 $output = $categoryIDs = array();
					$i=0;
					foreach($cartArray as $cart){
						
						
						$ProductsID=$cart->ProductsID;
						$variantid=$cart->Varientid;
						$addonsexist=$cart->addons;
						

						$exitsdata=$this->db->select('*')->from('tbl_waiterappcart')->where('waiterid',$waiterid)->where('ProductsID',$ProductsID)->where('variantid',$variantid)->where('orderid',$Orderid)->get()->row(); 
						if(!empty($exitsdata)){
							$this->db->where('waiterid',$waiterid)->where('ProductsID',$ProductsID)->where('variantid',$variantid)->where('orderid',$Orderid)->delete('tbl_waiterappcart');
							}
						$addonsprice=0;
						$addonsqty=0;
			            $addonsname='';
						if($addonsexist==1){
								foreach($cart->addonsinfo as $addonsinfo3){
								$addonsname.=$addonsinfo3->addonsName.",";
								$adsprice=$addonsinfo3->price*$addonsinfo3->add_on_qty;
								$addonsprice=$adsprice+$addonsprice;
								$addonsqty=$addonsqty+$addonsinfo3->add_on_qty;
								}
								foreach($cart->addonsinfo as $addonsinfo){
								$data3=array(
							    'waiterid'						    =>	$waiterid,
								'alladdOnsName'						=>	$addonsname,
								'total_addonsprice'		        	=>	$addonsprice,
								'totaladdons'	        			=>	$addonsqty,
								'addons_name'	        			=>	$addonsinfo->addonsName,
								'addons_id'	        				=>	$addonsinfo->add_on_id,
								'addons_price'		    			=>	$addonsinfo->price,
								'addonsQty'							=>	$addonsinfo->add_on_qty,
								'component'		        			=>	$cart->component,
								'destcription'	        			=>	$cart->destcription,
								'itemnotes'	        				=>	$cart->itemnotes,
								'offerIsavailable'	        		=>	$cart->offerIsavailable,
								'offerstartdate'		    		=>	$cart->offerstartdate,
								'OffersRate'						=>	$cart->OffersRate,
								'offerendate'		        		=>	$cart->offerendate,
								'price'	        					=>	$cart->price,
								'ProductsID'	        			=>	$cart->ProductsID,
								'ProductImage'	        			=>	$cart->ProductImage,
								'ProductName'		    			=>	$cart->ProductName,
								'productvat'						=>	$cart->productvat,
								'quantity'		        			=>	$cart->Itemqty,
								'variantName'	        			=>	$cart->Varientname,
								'variantid'	        				=>	$cart->Varientid,
								'orderid'	        			    =>	$Orderid,
							);
					
							$this->db->insert('tbl_waiterappcart',$data3);	
							}
							}
						else{
							$data3=array(
							    'waiterid'						    =>	$waiterid,
								'alladdOnsName'						=>	$addonsname,
								'total_addonsprice'		        	=>	$addonsprice,
								'totaladdons'	        			=>	$cart->addons,
								'addons_name'	        			=>	NULL,
								'addons_id'	        				=>	NULL,
								'addons_price'		    			=>	0.00,
								'addonsQty'							=>	NULL,
								'component'		        			=>	$cart->component,
								'destcription'	        			=>	$cart->destcription,
								'itemnotes'	        				=>	$cart->itemnotes,
								'offerIsavailable'	        		=>	$cart->offerIsavailable,
								'offerstartdate'		    		=>	$cart->offerstartdate,
								'OffersRate'						=>	$cart->OffersRate,
								'offerendate'		        		=>	$cart->offerendate,
								'price'	        					=>	$cart->price,
								'ProductsID'	        			=>	$cart->ProductsID,
								'ProductImage'	        			=>	$cart->ProductImage,
								'ProductName'		    			=>	$cart->ProductName,
								'productvat'						=>	$cart->productvat,
								'quantity'		        			=>	$cart->Itemqty,
								'variantName'	        			=>	$cart->Varientname,
								'variantid'	        				=>	$cart->Varientid,
								'orderid'	        			    =>	$Orderid,

							);
						
							$this->db->insert('tbl_waiterappcart',$data3);	
							}
						$i++;
						}
						return $this->respondWithSuccess('Add to cart SuccessfyllyCart', $output);
					}
		}
	
	public function modifyfoodcart()
     {
            // TO DO /
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			$this->form_validation->set_rules('Orderid', 'Orderid', 'required|xss_clean|trim');
            $this->form_validation->set_rules('VatAmount', 'Total VAT', 'xss_clean|required|trim');
			$this->form_validation->set_rules('TableId', 'TableId', 'xss_clean|required|trim');
			$this->form_validation->set_rules('Total', 'Cart Total', 'xss_clean|required|trim');
			$this->form_validation->set_rules('Grandtotal', 'Grand Total', 'xss_clean|required|trim');
			$this->form_validation->set_rules('foodinfo', 'foodinfo', 'xss_clean|required|trim');
            if ($this->form_validation->run() == FALSE)
            {
                $errors = $this->form_validation->error_array();
                return $this->respondWithValidationError($errors);
            }
            else
            {
				 $json = $this->input->post('foodinfo', TRUE);
                 $cartArray = json_decode($json);
				$orderid=$this->input->post('Orderid', TRUE);
				 
				$ID                 = $this->input->post('id', TRUE);
				$VAT                = $this->input->post('VAT', TRUE);
				$VatAmount          = $this->input->post('VatAmount', TRUE);
				$TableId        	= $this->input->post('TableId', TRUE);
				$ServiceCharge      = $this->input->post('ServiceCharge', TRUE);
				$Discount 			= $this->input->post('Discount', TRUE);
				$Total        		= $this->input->post('Total', TRUE);
				$Grandtotal        	= $this->input->post('Grandtotal', TRUE);
				$customernote       = $this->input->post('CustomerNote', TRUE);
				$newdate= date('Y-m-d');
				$lastid=$this->db->select("*")->from('customer_order')->where('order_id',$orderid)->get()->row();
				$sino = $lastid->saleinvoice;
				//Inser Order information 
					$data2=array(
						'order_date'	        =>	$newdate,
						'order_time'	        =>	date('H:i:s'),
						'totalamount'		 	=>  $Grandtotal,
						'table_no'		    	=>	$TableId,
						'customer_note'		    =>	$customernote,
						'order_status'		    =>	1
					);
					$this->db->where('order_id',$orderid);
					$this->db->update('customer_order',$data2);
					
					$this->db->where('order_id',$orderid)->delete('order_menu');
				
			
				 $output = $categoryIDs = array();
				 
				  foreach ($cartArray as $cart) {
					  $addonsid="";
					  $addonsqty="";
					  $addonsprice=0;
					  if($cart->addons==1){
					  	foreach($cart->addonsinfo as $adonsinfo){
							 $addprice=$adonsinfo->addonsquantity*$adonsinfo->addonsprice;
							 $addonsid.=$adonsinfo->addonsid.',';
							 $addonsqty.=$adonsinfo->addonsquantity.',';
							  $addonsprice=$addonsprice+$addprice;
							}
					  }
					  $alladdons=trim($addonsid,',');
					  $alladdonsqty=trim($addonsqty,',');
					  //Insert Item information
					$data3=array(
						'order_id'				=>	$orderid,
						'menu_id'		        =>	$cart->ProductsID,
						'menuqty'	        	=>	$cart->quantitys,
						'notes'                 =>  $cart->itemNote,
						'add_on_id'	        	=>	$alladdons,
						'addonsqty'	        	=>	$alladdonsqty,
						'varientid'		    	=>	$cart->variantid,
					);
					$this->db->insert('order_menu',$data3);
					$this->db->where('orderid',$orderid)->where('ProductsID',$cart->ProductsID)->where('variantid',$cart->Varientid)->delete('tbl_waiterappcart');
				  }
				  $billinfo=array(
					'total_amount'	        =>	$Total,
					'discount'	            =>	$Discount,
					'service_charge'	    =>	$ServiceCharge,
					'VAT'		 	        =>  $VatAmount,
					'bill_amount'		    =>	$Grandtotal,
					'update_by'		        =>	$ID,
					'update_date'		    =>	date('Y-m-d')
				);
				$this->db->where('order_id',$orderid);
				$this->db->update('bill',$billinfo);
				$billinfo=$this->db->select("*")->from('bill')->where('order_id',$orderid)->get()->row();
				$billid = $billinfo->bill_id;
				$cardinfo=array(
					'card_no'		        =>	"",
					'issuer_name'	        =>	""
				);
				$this->db->where('bill_id',$billid);
			    $this->db->update('bill_card_payment',$cardinfo);
                if (!empty($orderid)) {
                    return $this->respondWithSuccess('Order Place Successfully.', $output);
                } else {
                    return $this->respondWithError('Order Not placed!!!',$output);
                }
            }
    }
	public function orderclear(){
			 $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
				else{
					 $waiterid=$this->input->post('id', TRUE);
					 $ProductsID=$this->input->post('ProductsID', TRUE);
					 $variantid=$this->input->post('variantid', TRUE);
					 $output = $categoryIDs = array();
					 $this->db->where('waiterid',$waiterid)->delete('tbl_waiterappcart');
					return $this->respondWithSuccess('Order List Clear', $output);
				}
		}
		
	public function allonlineorder(){
			 $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
				else{
					 $output = $categoryIDs = array();
					 $waiterid=$this->input->post('id', TRUE);
					 $orderlist = $this->Api_v1_model->allincomminglist();
					 if(!empty($orderlist)){
						  $i=0;
						 foreach($orderlist as $order){
							 $output['orderinfo'][$i]['orderid']=$order->order_id;
							 $output['orderinfo'][$i]['customer']=$order->customer_name;
							 $output['orderinfo'][$i]['amount']=$order->totalamount;
							 $i++;
							 }
						  return $this->respondWithSuccess('Incomming Order List', $output);
						 }
					 else{
						  return $this->respondWithError('No Incomming Order Found!!!',$output);
						 }
					
				}
		}
	public function acceptorder(){
			 $this->form_validation->set_rules('id', 'id', 'required|xss_clean|trim');
			 $this->form_validation->set_rules('order_id', 'Order ID', 'required|xss_clean|trim');
			 if ($this->form_validation->run() == FALSE){
					$errors = $this->form_validation->error_array();
					return $this->respondWithValidationError($errors);
				}
				else{
					 $output = $categoryIDs = array();
					 $waiterid=$this->input->post('id', TRUE);
					 $orderid=$this->input->post('order_id', TRUE);
					 $orderinfo= $this->db->select('*')->from('customer_order')->where('order_id',$orderid)->get()->row();
					 if($orderinfo->order_status==5){
                        return $this->respondWithError('This Order is Cancel By Admin.Please Try Another!!!',$output);
					 }
					 
					 else if(!empty($orderinfo->waiter_id)){
                        return $this->respondWithError('This Order Already Assign.Please Try Another!!!',$output);
					 }
					 else{
					 $updatetData['waiter_id']    			= $waiterid;
				     $this->Api_v1_model->update_date('customer_order', $updatetData, 'order_id', $orderid);
				      /*Push Notification*/
	
		$senderid=array();
		
		    $kitcheninfo=$this->db->select('order_menu.*,item_foods.ProductsID,item_foods.kitchenid')->from('order_menu')->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left')->where('order_menu.order_id',$orderid)->group_by('item_foods.kitchenid')->get()->result();
		    foreach($kitcheninfo as $kitchenid){
		           $allemployee =$this->db->select('user.*,tbl_assign_kitchen.userid')->from('tbl_assign_kitchen')->join('user','user.id=tbl_assign_kitchen.userid','left')->where('tbl_assign_kitchen.kitchen_id',$kitchenid->kitchenid)->get()->result(); 
			       foreach($allemployee as $mytoken){
			       $senderid[]=$mytoken->waiter_kitchenToken;
		        }
		     }
		$newmsg=array
				(
					'tag'						=> "New Order Placed",
					'orderid'					=> $orderid,
					'amount'					=> $orderinfo->totalamount
				);
		$message = json_encode( $newmsg );	
		define( 'API_ACCESS_KEY', 'AAAAqG0NVRM:APA91bExey2V18zIHoQmCkMX08SN-McqUvI4c3CG3AnvkRHQp8S9wKn-K4Vb9G79Rfca8bQJY9pn-tTcWiXYJiqe2s63K6QHRFqIx4Oaj9MoB1uVqB7U_gNT9fiqckeWge8eVB9P5-rX' );
				$registrationIds = $senderid;
				$msg = array
				(
					'message' 					=> "Orderid: ".$orderid.", Amount:".$orderinfo->totalamount,
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
				$updatetData = array('nofification' => 1,'orderacceptreject'=>1,'order_status'=>2);
				$this->db->where('order_id',$orderid);
		        $this->db->update('customer_order',$updatetData);
				/*PUSH Notification For Customer*/
				$customerinfo=$this->db->select("*")->from('customer_info')->where('customer_id',$orderinfo->customer_id)->get()->row();
				 $bodymsg="Order ID:".$orderid." Order amount:".$orderinfo->totalamount;
				 $icon=base_url('assets/img/applogo.png');
                 $fields3 = array(
    		'to'=>$customerinfo->customer_token,
    		'data'=>array(
    			'title'=>"You Order is Accepted",
    			'body'=>$bodymsg,
    			'image'=>$icon,
    			'media_type'=>"image",
    			'message'=>"test",
    			"action"=> "1",
    		),
    		'notification'=>array(
    			'sound'=>"default",
    			'title'=>"You Order is Accepted",
    			'body'=>$bodymsg,
    			'image'=>$icon,
    		)
    	);
	$post_data3 = json_encode($fields3);
	$url = "https://fcm.googleapis.com/fcm/send";
	$ch3  = curl_init($url); 
	curl_setopt($ch3, CURLOPT_FAILONERROR, TRUE); 
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($ch3, CURLOPT_POSTFIELDS, $post_data3);
	curl_setopt($ch3, CURLOPT_HTTPHEADER, array('Authorization: Key=AAAAmN4ekRg:APA91bHDg_gr99QlnGtHD_exg-QuhRc_45Xluti4dmaNGSD0jfuXi3-3M_wv01TihrHlUAWUDI-dlJqr-_wEHeYigIXSjEbsXJfxI4J9x7ugZDOBv07FhAlWIdDvl8zWcKoeeqqPT9Gw',
	    'Content-Type: application/json')
	);
	$result3 = curl_exec($ch3);
	curl_close($ch3);
					 return $this->respondWithSuccess('Order Assign to Waiter', $output);
					 }
				}
		}
	
		
}