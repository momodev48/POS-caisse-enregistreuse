<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_setting extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'websetting_model',
			'basicsetting_model',
		));
		$this->db->query('SET SESSION sql_mode = ""');
		if (!$this->session->userdata('isAdmin')) 
		redirect('login'); 
	}
	// Common Setting
		public function index()
	{
		$data['title'] = display('web_setting');
		#-------------------------------#
		//check setting table row if not exists then insert a row
		#-------------------------------#
		$data['websetting'] = $this->websetting_model->read(); 


		$data['module'] = "dashboard";  
		$data['page']   = "web/web_setting";  
		echo Modules::run('template/layout', $data); 
	} 

	public function common_create()
	{
		$data['title'] = display('web_setting');
		#-------------------------------#
		$this->form_validation->set_rules('email',display('email'),'max_length[100]|valid_email');
		$this->form_validation->set_rules('phone',display('phone'),'max_length[20]');
		$this->form_validation->set_rules('footer_text',display('footer_text'),'max_length[255]'); 
		#-------------------------------#
		//logo upload
		$logo = $this->fileupload->do_upload(
			'assets/img/',
			'logo'
		);
		// if logo is uploaded then resize the logo
		if ($logo !== false && $logo != null) {
			$this->fileupload->do_resize(
				$logo, 
				168,
				65
			);
		}
		//if logo is not uploaded
		if ($logo === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}
		
		$footerlogo = $this->fileupload->do_upload(
			'assets/img/',
			'logofooter'
		);
		// if logo is uploaded then resize the logo
		if ($footerlogo !== false && $footerlogo != null) {
			$this->fileupload->do_resize(
				$footerlogo, 
				168,
				65
			);
		}
		//if logo is not uploaded
		if ($footerlogo === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}


		$data['setting'] = (object)$postData = array(
			'id'          => $this->input->post('id',true),
			'email' 	  => $this->input->post('email',true),
			'phone' 	  => $this->input->post('phone',true),
			'logo' 	      => (!empty($logo)?$logo:$this->input->post('old_logo')),
			'logo_footer' => (!empty($footerlogo)?$footerlogo:$this->input->post('old_footerlogo')),
			'ismembership'=> $this->input->post('membershipenable',true),
			'phone_optional'      => $this->input->post('phone2', false),
			'web_onoff'      => $this->input->post('websiteonoff', false),
			'address' 	  => $this->input->post('address',true),
			'powerbytxt'  => $this->input->post('power_text', false),
			'backgroundcolorqr'  => $this->input->post('headercolor', true),
			'qrheaderfontcolor'  => $this->input->post('headerfontcolor', true)
		); 
		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['id'])) {
				if ($this->websetting_model->create_setting($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
			} else {
				if ($this->websetting_model->update_setting($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				} 
			}
 
			redirect('dashboard/web_setting');

		} else { 
			$data['module'] = "dashboard";  
			$data['page']   = "web/web_setting";  
			echo Modules::run('template/layout', $data); 
		} 
	}
	//Banner setting
	
 

	public function bannersetting()
	{
		$data['title'] = display('banner_setting');
		$data['module'] 	= "dashboard";  
		$data['baller_list'] = $this->db->select('*')->from('tbl_slider')->get()->result(); 
		$data['type']   =  $this->websetting_model->type_dropdown();
		$data['page']   = "web/banner_list";  
		echo Modules::run('template/layout', $data); 
	} 
	public function bannertype()
	{
		$data['title'] = display('bannertype');
		$data['module'] 	= "dashboard";  
		$data['ballertype_list'] = $this->db->select('*')->from('tbl_slider_type')->get()->result(); 
		$data['page']   = "web/bannertype_list";  
		echo Modules::run('template/layout', $data); 
	} 
	public function createtype(){
		$data['title'] = display('bannertype');
		$this->form_validation->set_rules('bannertype',display('bannertype'),'required');
		$postData = array(
			'STypeName' 	  => $this->input->post('bannertype',true)
		); 
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->createtype($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('save_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/bannertype');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/bannertype');
			}
		}
	public function edittype($id){
		$this->form_validation->set_rules('bannertype',display('bannertype'),'required');
		$postData = array(
		    'stype_id' 	      => $id,
			'STypeName' 	  => $this->input->post('bannertype',true)
		); 
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->updatetype($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('update_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/bannertype');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/bannertype');
			}
		}
	public function create()
	{
		$data['title'] = display('banner_setting');
		#-------------------------------#
		$this->form_validation->set_rules('banner_type',display('banner_type'),'required');
		$this->form_validation->set_rules('width', display('width') ,'required');
		$this->form_validation->set_rules('height', display('height') ,'required');
		$this->form_validation->set_rules('title', display('title') ,'required');
		$this->form_validation->set_rules('subtitle',display('subtitle'),'required');
		$this->form_validation->set_rules('status',display('status'),'required');

		 $width=$this->input->post('width',true);
		 $height=$this->input->post('height',true);
		   //Banner upload
		$banner = $this->fileupload->do_upload(
			'assets/img/banner/',
			'picture'
		);
		// if Banner is uploaded then resize the Banner
		if ($banner !== false && $banner != null) {
			$this->fileupload->do_resize(
				$banner, 
				$width,
				$height
			);
		}
		//if Banner is not uploaded
		if ($banner === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}
		 
		$postData = array(
	   'Sltypeid'           => $this->input->post('banner_type',true),
	   'title'     		    => $this->input->post('title',true), 
	   'subtitle'           => $this->input->post('subtitle',true),
	   'image'              => $banner,
	   'width'              => $width,
	   'height'             => $height,
	   'slink'     		    => $this->input->post('url',true), 
	   'status'     		=> $this->input->post('status',true)
	  );
		if ($this->form_validation->run() === true) {
				if ($this->websetting_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
			redirect('dashboard/web_setting/bannersetting');

		} else { 
			$this->session->set_flashdata('exception',display('please_try_again'));
			redirect('dashboard/web_setting/bannersetting');
		} 
	}
	
	public function updatebanner()
	{
		$data['title'] = display('banner_setting');
		#-------------------------------#
		$this->form_validation->set_rules('banner_type',display('banner_type'),'required');
		$this->form_validation->set_rules('width', display('width') ,'required');
		$this->form_validation->set_rules('height', display('height') ,'required');
		$this->form_validation->set_rules('title', display('title') ,'required');
		$this->form_validation->set_rules('subtitle',display('subtitle'),'required');
		$this->form_validation->set_rules('status',display('status'),'required');
		$width=$this->input->post('width',true);
		$height=$this->input->post('height',true);


		   //logo upload
		$banner = $this->fileupload->do_upload(
			'assets/img/banner/',
			'picture'
		);
		// if logo is uploaded then resize the logo
		if ($banner !== false && $banner != null) {
			$this->fileupload->do_resize(
				$banner, 
				$width,
				$height
			);
		}
		//if logo is not uploaded
		if ($banner === false) {
			$this->session->set_flashdata('exception', display('invalid_logo'));
		}
		$sliderinfo=$this->db->select('*')->from('tbl_slider')->where('slid',$this->input->post('slid',true))->get()->row();
		if(!empty($banner)){
			 unlink($sliderinfo->image);
			} 
		$postData = array(
	   'slid'               => $this->input->post('slid',true),
	   'Sltypeid'           => $this->input->post('banner_type',true),
	   'title'     		    => $this->input->post('title',true), 
	   'subtitle'           => $this->input->post('subtitle',true),
	   'image'              => (!empty($banner)?$banner:$this->input->post('sliderimage')),
	   'width'              => $width,
	   'height'             => $height,
	   'slink'     		    => $this->input->post('url',true), 
	   'status'     		=> $this->input->post('status',true)
	  );
		if ($this->form_validation->run() === true) {
				if ($this->websetting_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
			redirect('dashboard/web_setting/bannersetting');

		} else { 
			$this->session->set_flashdata('exception',display('please_try_again'));
			redirect('dashboard/web_setting/bannersetting');
		} 
	}

	 public function updateintfrm($id){
		$data['title'] = display('banner_edit');
		$data['intinfo']    = $this->websetting_model->findById($id);
		$data['type']   =  $this->websetting_model->type_dropdown();
        $data['module'] 	= "dashboard";    
        $data['page']   = "web/banneredit";
		$this->load->view('dashboard/web/banneredit', $data);   
  
	   }
public function delete($bannerid = null)
    {
		$sliderinfo=$this->db->select('*')->from('tbl_slider')->where('slid',$bannerid)->get()->row();
		unlink($sliderinfo->image);
		if ($this->websetting_model->delete($bannerid)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard/web_setting/bannersetting');
    }
	
	
//****************Menu Section***************/
public function menusetting()
	{
		$data['title'] = display('menu_setting');
		$data['module'] 	= "dashboard";  
		$data['menu_list'] = $this->db->select('*')->from('top_menu')->get()->result(); 
		$data['allmenu']   =  $this->websetting_model->allmenu_dropdown();
		$data['page']   = "web/menu_list";  
		echo Modules::run('template/layout', $data); 
	}
 
	public function createmenu(){
		$data['title'] = display('add_menu');
		$this->form_validation->set_rules('menuname',display('menu_name'),'required');
		$this->form_validation->set_rules('Menuurl',display('menu_url'),'required');
		$this->form_validation->set_rules('status',display('status'),'required');
		if(empty($this->input->post('menuid',true))){
			$parent=0;
			}
		else{
			$parent=$this->input->post('menuid',true);
			}
		$postData = array(
			'menu_name' 	  => $this->input->post('menuname',true),
			'menu_slug' 	  => $this->input->post('Menuurl',true),
			'parentid' 	      => $parent,
			'entrydate' 	  => date('Y-m-d'),
			'isactive' 	      => $this->input->post('status',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->createmenu($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('save_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/menusetting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/menusetting');
			}
		}
	public function editmenu($id){
		$data['title'] = display('add_menu');
		$this->form_validation->set_rules('menuname',display('menu_name'),'required');
		$this->form_validation->set_rules('Menuurl',display('menu_url'),'required');
		$this->form_validation->set_rules('status',display('status'),'required');
		if(empty($this->input->post('menuid',true))){
			$parent=0;
			}
		else{
			$parent=$this->input->post('menuid',true);
			}
		$postData = array(
		    'menuid' 	      => $id,
			'menu_name' 	  => $this->input->post('menuname',true),
			'menu_slug' 	  => $this->input->post('Menuurl',true),
			'parentid' 	      => $parent,
			'entrydate' 	  => date('Y-m-d'),
			'isactive' 	      => $this->input->post('status',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->updatemenu($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('update_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/menusetting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/menusetting');
			}
		}
		
	public function deletemenu($menuid = null)
    {
		if ($this->websetting_model->deletemenu($menuid)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard/web_setting/menusetting');
    }
	
//****************Social Section***************/
public function socialtting()
	{
		$data['title'] = display('social_setting');
		$data['module'] 	= "dashboard";  
		$data['sociallink_list'] = $this->db->select('*')->from('tbl_sociallink')->get()->result(); 
		$data['page']   = "web/socialicon_list";  
		echo Modules::run('template/layout', $data); 
	}
 
	public function createsociallink(){
		$data['title'] = display('social_setting');
		$this->form_validation->set_rules('stitle',display('title'),'required');
		$this->form_validation->set_rules('url_link',display('url_link'),'required');
		$this->form_validation->set_rules('sicon',display('sicon'),'required');
		$this->form_validation->set_rules('status',display('status'),'required');
		
		$postData = array(
			'title' 	      => $this->input->post('stitle',true),
			'socialurl' 	  => $this->input->post('url_link',true),
			'icon' 	          => $this->input->post('sicon',true),
			'status' 	      => $this->input->post('status',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->createslink($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('save_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/socialtting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/socialtting');
			}
		}
	public function editslink($id){
		$data['title'] = display('social_setting');
		$this->form_validation->set_rules('stitle',display('title'),'required');
		$this->form_validation->set_rules('url_link',display('url_link'),'required');
		$this->form_validation->set_rules('sicon',display('sicon'),'required');
		$this->form_validation->set_rules('status',display('status'),'required');
		
		$postData = array(
		    'sid' 	      => $id,
			'title' 	      => $this->input->post('stitle',true),
			'socialurl' 	  => $this->input->post('url_link',true),
			'icon' 	          => $this->input->post('sicon',true),
			'status' 	      => $this->input->post('status',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->updateslink($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('update_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/socialtting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/socialtting');
			}
		}
		
	public function deleteslink($menuid = null)
    {
		if ($this->websetting_model->deleteslink($menuid)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard/web_setting/socialtting');
    }
	
	//****************Seo Section***************/
public function seosetting()
	{
		$data['title'] = display('seo_setting');
		$data['module'] 	= "dashboard";  
		$data['seo_list'] = $this->db->select('*')->from('tbl_seoption')->get()->result(); 
		$data['page']   = "web/seo_list";  
		echo Modules::run('template/layout', $data); 
	}
 
	public function createseopage(){
		$data['title'] = display('seo_setting');
		$this->form_validation->set_rules('stitle',display('title'),'required');
		$title=$this->input->post('stitle',true);
		$titleslug = preg_replace('/\s+/', '_', $title);
		
		$postData = array(
			'title' 	        => $this->input->post('stitle',true),
			'title_slug'		=> strtolower($titleslug),
			'keywords' 	  		=> $this->input->post('keywords',true),
			'description' 	    => $this->input->post('descp',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->createseoption($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('save_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/seosetting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/seosetting');
			}
		}
	public function editseo($id){
		$data['title'] = display('seo_setting');
		$this->form_validation->set_rules('stitle',display('title'),'required');
		$postData = array(
			'id' 	        	=> $id,
			'title' 	        => $this->input->post('stitle',true),
			'keywords' 	  		=> $this->input->post('keywords',true),
			'description' 	    => $this->input->post('descp',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->updateseopage($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('update_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/seosetting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/seosetting');
			}
		}
		
	public function deleteseo($menuid = null)
    {
		if ($this->websetting_model->deleteseo($menuid)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard/web_setting/seosetting');
    }
	
	//widget setting
	public function widgetsetting()
	{
		$data['title'] = display('widget_setting');
		$data['module'] 	= "dashboard";  
		$data['widget_list'] = $this->db->select('*')->from('tbl_widget')->get()->result(); 
		$data['page']   = "web/widget_list";  
		echo Modules::run('template/layout', $data); 
	}
 
	public function createwidget(){
		$data['title'] = display('add_widget');
		$this->form_validation->set_rules('widgetname',display('widget_name'),'required');
		$postData = array(
			'widget_name' 	  => $this->input->post('widgetname',true),
			'widget_title' 	  => $this->input->post('widgettitle',true),
			'widget_desc' 	  => $this->input->post('widgetdesc',true),
			'status' 	  	  => $this->input->post('status',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->createwidget($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('save_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/widgetsetting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/widgetsetting');
			}
		}
	public function updatewidget($id){
		$data['widget_info'] = $this->db->select('*')->from('tbl_widget')->where('widgetid',$id)->get()->row();
		$data['module'] 	= "dashboard"; 
		$data['page']   = "web/widget_list"; 
		$this->load->view('dashboard/web/widget', $data);  
		}
	public function editwidget($id){
		$data['title'] = display('add_widget');
		$this->form_validation->set_rules('widgetname',display('widget_name'),'required');
		$postData = array(
		    'widgetid' 	      => $id,
			'widget_name' 	  => $this->input->post('widgetname',true),
			'widget_title' 	  => $this->input->post('widgettitle',true),
			'widget_desc' 	  => $this->input->post('widgetdesc',true),
			'status' 	  	  => $this->input->post('status',true)
		);
		
			if ($this->form_validation->run() === true) {
					if ($this->websetting_model->updatewidget($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('update_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/widgetsetting');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/widgetsetting');
			}
		}
		
	public function deletewidget($menuid = null)
    {
		if ($this->websetting_model->deletewidget($menuid)) {
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('dashboard/web_setting/widgetsetting');
    }
	
	public function email_config_setup(){
		$data['title'] = display('email_setting');
		$data['module'] 	= "dashboard";  
		$data['config'] = $this->db->select('*')->from('email_config')->where('email_config_id',1)->get()->row(); 
		$data['page']   = "web/email_setting";  
		echo Modules::run('template/layout', $data);
	}
	public function email_config_save(){
		$data = array(
			'smtp_port' => $this->input->post('smtp_port',true),
			'smtp_host' => $this->input->post('smtp_host',true),
			'smtp_password' => $this->input->post('smtp_password',true),
			'protocol' => $this->input->post('protocol',true),
			'mailpath' => $this->input->post('mailpath',true),
			'mailtype' => $this->input->post('mailtype',true),
			'sender' => $this->input->post('sender',true),
			'api_key' => trim($this->input->post('api_key',true))
		);

		$check = $this->db->select('*')
		->from('email_config')
		->where('email_config_id',1)
		->get()->row();
		
		if($check){
			$this->db->where('email_config_id',1)->update('email_config',$data);
		}else{
			$this->db->insert('email_config',$data);
		}

		$this->session->set_flashdata('message',display('update_successfully'));
    	redirect("dashboard/web_setting/email_config_setup");
	}
	public function subscribeList(){
        $data['title']    = display('subscribelist'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('dashboard/web_setting/subscribeList');
        $config["total_rows"]  = $this->websetting_model->countlist();
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
        $data["subscribe"] = $this->websetting_model->emailread($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		

        #
        #pagination ends
        #   
        $data['module'] = "dashboard";
        $data['page']   = "web/subscribeList";   
        echo Modules::run('template/layout', $data); 
		}
public function storetime()
	{
		$data['title'] = display('storetime');
		$data['module'] 	= "dashboard";  
		$data['openclosetime'] = $this->db->select('*')->from('tbl_openclose')->get()->result(); 
		$data['page']   = "web/storetime_list";  
		echo Modules::run('template/layout', $data); 
	} 
	public function storetimecreate(){
		$data['title'] = display('storetime');
		$this->form_validation->set_rules('dayname',display('day_name'),'required');
		$this->form_validation->set_rules('opentime',display('opent'),'required');
		$this->form_validation->set_rules('closetime',display('closeTime'),'required');
		$postData = array(
			'dayname' 	  => $this->input->post('dayname',true),
			'opentime' 	  => $this->input->post('opentime'),
			'closetime' 	  => $this->input->post('closetime')
		); 
			if ($this->form_validation->run() === true) {
					if ($this->basicsetting_model->openclosecreate($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('save_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/storetime');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/storetime');
			}
		}
	public function editstoretime($id){
		$this->form_validation->set_rules('dayname',display('day_name'),'required');
		$this->form_validation->set_rules('opentime',display('opent'),'required');
		$this->form_validation->set_rules('closetime',display('closeTime'),'required');
		$postData = array(
			'stid' 	  => $this->input->post('stid'),
			'dayname' 	  => $this->input->post('dayname',true),
			'opentime' 	  => $this->input->post('opentime'),
			'closetime' 	  => $this->input->post('closetime')
		);  
			if ($this->form_validation->run() === true) {
					if ($this->basicsetting_model->updatetime($postData)) {
						#set success message
						$this->session->set_flashdata('message',display('update_successfully'));
					} else {
						#set exception message
						$this->session->set_flashdata('exception',display('please_try_again'));
					}
	 
				redirect('dashboard/web_setting/storetime');
	
			} else { 
				$this->session->set_flashdata('exception',display('please_try_again'));
				redirect('dashboard/web_setting/storetime');
			}
		}

}
