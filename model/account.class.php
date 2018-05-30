<?php
class account extends db{
	public $id=null;
	public $member_id = null;
	public $type=null;
	public $table=null;
	public $account_debit=null;
	public $account_credit=null;
	
	public function __construct($mem_id, $type, $admin=0){
		parent::__construct();
		if($type != 'fund' && $type != 'share'){
			throw new Exception('Unknown Account Type Defined');
		}
		$this->table = $type.'_account';
		$field_array = array($type.'_account_id', 'member_id', $type.'_account_debit', $type.'_account_credit', $type.'_account_active');
		$this->type = $type;
		if($admin==0){
			$this->member_id = $mem_id;
			$mbr = $this->dbSelect_where($this->table, $field_array, array('member_id' => $this->member_id));
		}else{
			$mbr = $this->dbSelect_where($this->table, $field_array, array($type.'_account_id' => $mem_id));	
		}
		if(empty($mbr)){
			throw new Exception($type.' account data not found in database. Records deleted?');
		}else if($mbr[0][$type.'_account_active']=='0'){
			throw new Exception($type.' account inactivated');
		}else{
			$this->id=$mbr[0][$type.'_account_id'];
			$this->member_id=$mbr[0]['member_id'];
			$this->account_debit=$mbr[0][$type.'_account_debit'];
			$this->account_credit=$mbr[0][$type.'_account_credit'];
		}
	}

	public function get_account_bal(){
		return $this->account_debit - $this->account_credit;
	}
	
	public function reduce_account_bal($amount){
		if(!is_numeric($amount)){
			throw new Exception('Invalid amount supplied for account balance reduction');
		}else if($this->get_account_bal() < $amount){
			throw new Exception('Reduction amount is more than account balance');
		}
		$this->update_account_bal('_account_credit',$amount);
	}
	
	public function increase_account_bal($amount){
		if(!is_numeric($amount)){
			throw new Exception('Invalid amount supplied for account balance increase');
		}
		$this->update_account_bal('_account_debit',$amount);
	}
	
	private function update_account_bal($fld, $amount){
		try{
		
		$this->db->beginTransaction();
		$upd_acc = 'update '.$this->table.' set '.$this->type.$fld.' = '.$this->type.$fld.' + '.$amount.' where '.$this->type.'_account_id='.$this->id;
		$this->db->exec($upd_acc);
		$this->db->commit();
		$this->refresh_values();		
		}catch(PDOException $e){
			$this->db->rollback();
			throw new Exception($e->getMessage());
		}
	}
	
	private function refresh_values(){
		$field_array = array($this->type.'_account_debit', $this->type.'_account_credit', $this->type.'_account_active');
		$mbr = $this->dbSelect_where($this->table, $field_array, array($this->type.'_account_id' => $this->id));
		if(empty($mbr)){
			throw new Exception($this->type.' account data not found in database. Records deleted?');
		}else if($mbr[0][$this->type.'_account_active']=='0'){
			throw new Exception($this->type.' account inactivated');
		}else{
			$this->account_debit=$mbr[0][$this->type.'_account_debit'];
			$this->account_credit=$mbr[0][$this->type.'_account_credit'];
		}
	}
}