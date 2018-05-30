<?php
Class newsController extends admin_base_controller{
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
	
	private function load_list(){
		$this->registry->template->_page_title = 'News';
		$news = new news();
		$article_count = $news->get_news_list_count();
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
			$this->registry->template->news_list= $news->get_news_list_array($limit);
			$this->registry->template->site_page_count = $article_count;
			$this->registry->template->news_count = $pageCount;
			$this->registry->template->news_number = $pageNum;
			$this->registry->template->show('admin/news_list');
		}else{
			$this->registry->template->no_page_info = 'No news entries have been defined yet.';
			$this->registry->template->show('admin/news_list');
		}
	}
	
	public function editAction(){
		try{
		$this->registry->template->_page_title = 'Edit News';
		if(isset($this->registry->router->args['_POST']['news_edit'])){
			if(!empty($this->registry->router->args['_POST']['news_title']) 
				&& !empty($this->registry->router->args['_POST']['news_desc']) 
				&& !empty($this->registry->router->args['_POST']['news_content'])
			){
				$news = new news($this->registry->router->args['_PATH'][3]);
				
				$news->news_title = $this->registry->router->args['_POST']['news_title'];
				$news->news_desc = $this->registry->router->args['_POST']['news_desc'];
				$news->news_date = $this->registry->router->args['_POST']['news_date'];
				$news->news_content = $this->registry->router->args['_POST']['news_content'];

				$this->registry->template->info_msg = 'Operation successful';
				$news->save();
				$this->load_list();
				
			}else{
					
				$this->registry->template->error_msg = 'Blank data posted for some expected text entries';
				$this->registry->template->news_title = $this->registry->router->args['_POST']['news_title'];
				$this->registry->template->news_desc = $this->registry->router->args['_POST']['news_desc'];
				$this->registry->template->news_date = $this->registry->router->args['_POST']['news_date'];
				$this->registry->template->news_content = $this->registry->router->args['_POST']['news_content'];
				
				$this->registry->template->show('admin/news_edit');
			}
		}else if(!empty($this->registry->router->args['_PATH'][3])){
			$news = new news($this->registry->router->args['_PATH'][3]);
			
			$this->registry->template->news_title = $news->news_title;
			$this->registry->template->news_desc = $news->news_desc;
			$this->registry->template->news_date = $news->news_date;
			$this->registry->template->news_content =$news->news_content;
			
			$news->save();
			
			$this->registry->template->show('admin/news_edit');
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
		$this->registry->template->_page_title = 'Delete News';
		if(isset($this->registry->router->args['_POST']['news_delete'])){
			$news = new news($this->registry->router->args['_PATH'][3]);
				
				$news->delete_me();

				$this->registry->template->info_msg = 'Operation successful';
				$this->load_list();
				
		}else if(!empty($this->registry->router->args['_PATH'][3])){
			$news = new news($this->registry->router->args['_PATH'][3]);
			
			$this->registry->template->news_title = $news->news_title;
			$this->registry->template->news_desc = $news->news_desc;
			$this->registry->template->news_date = $news->news_date;
			$this->registry->template->news_content =$news->news_content;
			
			$news->save();
			
			$this->registry->template->show('admin/news_delete');
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
		$this->registry->template->_page_title = 'Add News';
		if(isset($this->registry->router->args['_POST']['news_add'])){
			if(!empty($this->registry->router->args['_POST']['news_title']) 
				&& !empty($this->registry->router->args['_POST']['news_desc'])
				&& !empty($this->registry->router->args['_POST']['news_date'])
				&& !empty($this->registry->router->args['_POST']['news_content'])
			){
				$news = new news();
				
				$news->news_title = $this->registry->router->args['_POST']['news_title'];
				$news->news_desc = $this->registry->router->args['_POST']['news_desc'];
				$news->news_date = $this->registry->router->args['_POST']['news_date'];
				$news->news_content = $this->registry->router->args['_POST']['news_content'];

				$this->registry->template->info_msg = 'Operation successful';
				$news->save();
				$this->load_list();
			}else{
				$this->registry->template->error_msg='You supplied blank data for some expected text-entries';
				$this->registry->template->show('admin/news_add');
			}
		}else{
			$this->registry->template->show('admin/news_add');
		}
		}catch(Exception $err){
			$this->registry->template->error_msg='Some error occured: '.$err->getMessage();
			$this->registry->template->show('admin/news_add');
		}
	}
	
}

?>
