<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_model extends CI_Model {
	
	private $table = 'tblreservation';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function insertcustomer($data = array(),$mobile){
		$this->db->select('*');
        $this->db->from('customer_info');
		$this->db->where('customer_phone',$mobile);
		 $query = $this->db->get();
        if ($query->num_rows() > 0) {
           $customer=$query->result();
		  return $returnid =   $customer->customer_id;
        } 
		else{
		$this->db->insert('customer_info', $data);
		return $returnid = $this->db->insert_id();
		}
		}
	public function delete($id = null)
	{
		$this->db->where('reserveid',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update($data = array())
	{
		return $this->db->where('reserveid',$data["reserveid"])
			->update($this->table, $data);
	}

    public function read_reservation($limit = null, $start = null)
	{
	    $this->db->select('tblreservation.*,customer_info.*,rest_table.tablename,rest_table.person_capicity');
        $this->db->from($this->table);
		$this->db->join('customer_info','customer_info.customer_id = tblreservation.cid','left');
		$this->db->join('rest_table','rest_table.tableid = tblreservation.tableid','left');
        $this->db->order_by('reserveid', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('reserveid',$id) 
			->get()
			->row();
	} 
	public function findByCusId($id = null)
	{ 
		return $this->db->select("*")->from('customer_info')
			->where('customer_id',$id) 
			->get()
			->row();
	}
public function findBytableId($id = null)
	{ 
		return $this->db->select("*")->from('rest_table')
			->where('tableid',$id) 
			->get()
			->row();
	}
public function count_reservation()
	{
		$this->db->select('tblreservation.*,customer_info.*,rest_table.tablename,rest_table.person_capicity');
        $this->db->from($this->table);
		$this->db->join('customer_info','customer_info.customer_id = tblreservation.cid','left');
		$this->db->join('rest_table','rest_table.tableid = tblreservation.tableid','left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
 public function customer_dropdown()
	{
		$data = $this->db->select("*")
			->from('customer_info')
			->get()
			->result();

		$list[''] = 'Select Customer';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->customer_id] = $value->customer_name;
			return $list;
		} else {
			return false; 
		}
	}
	public function table_dropdown()
		{
			$data = $this->db->select("*")
				->from('rest_table')
				->get()
				->result();
	
			$list[''] = 'Select Table';
			if (!empty($data)) {
				foreach($data as $value)
					$list[$value->tableid] = $value->tablename;
				return $list;
			} else {
				return false; 
			}
		}
	
	public function read_gettable(){
			$data = $this->db->select("*")
				->from('rest_table')
				->get()
				->result();
				
				return $data;
		}
	public function bookedpeople(){
		$newdate= $this->input->post('getdate');
		$gettime=$this->input->post('time');
		$dateRange = "reserveday='$newdate' AND formtime<='$gettime' AND totime>='$gettime' AND status=2";
		$this->db->select('SUM(person_capicity) as totalperson');
        $this->db->from('tblreservation');
		$this->db->where($dateRange, NULL, FALSE); 
		$query = $this->db->get();
		return $query->row();
		} 
	public function checktable($id){
		$this->db->select('tableid');
        $this->db->from('rest_table');
        $this->db->where('tableid', $id);
		$this->db->where('status', 1);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
            return $query->row();    
        }
        return false;
		}  
	public function checkavailtable(){
		$bookdate = str_replace('/','-',$this->input->post('getdate'));
		$newdate= date('Y-m-d' , strtotime($bookdate));
		$gettime=$this->input->post('time');
		$nopeople=$this->input->post('people');
		$dateRange = "reserveday='$newdate' AND formtime<'$gettime' AND totime>'$gettime' AND person_capicity='$nopeople' AND status=2";
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
		$this->db->where('person_capicity', $person); 
		$query = $this->db->get();
		 if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
		}  
 public function getproduct(){
	 
	    $this->db->select('product_tbl.product_name,visit_comp_product_gap.product_id,visit_comp_product_gap.comp_product_name,visit_comp_product_gap.comp_product_qty');
        $this->db->from('product_tbl');
		$this->db->join('visit_comp_product_gap','visit_comp_product_gap.product_id = product_tbl.product_id','Inner');
		$this->db->where('visit_comp_product_gap.comp_product_name!=','none');
		$this->db->group_by('visit_comp_product_gap.product_id'); 
        $this->db->order_by('visit_comp_product_gap.product_id', 'Asc');
        $query = $this->db->get();
        
            $allproduct= $query->result();
			$singleproduct=''; 
			foreach($allproduct as $single){
				$singleproduct.="'".$single->product_name."',";
				}  
			$singleproduct=trim($singleproduct,',');
			return  $singleproduct;
	 }
  public function getquantity(){
	  $this->db->select('product_tbl.product_name,visit_comp_product_gap.product_id,visit_comp_product_gap.comp_product_name,visit_comp_product_gap.comp_product_qty,SUM(visit_comp_product_gap.comp_product_qty) as qty');
        $this->db->from('product_tbl');
		$this->db->join('visit_comp_product_gap','visit_comp_product_gap.product_id = product_tbl.product_id','Inner');
		$this->db->where('visit_comp_product_gap.comp_product_name!=','none');
		$this->db->group_by('visit_comp_product_gap.comp_product_name'); 
        $this->db->order_by('visit_comp_product_gap.product_id', 'Asc');
        $query = $this->db->get();
        
            $allproduct= $query->result();
			$singleproduct='';
		 
			foreach($allproduct as $single){
				 $singleproduct.="{ name: '$single->comp_product_name', data: [5, 3, 4, 7, 2]},";
				 }  
			$singleproduct=trim($singleproduct,',');
			
			return  $singleproduct;
	  }
	public function alloffdays()
	{
	    $this->db->select('*');
        $this->db->from('reservationofday');
        $this->db->order_by('offdayid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	public function unavailablecreate($data = array())
	{
		return $this->db->insert('reservationofday', $data);
	}
	public function deleteunavailable($id = null)
	{
		$this->db->where('offdayid',$id)
			->delete('reservationofday');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function updateunavail($data = array())
	{
		return $this->db->where('offdayid',$data["offdayid"])
			->update('reservationofday', $data);
	}
	public function findByIdunavail($id = null)
	{ 
		return $this->db->select("*")->from('reservationofday')
			->where('offdayid',$id) 
			->get()
			->row();
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
	public function updatesetting($data = array())
	{
		return $this->db->where('id',$data["id"])->update('setting', $data);
	} 
}
