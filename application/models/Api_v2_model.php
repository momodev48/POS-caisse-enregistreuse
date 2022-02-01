<?php

class Api_v2_model extends CI_Model
{

   public function authenticate_user($table, $data)
    {
        $Type = $data['customer_email'];
        $Password = $data['password'];
        $this->db->select("*");
		$this->db->where('customer_email', $data['customer_email']);
        $this->db->where("(password = '" . $Password . "' OR customer_info.password =  '" . md5($Password) . "')", NULL, TRUE);
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
        $this->db->select('*');
		$this->db->where('customer_email', $data['customer_email']);
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
    public function categorylist($catid){
		$this->db->select('CategoryID,Name,CategoryImage');
        $this->db->from('item_category');
		$this->db->where('CategoryIsActive',1);
		$this->db->group_by('CategoryID');
		$query = $this->db->get();
		$categorylist=$query->result();
	    return $categorylist;
		}
	 public function sliderlist(){
		$this->db->select('*');
                      $this->db->from('tbl_slider');
		$this->db->where('Sltypeid',1);
		$this->db->where('status',1);
		$query = $this->db->get();
		$categorylist=$query->result();
	           return $categorylist;
		}
	public function allfooditem($catid=null){
		$this->db->select('item_foods.ProductsID,item_foods.ProductName,item_foods.ProductImage,item_foods.medium_thumb,item_foods.small_thumb,item_foods.component,item_foods.itemnotes,item_foods.descrip,item_foods.productvat,item_foods.OffersRate,item_foods.offerIsavailable,item_foods.offerstartdate,item_foods.offerendate,item_foods.ProductsIsActive,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		if(!empty($catid)){
		$this->db->where('item_foods.CategoryID',$catid);
		}
		$this->db->where('item_foods.ProductsIsActive',1);
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
		}
	public function readfooditem($productid,$variantid){
		$this->db->select('item_foods.ProductsID,item_foods.ProductName,item_foods.ProductImage,item_foods.medium_thumb,item_foods.small_thumb,item_foods.component,item_foods.itemnotes,item_foods.descrip,item_foods.productvat,item_foods.OffersRate,item_foods.offerIsavailable,item_foods.offerstartdate,item_foods.offerendate,item_foods.ProductsIsActive,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('item_foods.ProductsID',$productid);
		$this->db->where('item_foods.ProductsIsActive',1);
		$this->db->where('variant.variantid',$variantid);
		$query = $this->db->get();
		$itemlist=$query->row();
	    return $itemlist;
		}
	public function foodlist($CategoryID){
		$this->db->select('item_foods.ProductsID,item_foods.ProductName,item_foods.ProductImage,item_foods.medium_thumb,item_foods.small_thumb,item_foods.component,item_foods.itemnotes,item_foods.descrip,item_foods.productvat,item_foods.OffersRate,item_foods.offerIsavailable,item_foods.offerstartdate,item_foods.offerendate,item_foods.ProductsIsActive,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('item_category','item_category.CategoryID=item_foods.ProductsID','left');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('item_foods.ProductsIsActive',1);
		$this->db->where('item_foods.CategoryID',$CategoryID);
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
		}
	
	public function findaddons($id = null)
	{ 
		$this->db->select('add_ons.*');
        $this->db->from('menu_add_on');
		$this->db->join('add_ons','menu_add_on.add_on_id = add_ons.add_on_id','left');
		$this->db->where('menu_id',$id);
		$query = $this->db->get();
		$addons=$query->result();
	    return $addons;
	}
	
	public function bestseller(){
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price,count(order_menu.menu_id) as cnt');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->join('order_menu','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->where('ProductsIsActive',1);
		$this->db->group_by('order_menu.menu_id');
		$this->db->order_by('cnt','DESC');
		$this->db->limit('25');
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
		}
	public function offeritem(){
		$this->db->select('item_foods.ProductsID,item_foods.ProductName,item_foods.ProductImage,item_foods.medium_thumb,item_foods.small_thumb,item_foods.component,item_foods.itemnotes,item_foods.descrip,item_foods.productvat,item_foods.OffersRate,item_foods.offerIsavailable,item_foods.offerstartdate,item_foods.offerendate,item_foods.ProductsIsActive,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('item_foods.ProductsIsActive',1);
		$this->db->where('item_foods.offerIsavailable',1);
		$query = $this->db->get();
		$itemlist=$query->result();
	    return $itemlist;
		}
	public function checkavailtable($nopeople,$newdate,$gettime){
		$dateRange = "reserveday='$newdate' AND formtime<='$gettime' AND totime>='$gettime' AND person_capicity='$nopeople' AND status=2";
		$this->db->select('*');
        $this->db->from('tblreservation');
		$this->db->where($dateRange, NULL, FALSE); 
		$query = $this->db->get();
	
		$totalid='';
		 if ($query->num_rows() > 0) {
           $gettable=$query->result(); 
		   foreach($gettable as $selectedtable){
			   $totalid.=$selectedtable->tableid.",";
			   } 
			return $totalid=trim($totalid,',');    
        }
        return false;
		}
	public function checkfree($invalue,$person){
		$this->db->select('*');
        $this->db->from('rest_table');
		$this->db->where_not_in('tableid', $invalue);
		$this->db->where('person_capicity>=', $person); 
		$query = $this->db->get();
		 if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
		} 

	public function habitrecord($pid,$cid,$vid){
		$this->db->select('habit');
        $this->db->from('tbl_habittrack');
		$this->db->where('cusid', $cid);
		$this->db->where('itemid', $pid);
		$this->db->where('varient', $vid); 
		$this->db->order_by('htid', 'DESC');
        $this->db->limit('1');
		$query = $this->db->get();

		 if ($query->num_rows() > 0) {
            return $query->row();    
        }
        return false;
		} 
	public function insertcustomer($data = array(),$mobile){
		$this->db->select('*');
        $this->db->from('customer_info');
		$this->db->where('customer_phone',$mobile);
		 $query = $this->db->get();
        if ($query->num_rows() > 0) {
           $customer=$query->row();
		  return $returnid =   $customer->customer_id;
        } 
		else{
		$this->db->insert('customer_info', $data);
		return $returnid = $this->db->insert_id();
		}
		} 
	public function bookedtable($data = array())
	{
		$this->db->insert('tblreservation', $data);
		return $this->db->insert_id();
	}
	public function bookinginfo($reserid){
		$this->db->select('tblreservation.*,rest_table.tablename,customer_info.customer_name');
        $this->db->from('tblreservation');
		$this->db->join('rest_table','rest_table.tableid=tblreservation.tableid','left');
		$this->db->join('customer_info','customer_info.customer_id=tblreservation.cid','left');
		$this->db->where('tblreservation.reserveid',$reserid);
		$query = $this->db->get();
		$reserveinfo=$query->row();
	    return $reserveinfo;
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
		$lastid=$this->db->select("*")->from('customer_order')->where('order_id',$orderid)->order_by('order_id','desc')->get()->row();

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
		$sino = $lastid->saleinvoice;
		
		$orderid = $orderid;
		$json = $this->input->post('CartData', TRUE);
		$cartArray = json_decode($json);

		foreach($cartArray as $item){
			$addonsqty='';
			$addonsid='';
			if($item->addons==1){
				foreach($item->addonsinfo as $addonsitem){
					if($addonsitem->count>0){
					$addonsqty.=$addonsitem->count.",";
					$addonsid.=$addonsitem->addonsid.",";
				    }
					}
					$addonsqty=trim($addonsqty, ',');
			        $addonsid=trim($addonsid,',');
			}
				       $data3=array('order_id'	    =>	$orderid,
						'menu_id'		        =>	$item->ProductsID,
						'menuqty'	        	=>	$item->count,
						'notes'		            =>	$item->itemnote,
						'varientid'		    	=>	$item->variantid,
						'add_on_id'	        	=>	$addonsid,
						'addonsqty'	        	=>	$addonsqty,
					);
					$this->db->insert('order_menu',$data3);
			        /***food habit module section***/
					$scan = scandir('application/modules/');
					$habitsys="";
					foreach($scan as $file) {
					   if($file=="testhabit"){
						   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
							   if(!empty($item->itemnote)){
						   		$habittest=array(
									'cusid'					=>	$cid,
									'itemid'		        =>	$item->ProductsID,
									'varient'		        =>	$item->variantid,
									'habit'	        		=>	$item->itemnote
								);
								$this->db->insert('tbl_habittrack',$habittest);
							   }
						   }
						}
					}
				
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
				}
			}
		return $orderid;
		}
		public function read_rating($table,$field1,$field2,$field2value) {
		
        $this->db->select('count('.$field1.') as totalrate');
		$this->db->where( $field2, $field2value );
		$this->db->where($field1.'!=', '');
		$this->db->where('status', 1 );
		$query = $this->db->get($table);
        $total_active_events = $query->num_rows();
		$allrows = $query->row();
        if( $total_active_events > 0 ) {
            return $allrows;
        }
        return false;
		
    }
	public function read_average($table,$field1,$field2,$field2value) {
		
        $this->db->select('AVG('.$field1.') as averagerating');
		$this->db->where( $field2, $field2value );
		$this->db->where('status', 1 );
		$query = $this->db->get($table);
        $total_active_events = $query->num_rows();
		$allrows = $query->row();
        if( $total_active_events > 0 ) {
            return $allrows;
        }
        return false;
		
    }
public function customerorder($customerid){
		$this->db->select('customer_order.*,bill.*');
        $this->db->from('customer_order');
		$this->db->join('bill','bill.order_id=customer_order.order_id','left');
		$this->db->where('customer_order.customer_id',$customerid);
		$this->db->distinct('customer_order.order_id');
		$this->db->order_by('customer_order.order_id','DESC');
		$this->db->limit('15');
		$query = $this->db->get();
		
		return $reserveinfo=$query->result();
		
		}
	public function customerfoodlist($oredrid){
		
		
		$this->db->select('order_menu.*,item_foods.ProductsID,item_foods.ProductName,item_foods.ProductImage,item_foods.OffersRate,variant.variantid,variant.variantName,variant.price');
        $this->db->from('order_menu');
		$this->db->join('item_foods','order_menu.menu_id=item_foods.ProductsID','left');
		$this->db->join('variant','order_menu.varientid=variant.variantid','left');
		$this->db->where('order_menu.order_id',$oredrid);
		$query = $this->db->get();
		$itemlist=$query->result();
		
	    return $itemlist;
		}
	public function productvarient($productid,$varient){
		$this->db->select('item_foods.ProductsID,item_foods.ProductName,item_foods.ProductImage,item_foods.component,item_foods.itemnotes,item_foods.descrip,item_foods.productvat,item_foods.OffersRate,item_foods.offerIsavailable,item_foods.offerstartdate,item_foods.offerendate,item_foods.ProductsIsActive,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('item_foods.ProductsID',$productid);
		$this->db->where('variant.variantid',$varient);
		$query = $this->db->get();
		$itemlist=$query->row();
	    return $itemlist;
		
		}
	public function allreviewlist($productid,$limit){
	    $this->db->select('*');
		$this->db->where('proid', $productid );
		$this->db->where('reviewtxt !=', '');
		$this->db->where('status', 1 );
		$this->db->order_by('ratingid','DESC');
		$this->db->limit($limit);
		$query = $this->db->get('tbl_rating');
        $total_active_events = $query->num_rows();
		return $allrows = $query->result();
	    
		}
}
