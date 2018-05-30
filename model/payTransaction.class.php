<?php
class fundTransaction extends db{

	private $debit_account;
	private $credit_account;
	
	private $amount;
	
	public function get_fund_trans_list_array($limit){
		$t = "fund_transaction";
		return $this->dbSelect($t, '*', $limit);
	}
	
	public function get_fund_trans_list_count(){
		$t = "fund_transaction";
		$row_count=$this->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}

	public function __construct(account $debit_account, account $credit_account, $amount){
		parent::__construct();
		$this->debit_account = $debit_account;
		$this->credit_account = $credit_account;
		if(!is_numeric($amount)) throw new Exception('Bad amount supplied');
		$this->amount=$amount;
	}
	
	public function get_debit_account_transaction_charge(){
		return $this->registry->sacco_configs->debit_fund_trans_charge;
	}

	public function get_credit_account_transaction_charge(){
		return $this->registry->sacco_configs->credit_fund_trans_charge;
	}
	
	public function effect_transaction(){
		$this->credit_account->reduce_account_bal($this->amount);
		$this->debit_account->increase_account_bal($this->amount);
		$val = array(
					'account_id_credit'=>$this->credit_account->id,
					'account_id_debit'=>$this->debit_account->id,
					'fund_transaction_amount'=>$this->amount
					);
		$inst = $this->dbInsert('fund_transaction',$val);
		$trans_id = $inst['last_insert_id'];
		$ent = new entityData($this->credit_account->member_id);
		$ent->set_last_fund_trans_id($trans_id);
		$ent = new entityData($this->debit_account->member_id);
		$ent->set_last_fund_trans_id($trans_id);
		if($this->get_credit_account_transaction_charge() > 0){
			$this->trans_fee_charge($this->credit_account, $this->get_credit_account_transaction_charge(), $trans_id);
		}
		if($this->get_debit_account_transaction_charge() > 0){
			$this->trans_fee_charge($this->debit_account, $this->get_debit_account_transaction_charge(), $trans_id);
		}
	}
	
	private function trans_fee_charge(account $mem_account, $amount, $trans_id){
		if($amount<0) throw new Exception ('Trans-charge not effected, but transactions have been effected. Invalid trans-charge supplied');
		$mem_account->reduce_account_bal($amount);
		$this->dbInsert('fund_trans_charges', array('trans_id'=>$trans_id, 'account_id'=>$mem_account->id, 'fund_trans_charge_amount'=>$amount));
	}
	
}