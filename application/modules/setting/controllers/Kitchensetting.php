<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kitchensetting extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->library('lsoft_setting');
 		$this->load->model(array(
 			'kitchen_model',
			'logs_model'  
 		));
 		
		if (! $this->session->userdata('isAdmin'))
			redirect('login');
 	}
 
	//Kitchen List
    public function index(){
       $this->permission->method('setting','read')->redirect();
        $data['title']    = display('kitchen_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/kitchensetting/index');
        $config["total_rows"]  = $this->kitchen_model->countlist();
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
        $data["kitchenlist"] = $this->kitchen_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('kitchen_edit');
		$data['intinfo']   = $this->kitchen_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "kitchenlist";   
        echo Modules::run('template/layout', $data);
    }

        //Create Kitchen
    public function create($id = null)
    {
	  $data['title'] = display('add_kitchen');
	  #-------------------------------#
		$this->form_validation->set_rules('kitchenname',display('kitchen_name'),'required|max_length[50]');		
	   $saveid=$this->session->userdata('id');
	   $data['type']   = (Object) $postData = array(
		   'kitchenid'  		    => $this->input->post('kitchenid'),
		   'kitchen_name' 			=> $this->input->post('kitchenname',true),
		   'status' 			    => 1,
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('kitchenid'))) {
		$this->permission->method('setting','create')->redirect();
	 $logData =array(
	   'action_page'         => "Kitchen List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Kitchen Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->kitchen_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/kitchensetting/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/kitchensetting/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = array(
	   'action_page'         => "Kitchen List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Kitchen Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	 
		if ($this->kitchen_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/kitchensetting/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('kitchen_edit');
		$data['intinfo']   = $this->currency_model->findById($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "kitchenlist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
	public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('kitchen_edit');
		$data['intinfo']   = $this->kitchen_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "kitchenedit";
		$this->load->view('setting/kitchenedit', $data);   
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = array(
	   'action_page'         => "Kitchen List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Kitchen Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->kitchen_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/kitchensetting/index');
    }
    public function printersetting(){
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('printer_list'); 
		$data["printerlist"] = $this->kitchen_model->allprinters();
		$data['allkitchen']   = $this->kitchen_model->allkitchen();
		$data['module'] = "setting";
        $data['page']   = "printerlist";   
        echo Modules::run('template/layout', $data);
		}
	public function addprinter($id = null)
    {
	  $data['title'] = display('add_kitchen');
	  #-------------------------------#
		$this->form_validation->set_rules('kitchenname',display('kitchen_name'),'required|max_length[50]');
		$this->form_validation->set_rules('ipaddress',display('ip_address'),'required|max_length[50]');	
		$this->form_validation->set_rules('ipport',display('ip_port'),'required|max_length[50]');		
	   $saveid=$this->session->userdata('id');
	   $data['type']   = (Object) $postData = array(
	   	   'kitchenid'  	=> $this->input->post('kitchenname'),
		   'ip'  		    => $this->input->post('ipaddress'),
		   'port' 			=> $this->input->post('ipport',true)
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	 $this->permission->method('setting','update')->redirect();
		
	  $logData = array(
	   'action_page'         => "Kitchen List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Kitchen Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	
		if ($this->kitchen_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/kitchensetting/printersetting");  
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('update');
		$data['intinfo']   = $this->currency_model->findById($id);
	   }
	   $data["printerlist"] = $this->kitchen_model->allprinters();
	   $data['allkitchen']   = $this->kitchen_model->allkitchen();
	   $data['module'] = "setting";
	   $data['page']   = "printerlist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
	public function updateprintertfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('update');
		$data['intinfo']   = $this->kitchen_model->findById($id);
		$data["printerlist"] = $this->kitchen_model->allprinters();
	    $data['allkitchen']   = $this->kitchen_model->allkitchen();
        $data['module'] = "setting";  
        $data['page']   = "printeredit";
		$this->load->view('setting/printeredit', $data);   
	   }
	public function assignkitchen(){
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('kitchen_assign');
		$data['allkitchen']   = $this->kitchen_model->allkitchen();
		$data['alluser']   = $this->kitchen_model->allkitchenuser();
		$data['allkitchenuser']   = $this->kitchen_model->allssignuser();
        $data['module'] = "setting";  
        $data['page']   = "assign_kitchen";
		echo Modules::run('template/layout', $data);  
	   }
  public function save_kitchenuser_access(){
	  	$this->form_validation->set_rules('user_id',display('user'),'required');	
		$this->form_validation->set_rules('kitchen',display('kitchen_name'),'required');
			if ($this->form_validation->run()){
				 $data['type']   = (Object) $postData = array(
				   'kitchen_id'  		    => $this->input->post('kitchen'),
				   'userid' 			=> $this->input->post('user_id',true),
				  ); 
				  echo $issave=$this->kitchen_model->checkandsave($postData);
				  if($issave>0){
					  $this->session->set_flashdata('message', display('save_successfully'));
					  }
				  else{
					  $this->session->set_flashdata('exception',  display('please_try_again_userassign'));
					  }
			    redirect("setting/kitchensetting/assignkitchen");
			}	
			else{
				$data['title'] = display('kitchen_assign');
				$data['allkitchen']   = $this->kitchen_model->allkitchen();
				$data['alluser']   = $this->kitchen_model->allkitchenuser();
				$data['module'] = "setting";  
				$data['page']   = "assign_kitchen";
				echo Modules::run('template/layout', $data);  
				}
	  }
	
}
