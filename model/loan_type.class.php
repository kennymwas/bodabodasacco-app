<?php
class loan_type extends db{
	public $id = 0;
	public $loan_type_name = '';
	public $loan_type_min_months = 0;
	public $loan_type_max_months = 0;
	public $loan_type_min_amount = 0;
	public $loan_type_max_amount = 0;
	public $loan_type_share_threshold = 0;
	public $loan_type_fund_threshold = 0;
	public $loan_type_account_age_threshold = 0;
	public $loan_type_interest = 0;
	
	public function __construct($id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'loan_types';
			$field_array = '*';
			$cl = array('loan_type_id' => $id);
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Loan-Type ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id = $mbr[0]['loan_type_id'];
				$this->loan_type_name = $mbr[0]['loan_type_name'];
				$this->loan_type_min_months = $mbr[0]['loan_type_min_months'];
				$this->loan_type_max_months = $mbr[0]['loan_type_max_months'];
				$this->loan_type_min_amount = $mbr[0]['loan_type_min_amount'];
				$this->loan_type_max_amount = $mbr[0]['loan_type_max_amount'];
				$this->loan_type_share_threshold = $mbr[0]['loan_type_share_threshold'];
				$this->loan_type_fund_threshold = $mbr[0]['loan_type_fund_threshold'];
				$this->loan_type_account_age_threshold = $mbr[0]['loan_type_account_age_threshold'];
				$this->loan_type_interest = $mbr[0]['loan_type_interest'];
			}
		}
	}
	
	public function delete($id){
		if(!empty($id)){
			$this->dbDelete('loan_types',array('loan_type_id' => $id));
		}else{
			throw new Exception('Loan-Type data not loaded. Delete cannot execute');
		}
	}
	
	public function delete_me(){
		if(!empty($this->id)){
			$this->dbDelete('loan_types',array('loan_type_id' => $this->id));
		}else{
			throw new Exception('Loan-Type data not loaded. Delete cannot execute');
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('loan_types', 
				array('loan_type_name' => $this->loan_type_name,
					'loan_type_min_months' => $this->loan_type_min_months,
					'loan_type_max_months' => $this->loan_type_max_months,
					'loan_type_min_amount' => $this->loan_type_min_amount,
					'loan_type_max_amount' => $this->loan_type_max_amount,
					'loan_type_share_threshold' => $this->loan_type_share_threshold,
					'loan_type_fund_threshold' => $this->loan_type_fund_threshold,
					'loan_type_account_age_threshold' => $this->loan_type_account_age_threshold,
					'loan_type_interest' => $this->loan_type_interest
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('loan_types', 
				array('loan_type_name' => $this->loan_type_name,
					'loan_type_min_months' => $this->loan_type_min_months,
					'loan_type_max_months' => $this->loan_type_max_months,
					'loan_type_min_amount' => $this->loan_type_min_amount,
					'loan_type_max_amount' => $this->loan_type_max_amount,
					'loan_type_share_threshold' => $this->loan_type_share_threshold,
					'loan_type_fund_threshold' => $this->loan_type_fund_threshold,
					'loan_type_account_age_threshold' => $this->loan_type_account_age_threshold,
					'loan_type_interest' => $this->loan_type_interest
						),
						array('loan_type_id' => $this->id));
		}	
	}
	
	public function get_loan_type_data_array(){
		$mbr = $this->dbSelect('loan_types', '*');
		if(empty($mbr)){
			return array();
		}else{
			return $mbr;
		}
	}
}