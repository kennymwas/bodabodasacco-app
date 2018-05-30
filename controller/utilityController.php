<?php
Class utilityController extends base_controller{
	public function indexAction(){
		$this->listAction();
	}
	
	public function errorAction(){
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}
	
	public function check_if_logged(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			exit;
		}
		return;
	}
	
	public function paymentsAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Utility-Payments';
		try{
			if(isset($this->registry->router->args['_PATH'][2])){
				$utility = new utility($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$utility_payment = new utility_payment();
				
				$this->registry->template->_page_title = 'Utility-Payments: '.$utility->utility_name;
				$this->registry->template->utility_payment_list = $utility_payment->get_utility_payment_data_in_array($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$this->registry->template->utility_payment_count = $utility_payment->get_utility_payment_count($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$this->registry->template->utility_payment_total = $utility_payment->get_utility_payments_total($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				
				//print_r($this->registry->template->loan_payment_list);
				$this->registry->template->show('manage_utility_payment');
			}else{
				$this->registry->template->error_msg = "Bad URL. Valid Utility ID required in URL";
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->listAction();
		}
	}
	
	public function payAction(){
		try{
			$this->check_if_logged();
			$this->registry->template->utility_id = 'N/A';
			$this->registry->template->utility_name = 'N/A';
			$this->registry->template->payment_charge = $this->registry->sacco_configs->utility_payment_transaction_charge;
			if(isset($this->registry->router->args['_PATH'][2]) && !isset($this->registry->router->args['_POST'])){
				$ut = new utility($this->registry->router->args['_PATH'][2]);
				$this->registry->template->utility_id= $ut->utility_id;
				$this->registry->template->utility_name = $ut->utility_name;
				$this->registry->template->payment_charge = $this->registry->sacco_configs->utility_payment_transaction_charge;
				$this->registry->template->show('utility_pay');
			}else if(isset($this->registry->router->args['_POST']['pay_utility'])){
				if(!is_numeric($this->registry->router->args['_POST']['pay_amount'])){
					throw new Exception('Invalid payment amount specified');
				}else if($this->registry->router->args['_POST']['pay_amount']<1){
					throw new Exception('Invalid payment amount specified');
				}
				$ut = new utility($this->registry->router->args['_POST']['pay_utility']);
				$this->registry->template->utility_id= $ut->utility_id;
				$this->registry->template->utility_name = $ut->utility_name;
				$this->registry->template->payment_charge = $this->registry->sacco_configs->utility_payment_transaction_charge;
				if($this->registry->template->_fund_balance < ($this->registry->template->payment_charge + $this->registry->router->args['_POST']['pay_amount'])){
					throw new Exception('You lack enough funds for that payment');
				}
				$member = new member($_SESSION['log']['id']);
				$member->get_fund_account()->reduce_account_bal($this->registry->template->payment_charge + $this->registry->router->args['_POST']['pay_amount']);
				$this->registry->template->_fund_balance = $member->get_fund_account()->get_account_bal();
				$up = new utility_payment();
				$up->utility_id = $ut->utility_id;
				$up->member_id = $_SESSION['log']['id'];
				$up->utility_payment_amount = $this->registry->router->args['_POST']['pay_amount'];
				$up->utility_payment_charge = $this->registry->sacco_configs->utility_payment_transaction_charge;
				$up->save();
				$this->registry->template->info_msg = 'Payment successful';
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->registry->template->show('utility_pay');
		}
	}
	
	public function listAction(){
		try{
			$this->check_if_logged();
			$this->registry->template->_page_title = 'Your Utility Accounts';
			$ut = new utility();
			$this->registry->template->utility_count = $ut->get_mem_utility_count($_SESSION['log']['id']);
			if($this->registry->template->utility_count==0){
				$this->registry->template->no_page_info = 'No utilities-accounts have been defined';
			}else{
				$this->registry->template->utility_list = $ut->get_mem_utilities($_SESSION['log']['id']);
			}
			$this->registry->template->show('utility_list');
		}catch(Exception $err){
			echo "Some error occured. Cannot list utilities :<br/><br/>".$err->getMessage();
		}
	}
	
	public function addAction(){
		try{
			$this->check_if_logged();
			$this->registry->template->_page_title = 'Add Utility';
			
			if(isset($this->registry->router->args['_PATH'][2])  && !empty($this->registry->router->args['_POST']['utility_account_number'])){
				$ut = new utility($this->registry->router->args['_PATH'][2]);
				if(!$ut->utility_available){
					throw new Exception('That utility has been disabled and is unavailable');
				}else{
					$utm = new utility_member();
					$utm->utility_member_utility_id = $ut->utility_id;
					$utm->utility_member_member_id = $_SESSION['log']['id'];
					$utm->utility_member_account = $this->registry->router->args['_POST']['utility_account_number'];
					$utm->save();
					$this->registry->template->info_msg = 'Addition successful';
					$this->listAction();
				}
			}else if(isset($this->registry->router->args['_PATH'][2])){
				$ut = new utility($this->registry->router->args['_PATH'][2]);
				$this->registry->template->account_name = $ut->utility_name;
				$this->registry->template->show('utility_add_account');
			}else{
				$ut = new utility();
				$this->registry->template->utility_count = $ut->get_table_row_count();
				if($this->registry->template->utility_count==0){
					$this->registry->template->no_page_info = 'No utilities-accounts have been defined';
				}else{
					$this->registry->template->utility_list = $ut->get_all_utility_data();
				}
				$this->registry->template->utility_list = $ut->get_all_utility_data();
				$this->registry->template->show('utility_add');
			}
		}catch(Exception $err){
			if(substr($err->getMessage(), 0, 15)=="SQLSTATE[23000]"){
				$this->registry->template->error_msg = 'A utility-account record already exists with that utility name';
			}else{
				$this->registry->template->error_msg = $err->getMessage();
			}
			$this->listAction();
		}
	}
	
	public function removeAction(){
		try{
			$this->check_if_logged();
			if(isset($this->registry->router->args['_PATH'][2])){
				$utm = new utility_member($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$utm->delete_me();
				$this->registry->template->info_msg = 'Deletion successful';
				$this->listAction();
			}else{
				throw new Exception('Bad URL. Cannot delete utility record');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
	
	private function load_utility_data($id){
		$ut = new utility($id);
		$this->registry->template->utility_id= $ut->utility_id;
		$this->registry->template->utility_name= $ut->utility_name;
		$this->registry->template->utility_website= $ut->utility_website;
		$this->registry->template->utility_email= $ut->utility_email;
		$this->registry->template->utility_phone= $ut->utility_phone;
		$this->registry->template->utility_postal= $ut->utility_postal;
		$this->registry->template->utility_address= $ut->utility_address;
	}
	
	public function editAction(){
		try{
			$this->registry->template->_page_title = 'Edit Utility';
			if(isset($this->registry->router->args['_POST']['utility_edit'])){
				$p = $this->registry->router->args['_POST'];
				$ut = new utility($p['utility_edit']);
				$ut->utility_name= $p['utility_name'];
				$ut->utility_website= $p['utility_website'];
				$ut->utility_email= $p['utility_email'];
				$ut->utility_phone= $p['utility_phone'];
				$ut->utility_postal= $p['utility_postal'];
				$ut->utility_address= $p['utility_address'];
				$ut->save();
				$this->listAction();
			}else if(isset($this->registry->router->args['_PATH'][3])){
				$this->load_utility_data($this->registry->router->args['_PATH'][3]);
				$this->registry->template->show('admin/utility_edit');
			}else{
				throw new Exception('Bad URL. Cannot edit utility');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
	
	public function enableAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$ut = new utility($this->registry->router->args['_PATH'][3]);
				$ut->enable(true);
				$this->listAction();
			}else{
				throw new Exception('Bad URL. Cannot enable utility');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
	
	public function disableAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$ut = new utility($this->registry->router->args['_PATH'][3]);
				$ut->enable(false);
				$this->listAction();
			}else{
				throw new Exception('Bad URL. Cannot disable utility');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
	
	public function showAction(){
		try{
			$this->registry->template->_page_title = 'Utility Detail';
			if(isset($this->registry->router->args['_PATH'][3])){
				$this->load_utility_data($this->registry->router->args['_PATH'][3]);
				$this->registry->template->show('admin/utility_show');
			}else{
				throw new Exception('Bad URL. Cannot show utility detail');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
}