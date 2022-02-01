<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banklist_model extends CI_Model {
	
	private $table = 'tbl_bank';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('bankid',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 




	public function update($data = array())
	{
		return $this->db->where('bankid',$data["bankid"])
			->update($this->table, $data);
	}

    public function read($limit = null, $start = null)
	{
	    $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('bankid', 'desc');
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
			->where('bankid',$id) 
			->get()
			->row();
	} 
	public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '1020102%'");
        return $query->row();

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
public function settinginfo()
	{ 
		return $this->db->select("*")->from('setting')
			->get()
			->row();
	}
	public function currencysetting($id = null)
	{ 
		return $this->db->select("*")->from('currency')
			->where('currencyid',$id) 
			->get()
			->row();
	} 
    public function get_bank_list($id=null){
			$this->db->select('*');
			$this->db->from($this->table);
			if(!empty($id)){
			$this->db->where('bankid',$id);
			}
			$this->db->order_by('bankid', 'desc');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();    
			}
			return false;
		}
	
	 public function get_bank_ledger($id=null){
			$this->db->select('*');
			$this->db->from('bank_summary');
			if(!empty($id)){
			$this->db->where('bank_id',$id);
			}
			$this->db->order_by('bank_id', 'desc');
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();    
			}
			return false;
		}
}
