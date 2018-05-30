<?php
Class pageController extends admin_base_controller{
	public function indexAction() {
		$this->listAction();
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}
	
	public function testAction(){
		$page = new page();
		print_r($page->get_page_list_array('0, 90'));
	}
	
	public function listAction(){
		$this->load_list();
	}
	
	private function load_list(){
		$this->registry->template->_page_title = 'Pages';
		$page = new page();
		$article_count = $page->get_page_list_count();
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
			$this->registry->template->page_list= $page->get_page_list_array($limit);
			$this->registry->template->site_page_count = $article_count;
			$this->registry->template->page_count = $pageCount;
			$this->registry->template->page_number = $pageNum;
			$this->registry->template->show('admin/page_list');
		}else{
			$this->registry->template->no_page_info = 'No pages have been defined yet.';
			$this->registry->template->show('admin/page_list');
		}
	}
	
	public function editAction(){
		try{
		$this->registry->template->_page_title = 'Edit Page';
		if(isset($this->registry->router->args['_POST']['page_edit'])){
			if(!empty($this->registry->router->args['_POST']['page_title']) 
				&& !empty($this->registry->router->args['_POST']['page_desc']) 
				&& !empty($this->registry->router->args['_POST']['page_content'])
			){
				$page = new page($this->registry->router->args['_PATH'][3]);
				
				$page->page_title = $this->registry->router->args['_POST']['page_title'];
				$page->page_desc = $this->registry->router->args['_POST']['page_desc'];
				$page->page_content = $this->registry->router->args['_POST']['page_content'];

				$this->registry->template->info_msg = 'Operation successful';
				$page->save();
				$this->load_list();
				
			}else{
					
				$this->registry->template->error_msg = 'Blank data posted for some expected text entries';
				$this->registry->template->page_title = $this->registry->router->args['_POST']['page_title'];
				$this->registry->template->page_desc = $this->registry->router->args['_POST']['page_desc'];
				$this->registry->template->page_content = $this->registry->router->args['_POST']['page_content'];
				
				$this->registry->template->show('admin/page_edit');
			}
		}else if(!empty($this->registry->router->args['_PATH'][3])){
			$page = new page($this->registry->router->args['_PATH'][3]);
			
			$this->registry->template->page_title = $page->page_title;
			$this->registry->template->page_desc = $page->page_desc;
			$this->registry->template->page_content =$page->page_content;
			
			$page->save();
			
			$this->registry->template->show('admin/page_edit');
		}else{
			$this->registry->template->error_msg = 'Bad page-edit URL specified';
			$this->listAction();
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Some error occurred: '.$err->getMessage();
			$this->listAction();
		}
	}
	
	public function deleteAction(){
		try{
		$this->registry->template->_page_title = 'Delete Page';
		if(isset($this->registry->router->args['_POST']['page_delete'])){
			$page = new page($this->registry->router->args['_PATH'][3]);
				
				$page->delete_me();

				$this->registry->template->info_msg = 'Operation successful';
				$this->load_list();
				
		}else if(!empty($this->registry->router->args['_PATH'][3])){
			$page = new page($this->registry->router->args['_PATH'][3]);
			
			$this->registry->template->page_title = $page->page_title;
			$this->registry->template->page_desc = $page->page_desc;
			$this->registry->template->page_content =$page->page_content;
			
			$page->save();
			
			$this->registry->template->show('admin/page_delete');
		}else{
			$this->registry->template->error_msg = 'Bad page-delete URL specified';
			$this->listAction();
		}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Some error occurred: '.$err->getMessage();
			$this->listAction();
		}
	}
	
	public function addAction(){
		try{
		$this->registry->template->_page_title = 'Add Page';
		if(isset($this->registry->router->args['_POST']['page_add'])){
			if(!empty($this->registry->router->args['_POST']['page_title']) 
				&& !empty($this->registry->router->args['_POST']['page_desc'])
				&& !empty($this->registry->router->args['_POST']['page_content'])
			){
				$page = new page();
				
				$page->page_title = $this->registry->router->args['_POST']['page_title'];
				$page->page_desc = $this->registry->router->args['_POST']['page_desc'];
				$page->page_content = $this->registry->router->args['_POST']['page_content'];

				$this->registry->template->info_msg = 'Operation successful';
				$page->save();
				$this->load_list();
			}else{
				$this->registry->template->error_msg='You supplied blank data for some expected text-entries';
				$this->registry->template->show('admin/page_add');
			}
		}else{
			$this->registry->template->show('admin/page_add');
		}
		}catch(Exception $err){
			$this->registry->template->error_msg='Some error occured: '.$err->getMessage();
			$this->registry->template->show('admin/page_add');
		}
	}
	
}

?>
