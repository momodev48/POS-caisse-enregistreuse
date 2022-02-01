<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {
	
	private $table = 'supplier';
 
	public function create($data = array())
	{
		return $this->db->insert($this->table, $data);
		
	}
	public function delete($id = null)
	{
		$this->db->where('supid',$id)
			->delete($this->table);

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 

	 public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='4' And HeadCode LIKE '5020205%'");
        return $query->row();
    }
	
	 //Supplier Previous balance adjustment
      public function previous_balance_add($balance, $supplier_id,$c_acc,$supplier_name,$sino) {
    $coainfo = $this->db->select('*')->from('acc_coa')->where('HeadName',$c_acc)->get()->row();
    $supplier_headcode = $coainfo->HeadCode;
        $data = array(
            'transaction_id' => $sino,
            'supplier_id'    => $supplier_id,
            'chalan_no'      => 'Adjustment ',
            'deposit_no'     => NULL,
            'amount'         => $balance,
            'description'    => "Previous adjustment with software",
            'payment_type'   => "NA",
            'cheque_no'      => "NA",
            'date'           => date("Y-m-d"),
            'status'         => 1,
            'd_c'            => 'c'
        );
     $cosdr = array(
      'VNo'            =>  $sino,
      'Vtype'          =>  'PR Balance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  $supplier_headcode,
      'Narration'      =>  'supplier debit For '.$supplier_name,
      'Debit'          =>  0,
      'Credit'         =>  $balance,
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('user_id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    );
       $inventory = array(
      'VNo'            =>  $sino,
      'Vtype'          =>  'PR Balance',
      'VDate'          =>  date("Y-m-d"),
      'COAID'          =>  10107,
      'Narration'      =>  'Inventory credit For  '.$supplier_name,
      'Debit'          =>  $balance,
      'Credit'         =>  0,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $this->session->userdata('user_id'),
      'CreateDate'     => date('Y-m-d H:i:s'),
      'IsAppove'       => 1
    ); 

        $this->db->insert('supplier_ledger', $data);
        if(!empty($balance)){
           $this->db->insert('acc_transaction', $cosdr); 
           $this->db->insert('acc_transaction', $inventory); 
        }
    }
	
	
 	public function create_coa($data = array())
    {
        $this->db->insert('acc_coa',$data);
        return true;
    }

	public function update($data = array())
	{
		return $this->db->where('supid',$data["supid"])
			->update($this->table, $data);
	}

    public function read($limit = null, $start = null)
	{
	   $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('supid', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 
	
	public function supplierlist()
	{
	   $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('supid', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('supid',$id) 
			->get()
			->row();
	} 

 
public function countlist()
	{
		$this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
	
	public function customerlist($limit = null, $start = null)
	{
	   $this->db->select('*');
        $this->db->from('customer_info');
        $this->db->order_by('customer_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	}
	public function countcustomerlist()
	{
		$this->db->select('*');
        $this->db->from('customer_info');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	} 
	    // count ledger info
    public function count_supplier_product_info() {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }
	public function supplier_ledger_report($supplierid= null,$fromdate= null,$todate= null,$limit = null, $start = null){
			$this->db->select('supplier_ledger.*,supplier.supName');
			$this->db->from('supplier_ledger');
			$this->db->join('supplier','supplier.supid=supplier_ledger.supplier_id','left');
			if(!empty($supplierid)){
			$this->db->where('supplier_ledger.supplier_id', $supplierid);
			$this->db->where(array('date >=' => $fromdate, 'date <=' => $todate));
			}
			$this->db->limit($limit, $start);
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return $query->result();    
			}
			return false;
		}
    //To get certain supplier's chalan info by which this company got products day by day
    public function suppliers_ledger($supplier_id, $start, $end) {
        $this->db->select('supplier_ledger.*,supplier.supName');
        $this->db->from('supplier_ledger');
		$this->db->join('supplier','supplier.supid=supplier_ledger.supplier_id','left');
        $this->db->where('supplier_ledger.supplier_id', $supplier_id);
        $this->db->where(array('date >=' => $start, 'date <=' => $end));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	public function supplier_duepaid_report($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	public function suppliers_balance($supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_ledger');
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
}
