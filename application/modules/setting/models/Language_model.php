<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {
	
    private $table  = "language";
    private $phrase = "phrase";
	private function get_alllanguage_query($language,$phase)
	{
			//echo $language;		
			$column_order = array(null,"'".$phase."'","'".$language."'"); 
			$column_search = array("'".$phase."'","'".$language."'"); 
			$order = array($phase => 'asc');
			$condt='';
		if($_POST['search']['value']){
		$condt=$phase." LIKE '%".$_POST['search']['value']."%' ESCAPE '!' OR ".$language." LIKE '%".$_POST['search']['value']."%' ESCAPE '!' ";
		}
		$cdate=date('Y-m-d');
		$this->db->select('*');
        $this->db->from('language');
		if(!empty($condt)){
		$this->db->where($condt);
		}
		$this->db->order_by($phase,'asc');
		$i = 0;
	

		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		
		return $query->result();
		
	}
	public function get_alllanguage($language,$phase)
	{
		return $this->get_alllanguage_query($language,$phase);
		
	}
	public function count_filtertonlineorder($language=null,$phase=null)
	{
		$order = array($phase => 'asc');
			$condt='';
		if($_POST['search']['value']){
		$condt=$phase." LIKE '%".$_POST['search']['value']."%' ESCAPE '!' OR ".$language." LIKE '%".$_POST['search']['value']."%' ESCAPE '!' ";
		}
		$cdate=date('Y-m-d');
		$this->db->select('*');
        $this->db->from('language');
		if(!empty($condt)){
		$this->db->where($condt);
		}
		$this->db->order_by($phase,'asc');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_allonlineorder($language=null,$phase=null)
	{
		$cdate=date('Y-m-d');
		$this->db->select('*');
        $this->db->from('language');
		return $this->db->count_all_results();
	} 
 
	
	
}