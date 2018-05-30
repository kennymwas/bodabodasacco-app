<?php
Class membersController extends admin_base_controller{
	public function indexAction() {
		$this->listAction();
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
	
	private function load_list(){
		$this->registry->template->_page_title = 'Members';
		$mem = new member();
		$article_count = $mem->get_member_list_count();
		$article_list_count = 10;
		$pageCount = round($article_count/$article_list_count);
		if($pageCount==0)$pageCount=1;
		if($article_count!=0){
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
				$LB =($pageNum*$article_list_count)-$article_list_count;
				$article_list_count+=(($article_count)-$article_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$article_list_count)-$article_list_count;
			}
			$limit = $LB.','.$article_list_count;
			$this->registry->template->member_list= $mem->get_member_list_array($limit);
			$this->registry->template->site_page_count = $pageCount;
			$this->registry->template->member_count = $article_count;
			$this->registry->template->pageNum = $pageNum;
			$this->registry->template->show('admin/member_list');
		}else{
			$this->registry->template->no_page_info = 'No members have been defined yet.';
			$this->registry->template->show('admin/member_list');
		}
	}
	
	public function view_detailAction($_mem_id=''){
		try{
		$this->registry->template->_page_title = 'Member-Data Management<br/>Member Detail';
		if(!isset($this->registry->router->args['_PATH'][3]) && empty($_mem_id)){
			$this->registry->template->error_msg = 'Bad URL for member-view specified';
			$this->listAction();
		}else{			
			/* retrive member data */
			$mem_id= !empty($_mem_id) ? $_mem_id : $this->registry->router->args['_PATH'][3];
			$member = new member($mem_id);
			$this->registry->template->member_id = $member->id ;
			$this->registry->template->member_name = $member->name ;
			$this->registry->template->nat_id = $member->nat_id ;
			$this->registry->template->work_id = $member->work_id ;
			$this->registry->template->member_status = $member->active == '1' ? '<font color=\'green\'>Active</font>' : '<font color=\'red\'>Disabled</font>' ;
			$this->registry->template->_fund_balance = $member->get_fund_account()->get_account_bal();
			$this->registry->template->_share_balance = $member->get_share_account()->get_account_bal();
			$this->registry->template->_share_value = $this->registry->template->_share_balance * $this->registry->sacco_configs->share_value;
			$this->registry->template->_value_per_share = $this->registry->sacco_configs->share_value;
			
			/* set member-id in session, usefull after edits so that you can go back to view-detail page of last memmber */
			$_SESSION['admin_log']['member_id']=$mem_id;
			
			/* retrive phone list */
			$phone = new phone();
			$this->registry->template->phone_list = $phone->get_phone_data_array($mem_id);
			$this->registry->template->phone_list_count = sizeof($this->registry->template->phone_list);
			
			/* retrive email list */
			$email = new email();
			$this->registry->template->email_list = $email->get_email_data_array($mem_id);
			$this->registry->template->email_list_count = sizeof($this->registry->template->email_list);
			
			/* retrive postal list */
			$postal = new postal();
			$this->registry->template->postal_list = $postal->get_postal_data_array($mem_id);
			$this->registry->template->postal_list_count = sizeof($this->registry->template->postal_list);
			
			/* retrive physical address list */
			$physicalAddress = new physicalAddress();
			$this->registry->template->physicalAddress_list = $physicalAddress->get_physicalAddress_data_array($mem_id);
			$this->registry->template->physicalAddress_list_count = sizeof($this->registry->template->physicalAddress_list);
			
			/* retrive kin list */
			$kin = new kin();
			$this->registry->template->kin_list = $kin->get_kin_data_array($mem_id);
			$this->registry->template->kin_list_count = sizeof($this->registry->template->kin_list);
			
			/* load view */
			$this->registry->template->show('admin/member_view_detail');
		}
		}catch(Exception $err){
			$this->registry->template->no_page_info = $err->getMessage();
			$this->listAction();
		}
	}
	
	public function editAction(){
		try{
		if(isset($this->registry->router->args['_POST'])){
			$P = $this->registry->router->args['_POST'];
		}
		if(!empty($P['member_edit'])){
			if(!empty($P['member_name']) && !empty($P['nat_id']) && !empty($P['work_id']) && !empty($P['member_status'])){
				$member = new member($this->registry->router->args['_POST']['member_edit']);
				$member->name = $P['member_name'];
				$member->work_id = $P['work_id'];
				$member->nat_id = $P['nat_id'];
				$member->active = $P['member_status']=='active' ? 1 : 0;
				$member->save();
				$this->registry->template->info_msg = "Update successful";
				$this->list_viewAction();
			}else{
				$this->registry->template->error_msg = "Blank entries were supplied. Please fill up all the required textboxes";
				$this->list_viewAction();
			}
		}else if(!empty($P['upd_finance'])){
			if(!empty($P['fund_upd_val'])){
				if(!is_numeric($P['fund_upd_val'])){
					throw New Exception('Invalid value supplied');
				}
				$member = new member($this->registry->router->args['_POST']['upd_finance']);
				$member->get_fund_account()->increase_account_bal($P['fund_upd_val']);
				$this->registry->template->info_msg = "Update successful";
				$this->list_viewAction();
			}else{
				$this->registry->template->error_msg = "Blank entries were supplied. Please fill up all the required textboxes";
				$this->list_viewAction();
			}
		}else if(!empty($P['upd_share'])){
			if(!empty($P['share_upd_val'])){
				if(!is_numeric($P['share_upd_val'])){
					throw New Exception('Invalid value supplied');
				}
				$member = new member($this->registry->router->args['_POST']['upd_share']);
				$member->get_share_account()->increase_account_bal($P['share_upd_val']);
				$this->registry->template->info_msg = "Update successful";
				$this->list_viewAction();
			}else{
				$this->registry->template->error_msg = "Blank entries were supplied. Please fill up all the required textboxes";
				$this->list_viewAction();
			}
		}else{
			$this->registry->template->_page_title = 'Member-Data Management<br/>Edit Member Detail';
			if(!isset($this->registry->router->args['_PATH'][3])){
				$this->registry->template->error_msg = 'Bad URL for member-edit specified';
				$this->list_viewAction();
			}else{			
				/* retrive member data */
				$mem_id=$this->registry->router->args['_PATH'][3];
				$member = new member($mem_id);
				$this->registry->template->member_id = $member->id ;
				$this->registry->template->member_name = $member->name ;
				$this->registry->template->nat_id = $member->nat_id ;
				$this->registry->template->work_id = $member->work_id ;
				$this->registry->template->member_status = $member->active;
				$this->registry->template->_fund_balance = $member->get_fund_account()->get_account_bal();
				$this->registry->template->_share_balance = $member->get_share_account()->get_account_bal();
				$this->registry->template->_share_value = $this->registry->template->_share_balance * $this->registry->sacco_configs->share_value;
				$this->registry->template->_value_per_share = $this->registry->sacco_configs->share_value;
				
				/* set member-id in session, usefull after edits so that you can go back to view-detail page of last memmber */
				$_SESSION['admin_log']['member_id']=$mem_id;
				
				/* load view */
				$this->registry->template->show('admin/member_edit');
			}
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->list_viewAction();
		}
	}
	
	public function deleteAction(){
		try{
		if(!empty($this->registry->router->args['_POST']['member_delete'])){
			$member = new member($this->registry->router->args['_POST']['member_delete']);
			$member->delete_me();
			$this->registry->template->info_msg = "Delete successful";
			$this->load_list();
		}else{
			$this->registry->template->_page_title = 'Member-Data Management<br/>Delete Member Detail';
			if(!isset($this->registry->router->args['_PATH'][3])){
				$this->registry->template->error_msg = 'Bad URL for member-edit specified';
				$this->list_viewAction();
			}else{			
				/* retrive member data */
				$mem_id=$this->registry->router->args['_PATH'][3];
				$member = new member($mem_id);
				$this->registry->template->member_id = $member->id ;
				$this->registry->template->member_name = $member->name ;
				$this->registry->template->nat_id = $member->nat_id ;
				$this->registry->template->work_id = $member->work_id ;
				$this->registry->template->member_status = $member->active;
				
				/* set member-id in session, usefull after edits so that you can go back to view-detail page of last memmber */
				unset($_SESSION['admin_log']['member_id']);
				
				/* load view */
				$this->registry->template->show('admin/member_delete');
			}
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->list_viewAction();
		}
	}
}