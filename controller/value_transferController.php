<?php
Class value_transferController Extends base_controller{
	
	public function indexAction() {
		$this->trans();
	}
	
	private function trans(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			return 0;
		}
		try{
		$member = new member($_SESSION['log']['id']);
		$this->registry->template->member_name = $member->name;
		$this->registry->template->fund_balance = $member->get_fund_account()->get_account_bal();
		$this->registry->template->share_balance = $member->get_share_account()->get_account_bal();
		$this->registry->template->_page_title = 'Funds Transfer';
		$this->registry->template->transfer_step = 1;
		if(isset($this->registry->router->args['_POST']['value_transfer']) && !isset($_SESSION['value_transfer'])){
			if(!isset($this->registry->router->args['_POST']['recipient_email']) 
				|| !isset($this->registry->router->args['_POST']['value_type']) 
				|| !isset($this->registry->router->args['_POST']['value_amount'])
			){
				throw new Exception('Missing data in POST. Please Contact Support');
			}
			$member = new member($_SESSION['log']['id']);
			$this->registry->template->value_amount = '';
			if($this->registry->router->args['_POST']['value_type']=='share'){
				$this->registry->template->account_balance = $member->get_share_account()->get_account_bal();
				$this->registry->template->value_type = 'Shares Transfer';
			}else if($this->registry->router->args['_POST']['value_type']=='fund'){
				$this->registry->template->value_amount = $this->registry->template->site_currency;
				$this->registry->template->account_balance = $member->get_fund_account()->get_account_bal();
				$this->registry->template->value_type = 'Funds Transfer';
			}else{
				throw new Exception('Invalid value type supplied');
			}
			if(!is_numeric($this->registry->router->args['_POST']['value_amount'])){
				throw new Exception('Invalid value amount supplied');
			}else if($this->registry->router->args['_POST']['value_amount']<1){
				throw new Exception('Invalid value amount supplied');
			}else if($this->registry->router->args['_POST']['value_amount'] > $this->registry->template->account_balance){
				throw new Exception('Insufficient account balance to effect value transfer');
			}
			$recep_mem = new member();
			$recep_mem->load_by_email($this->registry->router->args['_POST']['recipient_email']);
			if($recep_mem->id == $_SESSION['log']['id']){
				throw new Exception('You specified your own email address');
			}
			$this->registry->template->recep_name = $recep_mem->name;
			$this->registry->template->value_amount = $this->registry->template->value_amount.$this->registry->router->args['_POST']['value_amount'];
			$_SESSION['value_transfer']['type']=$this->registry->router->args['_POST']['value_type'];
			$_SESSION['value_transfer']['amount']=$this->registry->router->args['_POST']['value_amount'];
			$_SESSION['value_transfer']['recep_member_id']=$recep_mem->id;
			$_SESSION['value_transfer']['recep_email'] = $this->registry->router->args['_POST']['recipient_email'];
			if($_SESSION['value_transfer']['type']=='fund'){
				$trans = new fundTransaction($recep_mem->get_fund_account(), $member->get_fund_account(), $_SESSION['value_transfer']['amount']);
			}else{
				$trans = new shareTransaction($recep_mem->get_share_account(), $member->get_share_account(), $_SESSION['value_transfer']['amount']);
			}
			$this->registry->template->recep_email = $_SESSION['value_transfer']['recep_email'];
			$this->registry->template->recipient_trans_charge = $trans->get_debit_account_transaction_charge();
			$this->registry->template->sender_trans_charge = $trans->get_credit_account_transaction_charge();
			$this->registry->template->info_msg = 'If you do not want to effect this transaction now, you can save it by clicking [<a href=\'#\'>here</a>], otherwise the request will be nullified after your sessions logs off.';
			$this->registry->template->transfer_step = 2;
			$this->registry->template->show('value_transfer');
		}else if(isset($_SESSION['value_transfer']) && isset($this->registry->router->args['_POST']['make_value_transfer'])){
			$recep_mem = new member($_SESSION['value_transfer']['recep_member_id']);
			if($_SESSION['value_transfer']['type']=='fund'){
				$trans = new fundTransaction($recep_mem->get_fund_account(), $member->get_fund_account(), $_SESSION['value_transfer']['amount']);
			}else{
				$trans = new shareTransaction($recep_mem->get_share_account(), $member->get_share_account(), $_SESSION['value_transfer']['amount']);
			}
			$trans->effect_transaction();
			unset($_SESSION['value_transfer']);
			$_SESSION['value_transfer_summary'] = 'your last transaction was successfully carried out';
			$this->registry->template->transfer_step = 4;
			$this->registry->template->transfer_info = 'Transaction Successful';
			$this->registry->template->show('value_transfer');
		}else if(isset($_SESSION['value_transfer']) && isset($this->registry->router->args['_POST']['cancel_value_transfer'])){
			unset($_SESSION['value_transfer']);
			$this->registry->template->transfer_step = 3;
			$this->registry->template->transfer_info = 'Transaction Request Cancel';
			$this->registry->template->show('value_transfer');
		}else if(isset($_SESSION['value_transfer_summary'])){
			$this->registry->template->info_msg = $_SESSION['value_transfer_summary'];
			unset($_SESSION['value_transfer_summary']);
			$this->registry->template->show('value_transfer');
		}else if(isset($_SESSION['value_transfer'])){
				if(isset($this->registry->router->args['_POST']['value_transfer'])) $this->registry->template->error_msg = 'You can only create a new transaction request after confirming or cancelling this one';
				$recep_mem = new member($_SESSION['value_transfer']['recep_member_id']);
				$this->registry->template->recep_name = $recep_mem->name;
				$this->registry->template->info_msg = 'You can save this transaction data by clicking [<a href=\'#\'>here</a>] to save transaction, otherwise the request will be nullified after your sessions logs off.';
				$this->registry->template->value_amount= $_SESSION['value_transfer']['amount'];
				if($_SESSION['value_transfer']['type']=='fund'){
					$trans = new fundTransaction($recep_mem->get_fund_account(), $member->get_fund_account(), $_SESSION['value_transfer']['amount']);
				}else{
					$trans = new shareTransaction($recep_mem->get_share_account(), $member->get_share_account(), $_SESSION['value_transfer']['amount']);
				}
				$this->registry->template->recep_email = $_SESSION['value_transfer']['recep_email'];
				$this->registry->template->recipient_trans_charge = $trans->get_debit_account_transaction_charge();
				$this->registry->template->sender_trans_charge = $trans->get_credit_account_transaction_charge();
				$this->registry->template->transfer_step = 2;
				if($_SESSION['value_transfer']['type']=='fund'){
					$this->registry->template->value_type = 'Funds Transfer';
					$this->registry->template->value_amount = $this->registry->template->site_currency.$this->registry->template->value_amount;
				}else if($_SESSION['value_transfer']['type']=='share'){
					$this->registry->template->value_type = 'Shares Transfer';
				}else{
					throw new Exception('Invalid value type specified. Contact Support. Major Error.');
				}
				$this->registry->template->show('value_transfer');
		}else{
			$this->registry->template->show('value_transfer');
		}
		
		}catch (Exception $e){
			$this->registry->template->error_msg = $e->getMessage();
			$this->registry->template->show('value_transfer');
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->registry->template->show('value_transfer');
	}	
}