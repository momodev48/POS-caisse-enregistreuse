<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kitchen_model extends CI_Model {
 
	
   private $table = 'tbl_kitchen';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('kitchenid',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 




	public function update($data = array())
	{
		return $this->db->where('kitchenid',$data["kitchenid"])
			->update($this->table, $data);
	}

    public function read($limit = null, $start = null)
	{
	   $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('kitchenid', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 
    public function allprinters(){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where("ip!=''");
			$this->db->order_by('kitchenid', 'desc');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();    
			}
			return false;
		}
	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('kitchenid',$id) 
			->get()
			->row();
	} 

 
public function countlist()
	{
		$this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
	public function checkandsave($data = array()){
			$total=$this->db->select("*")->from('tbl_assign_kitchen')->where('kitchen_id',$data["kitchen_id"])->where('userid',$data["userid"])->get()->num_rows();
			if($total>0){
				 return 0;
				}
			else{
				 $this->db->insert('tbl_assign_kitchen', $data);
				 return 1;
				}
		}
	public function allkitchen(){
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('kitchenid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
		}
	public function allkitchenuser(){
		$this->db->select('user.firstname,user.lastname,user.id,user.email,employee_history.phone');
        $this->db->from('user');
		$this->db->where('employee_history.pos_id',1);
		$this->db->join('employee_history','employee_history.emp_his_id=user.id','Left');
		$this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
		}
	public function allssignuser(){
		$this->db->select('tbl_assign_kitchen.*,user.firstname,user.lastname,tbl_kitchen.kitchen_name,');
        $this->db->from('tbl_assign_kitchen');
		$this->db->where('tbl_kitchen.status',1);
		$this->db->join('tbl_kitchen','tbl_kitchen.kitchenid=tbl_assign_kitchen.kitchen_id','Left');
		$this->db->join('user','user.id=tbl_assign_kitchen.userid','Left');
		$this->db->order_by('tbl_assign_kitchen.assignid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
		}

}
