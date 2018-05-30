<?php
Class postalController Extends base_controller{
	
	public function indexAction(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/');
		}else{
			$this->listAction();
		}
	}
	
	public function check_if_logged(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			exit;
		}
		return;
	}
	
	public function listAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Postal Data';
		try{
			$postal = new postal();
			$this->registry->template->postal_list = $postal->get_postal_data_array($_SESSION['log']['id']);
			$this->registry->template->postal_list_count = sizeof($this->registry->template->postal_list);
			$this->registry->template->show('manage_postal');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('add_postal');
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}	
	
	public function addAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Add Postal Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_postal'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['log']['id']);
				if($sc->max_postal == $ent->get_entity_count('postal') || $sc->max_postal < $ent->get_entity_count('postal') ) throw new Exception ('Max entries made');
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['code']) && !empty($ps['city']) && !empty($ps['country_id']) && !empty($ps['visibility'])){
					$postal =  new postal();
					$postal->member_id=$_SESSION['log']['id'];
					$postal->front_name = $ps['front_name'];
					$postal->detail = $ps['detail'];
					$postal->postal_code = $ps['code'];
					$postal->city = $ps['city'];
					$postal->country_id = $ps['country_id'];
					if($ps['visibility']=="public"){
						$postal->data_public = 1;
					}else{
						$postal->data_public = 0;
					}
					$postal->save();
					$this->header_redirect('postal');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				$ent = new entityData($_SESSION['log']['id']);
				$this->registry->template->country_list = $ent->get_country_listing();
				$this->registry->template->show('add_postal');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('add_postal');
		}
	}
	
	private function visibilityToggle($bool){
		try{
			if(isset($this->registry->router->args['_PATH'][2]) && ($bool==1 || $bool==0)){
				$postal = new postal($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$postal->data_public = $bool;
				$postal->save();
				$this->header_redirect('postal');
			}else{
				$this->registry->template->error_msg = "Bad data in request";
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
		}
	}
	
	public function hideAction(){
		$this->visibilityToggle(false);
	}
	
	public function showAction(){
		$this->visibilityToggle(true);
	}
	
	public function editAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Edit Postal Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->postal_id= 'N/A';
		$this->registry->template->code= 'N/A';
		$this->registry->template->city= 'N/A';
		$this->registry->template->country_name= 'N/A';
		$this->registry->template->country_id= 0;
		$this->registry->template->country_list=array();
		try{
			if(isset($this->registry->router->args['_POST']['edit_postal'])){
				$ps = $this->registry->router->args['_POST'];
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['code']) && !empty($ps['city']) && !empty($ps['country_id']) && !empty($ps['visibility'])){
					$postal =  new postal($ps['edit_postal'], $_SESSION['log']['id']);
					$postal->front_name = $ps['front_name'];
					$postal->detail = $ps['detail'];
					$postal->code = $ps['code'];
					$postal->city = $ps['city'];
					$postal->country_id = $ps['country_id'];
					if($ps['visibility']=="public"){
						$postal->data_public = 1;
					}else{
						$postal->data_public = 0;
					}
					$postal->save();
					$this->header_redirect('postal');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$postal =  new postal($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->front_name= $postal->front_name;
					$this->registry->template->detail= $postal->detail;
					$this->registry->template->visibility= $postal->data_public;
					$this->registry->template->postal_id= $postal->id;
					$this->registry->template->code= $postal->postal_code;
					$this->registry->template->city= $postal->city;
					$this->registry->template->country_name= $postal->country_name;
					$this->registry->template->country_id= $postal->country_id;
					
					$ent = new entityData($_SESSION['log']['id']);
					$this->registry->template->country_list = $ent->get_country_listing();
					
					$this->registry->template->show('edit_postal');
				}else{
					$this->registry->template->error_msg = 'Postal ID not specified';
					$this->registry->template->show('edit_postal');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('edit_postal');
		}
	}
	
	public function deleteAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Edit Postal Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->postal_id= 'N/A';
		$this->registry->template->code= 'N/A';
		$this->registry->template->city= 'N/A';
		$this->registry->template->country_name= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['delete_postal'])){
				$postal =  new postal();
				$ent = new entityData($_SESSION['log']['id']);
				$postal->delete_me($this->registry->router->args['_POST']['delete_postal']);
				$this->header_redirect('postal');

			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$postal =  new postal($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->front_name= $postal->front_name;
					$this->registry->template->detail= $postal->detail;
					$this->registry->template->visibility= $postal->data_public;
					$this->registry->template->postal_id= $postal->id;
					$this->registry->template->code= $postal->postal_code;
					$this->registry->template->city= $postal->city;
					$this->registry->template->country_name= $postal->country_name;
					$this->registry->template->show('delete_postal');
				}else{
					$this->registry->template->error_msg = 'Postal ID not specified';
					$this->registry->template->show('delete_postal');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('delete_postal');
		}
	}
}