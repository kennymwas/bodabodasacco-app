<?php
Class contact_queriesController extends admin_base_controller{
	public function indexAction() {
		$this->listAction();
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}
	
	public function listAction(){
		$this->load_list();
	}
	
	public function deleteAction(){
		try{
			if(!empty($this->registry->router->args['_PATH'][3])){
				$member_query = new member_query($this->registry->router->args['_PATH'][3]);
				$member_query->delete_me();
				$this->registry->template->error_msg = 'Query successfully deleted';
				$this->load_list();
			}else{
				$this->registry->template->error_msg = 'Invalid URL supplied. Cannot delete query';
				$this->load_list();
			}
		}catch(Exception $er){
			$this->registry->template->error_msg = $er->getMessage();
			$this->load_list();
		}
	}
	
	public function mark_as_readAction(){
		try{
			if(!empty($this->registry->router->args['_PATH'][3])){
				$member_query = new member_query($this->registry->router->args['_PATH'][3]);
				$member_query->mark_read_value(true);
				$this->registry->template->error_msg = 'Query successfully marked as read';
				$this->load_list();
			}else{
				$this->registry->template->error_msg = 'Invalid URL supplied. Cannot mark query as read';
				$this->load_list();
			}
		}catch(Exception $er){
			$this->registry->template->error_msg = $er->getMessage();
			$this->load_list();
		}
	}
	
	public function mark_as_unreadAction(){
		try{
			if(!empty($this->registry->router->args['_PATH'][3])){
				$member_query = new member_query($this->registry->router->args['_PATH'][3]);
				$member_query->mark_read_value(false);
				$this->registry->template->error_msg = 'Query successfully marked as unread';
				$this->load_list();
			}else{
				$this->registry->template->error_msg = 'Invalid URL supplied. Cannot mark query as unread';
				$this->load_list();
			}
		}catch(Exception $er){
			$this->registry->template->error_msg = $er->getMessage();
			$this->load_list();
		}
	}
	
	public function readAction(){
		try{
			if(!empty($this->registry->router->args['_PATH'][3])){
				$member_query = new member_query($this->registry->router->args['_PATH'][3]);
				$this->registry->template->member_query_msg = $member_query->member_query_msg;
				$this->registry->template->member_query_time = $member_query->member_query_time;
				if($member_query->member_id){
					$this->registry->template->member_query_name = '<a href=\''.$this->registry->template->admin_url.'members/view_detail/'.$member_query->member_id.'\'>[.'.$member_query->member_query_name.'.]</a>';
				}else{
					$this->registry->template->member_query_name = $member_query->member_query_name;
				}
				if($member_query->member_id){
					$this->registry->template->member_query_email = '<a href=\''.$this->registry->template->admin_url.'members/view_detail/'.$member_query->member_id.'\'>[.member info.]</a>';
				}else{
					$this->registry->template->member_query_email = $member_query->member_query_email;
				}
				$this->registry->template->show('admin/queries_read');
				$member_query->mark_read_value(true);
			}else{
				$this->registry->template->error_msg = 'Invalid URL supplied. Cannot retrieve relevant query record';
				$this->load_list();
			}
		}catch(Exception $er){
			$this->registry->template->error_msg = $er->getMessage();
			$this->load_list();
		}
	}
	
	private function load_list(){
		$this->registry->template->_page_title = 'Contact Queries';
		$member_query = new member_query();
		$query_count = $member_query->get_table_row_count();
		$query_list_count = 10;
		$pageCount = round($query_count/$query_list_count);
		if($pageCount==0)$pageCount=1;
		if($query_count!=0){
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
				$LB =($pageNum*$query_list_count)-$query_list_count;
				$query_list_count+=(($query_count)-$query_list_count*$pageCount);
			}else if($pageCount==1){
				$LB =0;
			}else{
				$LB =($pageNum*$query_list_count)-$query_list_count;
			}
			$limit = $LB.','.$query_list_count;
			$this->registry->template->query_list= $member_query->get_listing_rows_in_array($limit);
			$this->registry->template->site_page_count = $query_count;
			$this->registry->template->query_count = $pageCount;
			$this->registry->template->query_number = $pageNum;
			$this->registry->template->show('admin/queries_list');
		}else{
			$this->registry->template->no_page_info = 'No queries have been made yet.';
			$this->registry->template->show('admin/queries_list');
		}
	}
}