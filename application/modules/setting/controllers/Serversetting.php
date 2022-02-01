<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serversetting extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'server_model'
		));

		if (!$this->session->userdata('isAdmin')) 
		redirect('login'); 
	}
	public function index()
	{
		$data['title'] = display('server_setting');
		#-------------------------------#
		//check setting table row if not exists then insert a row
		#-------------------------------#
		$data['setting2'] = $this->server_model->read();
		

		$data['module'] = "setting";  
		$data['page']   = "serversetting";  
		echo Modules::run('template/layout', $data); 
	} 

	public function create()
	{
		$data['title'] = display('server_setting');
		#-------------------------------#
		$this->form_validation->set_rules('ipaddress',display('netip'),'required');
		$this->form_validation->set_rules('port', display('ip_port') ,'max_length[255]');
		$this->form_validation->set_rules('dbname',display('onlinebdname'),'max_length[100]');
		$this->form_validation->set_rules('dbuser',display('dbuser'),'max_length[20]');
		$this->form_validation->set_rules('dbpassword',display('dbpassword'),'max_length[250]'); 
		$this->form_validation->set_rules('dbhost',display('dbhost'),'max_length[255]'); 
		$this->form_validation->set_rules('directory','Dorectory Name','max_length[255]'); 
		#-------------------------------#
		//logo upload
		#-------------------------------#

		$data['setting'] = (object)$postData = [
			'serverid'        => $this->input->post('serverid'),
			'localhost_url'   => $this->input->post('ipaddress',true),
			'online_url'      => $this->input->post('port',true),
		]; 

		#-------------------------------#
		if ($this->form_validation->run() === true) {

			#if empty $id then insert data
			if (empty($postData['serverid'])) {
				if ($this->server_model->create($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('save_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception',display('please_try_again'));
				}
			} else {
				
				if ($this->server_model->update($postData)) {
					#set success message
					$this->session->set_flashdata('message',display('update_successfully'));
				} else {
					#set exception message
					$this->session->set_flashdata('exception', display('please_try_again'));
				} 
			}
 
			redirect('setting/serversetting');

		} else { 
			$data['module'] = "setting";  
			$data['page']   = "serversetting";  
			echo Modules::run('template/layout', $data); 
		} 
	}

	//check setting table row if not exists then insert a row
}
