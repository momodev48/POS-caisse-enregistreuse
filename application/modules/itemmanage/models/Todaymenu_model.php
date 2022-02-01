<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todaymenu_model extends MX_Controller {
    
    private $table = 'tbl_menutype';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('menutypeid',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update_menutype($data = array())
	{
		return $this->db->where('menutypeid',$data["menutypeid"])
			->update($this->table, $data);
	}

    public function read_menulist()
	{
	    $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('menutypeid', 'desc');
		$this->db->where('status', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)->where('menutypeid',$id)->get()->row();
	} 
 

    
}
