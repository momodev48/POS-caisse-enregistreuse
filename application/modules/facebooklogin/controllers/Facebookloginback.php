<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebookloginback extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
       
        $this->load->model(array(
            
            'facebooklogin/facebooklogin_model',
           
        ));
       // $this->auth->check_admin_auth();
    }
    public function showsetting(){
    	$data['title'] = display('add_facebook_app');
	  #-------------------------------#
    	$facebook_settings = $this->facebooklogin_model->show_api();
	  $this->form_validation->set_rules('app_id', display('api_key')  ,'required|max_length[100]');
	  $this->form_validation->set_rules('app_secret', display('secret_key')  ,'required');
	 
	  if ($this->form_validation->run()) { 
	  	  $data['facebooklogin']   = (Object) $postData = [
	   'app_id'     => $this->input->post('app_id',true),
	   'app_secret'     	=> $this->input->post('app_secret',true), 
	  ];
	  	
	  	if(!$facebook_settings){
	  		$this->facebooklogin_model->insert_data('facebook_settings', $postData);
	  	
	  	}
	  	else{
	  	$this->facebooklogin_model->update_data($facebook_settings->id,$postData);
	  	}
	  	redirect("facebooklogin/facebookloginback/showsetting");
	  	
	  }
	  else{
    	
	   $data['facebookloginbackapi']   = $facebook_settings;
       $data['module'] = "facebooklogin";
	   $data['page']   = "back/add_setting";   
	   echo Modules::run('template/layout', $data);
	   }
    }
 
    
    
}
