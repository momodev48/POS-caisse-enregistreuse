<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplierlist extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'supplier_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('purchase','read')->redirect();
        $data['title']    = display('supplier_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('purchase/supplierlist/index');
        $config["total_rows"]  = $this->supplier_model->countlist();
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
        $data["supplierlist"] = $this->supplier_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		if(!empty($id)) {
		$data['title'] = display('supplier_edit');
		$data['intinfo']   = $this->supplier_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "purchase";
        $data['page']   = "supplierlist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('supplier_add');
	    $coa = $this->supplier_model->headcode();
        if($coa->HeadCode!=NULL){
            $headcode=$coa->HeadCode+1;
        }
        else{
            $headcode="502020501";
        }
	   $lastid=$this->db->select("*")->from('supplier')
			->order_by('suplier_code','desc')
			->get()
			->row();
		$sl=$lastid->suplier_code;
		if(empty($sl)){
		$sl = "sup_001"; 
		}
		else{
		$sl = $sl;  
		}
		$supno=explode('_',$sl);
		$nextno=$supno[1]+1;
		$si_length = strlen((int)$nextno); 
		
		$str = '000';
		$cutstr = substr($str, $si_length); 
		$sino = $supno[0]."_".$cutstr.$nextno;
		if(!empty($this->input->post('supid'))) {
			$sino=$this->input->post('supcode');
			}
	  #-------------------------------#
		$this->form_validation->set_rules('suppliername',display('supplier_name'),'required|max_length[50]');
		$this->form_validation->set_rules('mobile',display('mobile')  ,'required');
	   $saveid=$this->session->userdata('id');
	   
       $c_name = $this->input->post('suppliername',true);
       $c_acc=$sino.'-'.$c_name;
		
	   $data['supplier']   = (Object) $postData = array(
		   'supid'  			 => $this->input->post('supid'),
		   'suplier_code'  		 => $sino,
		   'supName' 			 => $this->input->post('suppliername',true),
		   'supEmail' 	         => $this->input->post('email',true),
		   'supMobile' 	 	     => $this->input->post('mobile',true),
		   'supAddress' 	     => $this->input->post('address',true),
		  ); 
	    $data['aco']   = (Object) $postDatacoa = array(
            'HeadCode'         => $headcode,
            'HeadName'         => $c_acc,
            'PHeadName'        => 'Suppliers',
            'HeadLevel'        => '4',
            'IsActive'         => '1',
            'IsTransaction'    => '1',
            'IsGL'             => '0',
            'HeadType'         => 'L',
            'IsBudget'         => '0',
            'IsDepreciation'   => '0',
            'DepreciationRate' => '0',
            'CreateBy'         => $saveid,
            'CreateDate'       => date('Y-m-d H:i:s'),
        );
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('supid'))) {
		$this->permission->method('purchase','create')->redirect();
		
	 $logData = array(
	   'action_page'         => "Supplier List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Supplier Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	     $this->supplier_model->create_coa($postDatacoa);
		if ($this->supplier_model->create($postData)) { 
		$supplier_id = $this->db->insert_id();
		 $this->logs_model->log_recorded($logData);
		 $this->supplier_model->previous_balance_add($this->input->post('previous_balance'), $supplier_id,$c_acc,$c_name,$sino);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('purchase/supplierlist/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("purchase/supplierlist/index"); 
	
	   } else {
		$this->permission->method('purchase','update')->redirect();
		
	  $logData = array(
	   'action_page'         => "Supplier List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Supplier Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	  $c_accup = $this->input->post('oldname');
	  $getheadid=$this->db->select("HeadCode")->from('acc_coa')
	  		->where('HeadName',$c_accup)
			->get()
			->row();
	  if(!empty($getheadid)){
		  $upheadcode=$getheadid->HeadCode;
		  $acc=array(
		   'HeadName'         => $c_acc,
		   'UpdateBy'         => $saveid,
		   'UpdateDate'       => date('Y-m-d H:i:s')
		  );
		    $this->db->where('HeadCode',$upheadcode);
	        $this->db->update('acc_coa',$acc);

		  }

		if ($this->supplier_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("purchase/supplierlist/index");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('supplier_edit');
		$data['intinfo']   = $this->supplier_model->findById($id);
	   }
	   
	   $data['module'] = "purchase";
	   $data['page']   = "supplierlist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('purchase','update')->redirect();
		$data['title'] = display('supplier_edit');
		$data['intinfo']   = $this->supplier_model->findById($id);
        $data['module'] = "purchase";  
        $data['page']   = "supplieredit";
		$this->load->view('purchase/supplieredit', $data);   
    
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('purchase','delete')->redirect();
		$logData = array(
	   'action_page'         => "Supplier List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Supplier Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->supplier_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('purchase/supplierlist/index');
    }
	public function supplier_ledger_report() {
		$this->permission->method('purchase','read')->redirect();
		$data['title'] = display('supplier_ledger');
		$supplierid='';
		$fromdate='';
		$todate='';
        $config["base_url"] = base_url('purchase/supplierlist/supplier_ledger_report/');
        $config["total_rows"] = $this->supplier_model->count_supplier_product_info();
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config["num_links"] = 5;
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
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
		$data["links"] = $this->pagination->create_links();
		$supplierid=$this->input->post('supplier_id',true);
		$fromdate=$this->input->post('from_date',true);
		$todate=$this->input->post('to_date',true);
		$data['supplierlist']=$this->supplier_model->supplierlist();
		if(!empty($supplierid)){
		$data['Supplierinfo']=$this->db->select("*")->from('supplier')->where('supid',$supplierid)->get()->row();
		}
		else{
			$data['Supplierinfo']='';
			}
		$data["supplierledger"] = $this->supplier_model->supplier_ledger_report($supplierid,$fromdate,$todate,$config["per_page"], $page);
		$seting=$this->db->select("*")->from('setting')->get()->row();
		$currencyinfo=$this->db->select("*")->from('currency')->where('currencyid',$seting->currency)->get()->row();
		$data['currency']=$currencyinfo->curr_icon;
		$data['position']=$currencyinfo->position;
		 $data['module'] = "purchase";
        $data['page']   = "supplier_ledger";   
        echo Modules::run('template/layout', $data); 
    }
	public function supplier_due_paid_report($supplierid) {
		$this->permission->method('purchase','read')->redirect();
		$data['title'] = display('supplier_ledger');
		$data['Supplierinfo']=$this->db->select("*")->from('supplier')->where('supid',$supplierid)->get()->row();
		$data["supplierledger"] = $this->supplier_model->supplier_duepaid_report($supplierid);
		$seting=$this->db->select("*")->from('setting')->get()->row();
		$currencyinfo=$this->db->select("*")->from('currency')->where('currencyid',$seting->currency)->get()->row();
		$data['currency']=$currencyinfo->curr_icon;
		$data['position']=$currencyinfo->position;
		 $data['module'] = "purchase";
        $data['page']   = "supplier_duepaid";   
        echo Modules::run('template/layout', $data); 
    }
 
}
