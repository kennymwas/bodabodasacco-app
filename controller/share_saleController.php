<?php
Class share_saleController Extends base_controller{
	
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
		$this->registry->template->_page_title = 'Share Sale';
		$this->registry->template->transfer_step = 1;
		if(isset($this->registry->router->args['_POST']['share_sale']) && !isset($_SESSION['share_sale'])){
			if(!isset($this->registry->router->args['_POST']['recipient_email']) 
				|| !isset($this->registry->router->args['_POST']['share_value'])
				|| !isset($this->registry->router->args['_POST']['value_amount'])
			){
				throw new Exception('Missing data in POST. Please Contact Support');
			}
			$member = new member($_SESSION['log']['id']);
			$this->registry->template->value_amount = '';
			$this->registry->template->account_balance = $member->get_share_account()->get_account_bal();
			if(!is_numeric($this->registry->router->args['_POST']['value_amount'])){
				throw new Exception('Invalid value amount supplied');
			}else if(!is_numeric($this->registry->router->args['_POST']['share_value'])){
				throw new Exception('Invalid share value supplied');
			}else if($this->registry->router->args['_POST']['share_value']<1){
				throw new Exception('Invalid share amount supplied');
			}else if(!is_numeric($this->registry->router->args['_POST']['value_amount'])){
				throw new Exception('Invalid value amount supplied');
			}else if($this->registry->router->args['_POST']['value_amount']<1){
				throw new Exception('Invalid value amount supplied');
			}
			// if($this->registry->router->args['_POST']['value_amount'] > $this->registry->template->account_balance){
				// throw new Exception('Insufficient account balance to effect value transfer');
			// }
			$recep_mem = new member();
			$recep_mem->load_by_email($this->registry->router->args['_POST']['recipient_email']);
			if($recep_mem->id == $_SESSION['log']['id']){
				throw new Exception('You specified your own email address');
			}
			$this->registry->template->recep_name = $recep_mem->name;
			$this->registry->template->value_amount = $this->registry->router->args['_POST']['value_amount'];
			$_SESSION['share_sale']['amount']=$this->registry->router->args['_POST']['value_amount'];
			$_SESSION['share_sale']['share_value']=$this->registry->router->args['_POST']['share_value'];
			$_SESSION['share_sale']['recep_member_id']=$recep_mem->id;
			$_SESSION['share_sale']['recep_email'] = $this->registry->router->args['_POST']['recipient_email'];
			$trans = new share_saleTransaction($recep_mem->get_share_account(), $member->get_share_account(), $_SESSION['share_sale']['amount'], $_SESSION['share_sale']['share_value']);
			$this->registry->template->recep_email = $_SESSION['share_sale']['recep_email'];
			$this->registry->template->recipient_trans_charge = $trans->get_debit_account_transaction_charge();
			$this->registry->template->sender_trans_charge = $trans->get_credit_account_transaction_charge();
			//$this->registry->template->info_msg = 'If you do not want to effect this sale now, you can save it by clicking [<a href=\'#\'>here</a>], otherwise the request will be nullified after your sessions logs off.';
			$this->registry->template->transfer_step = 2;
			$this->registry->template->show('share_sale');
		}else if(isset($_SESSION['share_sale']) && isset($this->registry->router->args['_POST']['make_sale'])){
			$recep_mem = new member($_SESSION['share_sale']['recep_member_id']);
			$trans = new share_saleTransaction($recep_mem->get_share_account(), $member->get_share_account(), $_SESSION['share_sale']['amount'], $_SESSION['share_sale']['share_value']);
			$trans->effect_transaction();
			unset($_SESSION['share_sale']);
			$_SESSION['sale_summary'] = 'your last sale was successfully carried out. It now awaits admin approval before being effected';
			$this->registry->template->transfer_step = 4;
			$this->registry->template->transfer_info = 'Sale Successful, awaiting admin approval';
			$this->registry->template->show('share_sale');
		}else if(isset($_SESSION['share_sale']) && isset($this->registry->router->args['_POST']['cancel_sale'])){
			unset($_SESSION['share_sale']);
			$this->registry->template->transfer_step = 3;
			$this->registry->template->transfer_info = 'Sale Request Cancel';
			$this->registry->template->show('share_sale');
		}else if(isset($_SESSION['sale_summary'])){
			$this->registry->template->info_msg = $_SESSION['sale_summary'];
			unset($_SESSION['sale_summary']);
			$this->registry->template->show('share_sale');
		}else if(isset($_SESSION['share_sale'])){
				if(isset($this->registry->router->args['_POST']['share_sale'])) $this->registry->template->error_msg = 'You can only create a new sale request after confirming or cancelling this one';
				$recep_mem = new member($_SESSION['share_sale']['recep_member_id']);
				$this->registry->template->recep_name = $recep_mem->name;
				$this->registry->template->info_msg = 'You can save this transaction data by clicking [<a href=\'#\'>here</a>] to save this sale request, otherwise the request will be nullified after your sessions logs off.';
				$this->registry->template->value_amount= $_SESSION['share_sale']['amount'];
				if($_SESSION['share_sale']['type']=='fund'){
					$trans = new fundTransaction($recep_mem->get_fund_account(), $member->get_fund_account(), $_SESSION['share_sale']['amount']);
				}else{
					$trans = new share_saleTransaction($recep_mem->get_share_account(), $member->get_share_account(), $_SESSION['share_sale']['amount']);
				}
				$this->registry->template->recep_email = $_SESSION['share_sale']['recep_email'];
				$this->registry->template->recipient_trans_charge = $trans->get_debit_account_transaction_charge();
				$this->registry->template->sender_trans_charge = $trans->get_credit_account_transaction_charge();
				$this->registry->template->transfer_step = 2;
				$this->registry->template->show('share_sale');
		}else{
			$this->registry->template->show('share_sale');
		}
		
		}catch (Exception $e){
			$this->registry->template->error_msg = $e->getMessage();
			$this->registry->template->show('share_sale');
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->registry->template->show('share_sale');
	}	
}