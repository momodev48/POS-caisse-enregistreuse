<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'membership_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('membership_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/membership/index');
        $config["total_rows"]  = $this->membership_model->countlist();
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
        $data["membershiplist"] = $this->membership_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('membership_edit');
		$data['intinfo']   = $this->membership_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "membershiplist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('membership_add');
	  #-------------------------------#
		$this->form_validation->set_rules('membershipname',display('membership_name'),'required|max_length[50]');
		$this->form_validation->set_rules('discount',display('discount')  ,'required');
	   $saveid=$this->session->userdata('id');
	   $discount=$this->input->post('discount');
	   if(empty($discount)){
		   $discount=0;
		   }
		else{
			$discount=$this->input->post('discount');
			}
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('id'))) {
		 $data['membership']   = (Object) $postData = [
		   'id'     			 => $this->input->post('id'),
		   'membership_name' 	 => $this->input->post('membershipname',true),
		   'discount' 	 		 => $discount,
		   'other_facilities' 	 => $this->input->post('facilities',true),
		   'create_by' 	 		 => $saveid,
		   'create_date' 	     => date('Y-m-d H:i:s'),
		   'update_by' 	 		 => $saveid,
		   'update_date' 	     => date('Y-m-d H:i:s'),
		  ];
		$this->permission->method('setting','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Membership List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Membership Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->membership_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/membership/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/membership/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		$data['membership']   = (Object) $postData = [
		   'id'     			 => $this->input->post('id'),
		   'membership_name' 	 => $this->input->post('membershipname',true),
		   'discount' 	 		 => $discount,
		   'other_facilities' 	 => $this->input->post('facilities',true),
		   'update_by' 	 		 => $saveid,
		   'update_date' 	     => date('Y-m-d H:i:s'),
		  ];
	  $logData = [
	   'action_page'         => "Membership List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Membership Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];

		if ($this->membership_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/membership/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('membership_edit');
		$data['intinfo']   = $this->membership_model->findById($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "membershiplist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('membership_edit');
		$data['intinfo']   = $this->membership_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "membershipedit";
		$this->load->view('setting/membershipedit', $data);   

	   }
 
    public function delete($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = [
	   'action_page'         => "Membership List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Membership Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->membership_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/membership/index');
    }
 
}
