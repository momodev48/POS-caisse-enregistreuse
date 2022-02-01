<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model extends CI_Model {


     function get_userlist()
    {
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('IsActive',1);
        $this->db->order_by('HeadName');
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
	function get_coahead()
    {
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('PHeadName','COA');
		$this->db->where('IsActive',1);
        $this->db->order_by('HeadName');
        $query = $this->db->get();
	
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
	public function allphead_dropdown($pheadname){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('PHeadName',$pheadname);
		$this->db->where('IsActive',1);
        $this->db->order_by('HeadName');
        $query = $this->db->get();
        $pheadlist = $query->result();
        $i=0;
        foreach($pheadlist as $p_cat){
	
            $pheadlist[$i]->sub = $this->sub_parents($p_cat->HeadName);
            $i++;
        }
        return $pheadlist;
    }
    public function sub_parents($pheadname){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('PHeadName',$pheadname);
		$this->db->where('IsActive',1);
        $this->db->order_by('HeadName');

        $child = $this->db->get();
        $pheadlist = $child->result();
        $i=0;
        foreach($pheadlist as $p_cat){
            $pheadlist[$i]->sub = $this->sub_parents($p_cat->HeadName);
            $i++;
        }
        return $pheadlist;       
    }
	public function findById($id = null)
	{ 
		return $this->db->select("*")->from('acc_coa')
			->where('HeadCode',$id) 
			->get()
			->row();
	} 
	function updarecoahead($data = array()){
		return $this->db->where('HeadCode', $data["HeadCode"])
			->update("acc_coa", $data);
		}
	function head_delete($id){
			$this->db->where('HeadCode',$id)->delete('acc_coa');
		    if ($this->db->affected_rows()) {
			return true;
			} else {
			return false;
			}
		}
		
		
    function dfs($HeadName,$HeadCode,$oResult,$visit,$d)
    {
        if($d==0) echo "<li>$HeadName";
        else      echo "<li><a href='javascript:' onclick=\"loadData('".$HeadCode."')\">$HeadName</a>";
        $p=0;
        for($i=0;$i< count($oResult);$i++)
        {

            if (!$visit[$i])
            {
                if ($HeadName==$oResult[$i]->PHeadName)
                {
                    $visit[$i]=true;
                    if($p==0) echo "<ul>";
                    $p++;
                    $this->dfs($oResult[$i]->HeadName,$oResult[$i]->HeadCode,$oResult,$visit,$d+1);
                }
            }
        }
        if($p==0)
            echo "</li>";
        else
            echo "</ul>";
    }

// Accounts list
    public function Transacc()
    {
      return  $data = $this->db->select("*")
            ->from('acc_coa')
            ->where('IsTransaction', 1)  
            ->where('IsActive', 1) 
            ->order_by('HeadName')
            ->get()
            ->result();
    }
	
// Credit Account Head
     public function Cracc()
    {
      return  $data = $this->db->select("*")
            ->from('acc_coa') 
            ->like('HeadCode',1020102, 'after')
            ->where('IsTransaction', 1) 
            ->order_by('HeadName')
            ->get()
            ->result();
    }
	
    // Insert Debit voucher 
    public function insert_debitvoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo',true)));
            $Vtype="DV";
            $cAID = $this->input->post('cmbDebit',true);
            $dAID = $this->input->post('txtCode',true);
            $Debit =$this->input->post('txtAmount',true);
            $Credit= $this->input->post('grand_total',true);
            $VDate = $this->input->post('dtpDate',true);
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $cAID,
      'Narration'      =>  $Narration,
      'Debit'          =>  0,
      'Credit'         =>  $Credit,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 

       $this->db->insert('acc_transaction',$cinsert);
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $dbtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  $Damnt,
      'Credit'         =>  0,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
         
              $this->db->insert('acc_transaction',$debitinsert);

    }
    return true;
}

// Update debit voucher
   public function update_debitvoucher(){
           $voucher_no = $this->input->post('txtVNo',true);
            $Vtype="DV";
            $cAID = $this->input->post('cmbDebit',true);
            $dAID = $this->input->post('txtCode',true);
            $Debit =$this->input->post('txtAmount',true);
            $Credit= $this->input->post('grand_total',true);
            $VDate = $this->input->post('dtpDate',true);
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $cAID,
      'Narration'      =>  $Narration,
      'Debit'          =>  0,
      'Credit'         =>  $Credit,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
            $this->db->where('VNo',$voucher_no)
            ->delete('acc_transaction');

       $this->db->insert('acc_transaction',$cinsert);
            for ($i=0; $i < count($dAID); $i++) {
                $dbtid=$dAID[$i];
                $Damnt=$Debit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $dbtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  $Damnt,
      'Credit'         =>  0,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
           
              $this->db->insert('acc_transaction',$debitinsert);

    }
    return true;
}
//Generate Voucher No
public function voNO()
    {
      return  $data = $this->db->select("Max(VNo) as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'DV-', 'after')
            ->get()
            ->row();
          
    }
    // Credit voucher no
    public function crVno()
    {
      return  $data = $this->db->select("Max(VNo) as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'CV-', 'after')
            ->get()
            ->row();
          
    }

 // Contra voucher 

    public function contra()
    {
      return  $data = $this->db->select("Max(VNo) as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'Contra-', 'after')
            ->get()
            ->row();
           
    }


  // Insert Credit voucher 
    public function insert_creditvoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo',true)));
            $Vtype="CV";
            $dAID = $this->input->post('cmbDebit',true);
            $cAID = $this->input->post('txtCode',true);
            $Credit =$this->input->post('txtAmount',true);
            $debit= $this->input->post('grand_total',true);
            $VDate = $this->input->post('dtpDate',true);
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $dAID,
      'Narration'      =>  $Narration,
      'Debit'          =>  $debit,
      'Credit'         =>  0,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 

       $this->db->insert('acc_transaction',$cinsert);
            for ($i=0; $i < count($cAID); $i++) {
                $crtid=$cAID[$i];
                $Cramnt=$Credit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $crtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  0,
      'Credit'         =>  $Cramnt,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
        
              $this->db->insert('acc_transaction',$debitinsert);

    }
    return true;
}

// Insert Countra voucher 
     public function insert_contravoucher() {
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
                'CreateBy' => $CreateBy,
                'CreateDate' => $createdate,
                'IsAppove' => 0
            );
            $this->db->insert('acc_transaction', $contrainsert);
        }
        return true;
    }
// Insert journal voucher 
    public function insert_journalvoucher() {
        $voucher_no = addslashes(trim($this->input->post('txtVNo',true)));
        $Vtype = "JV";
        $dAID = $this->input->post('cmbDebit');
        $cAID = $this->input->post('txtCode');
        $debit = $this->input->post('txtAmount');
        $credit = $this->input->post('txtAmountcr');
        $VDate = $this->input->post('dtpDate');
        $Narration = addslashes(trim($this->input->post('txtRemarks',true)));
        $IsPosted = 1;
        $IsAppove = 0;
        $CreateBy = $this->session->userdata('user_id');
        $createdate = date('Y-m-d H:i:s');


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
                'CreateBy' => $CreateBy,
                'CreateDate' => $createdate,
                'IsAppove' => 0
            );

            $this->db->insert('acc_transaction', $contrainsert);
        }

        return true;
    }
