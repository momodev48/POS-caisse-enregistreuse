<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
 
	private $table = "setting";

	public function create($data = array())
	{	 
		return $this->db->insert($this->table,$data);
	}
 
	public function read()
	{
		return $this->db->select("*")
			->from($this->table)
			->get()
			->row();
	} 
	
  	public function update($data = array())
	{
		return $this->db->where('id',$data['id'])
			->update($this->table,$data); 
	} 
	
	public function currencyList()
	{
		$data = $this->db->select("*")
			->from('currency')
			->get()
			->result();

		$list[''] = 'Select '.display('currency');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->currencyid] = $value->currencyname;
			return $list;
		} else {
			return false; 
		}
	}
 #payroll commision waiter wise

	public function poslist()
	{
		$this->db->select('pos_id');
      $this->db->from('payroll_commission_setting');
      $poses=$this->db->get()->result_array();
      $i=0;
      $pos_ids = array();
      foreach ($poses as $pos) {
        $pos_ids[$i] = $pos['pos_id'];
        $i++;
      }
	if(!empty($pos_ids)){
		$data = $this->db->select("pos_id,position_name")
			->from('position')
			->where_not_in('pos_id', $pos_ids)
			->get()
			->result();
		}
		else{
			$data = $this->db->select("pos_id,position_name")
			->from('position')
			->get()
			->result();
		}

		$list[''] = 'Select position';
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->pos_id] = $value->position_name;
			return $list;
		} else {
			return false; 
		}
	
	}
	public function editcomm($id){
			return $result = $this->db->select('payroll_commission_setting.*,position.*')	
			 ->from('payroll_commission_setting')
			 ->join('position','position.pos_id=payroll_commission_setting.pos_id')
			 ->where('payroll_commission_setting.id',$id)
	         ->get()
			 ->row();
	}

	public function showcommsionlist($id = null)
	{

		return $result = $this->db->select('payroll_commission_setting.*,position.*')	
			 ->from('payroll_commission_setting')
			 ->join('position','position.pos_id=payroll_commission_setting.pos_id')
	         ->get()
			 ->result();
	}

}
