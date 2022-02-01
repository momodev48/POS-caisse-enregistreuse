<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fooditem_model extends CI_Model {
	private $table = 'item_foods';

	public function fooditem_create($data = array())
	{
		return $this->db->insert($this->table, $data);
	}
	public function groupfood_create($data = array())
	{
		$this->db->insert($this->table, $data);
		$insert_id = $this->db->insert_id();
		$item_id = $this->input->post('itemid',true);
		$varientid = $this->input->post('varientid',true);
		$qty = $this->input->post('qty',true);
		$price = $this->input->post('price',true);
		if(!empty($qty)){
					$data2 = array(
						'menuid'		=>	$insert_id,
						'variantName'	=>	"Set",
						'price'		    =>	$price,						
						);
					$this->db->select('menuid');
					$this->db->from('variant');
					$this->db->where('menuid',$insert_id);
					$query = $this->db->get();
					$getrow=$query->row();
					if(empty($getrow)) {
            			$this->db->insert('variant', $data2);
        			}
				}
		for ($i=0, $n=count($item_id); $i < $n; $i++) {
				$data1 = array(
				'gitemid'		=>	$insert_id,
				'items'			=>	$item_id[$i],
				'item_qty'		=>	$qty[$i],
				'varientid'		=>	$varientid[$i],
				'status'		=>	1
				);
				if(!empty($qty)){
					$this->db->insert('tbl_groupitems', $data1);
				}
			}
			if(!empty($insert_id)){
				return true;
				}
			else{
				return false;
				}
			
		
	}
	public function addsupplier($data = array())
	{
		return $this->db->insert('supplier', $data);
	}
   
	public function fooditem_delete($id = null)
	{
		$this->db->where('ProductsID',$id)->delete($this->table);

		if ($this->db->affected_rows()) {
			$this->db->where('menuid',$id)->delete('variant');
			$this->db->where('menu_id',$id)->delete('menu_add_on');
			return true;
		} else {
			return false;
		}
	} 

	public function update_fooditem($data = array())
	{
		return $this->db->where('ProductsID',$data["ProductsID"])
			->update($this->table, $data);
	}
	
	public function update_groupfooditem($data = array())
	{
		$this->db->where('ProductsID',$data["ProductsID"])->update($this->table, $data);
		$item_id = $this->input->post('itemid',true);
		$varientid = $this->input->post('varientid',true);
		$qty = $this->input->post('qty',true);
		$price = $this->input->post('price',true);
		if(!empty($qty)){
					$data2 = array(
						'menuid'		=>	$data["ProductsID"],
						'variantName'	=>	"Set",
						'price'		    =>	$price,						
						);
						$data3 = array(
						'price'		    =>	$price					
						);
					$this->db->select('menuid');
					$this->db->from('variant');
					$this->db->where('menuid',$data["ProductsID"]);
					$query = $this->db->get();
					$getrow=$query->row();
					if(empty($getrow)) {
            			$this->db->insert('variant', $data2);
        			}else{
						$this->db->where('menuid',$data["ProductsID"])->where('variantName','set')->update('variant', $data3);
						}
				}
		$this->db->where('gitemid',$data["ProductsID"])->delete('tbl_groupitems');
		for ($i=0, $n=count($item_id); $i < $n; $i++) {
				$data1 = array(
				'gitemid'		=>	$data["ProductsID"],
				'items'			=>	$item_id[$i],
				'item_qty'		=>	$qty[$i],
				'varientid'		=>	$varientid[$i],
				'status'		=>	1
				);
				if(!empty($qty)){
            			$this->db->insert('tbl_groupitems', $data1);
        			}
			}
	}

    public function read_fooditem($limit = null, $start = null)
	{
	    $this->db->select('item_foods.*,item_category.Name');
        $this->db->from($this->table);
		$this->db->join('item_category','item_foods.CategoryID = item_category.CategoryID','left');
        $this->db->order_by('ProductsID', 'desc');
   
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('ProductsID',$id) 
    		->limit($limit, $start)
			->get()
			->row();
	}
	public function findBygroupId($id = null)
	{ 
		$this->db->select('variant.*,item_foods.*');
        $this->db->from($this->table);
		$this->db->join('variant','variant.menuid = item_foods.ProductsID','left');
		$this->db->where('item_foods.ProductsID',$id);
        $query = $this->db->get();
		return $query->row();
	}  
 	public function allgroupitem($id = null)
	{ 
		$this->db->select('*');
        $this->db->from('tbl_groupitems');
		$this->db->where('gitemid',$id);
        $query = $this->db->get();
	
		return $query->result();
	} 
// Category Dropdown
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
	public function parentcategory_dropdown($parent = null)
	{
		return $this->db->select("*")
			->from('item_category')
			->where('parentid',$parent) 
			->get()
			->result();

		
	}

 public function fooditem_dropdown()
	{
		$data = $this->db->select("*")
			->from($this->table)
			->get()
			->result();

		$list[''] = 'Select '.display('item_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->ProductsID] = $value->ProductName;
			return $list;
		} else {
			return false; 
		}
	}

public function count_fooditem()
	{
		$this->db->select('item_foods.*,item_category.Name');
        $this->db->from($this->table);
		$this->db->join('item_category','item_foods.CategoryID = item_category.CategoryID','left');
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
	public function allkitchen(){
		$data = $this->db->select("*")
			->from('tbl_kitchen')
			->where('status',1)
			->get()
			->result();
			return $data;
		
		}
	public function findfooditem($product_name)
		{ 
		$this->db->select('item_foods.*,variant.variantid,variant.variantName,variant.price');
        $this->db->from('item_foods');
		$this->db->join('variant','item_foods.ProductsID=variant.menuid','left');
		$this->db->where('ProductsIsActive',1);
		$this->db->like('ProductName', $product_name);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
		}
		
		
}
