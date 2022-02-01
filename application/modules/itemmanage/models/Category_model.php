<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
	
	private $table = 'item_category';
 
    public function cat_view()
	{
		return $this->db->select('*')	
			->from($this->table)
			->order_by('CategoryID', 'desc')
			->get()
			->result();
	}
	public function cat_create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}

	public function cat_delete($id = null)
	{
		$this->db->where('CategoryID',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 




	public function update_cat($data = array())
	{
		return $this->db->where('CategoryID',$data["CategoryID"])
			->update($this->table, $data);
	}

    public function read_category($limit = null, $start = null)
	{
	   $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('CategoryID', 'desc');
     
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('CategoryID',$id) 
    		->limit($limit, $start)
			->get()
			->row();
	} 
 
// Department Dropdown
	public function category_dropdown()
	{
		$data = $this->db->select("*")
			->from($this->table)
			->get()
			->result();

		$list[''] = display('category_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->CategoryID] = $value->Name;
			return $list;
		} else {
			return false; 
		}
	}
 // Parent Category Dropdown
	
    public function allcategory_dropdown(){

        $this->db->select('*');
        $this->db->from('item_category');
        $this->db->where('parentid', 0);
        $parent = $this->db->get();
        $categories = $parent->result();
        $i=0;
        foreach($categories as $p_cat){
			
            $categories[$i]->sub = $this->sub_categories($p_cat->CategoryID);
			
            $i++;
        }
        return $categories;
    }
    public function sub_categories($id){

        $this->db->select('*');
        $this->db->from('item_category');
        $this->db->where('parentid', $id);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){
            $categories[$i]->sub = $this->sub_categories($p_cat->CategoryID);
            $i++;
        }
        return $categories;       
    }
	
	
	    public function checkcategoryitem($catid){
	    $this->db->select('*');
        $this->db->from('item_foods');
		$this->db->where('CategoryID', $catid);
		$query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	   }

	
public function count_category()
	{
		$this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
    
}
