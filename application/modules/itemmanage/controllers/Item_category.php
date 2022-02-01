<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_category extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'category_model',
			'logs_model'
		));	
    }
 
    public function index()
    {
        
		$this->permission->method('itemmanage','read')->redirect();
        $data['title']    = display('category_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('itemmanage/item_category/index');
        $config["total_rows"]  = $this->category_model->count_category();
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
        $data["categories"] = $this->category_model->read_category($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
        #
        #pagination ends
        #   
        $data['module'] = "itemmanage";
        $data['page']   = "home";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('add_category');
	  #-------------------------------#
	  
	  if(!empty($this->input->post('CategoryID'))) {
	  $this->form_validation->set_rules('categoryname', display('category_name')  ,'required|max_length[100]');
	  }
	  else{
		   $this->form_validation->set_rules('categoryname', display('category_name')  ,'required|is_unique[item_category.Name]|max_length[100]');
		   $this->form_validation->set_message('is_unique', 'Sorry, this %s already used!');
		  }
	  $this->form_validation->set_rules('status', display('status')  ,'required');
	  $this->load->library('fileupload');
	  $img = $this->fileupload->do_upload(
		'./application/modules/itemmanage/assets/images/','picture'
	
	   );
	   
	   $savedid=$this->session->userdata('id');
	   $offerstartdate = str_replace('/','-',$this->input->post('offerstartdate',true));
	   $offerendate = str_replace('/','-',$this->input->post('offerendate',true));
	  
	   $isoffer = $this->input->post('isoffer');
	   if($isoffer==1){
		   $this->form_validation->set_rules('offerstartdate', display('offerdate')  ,'required');
		   $this->form_validation->set_rules('offerendate', display('offerenddate')  ,'required');
		    $convertstartdate= date('Y-m-d' , strtotime($offerstartdate));
			$convertenddate= date('Y-m-d' , strtotime($offerendate));
			$isoffer=$isoffer;
		   }
		else{
			 $convertstartdate= "0000-00-00";
			 $convertenddate= "0000-00-00";
			 $isoffer=0;
			}
	   
	  #-------------------------------#
	   
	
	  $data['categoryinfo']="";
	  if ($this->form_validation->run()) { 
	   if (empty($this->input->post('CategoryID'))) {
		$this->permission->method('itemmanage','create')->redirect();
		$data['category']   = (Object) $postData = array(
	   'CategoryID'     => $this->input->post('CategoryID',true),
	   'Name'     	=> $this->input->post('categoryname',true), 
	   'parentid'           =>$this->input->post('Parentcategory',true),
	   'CategoryIsActive'   => $this->input->post('status',true),
	   'isoffer'     		=> $isoffer, 
	   'offerstartdate'     => $convertstartdate, 
	   'offerendate'        => $convertenddate,
	   'CategoryImage'      => $img,
	   'UserIDInserted'     => $savedid,
	   'UserIDUpdated'      => $savedid,
	   'UserIDLocked'       => $savedid,
	   'DateInserted'       => date('Y-m-d H:i:s'),
	   'DateUpdated'        => date('Y-m-d H:i:s'),
	   'DateLocked'         => date('Y-m-d H:i:s'),
	  );
	 $logData = array(
	   'action_page'         => "Add Category",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "Category is Created",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->category_model->cat_create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->db->select('*');
			$this->db->from('item_category');
			$this->db->where('CategoryIsActive',1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label'=>$row->Name,'value'=>$row->CategoryID);
			}
			$cache_file = './assets/js/category.json';
			$categoryList = json_encode($json_product);
			file_put_contents($cache_file,$categoryList);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('itemmanage/item_category/create');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_category/create"); 
	
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
		if(empty($img)){
			$img=$this->input->post('old_image');
			}
		$data['category']   = (Object) $postData = array(
	   'CategoryID'     => $this->input->post('CategoryID',true),
	   'Name'     	=> $this->input->post('categoryname',true), 
	   'parentid'           =>$this->input->post('Parentcategory',true),
	   'CategoryIsActive'   => $this->input->post('status',true),
	   'isoffer'     		=> $isoffer, 
	   'offerstartdate'     => $convertstartdate, 
	   'offerendate'        => $convertenddate,
	   'CategoryImage'      => $img,
	   'UserIDUpdated'      => $savedid,
	   'DateUpdated'        => date('Y-m-d H:i:s'),
	  );
	  $logData = array(
	   'action_page'         => "Category List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Category Updated",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	 
		if ($this->category_model->update_cat($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->db->select('*');
			$this->db->from('item_category');
			$this->db->where('CategoryIsActive',1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label'=>$row->Name,'value'=>$row->CategoryID);
			}
			$cache_file = './assets/js/category.json';
			$categoryList = json_encode($json_product);
			file_put_contents($cache_file,$categoryList);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_category/create/".$postData['CategoryID']);  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('update_category');
		$data['categoryinfo']   = $this->category_model->findById($id);
	   }
	   $data['categories']   =  $this->category_model->allcategory_dropdown();
	   $data['module'] = "itemmanage";
	   $data['page']   = "addcategory";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
 
    public function delete($category = null)
    {
        $this->permission->module('itemmanage','delete')->redirect();
		$logData = array(
	   'action_page'         => "Category List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Category Deleted",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->category_model->cat_delete($category)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('itemmanage/item_category/index');
    }
 
}
