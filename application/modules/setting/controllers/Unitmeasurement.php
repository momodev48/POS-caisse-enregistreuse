<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unitmeasurement extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'unit_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('unit_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/unitmeasurement/index');
        $config["total_rows"]  = $this->unit_model->count_unit();
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
        $data["unitlist"] = $this->unit_model->read_unit($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
		if(!empty($id)) {
		$data['title'] = display('unit_update');
		$data['unitinfo']   = $this->unit_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "unitlist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('unit_add');
	  #-------------------------------#
		$this->form_validation->set_rules('unitname',display('unit_name'),'required|max_length[50]');
		$this->form_validation->set_rules('shortname',display('unit_short_name')  ,'max_length[200]');
		$this->form_validation->set_rules('status', display('status')  ,'required');
	   
	  $data['unitinfo']="";
	  $data['units']   = (Object) $postData = [
	   'id'     => $this->input->post('id'),
	   'uom_name' 			 => $this->input->post('unitname',true),
	   'uom_short_code' 	 => $this->input->post('shortname',true),
	   'is_active' 	 	 => $this->input->post('status',true),
	  ];
	  if ($this->form_validation->run()) { 
	   if (empty($this->input->post('id'))) {
		$this->permission->method('setting','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Unit List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New unit Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->unit_model->unit_create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/unitmeasurement/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/unitmeasurement/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
	  $logData = [
	   'action_page'         => "Unit List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Unit Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];

		if ($this->unit_model->update_cat($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/unitmeasurement/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('unit_update');
		$data['unitinfo']   = $this->unit_model->findById($id);
	   }
	   $data['module'] = "setting";
	   $data['page']   = "unitlist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateunitfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('unit_update');
		$data['unitinfo']   = $this->unit_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "unitedit";
		$this->load->view('setting/unitedit', $data);   
      
	   }
 
    public function delete($category = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = [
	   'action_page'         => "Units List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Unit Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->unit_model->unit_delete($category)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/unitmeasurement/index');
    }
 
}
