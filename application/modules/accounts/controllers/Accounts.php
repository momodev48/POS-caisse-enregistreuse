<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends MX_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'accounts_model'
		));	
		$this->db->query('SET SESSION sql_mode = ""');
	}


		public function C_O_A() 
	{ 
    $this->permission->method('accounts','read')->redirect();
    	$data['title'] = display('act');
		$data['module'] = "accounts";
		$data['page']   = "coa";   
		echo Modules::run('template/layout', $data); 
	}


    // tree view controller
    public function show_tree($id = null){
    	$this->permission->method('accounts','read')->redirect();
       
        $id      = ($id ?$id :2);

        $data = array(
            'userList' => $this->accounts_model->get_userlist(),
            'userID' => set_value('userID'),
        );
		$data['coa_head']=$this->accounts_model->get_coahead();
		$data['allheadname']=$this->accounts_model->allphead_dropdown('COA');
	
		 $data['title'] = display('act');
		$data['module'] = "accounts";
		$data['page']   = "treeview";   
		echo Modules::run('template/layout', $data); 
    }
 public function selectphead(){
		 $this->permission->method('accounts','read')->redirect();
		 $phead=$this->input->post('phead',true);
		 $coa_phead=$this->accounts_model->allphead_dropdown($phead);
		  echo $allphead=$this->allphead($coa_phead);
		
	 }
  function allphead($data){
	  echo '<option value="" class="bolden" data-id="0"><strong>'.$menu->HeadName.'</strong></option>';
	foreach($data as $menu){
		echo '<option value="'.$menu->HeadCode.'" class="bolden" data-id="'.$menu->HeadLevel.'" data-phead="'.$menu->HeadName.'"><strong>'.$menu->HeadName.'</strong></option>';
		if(!empty($menu->sub)){
			$this->all_subphead($menu->sub);
		}
	}
}

