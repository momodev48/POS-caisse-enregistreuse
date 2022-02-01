<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 
class Facebooklogin_model extends CI_Model{ 
        
  
    public function __construct()
    {
        parent::__construct();
    }

   public function show_api()
   {
    $result = $this->db->get('facebook_settings')->row();
        return $result;

   }
   public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '102030%'");
        return $query->row();
    }

    public function insert_data($table, $data)
    {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
    }
    public function update_data($id,$data = array())
      {
    return $this->db->where('id',$id)
      ->update('facebook_settings', $data);
      }

    

     
}