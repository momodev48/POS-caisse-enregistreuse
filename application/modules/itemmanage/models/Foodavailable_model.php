<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foodavailable_model extends MX_Controller {
    
    private $table = 'foodvariable';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function delete($id = null)
	{
		$this->db->where('availableID',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update($data = array())
	{
		return $this->db->where('availableID',$data["availableID"])
			->update($this->table, $data);
	}

    public function read($limit = null, $start = null)
	{
	   $this->db->select('foodvariable.*,item_foods.ProductName');
        $this->db->from($this->table);
		$this->db->join('item_foods','foodvariable.foodid = item_foods.ProductsID','left');
        $this->db->order_by('availableID', 'desc');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('availableID',$id) 
			->get()
			->row();
	} 

 
public function count_avail()
	{
		$this->db->select('foodvariable.*,item_foods.ProductName');
        $this->db->from($this->table);
		$this->db->join('item_foods','foodvariable.foodid = item_foods.ProductsID','left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
    
}
