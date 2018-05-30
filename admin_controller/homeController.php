<?php
Class homeController extends admin_base_controller{
	public function indexAction() {
		$this->homeAction();
	}
	
	public function homeAction(){
		$mem = new member();
		$this->registry->template->_member_count = $mem->get_member_list_count();
		$this->registry->template->show('admin/home');
	}
	
	public function errorAction() {
		$this->registry->template->show('home');
	}
	
	public function logoutAction(){
		unset($_SESSION['admin_log']);
		$this->header_redirect('index/admin_login');
	}
	
}