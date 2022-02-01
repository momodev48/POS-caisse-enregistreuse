<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commissionsetting extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		
 		$this->load->model(array(
 			'Setting_model'  
 		));
 		
		if (! $this->session->userdata('isAdmin'))
			redirect('login');
 	}
 
	# Payroll for waiter 
    # Payroll setting

    public function payroll_commission($id = null)
    {
            $data['title']       = display('update');
        $this->form_validation->set_rules('rate', display('rate')  ,'required');
         $this->form_validation->set_rules('position', display('position')  ,'required');
         if ($this->form_validation->run()) {
            $postData = [
             'rate'     => $this->input->post('rate',true),
             'pos_id'       => $this->input->post('position',true), 
               ];
        
        if($id ==null){
                $this->db->insert('payroll_commission_setting',$postData);
        }
        else{
            $this->db->where('id',$id);
            $this->db->update('payroll_commission_setting',$postData);
        }
        echo "insert";exit;
         }
         else{
            $data['module']      = "setting";
            $data['commissions']  = $this->Setting_model->showcommsionlist();
            $data['page']        = "add_commision";   
            echo Modules::run('template/layout', $data); 
        }
    }
    public function edit_commission($id =null)
    {
        if($id ==null){
            $data['edit'] = $id;
        $data['poslist'] = $this->Setting_model->poslist();
        }
        else{
            $data['edit'] =$id;
        $data['poslist'] = $this->Setting_model->editcomm($id);
        }
        $this->load->view('edit_com',$data);
    }
       public function delete($id){
    
        $this->db->where('id',$id)->delete('payroll_commission_setting');
         redirect(base_url('setting/commissionsetting/payroll_commission'));
    }

}