// journal voucher
public function journal()
    {
      return  $data = $this->db->select("Max(VNo) as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'Journal-', 'after')
            ->get()
            ->row();
     
    }

    // voucher Aprove 
    public function approve_voucher(){
        $values = array("DV", "CV", "JV","Contra");
      
       return $approveinfo = $this->db->select('*,SUM(Debit) as totaldebit,SUM(Credit) as totalcredit')
                               ->from('acc_transaction')
                               ->where_in('Vtype',$values)
                               ->where('IsAppove',0)
                               ->group_by('VNo')
                               ->get()
                               ->result();
                            

    }
//approved
        public function approved($data = [])
    {
        return $this->db->where('VNo',$data['VNo'])
            ->update('acc_transaction',$data); 
    } 

    //debit update voucher
    public function dbvoucher_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Credit <',1)
                 ->get()
                 ->result();

    }

     //credit voucher update 
    public function crdtvoucher_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Debit <',1)
                 ->get()
                 ->result();

    }
	
	 public function journalCrebitVoucher_edit($id) {
        return $vou_info = $this->db->select('*')
                ->from('acc_transaction')
                ->where('VNo', $id)
                ->get()
                ->result();
    }
    //Debit voucher inof
     //credit voucher update 
    public function debitvoucher_updata($id){
      return $cr_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Credit<',1)
                 ->get()
                 ->row();
    }
     // debit update voucher credit info
    public function crvoucher_updata($id){
       return $v_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->where('Debit<',1)
                 ->get()
                 ->row();
    }

    // update Credit voucher
     public function update_creditvoucher(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo',true)));
            $Vtype="CV";
            $dAID = $this->input->post('cmbDebit',true);
            $cAID = $this->input->post('txtCode',true);
            $Credit =$this->input->post('txtAmount',true);
            $debit= $this->input->post('grand_total',true);
            $VDate = $this->input->post('dtpDate',true);
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $IsPosted=1;
            $IsAppove=0;
            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

            $cinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $dAID,
      'Narration'      =>  $Narration,
      'Debit'          =>  $debit,
      'Credit'         =>  0,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
              $this->db->where('VNo',$voucher_no)
            ->delete('acc_transaction');

       $this->db->insert('acc_transaction',$cinsert);
            for ($i=0; $i < count($cAID); $i++) {
                $crtid=$cAID[$i];
                $Cramnt=$Credit[$i];
           
            $debitinsert = array(
      'VNo'            =>  $voucher_no,
      'Vtype'          =>  $Vtype,
      'VDate'          =>  $VDate,
      'COAID'          =>  $crtid,
      'Narration'      =>  $Narration,
      'Debit'          =>  0,
      'Credit'         =>  $Cramnt,
      'StoreID'        => 0,
      'IsPosted'       => $IsPosted,
      'CreateBy'       => $CreateBy,
      'CreateDate'     => $createdate,
      'IsAppove'       => 0
    ); 
      
              $this->db->insert('acc_transaction',$debitinsert);

    }
    return true;
}
 //contra voucher update 
    public function contravoucher_updata($id){
      return  $vou_info = $this->db->select('*')
                 ->from('acc_transaction')
                 ->where('VNo',$id)
                 ->get()
                 ->result();
    }
 //Trial Balance Report 
    public function trial_balance_report($FromDate,$ToDate,$WithOpening){

        if($WithOpening)
            $WithOpening=true;
        else
            $WithOpening=false;

        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND IsActive=1 AND HeadType IN ('A','L') ORDER BY HeadCode";
        $oResultTr = $this->db->query($sql);
        
        $sql="SELECT * FROM acc_coa WHERE IsGL=1 AND IsActive=1 AND HeadType IN ('I','E') ORDER BY HeadCode";
        $oResultInEx = $this->db->query($sql);

        $data = array(
            'oResultTr'   => $oResultTr->result_array(),
            'oResultInEx' => $oResultInEx->result_array(),
            'WithOpening' => $WithOpening
        );

        return $data;
    }

     //al hassan working
      public  function get_vouchar(){


         $date=date('Y-m-d');
          $sql="SELECT VNo, Vtype,VDate, SUM(Debit+Credit)/2 as Amount FROM acc_transaction  WHERE VDate='$date' AND VType IN ('DV','JV','CV') GROUP BY VNO, Vtype, VDate ORDER BY VDate";
        
          $query = $this->db->query($sql);
          return $query->result();
    }
    //al hassan working
    public  function get_vouchar_view($date){
        $sql="SELECT acc_income_expence.COAID,SUM(acc_income_expence.Amount) AS Amount, acc_coa.HeadName FROM acc_income_expence INNER JOIN acc_coa ON acc_coa.HeadCode=acc_income_expence.COAID WHERE Date='$date' AND acc_income_expence.IsApprove=1 AND acc_income_expence.Paymode='Cash' GROUP BY acc_income_expence.COAID, acc_coa.HeadName ORDER BY acc_coa.HeadName";
        $query = $this->db->query($sql);
        return $query->result();
    }
    //al hassan working
    public  function get_cash(){
        $date=date('Y-m-d');


        $sql="SELECT SUM(Debit) as Amount FROM acc_transaction WHERE VDate='$date' AND COAID ='1020101' AND VType NOT IN ('DV','JV','CV') AND IsAppove='1'";
        $query = $this->db->query($sql);
        return $query->row();

    }
    //al hassan working
    public  function get_general_ledger(){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('IsGL',1);
        $this->db->order_by('HeadName', 'asc');
        $query = $this->db->get();
        return $query->result();


    }
    //al hassan working
    public function general_led_get($Headid){

        $sql="SELECT * FROM acc_coa WHERE HeadCode='$Headid' ";
        $query = $this->db->query($sql);
        $rs=$query->row();


        $sql="SELECT * FROM acc_coa WHERE IsTransaction=1 AND PHeadName='".$rs->HeadName."' ORDER BY HeadName";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function voucher_report_serach($vouchar){
       $sql="SELECT SUM(Debit) as Amount FROM acc_transaction WHERE VDate='$vouchar' AND COAID ='1020101' AND VType NOT IN ('DV','JV','CV') AND IsAppove='1'";
        $query = $this->db->query($sql);
        return $query->row();

    }


    public function general_led_report_headname($cmbGLCode){
        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('HeadCode',$cmbGLCode);
        $query = $this->db->get();
        return $query->row();
    }
    public function general_led_report_headname2($cmbGLCode,$cmbCode,$dtpFromDate,$dtpToDate,$chkIsTransction){

            if($chkIsTransction){
       
                $this->db->select('acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Narration, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID,acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.COAID = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('acc_transaction.COAID',$cmbCode);
       

                $query = $this->db->get();
                return $query->result();
            }
            else{
               // $cmbCode1=$cmbCode;
                $this->db->select('acc_transaction.COAID,acc_transaction.Debit, acc_transaction.Credit,acc_coa.HeadName,acc_transaction.IsAppove, acc_coa.PHeadName, acc_coa.HeadType');
                $this->db->from('acc_transaction');
                $this->db->join('acc_coa','acc_transaction.COAID = acc_coa.HeadCode', 'left');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate BETWEEN "'.$dtpFromDate. '" and "'.$dtpToDate.'"');
                $this->db->where('acc_transaction.COAID',$cmbCode);
        
                $query = $this->db->get();
                return $query->result();
            }

    }
    // prebalance calculation
      public function general_led_report_prebalance($cmbCode,$dtpFromDate){

            
                //$cmbCode1=$cmbCode;
                $this->db->select('sum(acc_transaction.Debit) as predebit, sum(acc_transaction.Credit) as precredit');
                $this->db->from('acc_transaction');
                $this->db->where('acc_transaction.IsAppove',1);
                $this->db->where('VDate < ',$dtpFromDate);
                $this->db->where('acc_transaction.COAID',$cmbCode);
                $query = $this->db->get()->row();
                return $balance=$query->predebit - $query->precredit;

    }

    public function get_status(){

        $this->db->select('*');
        $this->db->from('acc_coa');
        $this->db->where('IsTransaction',1);
        $this->db->like('HeadCode','1020102','after');
        $this->db->order_by('HeadName', 'asc');
        $query = $this->db->get();
        return $query->result();
       
    }
   
     //Profict loss report search
    public function profit_loss_serach(){
       
        $sql="SELECT * FROM acc_coa WHERE acc_coa.HeadType='I'";
        $sql1 = $this->db->query($sql);

        $sql="SELECT * FROM acc_coa WHERE acc_coa.HeadType='E'";
        $sql2 = $this->db->query($sql);
        
        $data = array(
          'oResultAsset'     => $sql1->result(),
          'oResultLiability' => $sql2->result(),
        );
        return $data;
    } 
    public function profit_loss_serach_date($dtpFromDate,$dtpToDate){
       $sqlF="SELECT  acc_transaction.VDate, acc_transaction.COAID, acc_coa.HeadName FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode WHERE acc_transaction.VDate BETWEEN '$dtpFromDate' AND '$dtpToDate' AND acc_transaction.IsAppove = 1 AND  acc_transaction.COAID LIKE '301%'";
       $query = $this->db->query($sqlF);
       return $query->result();
    }
	public function get_supplier(){
        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->order_by('supid', 'desc');
        $query = $this->db->get();
        return $query->result();  
    }
  public function Spayment()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'PM-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
       
    }
public function Cashvoucher()
    {
      return  $data = $this->db->select("VNo as voucher")
            ->from('acc_transaction') 
            ->like('VNo', 'CHV-', 'after')
            ->order_by('ID','desc')
            ->get()
            ->row();
         
    }
	public function supplier_payment_insert(){
           $voucher_no = addslashes(trim($this->input->post('txtVNo',true)));
            $Vtype="PM";
            $cAID = $this->input->post('cmbDebit',true);
            $dAID = $this->input->post('txtCode',true);
            $Debit =$this->input->post('txtAmount',true);
			$payment_type=$this->input->post('paytype',true);
			$bakid='';
			if($payment_type==2){
				$bakid=$this->input->post('bank',true);
				$bankinfo =$this->db->select('*')->from('tbl_bank')->where('bankid',$bakid)->get()->row();
			$bankheadcode = $this->db->select('*')->from('acc_coa')->where('HeadName',$bankinfo->bank_name)->get()->row();
			}
            $Credit= 0;
            $VDate = $this->input->post('dtpDate',true);
            $Narration=addslashes(trim($this->input->post('txtRemarks',true)));
            $IsPosted=1;
            $IsAppove=1;
            $sup_id = $this->input->post('supplier_id');

            $CreateBy=$this->session->userdata('id');
           $createdate=date('Y-m-d H:i:s');

                $dbtid=$dAID;
                $Damnt=$Debit;
                $supplier_id = $sup_id;
                $supinfo =$this->db->select('*')->from('supplier')->where('supid',$supplier_id)->get()->row();
            $supplierdebit = array(
			  'VNo'            =>  $voucher_no,
			  'Vtype'          =>  $Vtype,
			  'VDate'          =>  $VDate,
			  'COAID'          =>  $dbtid,
			  'Narration'      =>  $Narration,
			  'Debit'          =>  $Damnt,
			  'Credit'         =>  0,
			  'IsPosted'       => $IsPosted,
			  'CreateBy'       => $CreateBy,
			  'CreateDate'     => $createdate,
			  'IsAppove'       => 1
			); 
			 $datapay = array(
				  'transaction_id' => $voucher_no,
				  'supplier_id'    => $supplier_id,
				  'chalan_no'      => NULL,
				  'deposit_no'     => $voucher_no,
				  'amount'         => $Damnt,
				  'description'    => 'Paid to '.$supinfo->supName,
				  'payment_type'   => 1,
				  'cheque_no'      => '',
				  'date'           => $VDate,
				  'status'         => 1,
				  'd_c'            => 'd'
			  );
			 $this->db->insert('acc_transaction',$supplierdebit);
			 $this->db->insert('supplier_ledger',$datapay);
			if($payment_type==2){
				$podebitpaidamount = array(
				  'VNo'            =>  $voucher_no,
				  'Vtype'          =>  $Vtype,
				  'VDate'          =>  $VDate,
				  'COAID'          =>  $bankheadcode->HeadCode,
				  'Narration'      =>  'Paid On Bank to '.$supinfo->supName,
				  'Debit'          =>  0,
				  'Credit'         =>  $Damnt,// paid amount*****
				  'StoreID'        =>  0,
				  'IsPosted'       =>  $IsPosted,
				  'CreateBy'       => $CreateBy,
			      'CreateDate'     => $createdate,
				  'IsAppove'       =>  1
				); 
				$banksummary = array(
					'date'          =>  $VDate,
					'ac_type'       =>  'Credit(-)',
					'bank_id'       =>  $bankid,
					'description'   =>  'Supplier Payments',
					'deposite_id'   =>  $voucher_no,
					'dr'            =>  null,
					'cr'            =>  $Damnt,
					'ammount'       =>  $Damnt,
					'status'        =>  1
				);
			 
              $this->db->insert('acc_transaction',$podebitpaidamount);
			  $this->db->insert('bank_summary',$banksummary);
              
			}
			else{
					$cc = array(
					  'VNo'            =>  $voucher_no,
					  'Vtype'          =>  $Vtype,
					  'VDate'          =>  $VDate,
					  'COAID'          =>  1020101,
					  'Narration'      =>  'Paid to '.$supinfo->supName,
					  'Debit'          =>  0,
					  'Credit'         =>  $Damnt,
					  'IsPosted'       =>  1,
					  'CreateBy'       =>  $CreateBy,
					  'CreateDate'     =>  $createdate,
					  'IsAppove'       =>  1
					); 
				 $this->db->insert('acc_transaction',$cc);
				}
              $this->session->set_flashdata('message', display('save_successfully'));
              redirect('accounts/accounts/supplier_paymentreceipt/'.$supplier_id.'/'.$voucher_no.'/'.$dbtid);
    }
	   //Retrieve company Edit Data
    	public function supplierinfo($supplier_id){
  				return $this->db->select('*')
                  ->from('supplier')
                  ->where('supid',$supplier_id)
                  ->get()
                  ->row();
			}
		public function supplierpaymentinfo($voucher_no,$coaid){
  			return $payments=$this->db->select('*')->from('acc_transaction')->where('VNo',$voucher_no)->where('COAID',$coaid)->get()->row();
    
				}
	public function insert_cashadjustment(){
            $voucher_no = $this->input->post('txtVNo',true);
            $Vtype="AD";
            $amount =$this->input->post('txtAmount',true);
            $type = $this->input->post('type',true);
            if($type == 1){
              $debit = $amount;
              $credit = 0;
            }
            if($type == 2){
              $debit = 0;
              $credit = $amount;
            }
            $VDate = $this->input->post('dtpDate',true);
            $Narration=$this->input->post('txtRemarks',true);
            $IsPosted=1;
            $IsAppove=1;
            $CreateBy=$this->session->userdata('user_id');
           $createdate=date('Y-m-d H:i:s');
 
			 $cc = array(
			  'VNo'            =>  $voucher_no,
			  'Vtype'          =>  $Vtype,
			  'VDate'          =>  $VDate,
			  'COAID'          =>  1020101,
			  'Narration'      =>  'Cash Adjustment ',
			  'Debit'          =>  $debit,
			  'Credit'         =>  $credit,
			  'IsPosted'       =>  1,
			  'CreateBy'       =>  $CreateBy,
			  'CreateDate'     =>  $createdate,
			  'IsAppove'       =>  1
			); 
              $this->db->insert('acc_transaction',$cc);
 			return true;
			}

  public function bankbook_firstqury($FromDate,$HeadCode){

  $sql = "SELECT SUM(Debit) Debit, SUM(Credit) Credit, IsAppove, COAID FROM acc_transaction
              WHERE VDate < '$FromDate 00:00:00' AND COAID = '$HeadCode' AND IsAppove =1 GROUP BY IsAppove, COAID";
              return  $sql;

}

public function bankbook_secondqury($FromDate,$HeadCode,$ToDate){
  $sql = "SELECT acc_transaction.VNo, acc_transaction.Vtype, acc_transaction.VDate, acc_transaction.Debit, acc_transaction.Credit, acc_transaction.IsAppove, acc_transaction.COAID, acc_coa.HeadName, acc_coa.PHeadName, acc_coa.HeadType, acc_transaction.Narration 
     FROM acc_transaction INNER JOIN acc_coa ON acc_transaction.COAID = acc_coa.HeadCode
         WHERE acc_transaction.IsAppove =1 AND VDate BETWEEN '$FromDate 00:00:00' AND '$ToDate 00:00:00' AND acc_transaction.COAID='$HeadCode' ORDER BY  acc_transaction.VDate, acc_transaction.VNo";

         return $sql;
}
	public function fixed_assets()
	{
			 return   $this->db->select('*')
					  ->from('acc_coa')
					  ->where('PHeadName','Assets')
					  ->get()
					  ->result_array();
	}
	public function liabilities_data()
	{
	  return   $this->db->select('*')
					  ->from('acc_coa')
					  ->where('PHeadName','Liabilities')
					  ->get()
					  ->result_array();
	}
	public function income_fields()
	{
	  return   $this->db->select('*')
					  ->from('acc_coa')
					  ->where('PHeadName','Income')
					  ->get()
					  ->result_array();
	}
	public function expense_fields()
	{
	   return   $this->db->select('*')
					  ->from('acc_coa')
					  ->where('PHeadName','Expence')
					  ->get()
					  ->result_array();
	}
	public function assets_info($head_name)
	{
			 $this->db->select("*");
			 $this->db->from('acc_coa');
			 $this->db->where('PHeadName',$head_name);
			 $this->db->group_by('HeadCode');
		   return  $records = $this->db->get()->result_array();     
	
	} 
	
	public function asset_childs($head_name,$from_date,$to_date)
	{
			 $this->db->select("*");
			 $this->db->from('acc_coa');
			 $this->db->where('PHeadName',$head_name);
			 $this->db->group_by('HeadCode');
		   return  $records = $this->db->get()->result_array();    
	}
	
	public function assets_balance($head_code,$from_date,$to_date)
	{
			 $this->db->select("(sum(Debit)-sum(Credit)) as balance");
			 $this->db->from('acc_transaction');
			 $this->db->where('COAID',$head_code);
			 $this->db->where('VDate >=',$from_date);
			 $this->db->where('VDate <=',$to_date);
			 $this->db->where('IsAppove',1);
		   return  $records = $this->db->get()->result_array(); 
	}
	public function liabilities_info($head_name)
	{
	
			 $this->db->select("*");
			 $this->db->from('acc_coa');
			 $this->db->where('PHeadName',$head_name);
		   return  $records = $this->db->get()->result_array();   
	
	}
	public function liabilities_balance($head_code,$from_date,$to_date)
	{
	   $this->db->select("(sum(Credit)-sum(Debit)) as balance,COAID");
			 $this->db->from('acc_transaction');
			 $this->db->where('COAID',$head_code);
			 $this->db->where('VDate >=',$from_date);
			 $this->db->where('VDate <=',$to_date);
			 $this->db->where('IsAppove',1);
		   return  $records = $this->db->get()->result_array(); 
	}
	public function income_balance($head_code,$from_date,$to_date)
	{
			$this->db->select("(sum(Debit)-sum(Credit)) as balance,COAID");
			 $this->db->from('acc_transaction');
			 $this->db->where('COAID',$head_code);
			 $this->db->where('VDate >=',$from_date);
			 $this->db->where('VDate <=',$to_date);
			 $this->db->where('IsAppove',1);
		   return  $records = $this->db->get()->result_array(); 
	}
}
