<?php
Class newsController Extends base_controller{
	public function indexAction() {
		$this->load_list();
	}
	
	public function cssAction(){
		$this->registry->template->show('main_css');
	}
	
	public function page_load(){
		try{
			if(isset($this->registry->router->args['_PATH'][1])){
				$news = new news($this->registry->router->args['_PATH'][1]);
				
				$this->registry->template->_page_title = $news->news_title;
				$this->registry->template->page_content = $news->news_content;
				$this->registry->template->page_description = $news->news_desc;
				$this->registry->template->news_date = $news->news_date;
				
				$this->registry->template->show('news');
			}else{
				$this->header_redirect('home');
			}
			
		}catch(Exception $err){
			$this->registry->template->error_msg = '<h1>Error</h1>Bad URL specified';
			$this->registry->template->_page_title = 'Error 404';
			$this->registry->template->page_content = '<h2>Page Not Found</h2><br/>Sorry, we could not find the page you were looking for...';
			$this->registry->template->show('page');
		}
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
			$this->registry->template->show('news_list');
		}else{
			$this->registry->template->no_page_info = 'No news entries have been defined yet.';
			$this->registry->template->show('news_list');
		}
	}
	
	public function errorAction() {
		$this->page_load();
	}
	
}

?>
