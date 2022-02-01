<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smsetting extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->library('lsoft_setting');
 		$this->load->model(array(
 			'sms_model'  
 		));
 		
		if (! $this->session->userdata('isAdmin'))
			redirect('login');
 	}
 
	//sms Configuration
    public function sms_configuration(){
		$data['title'] = display('sms_setting'); 
       $data['gateways']= $this->lsoft_setting->sms_configuration_form();
		$data['module'] = "setting";  
		$data['page']   = "sms/form"; 
		echo Modules::run('template/layout', $data);
    }

        //Update sms configuration
    public function update_sms_configuration(){   
		$id = $this->input->post('id');
		$username=$this->input->post('user_name');
		$password=$this->input->post('password');
		$sms_from=$this->input->post('sms_from');
		$userid=$this->input->post('userid');
		$isactive=$this->input->post('status');
		for($i=0, $n=count($id); $i < $n; $i++) {
			$status=0;
		if($id[$i]==$isactive[0]){
			$status=1;
			}
				 $data=array(
					 'id'         	=> $id[$i],
					 'user_name'    => $username[$i],           
					 'password'     => $password[$i],
					 'sms_from'     => $sms_from[$i],
					 'userid'       => $userid[$i],
					 'status'       => $status,
				 );
			
				$this->sms_model->update_sms_config($data,$id[$i]);
			}
       $this->session->set_flashdata('message', display('update_successfully'));
        redirect("setting/smsetting/sms_configuration");
    }
	
	    /*sms sms_template*/
    public function sms_template(){
    	$data['template'] = $this->sms_model->template_list();

    	$data['title'] = display('sms_template'); 
		$data['module'] = "setting";  
		$data['page']   = "sms/sms_template"; 
		echo Modules::run('template/layout', $data);
    }


	//save sms template
    public function save_sms_template(){
    	$data=array(			
    		'template_name' => $this->input->post('template_name'),
    		'type'			=> $this->input->post('type'),			
    		'message' 	=> $this->input->post('message'),
    	);

    	$this->sms_model->save_sms_template($data);
		$this->session->set_flashdata('message', display('save_successfully'));
    	redirect('setting/smsetting/sms_template');
    }

//delete template
    public function delete_teamplate($id){
    	$this->db->where('id',$id)->delete('sms_template');
    	$this->session->set_flashdata('message', display('delete_successfully'));
    	redirect('setting/smsetting/sms_template');
    }

    public function template_update(){
    	$data=array(    					
    		'template_name' => $this->input->post('template_name'),
    		'type'			=> $this->input->post('type'),			
    		'message' 	=> $this->input->post('message'),
    	);
    	$this->sms_model->template_update($data);
		$this->session->set_flashdata('message', display('update_successfully'));
    	redirect('setting/smsetting/sms_template');
    }

    public function set_default_template($id=null, $status = null){
    	$this->db->set('default_status', (($status == 1) ? 0 : 1))
    	->where('id', $id)
    	->update('sms_template');
    	$this->session->set_flashdata('message', display('successfully_updated'));
    	redirect('setting/smsetting/sms_template');
    }
}
