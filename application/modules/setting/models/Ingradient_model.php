<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingradient_model extends CI_Model {
	
	private $table = 'ingredients';
 
	public function unit_ingredient($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function ingredient_delete($id = null)
	{
		$this->db->where('id',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 
	public function update_ingredient($data = array())
	{
		return $this->db->where('id',$data["id"])
			->update($this->table, $data);
	}

    public function read_ingredient($limit = null, $start = null)
	{
	    $this->db->select('ingredients.*,unit_of_measurement.uom_name');
        $this->db->from($this->table);
		$this->db->join('unit_of_measurement','ingredients.uom_id = unit_of_measurement.id','left');
        $this->db->order_by('id', 'desc');
    
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('id',$id) 
			->get()
			->row();
	} 

 
public function count_ingredient()
	{
		$this->db->select('ingredients.*,unit_of_measurement.uom_name');
        $this->db->from($this->table);
		$this->db->join('unit_of_measurement','ingredients.uom_id = unit_of_measurement.id','left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
    
}
