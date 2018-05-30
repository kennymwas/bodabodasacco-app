<?php
Class error404Controller extends base_controller {
	public function indexAction() {
		$this->registry->template->blog_heading = 'Bad Link';
		$this->registry->template->show('error404');
	}
	
	public function errorAction() {
		$this->registry->template->blog_heading = 'Bad Link';
		$this->registry->template->show('error404');
	}
	
	public function badPathAction($msg){
		echo $msg;
	}
}
