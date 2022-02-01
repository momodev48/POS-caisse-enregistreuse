<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shippingmethod extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'shipping_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('shipping_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/shippingmethod/index');
        $config["total_rows"]  = $this->shipping_model->countlist();
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
        $data["shippinglist"] = $this->shipping_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('shipping_edit');
		$data['intinfo']   = $this->shipping_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "shippinglist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('shipping_add');
	  #-------------------------------#
		$this->form_validation->set_rules('shipping',display('payment_name'),'required|max_length[50]');
		$this->form_validation->set_rules('shippingrate',display('shippingrate')  ,'required');
		$this->form_validation->set_rules('status',display('status')  ,'required');
	   $saveid=$this->session->userdata('id');
	   $data['payments']   = (Object) $postData = [
		   'ship_id'  			 => $this->input->post('ship_id'),
		   'shipping_method' 	 => $this->input->post('shipping',true),
		   'shippingrate' 	 	 => $this->input->post('shippingrate',true),
		   'shiptype' 	 	 	 => $this->input->post('shippintype',true),
		   'is_active' 	 		 => $this->input->post('status',true),
		  ]; 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('ship_id'))) {
		
		$this->permission->method('setting','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Shipping Method List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Shipping Method Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->shipping_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/shippingmethod/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/shippingmethod/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = [
	   'action_page'         => "Shipping Method List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Shipping Method Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
	
		if ($this->shipping_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/shippingmethod/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('shipping_edit');
		$data['intinfo']   = $this->shipping_model->findById($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "shippinglist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('shipping_edit');
		$data['intinfo']   = $this->shipping_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "shippingedit";
		$this->load->view('setting/shippingedit', $data);   
     
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = [
	   'action_page'         => "Shipping Method List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Shipping Method Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->shipping_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/shippingmethod/index');
    }
 
}