function all_subphead($sub_menu){
	foreach($sub_menu as $menu){
		echo '<option value="'.$menu->HeadCode.'" data-id="'.$menu->HeadLevel.'" data-phead="'.$menu->HeadName.'">&nbsp;&nbsp;&mdash;'.$menu->HeadName.'</option>';
		if(!empty($menu->sub)){
			$this->all_subphead($menu->sub);
		}		
	}
}

  public function selectedform($id){

		$role_reult = $this->db->select('*')
						->from('acc_coa')
						->where('HeadCode',$id)
						->get()
						->row();

					$baseurl = base_url().'/'.'accounts/accounts/insert_coa';
	

		if ($role_reult) {
			$html = "";
			$html .= "
        <form name=\"form\" id=\"form\" action=\"".$baseurl."\" method=\"post\" enctype=\"multipart/form-data\">
                <div id=\"newData\">
   <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
    
      <tr>
        <td>Head Code</td>
        <td><input type=\"text\" name=\"txtHeadCode\" id=\"txtHeadCode\" class=\"form_input\"  value=\"".$role_reult->HeadCode."\" readonly=\"readonly\"/></td>
      </tr>
      <tr>
        <td>Head Name</td>
        <td><input type=\"text\" name=\"txtHeadName\" id=\"txtHeadName\" class=\"form_input\" value=\"".$role_reult->HeadName."\"/>
<input type=\"hidden\" name=\"HeadName\" id=\"HeadName\" class=\"form_input\" value=\"".$role_reult->HeadName."\"/>
        </td>
      </tr>
      <tr>
        <td>Parent Head</td>
        <td><input type=\"text\" name=\"txtPHead\" id=\"txtPHead\" class=\"form_input\" readonly=\"readonly\" value=\"".$role_reult->PHeadName."\"/></td>
      </tr>
      <tr>

        <td>Head Level</td>
        <td><input type=\"text\" name=\"txtHeadLevel\" id=\"txtHeadLevel\" class=\"form_input\" readonly=\"readonly\" value=\"".$role_reult->HeadLevel."\"/></td>
      </tr>
       <tr>
        <td>Head Type</td>
        <td><input type=\"text\" name=\"txtHeadType\" id=\"txtHeadType\" class=\"form_input\" readonly=\"readonly\" value=\"".$role_reult->HeadType."\"/></td>
      </tr>

       <tr>
        <td>&nbsp;</td>
        <td><input type=\"checkbox\" name=\"IsTransaction\" value=\"1\" id=\"IsTransaction\" size=\"28\"  onchange=\"IsTransaction_change();\"";
        	if($role_reult->IsTransaction==1){ $html .="checked";}

        $html .="/><label for=\"IsTransaction\"> Transaction</label>
        <input type=\"checkbox\" value=\"1\" name=\"IsActive\" id=\"IsActive\"";
       if($role_reult->IsActive==1){ $html .="checked";}
         $html .=" size=\"28\" checked=\"\" /><label for=\"IsActive\"> Active</label>
        <input type=\"checkbox\" value=\"1\" name=\"IsGL\" id=\"IsGL\" size=\"28\"";
         if($role_reult->IsGL==1){ $html .="checked";}
        $html .=" onchange=\"IsGL_change();\"/><label for=\"IsGL\"> GL</label>

        </td>
      </tr>
       <tr>
                    <td>&nbsp;</td>
                    <td>";
                   if( $this->permission->method('accounts','create')->access()):
                    $html .="<input type=\"button\" name=\"btnNew\" id=\"btnNew\" value=\"New\" onClick=\"newdata(".$role_reult->HeadCode.")\" />
                     <input type=\"submit\" name=\"btnSave\" id=\"btnSave\" value=\"Save\" disabled=\"disabled\"/>";
                     endif;
               if($this->permission->method('accounts','update')->access()):
           $html .=" <input type=\"submit\" name=\"btnUpdate\" id=\"btnUpdate\" value=\"Update\" />";
              endif;
                   $html .=" </td>
                  </tr>
      
    </table>
 </form>
			";
		}
		echo json_encode($html);
	}

  public function newform($id){

    $newdata = $this->db->select('*')
            ->from('acc_coa')
            ->where('HeadCode',$id)
            ->get()
            ->row();

           
  $newidsinfo = $this->db->select('*,count(HeadCode) as hc')
            ->from('acc_coa')
            ->where('PHeadName',$newdata->HeadName)
            ->get()
            ->row();

$nid  = $newidsinfo->hc;
$n =$nid + 1;
if ($n / 10 < 1)
  $HeadCode = $id . "0" . $n;
else
  $HeadCode = $id . $n;

  $info['headcode'] =  $HeadCode;
  $info['rowdata'] =  $newdata;
  $info['headlabel'] =  $newdata->HeadLevel+1;
    echo json_encode($info);
  }

  public function insert_coa(){
    $headcode =$this->input->post('txtHeadCode',true);
    $HeadName =$this->input->post('txtHeadName',true);
    $PHeadName =$this->input->post('txtPHead',true);
    $HeadLevel =$this->input->post('txtHeadLevel',true);
    $txtHeadType =$this->input->post('txtHeadType',true);
    $isact =$this->input->post('IsActive',true);
    $IsActive = (!empty($isact)?$isact:0);
    $trns =$this->input->post('IsTransaction',true);
    $IsTransaction = (!empty($trns)?$trns:0);
    $isgl=$this->input->post('IsGL',true);
     $IsGL = (!empty($isgl)?$isgl:0);
    $createby=$this->session->userdata('id');
   
    $createdate=date('Y-m-d H:i:s');
       $postData = array(
		  'HeadCode'       =>  $headcode,
		  'HeadName'       =>  $HeadName,
		  'PHeadName'      =>  $PHeadName,
		  'HeadLevel'      =>  $HeadLevel,
		  'IsActive'       =>  $IsActive,
		  'IsTransaction'  =>  $IsTransaction,
		  'IsGL'           =>  $IsGL,
		  'HeadType'       => $txtHeadType,
		  'IsBudget'       => 0,
		  'CreateBy'       => $createby,
		  'CreateDate'     => $createdate,
		); 
 $upinfo = $this->db->select('*')
            ->from('acc_coa')
            ->where('HeadCode',$headcode)
            ->get()
            ->row();
            if(empty($upinfo)){
  $this->db->insert('acc_coa',$postData);
}else{

$hname =$this->input->post('HeadName',true);
$updata = array(
'PHeadName'      =>  $HeadName,
);

            
  $this->db->where('HeadCode',$headcode)
      ->update('acc_coa',$postData);
  $this->db->where('PHeadName',$hname)
      ->update('acc_coa',$updata);
}
    redirect($_SERVER['HTTP_REFERER']);
  }
  
  public function insert_coa2(){
	$id=$this->input->post('headcode',true);
    $HeadName =$this->input->post('headname',true);
	$coahead =$this->input->post('coahead',true);
    $PHeadName =$this->input->post('pheadcode',true);
	$newhead = (!empty($PHeadName)?$PHeadName:$coahead);
    $HeadLevel =$this->input->post('headlebel',true);
    $txtHeadType =$this->input->post('headtype',true);
	$newidsinfo = $this->db->select('*,count(HeadCode) as hc')->from('acc_coa')->where('PHeadName',$PHeadName)->get()->row();


$nid  = $newidsinfo->hc;
$n =$nid + 1;
if ($n / 10 < 1)
  $HeadCode = $id . "0" . $n;
else
  $HeadCode = $id . $n;

    $isact =$this->input->post('IsActive',true);
    $IsActive = (!empty($isact)?$isact:0);
    $trns =$this->input->post('IsTransaction',true);
    $IsTransaction = (!empty($trns)?$trns:0);
    $isgl=$this->input->post('IsGL',true);
     $IsGL = (!empty($isgl)?$isgl:0);
    $createby=$this->session->userdata('id');

    $createdate=date('Y-m-d H:i:s');
       $postData = array(
		  'HeadCode'       =>  $HeadCode,
		  'HeadName'       =>  $HeadName,
		  'PHeadName'      =>  $PHeadName,
		  'HeadLevel'      =>  $HeadLevel,
		  'IsActive'       =>  $IsActive,
		  'IsTransaction'  =>  $IsTransaction,
		  'IsGL'           =>  $IsGL,
		  'HeadType'       => $txtHeadType,
		  'IsBudget'       => 0,
		  'CreateBy'       => $createby,
		  'CreateDate'     => $createdate,
		); 

  $this->db->insert('acc_coa',$postData);
  $lastid=$this->db->insert_id();
   if(!empty($lastid)){
	   $this->session->set_flashdata('message', display('save_successfully'));
	   redirect($_SERVER['HTTP_REFERER']);
	 }
	 else{
		 $this->session->set_flashdata('exception',  display('please_try_again'));
		 redirect($_SERVER['HTTP_REFERER']);
		 }
  }
  public function updatecoa($id){
	  
		$this->permission->method('accounts','update')->redirect();
		$data['title'] = display('update');
		$data['intinfo']   = $this->accounts_model->findById($id);
        $data['module'] = "accounts";  
        $data['page']   = "coaedit";
		$this->load->view('accounts/coaedit', $data);   

	   }
 public function updatecoahead(){
	  		$Headcode =$this->input->post('HeadCode',true);
			$HeadName =$this->input->post('headname',true);
			
			if(!empty($this->input->post('IsTransaction',true))){
				$IsTransaction =1;
			}else{
				$IsTransaction =0;
				}
			if(!empty($this->input->post('IsActive',true))){
				$IsActive =1;
			}else{
				$IsActive =0;
				}
			if(!empty($this->input->post('IsGL',true))){
				$IsGL =1;
			}else{
				$IsGL =0;
				}
			$postData = array(
					'HeadCode'                         => $this->input->post('HeadCode',true),
					'HeadName'                         => $this->input->post('headname',true),
					'IsTransaction'                    => $IsTransaction,
					'IsActive'                         => $IsActive,
					'IsGL'                      	   => $IsGL,
				); 
			if ($this->accounts_model->updarecoahead($postData)) { 
					$this->session->set_flashdata('message', display('update_successfully'));
					redirect("accounts/accounts/show_tree");
				} else {
					$this->session->set_flashdata('exception',  display('please_try_again'));
					redirect("accounts/accounts/show_tree");
				}	
	  }
  public function deletehead($id){
	  $this->permission->module('accounts','delete')->redirect();
	  if ($this->accounts_model->head_delete($id)) {
			$this->session->set_flashdata('message',display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception',display('please_try_again'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	  }

  // Debit voucher Create 
  public function debit_voucher(){
    $this->permission->method('accounts','create')->redirect();
    $data['title'] = display('debit_voucher');
    $data['acc'] = $this->accounts_model->Transacc();
    $data['voucher_no'] = $this->accounts_model->voNO();
    $data['crcc'] = $this->accounts_model->Cracc();
    $data['module'] = "accounts";
    $data['page']   = "debit_voucher";   
    echo Modules::run('template/layout', $data); 
  }

  // Debit voucher code select onchange
  public function debtvouchercode($id){
    $debitvcode = $this->db->select('*')
            ->from('acc_coa')
            ->where('HeadCode',$id)
            ->get()
            ->row();
      $code = $debitvcode->HeadCode;   
echo json_encode($code);

  }
  //Create Debit Voucher
 public function create_debit_voucher(){
   $this->permission->method('accounts','create')->redirect();
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->insert_debitvoucher()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounts/accounts/debit_voucher/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("accounts/accounts/debit_voucher");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("accounts/accounts/debit_voucher");
     }

}

// Update Debit voucher 
public function update_debit_voucher(){
   $this->permission->method('accounts','create')->redirect();
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->update_debitvoucher()) { 
          $this->session->set_flashdata('message', display('update_successfully'));
          redirect('accounts/accounts/aprove_v/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("accounts/accounts/aprove_v");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("accounts/accounts/aprove_v");
     }

}

//Credit voucher 
 public function credit_voucher(){
    $this->permission->method('accounts','create')->redirect();
    $data['title'] = display('credit_voucher');
    $data['acc'] = $this->accounts_model->Transacc();
    $data['voucher_no'] = $this->accounts_model->crVno();
    $data['crcc'] = $this->accounts_model->Cracc();
    $data['module'] = "accounts";
    $data['page']   = "credit_voucher";   
    echo Modules::run('template/layout', $data); 
  }

  //Create Credit Voucher
 public function create_credit_voucher(){
   $this->permission->method('accounts','create')->redirect();
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->insert_creditvoucher()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounts/accounts/credit_voucher/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("accounts/accounts/credit_voucher");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("accounts/accounts/credit_voucher");
     }

}
// Contra Voucher form
 public function contra_voucher(){
    $this->permission->method('accounts','create')->redirect();
    $data['title'] = display('contra_voucher');
    $data['acc'] = $this->accounts_model->Transacc();
    $data['voucher_no'] = $this->accounts_model->contra();
    $data['module'] = "accounts";
    $data['page']   = "contra_voucher";   
    echo Modules::run('template/layout', $data); 
  }

  //Create Contra Voucher
 public function create_contra_voucher(){
   $this->permission->method('accounts','create')->redirect();
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->insert_contravoucher()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounts/accounts/contra_voucher/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("accounts/accounts/contra_voucher");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("accounts/accounts/contra_voucher");
     }

}
// Journal voucher
 public function journal_voucher(){
    $this->permission->method('accounts','create')->redirect();
    $data['title'] = display('journal_voucher');
    $data['acc'] = $this->accounts_model->Transacc();
    $data['voucher_no'] = $this->accounts_model->journal();
    $data['module'] = "accounts";
    $data['page']   = "journal_voucher";   
    echo Modules::run('template/layout', $data); 
  }

   //Create Journal Voucher
 public function create_journal_voucher(){
   $this->permission->method('accounts','create')->redirect();
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->insert_journalvoucher()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounts/accounts/journal_voucher/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("accounts/accounts/journal_voucher");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("accounts/accounts/journal_voucher");
     }

}
//Aprove voucher
  public function aprove_v(){
   $this->permission->method('accounts','create')->redirect();
    $data['title'] = display('voucher_approval');
    $data['aprrove'] = $this->accounts_model->approve_voucher();
    $data['module'] = "accounts";
    $data['page']   = "voucher_approve";   
    echo Modules::run('template/layout', $data); 
}
// isApprove
 public function isactive($id = null, $action = null)
  {

    $action = ($action=='active'?1:0);

    $postData = array(
      'VNo'     => $id,
      'IsAppove' => $action
    );

    if ($this->accounts_model->approved($postData)) {
      $this->session->set_flashdata('message', display('successfully_approved'));
    } else {
      $this->session->set_flashdata('exception', display('please_try_again'));
    }

    redirect($_SERVER['HTTP_REFERER']);
  }

  //Update voucher 
  public function voucher_update($id= null){
    $this->permission->method('accounts','Update')->redirect();
    $vtype =$this->db->select('*')
                    ->from('acc_transaction')
                    ->where('VNo',$id)
                    ->get()
                    ->row();
					
    $data['crcc'] = $this->accounts_model->Cracc();
    $data['acc'] = $this->accounts_model->Transacc();
	
                    if($vtype->Vtype =="DV"){
    $data['title'] = display('update_debit_voucher');
    $data['dbvoucher_info'] = $this->accounts_model->dbvoucher_updata($id);
    $data['credit_info'] = $this->accounts_model->crvoucher_updata($id);
    $data['page']   = "update_dbt_crtvoucher";   
    } 
    if($vtype->Vtype =="CV"){
    
    $data['title'] = display('update_credit_voucher');
    $data['crvoucher_info'] = $this->accounts_model->crdtvoucher_updata($id);
    $data['debit_info'] = $this->accounts_model->debitvoucher_updata($id);
    $data['page']   = "update_credit_bdtvoucher";   
    }
	if($vtype->Vtype =="Contra"){
      
    $data['title'] = display('update_contra_voucher');
    $data['crvoucher_info'] = $this->accounts_model->contravoucher_updata($id);
    $data['page']   = "update_contra_voucher";   
    }
	if($vtype->Vtype =="JV"){
     
    $data['title'] = display('update_contra_voucher');
    $data['journal_info'] = $this->accounts_model->journalCrebitVoucher_edit($id);
    $data['page']   = "update_journal_voucher";   
    }
   
    $data['module'] = "accounts";
   
    echo Modules::run('template/layout', $data); 
  }
  // update credit voucher 
  public function update_credit_voucher(){
   $this->permission->method('accounts','create')->redirect();
    $this->form_validation->set_rules('cmbDebit', display('cmbDebit')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->update_creditvoucher()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounts/accounts/aprove_v/');
        }else{
          $this->session->set_flashdata('exception',  display('please_try_again'));
        }
        redirect("accounts/accounts/aprove_v");
    }else{
      $this->session->set_flashdata('exception',  display('please_try_again'));
      redirect("accounts/accounts/aprove_v");
     }

}
 // Debit voucher code select onchange
    public function debit_voucher_code($id) {
        $debitvcode = $this->db->select('*')
                ->from('acc_coa')
                ->where('HeadCode', $id)
                ->get()
                ->row();
        $code = $debitvcode->HeadCode;
        echo json_encode($code);
    }
	// update_contra_voucher
	 public function update_contra_voucher() {
        $voucher_no = addslashes(trim($this->input->post('txtVNo',true)));
        $Vtype = "Contra";
        $dAID = $this->input->post('cmbDebit',true);
        $cAID = $this->input->post('txtCode',true);
        $debit = $this->input->post('txtAmount',true);
        $credit = $this->input->post('txtAmountcr',true);
        $VDate = $this->input->post('dtpDate',true);
        $Narration = addslashes(trim($this->input->post('txtRemarks',true)));
        $IsPosted = 1;
        $IsAppove = 0;
        $CreateBy = $this->session->userdata('user_id');
        $createdate = date('Y-m-d H:i:s');
        if ($voucher_no) {
            $this->db->where('VNo', $voucher_no);
            $this->db->delete('acc_transaction');
        }
        for ($i = 0; $i < count($cAID); $i++) {

            $contrainsert = array(
                'VNo' => $voucher_no,
                'Vtype' => $Vtype,
                'VDate' => $VDate,
                'COAID' => $cAID[$i],
                'Narration' => $Narration,
                'Debit' => $debit[$i],
                'Credit' => $credit[$i],
				'StoreID' => 0,
                'IsPosted' => $IsPosted,
                'UpdateBy' => $CreateBy,
                'UpdateDate' => $createdate,
                'IsAppove' => 0
            );
            $this->db->insert('acc_transaction', $contrainsert);
        }
        $this->session->set_flashdata('message', display('save_successfully'));
        redirect("accounts/accounts/aprove_v");
    }
	//    ============== its for update_journal_voucher ==============
    public function update_journal_voucher() {
        $voucher_no = addslashes(trim($this->input->post('txtVNo',true)));
        $Vtype = "JV";
        $dAID = $this->input->post('cmbDebit',true);
        $cAID = $this->input->post('txtCode',true);
        $debit = $this->input->post('txtAmount',true);
        $credit = $this->input->post('txtAmountcr',true);
        $VDate = $this->input->post('dtpDate',true);
        $Narration = addslashes(trim($this->input->post('txtRemarks',true)));
        $IsPosted = 1;
        $IsAppove = 0;
        $CreateBy = $this->session->userdata('user_id');
        $createdate = date('Y-m-d H:i:s');
        if ($voucher_no) {

            $this->db->where('VNo', $voucher_no);
            $this->db->delete('acc_transaction');
        }

        for ($i = 0; $i < count($cAID); $i++) {

            $contrainsert = array(
                'VNo' => $voucher_no,
                'Vtype' => $Vtype,
                'VDate' => $VDate,
                'COAID' => $cAID[$i],
                'Narration' => $Narration,
                'Debit' => $debit[$i],
                'Credit' => $credit[$i],

                'IsPosted' => $IsPosted,
                'UpdateBy' => $CreateBy,
                'UpdateDate' => $createdate,
                'IsAppove' => 0
            );

            $this->db->insert('acc_transaction', $contrainsert);
        }

        $this->session->set_flashdata('message', display('save_successfully'));
        redirect("accounts/accounts/aprove_v");
    }
 //Trial Balannce
    public function trial_balance(){
        $data['title']  = display('trial_balance');
        $data['module'] = "accounts";
        $data['page']   = "trial_balance";
        echo Modules::run('template/layout', $data);
    }
    //Trial Balance Report
    public function trial_balance_report(){
       $dtpFromDate     = $this->input->post('dtpFromDate',true);
       $dtpToDate       = $this->input->post('dtpToDate',true);
       $chkWithOpening  = $this->input->post('chkWithOpening',true);

       $results         = $this->accounts_model->trial_balance_report($dtpFromDate,$dtpToDate,$chkWithOpening);

       if ($results['WithOpening']) {
            $data['oResultTr']    = $results['oResultTr'];
            $data['oResultInEx']  = $results['oResultInEx'];
            $data['dtpFromDate']  = $dtpFromDate;
            $data['dtpToDate']    = $dtpToDate;

            // PDF Generator 
            $this->load->library('pdfgenerator');
            $dompdf = new DOMPDF();
            $page = $this->load->view('accounts/trial_balance_with_opening_pdf',$data,true);
            $dompdf->load_html($page);
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents('assets/data/pdf/Trial Balance With Opening As On '.$dtpFromDate.' To '.$dtpToDate.'.pdf', $output);


            $data['pdf']    = 'assets/data/pdf/Trial Balance With Opening As On '.$dtpFromDate.' To '.$dtpToDate.'.pdf';
            $data['title']  = display('trial_balance_report');
            $data['module'] = "accounts";
            $data['page']   = "trial_balance_with_opening";
            echo Modules::run('template/layout', $data);
       }else{

            $data['oResultTr']    = $results['oResultTr'];
            $data['oResultInEx']  = $results['oResultInEx'];
            $data['dtpFromDate']  = $dtpFromDate;
            $data['dtpToDate']    = $dtpToDate;

            // PDF Generator 
            $this->load->library('pdfgenerator');
            $dompdf = new DOMPDF();
            $page = $this->load->view('accounts/trial_balance_without_opening_pdf',$data,true);
            $dompdf->load_html($page);
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents('assets/data/pdf/Trial Balance As On '.$dtpFromDate.' To '.$dtpToDate.'.pdf', $output);
            $data['pdf']    = 'assets/data/pdf/Trial Balance As On '.$dtpFromDate.' To '.$dtpToDate.'.pdf';

            $data['title']  = display('trial_balance_report');
            $data['module'] = "accounts";
            $data['page']   = "trial_balance_without_opening";
            echo Modules::run('template/layout', $data);
       }

    }

     //al hassan working
    public function vouchar_cash($date){
        $vouchar_view = $this->accounts_model->get_vouchar_view($date);
        $data = array(
            'vouchar_view' => $vouchar_view,
        );

        $data['title'] = display('accounts_form');
        $data['module'] = "accounts";
        $data['page']   = "vouchar_cash";
        echo Modules::run('template/layout', $data);
    }
