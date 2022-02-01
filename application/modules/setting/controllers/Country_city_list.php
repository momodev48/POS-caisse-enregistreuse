<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_city_list extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'countrycity_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('country_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/country_city_list/index');
        $config["total_rows"]  = $this->countrycity_model->countlist();
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
        $data["countrylist"] = $this->countrycity_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('edit_country');
		$data['intinfo']   = $this->countrycity_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "countrylist";   
        echo Modules::run('template/layout', $data); 
    }
    public function create($id = null)
    {
	  $data['title'] = display('add_country');
	  #-------------------------------#
		$this->form_validation->set_rules('country',display('countryname'),'required|max_length[50]');
	   $saveid=$this->session->userdata('id');
	   $data['type']   = (Object) $postData = array(
	       'countryid'  		=> $this->input->post('countryid'),
		   'countryname'  		=> $this->input->post('country',true),
		   'status' 			=> 1,
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('countryid'))) {
		$this->permission->method('setting','create')->redirect();
	 $logData = array(
	   'action_page'         => "Country List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Country Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->countrycity_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/country_city_list/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/country_city_list/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = array(
	   'action_page'         => "Country List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Country Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	
		if ($this->countrycity_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/country_city_list/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('edit_type');
		$data['intinfo']   = $this->countrycity_model->findById($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "countrylist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('edit_country');
		$data['intinfo']   = $this->countrycity_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "countryedit";
		$this->load->view('setting/countryedit', $data);   
      
	   }
 
    public function deletecountry($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData =array(
	   'action_page'         => "country List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Country Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->countrycity_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/country_city_list/index');
    }
	
	//State section
	 public function statelist($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('state_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/country_city_list/statelist');
        $config["total_rows"]  = $this->countrycity_model->countstatelist();
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
        $data["statelist"] = $this->countrycity_model->readstate($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('edit_state');
		$data['intinfo']   = $this->countrycity_model->findByIdstate($id);
	   }
	   $data['country']   = $this->countrycity_model->allcountry();
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "statelist";   
        echo Modules::run('template/layout', $data); 
    }
    public function createstate($id = null)
    {
	  $data['title'] = display('add_country');
	  #-------------------------------#
		$this->form_validation->set_rules('country',display('countryname'),'required|max_length[50]');
		$this->form_validation->set_rules('state',display('state'),'required|max_length[50]');
		$data['country']   = $this->countrycity_model->allcountry();
	   $saveid=$this->session->userdata('id');
	   $data['type']   = (Object) $postData = array(
	       'stateid'  			=> $this->input->post('stateid'),
		   'countryid'  		=> $this->input->post('country'),
		   'statename'  		=> $this->input->post('state',true),
		   'status' 			=> 1,
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('stateid'))) {
		$this->permission->method('setting','create')->redirect();
	 $logData = array(
	   'action_page'         => "State List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New State Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->countrycity_model->createstate($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/country_city_list/statelist');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/country_city_list/statelist"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = array(
	   'action_page'         => "State List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "State Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );

		if ($this->countrycity_model->updatestate($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/country_city_list/statelist");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('edit_state');
		$data['intinfo']   = $this->countrycity_model->findByIdstate($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "statelist";   
	   echo Modules::run('template/layout', $data); 
	   }   
    }
    public function updatestatefrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('edit_state');
		$data['intinfo']   = $this->countrycity_model->findByIdstate($id);
		$data['country']   = $this->countrycity_model->allcountry();
        $data['module'] = "setting";  
        $data['page']   = "statedit";
		$this->load->view('setting/statedit', $data);   
      
	   }
 
    public function deletestate($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData =array(
	   'action_page'         => "country List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Country Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->countrycity_model->deletestate($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/country_city_list/statelist');
    }
	
	//City section
	 public function citylist($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('city_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/country_city_list/citylist');
        $config["total_rows"]  = $this->countrycity_model->countcitylist();
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
        $data["citilist"] = $this->countrycity_model->readcity($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('edit_state');
		$data['intinfo']   = $this->countrycity_model->findByIdcity($id);
	   }
	   $data['allstate']   = $this->countrycity_model->allstate();
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "citylist";   
        echo Modules::run('template/layout', $data); 
    }
    public function createcity($id = null)
    {
	  $data['title'] = display('add_city');
	  #-------------------------------#
		$this->form_validation->set_rules('city',display('city'),'required|max_length[50]');
		$this->form_validation->set_rules('state',display('state'),'required|max_length[50]');
		$data['allstate']   = $this->countrycity_model->allstate();
	   $saveid=$this->session->userdata('id');
	   $data['type']   = (Object) $postData = array(
	   	   'cityid'  			=> $this->input->post('cityid'),
	       'stateid'  			=> $this->input->post('state'),
		   'countryid'  		=> $this->input->post('country'),
		   'cityname'  		    => $this->input->post('city',true),
		   'status' 			=> 1,
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('cityid'))) {
		$this->permission->method('setting','create')->redirect();
		 $logData = array(
		   'action_page'         => "City List",
		   'action_done'     	 => "Insert Data", 
		   'remarks'             => "New City Created",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  );
		if ($this->countrycity_model->createcity($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/country_city_list/citylist');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/country_city_list/citylist"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		$postData2 = array(
	   	   'cityid'  			=> $this->input->post('cityid'),
	       'stateid'  			=> $this->input->post('state1'),
		   'countryid'  		=> $this->input->post('country1'),
		   'cityname'  		    => $this->input->post('city1',true),
		   'status' 			=> 1,
		  ); 
	  $logData = array(
	   'action_page'         => "City List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "City Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->countrycity_model->updatecity($postData2)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/country_city_list/citylist");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('edit_city');
		$data['intinfo']   = $this->countrycity_model->findByIdcity($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "citylist";   
	   echo Modules::run('template/layout', $data); 
	   }   
    }
    public function updatecityfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('edit_city');
		$data['intinfo']   = $this->countrycity_model->findByIdcity($id);
		$data['allstate']   = $this->countrycity_model->allstate();
        $data['module'] = "setting";  
        $data['page']   = "cityedit";
		$this->load->view('setting/cityedit', $data);   
 
	   }
 
    public function deletecity($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData =array(
	   'action_page'         => "City List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "City Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->countrycity_model->deletecity($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/country_city_list/citylist');
    }
 
}
