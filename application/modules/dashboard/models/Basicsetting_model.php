<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Basicsetting_model extends CI_Model {
 
	public function openclosecreate($data = array())
	{	 
		return $this->db->insert('tbl_openclose',$data);
	}
	public function updatetime($data = array())
	{
		return $this->db->where('stid',$data["stid"])
			->update('tbl_openclose', $data);
	}
 
}
