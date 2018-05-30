<?php
class tmp_sale_shareTransaction extends db{
	public $tmp_share_transaction_id;
	public $tmp_share_transaction_type;
	public $tmp_account_id_credit;
	public $tmp_account_id_debit;
	public $tmp_share_transaction_date;
	public $tmp_share_transaction_amount;
	public $tmp_share_value;

	public function __construct($id){
		parent::__construct();
		$rs = $this->dbSelect_where('tmp_sale_share_transaction', '*', array('tmp_share_transaction_id' => $id));
		$this->tmp_share_transaction_id= $rs[0]['tmp_share_transaction_id'];
		$this->tmp_share_transaction_type= $rs[0]['tmp_share_transaction_type'];
		$this->tmp_account_id_credit= $rs[0]['tmp_account_id_credit'];
		$this->tmp_account_id_debit= $rs[0]['tmp_account_id_debit'];
		$this->tmp_share_transaction_date= $rs[0]['tmp_share_transaction_date'];
		$this->tmp_share_transaction_amount= $rs[0]['tmp_share_transaction_amount'];
		$this->tmp_share_value= $rs[0]['tmp_share_value'];
	}
	
	public function get_transaction_charge(){
		//echo $this->tmp_share_transaction_id;exit;
		if(!empty($this->tmp_share_transaction_id)){
			$rs = $this->dbSelect_where('share_sale_trans_charges', '*', array('trans_id' => $this->tmp_share_transaction_id));
			return $rs;
		}else{
			throw new Exception('Temp Share Sale Transaction data not loaded yet. Cannot execute get_debit_transaction_charge()');
		}
	}

	public function refund_transaction_charge(){
		$rs = $this->get_transaction_charge();
		foreach($rs as $trans){
			$acc = new account($trans['account_id'], 'share', 1);
			$member = new member($acc->member_id);
			$member->get_fund_account()->increase_account_bal($trans['share_trans_charge_amount']);
		}
	}
	
	public function effect_transaction(){
		if(!empty($this->tmp_share_transaction_id)){
			$acc = new account($this->tmp_account_id_credit, 'share', 1);
			$sender = new member($acc->member_id);
			
			$acc = new account($this->tmp_account_id_debit, 'share', 1);
			$recep = new member($acc->member_id);
			
			//echo $this->tmp_account_id_debit;
			
			$f = $this->tmp_share_transaction_amount*$this->tmp_share_value;
			$recep->get_fund_account()->reduce_account_bal($f);
			$sender->get_fund_account()->increase_account_bal($f);
			
			$sender->get_share_account()->reduce_account_bal($this->tmp_share_transaction_amount);
			$recep->get_share_account()->increase_account_bal($this->tmp_share_transaction_amount);
			
			$val = array(
					'account_id_credit' => $this->tmp_account_id_credit,
					'account_id_debit' => $this->tmp_account_id_debit,
					'share_transaction_approved_date' => date('Y-m-d H:i:s'),
					'share_transaction_request_date' => $this->tmp_share_transaction_date,
					'share_value' => $this->tmp_share_value,
					'share_transaction_amount'=>$this->tmp_share_transaction_amount
					);
			$ins = $this->dbInsert('share_sale_transaction',$val);
			$this->dbDelete('tmp_sale_share_transaction' , array('tmp_share_transaction_id' => $this->tmp_share_transaction_id));
			
			$ent = new entityData($sender->id);
			$ent->set_last_share_sale_trans_id($ins['last_insert_id']);
			
			$ent = new entityData($recep->id);
			$ent->set_last_share_sale_trans_id($ins['last_insert_id']);
		}else{
			throw new Exception('Temp Share Transaction data not loaded yet. Cannot approve share transfer');
		}
	}
	
	public function cancel_transaction(){
		if(!empty($this->tmp_share_transaction_id)){
			$this->refund_transaction_charge();
			$this->dbDelete('tmp_sale_share_transaction' , array('tmp_share_transaction_id' => $this->tmp_share_transaction_id));
		}else{
			throw new Exception('Temp Share Transaction data not loaded yet. Cannot approve share transfer');
		}
	}
}