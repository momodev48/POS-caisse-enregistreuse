<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_addons extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'addons_model',
			'logs_model'
		));	
    }
 
    public function index()
    {
        
		$this->permission->method('itemmanage','read')->redirect();
        $data['title']    = display('addons_list'); 
              
        #
        #pagination starts
        #
        $config["base_url"] = base_url('itemmanage/menu_addons/index');
        $config["total_rows"]  = $this->addons_model->count_addons();
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
        $data["addonslist"] = $this->addons_model->read_addons($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
		$settinginfo=$this->addons_model->settinginfo();
		$data['currency']=$this->addons_model->currencysetting($settinginfo->currency);

        #
        #pagination ends
        #   
        $data['module'] = "itemmanage";
        $data['page']   = "addonslist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('add_adons');
	 
	  $this->form_validation->set_rules('addonsname', display('addonsname')  ,'required|max_length[100]');
	  $this->form_validation->set_rules('addonsprice', display('price')  ,'required');
	  $this->form_validation->set_rules('status', display('status')  ,'required');
	  
	   
	   $savedid=$this->session->userdata('id');
	   $data['addons']   = (Object) $postData = [
	   'add_on_id'     => $this->input->post('add_on_id',true),
	   'add_on_name'     	=> $this->input->post('addonsname',true), 
	   'price'           =>$this->input->post('addonsprice',true),
	   'is_active'   => $this->input->post('status',true),
	  ];
	   $taxsettings = $this->taxchecking();
		if(!empty($taxsettings)){
			$tx=0;
			$taxitems= array();
			foreach ($taxsettings as $taxitem) {
				$filedtax = 'tax'.$tx;
					$taxitems[$filedtax] = $this->input->post($filedtax,true);
				$tx++;
			}
			$postData = array_merge($postData,$taxitems);
		}
	 
	  if ($this->form_validation->run()) { 
	   if (empty($this->input->post('add_on_id'))) {
		$this->permission->method('itemmanage','create')->redirect();
	   $logData = [
	   'action_page'         => "Add Add-ons",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Add-ons is Created",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->addons_model->addons_create($postData)) { 
		$this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('itemmanage/menu_addons/create');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/menu_addons/create"); 
	
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
		if(empty($img)){
			$img=$this->input->post('old_image');
			}
	   $logData = [
	   'action_page'         => "Add-ons List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Add-ons Updated",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
	
		if ($this->addons_model->update_addons($postData)) { 
		$this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/menu_addons/create/".$postData['add_on_id']);  
	   }
	  } else { 
	  $data['taxitems'] = $this->taxchecking();
	   if(!empty($id)) {
		$data['title'] = display('update_adons');
		$data['addonsinfo']   = $this->addons_model->findById($id);
	   }
	   $data['module'] = "itemmanage";
	   $data['page']   = "addonscreate";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
 
 
    public function delete($addons = null)
    {
        $this->permission->module('itemmanage','delete')->redirect();
		$logData = [
	   'action_page'         => "Add-ons List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Add-ons Deleted",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->addons_model->addons_delete($addons)) {
			$this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('itemmanage/menu_addons/create');
    }
	private function taxchecking()
    {
    	$taxinfos = '';
    	if ($this->db->table_exists('tbl_tax')) {
    		$taxsetting = $this->db->select('*')->from('tbl_tax')->get()->row();
    	}
    	if($taxsetting->tax == 1){
    	$taxinfos = $this->db->select('*')->from('tax_settings')->get()->result_array();
    		}
    		
          return $taxinfos;

    }
	//Assign Add-ons Part
	public function assignaddons($id = null)
    {
        
		$this->permission->method('itemmanage','read')->redirect();
        $data['title']    = display('assign_adons_list'); 
              
        #
        #pagination starts
        #
        $config["base_url"] = base_url('itemmanage/menu_addons/assignaddons');
        $config["total_rows"]  = $this->addons_model->count_menuaddons();
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
        $data["addonsmenulist"] = $this->addons_model->read_menuaddons($config["per_page"], $page);
		$data["addonsmenulist2"] = $this->addons_model->read_menuaddons($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
		if(!empty($id)) {
		$data['title'] = display('update_adons');
		$data['addonsinfo']   = $this->addons_model->findById($id);
	   }
	    $data['menudropdown']   =  $this->addons_model->menu_dropdown();
		$data['addonsdropdown']   =  $this->addons_model->addons_dropdown();
        #
        #pagination ends
        #   
        $data['module'] = "itemmanage";
        $data['page']   = "assignaddons";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function assignaddonscreate($id = null)
    {
	  $data['title'] = display('assign_adons');
	 
	  $this->form_validation->set_rules('addonsid', display('addonsname')  ,'required');
	  $this->form_validation->set_rules('menuid', display('item_name')  ,'required');
	  
	   
	   $savedid=$this->session->userdata('id');
	   $data['addons']   = (Object) $postData = [
	   'row_id'     => $this->input->post('row_id',true),
	   'add_on_id'     => $this->input->post('addonsid',true),
	   'menu_id'     	=> $this->input->post('menuid',true), 
	   'is_active'   => 1,
	  ];
	   
	 
	  if ($this->form_validation->run()) { 
	   if (empty($this->input->post('row_id'))) {
		$this->permission->method('itemmanage','create')->redirect();
	   $logData = [
	   'action_page'         => "Add-ons Assign",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "Assign New Add-ons To Menu",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->addons_model->menuaddons_create($postData)) { 
		$this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('itemmanage/menu_addons/assignaddons');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/menu_addons/assignaddons"); 
	
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
		if(empty($img)){
			$img=$this->input->post('old_image');
			}
	   $logData = [
	   'action_page'         => "Add-ons Assign List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Add-ons Assign List Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];

		if ($this->addons_model->update_menuaddons($postData)) { 
		
		$this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/menu_addons/assignaddons");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('update_adons');
		$data['addonsinfo']   = $this->addons_model->findById($id);
	   }
	   $data['module'] = "itemmanage";
	   $data['page']   = "assignaddons";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
 public function assignaddonsupdateinfo($id){
	  
		$this->permission->method('itemmanage','update')->redirect();
		$data['title'] = display('assign_adons_list');
		$data['addonsinfo']   = $this->addons_model->findBymenuaddons($id);
		$data['menudropdown']   =  $this->addons_model->menu_dropdown();
		$data['addonsdropdown']   =  $this->addons_model->addons_dropdown();
        $data['module'] = "itemmanage";  
        $data['page']   = "assignaddonsedit";
		$this->load->view('itemmanage/assignaddonsedit', $data);   
    
	   }
 
    public function assignaddonsdelete($addons = null)
    {
        $this->permission->module('itemmanage','delete')->redirect();
		$logData = [
	   'action_page'         => "Add-ons List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Add-ons Assign Menu Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->addons_model->menuaddons_delete($addons)) {
			$this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('itemmanage/menu_addons/assignaddons');
    }
 
}
