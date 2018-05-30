<?php
Class loanController extends admin_base_controller{
	
	public function indexAction() {
		$this->listAction();
	}
	
	public function add_loan_typeAction(){
		$this->registry->template->_page_title = 'Loan-Type Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_loan_type'])){
				$p = $this->registry->router->args['_POST'];
				$lt = new loan_type();
				if(!is_numeric($p['loan_type_min_months']) || !is_numeric($p['loan_type_max_months']) 
				|| !is_numeric($p['loan_type_min_amount']) || !is_numeric($p['loan_type_max_amount']) 
				|| !is_numeric($p['loan_type_share_threshold']) || !is_numeric($p['loan_type_fund_threshold']) || !is_numeric($p['loan_type_account_age_threshold'])){
					throw new Exception('Invalid data posted. Non-numeric data posted where numeric data is expected');
				}
				$lt->loan_type_name = $p['loan_type_name'];
				$lt->loan_type_min_months = $p['loan_type_min_months'];
				$lt->loan_type_max_months = $p['loan_type_max_months'];
				$lt->loan_type_min_amount = $p['loan_type_min_amount'];
				$lt->loan_type_max_amount = $p['loan_type_max_amount'];
				$lt->loan_type_share_threshold = $p['loan_type_share_threshold'];
				$lt->loan_type_fund_threshold = $p['loan_type_fund_threshold'];
				$lt->loan_type_account_age_threshold = $p['loan_type_account_age_threshold'];
				$lt->loan_type_interest = $p['loan_type_interest'];
				
				$lt->save();
				
				$this->registry->template->info_msg = 'Operation executed successfully';
				
				$this->list_loan_typesAction();
			}else{
				$this->registry->template->show('admin/add_loan_type');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Error: ".$err->getMessage();
			$this->registry->template->show('admin/add_loan_type');
		}
	}
	
	public function delete_loan_typeAction(){
		//echo "xxx";exit;
		$this->registry->template->_page_title = 'Loan-Type Data';
		try{
			if(!empty($this->registry->router->args['_PATH'][3]) && !isset($this->registry->router->args['_POST']['edit_loan_type'])){
				$loan_type = new loan_type($this->registry->router->args['_PATH'][3]);
				$loan_type->delete_me();
				$this->registry->template->info_msg = 'Operation executed successfully';
				$this->list_loan_typesAction();
			}else{
				$this->registry->template->error_msg = 'Invalid URL supplied. Cannot delete loan-type';
				$this->list_loan_typesAction();
			}
		}catch(Exception $er){
			$this->registry->template->error_msg = $er->getMessage();
			$this->list_loan_typesAction();
		}
	}
	
	
	public function edit_loan_typeAction(){
		//echo "xxx";exit;
		$this->registry->template->_page_title = 'Loan-Type Data';
		try{
			if(!empty($this->registry->router->args['_PATH'][3]) && !isset($this->registry->router->args['_POST']['edit_loan_type'])){
				$loan_type = new loan_type($this->registry->router->args['_PATH'][3]);
				$this->registry->template->loan_type_id = $loan_type->id;
				$this->registry->template->loan_type_name = $loan_type->loan_type_name;
				$this->registry->template->loan_type_min_months = $loan_type->loan_type_min_months;
				$this->registry->template->loan_type_max_months = $loan_type->loan_type_max_months;
				$this->registry->template->loan_type_min_amount = $loan_type->loan_type_min_amount;
				$this->registry->template->loan_type_max_amount = $loan_type->loan_type_max_amount;
				$this->registry->template->loan_type_share_threshold = $loan_type->loan_type_share_threshold;
				$this->registry->template->loan_type_fund_threshold = $loan_type->loan_type_fund_threshold;
				$this->registry->template->loan_type_account_age_threshold = $loan_type->loan_type_account_age_threshold;
				$this->registry->template->loan_type_interest = $loan_type->loan_type_interest;
				$this->registry->template->show('admin/edit_loan_type');
			}else if(isset($this->registry->router->args['_POST']['edit_loan_type'])){
				$p = $this->registry->router->args['_POST'];
				$lt = new loan_type( $p['edit_loan_type']);
				if(!is_numeric($p['loan_type_min_months']) || !is_numeric($p['loan_type_max_months']) 
				|| !is_numeric($p['loan_type_min_amount']) || !is_numeric($p['loan_type_max_amount']) 
				|| !is_numeric($p['loan_type_share_threshold']) || !is_numeric($p['loan_type_fund_threshold']) || !is_numeric($p['loan_type_account_age_threshold'])
				|| !is_numeric($p['loan_type_interest'])){
					throw new Exception('Invalid data posted. Non-numeric data posted where numeric data is expected');
				}
				if($p['loan_type_interest']>100) throw new Exception('Invalid loan interest');
				$lt->loan_type_name = $p['loan_type_name'];
				$lt->loan_type_min_months = $p['loan_type_min_months'];
				$lt->loan_type_max_months = $p['loan_type_max_months'];
				$lt->loan_type_min_amount = $p['loan_type_min_amount'];
				$lt->loan_type_max_amount = $p['loan_type_max_amount'];
				$lt->loan_type_share_threshold = $p['loan_type_share_threshold'];
				$lt->loan_type_fund_threshold = $p['loan_type_fund_threshold'];
				$lt->loan_type_account_age_threshold = $p['loan_type_account_age_threshold'];
				$lt->loan_type_interest = $p['loan_type_interest'];
				
				$lt->save();
				
				$this->registry->template->info_msg = 'Operation executed successfully';
				
				$this->list_loan_typesAction();
			}else{
				$this->registry->template->error_msg = 'Invalid URL supplied. Cannot edit loan-type';
				$this->list_loan_typesAction();
			}
		}catch(Exception $er){
			$this->registry->template->error_msg = $er->getMessage();
			$this->list_loan_typesAction();
		}
	}
	
	public function list_loan_typesAction(){
		$this->registry->template->_page_title = 'Loan-Type Data';
		try{
			$loan_type = new loan_type();
			$this->registry->template->loan_type_list = $loan_type->get_loan_type_data_array();
			$this->registry->template->loan_type_list_count = sizeof($this->registry->template->loan_type_list);
			$this->registry->template->show('admin/loan_type_list');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Error: ".$err->getMessage();
			$this->registry->template->show('admin/loan_type_list');
		}
	}
	
	public function test_loanAction(){
		$ent = new entityData($_SESSION['admin_log']['id']);
		echo $_SESSION['admin_log']['id'].' :'.$ent->get_loan_total($_SESSION['admin_log']['id']);
	}
	
	public function check_if_logged(){
		if(!isset($_SESSION['admin_log'])){
			$this->header_redirect('member/login/1');
			exit;
		}
		return;
	}
	
	public function get_loan_list_count(){
		$t = "loan";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
	public function get_loan_list(){
		$t = "loan INNER JOIN member ON member.member_id = loan.member_id";
		$db = new db();
		$dt=$db->dbSelect($t, '*');
		return $dt;
	}
	
	public function listAction(){
		
		$this->registry->template->_page_title = 'Loan Data';
		try{
			$ent = new entityData('-1');
			$this->registry->template->total_loan_amount = $ent->get_loan_total_in_db();
			$this->registry->template->loan_list = $this->get_loan_list();
			$this->registry->template->loan_list_count = sizeof($this->registry->template->loan_list);
			$this->registry->template->show('admin/loan_list');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Error: ".$err->getMessage();
			$this->registry->template->show('admin/loan_list');
		}
		
	}
	
	public function drop_requestAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$loan =  new loan($this->registry->router->args['_PATH'][3]);
				$loan->delete_me();
				$this->registry->template->info_msg = 'Request Dropped';
				$this->listAction();
			}else{
				$this->registry->template->error_msg = 'Loan ID not specified';
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Error: ".$err->getMessage();
			$this->listAction();
		}
	}
	
	public function approve_loanAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$loan =  new loan($this->registry->router->args['_PATH'][3]);
				$loan->loan_approved = '1';
				$loan->save();
				$this->registry->template->info_msg = 'Request Approved';
				$this->listAction();
			}else{
				$this->registry->template->error_msg = 'Loan ID not specified';
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Error: ".$err->getMessage();
			$this->listAction();
		}
	}
	
	public function loan_paymentsAction(){
		$this->registry->template->_page_title = 'Loan-Payments';
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$loan_payment = new loan_payment();
				
				$this->registry->template->loan_payment_list = $loan_payment->get_loan_payment_data_in_array($this->registry->router->args['_PATH'][3]);
				$this->registry->template->loan_payment_count = $loan_payment->get_loan_payment_count($this->registry->router->args['_PATH'][3]);
				$this->registry->template->loan_payment_total = $loan_payment->get_loan_payments_total($this->registry->router->args['_PATH'][3]);
				
				//print_r($this->registry->template->loan_payment_list);
				$this->registry->template->show('admin/loan_payments');
			}else{
				$this->registry->template->error_msg = "Bad URL. Valid Loan ID required in URL";
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Error: ".$err->getMessage();
			$this->listAction();
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