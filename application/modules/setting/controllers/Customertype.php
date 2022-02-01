<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customertype extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->load->model(array(
			'customertype_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('customertype_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/customertype/index');
        $config["total_rows"]  = $this->customertype_model->countlist();
        $config["per_page"]    = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["typelist"] = $this->customertype_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('edit_type');
		$data['intinfo']   = $this->customertype_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "ctypelist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('type_add');
	  #-------------------------------#
		$this->form_validation->set_rules('typename',display('type_name'),'required|max_length[50]');
	   $saveid=$this->session->userdata('id');
	   $data['type']   = (Object) $postData = array(
		   'customer_type_id'  		=> $this->input->post('customer_type_id'),
		   'customer_type' 			=> $this->input->post('typename',true),
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('customer_type_id'))) {
		$this->permission->method('setting','create')->redirect();
		 $logData = array(
		   'action_page'         => "Customer Type List",
		   'action_done'     	 => "Insert Data", 
		   'remarks'             => "New Customer Type Created",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  );
		if ($this->customertype_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/customertype/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/customertype/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData =array(
	   'action_page'         => "Customer Type List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Customer Type Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	
		if ($this->customertype_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/customertype/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('edit_type');
		$data['intinfo']   = $this->customertype_model->findById($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "ctypelist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('edit_type');
		$data['intinfo']   = $this->customertype_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "ctypedit";
		$this->load->view('setting/ctypedit', $data);   
      
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = array(
	   'action_page'         => "Customer Type List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Customer Type Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->customertype_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/customertype/index');
    }
 
}
