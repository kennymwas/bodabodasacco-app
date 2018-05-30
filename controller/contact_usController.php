<?php
Class contact_usController Extends base_controller{
	public function indexAction() {
		$this->load_form();
	}
	
	private function load_form(){
		$this->registry->template->_page_title = 'Contact Us';
		$this->registry->template->page_content ='Hallo. Feel free to send us any of your queries using the form below';
		$this->registry->template->page_description = 'Contact us';
		$this->registry->template->dt = '';
		try{
		
			try{
			
				$page = new page('contact_us');
					
				$this->registry->template->_page_title = $page->page_title;
				$this->registry->template->page_content = $page->page_content;
				$this->registry->template->page_description = $page->page_desc;
				
			}catch(Exception $err){
				// log error, etc
			}
			
			if(isset($this->registry->router->args['_POST']['contact_us']) && isset($this->registry->router->args['_POST']['member_query_msg'])){
				$this->registry->template->dt = $this->registry->router->args['_POST']['member_query_msg'];
				$p = $this->registry->router->args['_POST'];
				if(!isset($_SESSION['log']['id']) && (!isset($p['member_query_name']) || !isset($p['member_query_email']))){
					throw new Exception('As you are not logged in, we require your name AND email address');
				}else{
					$qr = new member_query();
					if(isset($_SESSION['log']['id'])){
						$member = new member($_SESSION['log']['id']);
						$qr->member_id = $_SESSION['log']['id'];
						$qr->member_query_name = $member->name;
					}else if(isset($p['member_query_name']) && isset($p['member_query_email'])){
						$qr->member_query_name = $p['member_query_name'];
						$qr->member_query_email = $p['member_query_email'];
					}
					$qr->member_query_msg = $p['member_query_msg'];
					$qr->save();
					$this->registry->template->info_msg = 'Query successfully posted';
				}
			}else if(isset($this->registry->router->args['_POST']['contact_us'])){
				throw new Exception('Error: Missing data in post');
			}
			
			$this->registry->template->show('contact_us');
			
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Some error occured: '.$err->getMessage();
			
			$this->registry->template->show('contact_us');
		}
	}
	
	public function errorAction() {
		$this->page_load();
	}
	
}

?>
