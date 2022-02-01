<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cexpense extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->model('Expense_model');
    }

     public function add_expense(){
		$this->permission->module('hrm','read')->redirect();
		$data['title']  = display('add_expense');
		$data['expense_item'] = $this->Expense_model->expense_item_list();
		$data['bank_list']    = $this->Expense_model->bank_list();
		$data['module']   = "hrm";
		$data['page']     = "expense/expense_form";   
		echo Modules::run('template/layout', $data);
		}

     public function create_expense(){
  
    $this->form_validation->set_rules('amount', display('amount')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->Expense_model->expense_insert()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('hrm/Cexpense/add_expense/');
        }else{
          $this->session->set_flashdata('error_message',  display('please_try_again'));
        }
        redirect("hrm/Cexpense/add_expense");
    }else{
      $this->session->set_flashdata('error_message',  display('please_try_again'));
      redirect("hrm/Cexpense/add_expense");
     }

}

      public function manage_expense(){
        $data['title']  = display('manage_expense');
        $config["base_url"] = base_url('hrm/Cexpense/manage_expense');
        $config["total_rows"]  = $this->db->count_all('expense');
        $config["per_page"]    = 20;
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
        $data["links"] = $this->pagination->create_links();
        $data['expense_list']= $this->Expense_model->expense_list($config["per_page"], $page);
		$data['module']   = "hrm";
		$data['page']     = "expense/manage_expense";   
		echo Modules::run('template/layout', $data);
    }

            public function delete_expense($id = null) 
    { 

        if ($this->Expense_model->expense_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect("hrm/Cexpense/manage_expense");
    }
    // add expense expense item
     public function add_expense_item(){
	$this->permission->module('hrm','read')->redirect();
    $data['title']  = display('add_expense_item');
	$data['module']   = "hrm";
	$data['page']     = "expense/expense_item_form";   
	echo Modules::run('template/layout', $data);
    }

    //expense item add
         public function create_expense_item(){
		$this->permission->module('hrm','create')->redirect();
           $this->form_validation->set_rules('expense_item_name', display('expense_item_name')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->Expense_model->expense_item_insert()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('hrm/Cexpense/manage_expense_item/');
        }else{
          $this->session->set_flashdata('error_message',  display('please_try_again'));
        }
        redirect("hrm/Cexpense/manage_expense_item");
    }else{
      $this->session->set_flashdata('error_message',  display('please_try_again'));
      redirect("hrm/Cexpense/manage_expense_item");
     }

}
/// Manage Expense Item
      public function manage_expense_item(){
      	$this->permission->module('hrm','read')->redirect();
		$data['title']  = display('manage_expense_item');
        $data['expense_item_list']= $this->Expense_model->expense_item_list();
		$data['module']   = "hrm";
	    $data['page']     = "expense/manage_expense_item";   
	    echo Modules::run('template/layout', $data);
    }
// expense item delete
     public function delete_expense_item($id = null) 
    { 
        if ($this->Expense_model->expense_item_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('exception',display('please_try_again'));
        }
        redirect("hrm/Cexpense/manage_expense_item");
    }
    // expense statement form
     public function expense_statement_form(){
      $expense_item  = $this->Expense_model->expense_item_list();
        $data = array(
            'item_list' => $expense_item,
        );
        $data['title']  = display('expense_statement');
		$data['module']   = "hrm";
	    $data['page']     = "expense/expense_statement_form";   
	    echo Modules::run('template/layout', $data);
}

// Expense statement
 public function expense_statement(){
    $this->load->model('Expense_model');
    $expense_id  = $this->input->get('expense_id');
    $from_date   = $this->input->get('from_date');
    $to_date     = $this->input->get('to_date');
	
	$startdate= date('Y-m-d' , strtotime($from_date));
	$enddate= date('Y-m-d' , strtotime($to_date));

   $customer_statement = $this->Expense_model->get_expense_statement($expense_id,$startdate,$enddate);
     $expense_item  = $this->Expense_model->expense_item_list();
        $data = array(
            'item_list'          => $expense_item,
            'expense_statement'  => $customer_statement,
            'from_date'          => $startdate,
            'to_date'            => $enddate,
            'expense_id'         => $expense_id,
        );
        $data['title']  = display('expense_statement');
		$data['module']   = "hrm";
	    $data['page']     = "expense/expense_statement";   
	    echo Modules::run('template/layout', $data);
}
}
