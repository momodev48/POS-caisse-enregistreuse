<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentmethod extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'payment_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('paymentmethod_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/paymentmethod/index');
        $config["total_rows"]  = $this->payment_model->countlist();
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
        $data["paymentlist"] = $this->payment_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "paymentlist";   
        echo Modules::run('template/layout', $data); 
    }
	
    public function create($id = null)
    {
	  $data['title'] = display('payment_add');
	  #-------------------------------#
		$this->form_validation->set_rules('payment',display('payment_name'),'required|max_length[50]');
		$this->form_validation->set_rules('status',display('status')  ,'required');
	   $saveid=$this->session->userdata('id');
	   $data['payments']   = (Object) $postData = [
		   'payment_method_id'   => $this->input->post('payment_method_id'),
		   'payment_method' 	 => $this->input->post('payment',true),
		   'is_active' 	 		 => $this->input->post('status',true),
		  ]; 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('payment_method_id'))) {
		
		$this->permission->method('setting','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Payment Method List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Payment Method Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->payment_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/paymentmethod/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/paymentmethod/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = [
	   'action_page'         => "Payment Method List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Payment Method Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];

		if ($this->payment_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/paymentmethod/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->findById($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "membershiplist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "paymentedit";
		$this->load->view('setting/paymentedit', $data);   
        
	   }
 
  
	
	/**************Paymentsetup******************/
	
	public function paymentsetup($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('paymentmethod_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/paymentmethod/paymentsetup');
        $config["total_rows"]  = $this->payment_model->countsetuplist();
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
        $data["psetuplist"] = $this->payment_model->setupread($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['paymentlist']   =  $this->payment_model->payment_dropdown();
		$data['currency_list'] = array(
		    'BDT' => '(BDT) Bangladeshi Taka', 
			'USD' => '(USD) U.S. Dollar', 
			'EUR' => '(EUR) Euro', 
			'AUD' => '(AUD) Australian Dollar',
			'CAD' => '(CAD) Canadian Dollar',
			'CZK' => '(CZK) Czech Koruna',
			'DKK' => '(DKK) Danish Krone',
			'HKD' => '(HKD) Hong Kong Dollar',
			'MXN' => '(MXN) Mexican Peso',
			'NOK' => '(NOK) Norwegian Krone',
			'NZD' => '(NZD) New Zealand Dollar',
			'PHP' => '(PHP) Philippine Peso',
			'PLN' => '(PLN) Polish Zloty',
			'BRL' => '(BRL) Brazilian Real',
			'HUF' => '(HUF) Hungarian Forint',
			'ILS' => '(ILS) Israeli New Sheqel',
			'JPY' => '(JPY) Japanese Yen',
			'MYR' => '(MYR) Malaysian Ringgit',
			'GBP' => '(GBP) Pound Sterling',
			'SGD' => '(SGD) Singapore Dollar',
			'NGN' => '(NGN) Nigerian Dollar',
			'XAF' => '(XAF) Cameroon',
			'SEK' => '(SEK) Swedish Krona',
			'CHF' => '(CHF) Swiss Franc',
			'TWD' => '(TWD) Taiwan New Dollar',
			'THB' => '(THB) Thai Baht',
		);
		if(!empty($id)) {
		$data['title'] = display('edit_setup');
		$data['intinfo']   = $this->payment_model->psetupById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "paymentsetup";   
        echo Modules::run('template/layout', $data); 
    }
	
	public function psetupcreate($id = null)
    {
	  $data['title'] = display('add_paymentsetup');
	  #-------------------------------#
	   $this->form_validation->set_rules('payment',display('payment_name'),'required|max_length[50]');
	   $this->form_validation->set_rules('status',display('status')  ,'required');
	   $saveid=$this->session->userdata('id');
	   $data['payments']   = (Object) $postData = [
		   'setupid'             => $this->input->post('setupid'),
		   'paymentid' 	         => $this->input->post('payment',true),
		   'marchantid' 	     => $this->input->post('marchantid',true),
		   'password' 	         => $this->input->post('password',true),
		   'email' 	             => $this->input->post('email',true),
		   'currency' 	         => $this->input->post('currency',true),
		   'Islive' 	         => $this->input->post('islive',true),
		   'status' 	 		 => $this->input->post('status',true),
		  ]; 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('setupid'))) {
		
		$this->permission->method('setting','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Payment Setup List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Payment Method Setup",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->payment_model->psetupcreate($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/paymentmethod/paymentsetup');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/paymentmethod/paymentsetup"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = [
	   'action_page'         => "Payment Setup List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Payment Method Setup Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];

		if ($this->payment_model->psetupupdate($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/paymentmethod/paymentsetup");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('edit_setup');
		$data['intinfo']   = $this->payment_model->psetupById($id);
	   }
	   $data['paymentlist']   =  $this->payment_model->payment_dropdown();
	   $data['currency_list'] = array(
	        'BDT' => '(BDT) Bangladeshi Taka', 
			'USD' => '(USD) U.S. Dollar', 
			'EUR' => '(EUR) Euro', 
			'AUD' => '(AUD) Australian Dollar',
			'CAD' => '(CAD) Canadian Dollar',
			'CZK' => '(CZK) Czech Koruna',
			'DKK' => '(DKK) Danish Krone',
			'HKD' => '(HKD) Hong Kong Dollar',
			'MXN' => '(MXN) Mexican Peso',
			'NOK' => '(NOK) Norwegian Krone',
			'NZD' => '(NZD) New Zealand Dollar',
			'PHP' => '(PHP) Philippine Peso',
			'PLN' => '(PLN) Polish Zloty',
			'BRL' => '(BRL) Brazilian Real',
			'HUF' => '(HUF) Hungarian Forint',
			'ILS' => '(ILS) Israeli New Sheqel',
			'JPY' => '(JPY) Japanese Yen',
			'MYR' => '(MYR) Malaysian Ringgit',
			'GBP' => '(GBP) Pound Sterling',
			'SGD' => '(SGD) Singapore Dollar',
			'SEK' => '(SEK) Swedish Krona',
			'CHF' => '(CHF) Swiss Franc',
			'TWD' => '(TWD) Taiwan New Dollar',
			'THB' => '(THB) Thai Baht',
		);
	   $data['module'] = "setting";
	   $data['page']   = "paymentsetup";   
	   echo Modules::run('template/layout', $data); 
	   }   
    }
   public function psetupupdateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('payment_edit');
		$data['intinfo']   = $this->payment_model->psetupById($id);
		$data['paymentlist']   =  $this->payment_model->payment_dropdown();
		 $data['currency_list'] = array(
		    'BDT' => '(BDT) Bangladeshi Taka', 
			'USD' => '(USD) U.S. Dollar', 
			'EUR' => '(EUR) Euro', 
			'AUD' => '(AUD) Australian Dollar',
			'CAD' => '(CAD) Canadian Dollar',
			'CZK' => '(CZK) Czech Koruna',
			'DKK' => '(DKK) Danish Krone',
			'HKD' => '(HKD) Hong Kong Dollar',
			'MXN' => '(MXN) Mexican Peso',
			'NOK' => '(NOK) Norwegian Krone',
			'NZD' => '(NZD) New Zealand Dollar',
			'PHP' => '(PHP) Philippine Peso',
			'PLN' => '(PLN) Polish Zloty',
			'BRL' => '(BRL) Brazilian Real',
			'HUF' => '(HUF) Hungarian Forint',
			'ILS' => '(ILS) Israeli New Sheqel',
			'JPY' => '(JPY) Japanese Yen',
			'MYR' => '(MYR) Malaysian Ringgit',
			'GBP' => '(GBP) Pound Sterling',
			'SGD' => '(SGD) Singapore Dollar',
			'SEK' => '(SEK) Swedish Krona',
			'CHF' => '(CHF) Swiss Franc',
			'TWD' => '(TWD) Taiwan New Dollar',
			'THB' => '(THB) Thai Baht',
		);
        $data['module'] = "setting";  
        $data['page']   = "paymentsetupedit";
		$this->load->view('setting/paymentsetupedit', $data);   
      
	   }
 
    public function setupdelete($id = null)
    {
  
    }
 
}
