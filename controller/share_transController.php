<?php
Class share_transController Extends admin_base_controller{
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
				$this->header_redirect($base_url.'admin/members');
			}
		}catch(Exception $err){
			echo "Some error occured!! ".$err->getMessage();
		}
	}
	
	public function list_memAction(){
		try{
			if(isset($_SESSION['admin_log']['member_id'])){
				$this->header_redirect($base_url.'admin/members/view_detail/'.$_SESSION['admin_log']['member_id']);
			}else{
				$this->header_redirect($base_url.'admin/members');
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
	
	public function list_salesAction(){
		$this->load_list_sales();
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
	
	public function get_share_trans_list_count_p(){
		$t = "tmp_share_transaction";
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
				$trans_arr2[$count]['share_transaction_date'] = $r['share_transaction_approved_date'];
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
	
}