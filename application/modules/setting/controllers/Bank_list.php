<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_list extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'banklist_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('bank_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/bank_list/index');
        $config["total_rows"]  = $this->banklist_model->countlist();
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
        $data["typelist"] = $this->banklist_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('update_bank');
		$data['intinfo']   = $this->banklist_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "banklist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('add_bank');
	  #-------------------------------#
		$this->form_validation->set_rules('bank_name',display('bank_name'),'required|max_length[50]');
	   $saveid=$this->session->userdata('id');
	   $this->load->library('fileupload');
	   $img =  $this->fileupload->do_upload('./application/modules/hrm/assets/images/', 'signature_pic');
	   
		if(!empty($this->input->post('bankid'))) {
			$getpic=(!empty($img)?$img:$this->input->post('signature_picold'));
			}
		else{
			$getpic=$img;
			}
	   $data['type']   = (Object) $postData = array(
		   'bankid'  		=> $this->input->post('bankid'),
		   'bank_name' 			=> $this->input->post('bank_name',true),
		   'ac_name' 			=> $this->input->post('ac_name',true),
		   'ac_number' 			=> $this->input->post('ac_no',true),
		   'branch' 			=> $this->input->post('branch',true),
		   'signature_pic' 	    => $getpic,
		  ); 
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('bankid'))) {
		$this->permission->method('setting','create')->redirect();
		 $logData =array(
		   'action_page'         => "Bank List",
		   'action_done'     	 => "Insert Data", 
		   'remarks'             => "New Bank Created",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  );
		if ($this->banklist_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $coa = $this->banklist_model->headcode();
           if($coa->HeadCode!=NULL){
                $headcode=$coa->HeadCode+1;
           }else{
                $headcode="102010201";
            }

        $createby=$this->session->userdata('id');
        $createdate=date('Y-m-d H:i:s');
		 $bank_coa = array(
             'HeadCode'         => $headcode,
             'HeadName'         => $this->input->post('bank_name'),
             'PHeadName'        => 'Cash At Bank',
             'HeadLevel'        => '4',
             'IsActive'         => '1',
             'IsTransaction'    => '1',
             'IsGL'             => '0',
             'HeadType'         => 'A',
             'IsBudget'         => '0',
             'IsDepreciation'   => '0',
             'DepreciationRate' => '0',
             'CreateBy'         => $createby,
             'CreateDate'       => $createdate,
        );
		$this->db->insert('acc_coa',$bank_coa);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/bank_list/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/bank_list/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = array(
	   'action_page'         => "Bank List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Bank Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );

		if ($this->banklist_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/bank_list/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('update_bank');
		$data['intinfo']   = $this->banklist_model->findById($id);
	   }
	   
	   $data['module'] = "setting";
	   $data['page']   = "banklist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('update_bank');
		$data['intinfo']   = $this->banklist_model->findById($id);
        $data['module'] = "setting";  
        $data['page']   = "bankedit";
		$this->load->view('setting/bankedit', $data);   
      
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = array(
	   'action_page'         => "Bank List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Bank Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->banklist_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/bank_list/index');
    }
	 public function bank_transaction() {
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('bank_transaction'); 
        $data['bank_list'] = $this->banklist_model->get_bank_list();
	    $data['module'] = "setting";
	    $data['page']   = "bank_debit_credit_manage";   
	    echo Modules::run('template/layout', $data); 
    }
	public function bank_debit_credit_manage_add() {
		$this->permission->method('setting','create')->redirect();
        if ($this->input->post('account_type') == "Debit(+)") {
            $dr = $this->input->post('ammount');
        } else {
            $cr = $this->input->post('ammount');
        }
         $receive_by=$this->session->userdata('id');
        $receive_date=date('Y-m-d');
        $bankname = $this->db->select('bank_name')->from('tbl_bank')->where('bankid',$this->input->post('bank_id'))->get()->row();
		$coaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname->bank_name)->get()->row()->HeadCode;
        $data = array(
            'date' => $this->input->post('date'),
            'ac_type' => $this->input->post('account_type'),
            'bank_id' => $this->input->post('bank_id'),
            'description' => $this->input->post('description'),
            'deposite_id' => $this->input->post('withdraw_deposite_id'),
            'dr' => (!empty($dr) ? $dr : null),
            'cr' => (!empty($cr) ? $cr : null),
            'ammount' => $this->input->post('ammount'),
            'status' => 1
        );
		$this->db->insert('bank_summary', $data);
        $coabanktransaction = array(
          'VNo'            =>  $this->input->post('withdraw_deposite_id'),
          'Vtype'          =>  'Bank Transaction',
          'VDate'          =>  $this->input->post('date'),
          'COAID'          =>  $coaid,
          'Narration'      =>  'Deposit No.'.$this->input->post('withdraw_deposite_id'),
          'Debit'          =>  (!empty($dr) ? $dr : 0),
          'Credit'         =>  (!empty($cr) ? $cr : 0),
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  date('Y-m-d H:i:s'),
          'IsAppove'       =>  1
        ); 
        $this->db->insert('acc_transaction',$coabanktransaction);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        redirect(base_url('setting/bank_list'));
        exit;
    }
	public function bank_ledger($bank_id) {
       $this->permission->method('setting','read')->redirect();
        $data['title']    = display('bank_ledger'); 
        $data['bank_list'] = $this->banklist_model->get_bank_ledger($bank_id);
		$data['intinfo']   = $this->banklist_model->findById($bank_id);
		$settinginfo=$this->banklist_model->settinginfo();
		$data['currency']=$this->banklist_model->currencysetting($settinginfo->currency);
	    $data['module'] = "setting";
	    $data['page']   = "bank_ledger";   
	    echo Modules::run('template/layout', $data); 
    }
 
}
