<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends CI_Model {
	
	private $table = 'purchaseitem';
 
	public function create()
	{
		$saveid=$this->session->userdata('id');
		$p_id = $this->input->post('product_id');
		$payment_type=$this->input->post('paytype',true);
		$bankid='';
		if(empty($this->input->post('paidamount'))){
			$pamount=$this->input->post('grand_total_price',true);
			}
		else{
			$pamount=$this->input->post('paidamount',true);
			}
		if($payment_type==2){
			$bankid=$this->input->post('bank',true);
			$bankinfo =$this->db->select('*')->from('tbl_bank')->where('bankid',$bankid)->get()->row();
			$bankheadcode = $this->db->select('*')->from('acc_coa')->where('HeadName',$bankinfo->bank_name)->get()->row();
		}
		$purchase_date = str_replace('/','-',$this->input->post('purchase_date'));
		$newdate= date('Y-m-d' , strtotime($purchase_date));
		$expire_date = str_replace('/','-',$this->input->post('expire_date'));
		$exdate= date('Y-m-d' , strtotime($expire_date));
		$data=array(
			'invoiceid'				=>	$this->input->post('invoice_no',true),
			'suplierID'			    =>	$this->input->post('suplierid',true),
			'paymenttype'			=> $payment_type,
			'total_price'	        =>	$this->input->post('grand_total_price',true),
			'paid_amount'	        =>	$pamount,
			'bankid'	            =>	$bankid,
			'details'	            =>	$this->input->post('purchase_details',true),
			'purchasedate'		    =>	$newdate,
			'purchaseexpiredate'	=>	$exdate,
			'savedby'			    =>	$saveid
		);
		 $this->db->insert($this->table,$data);
		$returnid = $this->db->insert_id();
		
		$rate = $this->input->post('product_rate',true);
		$quantity = $this->input->post('product_quantity',true);
		$t_price = $this->input->post('total_price',true);
		
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
			$product_quantity = $quantity[$i];
			$product_rate = $rate[$i];
			$product_id = $p_id[$i];
			$total_price = $t_price[$i];
			
			$data1 = array(
				'purchaseid'		=>	$returnid,
				'indredientid'		=>	$product_id,
				'quantity'			=>	$product_quantity,
				'price'				=>	$product_rate,
				'totalprice'		=>	$total_price,
				'purchaseby'		=>	$saveid,
				'purchasedate'		=>	$newdate,
				'purchaseexpiredate'=>	$exdate
			);

			if(!empty($quantity))
			{
				/*add stock in ingredients*/
				$this->db->set('stock_qty', 'stock_qty+'.$product_quantity, FALSE);
				$this->db->where('id', $product_id);
				$this->db->update('ingredients');
				/*end add ingredients*/
				$this->db->insert('purchase_details',$data1);
			}
		}
		
		$supinfo =$this->db->select('*')->from('supplier')->where('supid',$this->input->post('suplierid'))->get()->row();
		$sup_head = $supinfo->suplier_code.'-'.$supinfo->supName;
		$sup_coa = $this->db->select('*')->from('acc_coa')->where('HeadName',$sup_head)->get()->row();
		
		
		// Acc transaction
		$recv_id = date('YmdHis');
		$receive_transection = array(
					'VNo'            =>  $this->input->post('invoice_no',true),
					'Vtype'          =>  'PO',
					'VDate'          =>  $newdate,
					'COAID'          =>  10107,
					'Narration'      =>  'PO Receive Receive No '.$recv_id,
					'Debit'          =>  $this->input->post('grand_total_price',true),
					'Credit'         =>  0,
					'StoreID'        =>  0,
					'IsPosted'       =>  1,
					'CreateBy'       =>  $saveid,
					'CreateDate'     =>  $newdate,
					'IsAppove'       =>  1
				); 
		$this->db->insert('acc_transaction',$receive_transection);
		 //  Supplier credit
		  $poCredit = array(
			  'VNo'            =>  $this->input->post('invoice_no',true),
			  'Vtype'          =>  'PO',
			  'VDate'          =>  $newdate,
			  'COAID'          =>  $sup_coa->HeadCode,
			  'Narration'      =>  'PO received For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
			  'Debit'          =>  0,
			  'Credit'         =>  $this->input->post('grand_total_price',true),
			  'StoreID'        =>  0,
			  'IsPosted'       =>  1,
			  'CreateBy'       =>  $saveid,
			  'CreateDate'     =>  $newdate,
			  'IsAppove'       =>  1
			); 
		   $this->db->insert('acc_transaction',$poCredit);
		   
		
		   
		     // Expense for company
         $expense = array(
		  'VNo'            => $this->input->post('invoice_no',true),
		  'Vtype'          => 'Purchase',
		  'VDate'          => $newdate,
		  'COAID'          => 407,
		  'Narration'      => 'Company Credit For  '.$sup_coa->HeadCode,
		  'Debit'          => $this->input->post('grand_total_price'),
		  'Credit'         => 0,//purchase price asbe
		  'IsPosted'       => 1,
		  'CreateBy'       => $saveid,
		  'CreateDate'     => $newdate,
		  'IsAppove'       => 1
		); 
		 // Bank summary for credit
		  $banksummary = array(
					'date'          =>  $newdate,
					'ac_type'       =>  'Credit(-)',
					'bank_id'       =>  $bankid,
					'description'   =>  'product purchase',
					'deposite_id'   =>  $this->input->post('invoice_no',true),
					'dr'            =>  null,
					'cr'            =>  $pamount,
					'ammount'       =>  $pamount,
					'status'        =>  1
				);
		$ledger = array(
            'transaction_id'  => $this->input->post('invoice_no',true),
            'chalan_no'       => $this->input->post('invoice_no',true),
            'supplier_id'     => $this->input->post('suplierid'),
            'amount'          => $this->input->post('grand_total_price'),
            'date'            => $newdate,
            'description'     => $this->input->post('purchase_details'),
            'status'          => 1,
            'd_c'             => 'c',
        );
       $ledger_debit = array(
         'transaction_id'  => $this->input->post('invoice_no',true),
         'chalan_no'       => $this->input->post('invoice_no',true),
         'supplier_id'     => $this->input->post('suplierid'),
         'amount'          => $pamount,
         'date'            =>  $newdate,
         'description'     =>  'Purchase From Supplier. '.$this->input->post('purchase_details'),
         'status'          =>  1,
         'd_c'             => 'd',
        );
		
		$this->db->insert('supplier_ledger',$ledger);
		$this->db->insert('acc_transaction',$expense);
		if($payment_type==1){
			//for cash Payment
	   // Supplier paid amount Debit for cash Payments
	    $podebitpaidamount = array(
		  'VNo'            =>  $this->input->post('invoice_no',true),
		  'Vtype'          =>  'PO',
		  'VDate'          =>  $newdate,
		  'COAID'          =>  $sup_coa->HeadCode,
		  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
		  'Debit'          =>  $pamount,// paid amount*****
		  'Credit'         =>  0,
		  'StoreID'        =>  0,
		  'IsPosted'       =>  1,
		  'CreateBy'       =>  $saveid,
		  'CreateDate'     =>  $newdate,
		  'IsAppove'       =>  1
    	); 
       $this->db->insert('acc_transaction',$podebitpaidamount);
	   
	   //Cash in Hand  Cdedit.
	    $podebitpaidamount = array(
		  'VNo'            =>  $this->input->post('invoice_no',true),
		  'Vtype'          =>  'PO',
		  'VDate'          =>  $newdate,
		  'COAID'          =>  1020101,
		  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
		  'Debit'          =>  0,
		  'Credit'         =>  $pamount,// paid amount*****
		  'StoreID'        =>  0,
		  'IsPosted'       =>  1,
		  'CreateBy'       =>  $saveid,
		  'CreateDate'     =>  $newdate,
		  'IsAppove'       =>  1
    	); 
        $this->db->insert('acc_transaction',$podebitpaidamount);
		$this->db->insert('supplier_ledger',$ledger_debit);
		}
		if($payment_type==2){
			// Supplier paid amount Debit for cash Payments
			$podebitpaidamount = array(
			  'VNo'            =>  $this->input->post('invoice_no',true),
			  'Vtype'          =>  'PO',
			  'VDate'          =>  $newdate,
			  'COAID'          =>  $sup_coa->HeadCode,
			  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
			  'Debit'          =>  $pamount,// paid amount*****
			  'Credit'         =>  0,
			  'StoreID'        =>  0,
			  'IsPosted'       =>  1,
			  'CreateBy'       =>  $saveid,
			  'CreateDate'     =>  $newdate,
			  'IsAppove'       =>  1
			); 
		   $this->db->insert('acc_transaction',$podebitpaidamount);
	   
	   		//Cash in Hand  Cdedit.
			$podebitpaidamount = array(
			  'VNo'            =>  $this->input->post('invoice_no',true),
			  'Vtype'          =>  'PO',
			  'VDate'          =>  $newdate,
			  'COAID'          =>  $bankheadcode->HeadCode,
			  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
			  'Debit'          =>  0,
			  'Credit'         =>  $pamount,// paid amount*****
			  'StoreID'        =>  0,
			  'IsPosted'       =>  1,
			  'CreateBy'       =>  $saveid,
			  'CreateDate'     =>  $newdate,
			  'IsAppove'       =>  1
			); 
			$this->db->insert('acc_transaction',$podebitpaidamount);
			$this->db->insert('bank_summary',$banksummary);
            $this->db->insert('supplier_ledger',$ledger_debit);
		}
		return true;
	
	}
	
	public function delete($id = null)
	{
		$this->db->where('purID',$id)
			->delete($this->table);

		$this->db->where('purchaseid',$id)
			->delete('purchase_details');

		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	} 




	public function update()
	{
		$id=$this->input->post('purID');
		$saveid=$this->session->userdata('id');
		$p_id = $this->input->post('product_id',true);
		$payment_type=$this->input->post('paytype',true);
		$bankid='';
		if(empty($this->input->post('paidamount'))){
			$pamount=$this->input->post('grand_total_price',true);
			}
		else{
			$pamount=$this->input->post('paidamount',true);
			}
		if($payment_type==2){
			$bankid=$this->input->post('bank',true);
			$bankinfo =$this->db->select('*')->from('tbl_bank')->where('bankid',$bankid)->get()->row();
			$bankheadcode = $this->db->select('*')->from('acc_coa')->where('HeadName',$bankinfo->bank_name)->get()->row();
		}
		$oldinvoice=$this->input->post('oldinvoice',true);
		$oldsupplier= $this->input->post('oldsupplier',true);
		$length= count($p_id);
		$purchase_date = str_replace('/','-',$this->input->post('purchase_date'));
		$newdate= date('Y-m-d' , strtotime($purchase_date));
		$expire_date = str_replace('/','-',$this->input->post('expire_date'));
		$exdate= date('Y-m-d' , strtotime($expire_date));
		$data=array(
			'invoiceid'				=>	$this->input->post('invoice_no',true),
			'suplierID'			    =>	$this->input->post('suplierid',true),
			'paymenttype'			=>  $payment_type,
			'bankid'			    =>  $bankid,
			'total_price'	        =>	$this->input->post('grand_total_price',true),
			'paid_amount'	        =>	$pamount,
			'details'	            =>	$this->input->post('purchase_details',true),
			'purchasedate'		    =>	$newdate,
			'purchaseexpiredate'	=>	$exdate,
			'savedby'			    =>	$saveid
		);
		 $this->db->where('purID',$id)
			->update($this->table, $data);
		
		
		$rate = $this->input->post('product_rate',true);
		$quantity = $this->input->post('product_quantity',true);
		$t_price = $this->input->post('total_price',true);
		
		for ($i=0, $n=count($p_id); $i < $n; $i++){
			$product_quantity = $quantity[$i];
			$product_rate = $rate[$i];
			$product_id = $p_id[$i];
			$total_price = $t_price[$i];
			$this->db->select('*');
            $this->db->from('purchase_details');
            $this->db->where('purchaseid',$id);
			$this->db->where('indredientid',$product_id);
            $query = $this->db->get();
			if ($query->num_rows() > 0) {
				
				$dataupdate = array(
					'purchaseid'		=>	$id,
					'indredientid'		=>	$product_id,
					'quantity'			=>	$product_quantity,
					'price'				=>	$product_rate,
					'totalprice'		=>	$total_price,
					'purchaseby'		=>	$saveid,
					'purchasedate'		=>	$newdate,
					'purchaseexpiredate'=>	$exdate
				);	
			
				if(!empty($quantity))
				{
					
					/*add stock in ingredients*/
					$olderqty = $query->row();
					$addv = $product_quantity-$olderqty->quantity;
				$this->db->set('stock_qty', 'stock_qty+'.$addv, FALSE);
				$this->db->where('id', $product_id);
				$this->db->update('ingredients');
				/*end add ingredients*/
					$this->db->where('purchaseid', $id);
					$this->db->where('indredientid', $product_id);
					$this->db->update('purchase_details', $dataupdate);
				}
			}
			else{
				$data1 = array(
					'purchaseid'		=>	$id,
					'indredientid'		=>	$product_id,
					'quantity'			=>	$product_quantity,
					'price'				=>	$product_rate,
					'totalprice'		=>	$total_price,
					'purchaseby'		=>	$saveid,
					'purchasedate'		=>	$newdate
				);
				if(!empty($quantity))
				{
					
					$this->db->insert('purchase_details',$data1);
				}
			}
		}
		
			$this->db->select('*');
            $this->db->from('purchase_details');
            $this->db->where('purchaseid',$id);
            $query = $this->db->get();
			$details=$query->result_array();
			$test=array();
			$k=0;
			foreach($details as $single){
				$k++;
				$test[$k]=$single['indredientid'];
				}
			$result=array_diff($test,$p_id);
			if(!empty($result)){
				foreach($result as $delval){
					$this->db->where('indredientid', $delval);
					$this->db->where('purchaseid',$id);
					$del=$this->db->delete('purchase_details'); 
					}
			}
			
			$supinfo =$this->db->select('*')->from('supplier')->where('supid',$oldsupplier)->get()->row();
			$sup_head = $supinfo->suplier_code.'-'.$supinfo->supName;
			$sup_coa = $this->db->select('*')->from('acc_coa')->where('HeadName',$sup_head)->get()->row();
			
			$this->db->where('VNo',$oldinvoice)->delete('acc_transaction');
			$this->db->where('transaction_id',$oldinvoice)->delete('supplier_ledger');
			$this->db->where('deposite_id',$oldinvoice)->delete('bank_summary');
			
			
			// Acc transaction
		$recv_id = date('YmdHis');
		$receive_transection = array(
					'VNo'            =>  $this->input->post('invoice_no',true),
					'Vtype'          =>  'PO',
					'VDate'          =>  $newdate,
					'COAID'          =>  10107,
					'Narration'      =>  'PO Receive Receive No '.$recv_id,
					'Debit'          =>  $this->input->post('grand_total_price',true),
					'Credit'         =>  0,
					'StoreID'        =>  0,
					'IsPosted'       =>  1,
					'CreateBy'       =>  $saveid,
					'CreateDate'     =>  $newdate,
					'IsAppove'       =>  1
				); 
		$this->db->insert('acc_transaction',$receive_transection);
		 //  Supplier credit
		  $poCredit = array(
			  'VNo'            =>  $this->input->post('invoice_no',true),
			  'Vtype'          =>  'PO',
			  'VDate'          =>  $newdate,
			  'COAID'          =>  $sup_coa->HeadCode,
			  'Narration'      =>  'PO received For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
			  'Debit'          =>  0,
			  'Credit'         =>  $this->input->post('grand_total_price',true),
			  'StoreID'        =>  0,
			  'IsPosted'       =>  1,
			  'CreateBy'       =>  $saveid,
			  'CreateDate'     =>  $newdate,
			  'IsAppove'       =>  1
			); 
		   $this->db->insert('acc_transaction',$poCredit);
		   
		
		   
		     // Expense for company
         $expense = array(
		  'VNo'            => $this->input->post('invoice_no',true),
		  'Vtype'          => 'Purchase',
		  'VDate'          => $newdate,
		  'COAID'          => 407,
		  'Narration'      => 'Company Credit For  '.$sup_coa->HeadCode,
		  'Debit'          => $this->input->post('grand_total_price'),
		  'Credit'         => 0,//purchase price asbe
		  'IsPosted'       => 1,
		  'CreateBy'       => $saveid,
		  'CreateDate'     => $newdate,
		  'IsAppove'       => 1
		); 
		 // Bank summary for credit
		  $banksummary = array(
					'date'          =>  $newdate,
					'ac_type'       =>  'Credit(-)',
					'bank_id'       =>  $bankid,
					'description'   =>  'product purchase',
					'deposite_id'   =>  $this->input->post('invoice_no',true),
					'dr'            =>  null,
					'cr'            =>  $pamount,
					'ammount'       =>  $pamount,
					'status'        =>  1
				);
		$ledger = array(
            'transaction_id'  => $this->input->post('invoice_no',true),
            'chalan_no'       => $this->input->post('invoice_no',true),
            'supplier_id'     => $this->input->post('suplierid'),
            'amount'          => $this->input->post('grand_total_price'),
            'date'            => $newdate,
            'description'     => $this->input->post('purchase_details'),
            'status'          => 1,
            'd_c'             => 'c',
        );
       $ledger_debit = array(
         'transaction_id'  => $this->input->post('invoice_no',true),
         'chalan_no'       => $this->input->post('invoice_no',true),
         'supplier_id'     => $this->input->post('suplierid'),
         'amount'          => $pamount,
         'date'            =>  $newdate,
         'description'     =>  'Purchase From Supplier. '.$this->input->post('purchase_details'),
         'status'          =>  1,
         'd_c'             => 'd',
        );
		
		$this->db->insert('supplier_ledger',$ledger);
		$this->db->insert('acc_transaction',$expense);
		if($payment_type==1){
			//for cash Payment
	   // Supplier paid amount Debit for cash Payments
	    $podebitpaidamount = array(
		  'VNo'            =>  $this->input->post('invoice_no',true),
		  'Vtype'          =>  'PO',
		  'VDate'          =>  $newdate,
		  'COAID'          =>  $sup_coa->HeadCode,
		  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
		  'Debit'          =>  $pamount,// paid amount*****
		  'Credit'         =>  0,
		  'StoreID'        =>  0,
		  'IsPosted'       =>  1,
		  'CreateBy'       =>  $saveid,
		  'CreateDate'     =>  $newdate,
		  'IsAppove'       =>  1
    	); 
       $this->db->insert('acc_transaction',$podebitpaidamount);
	   
	   //Cash in Hand  Cdedit.
	    $podebitpaidamount = array(
		  'VNo'            =>  $this->input->post('invoice_no',true),
		  'Vtype'          =>  'PO',
		  'VDate'          =>  $newdate,
		  'COAID'          =>  1020101,
		  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
		  'Debit'          =>  0,
		  'Credit'         =>  $pamount,// paid amount*****
		  'StoreID'        =>  0,
		  'IsPosted'       =>  1,
		  'CreateBy'       =>  $saveid,
		  'CreateDate'     =>  $newdate,
		  'IsAppove'       =>  1
    	); 
        $this->db->insert('acc_transaction',$podebitpaidamount);
		$this->db->insert('supplier_ledger',$ledger_debit);
		}
		if($payment_type==2){
			// Supplier paid amount Debit for cash Payments
			$podebitpaidamount = array(
			  'VNo'            =>  $this->input->post('invoice_no',true),
			  'Vtype'          =>  'PO',
			  'VDate'          =>  $newdate,
			  'COAID'          =>  $sup_coa->HeadCode,
			  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
			  'Debit'          =>  $pamount,// paid amount*****
			  'Credit'         =>  0,
			  'StoreID'        =>  0,
			  'IsPosted'       =>  1,
			  'CreateBy'       =>  $saveid,
			  'CreateDate'     =>  $newdate,
			  'IsAppove'       =>  1
			); 
		   $this->db->insert('acc_transaction',$podebitpaidamount);
	   
	   		//Cash in Hand  Cdedit.
			$podebitpaidamount = array(
			  'VNo'            =>  $this->input->post('invoice_no',true),
			  'Vtype'          =>  'PO',
			  'VDate'          =>  $newdate,
			  'COAID'          =>  $bankheadcode->HeadCode,
			  'Narration'      =>  'Paid For PO No.'.$this->input->post('invoice_no',true).' Receive No.'.$recv_id,
			  'Debit'          =>  0,
			  'Credit'         =>  $pamount,// paid amount*****
			  'StoreID'        =>  0,
			  'IsPosted'       =>  1,
			  'CreateBy'       =>  $saveid,
			  'CreateDate'     =>  $newdate,
			  'IsAppove'       =>  1
			); 
			$this->db->insert('acc_transaction',$podebitpaidamount);
			$this->db->insert('bank_summary',$banksummary);
            $this->db->insert('supplier_ledger',$ledger_debit);
		}
		return true;
	
	
	}
	
	
	public function makeproduction()
	{
		$saveid=$this->session->userdata('id');
		$p_id = $this->input->post('product_id');
		$purchase_date = str_replace('/','-',$this->input->post('purchase_date'));
		$newdate= date('Y-m-d' , strtotime($purchase_date));
		$data=array(
			'itemid'				=>	$this->input->post('foodid',true),
			'itemquantity'			=>	$this->input->post('pro_qty',true),
			'saveddate'		    	=>	$newdate,
			'savedby'			    =>	$saveid
		);
		$this->db->insert('production',$data);
		$returnid = $this->db->insert_id();
		$quantity = $this->input->post('product_quantity');
		
		for ($i=0, $n=count($p_id); $i < $n; $i++) {
			$product_quantity = $quantity[$i];
			$product_id = $p_id[$i];
			
			$data1 = array(
				'productionid'		=>	$returnid,
				'ingredientid'		=>	$product_id,
				'qty'				=>	$product_quantity,
				'createdby'			=>	$saveid,
				'created_date'		=>	$newdate
			);

			if(!empty($quantity))
			{
				$this->db->insert('production_details',$data1);
			}
		}
		return true;
	
	}

    public function read($limit = null, $start = null)
	{
	    $this->db->select('purchaseitem.*,supplier.supName');
        $this->db->from($this->table);
		$this->db->join('supplier','purchaseitem.suplierID = supplier.supid','left');
        $this->db->order_by('purID', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 

	public function findById($id = null)
	{ 
		return $this->db->select("*")->from($this->table)
			->where('purID',$id) 
			->get()
			->row();
	}
	public function settinginfo()
	{ 
		return $this->db->select("*")->from('setting')
			->get()
			->row();
	}
	public function currencysetting($id = null)
	{ 
		return $this->db->select("*")->from('currency')
			->where('currencyid',$id) 
			->get()
			->row();
	} 
	public function finditem($product_name)
		{ 
		$this->db->select('*');
		$this->db->from('ingredients');
		$this->db->where('is_active',1);
		$this->db->like('ingredient_name', $product_name);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
		}
	public function get_total_product($product_id){
		$this->db->select('*');
		$this->db->from('ingredients');
		$this->db->where('id', $product_id);
		$query = $this->db->get()->row();
		$available_quantity = $query->stock_qty;
		$data2 = array(
			'total_purchase'  => $available_quantity
			);
		

		return $data2;
		}
 public function iteminfo($id){
	 	$this->db->select('purchase_details.*,ingredients.ingredient_name,ingredients.stock_qty,unit_of_measurement.uom_short_code');
		$this->db->from('purchase_details');
		$this->db->join('ingredients','purchase_details.indredientid=ingredients.id','left');
		$this->db->join('unit_of_measurement','unit_of_measurement.id = ingredients.uom_id','inner');
		$this->db->where('purchaseid',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result();	
		}
		return false;
		
	 }
//item Dropdown
 public function item_dropdown()
	{
		$data = $this->db->select("*")
			->from('item_foods')
			->get()
			->result();

		$list[''] = 'Select '.display('item_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->ProductsID] = $value->ProductName;
			return $list;
		} else {
			return false; 
		}
	}
 //ingredient Dropdown
 public function ingrediant_dropdown()
	{
		$data = $this->db->select("*")
			->from('ingredients')
			->where('is_active',1) 
			->get()
			->result();

		$list[''] = 'Select '.display('item_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->ingredient_name;
			return $list;
		} else {
			return false; 
		}
	}
//item Dropdown
 public function supplier_dropdown()
	{
		$data = $this->db->select("*")
			->from('supplier')
			->get()
			->result();

		$list[''] = 'Select '.display('supplier_name');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->supid] = $value->supName;
			return $list;
		} else {
			return false; 
		}
	}
