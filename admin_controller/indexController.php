<?php
Class indexController extends admin_base_controller{
	public function indexAction() {
		$this->homeAction();
	}
	
	public function homeAction() {
		$this->header_redirect('home');
	}
	
	public function __construct($registry) {
		$this->registry = $registry;
		// if(!isset($_SESSION['admin_log'])){
			// $this->header_redirect('index/admin_login');
			// exit;
		// }else{
			// $this->registry->template->_admin_user = $_SESSION['admin_log']['admin_name'];
		// }
	}
	
	public function admin_loginAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][2])){
				if($this->registry->router->args['_PATH'][2]=='1'){
					$this->registry->template->error_msg='You need to be logged in first to view the admin section';
				}
			}
			if(isset($this->registry->router->args['_POST']['user_email']) && isset($this->registry->router->args['_POST']['user_pass'])){
				if($this->registry->router->args['_POST']['user_email'] == '' || $this->registry->router->args['_POST']['user_pass']==''){
					$this->registry->template->_page_title = 'Admin Login';
					$this->registry->template->error_msg= 'Error: Entries required for both admin login name and password';
					$this->registry->template->show('admin/admin_login');
				}else{
					$admin =  new admin();
					$admin->load_by_emailPass($this->registry->router->args['_POST']['user_email'],$this->registry->router->args['_POST']['user_pass']);
					$_SESSION['admin_log']['type']= 'admin';
					$_SESSION['admin_log']['id'] = $admin->user_id;
					$_SESSION['admin_log']['admin_name'] = $admin->admin_name;
					$this->header_redirect('home');
				}
			}else if(!isset($_SESSION['admin_log'])){
				$this->registry->template->_page_title = 'Admin Login';
				$this->registry->template->show('admin/admin_login'); 
			}else{
				$this->header_redirect('home');
			}
		}catch (Exception $err){
			$this->registry->template->_page_title = 'Admin Login';
			$this->registry->template->error_msg= $err->getMessage();
			$this->registry->template->show('admin/admin_login');
		}
	}
	
	public function page_load(){
		//echo $name;
		//print_r($this->registry->router->args['_PATH']);
		$page = new page();
		$page->run_page_load();
		//exit;
		if($page->error==0){
			$this->registry->template->page_content_meta_desc = $page->page_content_meta_desc;
			$this->registry->template->page_creation_time = $page->page_creation_time;
			$this->registry->template->page_data_title = $page->page_data_title;
			$this->registry->template->page_content_detail = $page->page_content_detail;
			$this->registry->template->page_section_title = $page->page_section_title;
			$this->registry->template->page_section_side_section_title = $page->page_section_side_section_title;
			$this->registry->template->page_section_side_section_data = $page->page_section_side_section_data;
			$this->registry->template->user_front_name = $page->user_front_name;
			$this->registry->template->show('admin/page');
		}else{
			echo $page->error_type;
		}
		
    }
	
	public function errorAction() {
		/*** set a template variable ***/
			$this->registry->template->welcome = 'Welcome to PHPRO MVC';
		/*** load the index template ***/
		echo "errorAction";
			//$this->registry->template->show('admin/index');
	}
	
}

?>
