<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_food extends MX_Controller {
    
    public function __construct()
    {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode = ""');
		$this->load->model(array(
			'fooditem_model',
			'category_model',
			'foodvarient_model',
			'foodavailable_model',
			'todaymenu_model',
			'logs_model'
		));	
    }
 
    public function index()
    {
        
		$this->permission->method('itemmanage','read')->redirect();
        $data['title']    = display('food_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('itemmanage/item_food/index');
        $config["total_rows"]  = $this->fooditem_model->count_fooditem();
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
        $data["fooditemslist"] = $this->fooditem_model->read_fooditem($config["per_page"], $page);
		$data['pagenum']=$page;
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #   
        $data['module'] = "itemmanage";
        $data['page']   = "fooditemlist";   
        echo Modules::run('template/layout', $data); 
    }
	
	
    public function create($id = null)
    {
	  $data['title'] = display('add_food');
	  #-------------------------------#
	  $this->form_validation->set_rules('CategoryID', display('category_name')  ,'required');
	  if(!empty($this->input->post('ProductsID'))) {
	  $this->form_validation->set_rules('foodname', display('item_name')  ,'required|max_length[100]');
	  }
	  else{
		   $this->form_validation->set_rules('foodname', display('item_name')  ,'required|is_unique[item_foods.ProductName]|max_length[100]');
		   $this->form_validation->set_message('is_unique', 'Sorry, this %s already used!');
		  }
	  $this->form_validation->set_rules('status', display('status')  ,'required');
	  
	   $savedid=$this->session->userdata('id');
	   $offerstartdate = str_replace('/','-',$this->input->post('offerstartdate',true));
	   $offerendate = str_replace('/','-',$this->input->post('offerendate',true));
	  
	   $isoffer = $this->input->post('isoffer',true);
	   $special = $this->input->post('special',true);
	   if($isoffer==1){
		   $this->form_validation->set_rules('offerstartdate', display('offerdate')  ,'required');
		   $this->form_validation->set_rules('offerendate', display('offerenddate')  ,'required');
		    $convertstartdate= date('Y-m-d' , strtotime($offerstartdate));
			$convertenddate= date('Y-m-d' , strtotime($offerendate));
			$isoffer=$isoffer;
			$OffersRate=$this->input->post('offerate',true);
		   }
		else{
			 $convertstartdate= "0000-00-00";
			 $convertenddate= "0000-00-00";
			 $isoffer=0;
			 $OffersRate=0;
			}
		if($special==1){
			$special = $this->input->post('special',true);
			}
		else{
			$special =0;
			}
	   $myvat=$this->input->post('vat');
	   if(empty($myvat)){
		   $myvat=0;
		   }
	   $menutype = $this->input->post('menutype',true);
	   $alltmtype="";
	   $i=0;
	   foreach($menutype as $types){
		   $i++;
		    $alltmtype.=$this->input->post('mytmenu_'.$types,true).",";
		   }
		$alltmtype=trim($alltmtype,','); 
	    $uniqueStr = implode(',', array_unique(explode(',', $alltmtype)));
	  #-------------------------------#
	  if ($this->form_validation->run()) { 
	  /****************image Upload*************/
	    $config['upload_path']          = 'application/modules/itemmanage/assets/images/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 100000;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('picture'))
		{
				$error = array('error' => $this->upload->display_errors());
				$img='';
				$big='';
				$medium='';
				$small='';
		}
		else
		{		
				 if(!empty($id)) {
					 $imageinfo=$this->db->select('*')->from('tem_foods')->where('ProductsID',$id)->get()->row();
					 unlink($imageinfo->ProductImage);
					 unlink($imageinfo->bigthumb);
					 unlink($imageinfo->medium_thumb);
					 unlink($imageinfo->small_thumb);
					 }
				
				$fdata =$this->upload->data();
			
				$image_sizes = array('big'=>array(555,370), 'medium' => array(268,223),'small' => array(116,116));
				$this->load->library('image_lib');
            foreach ($image_sizes as $key=>$resize) {
                $config1 = array(
                    'source_image' => $fdata['full_path'],
                    'new_image' => $fdata['file_path'].$key.'/',
                    'maintain_ratio' => FALSE,
                    'width' => $resize[0],
                    'height' => $resize[1],
                    'quality' =>70,
                );
                $this->image_lib->initialize($config1);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
			 $this->load->library('image_lib', $config);
             $this->image_lib->resize();  
	    $big='application/modules/itemmanage/assets/images/big/'.$fdata['file_name'];
		$medium='application/modules/itemmanage/assets/images/medium/'.$fdata['file_name'];
		$small='application/modules/itemmanage/assets/images/small/'.$fdata['file_name'];
		$img = 'application/modules/itemmanage/assets/images/'.$fdata['file_name'];          
		}
		
	  
	  /****************end*********************/
	   if (empty($this->input->post('ProductsID'))) {
		$this->permission->method('itemmanage','create')->redirect();
		$data['foodlist']   = (Object) $postData = array(
	   'ProductsID'     		=> $this->input->post('ProductsID'),
	   'CategoryID'     		=> $this->input->post('CategoryID'), 
	   'ProductName'   			=> $this->input->post('foodname',true),
	   'component'              => $this->input->post('component',true),
	   'itemnotes'              => $this->input->post('itemnotes',true),
	   'menutype'               => $uniqueStr,
	   'descrip'                => $this->input->post('descrip',true),
	   'kitchenid'              =>  $this->input->post('kitchen'),
	   'cookedtime'             => $this->input->post('cookedtime',true),
	   'productvat'             => $myvat,
	   'OffersRate'             => $OffersRate,
	   'special'       			=> $special,
	   'offerIsavailable'       => $isoffer,
	   'offerstartdate'         => $convertstartdate,
	   'offerendate'            => $convertenddate,
	   'is_customqty'           => $this->input->post('customqty',true),
	   'ProductsIsActive'   	=> $this->input->post('status'),
	   'ProductImage'      		=> $img,
	   'bigthumb'      			=> $big,
	   'medium_thumb'      		=> $medium,
	   'small_thumb'      		=> $small,
	   'UserIDInserted'     	=> $savedid,
	   'UserIDUpdated'      	=> $savedid,
	   'UserIDLocked'       	=> $savedid,
	   'DateInserted'       	=> date('Y-m-d H:i:s'),
	   'DateUpdated'        	=> date('Y-m-d H:i:s'),
	   'DateLocked'         	=> date('Y-m-d H:i:s'),
	  );
	  $logData = array(
	   'action_page'         => "Add Food",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Food Added",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	  $taxsettings = $this->taxchecking();
		if(!empty($taxsettings)){
			$tx=0;
			$taxitems= array();
			foreach ($taxsettings as $taxitem) {
				$filedtax = 'tax'.$tx;
					$taxitems[$filedtax] = $this->input->post($filedtax,true);
				$tx++;
			}
			$postData = array_merge($postData,$taxitems);
		}
		if ($this->fooditem_model->fooditem_create($postData)) { 
		$this->logs_model->log_recorded($logData);
			$this->db->select('*');
			$this->db->from('item_foods');
			$this->db->where('ProductsIsActive',1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label'=>$row->ProductName,'value'=>$row->ProductsID);
			}
			$cache_file = './assets/js/product.json';
			$productList = json_encode($json_product);
			file_put_contents($cache_file,$productList);
			
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('itemmanage/item_food/create');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/create"); 
	
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
		if(empty($img)){
			$img=$this->input->post('old_image',true);
			$big=$this->input->post('bigimage',true);
			$medium=$this->input->post('mediumimage',true);
			$small=$this->input->post('smallimage',true);
			}
		$data['category']   = (Object) $postData = array(
	   'ProductsID'     		=> $this->input->post('ProductsID'),
	   'CategoryID'     		=> $this->input->post('CategoryID'), 
	   'ProductName'   			=> $this->input->post('foodname',true),
	   'component'              => $this->input->post('component',true),
	   'itemnotes'              => $this->input->post('itemnotes',true),
	   'menutype'              => $uniqueStr,
	   'descrip'                => $this->input->post('descrip',true),
	   'productvat'             => $this->input->post('vat',true),
	   'kitchenid'             => $this->input->post('kitchen'),
	   'cookedtime'             => $this->input->post('cookedtime',true),
	   'OffersRate'             => $OffersRate,
	   'special'       			=> $special,
	   'is_customqty'           => $this->input->post('customqty',true),
	   'offerIsavailable'       => $isoffer,
	   'offerstartdate'         => $convertstartdate,
	   'offerendate'            => $convertenddate,
	   'ProductsIsActive'   	=> $this->input->post('status',true),
	   'ProductImage'      		=> $img,
	   'bigthumb'      			=> $big,
	   'medium_thumb'      		=> $medium,
	   'small_thumb'      		=> $small,

	   'UserIDUpdated'      => $savedid,
	   'DateUpdated'        => date('Y-m-d H:i:s'),
	  );
	  $logData = array(
	   'action_page'         => "Food List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Food Updated",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	  $taxsettings = $this->taxchecking();
		if(!empty($taxsettings)){
			$tx=0;
			$taxitems= array();
			foreach ($taxsettings as $taxitem) {
				$filedtax = 'tax'.$tx;
					$taxitems[$filedtax] = $this->input->post($filedtax,true);
				$tx++;
			}
			$postData = array_merge($postData,$taxitems);
		}

		if ($this->fooditem_model->update_fooditem($postData)) { 
		$this->logs_model->log_recorded($logData);
		    $this->db->select('*');
			$this->db->from('item_foods');
			$this->db->where('ProductsIsActive',1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label'=>$row->ProductName,'value'=>$row->ProductsID);
			}
			$cache_file = './assets/js/product.json';
			$productList = json_encode($json_product);
			file_put_contents($cache_file,$productList);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/create/".$postData['ProductsID']);  
	   }
	  } else { 
	  $data['taxitems'] = $this->taxchecking();
	   if(!empty($id)) {
		$data['title'] = display('update_fooditem');
		$data['productinfo']   = $this->fooditem_model->findById($id);
	   }
	   
	   $data['categories']   =  $this->category_model->allcategory_dropdown();
	   $data['allkitchen']   =  $this->fooditem_model->allkitchen();
	   $data['todaymenu']   =  $this->todaymenu_model->read_menulist();
	   $data['module'] = "itemmanage";
	   $data['page']   = "addfooditem";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
 
 
    public function delete($category = null)
    {
        $this->permission->module('itemmanage','delete')->redirect();
		$logData = [
	   'action_page'         => "Food List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Food Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->fooditem_model->fooditem_delete($category)) {
			$this->logs_model->log_recorded($logData);
			
			$this->db->select('*');
			$this->db->from('item_foods');
			$this->db->where('ProductsIsActive',1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label'=>$row->ProductName,'value'=>$row->ProductsID);
			}
			$cache_file = './assets/js/product.json';
			$productList = json_encode($json_product);
			file_put_contents($cache_file,$productList);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('itemmanage/item_food/index');
    }
	
	//Bulk Food Upload
	public function bulkfoodupload(){
		
	   $this->permission->method('itemmanage','read')->redirect();
	   $data['title']    = display('food_list'); 
	   $data['module'] = "itemmanage";
	   $data['page']   = "add_food_csv";   
	   echo Modules::run('template/layout', $data); 
		}
	public function supplieradd(){
		$data['title'] = display('supplier_add');
		#-------------------------------#
		$this->form_validation->set_rules('suppliername',display('payment_name'),'required|max_length[50]');
		$this->form_validation->set_rules('mobile',display('shippingrate')  ,'required');
		$saveid=$this->session->userdata('supid');
		$data['supplier']   = (Object) $postData = array(
		'supid'  			 => $this->input->post('supid'),
		'supName' 			 => $this->input->post('suppliername',true),
		'supEmail' 	         => $this->input->post('email',true),
		'supMobile' 	 	     => $this->input->post('mobile',true),
		'supAddress' 	     => $this->input->post('address',true),
		); 
		$data['intinfo']="";
			if ($this->form_validation->run()) { 
				$this->permission->method('itemmanage','create')->redirect();
				$logData = array(
				'action_page'         => "Supplier List",
				'action_done'     	 => "Insert Data", 
				'remarks'             => "New Supplier Created",
				'user_name'           => $this->session->userdata('fullname'),
				'entry_date'          => date('Y-m-d H:i:s'),
				);
				if ($this->fooditem_model->addsupplier($postData)) { 
					$this->logs_model->log_recorded($logData);
					$this->session->set_flashdata('message', display('save_successfully'));
					redirect('itemmanage/item_food/bulkfoodupload');
				} else {
					$this->session->set_flashdata('exception',  display('please_try_again'));
				}
				redirect("itemmanage/item_food/bulkfoodupload"); 
			} 
			else { 
				redirect("itemmanage/item_food/bulkfoodupload"); 
				}   
		}
	
	//Food Variant Section
	public function foodvarientlist($id=null)
    {
        
		$this->permission->method('itemmanage','read')->redirect();
        $data['title']    = display('variant_list'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('itemmanage/item_food/foodvarientlist');
        $config["total_rows"]  = $this->foodvarient_model->count_varient();
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
		$data["fooditemslist"] = $this->foodvarient_model->read_varient($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
        #
        #pagination ends
        # 
		if(!empty($id)) {
		$data['title'] = display('variant_edit');
		$data['intinfo']   = $this->foodvarient_model->findById($id);
	   }
	   $settinginfo=$this->fooditem_model->settinginfo();
	   $data['storeinfo']      = $settinginfo;
	   $data['currency']=$this->fooditem_model->currencysetting($settinginfo->currency);
	    $data['itemdropdown']   =  $this->fooditem_model->fooditem_dropdown();  
        $data['module'] = "itemmanage";
        $data['page']   = "varientlist";   
        echo Modules::run('template/layout', $data); 
    }
	public function varientcreate($id = null)
    {
	  $data['title'] = display('add_varient');
	  #-------------------------------#
		$this->form_validation->set_rules('varientname',display('varient_name'),'required|max_length[50]');
		$this->form_validation->set_rules('foodid',display('item_name')  ,'required');
		$this->form_validation->set_rules('price', display('price')  ,'required');
	   
	  $data['intinfo']="";
	  $data['varient']   = (Object) $postData = [
	   'variantid'          => $this->input->post('variantid'),
	   'menuid' 	        => $this->input->post('foodid',true),
	   'variantName' 	 	=> $this->input->post('varientname',true),
	   'price' 	 	        => $this->input->post('price',true),
	  ];
	  if ($this->form_validation->run()) { 
	   if (empty($this->input->post('variantid'))) {
		$this->permission->method('itemmanage','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Varient List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Varient Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->foodvarient_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('itemmanage/item_food/foodvarientlist');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/foodvarientlist"); 
	
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
	  $logData = [
	   'action_page'         => "Varient List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Varient Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
	 
		if ($this->foodvarient_model->update_varient($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/foodvarientlist");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('variant_edit');
		$data['intinfo']   = $this->foodvarient_model->findById($id);
	   }
	   $settinginfo=$this->fooditem_model->settinginfo();
	   $data['storeinfo']      = $settinginfo;
	   $data['currency']=$this->fooditem_model->currencysetting($settinginfo->currency);
	   $data['fooddropdown']   =  $this->fooditem_model->fooditem_dropdown();
	   $data['module'] = "itemmanage";
	   $data['page']   = "varientlist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateintfrm($id){
	  
		$this->permission->method('itemmanage','update')->redirect();
		$data['title'] = display('variant_edit');
		$data['intinfo']   = $this->foodvarient_model->findById($id);
		$data['itemdropdown']   =  $this->fooditem_model->fooditem_dropdown();
		$settinginfo=$this->fooditem_model->settinginfo();
	   $data['storeinfo']      = $settinginfo;
	   $data['currency']=$this->fooditem_model->currencysetting($settinginfo->currency);
        $data['module'] = "itemmanage";  
        $data['page']   = "varientedit";
		$this->load->view('itemmanage/varientedit', $data);   
     
	   }
 
    public function deletevarient($category = null)
    {
        $this->permission->module('itemmanage','delete')->redirect();
		$logData = [
	   'action_page'         => "Varient List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Varient Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->foodvarient_model->delete($category)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('itemmanage/item_food/foodvarientlist');
    }
	
	//Fooda vailable Section
	public function availablelist($id=null)
    {
        
		$this->permission->method('itemmanage','read')->redirect();
        $data['title']    = display('food_availablelist'); 
        #-------------------------------#       
        #
        #pagination starts
        #
        $config["base_url"] = base_url('itemmanage/item_food/availablelist');
        $config["total_rows"]  = $this->foodavailable_model->count_avail();
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
		$data["foodavailist"] = $this->foodavailable_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$data['pagenum']=$page;
        #
        #pagination ends
        # 
		if(!empty($id)) {
		$data['title'] = display('variant_edit');
		$data['intinfo']   = $this->foodavailable_model->findById($id);
	   }
	    $data['itemdropdown']   =  $this->fooditem_model->fooditem_dropdown();  
        $data['module'] = "itemmanage";
        $data['page']   = "availablelist";   
        echo Modules::run('template/layout', $data); 
    }
	public function availablecreate($id = null)
    {
	  $data['title'] = display('add_availablity');
	  #-------------------------------#
		$this->form_validation->set_rules('foodid',display('item_name')  ,'required');
		$this->form_validation->set_rules('availday',display('available_day')  ,'required');
		$this->form_validation->set_rules('fromtime',"From Date"  ,'required');
		$this->form_validation->set_rules('totime',"To Date"  ,'required');
		$this->form_validation->set_rules('status', display('status')  ,'required');
	  $avtime=$this->input->post('fromtime',true)."-".$this->input->post('totime',true);
	  
	  $data['intinfo']="";
	  $data['available']   = (Object) $postData = [
	   'availableID'          => $this->input->post('availableID'),
	   'foodid' 	          => $this->input->post('foodid',true),
	   'availtime' 	 	      => $avtime,
	   'availday' 	 	      => $this->input->post('availday',true),
	   'is_active' 	 	      => $this->input->post('status',true),
	  ];
	  if ($this->form_validation->run()) { 
	   if (empty($this->input->post('availableID'))) {
		$this->permission->method('itemmanage','create')->redirect();
		
	 $logData = [
	   'action_page'         => "Food Availablity",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Food Availablity Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->foodavailable_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('itemmanage/item_food/availablelist');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/availablelist"); 
	
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
	  $logData = array(
			   'action_page'         => "Food Availablity",
			   'action_done'     	 => "Update Data", 
			   'remarks'             => "Food Availablity Updated",
			   'user_name'           => $this->session->userdata('fullname'),
			   'entry_date'          => date('Y-m-d H:i:s'),
			 );

		if ($this->foodavailable_model->update($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/availablelist");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('edit_availablity');
		$data['intinfo']   = $this->foodavailable_model->findById($id);
	   }
	   $data['fooddropdown']   =  $this->fooditem_model->fooditem_dropdown();
	   $data['module'] = "itemmanage";
	   $data['page']   = "availablelist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updateavailfrm($id){
		$this->permission->method('itemmanage','update')->redirect();
		$data['title'] = display('edit_availablity');
		$data['intinfo']   = $this->foodavailable_model->findById($id);
		$data['itemdropdown']   =  $this->fooditem_model->fooditem_dropdown();
        $data['module'] = "itemmanage";  
        $data['page']   = "availabledit";
		$this->load->view('itemmanage/availabledit', $data);   
      
	   }
 
    public function deleteavailable($category = null)
    {
        $this->permission->module('itemmanage','delete')->redirect();
			$logData = array(
			   'action_page'         => "Food Availablity",
			   'action_done'     	 => "Delete Data", 
			   'remarks'             => "Food Availablity Deleted",
			   'user_name'           => $this->session->userdata('fullname'),
			   'entry_date'          => date('Y-m-d H:i:s'),
			  );
		if ($this->foodavailable_model->delete($category)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('itemmanage/item_food/availablelist');
    }
	
	//Food Variant Section
	public function todaymenutype($id=null)
    {
        
		$this->permission->method('itemmanage','read')->redirect();
        $data['title']    = display('menu_type'); 
		$data["todaymenutypelist"] = $this->todaymenu_model->read_menulist();
		if(!empty($id)) {
		$data['title'] = display('menutype_edit');
		$data['intinfo']   = $this->todaymenu_model->findById($id);
	   }
        $data['module'] = "itemmanage";
        $data['page']   = "menutypelist";   
        echo Modules::run('template/layout', $data); 
    }
	public function menutypecreate($id = null)
    {
	  $data['title'] = display('add_menu_type');
	  #-------------------------------#
		$this->form_validation->set_rules('menu_type_name',display('menu_type_name'),'required|max_length[50]');
		$this->form_validation->set_rules('status', display('status')  ,'required');
	   $this->load->library('fileupload');
	  $img = $this->fileupload->do_upload('./application/modules/itemmanage/assets/images/','picture');
	  
	  $data['intinfo']="";
	  $data['mtype']   = (Object) $postData = array(
	   'menutypeid'          	=> $this->input->post('menutypeid'),
	   'menutype' 	        	=> $this->input->post('menu_type_name',true),
	   'menu_icon' 	 			=> (!empty($img)?$img:$this->input->post('old_image')),
	   'status' 	 	        => $this->input->post('status',true),
	  );
	  if ($this->form_validation->run()) { 
	   if (empty($this->input->post('menutypeid'))) {
		$this->permission->method('itemmanage','create')->redirect();
	 $logData = array(
	   'action_page'         => "Menu type List",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Menu type Created",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
		if ($this->todaymenu_model->create($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('save_successfully'));
		 redirect('itemmanage/item_food/todaymenutype');
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/todaymenutype"); 
	
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
	  $logData = array(
	   'action_page'         => "Menu type List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Menu type Updated",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );

		if ($this->todaymenu_model->update_menutype($postData)) { 
		 $this->logs_model->log_recorded($logData);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/todaymenutype");  
	   }
	  } else { 
	   if(!empty($id)) {
		$data['title'] = display('menutype_edit');
		$data['intinfo']   = $this->todaymenu_model->findById($id);
	   }
	   $data['module'] = "itemmanage";
	   $data['page']   = "menutypelist";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
   public function updatemenufrm($id){
	  
		$this->permission->method('itemmanage','update')->redirect();
		$data['title'] = display('menutype_edit');
		$data['intinfo']   = $this->todaymenu_model->findById($id);
        $data['module'] = "itemmanage";  
        $data['page']   = "mtypeedit";
		$this->load->view('itemmanage/mtypeedit', $data);   
	   }
 
    public function deletemenutype($category = null)
    {
        $this->permission->module('itemmanage','delete')->redirect();
		$logData = [
	   'action_page'         => "Menu type List",
	   'action_done'     	 => "Delete Data", 
	   'remarks'             => "Menu type Deleted",
	   'user_name'           => $this->session->userdata('fullname'),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  ];
		if ($this->todaymenu_model->delete($category)) {
			#Store data to log table.
			 $this->logs_model->log_recorded($logData);
			#set success message
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			#set exception message
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect('itemmanage/item_food/todaymenutype');
    }
	
	public function addgroupfood($id = null)
    {
	  $data['title'] = display('add_group_item');
	  #-------------------------------#
	  $this->form_validation->set_rules('CategoryID', display('category_name')  ,'required');
	  $this->form_validation->set_rules('foodname', display('item_name')  ,'required|max_length[100]');
	  $this->form_validation->set_rules('status', display('status')  ,'required');
	   $savedid=$this->session->userdata('id');
	   $offerstartdate = str_replace('/','-',$this->input->post('offerstartdate'));
	   $offerendate = str_replace('/','-',$this->input->post('offerendate'));
	   $groupietm = $this->input->post('allid',true);
	    $totalitem=count(explode(',',$groupietm ));
	   $isoffer = $this->input->post('isoffer',true);
	   $special = $this->input->post('special',true);
	   if($isoffer==1){
		   $this->form_validation->set_rules('offerstartdate', display('offerdate')  ,'required');
		   $this->form_validation->set_rules('offerendate', display('offerenddate')  ,'required');
		    $convertstartdate= date('Y-m-d' , strtotime($offerstartdate));
			$convertenddate= date('Y-m-d' , strtotime($offerendate));
			$isoffer=$isoffer;
			$OffersRate=$this->input->post('offerate',true);
		   }
		else{
			 $convertstartdate= "0000-00-00";
			 $convertenddate= "0000-00-00";
			 $isoffer=0;
			 $OffersRate=0;
			}
		if($special==1){
			$special = $this->input->post('special',true);
			}
		else{
			$special =0;
			}
	   $myvat=$this->input->post('vat');
	   if(empty($myvat)){
		   $myvat=0;
		   }
	   $menutype = $this->input->post('menutype',true);
	   $alltmtype="";
	   $i=0;
	   foreach($menutype as $types){
		   $i++;
		    $alltmtype.=$this->input->post('mytmenu_'.$types,true).",";
		   }
		$alltmtype=trim($alltmtype,','); 
	    $uniqueStr = implode(',', array_unique(explode(',', $alltmtype)));
	  #-------------------------------#
	  if ($this->form_validation->run()) { 
	  if($totalitem<2){
		   $this->session->set_flashdata('exception',  'Add More then 1 Items for set menu/group items');
		   redirect("itemmanage/item_food/addgroupfood");
		   }
	  /****************image Upload*************/
	    $config['upload_path']          = 'application/modules/itemmanage/assets/images/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 100000;
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('picture'))
		{
				$error = array('error' => $this->upload->display_errors());
				$img='';
				$big='';
				$medium='';
				$small='';
		}
		else
		{	
				 if(!empty($id)) {
					 $imageinfo=$this->db->select('*')->from('tem_foods')->where('ProductsID',$id)->get()->row();
					 unlink($imageinfo->ProductImage);
					 unlink($imageinfo->bigthumb);
					 unlink($imageinfo->medium_thumb);
					 unlink($imageinfo->small_thumb);
					 }
				
				$fdata =$this->upload->data();
			
				$image_sizes = array('big'=>array(555,370), 'medium' => array(268,223),'small' => array(116,116));
				$this->load->library('image_lib');
            foreach ($image_sizes as $key=>$resize) {
                $config1 = array(
                    'source_image' => $fdata['full_path'],
                    'new_image' => $fdata['file_path'].$key.'/',
                    'maintain_ratio' => FALSE,
                    'width' => $resize[0],
                    'height' => $resize[1],
                    'quality' =>70,
                );
                $this->image_lib->initialize($config1);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
			 $this->load->library('image_lib', $config);
             $this->image_lib->resize();  
	    $big='application/modules/itemmanage/assets/images/big/'.$fdata['file_name'];
		$medium='application/modules/itemmanage/assets/images/medium/'.$fdata['file_name'];
		$small='application/modules/itemmanage/assets/images/small/'.$fdata['file_name'];
		$img = 'application/modules/itemmanage/assets/images/'.$fdata['file_name'];          
		}
		
	
	  /****************end*********************/
	   if (empty($this->input->post('ProductsID'))) {
		$this->permission->method('itemmanage','create')->redirect();
		$data['foodlist']   = (Object) $postData = array(
	   'ProductsID'     		=> $this->input->post('ProductsID'),
	   'CategoryID'     		=> $this->input->post('CategoryID'), 
	   'ProductName'   			=> $this->input->post('foodname',true),
	   'component'              => $this->input->post('component',true),
	   'itemnotes'              => $this->input->post('itemnotes',true),
	   'menutype'              => $uniqueStr,
	   'descrip'                => $this->input->post('descrip',true),
	   'kitchenid'             =>  0,
	   'isgroup'               =>  1,
	   'cookedtime'             => $this->input->post('cookedtime',true),
	   'productvat'             => $myvat,
	   'OffersRate'             => $OffersRate,
	   'special'       			=> $special,
	   'offerIsavailable'       => $isoffer,
	   'offerstartdate'         => $convertstartdate,
	   'offerendate'            => $convertenddate,
	   'ProductsIsActive'   	=> $this->input->post('status'),
	   'ProductImage'      		=> $img,
	   'bigthumb'      			=> $big,
	   'medium_thumb'      		=> $medium,
	   'small_thumb'      		=> $small,
	   'UserIDInserted'     	=> $savedid,
	   'UserIDUpdated'      	=> $savedid,
	   'UserIDLocked'       	=> $savedid,
	   'DateInserted'       	=> date('Y-m-d H:i:s'),
	   'DateUpdated'        	=> date('Y-m-d H:i:s'),
	   'DateLocked'         	=> date('Y-m-d H:i:s'),
	  );
	  $logData = array(
	   'action_page'         => "Add Food",
	   'action_done'     	 => "Insert Data", 
	   'remarks'             => "New Food Added",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	    $taxsettings = $this->taxchecking();
		if(!empty($taxsettings)){
			$tx=0;
			$taxitems= array();
			foreach ($taxsettings as $taxitem) {
				$filedtax = 'tax'.$tx;
					$taxitems[$filedtax] = $this->input->post($filedtax,true);
				$tx++;
			}
			$postData = array_merge($postData,$taxitems);
		}
		if ($this->fooditem_model->groupfood_create($postData)) { 
		   $this->session->set_flashdata('message', display('save_successfully'));
		   $this->logs_model->log_recorded($logData);
			$this->db->select('*');
			$this->db->from('item_foods');
			$this->db->where('ProductsIsActive',1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label'=>$row->ProductName,'value'=>$row->ProductsID);
			}
			$cache_file = './assets/js/product.json';
			$productList = json_encode($json_product);
			file_put_contents($cache_file,$productList);			
		} else {
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		}
		 redirect('itemmanage/item_food/addgroupfood');
	   } else {
		$this->permission->method('itemmanage','update')->redirect();
		if(empty($img)){
			$img=$this->input->post('old_image',true);
			$big=$this->input->post('bigimage',true);
			$medium=$this->input->post('mediumimage',true);
			$small=$this->input->post('smallimage',true);
			}
		$data['category']   = (Object) $postData = array(
	   'ProductsID'     		=> $this->input->post('ProductsID'),
	   'CategoryID'     		=> $this->input->post('CategoryID'), 
	   'ProductName'   			=> $this->input->post('foodname',true),
	   'component'              => $this->input->post('component',true),
	   'itemnotes'              => $this->input->post('itemnotes',true),
	   'menutype'               => $uniqueStr,
	   'descrip'                => $this->input->post('descrip',true),
	   'productvat'             => $this->input->post('vat',true),
	   'kitchenid'              => 0,
	   'isgroup'                =>  1,
	   'cookedtime'             => $this->input->post('cookedtime',true),
	   'OffersRate'             => $OffersRate,
	   'special'       			=> $special,
	   'offerIsavailable'       => $isoffer,
	   'offerstartdate'         => $convertstartdate,
	   'offerendate'            => $convertenddate,
	   'ProductsIsActive'   	=> $this->input->post('status',true),
	   'ProductImage'      		=> $img,
	   'bigthumb'      			=> $big,
	   'medium_thumb'      		=> $medium,
	   'small_thumb'      		=> $small,

	   'UserIDUpdated'      => $savedid,
	   'DateUpdated'        => date('Y-m-d H:i:s'),
	  );
	  $logData = array(
	   'action_page'         => "Food List",
	   'action_done'     	 => "Update Data", 
	   'remarks'             => "Food Updated",
	   'user_name'           => $this->session->userdata('fullname',true),
	   'entry_date'          => date('Y-m-d H:i:s'),
	  );
	  $taxsettings = $this->taxchecking();
		if(!empty($taxsettings)){
			$tx=0;
			$taxitems= array();
			foreach ($taxsettings as $taxitem) {
				$filedtax = 'tax'.$tx;
					$taxitems[$filedtax] = $this->input->post($filedtax,true);
				$tx++;
			}
			$postData = array_merge($postData,$taxitems);
		}	
		
	 
		if ($this->fooditem_model->update_groupfooditem($postData)) { 
		$this->logs_model->log_recorded($logData);
		    $this->db->select('*');
			$this->db->from('item_foods');
			$this->db->where('ProductsIsActive',1);
			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$json_product[] = array('label'=>$row->ProductName,'value'=>$row->ProductsID);
			}
			$cache_file = './assets/js/product.json';
			$productList = json_encode($json_product);
			file_put_contents($cache_file,$productList);
		 $this->session->set_flashdata('message', display('update_successfully'));
		} else {
		$this->session->set_flashdata('exception',  display('please_try_again'));
		}
		redirect("itemmanage/item_food/addgroupfood/".$postData['ProductsID']);  
	   }
	  } else { 
	  $data['taxitems'] = $this->taxchecking();
	   if(!empty($id)) {
		$data['title'] = display('update_group_item');
		$data['productinfo']   = $this->fooditem_model->findBygroupId($id);
		$data['groupsitem']   = $this->fooditem_model->allgroupitem($id);
	   }
	   
	   $data['categories']   =  $this->category_model->allcategory_dropdown();
	   $data['allkitchen']   =  $this->fooditem_model->allkitchen();
	   $data['todaymenu']   =  $this->todaymenu_model->read_menulist();
	   $data['module'] = "itemmanage";
	   $data['page']   = "addgroupitem";   
	   echo Modules::run('template/layout', $data); 
	   }   
 
    }
	private function taxchecking()
    {
		$taxinfos = '';
    	if ($this->db->table_exists('tbl_tax')) {
    		$taxsetting = $this->db->select('*')->from('tbl_tax')->get()->row();
    	}
    	if($taxsetting->tax == 1){
    	$taxinfos = $this->db->select('*')->from('tax_settings')->get()->result_array();
    		}
    		
          return $taxinfos;

    }
	public function checkfood(){
		$food=$this->input->post('q',true);
		$product_info 	= $this->fooditem_model->findfooditem($food);
		   $list[''] = '';
		foreach ($product_info as $value) {
			$json_product[] = array('label'=>$value['ProductName'].'_'.$value['variantName'],'value'=>$value['ProductsID'],"varientid"=>$value['variantid'],"variantName"=>$value['variantName'],"ProductName"=>$value['ProductName'],"price"=>$value['price']);
		} 
        echo json_encode($json_product);
		}
 
}
