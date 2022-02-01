<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		$this->load->model(array(
 			'auth_model' 
 		));
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->helper('captcha');
 	}
 

	public function index()
	{  
	//echo "Bla Bla";
	
		if($this->session->userdata('isLogIn'))
			redirect('dashboard/home');
		$data['title']    = display('login'); 
		#-------------------------------------#
	
		$this->form_validation->set_rules('email', display('email'), 'required|valid_email|max_length[100]|trim');
		$this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5|trim');
		$this->form_validation->set_rules('captcha', display('captcha'),  array('matches[captcha]', function($captcha){ 
		        	$oldCaptcha = $this->session->userdata('captcha');
		        	if ($captcha == $oldCaptcha) {
		        		return true;
		        	}
		        }
		    )
		);
		
		#-------------------------------------#
		$data['user'] = (object)$userData = array(
			'email' 	 => $this->input->post('email',true),
			'password'   => $this->input->post('password',true),
		);
		#-------------------------------------#
		if ( $this->form_validation->run())
		{
			$this->session->unset_userdata('captcha');

			$user = $this->auth_model->checkUser($userData);

			if($user->num_rows() > 0) {
            $chef = $this->db->select('emp_his_id,employee_id,pos_id')->where('emp_his_id',$user->row()->id)->get('employee_history')->row();
			$chefid='';
			if(!empty($chef)) {
					$shiftcheck = true;
				$shiftmangment = $this->db->where('directory','shiftmangment')->where('status',1)->get('module')->num_rows();
				
				if($shiftmangment == 1){
				$shiftcheck = $this->checkshift($chef->employee_id);
					}

					
				if($shiftcheck == true){
					if($chef->pos_id == 1){
					$chefid=$chef->emp_his_id;
					}
					
				}
				else{
					
					$this->session->set_flashdata('exception', display('not_your_working_time'));
				redirect('login');
					
				}
				
			
			}
			
			$checkPermission = $this->auth_model->userPermission2($user->row()->id);
			if($checkPermission!=NULL){
				$permission = array();
				$permission1 = array();
				if(!empty($checkPermission)){
					foreach ($checkPermission as $value) {
						$permission[$value->module] = array( 
							'create' => $value->create,
							'read'   => $value->read,
							'update' => $value->update,
							'delete' => $value->delete
						);

						$permission1[$value->menu_title] = array( 
							'create' => $value->create,
							'read'   => $value->read,
							'update' => $value->update,
							'delete' => $value->delete
						);
					
					}
				} 
			}

			if($user->row()->is_admin == 2){
				$row = $this->db->select('client_id,client_email')->where('client_email',$user->row()->email)->get('setup_client_tbl')->row();
			}

				     $sData = array(
					'isLogIn' 	  => true,
					'isAdmin' 	  => (($user->row()->is_admin == 1)?true:false),
					'user_type'   => $user->row()->is_admin,
					'id' 		  => $user->row()->id,
					'client_id'   => @$row->client_id,
					'fullname'	  => $user->row()->fullname,
					'user_level'  => $user->row()->user_level,
					'email' 	  => $user->row()->email,
					'image' 	  => $user->row()->image,
					'last_login'  => $user->row()->last_login,
					'last_logout' => $user->row()->last_logout,
					'ip_address'  => $user->row()->ip_address,
					'permission'  => json_encode(@$permission), 
					'label_permission'  => json_encode(@$permission1) 
					);	
					//store date to session 
					$this->session->set_userdata($sData);
					//update database status
					$this->auth_model->last_login();
					//welcome message
					$this->session->set_flashdata('message', display('welcome_back').' '.$user->row()->fullname);
					if(!empty($chefid)){
					redirect('ordermanage/order/allkitchen');
					}
					else if($user->row()->counter==1){
						redirect('ordermanage/order/counterboard');
						}
					else{
					redirect('dashboard/home');
					}

			} else {
				$this->session->set_flashdata('exception', display('incorrect_email_or_password'));
				redirect('login');
			} 

		} else {

			$captcha = create_captcha(array(
			    'img_path'      => './assets/img/captcha/',
			    'img_url'       => base_url('assets/img/captcha/'),
			    'font_path'     => './assets/fonts/captcha.ttf',
			    'img_width'     => '328',
			    'img_height'    => 64,
			    'expiration'    => 600, //5 min
			    'word_length'   => 4,
			    'font_size'     => 32,
			    'img_id'        => 'Imageid',
			    'pool'          => '23456789abcdefghijkmnpqrstuvwxyz',

			    // White background and border, black text and red grid
			    'colors'        => array(
			            'background' => array(255, 255, 255),
			            'border' => array(228, 229, 231),
			            'text' => array(49, 141, 1),
			            'grid' => array(241, 243, 246)
			    )
			));
			$data['captcha_word'] = $captcha['word'];
			$data['captcha_image'] = $captcha['image'];
			$this->session->set_userdata('captcha', $captcha['word']);

			echo Modules::run('template/login', $data);
		}
	}
  
	public function logout()
	{ 
		//update database status
		$this->auth_model->last_logout();
		//destroy session
		$this->session->sess_destroy();
		redirect('login');
	}

	public function checkshift($id){
		 $this->db->select('shift.*');
        $this->db->from('shift_user as shiftuser');
        $this->db->join('shifts as shift','shiftuser.shift_id=shift.id','left');
        $this->db->where('shiftuser.emp_id',$id);
        $shift=$this->db->get()->row();
         $timezone = $this->db->select('timezone')->get('setting')->row();
         $tz_obj = new DateTimeZone($timezone->timezone);
		$today = new DateTime("now", $tz_obj);
		$today_formatted = $today->format('H:i:s');

		
		if ( $today_formatted>=$shift->start_Time && $today_formatted <= $shift->end_Time ) 
		{
		
			return true;
		}
		else{
			
			return false;
		}

        
	}

}
