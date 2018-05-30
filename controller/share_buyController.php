<?php
Class share_buyController Extends base_controller{
	
	public function indexAction() {
		$this->trans();
	}
	
	public function listAction(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			return 0;
		}
		try{
			$member = new member($_SESSION['log']['id']);
			$tmp = new tmp_sharePurchase();
			$this->registry->template->dt_list=$tmp->get_share_purchase_data_array($member->id);
			$this->registry->template->dt_count = count($this->registry->template->dt_list);
			$this->registry->template->show('manage_share_buy');
		}catch (Exception $e){
			$this->registry->template->error_msg = $e->getMessage();
			$this->registry->template->show('manage_share_buy');
		}
	}
	
	public function delete_reqAction(){
		if(isset($this->registry->router->args['_PATH'][2])){
			$tmp = new tmp_sharePurchase($this->registry->router->args['_PATH'][2]);
			$member = new member($_SESSION['log']['id']);
			$share_val = $tmp->share_purchase_value_per_share * $tmp->share_purchase_amount;
			$tmp->delete_me();
			$member->get_fund_account()->increase_account_bal($share_val);
			$this->registry->template->info_msg = 'Drop-Request Successful, refund made';
			$this->listAction();
		}else{
			$this->registry->template->error_msg = 'Share Purchase ID not specified';
			$this->listAction();
		}
	}
	
	private function trans(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			return 0;
		}
		try{
			$this->registry->template->page_title = "Buy Shares";
			$this->registry->template->share_price = $this->registry->sacco_configs->share_value;
			$this->registry->template->new_share_balance = $this->registry->sacco_configs->new_share_balance;
			$this->registry->template->share_buy_step = 1;
			if(!empty($this->registry->router->args['_POST']['buy_shares'])){
				if(is_numeric($this->registry->router->args['_POST']['buy_shares'])){
					$share_amount = round($this->registry->router->args['_POST']['buy_shares']);
					if($share_amount<1){
						throw New Exception('You specified an invalid (negative or zero) share amount value');
					}
					$share_val = $share_amount*$this->registry->sacco_configs->share_value;
					if($share_val < $this->registry->template->_fund_balance){
						if($share_amount < $this->registry->sacco_configs->new_share_balance ){
						
							$member = new member($_SESSION['log']['id']);
							$tmp = new tmp_sharePurchase();
							$tmp->member_id = $member->id;
							$tmp->share_purchase_amount = $share_amount;
							$tmp->share_purchase_value_per_share = $this->registry->sacco_configs->share_value;
							$tmp->save();
							$member->get_fund_account()->reduce_account_bal($share_val);
							$ent = new entityData('-1');
							if($ent->update_new_share_balance(-1*$share_amount)==0) throw new Exception('Warning: Update request for new share balance was not successfully executed. Database records unaffected');
							$this->registry->template->share_buy_step = 2;
							$this->registry->template->share_purchase_amount = $tmp->share_purchase_amount;
							$this->registry->template->share_purchase_value_per_share = $tmp->share_purchase_value_per_share;
							$this->registry->template->show('share_buy');

						}else{
							throw New Exception('The amount you shares you request are more than the available shares');
						}
					}else{
						throw New Exception('You lack insufficient funds to   those shares');
					}
				}else{
					throw New Exception('Invalid amount supplied');
				}
			}else{
				$this->registry->template->show('share_buy');
			}
		
		}catch (Exception $e){
			$this->registry->template->error_msg = $e->getMessage();
			$this->registry->template->show('share_buy');
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->registry->template->show('share_buy');
	}	
}