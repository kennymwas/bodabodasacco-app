<?php
class loan extends db {
	public $id = null;
	public $member_id = null;
	public $loan_amount = 0;
	public $loan_type_id = 0;
	public $loan_payment_months = 0;
	public $loan_interest = 0;
	public $loan_approved = 0;
	public $loan_final_payment = 0;
	public $loan_monthly_payment = 0;
	public $loan_payment_completed = 0;
	public function __construct($id='', $mem_id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'loan';
			$field_array = '*';
			if(empty($mem_id)){
				$cl = array('loan_id' => $id);
			}else{
				$cl = array('loan_id' => $id, 'member_id' => $mem_id);
			}
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Loan ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id=$mbr[0]['loan_id'];
				$this->member_id=$mbr[0]['member_id'];
				$this->loan_amount=$mbr[0]['loan_amount'];
				$this->loan_type_id=$mbr[0]['loan_type_id'];
				$this->loan_payment_months=$mbr[0]['loan_payment_months'];
				$this->loan_interest=$mbr[0]['loan_interest'];
				$this->loan_approved=$mbr[0]['loan_approved'];
				$this->loan_final_payment=$mbr[0]['loan_final_payment'];
				$this->loan_monthly_payment=$mbr[0]['loan_monthly_payment'];
				$this->loan_payment_completed=$mbr[0]['loan_payment_completed'];
			}
		}
	}
	
	public function complete_loan_payment($status){
		if(!isset($this->id)) throw new Exception('Loan data not loaded. Loan status update cannot execute');
		$this->dbUpdate('loan', array('loan_payment_completed' => $this->loan_payment_completed),array('loan_id' => $this->id));
		$this->loan_payment_completed = $status;
	}
	
	public function delete($id){
		if(!empty($id)){
			$this->dbDelete('loan',array('loan_id' => $id));
		}else{
			throw new Exception('Loan data not loaded. Delete cannot execute');
		}
	}
	
	public function delete_me(){
		if(!empty($this->id)){
			$this->dbDelete('loan',array('loan_id' => $this->id));
		}else{
			throw new Exception('Loan data not loaded. Delete cannot execute');
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('loan', 
				array('member_id' => $this->member_id, 
					'loan_amount' => $this->loan_amount, 
					'loan_type_id' => $this->loan_type_id, 
					'loan_payment_months' => $this->loan_payment_months,
					'loan_interest' => $this->loan_interest,
					'loan_approved' => '0',
					'loan_final_payment' => $this->loan_final_payment,
					'loan_monthly_payment' => $this->loan_monthly_payment
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('loan', 
						array('loan_amount' => $this->loan_amount,
							'loan_type_id' => $this->loan_type_id,
							'loan_payment_months' => $this->loan_payment_months,
							'loan_interest' => $this->loan_interest,
							'loan_approved' => $this->loan_approved,
							'loan_final_payment' => $this->loan_final_payment,
							'loan_monthly_payment' => $this->loan_monthly_payment
						),
						array('loan_id' => $this->id));
		}	
	}
	
	public function get_loan_total($mem_id){
		if(!empty($mem_id)){
			$mbr = $this->dbSelect_where('loan', '*', array('member_id' => $mem_id));
			if(empty($mbr)){
				return 0;
			}else{
				$loan_total = 0;
				foreach($mbr as $rec){
					$loan_total += $rec['loan_amount'];
				}
				return $loan_total;
			}
		}else{
			throw New Exception('Member ID required to retrieve loan data');
		}
	}
	
	public function get_all_loan_data_array(){
		if(!empty($id)){
			$mbr = $this->dbSelect('loan', '*');
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Member ID required to retrieve loan data');
		}
	}
	
	public function get_loan_data_array($id){
		if(!empty($id)){
			$mbr = $this->dbSelect_where('loan', '*', array('member_id' => $id));
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Member ID required to retrieve loan data');
		}
	}
}