<?php
Class share_transController extends admin_base_controller{
	public function indexAction() {
		$this->list_pAction();
	}
	
	private function get_mem_name_from_acc_id($acc_id){
		try{
			$acc = new account($acc_id, 'share', 1);	
			$mem = new member($acc->member_id);
			return $mem->name;
		}catch(Exception $err){
			return "[N / A]";
		}
	}
	
	public function list_viewAction(){
		try{
			if(isset($_SESSION['admin_log']['member_id'])){
				$this->view_detailAction($_SESSION['admin_log']['member_id']);
			}else{
				$this->header_redirect('members');
			}
		}catch(Exception $err){
			echo "Some error occured!! ".$err->getMessage();
		}
	}
	
	public function list_memAction(){
		try{
			if(isset($_SESSION['admin_log']['member_id'])){
				$this->header_redirect('members/view_detail/'.$_SESSION['admin_log']['member_id']);
			}else{
				$this->header_redirect('members');
			}
		}catch(Exception $err){
			echo "Some error occured!! ".$err->getMessage();
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}
	
	public function listAction(){
		$this->load_list();
	}
	
	public function list_pAction(){
		$this->load_list_p();
	}
	
	public function list_sAction(){
		$this->load_list_s();
	}
	
	public function list_requested_purchasesAction(){
		$this->load_list_requested_purchases();
	}
	
	public function list_purchasesAction(){
		$this->load_list_purchases();
	}
	
	public function list_salesAction(){
		$this->load_list_sales();
	}
	
	private function load_list_requested_purchases(){
		$this->registry->template->_page_title = 'Requested Share Purchases';
		//$trans = new shareTransaction();
		$trans_count = $this->get_tmp_share_purchase_list_count();
		$trans_list_count = 10;
		$pageCount = round($trans_count/$trans_list_count);
		if($pageCount==0)$pageCount=1;
		if($trans_count!=0){
			if(!isset($this->registry->router->args['_PATH'][4])){
				$pageNum = 1; 
			}else{
				$pageNum = $this->registry->router->args['_PATH'][4];
				if(!is_numeric($pageNum)){
					$pageNum = 1;
				}else if($pageNum<1){ 
					$pageNum=1;
				}else if($pageNum>$pageCount){
					$pageNum=$pageCount;
				}
			}
			if ($pageNum==$pageCount){
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
				$trans_list_count+=(($trans_count)-$trans_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
			}
			$limit = $LB.','.$trans_list_count;
			$trans_arr1 = $this->get_tmp_share_purchase_list_array($limit);			
			$this->registry->template->trans_list = $trans_arr1;
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->trans_count = $trans_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/share_purchase_req');
		}else{
			$this->registry->template->no_page_info = 'No share purchase requests have been made yet.';
			$this->registry->template->show('admin/share_purchase_req');
		}
	}
	
	private function load_list_purchases(){
		$this->registry->template->_page_title = 'Share Purchases';
		//$trans = new shareTransaction();
		$trans_count = $this->get_share_purchase_list_count();
		$trans_list_count = 10;
		$pageCount = round($trans_count/$trans_list_count);
		if($pageCount==0)$pageCount=1;
		if($trans_count!=0){
			if(!isset($this->registry->router->args['_PATH'][4])){
				$pageNum = 1; 
			}else{
				$pageNum = $this->registry->router->args['_PATH'][4];
				if(!is_numeric($pageNum)){
					$pageNum = 1;
				}else if($pageNum<1){ 
					$pageNum=1;
				}else if($pageNum>$pageCount){
					$pageNum=$pageCount;
				}
			}
			if ($pageNum==$pageCount){
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
				$trans_list_count+=(($trans_count)-$trans_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
			}
			$limit = $LB.','.$trans_list_count;
			$trans_arr1 = $this->get_share_purchase_list_array($limit);			
			$this->registry->template->trans_list = $trans_arr1;
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->trans_count = $trans_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/share_purchase');
		}else{
			$this->registry->template->no_page_info = 'No share purchases have been made yet.';
			$this->registry->template->show('admin/share_purchase');
		}
	}
	
	private function load_list_p(){
		$this->registry->template->_page_title = 'Pending/Requested Share Transfers Transaction';
		//$trans = new shareTransaction();
		$trans_count = $this->get_share_trans_list_count_p();
		$trans_list_count = 10;
		$pageCount = round($trans_count/$trans_list_count);
		if($pageCount==0)$pageCount=1;
		if($trans_count!=0){
			if(!isset($this->registry->router->args['_PATH'][4])){
				$pageNum = 1; 
			}else{
				$pageNum = $this->registry->router->args['_PATH'][4];
				if(!is_numeric($pageNum)){
					$pageNum = 1;
				}else if($pageNum<1){ 
					$pageNum=1;
				}else if($pageNum>$pageCount){
					$pageNum=$pageCount;
				}
			}
			if ($pageNum==$pageCount){
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
				$trans_list_count+=(($trans_count)-$trans_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
			}
			$limit = $LB.','.$trans_list_count;
			$trans_arr1 = $this->get_share_trans_list_array_p($limit);
			$trans_arr2 = array();
			$count=0;
			foreach($trans_arr1 as $r){
				$trans_arr2[$count]['share_transaction_id'] = $r['tmp_share_transaction_id'];
				$trans_arr2[$count]['share_transaction_date'] = $r['tmp_share_transaction_date'];
				$trans_arr2[$count]['share_transaction_amount'] = $r['tmp_share_transaction_amount'];
				$trans_arr2[$count]['cred_name'] = $this->get_mem_name_from_acc_id($r['tmp_account_id_credit']);
				$trans_arr2[$count]['deb_name'] = $this->get_mem_name_from_acc_id($r['tmp_account_id_debit']);
				$count++;
			}
			
			$this->registry->template->trans_list = $trans_arr2;
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->trans_count = $trans_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/share_trans_list_p');
		}else{
			$this->registry->template->no_page_info = 'No share transfers have been performed yet.';
			$this->registry->template->show('admin/share_trans_list_p');
		}
	}
	
	private function load_list(){
		$this->registry->template->_page_title = 'Approved Share Transfers Transaction';
		//$trans = new shareTransaction();
		$trans_count = $this->get_share_trans_list_count();
		$trans_list_count = 10;
		$pageCount = round($trans_count/$trans_list_count);
		if($pageCount==0)$pageCount=1;
		if($trans_count!=0){
			if(!isset($this->registry->router->args['_PATH'][4])){
				$pageNum = 1; 
			}else{
				$pageNum = $this->registry->router->args['_PATH'][4];
				if(!is_numeric($pageNum)){
					$pageNum = 1;
				}else if($pageNum<1){ 
					$pageNum=1;
				}else if($pageNum>$pageCount){
					$pageNum=$pageCount;
				}
			}
			if ($pageNum==$pageCount){
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
				$trans_list_count+=(($trans_count)-$trans_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
			}
			$limit = $LB.','.$trans_list_count;
			$trans_arr1 = $this->get_share_trans_list_array($limit);
			
			$trans_arr2 = array();
			$count=0;
			foreach($trans_arr1 as $r){
				$trans_arr2[$count]['share_transaction_id'] = $r['share_transaction_id'];
				$trans_arr2[$count]['share_transaction_date'] = $r['share_transaction_request_date'];
				$trans_arr2[$count]['share_transaction_amount'] = $r['share_transaction_amount'];
				$trans_arr2[$count]['cred_name'] = $this->get_mem_name_from_acc_id($r['account_id_credit']);
				$trans_arr2[$count]['deb_name'] = $this->get_mem_name_from_acc_id($r['account_id_debit']);
				$count++;
			}
			
			$this->registry->template->trans_list = $trans_arr2;
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->trans_count = $trans_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/share_trans_list');
		}else{
			$this->registry->template->no_page_info = 'No share transfers have been approved yet.';
			$this->registry->template->show('admin/share_trans_list');
		}
	}
	
	
	public function get_share_trans_list_array_p($limit){
		$t = "tmp_share_transaction";
		$db = new db();
		return $db->dbSelect($t, '*', $limit);
	}
	
	public function get_share_purchase_list_array($limit){
		$t = "share_purchase inner join member on member.member_id = share_purchase.member_id";
		$db = new db();
		return $db->dbSelect($t, array('share_purchase.*', 'member.member_name'), $limit);
	}
	
	public function get_tmp_share_purchase_list_array($limit){
		$t = "tmp_share_purchase inner join member on member.member_id = tmp_share_purchase.member_id";
		$db = new db();
		return $db->dbSelect($t, array('tmp_share_purchase.*', 'member.member_name'), $limit);
	}
	
	public function get_share_trans_list_count_p(){
		$t = "tmp_share_transaction";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
	public function get_tmp_share_purchase_list_count(){
		$t = "tmp_share_purchase";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
	public function get_share_purchase_list_count(){
		$t = "share_purchase";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
	public function get_share_trans_list_array($limit){
		$t = "share_transaction";
		$db = new db();
		return $db->dbSelect($t, '*', $limit);
	}
	
	public function get_share_trans_list_count(){
		$t = "share_transaction";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
	public function get_share_sale_trans_list_array_s($limit){
		$t = "tmp_sale_share_transaction";
		$db = new db();
		return $db->dbSelect($t, '*', $limit);
	}
	
	public function get_share_sale_trans_list_count_s(){
		$t = "tmp_sale_share_transaction";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
	public function get_share_sale_trans_list_array($limit){
		$t = "share_sale_transaction";
		$db = new db();
		return $db->dbSelect($t, '*', $limit);
	}
	
	public function get_share_sale_trans_list_count(){
		$t = "share_sale_transaction";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
	private function load_list_s(){
		$this->registry->template->_page_title = 'Pending/Requested Share Sale Requests';
		//$trans = new shareTransaction();
		$trans_count = $this->get_share_sale_trans_list_count_s();
		$trans_list_count = 10;
		$pageCount = round($trans_count/$trans_list_count);
		if($pageCount==0)$pageCount=1;
		if($trans_count!=0){
			if(!isset($this->registry->router->args['_PATH'][4])){
				$pageNum = 1; 
			}else{
				$pageNum = $this->registry->router->args['_PATH'][4];
				if(!is_numeric($pageNum)){
					$pageNum = 1;
				}else if($pageNum<1){ 
					$pageNum=1;
				}else if($pageNum>$pageCount){
					$pageNum=$pageCount;
				}
			}
			if ($pageNum==$pageCount){
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
				$trans_list_count+=(($trans_count)-$trans_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
			}
			$limit = $LB.','.$trans_list_count;
			$trans_arr1 = $this->get_share_sale_trans_list_array_s($limit);
			$trans_arr2 = array();
			$count=0;
			foreach($trans_arr1 as $r){
				$trans_arr2[$count]['share_transaction_id'] = $r['tmp_share_transaction_id'];
				$trans_arr2[$count]['share_transaction_date'] = $r['tmp_share_transaction_date'];
				$trans_arr2[$count]['share_transaction_amount'] = $r['tmp_share_transaction_amount'];
				$trans_arr2[$count]['share_value'] = $r['tmp_share_value'];
				$trans_arr2[$count]['cred_name'] = $this->get_mem_name_from_acc_id($r['tmp_account_id_credit']);
				$trans_arr2[$count]['deb_name'] = $this->get_mem_name_from_acc_id($r['tmp_account_id_debit']);
				$count++;
			}
			
			$this->registry->template->trans_list = $trans_arr2;
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->trans_count = $trans_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/share_trans_list_s');
		}else{
			$this->registry->template->no_page_info = 'No share sale requests have been performed yet.';
			$this->registry->template->show('admin/share_trans_list_s');
		}
	}
	
	private function load_list_sales(){
		$this->registry->template->_page_title = 'Approved and Effected Share Sale Requests';
		//$trans = new shareTransaction();
		$trans_count = $this->get_share_sale_trans_list_count();
		$trans_list_count = 10;
		$pageCount = round($trans_count/$trans_list_count);
		if($pageCount==0)$pageCount=1;
		if($trans_count!=0){
			if(!isset($this->registry->router->args['_PATH'][4])){
				$pageNum = 1; 
			}else{
				$pageNum = $this->registry->router->args['_PATH'][4];
				if(!is_numeric($pageNum)){
					$pageNum = 1;
				}else if($pageNum<1){ 
					$pageNum=1;
				}else if($pageNum>$pageCount){
					$pageNum=$pageCount;
				}
			}
			if ($pageNum==$pageCount){
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
				$trans_list_count+=(($trans_count)-$trans_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$trans_list_count)-$trans_list_count;
			}
			$limit = $LB.','.$trans_list_count;
			$trans_arr1 = $this->get_share_sale_trans_list_array($limit);
			$trans_arr2 = array();
			$count=0;
			foreach($trans_arr1 as $r){
				$trans_arr2[$count]['share_transaction_id'] = $r['share_transaction_id'];
				$trans_arr2[$count]['share_transaction_approved_date'] = $r['share_transaction_approved_date'];
				$trans_arr2[$count]['share_transaction_amount'] = $r['share_transaction_amount'];
				$trans_arr2[$count]['share_value'] = $r['share_value'];
				$trans_arr2[$count]['cred_name'] = $this->get_mem_name_from_acc_id($r['account_id_credit']);
				$trans_arr2[$count]['deb_name'] = $this->get_mem_name_from_acc_id($r['account_id_debit']);
				$count++;
			}
			
			$this->registry->template->trans_list = $trans_arr2;
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->trans_count = $trans_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/share_trans_list_sales');
		}else{
			$this->registry->template->no_page_info = 'No share sale requests have been approved yet.';
			$this->registry->template->show('admin/share_trans_list_sales');
		}
	}
	
	public function approveAction(){
		try{
		if(!empty($this->registry->router->args['_PATH'][3])){
			$trans = new tmp_shareTransaction($this->registry->router->args['_PATH'][3]);
			$trans->effect_transaction();
			$this->registry->template->info_msg = 'Operation was successfull';
			$this->load_list_p();
		}else{
			$this->registry->template->error_msg = "Invalid approve-URL supplied";
			$this->load_list_p();
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->load_list_p();
		}
	}
	
	public function cancelAction(){
		try{
		if(!empty($this->registry->router->args['_PATH'][3])){
			$trans = new tmp_shareTransaction($this->registry->router->args['_PATH'][3]);
			$trans->cancel_transaction();
			$this->registry->template->info_msg = 'Operation was successfull';
			$this->load_list_p();
		}else{
			$this->registry->template->error_msg = "Invalid cancel-URL supplied";
			$this->load_list_p();
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->load_list_p();
		}
	}
	
	public function approve_saleAction(){
		try{
		if(!empty($this->registry->router->args['_PATH'][3])){
			$trans = new tmp_sale_shareTransaction($this->registry->router->args['_PATH'][3]);
			$trans->effect_transaction();
			$this->registry->template->info_msg = 'Operation was successfull';
			$this->load_list_s();
		}else{
			$this->registry->template->error_msg = "Invalid approve-URL supplied";
			$this->load_list_s();
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->load_list_s();
		}
	}
	
	public function cancel_saleAction(){
		try{
		if(!empty($this->registry->router->args['_PATH'][3])){
			$trans = new tmp_sale_shareTransaction($this->registry->router->args['_PATH'][3]);
			$trans->cancel_transaction();
			$this->registry->template->info_msg = 'Operation was successfull';
			$this->load_list_s();
		}else{
			$this->registry->template->error_msg = "Invalid cancel-URL supplied";
			$this->load_list_s();
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->load_list_s();
		}
	}
	
	public function approve_reqAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$tmp = new tmp_sharePurchase($this->registry->router->args['_PATH'][3]);
				$member = new member($tmp->member_id);
				$share_val = $tmp->share_purchase_value_per_share * $tmp->share_purchase_amount;
				$shr = new sharePurchase();
				$shr->member_id = $tmp->member_id;
				$shr->share_purchase_amount = $tmp->share_purchase_amount;
				$shr->share_purchase_value_per_share = $tmp->share_purchase_value_per_share;
				$member->get_share_account()->increase_account_bal($tmp->share_purchase_amount);
				$shr->save();
				$tmp->delete_me();
				$this->registry->template->info_msg = 'Request Successful, member\'s share balance updated';
				$this->list_requested_purchasesAction();
			}else{
				$this->registry->template->error_msg = 'Share-Request ID not specified';
				$this->list_requested_purchasesAction();
			}		
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->list_requested_purchasesAction();
		}
	}
	
	public function cancel_reqAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$tmp = new tmp_sharePurchase($this->registry->router->args['_PATH'][3]);
				$member = new member($tmp->member_id);
				$share_val = $tmp->share_purchase_value_per_share * $tmp->share_purchase_amount;
				$tmp->delete_me();
				$member->get_fund_account()->increase_account_bal($share_val);
				$this->registry->template->info_msg = 'Cancel-Request Successful, refund made';
				$this->list_requested_purchasesAction();
			}else{
				$this->registry->template->error_msg = 'Share-Request ID not specified';
				$this->list_requested_purchasesAction();
			}		
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->list_requested_purchasesAction();
		}
	}
	
	public function new_sharesAction(){
		try{
			$this->registry->template->_page_title = "Float New Shares";
			$this->registry->template->share_value = 'N/A';
			$this->registry->template->new_share_balance = 'N/A';
			//$this->registry->template->mod=1;
			if(!isset($this->registry->router->args['_PATH'][3])){
				$this->registry->template->share_value = $this->registry->sacco_configs->share_value;
				$this->registry->template->new_share_balance = $this->registry->sacco_configs->new_share_balance;
			}else if(isset($_POST['share_value']) && isset($_POST['new_share_balance'])){
				$this->registry->template->share_value = $_POST['share_value'];
				$this->registry->template->new_share_balance = $_POST['new_share_balance'];
				if(!is_numeric($_POST['share_value']) || !is_numeric($_POST['new_share_balance'])){
					throw new Exception('Invalid (non-numeric) data supplied)');
				}else if($_POST['share_value']<0 || $_POST['new_share_balance']<0){
					throw new Exception('Invalid (negative) data supplied)');
				}
				$ent = new entityData('-1');
				$ent->set_share_val($_POST['share_value']);
				$ent->set_new_share_balance($_POST['new_share_balance']);
			}else{
				$this->registry->template->share_value = $this->registry->sacco_configs->share_value;
				$this->registry->template->new_share_balance = $this->registry->sacco_configs->new_share_balance;
				$this->registry->template->mod=1;
			}
			$this->registry->template->show('admin/new_shares');
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->registry->template->show('admin/new_shares');
		}
	}
	
	private function divident_payout($amount){
		$db = new db();
		//return 50;
		$tb = 'share_account inner join fund_account on share_account.member_id = fund_account.member_id';
		//echo 'update '.$tb.' set fund_account_debit = (fund_account_debit + ((share_account_debit-share_account_credit)*'.$amount.'))';
		return $db->raw_execute('update '.$tb.' set fund_account_debit = (fund_account_debit + ((share_account_debit-share_account_credit)*'.$amount.'))');
		
	}
	
	private function get_divident_payout_amount($amount){
		$db = new db();
		$tb = 'share_account';
		$dt = $db->dbSelect($tb, array('SUM(((share_account_debit-share_account_credit)*'.$amount.')) as tot_amount'));
		return $dt[0]['tot_amount'];
	}
	
	public function dividendAction(){
		try{
			
			$this->registry->template->_page_title = "Dividend Pay-Out";
			$this->registry->template->dt_count = 0;
			$dv = new dividend_payout();
			if(isset($this->registry->router->args['_POST']['value_per_share'])){
				if(!is_numeric($this->registry->router->args['_POST']['value_per_share'])){
					$this->registry->template->error_msg = 'Invalid amount specified';
				}else if($this->registry->router->args['_POST']['value_per_share'] < 0){
					$this->registry->template->error_msg = 'Bad value specified for divident payout amount';
				}else{
					$dv->dividend_payout_value = $this->registry->router->args['_POST']['value_per_share'];
					$dv->dividend_payout_amount = $this->get_divident_payout_amount($this->registry->router->args['_POST']['value_per_share']);
					$dv->dividend_payout_member_count = $this->divident_payout($this->registry->router->args['_POST']['value_per_share']);
					//echo $dv->dividend_payout_member_count;
					$dv->save();
					$this->registry->template->info_msg = 'Operation was successful';
					include ("dividend_sms.php");
				}
			}
			$this->registry->template->dt_count = $dv->get_table_row_count();
			if($this->registry->template->dt_count==0){
				$this->registry->template->no_page_info = 'No dividend-payouts have been made yet';
			}else{
				$this->registry->template->dt_list = $dv->get_table_rows_in_array();
			}
			
			$this->registry->template->show('admin/share_dividend');
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->registry->template->show('admin/home');
		}
	}
	
}