//alhassan working
    public function general_ledger(){

        $general_ledger = $this->accounts_model->get_general_ledger();
        $data = array(
            'general_ledger' => $general_ledger,
        );

        $data['title'] = display('general_ledger');
        $data['module'] = "accounts";
        $data['page']   = "general_ledger";
        echo Modules::run('template/layout', $data);
    }
    //alhassan working
    public function general_led($Headid = NULL){
        $Headid = $this->input->post('Headid');
        $HeadName = $this->accounts_model->general_led_get($Headid);
        echo  "<option>Transaction Head</option>";
        $html = "";
        foreach($HeadName as $data){
            $html .="<option value='$data->HeadCode'>$data->HeadName</option>";
            
        }
        echo $html;
    }
    //al hassan working
    public function voucher_report_serach($vouchar=NULL){
      $vouchar = $this->input->post('vouchar');

        $voucher_report_serach = $this->accounts_model->voucher_report_serach($vouchar);

        if($voucher_report_serach->Amount==''){
             $pay='0.00';
        }else{
             $pay=$voucher_report_serach->Amount;
        }
        $baseurl = base_url().'accounts/accounts/vouchar_cash/'.$vouchar;
         $html = "";
         $html.="<td>
                   <a href=\"$baseurl\">CV-BAC-$vouchar</a>
                 </td>
                 <td>Aggregated Cash Credit Voucher of $vouchar</td>
                 <td>$pay</td>
                 <td align=\"left\">$vouchar</td>";
         echo $html;
    }
    //alhassan working
    public function accounts_report_search(){

        $cmbGLCode = $this->input->post('cmbGLCode',true);
        $cmbCode = $this->input->post('cmbCode',true);

        $dtpFromDate = $this->input->post('dtpFromDate',true);
        $dtpToDate = $this->input->post('dtpToDate',true);
        $chkIsTransction = $this->input->post('chkIsTransction',true);
      
        $HeadName = $this->accounts_model->general_led_report_headname($cmbGLCode);
        $HeadName2 = $this->accounts_model->general_led_report_headname2($cmbGLCode,$cmbCode,$dtpFromDate,$dtpToDate,$chkIsTransction);
        $pre_balance = $this->accounts_model->general_led_report_prebalance($cmbCode,$dtpFromDate);

        $data = array(
            'dtpFromDate' => $dtpFromDate,
            'dtpToDate' => $dtpToDate,
            'HeadName' => $HeadName,
            'HeadName2' => $HeadName2,
            'prebalance' =>  $pre_balance,
            'chkIsTransction' => $chkIsTransction,

        );
        $data['ledger'] = $this->db->select('*')->from('acc_coa')->where('HeadCode',$cmbCode)->get()->row();
        $data['title'] = display('general_ledger_report');
        $data['module'] = "accounts";
        $data['page']   = "general_ledger_report";
        echo Modules::run('template/layout', $data);

    }

    //alhassan working
    public function check_status_report(){
        $get_status = $this->accounts_model->get_status();
        $data = array(
            'get_status' => $get_status,
        );

        $data['title'] = display('general_ledger_report');
        $data['module'] = "accounts";
        $data['page']   = "check_status_report";
        echo Modules::run('template/layout', $data);
    }



    public function cash_book(){
        $data['title'] = display('cash_book');
        $data['module'] = "accounts";
        $data['page']   = "cash_book";
        echo Modules::run('template/layout', $data);
    }
    public function bank_book(){
        $data['title'] = display('bank_book');
        $data['module'] = "accounts";
        $data['page']   = "bank_book";
        echo Modules::run('template/layout', $data);
    }
     public function voucher_report(){
        $this->permission->method('accounts','read')->redirect();
        //al hassan working
        $get_cash = $this->accounts_model->get_cash();
        $get_vouchar= $this->accounts_model->get_vouchar();
        $data = array(
            'get_cash' => $get_cash,
            'get_vouchar' => $get_vouchar,
        );
        $data['title']  = display('voucher_report');
        $data['module'] = "accounts";
        $data['page']   = "coa";   
    echo Modules::run('template/layout', $data); 
  }
   public function coa_print(){
       

        $data['title'] = display('coa_print');
        $data['module'] = "accounts";
        $data['page']   = "coa_print";
        echo Modules::run('template/layout', $data);
    }
     //Profit loss report page
    public function profit_loss_report(){
        $data['title'] = display('profit_loss');
        $data['module'] = "accounts";
        $data['page']   = "profit_loss_report";
        echo Modules::run('template/layout', $data);
    }
    //Profit loss serch result
    public function profit_loss_report_search(){
        $dtpFromDate = $this->input->post('dtpFromDate',true);
        $dtpToDate   = $this->input->post('dtpToDate',true);

        $get_profit  = $this->accounts_model->profit_loss_serach();

        $data['oResultAsset'] = $get_profit['oResultAsset'];
        $data['oResultLiability']  = $get_profit['oResultLiability'];
        $data['dtpFromDate']  = $dtpFromDate;
        $data['dtpToDate']    = $dtpToDate;
        $data['pdf']    = 'assets/data/pdf/Statement of Comprehensive Income From '.$dtpFromDate.' To '.$dtpToDate.'.pdf';
        $data['title']  = display('profit_loss');
        $data['module'] = "accounts";
        $data['page']   = "profit_loss_report_search";
        echo Modules::run('template/layout', $data);
    }
    //Cash flow page
    public function cash_flow_report(){
        $data['title']  = display('cash_flow');
        $data['module'] = "accounts";
        $data['page']   = "cash_flow_report";
        echo Modules::run('template/layout', $data);
    }
    //Cash flow report search
    public function cash_flow_report_search(){
        $dtpFromDate = $this->input->post('dtpFromDate',true);
        $dtpToDate   = $this->input->post('dtpToDate',true);

        $data['dtpFromDate']  = $dtpFromDate;
        $data['dtpToDate']    = $dtpToDate;

        // PDF Generator 
        $this->load->library('pdfgenerator');
        $dompdf = new DOMPDF();
        $page = $this->load->view('accounts/cash_flow_report_search_pdf',$data,true);
        $dompdf->load_html($page);
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents('assets/data/pdf/Cash Flow Statement '.$dtpFromDate.' To '.$dtpToDate.'.pdf', $output);

        $data['pdf']    = 'assets/data/pdf/Cash Flow Statement '.$dtpFromDate.' To '.$dtpToDate.'.pdf';
        $data['title']  = display('cash_flow');
        $data['module'] = "accounts";
        $data['page']   = "cash_flow_report_search";
        echo Modules::run('template/layout', $data);
    }
	//Supplier payment information 
	 //Supplier code 
    public function supplier_headcode($id){
$supplier_info = $this->db->select('supName,suplier_code')->from('supplier')->where('supid',$id)->get()->row();
$head_name =$supplier_info->suplier_code.'-'.$supplier_info->supName;
    $supplierhcode = $this->db->select('*')
            ->from('acc_coa')
            ->where('HeadName',$head_name)
            ->get()
            ->row();
      $code = $supplierhcode->HeadCode;       
echo json_encode($code);

   }
    public function supplier_payments(){
		$this->permission->method('accounts','read')->redirect();
        $data['supplier_list']= $this->accounts_model->get_supplier();
       
        $data['voucher_no'] = $this->accounts_model->Spayment();
        $data['title']  = display('supplier_payment');
        $data['module'] = "accounts";
        $data['page']   = "supplier_payment_form";
        echo Modules::run('template/layout', $data);
    }
