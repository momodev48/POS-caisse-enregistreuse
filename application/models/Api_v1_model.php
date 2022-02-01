<?php

class Api_v1_model extends CI_Model
{

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
   public function read2($select_items, $table, $orderby, $where_array)
			{
			   
				$this->db->select($select_items);
				$this->db->from($table);
				foreach ($where_array as $field => $value) {
					$this->db->where($field, $value);
					
				}
				$this->db->order_by($orderby,'DESC');
				return $this->db->get()->result();
			}
	public function orderlist($waiter,$status){
		$Today=date('Y-m-d');
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where('customer_order.waiter_id',$waiter);
		$this->db->where('customer_order.order_status',$status);
		$this->db->where('customer_order.order_date',$Today);
		$this->db->order_by('customer_order.order_id','desc');
		$query = $this->db->get();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
	public function allorderlist($waiter,$status,$limit = null, $start = null){
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->where('customer_order.waiter_id',$waiter);
		$this->db->where('customer_order.order_status',$status);
		$this->db->order_by('customer_order.order_id', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		$orderdetails=$query->result();
	    return $orderdetails;
		}
	 public function count_comorder($waiter,$status)
	{
		$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
        $this->db->from('customer_order');
		$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
		$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
		$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
		$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
		$this->db->join('bill','customer_order.order_id=bill.order_id','left');
		$this->db->where('customer_order.waiter_id',$waiter);
		$this->db->where('customer_order.order_status',$status);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
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
	public function get_all($select_items, $table, $orderby)
		{
			$this->db->select($select_items);
			$this->db->from($table);
			$this->db->order_by($orderby,'ASC');
			return $this->db->get()->result();
		}
 

    public function authenticate_user($table, $data)
    {
        $Type = $data['email'];
        $Password = $data['password'];
        $this->db->select("user.id,user.firstname, user.lastname, user.email, employee_history.picture");
		$this->db->join("employee_history",'employee_history.emp_his_id=user.id','left');
		$this->db->where('employee_history.pos_id', 6);
		$this->db->where('user.email', $data['email']);
        $this->db->where("(user.password = '" . $Password . "' OR user.password =  '" . md5($Password) . "')", NULL, TRUE);
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
	public function categorylist($catid){
		$this->db->select('CategoryID,Name,CategoryImage');
        $this->db->from('item_category');
		if(!empty($catid)){
		$this->db->like('Name',$catid);
		}
		$this->db->where('CategoryIsActive',1);
		$this->db->where('parentid',0);
		$this->db->group_by('CategoryID');
		$query = $this->db->get();
		$categorylist=$query->result();
	    return $categorylist;
		}
	public function allsublist($catid){
		$this->db->select('CategoryID,Name,CategoryImage');
        $this->db->from('item_category');
		$this->db->where('parentid',$catid);
		$query = $this->db->get();
		$categorylist=$query->result();
	
	    return $categorylist;
		}
	public function foodlist($CategoryID=null){
	
		
		$this->db->select('*');
        $this->db->from('item_foods');
		$this->db->where('ProductsIsActive',1);
		$this->db->where('CategoryID',$CategoryID);		
		$query = $this->db->get();
		$itemlist=$query->result();
		$output=array();
	    if(!empty($itemlist)){
			$k=0;
			foreach($itemlist as $items){
				$varientinfo=$this->db->select("variant.*,count(menuid) as totalvarient")->from('variant')->where('menuid',$items->ProductsID)->get()->row();
				if(!empty($varientinfo)){
					$output[$k]['variantid']=$varientinfo->variantid;
					$output[$k]['totalvarient']=$varientinfo->totalvarient;
					$output[$k]['variantName']=$varientinfo->variantName;
					$output[$k]['price']=$varientinfo->price;
				}else{
					$output[$k]['variantid']='';
					$output[$k]['totalvarient']=0;
					$output[$k]['variantName']='';
					$output[$k]['price']='';
					}
				$output[$k]['ProductsID']=$items->ProductsID;
				$output[$k]['CategoryID']=$items->CategoryID;
				$output[$k]['ProductName']=$items->ProductName;
				$output[$k]['ProductImage']=$items->ProductImage;
				$output[$k]['bigthumb']=$items->bigthumb;
				$output[$k]['medium_thumb']=$items->medium_thumb;
				$output[$k]['small_thumb']=$items->small_thumb;
				$output[$k]['component']=$items->component;
				$output[$k]['descrip']=$items->descrip;
				$output[$k]['itemnotes']=$items->itemnotes;
				$output[$k]['menutype']=$items->menutype;
				$output[$k]['productvat']=$items->productvat;
				$output[$k]['special']=$items->special;
				$output[$k]['OffersRate']=$items->OffersRate;
				$output[$k]['offerIsavailable']=$items->offerIsavailable;
				$output[$k]['offerstartdate']=$items->offerstartdate;
				$output[$k]['offerendate']=$items->offerendate;
				$output[$k]['Position']=$items->Position;
				$output[$k]['kitchenid']=$items->kitchenid;
				$output[$k]['isgroup']=$items->isgroup;
				$output[$k]['is_customqty']=$items->is_customqty;
				$output[$k]['cookedtime']=$items->cookedtime;
				$output[$k]['ProductsIsActive']=$items->ProductsIsActive;
				$k++;	
				}
		}
	    return $output;
		}
		public function foodlistallcat($CategoryID){
	    $weherein='item_foods.CategoryID IN('.$CategoryID.')';
		$this->db->select('*');
        $this->db->from('item_foods');
		$this->db->where('ProductsIsActive',1);
		$weherein='item_foods.CategoryID IN('.$CategoryID.')';	
		$query = $this->db->get();
		$itemlist=$query->result();
		$output=array();
	    if(!empty($itemlist)){
			$k=0;
			foreach($itemlist as $items){
				$varientinfo=$this->db->select("variant.*,count(menuid) as totalvarient")->from('variant')->where('menuid',$items->ProductsID)->get()->row();
				if(!empty($varientinfo)){
					$output[$k]['variantid']=$varientinfo->variantid;
					$output[$k]['totalvarient']=$varientinfo->totalvarient;
					$output[$k]['variantName']=$varientinfo->variantName;
					$output[$k]['price']=$varientinfo->price;
				}else{
					$output[$k]['variantid']='';
					$output[$k]['totalvarient']=0;
					$output[$k]['variantName']='';
					$output[$k]['price']='';
					}
				$output[$k]['ProductsID']=$items->ProductsID;
				$output[$k]['CategoryID']=$items->CategoryID;
				$output[$k]['ProductName']=$items->ProductName;
				$output[$k]['ProductImage']=$items->ProductImage;
				$output[$k]['bigthumb']=$items->bigthumb;
				$output[$k]['medium_thumb']=$items->medium_thumb;
				$output[$k]['small_thumb']=$items->small_thumb;
				$output[$k]['component']=$items->component;
				$output[$k]['descrip']=$items->descrip;
				$output[$k]['itemnotes']=$items->itemnotes;
				$output[$k]['menutype']=$items->menutype;
				$output[$k]['productvat']=$items->productvat;
				$output[$k]['special']=$items->special;
				$output[$k]['OffersRate']=$items->OffersRate;
				$output[$k]['offerIsavailable']=$items->offerIsavailable;
				$output[$k]['offerstartdate']=$items->offerstartdate;
				$output[$k]['offerendate']=$items->offerendate;
				$output[$k]['Position']=$items->Position;
				$output[$k]['kitchenid']=$items->kitchenid;
				$output[$k]['isgroup']=$items->isgroup;
				$output[$k]['is_customqty']=$items->is_customqty;
				$output[$k]['cookedtime']=$items->cookedtime;
				$output[$k]['ProductsIsActive']=$items->ProductsIsActive;
				$k++;	
				}
		}
	    return $output;
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

   public function allincomminglist(){
			$currentdate=date('Y-m-d');
			$condition="(customer_order.waiter_id IS NULL OR customer_order.waiter_id='') AND customer_order.order_date='".$currentdate."' AND customer_order.order_status!=5";
			$this->db->select('customer_order.*,customer_info.customer_name,customer_type.customer_type,employee_history.first_name,employee_history.last_name,rest_table.tablename');
			$this->db->from('customer_order');
			$this->db->join('customer_info','customer_order.customer_id=customer_info.customer_id','left');
			$this->db->join('customer_type','customer_order.cutomertype=customer_type.customer_type_id','left');
			$this->db->join('employee_history','customer_order.waiter_id=employee_history.emp_his_id','left');
			$this->db->join('rest_table','customer_order.table_no=rest_table.tableid','left');
			$this->db->where('customer_order.isthirdparty',0);
			$this->db->where('customer_order.cutomertype',2);
			$this->db->where($condition);
			$this->db->order_by('customer_order.order_id', 'ASC');
			$query = $this->db->get();
	
			return $orderdetails=$query->result();
		} 

}
