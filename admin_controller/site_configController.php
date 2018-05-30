<?php
Class site_configController extends admin_base_controller{
	
	public function indexAction() {
		$this->listAction();
	}
	
	public function listAction(){
		try{
			$this->registry->template->_page_title = 'Site Configuration Data';
			$sc = new site_config();
			$this->registry->template->config_list = $sc->get_data_in_array();
			$this->registry->template->config_count = count($this->registry->template->config_list);
			if($this->registry->template->config_count==0){
				$this->registry->template->no_page_info = 'No config data defined in database';
			}
			$this->registry->template->show('admin/site_config');
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Unale to load config data: '.$err->getMessage();
			$this->registry->template->show('admin/site_config');
		}
	}
	
	public function editAction(){
		try{
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->_page_title = 'Site Configuration Data';
				$sc = new site_config();
				$this->registry->template->config_list = $sc->get_data_in_array();
				$this->registry->template->config_count = count($this->registry->template->config_list);
				if($this->registry->template->config_count==0){
					$this->registry->template->no_page_info = 'No config data defined in database';
				}
				$this->registry->template->show('admin/site_config_edit');
			}else{
				$p = $this->registry->router->args['_POST'];
				$sc = new site_config();
				foreach($p as $key => $val){
					$sc->set_config($key, $val);
					$sc->save();
				}
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Unale to load config data: '.$err->getMessage();
			$this->registry->template->show('admin/site_config_edit');
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->registry->template->show('admin/site_config');
	}	
}