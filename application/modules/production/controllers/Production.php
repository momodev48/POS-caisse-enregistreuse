<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'production_model',
			'logs_model'
		));	
		 $this->load->library('cart');
    }
 
    public function index($id = null)
    {
        
		$this->permission->method('production','read')->redirect();
        $data['title']    = display('production_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('production/production/index');
        $config["total_rows"]  = $this->production_model->countlist();
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
        $data["productionlist"] = $this->production_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
		$settinginfo=$this->production_model->settinginfo();
		$data['currency']=$this->production_model->currencysetting($settinginfo->currency);
        #
        #pagination ends
        #   
        $data['module'] = "production";
        $data['page']   = "productionsetlist";   
        echo Modules::run('template/layout', $data); 
    }
	
	public function productionunit(){
	  $data['title'] = "Set Production Unit";
	  #-------------------------------#
	   $saveid=$this->session->userdata('supid');
	   $data['intinfo']="";
	   $data['item']   = $this->production_model->item_dropdown();
	   $data['module'] = "production";
	   $data['page']   = "addproduction";   
	   echo Modules::run('template/layout', $data); 
		}
	public function production_entry(){
		$this->form_validation->set_rules('foodid','Food Name','required');
		$this->form_validation->set_rules('foodvarientid','Varient Name','required');
	    $saveid=$this->session->userdata('id'); 
		
	   if ($this->form_validation->run()) { 
		$this->permission->method('production','create')->redirect();
		 $logData = [
		   'action_page'         => "set Production Unit",
		   'action_done'     	 => "Insert Data", 
		   'remarks'             => "set Production Unit Created",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  ];
		if ($this->production_model->makeproduction()) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('production/production/addproduction');
		} 
		else{
			$this->session->set_flashdata('exception', "This Item Production Set Already Exist!!!");
		    redirect('production/production/addproduction');
			}
		redirect("production/production/addproduction"); 
	  } else { 
	  redirect("production/production/addproduction"); 
	   }  
		}
	
    public function create($id = null)
    {
	  $data['title'] = display('production_add');
	  #-------------------------------#
	   $saveid=$this->session->userdata('id');
	  $data['intinfo']="";
	 
	   $data['item']   = $this->production_model->item_dropdown();
		
	   $data['module'] = "production";
	   $data['page']   = "production";   
	   echo Modules::run('template/layout', $data); 
    }
	public function insert_production(){
			$this->form_validation->set_rules('foodid','Food Name','required');
			$this->form_validation->set_rules('foodvarientid','Varient Name','required');
			$this->form_validation->set_rules('pro_qty','Serving Unit','required');
			$this->form_validation->set_rules('production_date','Production Date','required');
			$this->form_validation->set_rules('expire_date','Production Expire Date','required');
	        $saveid=$this->session->userdata('id'); 
		    if ($this->form_validation->run()) { 
			$this->permission->method('production','create')->redirect();
			 $logData = [
			   'action_page'         => "Add Production",
			   'action_done'     	 => "Insert Data", 
			   'remarks'             => "Add Production Created",
			   'user_name'           => $this->session->userdata('fullname'),
			   'entry_date'          => date('Y-m-d H:i:s'),
			  ];
			if ($this->production_model->create()) { 
			 $this->logs_model->log_recorded($logData);
			 $this->session->set_flashdata('message', display('save_successfully'));
			 redirect('production/production/create');
			} 
			else{
				$this->session->set_flashdata('exception', display('please_try_again'));
				redirect('production/production/create');
				}
			redirect("production/production/create"); 
		  } else { 
		  redirect("production/production/create"); 
		   }  
		}
		/*change*/
	public function productionitem(){
		   $csrf_token=$this->security->get_csrf_hash();
		   $product_name 	= $this->input->post('product_name',true);
           $product_info 	= $this->production_model->finditem($product_name);
		 
		   $list[''] = '';
		foreach ($product_info as $value) {
			$json_product[] = array('label'=>$value['ingredient_name'],'value'=>$value['id'],'uprice'=>$value['utotalprice']/$value['uquantity']);
		} 
        echo json_encode($json_product);

		}
	public function getfoodfarient($id){
			$varientlist=$this->production_model->foodvarientlist($id);
			if(!empty($varientlist)){
				foreach($varientlist as $varient){
						echo '<option value="'.$varient->variantid.'">'.$varient->variantName.'</option>';
					}	
			}
		}
	public function productionquantity(){
		$product_id = $this->input->post('product_id');
		$product_info =  $this->production_model->get_total_product($product_id);
		echo json_encode($product_info);
		}
	
   public function updateintfrm($id,$vid){
		$this->permission->method('production','update')->redirect();
		$data['title'] = display('production_edit');
		$data['item']   = $this->production_model->item_dropdown();
		$data['productioninfo']   = $this->production_model->findById($id,$vid);
		$data['varientinfo']   = $this->production_model->findByvId($id);
		$data['iteminfo']       = $this->production_model->iteminfo($id,$vid);
        $data['module'] = "production";  
	    $data['page']   = "productionunitedit";   
	   echo Modules::run('template/layout', $data);  
	   }
 	public function update_entry(){
		$this->form_validation->set_rules('foodid','Select Food','required');
		$this->form_validation->set_rules('foodvarientid','Varient Name','required');
		$this->form_validation->set_rules('product_id[]','items','required');

	    $saveid=$this->session->userdata('id'); 
		if ($this->form_validation->run()) { 
		 $this->permission->method('production','update')->redirect();
		 $logData = array(
		   'action_page'         => "Update Set production Unit",
		   'action_done'     	 => "Update Data", 
		   'remarks'             => "Set production Unit Updated",
		   'user_name'           => $this->session->userdata('fullname'),
		   'entry_date'          => date('Y-m-d H:i:s'),
		  );
		if ($this->production_model->update()) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		 redirect('production/production/index');
		} else {
		 $this->session->set_flashdata('message',  display('update_successfully'));
		}
		redirect("production/production/index");
	  } else { 
	  $this->session->set_flashdata('exception',display('please_try_again'));	
	  redirect("production/production/index"); 
	   }  
		
	   }
	public function getset($id,$vid){
		$this->permission->method('production','update')->redirect();
		$data['title'] = display('production_edit');
		$data['item']   = $this->production_model->item_dropdown();
		$data['productioninfo']   = $this->production_model->readset($id,$vid);
		$data['iteminfo']       = $this->production_model->iteminfo($id,$vid);
        $data['module'] = "production";  
	    $data['page']   = "productionset";   
		$this->load->view('production/productionset', $data);  
	   }
  public function getlist($id){
	 	 $suplierinfo=$this->production_model->suplierinfo($id);
		 echo json_encode($suplierinfo);
	 }
    public function delete($id = null)
    {
        $this->permission->module('production','delete')->redirect();
		$logData = array(
	   'action_page'         => "production List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "production Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	    $pdetailid=$this->input->post('pdetailid');
		$productid=$this->input->post('productid');
		if ($this->production_model->deleteitem($productid,$pdetailid)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
		} else {
			#set exception message
			echo "404";
		}
		
    }
	 public function addproduction($id = null)
    {
	  $data['title'] = display('production_add');
	  #-------------------------------#
	   $saveid=$this->session->userdata('supid');
	  $data['intinfo']="";
	 
	   $data['item']   = $this->production_model->item_dropdown();
		
	   $data['module'] = "production";
	   $data['page']   = "addproduction";   
	   echo Modules::run('template/layout', $data); 
    }
	public function ingredientcheck(){
		$foodid=$this->input->post('foodid');
		$vid=$this->input->post('vid');
		$qty=$this->input->post('qty',true);
		echo $available=$this->production_model->checkingredientstock($foodid,$vid,$qty);
		}
	public function possetting(){
       $data['title'] = display('production_setting');
       $saveid=$this->session->userdata('id');
       $data['possetting'] =$this->db->select('*')->from('tbl_posetting')->where('possettingid',1)->get()->row();
       $data['module'] = "production";
       $data['page']   = "productionsetting";   
       echo Modules::run('template/layout', $data); 
    }
 
}