public function banklist(){
		$allbank=$this->db->select("*")->from('tbl_bank')->get()->result();
		echo json_encode($allbank);
		}
    //supplier payment submit
     public function create_supplier_payment(){

    $this->form_validation->set_rules('txtCode', display('txtCode')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->supplier_payment_insert()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounts/accounts/supplier_payment/');
        }else{
          $this->session->set_flashdata('error_message',  display('please_try_again'));
        }
        redirect("accounts/accounts/supplier_payment");
    }else{
      $this->session->set_flashdata('error_message',  display('please_try_again'));
      redirect("accounts/accounts/supplier_payment");
     }
}
	 public function supplier_paymentreceipt($supplier_id,$voucher_no,$coaid){
		$this->permission->method('accounts','read')->redirect();
		$seting=$this->db->select("*")->from('setting')->get()->row();
		$currencyinfo=$this->db->select("*")->from('currency')->where('currencyid',$seting->currency)->get()->row();
		$data['currency']=$currencyinfo->curr_icon;
		$data['position']=$currencyinfo->position;
		$data['supplier_info'] = $this->accounts_model->supplierinfo($supplier_id);
	
		$data['payment_info']  = $this->accounts_model->supplierpaymentinfo($voucher_no,$coaid);
		$data['company_info']  = $seting;
		$data['currency']      = $currency_details[0]['currency'];
		$data['position']      = $currency_details[0]['currency_position'];
		$data['title']         = display('supplier_payment');
		$data['module'] = "accounts";
		 $data['page']   = "supplier_payment_receipt";
        echo Modules::run('template/layout', $data);
	}
	
	// cash adjustment
  public function cash_adjustment(){
	    $this->permission->method('accounts','read')->redirect();
        $data['voucher_no'] = $this->accounts_model->Cashvoucher();
        $data['title']  = display('cash_adjustment');
        $data['module'] = "accounts";
        $data['page']   = "cash_adjustment";
        echo Modules::run('template/layout', $data);
  }

    //Create Cash Adjustment
 public function create_cash_adjustment(){
    $this->permission->method('accounts','read')->redirect();
    $this->form_validation->set_rules('txtAmount', display('amount')  ,'max_length[100]');
         if ($this->form_validation->run()) { 
        if ($this->accounts_model->insert_cashadjustment()) { 
          $this->session->set_flashdata('message', display('save_successfully'));
          redirect('accounts/accounts/cash_adjustment/');
        }else{
          $this->session->set_flashdata('error_message',  display('please_try_again'));
        }
        redirect("accounts/accounts/cash_adjustment");
    }else{
      $this->session->set_flashdata('error_message',  display('please_try_again'));
      redirect("accounts/accounts/cash_adjustment");
     }
   }
  public function balance_sheet()
    {
    $data['title']       = display('balance_sheet');
    $from_date           = (!empty($this->input->post('dtpFromDate'))?$this->input->post('dtpFromDate'):date('Y-m-d'));
    $to_date             = (!empty($this->input->post('dtpToDate'))?$this->input->post('dtpToDate'):date('Y-m-d'));
    $data['from_date']   = $from_date;
    $data['to_date']     = $to_date;
    $data['fixed_assets']= $this->accounts_model->fixed_assets();
    $data['liabilities'] = $this->accounts_model->liabilities_data();
    $data['incomes']     = $this->accounts_model->income_fields();
    $data['expenses']    = $this->accounts_model->expense_fields();
    $data['module']      = "accounts";
    $data['page']        = "balance_sheet"; 
    echo Modules::run('template/layout', $data);
    } 

}
