<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customerlist extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
		    'supplier_model',
			'logs_model',
			'ordermanage/order_model'
		));
		$this->load->library('excel');	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('customer_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/customerlist/index');
        $config["total_rows"]  = $this->supplier_model->countcustomerlist();
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
        $data["customerlist"] = $this->supplier_model->customerlist($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "customerlist";   
        echo Modules::run('template/layout', $data); 
    }
	public function insert_customer(){
	  $this->form_validation->set_rules('customer_name', 'Customer Name'  ,'required|max_length[100]');
	  $this->form_validation->set_rules('email', display('email')  ,'required');
	  $this->form_validation->set_rules('mobile', display('mobile')  ,'required');
	  $this->form_validation->set_rules('password', display('password')  ,'required');
	  $savedid=$this->session->userdata('id');
	   
	  $coa = $this->order_model->headcode();
        if($coa->HeadCode!=NULL){
            $headcode=$coa->HeadCode+1;
        }
        else{
            $headcode="102030101";
        }
	    $lastid=$this->db->select("*")->from('customer_info')
			->order_by('cuntomer_no','desc')
			->get()
			->row();
		$sl=$lastid->cuntomer_no;
		if(empty($sl)){
		$sl = "cus-0001"; 
		}
		else{
		$sl = $sl;  
		}
		$supno=explode('-',$sl);
		$nextno=$supno[1]+1;
		$si_length = strlen((int)$nextno); 
		
		$str = '0000';
		$cutstr = substr($str, $si_length); 
		$sino = $supno[0]."-".$cutstr.$nextno; 
		
	  
	  if ($this->form_validation->run()) { 
		$this->permission->method('setting','create')->redirect();
		$scan = scandir('application/modules/');
		$pointsys="";
		foreach($scan as $file) {
		   if($file=="loyalty"){
			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
			   $pointsys=1;
			   }
			   }
		} 
		$data['customer']   = (Object) $postData = array(
	   'cuntomer_no'     	=> $sino,
	   'membership_type'	=> $pointsys,
	   'customer_name'     	=> $this->input->post('customer_name',true),  
	   'customer_email'     =>$this->input->post('email',true),
	   'customer_phone'     => $this->input->post('mobile',true),
	   'password'     		=> md5($this->input->post('password')),
	   'customer_address'   => $this->input->post('address',true),
	   'favorite_delivery_address'     =>$this->input->post('favaddress',true), 
	   'is_active'        => 1,
	  );
	 $logData =array(
	   'action_page'         => "Add Customer",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "Customer is Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	   $c_name = $this->input->post('customer_name',true);
       $c_acc=$sino.'-'.$c_name;
		$createdate=date('Y-m-d H:i:s');
	    $data['aco']  = (Object) $postData1 = array(
             'HeadCode'         => $headcode,
             'HeadName'         => $c_acc,
             'PHeadName'        => 'Customer Receivable',
             'HeadLevel'        => '4',
             'IsActive'         => '1',
             'IsTransaction'    => '1',
             'IsGL'             => '0',
             'HeadType'         => 'A',
             'IsBudget'         => '0',
             'IsDepreciation'   => '0',
             'DepreciationRate' => '0',
             'CreateBy'         => $savedid,
             'CreateDate'       => $createdate,
        );
		$this->order_model->create_coa($postData1);
		if($totalnum>0){
			$this->session->set_flashdata('exception',  display('memberid_exist'));
		}
		else{
		if ($this->order_model->insert_customer($postData)) {
			$customerid=$this->db->select("*")->from('customer_info')->where('cuntomer_no',$sino)->get()->row(); 
		 if(!empty($pointsys)){
					  $pointstable = array(
					   'customerid'   => $customerid->customer_id,
					   'amount'       => 0,
					   'points'       => 10
					  );
					  $this->order_model->insert_data('tbl_customerpoint', $pointstable);
				  }
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/customerlist/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		}
		redirect("setting/customerlist/index"); 
	  } else {
		  redirect("setting/customerlist/index"); 
		  }   
 
    }
	public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('update_member');
		$data['intinfo']   = $this->supplier_model->findByIdmember($id);

        $data['module'] = "setting";  
        $data['page']   = "customeredit";
		$this->load->view('setting/customeredit', $data);   
    
	   }
   public function customerupdate(){
	   $this->form_validation->set_rules('customer_name', 'Customer Name'  ,'required|max_length[100]');
	  $this->form_validation->set_rules('mobile', display('mobile')  ,'required');
	  $savedid=$this->session->userdata('id');
	  if ($this->form_validation->run()) { 
	  $this->permission->method('setting','update')->redirect();
	  $sino=$this->input->post('memcode');
	  $c_name = $this->input->post('customer_name',true);
      $c_acc=$sino.'-'.$c_name;
	  if(empty($this->input->post('password'))){
		  $password=$this->input->post('oldpassword');
		  }
	  else{
		  $password=md5($this->input->post('password'));
		  }
	  $data['customer']   = (Object) $postData = array(
	   'customer_id'     	=> $this->input->post('custid'),
	   'customer_name'     	=> $this->input->post('customer_name',true),  
	   'customer_phone'     => $this->input->post('mobile',true),
	   'membership_type'	=> $this->input->post('isvip'),
	   'password'     		=> $password,
	   'customer_address'   => $this->input->post('address',true),
	   'is_active'     => $this->input->post('status'),
	   
	  );
	  $logData = array(
	   'action_page'         => "Customer List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Customer Updated",
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
	  	if ($this->supplier_model->updatemem($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $scan = scandir('application/modules/');
		$pointsys="";
		foreach($scan as $file) {
		   if($file=="loyalty"){
			   if (file_exists(APPPATH.'modules/'.$file.'/assets/data/env')){
			   $pointsys=1;
			   }
			   }
		} 
		if($pointsys==1){
			$customerinfo=$this->db->select("*")->from('tbl_customerpoint')->where('customerid',$this->input->post('custid'))->get()->row(); 
			if(empty($customerinfo)){
			$pointstable = array(
					   'customerid'   => $this->input->post('custid'),
					   'amount'       => 0,
					   'points'       => 10
					  );
					  $this->order_model->insert_data('tbl_customerpoint', $pointstable);
			}
		}
		 $this->session->set_flashdata('message', display('update_successfully'));
		} 
		else {$this->session->set_flashdata('exception',  display('please_try_again'));}
		redirect("setting/customerlist/index");
	  }
	  else{
		  $this->session->set_flashdata('exception',  display('please_try_again'));
		  redirect("setting/customerlist/index");
		  }
	   }
	  
	 function importmembercsv() {
         
                  if(isset($_FILES["userfile"]["name"]))
        {
           $_FILES["userfile"]["name"];
            $path = $_FILES["userfile"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
           
            foreach($object->getWorksheetIterator() as $sale)
            {
                
                $highestRow = $sale->getHighestRow();
                $highestColumn = $sale->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++)
                {
                $memberid = $sale->getCellByColumnAndRow(0, $row)->getValue();  
                $membername = $sale->getCellByColumnAndRow(1, $row)->getValue();
                $mobile = $sale->getCellByColumnAndRow(2, $row)->getValue();
                $cstatus = $sale->getCellByColumnAndRow(3, $row)->getValue();
                if($cstatus=="Active"){$status=1;}
                else{$status=0;}
               
               $coa = $this->order_model->headcode();
                if($coa->HeadCode!=NULL){
                    $headcode=$coa->HeadCode+1;
                }
                else{
                    $headcode="102030101";
                }
        	    $lastid=$this->db->select("*")->from('customer_info')->order_by('cuntomer_no','desc')->get()->row();
        		$sl=$lastid->cuntomer_no;
        		if(empty($sl)){
        		$sl = "cus-0001"; 
        		}
        		else{
        		$sl = $sl;  
        		}
        		$supno=explode('-',$sl);
        		$nextno=$supno[1]+1;
        		$si_length = strlen((int)$nextno); 
        		
        		$str = '0000';
        		$cutstr = substr($str, $si_length); 
        		$sino = $supno[0]."-".$cutstr.$nextno; 
        		$newmemberid=(int)$memberid;
        	    $totalnum=$this->db->select("*")->from('customer_info')->where('memberid',$newmemberid)->get()->num_rows();
        	    
        	    $this->permission->method('setting','create')->redirect();
        		$data['customer']   = (Object) $postData = array(
        		'memberid'     	=> (int)$memberid,
        	    'cuntomer_no'     	=> $sino,
        	    'customer_name'     	=> $membername,  
        	    'customer_phone'     => $mobile,
        	    'is_active'        => $status,
        	  );
        	
        	 $logData =array(
        	   'action_page'         => "Add Customer",
        	   'action_done'     	 => "Insert Data", 
        	   'remarks'             => "Customer is Created",
        	   'user_name'           => $this->session->userdata('fullname'),
        	   'entry_date'          => date('Y-m-d H:i:s'),
        	  );
        	  
        	   $c_name = $membername;
               $c_acc=$sino.'-'.$c_name;
        		$createdate=date('Y-m-d H:i:s');
        	    $data['aco']  = (Object) $postData1 = array(
                     'HeadCode'         => $headcode,
                     'HeadName'         => $c_acc,
                     'PHeadName'        => 'Customer Receivable',
                     'HeadLevel'        => '4',
                     'IsActive'         => '1',
                     'IsTransaction'    => '1',
                     'IsGL'             => '0',
                     'HeadType'         => 'A',
                     'IsBudget'         => '0',
                     'IsDepreciation'   => '0',
                     'DepreciationRate' => '0',
                     'CreateBy'         => $this->session->userdata('fullname'),
                     'CreateDate'       => $createdate,
                );
        		$this->order_model->create_coa($postData1);
        		if($totalnum>0){
        			$this->session->set_flashdata('exception',  display('memberid_exist'));
        		}
        		else{
        		if ($this->order_model->insert_customer($postData)) { 
        		 $this->logs_model->log_recorded($logData);
        		 $this->session->set_flashdata('message', display('save_successfully'));
        		} else {
        		 $this->session->set_flashdata('exception',  display('please_try_again'));
        		}
        		}
                }
            }
            $this->session->set_flashdata('message', display('save_successfully'));
            echo '<script>window.location.href = "'.base_url().'setting/customerlist/index"</script>';
        }
    }
	
	public function exportcsv(){
		$path="D:/xampp/htdocs/bhojonv2.4/Members.xlsx";
		$new="D:/xampp/htdocs/bhojonv2.4/Members3.xlsx";
		$getnew=$this->db->select("*")->from('customer_info')->limit(5)->get()->result();
		$objPHPExcel = PHPExcel_IOFactory::load($path);
		$objPHPExcel->setActiveSheetIndex(0);
		$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;

		$rowData = array( 
			array( "70055", "Ainal Hassan", "0171246275467", "Inactive") 
		); //fromArray allow you multi-row append
		$objPHPExcel->getActiveSheet()->fromArray($rowData, null, 'A'.$row);
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save($path);
		}
 
}