public function suplierinfo($id){
	return $this->db->select("*")->from('supplier')
			->where('supid',$id) 
			->get()
			->row();
	
	}
public function countlist()
	{
		
	    $this->db->select('purchaseitem.*,supplier.supName');
        $this->db->from($this->table);
		$this->db->join('supplier','purchaseitem.suplierID = supplier.supid','left');

		
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
 public function invoicebysupplier($id){
	 	 $this->db->select('*');
         $this->db->from($this->table);
		 $this->db->where('suplierID',$id);
		 $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();  
        }
        return false;
	 }
public function getinvoice($id){
	 	 $this->db->select('*');
         $this->db->from($this->table);
		 $this->db->where('invoiceid',$id);
		 $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();  
        }
        return false;
	 }
	public function pur_return_insert(){
				/*purchase Return Insert*/
				$po_no =  $this->input->post('invoice');
				$createby=$this->session->userdata('id');
				$createdate=date('Y-m-d H:i:s');
				$postData = array(
				'po_no'			        =>	$po_no,
				'supplier_id'		    =>	$this->input->post('supplier_id',true),
				'return_date'           =>  $this->input->post('return_date',true),
				'totalamount'           =>  $this->input->post('grand_total_price',true),
				'return_reason'         =>  $this->input->post('reason',true),
				'createby'		        =>	$createby,
				'createdate'		    =>	$createdate
				); 
			
				$grand_total_price=$this->input->post('grand_total_price',true);
				$this->db->insert('purchase_return',$postData);
				$id =$this->db->insert_id();
				/***************End**********************/
				/*update Purchase stock and Amount*/
				 $this->db->select('*');
                 $this->db->from($this->table);
				 $this->db->where('invoiceid',$po_no);
				 $query = $this->db->get();
				 $purchase= $query->row();
				 $purchaseid=$purchase->purID;
				 $updategrandtotal=$purchase->total_price-$grand_total_price;
				 $updateData = array('total_price'   =>	$updategrandtotal);
		
				 $this->db->where('invoiceid',$po_no)
				 ->update('purchaseitem', $updateData); 
				/***************End**********************/
				
				$p_id = $this->input->post('product_id');
				$pq = $this->input->post('total_price');
				$rate = $this->input->post('product_rate');
				$quantity = $this->input->post('total_qntt');
		
				for ($i=0, $n=count($p_id); $i <= $n; $i++) {
					$product_quantity = $quantity[$i];
					$product_rate = $rate[$i];
					$product_id = $p_id[$i];
					$removeprice=$pq[$i];
					if($product_quantity>0){
					$data = array(
					'preturn_id'        =>  $id,
					'product_id'		=>	$product_id,
					'qty'			    =>	$product_quantity,
					'product_rate'	    =>	$product_rate,
					);
			
					 $this->db->insert('purchase_return_details',$data);
					 $this->db->select('*');
					 $this->db->from('purchase_details');
					 $this->db->where('purchaseid',$purchaseid);
					 $this->db->where('indredientid',$product_id);
					 $query = $this->db->get();
					  if ($query->num_rows() > 0) {
					 $purchasedetails= $query->row();
					 $rateprice=$product_quantity*$product_rate;
					 $qtotalpr=$purchasedetails->totalprice-$removeprice;
					 $adjustqty=$purchasedetails->quantity-$product_quantity;
					$qtyData = array(
					'quantity'   =>	$adjustqty,
					'totalprice'   => $qtotalpr);
			
						/*add stock in ingredients*/
					
				$this->db->set('stock_qty', 'stock_qty-'.$product_quantity, FALSE);
				$this->db->where('id', $product_id);
				$this->db->update('ingredients');
				/*end add ingredients*/
					 $this->db->where('purchaseid',$purchaseid)
					->where('indredientid',$product_id)
					->update('purchase_details', $qtyData);
					  }
					  }
				}
		$recv_id = date('YmdHis');
		$supinfo =$this->db->select('*')->from('supplier')->where('supid',$this->input->post('supplier_id'))->get()->row();
		$sup_head = $supinfo->suplier_code.'-'.$supinfo->supName;
		$sup_coa = $this->db->select('*')->from('acc_coa')->where('HeadName',$sup_head)->get()->row();

	  //  Supplier credit
	  
	  $poCredit = array(
		  'VNo'            =>  $this->input->post('invoice',true),
		  'Vtype'          =>  'PO',
		  'VDate'          =>  $createdate,
		  'COAID'          =>  $sup_coa->HeadCode,
		  'Narration'      =>  'P Return For '.$po_no,
		  'Debit'          =>  $grand_total_price,
		  'Credit'         =>  0,
		  'StoreID'        =>  0,
		  'IsPosted'       =>  1,
		  'CreateBy'       =>  $createby,
		  'CreateDate'     =>  $createdate,
		  'IsAppove'       =>  1
    	); 
       $this->db->insert('acc_transaction',$poCredit);
	   // Acc transaction
	   $receive_transection = array(
					'VNo'            =>  $this->input->post('invoice',true),
					'Vtype'          =>  'PO',
					'VDate'          =>  $createdate,
					'COAID'          =>  10107,
					'Narration'      =>  'Purchase Return For PO No'.$po_no,
					'Debit'          =>  0,
					'Credit'         =>  $grand_total_price,
					'StoreID'        => 0,
					'IsPosted'       => 1,
					'CreateBy'       => $createby,
					'CreateDate'     => $createdate,
					'IsAppove'       => 1
				); 
		$this->db->insert('acc_transaction',$receive_transection);
		return true;
		}
	public function readinvoice($limit = null, $start = null)
	{
	    $this->db->select('purchase_return.*,supplier.supName');
        $this->db->from('purchase_return');
		$this->db->join('supplier','purchase_return.supplier_id = supplier.supid','left');
        $this->db->order_by('purchase_return.preturn_id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();    
        }
        return false;
	} 	
	public function countreturnlist()
	{
		
	    $this->db->select('purchase_return.*,supplier.supName');
        $this->db->from('purchase_return');
		$this->db->join('supplier','purchase_return.supplier_id = supplier.supid','left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();  
        }
        return false;
	}
  public function findByreturnId($id = null)
	{ 
		 $this->db->select('purchase_return.*,supplier.supName');
        $this->db->from('purchase_return');
		$this->db->join('supplier','purchase_return.supplier_id = supplier.supid','left');
		$this->db->where('preturn_id',$id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();  
        }
        return false;
	}
  public function returniteminfo($id){
	 	$this->db->select('purchase_return_details.*,ingredients.ingredient_name,unit_of_measurement.uom_short_code');
		$this->db->from('purchase_return_details');
		$this->db->join('ingredients','purchase_return_details.product_id=ingredients.id','left');
		$this->db->join('unit_of_measurement','unit_of_measurement.id = ingredients.uom_id','inner');
		$this->db->where('preturn_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();	
		}
		return false;
		
	 }
}
