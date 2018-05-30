<?php
Class indexController Extends base_controller{
	public function indexAction() {
		$this->header_redirect('home');
	}
	
	public function cssAction(){
		$this->registry->template->show('main_css');
	}
	/*bootstrap.min*/
	public function bootstrap_minAction(){
		$this->registry->template->show('bootstrap.min');
	}
	/*bootstrap*/
	public function bootstrapAction(){
		$this->registry->template->show('bootstrap');
	}
	
	public function page_load(){
		try{
			$page = new page($this->registry->router->args['_PATH'][0]);
			
			$this->registry->template->_page_title = $page->page_title;
			$this->registry->template->page_content = $page->page_content;
			$this->registry->template->page_description = $page->page_desc;
			
			$this->registry->template->show('page');
			
		}catch(Exception $err){
			$this->registry->template->error_msg = '<h1>Error</h1>Bad URL specified';
			$this->registry->template->_page_title = 'Error 404';
			$this->registry->template->page_content = '<h2>Page Not Found</h2><br/>Sorry, we could not find the page you were looking for...';
			$this->registry->template->show('page');
		}
    }
	
	public function contact_us(){
		try{
			$page = new page('contact_us');
			
			$this->registry->template->_page_title = $page->page_title;
			$this->registry->template->page_content = $page->page_content;
			$this->registry->template->page_description = $page->page_desc;
			
			$this->registry->template->show('contact_us');
			
		}catch(Exception $err){
			$this->registry->template->error_msg = '<h1>Error</h1>Bad URL specified';
			$this->registry->template->_page_title = 'Error 404';
			$this->registry->template->page_content = '<h2>Page Not Found</h2><br/>Sorry, we could not find the page you were looking for...';
			$this->registry->template->show('page');
		}

	}
	
	
	
	public function errorAction() {
		/* this function will probably never be executed. Included since it is defined as abstract method in parent class */
	}
	
}

?>
