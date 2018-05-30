<?php
class loan_payment extends db{	
	//public $loan_payment_id;
	public $id = 0;
	public $loan_id = 0;
	public $loan_payment_amount = 0;
	public $loan_balance = 0;
	public $loan_payment_date = '';
	
	public function __construct($id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'loan_payment';
			$field_array = '*';
			$cl = array('loan_id' => $id);
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Loan-Payment ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id=$mbr[0]['loan_payment_id'];
				$this->loan_id=$mbr[0]['loan_id'];
				$this->loan_payment_amount=$mbr[0]['loan_payment_amount'];
				$this->loan_balance=$mbr[0]['loan_balance'];
				$this->loan_payment_date=$mbr[0]['loan_payment_date'];
			}
		}
	}
	
	public function delete($id){
		if(!empty($id)){
			$this->dbDelete('loan_payment',array('loan_payment_id' => $id));
		}else{
			throw new Exception('Loan-Payment data not loaded. Delete cannot execute');
		}
	}
	
	public function delete_me(){
		if(!empty($this->id)){
			$this->dbDelete('loan_payment',array('loan_payment_id' => $this->id));
		}else{
			throw new Exception('Loan data not loaded. Delete cannot execute');
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('loan_payment', 
				array('loan_id' => $this->loan_id,
					'loan_payment_amount' => $this->loan_payment_amount,
					'loan_balance' => $this->loan_balance,
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('loan_payment', 
						array('loan_payment_amount' => $this->loan_payment_amount,
							'loan_balance' => $this->loan_balance,
							'loan_payment_date' => $this->loan_payment_date
							),
						array('loan_payment_id' => $this->id));
		}	
	}
	
	public function get_loan_payment_data_in_array($loan_id){
		if(!empty($loan_id)){
			$_loan_id = $loan_id;
		}else{
			if(empty($this->loan_id))throw New Exception('Loan-Payment ID required to retrieve loan-payment data');
			$_loan_id=$this->loan_id;
		}
		$table = 'loan_payment inner join loan on loan_payment.loan_id = loan.loan_id inner join member on member.member_id = loan.member_id';
		$mbr = $this->raw_select('select * from '.$table.' where loan_payment.loan_id='.$_loan_id);
		//echo 'select * from '.$table.' where loan_payment.loan_id='.$_loan_id;
		if(empty($mbr)){
			return 0;
		}else{
			return $mbr;
		}
	}
	
	public function get_loan_payment_count($loan_id){
		if(!empty($loan_id)){
			$_loan_id = $loan_id;
		}else{
			if(empty($this->loan_id))throw New Exception('Loan-Payment ID required to retrieve loan-payment data');
			$_loan_id=$this->loan_id;
		}
		$table = 'loan_payment inner join loan on loan_payment.loan_id = loan.loan_id inner join member on member.member_id = loan.member_id';
		$mbr = $this->raw_select('select count(*) from '.$table.' where loan_payment.loan_id='.$_loan_id);
		if(empty($mbr)){
			return 0;
		}else{
			return $mbr[0]['count(*)'];
		}
	}
	
	public function get_loan_payments_total($loan_id){
		if(!empty($loan_id)){
			$_loan_id = $loan_id;
		}else{
			if(empty($this->loan_id))throw New Exception('Loan-Payment ID required to retrieve loan-payment data');
			$_loan_id=$this->loan_id;
		}
		if($this->get_loan_payment_count($_loan_id)=='0') return 0;
		$table = 'loan_payment inner join loan on loan_payment.loan_id = loan.loan_id inner join member on member.member_id = loan.member_id';
		$mbr = $this->raw_select('select sum(loan_payment_amount) from '.$table.' where loan_payment.loan_id='.$_loan_id);
		if(empty($mbr)){
			return 0;
		}else{
			return $mbr[0]['sum(loan_payment_amount)'];
		}
	}
}