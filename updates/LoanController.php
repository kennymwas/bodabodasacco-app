<?php
Class loanController Extends base_controller{
	
	public function indexAction() {
		$this->listAction();
	}
	
	public function test_loanAction(){
		$ent = new entityData($_SESSION['log']['id']);
		echo $_SESSION['log']['id'].' :'.$ent->get_loan_total($_SESSION['log']['id']);
	}
	
	public function check_if_logged(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			exit;
		}
		return;
	}
	
	public function listAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Loan Data';
		try{
			$loan = new loan();
			$ent = new entityData($_SESSION['log']['id']);
			$this->registry->template->total_loan_amount = $ent->get_loan_total($_SESSION['log']['id']);
			$this->registry->template->loan_list = $loan->get_loan_data_array($_SESSION['log']['id']);
			$this->registry->template->loan_list_count = sizeof($this->registry->template->loan_list);
			$this->registry->template->show('manage_loan');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->addAction();
		}
	}
	
	public function list_paymentsAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Loan-Payments';
		try{
			if(isset($this->registry->router->args['_PATH'][2])){
				$loan = new loan($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$loan_payment = new loan_payment();
				
				$this->registry->template->loan_payment_list = $loan_payment->get_loan_payment_data_in_array($this->registry->router->args['_PATH'][2]);
				$this->registry->template->loan_payment_count = $loan_payment->get_loan_payment_count($this->registry->router->args['_PATH'][2]);
				$this->registry->template->loan_payment_total = $loan_payment->get_loan_payments_total($this->registry->router->args['_PATH'][2]);
				
				//print_r($this->registry->template->loan_payment_list);
				$this->registry->template->show('manage_loan_payment');
			}else{
				$this->registry->template->error_msg = "Bad URL. Valid Loan ID required in URL";
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->listAction();
		}
	}
	
	public function drop_requestAction(){
		$this->check_if_logged();
		try{
			if(isset($this->registry->router->args['_PATH'][2])){
				$loan =  new loan($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				if($loan->loan_approved) throw new Exception('Cannot drop request. Loan has been approved');
				$loan->delete_me();
				$this->registry->template->info_msg = 'Request Dropped';
				$this->listAction();
			}else{
				$this->registry->template->error_msg = 'Loan ID not specified';
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->listAction();
		}
	}
	
	public function addAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Add Loan';
		$this->registry->template->loan_max = $this->registry->template->_share_value * 3;
		
		$this->registry->template->loan_type_name = 'N/A';
		$this->registry->template->loan_type_min_months = 'N/A';
		$this->registry->template->loan_type_max_months = 'N/A';
		$this->registry->template->site_currency.$this->registry->template->loan_type_min_amount = 'N/A';
		$this->registry->template->site_currency.$this->registry->template->loan_type_max_amount = 'N/A';
		$this->registry->template->loan_type_interest = 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['add_loan']) && !isset($_SESSION['loan_req'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$loan_max = $this->registry->template->_share_value * 3;
				
				$this->registry->template->loan_type_id = $ps['loan_type_id'];
				
				$loan_type = new loan_type($ps['loan_type_id']);
				$this->registry->template->loan_type_name = $loan_type->loan_type_name;
				$this->registry->template->loan_type_min_months = $loan_type->loan_type_min_months;
				$this->registry->template->loan_type_max_months = $loan_type->loan_type_max_months;
				$this->registry->template->loan_type_min_amount = $loan_type->loan_type_min_amount;
				$this->registry->template->loan_type_max_amount = $loan_type->loan_type_max_amount;
				$this->registry->template->loan_type_interest = $loan_type->loan_type_interest;
				
				$ent = new entityData($_SESSION['log']['id']);
				if(!is_numeric($ps['loan_amount']) || !is_numeric($ps['loan_payment_months'])) throw new Exception ('Invalid (non-numeric) data supplied');
				if(!is_numeric($ps['loan_amount']) || !is_numeric($ps['loan_payment_months'])) throw new Exception ('Invalid (negative) data supplied');
				if(($ent->get_loan_total($_SESSION['log']['id']) + $ps['loan_amount']) > $loan_max ){
					throw new Exception ('Loan request will exceed your max loan threshold, valued at three times your share value.');
				}
				
				if(($ps['loan_payment_months']<$loan_type->loan_type_min_months && $loan_type->loan_type_min_months!=0)){
					throw new Exception ('Your payment period is less than the valid repayment period for that loan type');
				}
				
				if($ps['loan_payment_months']>$loan_type->loan_type_max_months && $loan_type->loan_type_max_months!=0){
					throw new Exception ('Your payment period is more than the valid repayment period for that loan type:'. $ps['loan_payment_months']);
				}
				
				if(($ps['loan_amount']<$loan_type->loan_type_min_amount && $loan_type->loan_type_min_amount !=0) || ($ps['loan_amount']>$loan_type->loan_type_max_amount && $loan_type->loan_type_max_amount!=0)){
					throw new Exception ('Your loan amount exceeds the valid loan amount for that loan type');
				}
				
				if($this->registry->template->_fund_balance < $loan_type->loan_type_fund_threshold){
					throw new Exception ('Your fund balance does not meet the fund-threshold for this loan type');
				}
				
				if($this->registry->template->_share_balance < $loan_type->loan_type_share_threshold){
					throw new Exception ('Your share balance does not meet the share-threshold for this loan type');
				}
				
				$princ = $ps['loan_amount'];
				$term  = $ps['loan_payment_months'];
				$intr  = $loan_type->loan_type_interest / 1200;
				$monthly_value = round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))),2);
				$total_value = $monthly_value * $term;
				
				$_SESSION['loan_req']['loan_amount'] = $princ;
				$_SESSION['loan_req']['loan_payment_months'] = $term;
				$_SESSION['loan_req']['loan_interest'] = $loan_type->loan_type_interest;
				$_SESSION['loan_req']['loan_type_id'] = $loan_type->id;
				$_SESSION['loan_req']['loan_final_payment'] = $total_value;
				$_SESSION['loan_req']['loan_monthly_payment'] = $monthly_value;
				
				$this->registry->template->loan_amount = $_SESSION['loan_req']['loan_amount'];
				$this->registry->template->loan_payment_months = $_SESSION['loan_req']['loan_payment_months'];
				$this->registry->template->loan_final_payment = $_SESSION['loan_req']['loan_final_payment'];
				$this->registry->template->loan_monthly_payment = $_SESSION['loan_req']['loan_monthly_payment'];
				$this->registry->template->loan_interest = $loan_type->loan_type_interest;
				
				$this->registry->template->show('add_loan');
				
			}else if(isset($_SESSION['loan_req'])){
				$this->registry->template->loan_amount = $_SESSION['loan_req']['loan_amount'];
				$this->registry->template->loan_payment_months = $_SESSION['loan_req']['loan_payment_months'];
				$this->registry->template->loan_final_payment = $_SESSION['loan_req']['loan_final_payment'];
				$this->registry->template->loan_monthly_payment = $_SESSION['loan_req']['loan_monthly_payment'];
				$this->registry->template->loan_type_interest = $_SESSION['loan_req']['loan_interest'];
				$this->registry->template->show('add_loan');
			}else if(isset($this->registry->router->args['_PATH'][2])){
				$loan_type = new loan_type($this->registry->router->args['_PATH'][2]);
				$this->registry->template->loan_type_name = $loan_type->loan_type_name;
				$this->registry->template->loan_type_min_months = $loan_type->loan_type_min_months;
				$this->registry->template->loan_type_max_months = $loan_type->loan_type_max_months;
				$this->registry->template->loan_type_min_amount = $loan_type->loan_type_min_amount;
				$this->registry->template->loan_type_max_amount = $loan_type->loan_type_max_amount;
				$this->registry->template->loan_type_interest = $loan_type->loan_type_interest;
				$this->registry->template->mod_1 = 1;
				$this->registry->template->loan_type_id = $this->registry->router->args['_PATH'][2];
				$this->registry->template->show('add_loan');
			}else{
				$this->list_typesAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->mod_1 = 1;
			$this->registry->template->show('add_loan');
		}
	}
	
	public function request_loanAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Add Loan';
		$this->registry->template->loan_interest = $this->registry->sacco_configs->loan_interest_rate;
		try{
			if(isset($_SESSION['loan_req'])){
				$loan = new loan();
				
				$loan->member_id=$_SESSION['log']['id'];
				
				$loan->loan_amount = $_SESSION['loan_req']['loan_amount'];
				$loan->loan_type_id = $_SESSION['loan_req']['loan_type_id'];
				$loan->loan_payment_months = $_SESSION['loan_req']['loan_payment_months'];
				$loan->loan_interest = $_SESSION['loan_req']['loan_interest'];
				$loan->loan_final_payment = $_SESSION['loan_req']['loan_final_payment'];
				$loan->loan_monthly_payment = $_SESSION['loan_req']['loan_monthly_payment'];
				
				//echo $_SESSION['loan_req']['loan_interest'];
				
				$loan->save();
				
				unset($_SESSION['loan_req']);
				
				$this->listAction();
				
			}else{
				$this->registry->template->mod_1 = 1;
				$this->registry->template->error_msg = "Apply for loan first" ;
				$this->addAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->addAction();
		}
	}
	
	public function make_paymentAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Make Loan-Payment';
		$this->registry->template->loan_balance = 'N/A';
		$this->registry->template->loan_id = 0;
		try{
			if(isset($this->registry->router->args['_POST']['add_loan_payment']) && isset($this->registry->router->args['_POST']['loan_payment_amount'])){
				$loan_id = $this->registry->router->args['_POST']['add_loan_payment'];
				$pay_amount = $this->registry->router->args['_POST']['loan_payment_amount'];
				$loan = new loan($loan_id, $_SESSION['log']['id']);
				$loan_payment = new loan_payment();
				$bal = $loan->loan_final_payment - $loan_payment->get_loan_payments_total($loan_id) - $pay_amount;
				$loan_payment->loan_id = $this->registry->router->args['_POST']['add_loan_payment'];
				$loan_payment->loan_payment_amount = $pay_amount;
				$loan_payment->loan_balance = $bal;
				
				$loan_payment->save();
				
				$this->registry->template->info_msg = "Payment Successful";
				
				$this->listAction();
			}else if(isset($this->registry->router->args['_PATH'][2])){
				$loan = new loan($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$this->registry->template->loan_balance = $loan->loan_final_payment;
				$this->registry->template->loan_id = $this->registry->router->args['_PATH'][2];
				$this->registry->template->add_loan_payment = $this->registry->router->args['_PATH'][2];
				$this->registry->template->show('add_loan_payment');
			}else{
				$this->registry->template->error_msg = "Bad URL. Valid Loan ID required in URL";
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->listAction();
		}
	}
	
	public function list_typesAction(){
		$this->registry->template->_page_title = 'Loan-Types';
		try{
			$loan_type = new loan_type();
			$this->registry->template->loan_type_list = $loan_type->get_loan_type_data_array();
			$this->registry->template->loan_type_list_count = sizeof($this->registry->template->loan_type_list);
			$this->registry->template->show('loan_type_listing');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('loan_type_listing');
		}
	}
	
	public function cancelAction(){
		unset($_SESSION['loan_req']);
		$this->header_redirect('member');
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->registry->template->show('value_transfer');
	}	
}