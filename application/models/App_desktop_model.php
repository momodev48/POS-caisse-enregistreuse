<?php

class App_desktop_model extends CI_Model
{

    public function authenticate_user($table, $data)
    {
        $Type = $data['email'];
        $Password = $data['password'];
        $this->db->select("*");
		$this->db->where('email', $data['email']);
        $this->db->where("(password = '" . $Password . "' OR password =  '" . md5($Password) . "')", NULL, TRUE);
        $query = $this->db->get($table)->row();
        $num_rows = $this->db->count_all_results();
        if ($num_rows > 0)
        {
			return $query;
        }
        else
        {
            return FALSE;
        }
    }

    public function checkEmailOrPhoneIsRegistered($table, $data)
    {
        $this->db->select('email, password');
		$this->db->where('email', $data['email']);
        $query = $this->db->get($table)->row();
        $num_rows = $this->db->count_all_results();

        if ($num_rows > 0)
        {
            return $query;
        }
        else
        {
            return FALSE;
        }
    }


    public function check_user($data)
    {

        $this->db->where('UserUUID', $data['UserUUID']);
        $this->db->where('Session', $data['Session']);
        $query = $this->db->get('tbluser');

        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
    public function insert_data($table, $data)
    {
      
        $this->db->insert($table, $data);
       
        return $this->db->insert_id();
    }

    public function update_date($table, $data, $field_name, $field_value)
    {
        $this->db->where($field_name, $field_value);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function read($select_items, $table, $where_array)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
        return $this->db->get()->row();
    }
    
     public function readnum($select_items, $table, $where_array)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        foreach ($where_array as $field => $value) {
            $this->db->where($field, $value);
        }
       $query = $this->db->get();
	   return $query->num_rows();
    }

