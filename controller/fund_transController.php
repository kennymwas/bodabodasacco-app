<?php
Class fund_transController Extends admin_base_controller{
	public function indexAction() {
		$this->listAction();
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
	
	private function load_list(){
		$this->registry->template->_page_title = 'Fund Transaction';
		//$trans = new fundTransaction();
		$trans_count = $this->get_fund_trans_list_count();
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
			$trans_arr1 = $this->get_fund_trans_list_array($limit);
			
			$trans_arr2 = array();
			$count=0;
			foreach($trans_arr1 as $r){
				$trans_arr2[$count]['fund_transaction_id'] = $r['fund_transaction_id'];
				$trans_arr2[$count]['fund_transaction_date'] = $r['fund_transaction_date'];
				$trans_arr2[$count]['fund_transaction_amount'] = $this->registry->template->site_currency.$r['fund_transaction_amount'];
				$trans_arr2[$count]['cred_name'] = $this->get_mem_name_from_acc_id($r['account_id_credit']);
				$trans_arr2[$count]['deb_name'] = $this->get_mem_name_from_acc_id($r['account_id_debit']);
				$count++;
			}
			
			$this->registry->template->trans_list = $trans_arr2;
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->trans_count = $trans_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/fund_trans_list');
		}else{
			$this->registry->template->no_page_info = 'No fund transactions have been performed yet.';
			$this->registry->template->show('admin/fund_trans_list');
		}
	}
	
	public function get_fund_trans_list_array($limit){
		$t = "fund_transaction";
		$db = new db();
		return $db->dbSelect($t, '*', $limit);
	}
	
	public function get_fund_trans_list_count(){
		$t = "fund_transaction";
		$db = new db();
		$row_count=$db->dbSelect($t, array('count(*)'));
		return $row_count[0]['count(*)'];
	}
	
}