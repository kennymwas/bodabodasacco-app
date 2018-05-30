<?php
Class pageController Extends base_controller{
	public function indexAction() {
		$this->header_redirect('');
	}
	
	public function show(){
		try{
			$page = new page($this->registry->router->args['_PATH'][3]);
			
			$this->registry->template->_page_title = $page->page_title;
			$this->registry->template->page_content = $page->page_content;
			$this->registry->template->page_description = $page->page_desc;
			
			$this->registry->template->show('page');
			
		}catch(Exception $err){
			$this->registry->template->error_msg = '<h1>Error</h1>Bad URL specified';
			$this->registry->template->_page_title = 'Error 404';
			$this->registry->template->page_content = '<h2>Page Not Found</h2><br/>Sorry, we could not find the page you were looking for...';
			$this->registry->template->page_description = $page->page_desc;
			$this->registry->template->show('page');
		}
	}
	
	public function errorAction(){
		$this->registry->template->error_msg = '<h1>Error</h1>Bad URL specified';
		$this->registry->template->_page_title = 'Error 404';
		$this->registry->template->page_content = '<h2>Page Not Found</h2><br/>Sorry, we could not find the page you were looking for...';
		$this->registry->template->page_description = $page->page_desc;
		$this->registry->template->show('page');
	}
	
}
?>