    public function read_all($select_items, $table, $field_name, $field_value, $order_by_name = NULL, $order_by = NULL)
    {
        $this->db->select($select_items);
        $this->db->from($table);
        $this->db->where($field_name, $field_value);

        if ($order_by_name != NULL && $order_by != NULL)
        {
            $this->db->order_by($order_by_name, $order_by);
        }
        return $this->db->get()->result();
    }
    public function categorylist(){
		$this->db->select('*');
        $this->db->from('item_category');
		$query = $this->db->get();
		$categorylist=$query->result();
	    return $categorylist;
		}
	public function foodlist(){
		$this->db->select('*');
        $this->db->from('item_foods');
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
		}
	public function verientlist(){
		$this->db->select('*');
        $this->db->from('variant');
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
		}
	public function addonslist()
	{ 
		$this->db->select('*');
        $this->db->from('add_ons');
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	public function addonsassignlist()
	{ 
		$this->db->select('*');
        $this->db->from('menu_add_on');
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	public function availablelist()
	{ 
		$this->db->select('*');
        $this->db->from('foodvariable');
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	
	public function headcode(){
	$query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102030%'");
	return $query->row();
    } 
	public function orderitem($orderid,$customerid){
		$saveid=$customerid;
		$bill=1;
		$cid=$customerid;
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
		
		$orderid = $orderid;
		$json = $this->input->post('CartData', TRUE);
		$cartArray = json_decode($json);
		
		foreach($cartArray as $item){
			$addonsqty='';
			$addonsid='';
			if($item->addons==1){
				foreach($item->addonsinfo as $addonsitem){
					$addonsqty.=$addonsitem->count.",";
					$addonsid.=$addonsitem->addonsid.",";
					}
					$addonsqty=trim($addonsqty, ',');
			        $addonsid=trim($addonsid,',');
			}
				$data3=array('order_id'				=>	$orderid,
						'menu_id'		        =>	$item->ProductsID,
						'menuqty'	        	=>	$item->count,
						'varientid'		    	=>	$item->variantid,
						'add_on_id'	        	=>	$addonsid,
						'addonsqty'	        	=>	$addonsqty,
					);
					$this->db->insert('order_menu',$data3);
			}
		if($bill==1){
			$payment= $this->input->post('Pay_type');
			if(!empty($payment)){
				$discount=$this->input->post('invoice_discount');
				$scharge=$this->input->post('service_charge');
				$vat=$this->input->post('vat');
				if($vat==''){
					$vat=0;
					}
				if($discount==''){
					$discount=0;
					}
			  if($scharge==''){
					$scharge=0;
					}
		$billstatus=0;			
					if($payment==5){
						$billstatus=0;
						}
					else if($payment==3){
						$billstatus=0;
						}
					else if($payment==2){
						$billstatus=0;
						}
				
		$billinfo=array(
			'customer_id'			=>	$cid,
			'order_id'		        =>	$orderid,
			'total_amount'	        =>	$this->input->post('SubtotalTotal'),
			'discount'	            =>	$this->input->post('invoice_discount'),
			'service_charge'	    =>	$this->input->post('service_charge'),
			'shipping_type'	        =>	$this->input->post('shippingtype'),
			'delivarydate'	        =>	$this->input->post('shippingdate'),
			'VAT'		 	        =>  $this->input->post('vat'),
			'bill_amount'		    =>	$this->input->post('grandtotal'),
			'bill_date'		        =>	$newdate,
			'bill_time'		        =>	date('H:i:s'),
			'bill_status'		    =>	$billstatus,
			'payment_method_id'		=>	$this->input->post('Pay_type'),
			'create_by'		        =>	$saveid,
			'create_date'		    =>	date('Y-m-d')
		);

		$this->db->insert('bill',$billinfo);
	
				$updatetData =array('order_status'     => 1);
		        $this->db->where('order_id',$orderid);
				$this->db->update('customer_order',$updatetData);
			
				// Find the acc COAID for the Transaction
				$cusifo = $this->db->select('*')->from('customer_info')->where('customer_id',$customerid)->get()->row();
			   $headn = $cusifo->cuntomer_no.'-'.$cusifo->customer_name;
				$coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$headn)->get()->row();
				$customer_headcode = $coainfo->HeadCode;
				
				//Customer debit for Product Value
				$invoice_no=$sino;
				 $cosdr = array(
				  'VNo'            =>  $invoice_no,
				  'Vtype'          =>  'CIV',
				  'VDate'          =>  $newdate,
				  'COAID'          =>  $customer_headcode,
				  'Narration'      =>  'Customer debit for Product Invoice#'.$invoice_no,
				  'Debit'          =>  $this->input->post('grandtotal'),
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
				  'Credit'         =>  $this->input->post('grandtotal'),
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
				  'Credit'         =>  $this->input->post('grandtotal'),
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
				  'Debit'          =>  $this->input->post('grandtotal'),
				  'Credit'         =>  0,
				  'StoreID'        =>  0,
				  'IsPosted'       =>  1,
				  'CreateBy'       => $saveid,
				  'CreateDate'     => $newdate,
				  'IsAppove'       => 1
				); 
				 $this->db->insert('acc_transaction',$cdv);
				}
			}
		return $orderid;
		}
	public function customerlist()
	{ 
		$this->db->select('*');
        $this->db->from('customer_info');
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	public function tablelist()
	{ 
		$this->db->select('*');
        $this->db->from('rest_table');
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	public function ctypelist()
	{ 
		$this->db->select('*');
        $this->db->from('customer_type');
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	public function waiterlist()
	{ 
		return $data = $this->db->select("*")
			->from('employee_history')
			->where('pos_id',6)
			->get()
			->result();
	}
		public function foodavailablelist()
	{ 
		$this->db->select('*');
        $this->db->from('foodvariable');
		$query = $this->db->get();
		$foodavailable=$query->result();
	    return $foodavailable;
	}
	public function allthirdpartylist()
	{ 
		$this->db->select('*');
        $this->db->from('tbl_thirdparty_customer');
		$query = $this->db->get();
		$allthirdparty=$query->result();
	    return $allthirdparty;
	}
	public function paymentmethod()
	{ 
		$this->db->select('*');
        $this->db->from('payment_method');
		$query = $this->db->get();
		$pments=$query->result();
	    return $pments;
	}
	public function allbank()
	{ 
		$this->db->select('*');
        $this->db->from('tbl_bank');
		$query = $this->db->get();
		$bank=$query->result();
	    return $bank;
	}
	public function allcardterminal()
	{ 
		$this->db->select('*');
        $this->db->from('tbl_card_terminal');
		$query = $this->db->get();
		$cardterminal=$query->result();
	    return $cardterminal;
	}
    public function allanguage()
	{ 
		$this->db->select('*');
        $this->db->from('language');
		$query = $this->db->get();
		$language=$query->result();
	
	    return $language;
	}
	public function resseting(){
		$this->db->select('setting.*,currency.*');
        $this->db->from('setting');
		$this->db->join('currency','currency.currencyid=setting.currency','left');
		$query = $this->db->get();
		$settinginfo=$query->result();
	    return $settinginfo;
		}
	
}
