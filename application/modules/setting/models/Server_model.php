<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Server_model extends CI_Model {
 
	private $table = "tblserver";

	public function create($data = [])
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
	
  	public function update($data = [])
	{
		return $this->db->where('serverid',$data['serverid'])
			->update($this->table,$data); 
	} 
	
}
