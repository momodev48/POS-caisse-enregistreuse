<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restauranttable extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'restable_model',
			'logs_model'
		));	
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('table_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('setting/restauranttable/index');
        $config["total_rows"]  = $this->restable_model->countlist();
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
        $data["tablelist"] = $this->restable_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['floorlist']   = $this->restable_model->readfloor();
		if(!empty($id)) {
		$data['title'] = display('table_edit');
		$data['intinfo']   = $this->restable_model->findById($id);
	   }
        #
        #pagination ends
        #   
        $data['module'] = "setting";
        $data['page']   = "tablelist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('add_new_table');
	  #-------------------------------#
		$this->form_validation->set_rules('tablename',display('table_name'),'required|max_length[50]');
		$this->form_validation->set_rules('capacity',display('capacity')  ,'required');
		$this->form_validation->set_rules('picture','Table icon'  ,'required');
		$tableid=$this->input->post('tableid');
	
		if(!empty($tableid)) {
		$data['title'] = display('table_edit');
		$data['intinfo']   = $this->restable_model->findById($tableid);
	
		$tableimg=$data['intinfo']->table_icon;
	   }
		$config['upload_path']          = 'assets/img/icons/resttable/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 100000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('picture'))
		{
				$error = array('error' => $this->upload->display_errors());
				$icon='';
		}
		else
		{
				
			    $fdata =$this->upload->data();
				$config1=array(
					'source_image' => $fdata['full_path'],
                    'new_image' => $fdata['file_path'],
					'maintain_ratio' => TRUE,
					'create_thumb' => false,
				    'width' => 360,
				    'height' => 233
				);
				$this->load->library('image_lib', $config1);
				$this->image_lib->resize();
				$icon="assets/img/icons/resttable/".$fdata['file_name'];
		}
		if(empty($icon)){
			$icon=$this->input->post('picture',true);
			}
	   $saveid=$this->session->userdata('id');
	   $data['supplier']   = (Object) $postData = [
		   'tableid'  			 => $this->input->post('tableid'),
		   'tablename' 			 => $this->input->post('tablename',true),
		   'person_capicity' 	 => $this->input->post('capacity',true),
		   'table_icon' 	     => $icon,
		   'floor'               => $this->input->post('floor'),
		   'status' 	 		 => 0,
		  ]; 
		  
	  $data['intinfo']="";
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('tableid'))) {
		
		$this->permission->method('setting','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Table List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New table Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
	  $lastid=$this->restable_model->create($postData);
		if($lastid) { 
		$rowdata=[
		'tableid'         => $lastid,
		];
		 $this->restable_model->addrow($rowdata);
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/restauranttable/index');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/restauranttable/index"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData = [
	   'action_page'         => "Table List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Table Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];

		if ($this->restable_model->update($postData)) {
		 $checkexist= $this->restable_model->ckeckseting($tableid);
		 if(empty($checkexist)){
			 $rowdata=[
			'tableid'         => $tableid,
			];
		 $this->restable_model->addrow($rowdata);
			 }
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/restauranttable/index");  
	   }
	  } else { 
	   $data['floorlist']   = $this->restable_model->readfloor();
	   $data['module'] = "setting";
	   $data['page']   = "tablelist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('table_edit');
		$data['intinfo']   = $this->restable_model->findById($id);
		$data['floorlist']   = $this->restable_model->readfloor();
        $data['module'] = "setting";  
        $data['page']   = "tableedit";
		$this->load->view('setting/tableedit', $data);   
	   }
 
    public function delete($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = [
	   'action_page'         => "Table List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Table Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
	 $retstable= $this->restable_model->findById($id);
		if ($this->restable_model->delete($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/restauranttable/index');
    }
	public function tablesetting(){
		    $data['title'] = display('setting');
		    $data['tablelist']   = $this->restable_model->tablelist();
			$data['module'] = "setting";  
			$data['page']   = "tablesetting";
			echo Modules::run('template/layout', $data);   
		}
	public function updatesetting(){
		 $ids =$this->input->post('ids');
		 $style =$this->input->post('style');
		 $tableexist=$this->db->select("*")->from('table_setting')->where('tableid',$ids)->get()->row();
				if(empty($tableexist)) { 
				$rowdata=array(
				'tableid'         => $ids,
				'iconpos'		  => $style
				);
				 $this->restable_model->addrow($rowdata);
				}
		$sortingdata=array(
			'iconpos'         => $style,
			'tableid'         => $ids,
			);
			 $this->restable_model->sortingtable($sortingdata);
		return;
		}
	public function uploadfile(){
			// Count total files
			  $countfiles = count($_FILES['file_source']['name']);
			  // Looping all files
			  for($i=0;$i<$countfiles;$i++){
		
				  $_FILES['file']['name'] = $_FILES['file_source']['name'][$i];
				  $_FILES['file']['type'] = $_FILES['file_source']['type'][$i];
				  $_FILES['file']['tmp_name'] = $_FILES['file_source']['tmp_name'][$i];
				  $_FILES['file']['error'] = $_FILES['file_source']['error'][$i];
				  $_FILES['file']['size'] = $_FILES['file_source']['size'][$i];
		
				$config['upload_path']          = 'assets/img/icons/resttable/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 100000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				  // File upload
				  if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
					$config['image_library'] = 'gd2';
                    $config['source_image'] = $uploadData['full_path'];
                
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 360;
                    $config['height'] = 233;
				  }
				   $this->load->library('image_lib',$config);
				   $this->image_lib->initialize($config);
                   $this->image_lib->resize();
		        
			  }
			  
			    $data['module'] = "setting";  
				$data['page']   = "alllayout";
				$this->load->view('setting/alllayout', $data);
			  
			  
			  
		}
	public function showfile(){
			    $data['module'] = "setting";  
				$data['page']   = "alllayout";
				$this->load->view('setting/alllayout', $data);
			  
		}
	public function floorlist(){
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('floor_list');
		$data["floorlist"] = $this->restable_model->readfloor(); 
		$data['module'] = "setting";
        $data['page']   = "tablefloor";   
        echo Modules::run('template/layout', $data); 
		}
	
 	public function createfloor($id = null)
    {
	  $data['title'] = display('add_floor');
	  #-------------------------------#
		$this->form_validation->set_rules('floor',display('floor'),'required');
		$tbfloorid=$this->input->post('tbfloorid');
		if(!empty($tbfloorid)) {			
		$data['title'] = display('edit_floor');
		$data['intinfo']   = $this->restable_model->findByfloorId($tbfloorid);
	   }

	   $saveid=$this->session->userdata('id');
	   $data['tableinfo']   = (Object) $postData = array(
		   'tbfloorid'  			 => $this->input->post('tbfloorid'),
		   'floorName' 			 => $this->input->post('floor',true)
		 ); 
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('tbfloorid'))) {
		
		$this->permission->method('setting','create')->redirect();
		
	 $logData = array(
	   'action_page'         => "Table Floor List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New table Floor Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	  $lastid=$this->restable_model->createfloor($postData);
		if($lastid) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/restauranttable/floorlist');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/restauranttable/floorlist"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
		
	  $logData =array(
	   'action_page'         => "Table floor List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Table floor Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );

		if($this->restable_model->updatefloor($postData)) {
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/restauranttable/floorlist");  
	   }
	  } else { 
	   $data['module'] = "setting";
	   $data['page']   = "tablelist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }

 
    public function deletefloor($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = array(
	   'action_page'         => "Table floor List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Table floor Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	
		if ($this->restable_model->deletefloor($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/restauranttable/floorlist');
    }
	public function roomlist(){
		$this->permission->method('setting','read')->redirect();
        $data['title']    = display('room_list');
		$data["roomlist"] = $this->restable_model->readroom(); 
		$data['floorlist']   = $this->restable_model->readfloor();
		$data['module'] = "setting";
        $data['page']   = "roomlist";   
        echo Modules::run('template/layout', $data); 
		}
	
 	public function createroom($id = null)
    {
	  $data['title'] = display('add_room');
	  #-------------------------------#
		$this->form_validation->set_rules('floor',display('floor'),'required');
		$tbfloorid=$this->input->post('tbfloorid');
		if(!empty($tbfloorid)) {			
		$data['title'] = display('edit_floor');
		$data['intinfo']   = $this->restable_model->findByroomId($tbfloorid);
	   }

	   $saveid=$this->session->userdata('id');
	   $data['tableinfo']   = (Object) $postData = array(
		   'id'  			     => $this->input->post('roomid'),
		   'roomno'  			 => $this->input->post('roomno'),
		   'floorno' 			 => $this->input->post('floor',true)
		 ); 
	  if ($this->form_validation->run()) { 
	   if(empty($this->input->post('roomid'))) {
		
		$this->permission->method('setting','create')->redirect();
		
	 $logData = array(
	   'action_page'         => "Room List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Room Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	  $lastid=$this->restable_model->createroom($postData);
		if($lastid) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('setting/restauranttable/roomlist');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/restauranttable/roomlist"); 
	
	   } else {
		$this->permission->method('setting','update')->redirect();
	  $logData =array(
	   'action_page'         => "Room List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Room Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );

		if($this->restable_model->updateroom($postData)) {
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("setting/restauranttable/roomlist");  
	   }
	  } else { 
	   $data['module'] = "setting";
	   $data['page']   = "roomlist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
public function updateroomfrm($id){
		$this->permission->method('setting','update')->redirect();
		$data['title'] = display('update');
		$data['intinfo']   = $this->restable_model->findByroomId($id);
		$data['floorlist']   = $this->restable_model->readfloor();
        $data['module'] = "setting";  
        $data['page']   = "roomedit";
		$this->load->view('setting/roomedit', $data);   
	   }
 
    public function deleteroom($id = null)
    {
        $this->permission->module('setting','delete')->redirect();
		$logData = array(
	   'action_page'         => "Room List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Room Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	
		if ($this->restable_model->deleteroom($id)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('setting/restauranttable/roomlist');
    }
}
