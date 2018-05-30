<?php
class share_saleTransaction extends db{
	public $debit_account;
	public $credit_account;
	
	private $amount;
	private $share_value;

	public function __construct(account $debit_account, account $credit_account, $amount, $val){
		parent::__construct();
		$this->debit_account = $debit_account;
		$this->credit_account = $credit_account;
		$this->amount = $amount;
		$this->share_value = $val;
	}
	
	public function get_debit_account_transaction_charge(){
		return $this->registry->sacco_configs->debit_share_sale_charge;
	}

	public function get_credit_account_transaction_charge(){
		return $this->registry->sacco_configs->credit_share_sale_charge;
	}
	
	public function effect_transaction(){
		$val = array(
					'tmp_account_id_credit'=>$this->credit_account->id,
					'tmp_account_id_debit'=>$this->debit_account->id,
					'tmp_share_value'=>$this->share_value,
					'tmp_share_transaction_amount'=>$this->amount
					);
		$inst = $this->dbInsert('tmp_sale_share_transaction',$val);
		
		$trans_id = $inst['last_insert_id'];
		
		$cred_member = new member($this->credit_account->member_id);
		$deb_member = new member($this->debit_account->member_id);
		
		if($this->get_credit_account_transaction_charge() > 0){
			$this->trans_fee_charge($cred_member->get_fund_account(), $this->get_credit_account_transaction_charge(), $trans_id);
		}
		if($this->get_debit_account_transaction_charge() > 0){
			$this->trans_fee_charge($deb_member->get_fund_account(), $this->get_debit_account_transaction_charge(), $trans_id);
		}
	}
	
	private function trans_fee_charge(account $mem_account, $amount, $trans_id){
		if($amount<0) throw new Exception ('Share Trans-charge not effected, but share-sales have been effected. Invalid trans-charge supplied');
		$mem_account->reduce_account_bal($amount);
		$this->dbInsert('share_sale_trans_charges', array('trans_id'=>$trans_id, 'account_id'=>$mem_account->id, 'share_trans_charge_amount'=>$amount));
	}
}