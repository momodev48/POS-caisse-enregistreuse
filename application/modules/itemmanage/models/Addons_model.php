<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addons_model extends CI_Model {
	
	private $table = 'add_ons';
	private $table2 = 'menu_add_on';
 
	public function addons_create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function menuaddons_create($data = array())
	{
		return $this->db->insert($this->table2, $data);
	}

	public function addons_delete($id = null)
	{
		$this->db->where('add_on_id',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			$this->db->where('add_on_id',$id)->delete($this->table2);
			return true;
		} else {
			return false;
		}
	} 
  public function menuaddons_delete($id = null)
	{
		$this->db->where('row_id',$id)
			->delete($this->table2);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 



	public function update_addons($data = array())
	{
		return $this->db->where('add_on_id',$data["add_on_id"])
			->update($this->table, $data);
	}
	public function update_menuaddons($data = array())
	{
		
		return $this->db->where('row_id',$data["row_id"])
			->update('menu_add_on', $data);
	}

    public function read_addons($limit = null, $start = null)
	{
	   $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('add_on_id', 'desc');
       
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 
	public function read_menuaddons($limit = null, $start = null)
	{
	    $this->db->select('menu_add_on.*,item_foods.ProductName,add_ons.add_on_name');
        $this->db->from($this->table2);
		$this->db->join('item_foods','menu_add_on.menu_id = item_foods.ProductsID','left');
		$this->db->join('add_ons','menu_add_on.add_on_id = add_ons.add_on_id','inner');
        $this->db->order_by('row_id', 'desc');
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('add_on_id',$id) 
    		->limit($limit, $start)
			->get()
			->row();
	} 
	public function findBymenuaddons($id = null)
	{ 
		return $this->db->select("*")->from($this->table2)
			->where('row_id',$id) 
			->get()
			->row();
	} 
 
public function count_addons()
	{
		$this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
public function count_menuaddons()
	{
		$this->db->select('menu_add_on.*,item_foods.ProductName,add_ons.add_on_name');
        $this->db->from($this->table2);
		$this->db->join('item_foods','menu_add_on.menu_id = item_foods.ProductsID','left');
		$this->db->join('add_ons','menu_add_on.add_on_id = add_ons.add_on_id','inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
// menu item Dropdown
	public function menu_dropdown()
	{
		$data = $this->db->select("*")
			->from('item_foods')
			->where("ProductsIsActive", 1)
			->get()
			->result();

		$list[''] = display('item_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->ProductsID] = $value->ProductName;
			return $list;
		} else {
			return false; 
		}
	}
	
// Addons Dropdown
	public function addons_dropdown()
	{
		$data = $this->db->select("*")
			->from($this->table)
			->where("is_active", 1)
			->get()
			->result();

		$list[''] = display('addons_list');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->add_on_id] = $value->add_on_name;
			return $list;
		} else {
			return false; 
		}
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
    
}
