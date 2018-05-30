<?php
Class phoneController Extends base_controller{
	
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
		$this->registry->template->_page_title = 'Phone Data';
		try{
			$phone = new phone();
			$this->registry->template->phone_list = $phone->get_phone_data_array($_SESSION['log']['id']);
			$this->registry->template->phone_list_count = sizeof($this->registry->template->phone_list);
			$this->registry->template->show('manage_phone');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('add_phone');
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}	
	
	public function addAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Add Phone Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_phone'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['log']['id']);
				if($sc->max_phone == $ent->get_entity_count('phone') || $sc->max_phone < $ent->get_entity_count('phone') ) throw new Exception ('Max entries made');
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['visibility'])){
					if(!is_numeric($ps['detail'])){
						throw new Exception('Phone detail should be numeric');
					}
					$phone =  new phone();
					$phone->member_id=$_SESSION['log']['id'];
					$phone->front_name = $ps['front_name'];
					$phone->detail = $ps['detail'];
					if($ps['visibility']=="public"){
						$phone->data_public = 1;
					}else{
						$phone->data_public = 0;
					}
					$phone->save();
					$this->header_redirect('phone');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				$this->registry->template->show('add_phone');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('add_phone');
		}
	}
	
	private function visibilityToggle($bool){
		try{
			if(isset($this->registry->router->args['_PATH'][2]) && ($bool==1 || $bool==0)){
				$phone = new phone($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$phone->data_public = $bool;
				$phone->save();
				$this->header_redirect('phone');
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
		$this->registry->template->_page_title = 'Edit Phone Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->phone_id= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['edit_phone'])){
				$ps = $this->registry->router->args['_POST'];
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['visibility'])){
					if(!is_numeric($ps['detail'])){
						throw new Exception('Phone detail should be numeric');
					}
					$phone =  new phone($ps['edit_phone'], $_SESSION['log']['id']);
					$phone->front_name = $ps['front_name'];
					$phone->detail = $ps['detail'];
					if($ps['visibility']=="public"){
						$phone->data_public = 1;
					}else{
						$phone->data_public = 0;
					}
					$phone->save();
					$this->header_redirect('phone');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$phone =  new phone($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->front_name= $phone->front_name;
					$this->registry->template->detail= $phone->detail;
					$this->registry->template->visibility= $phone->data_public;
					$this->registry->template->phone_id= $phone->id;
					$this->registry->template->show('edit_phone');
				}else{
					$this->registry->template->error_msg = 'Phone ID not specified';
					$this->registry->template->show('edit_phone');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('edit_phone');
		}
	}
	
	public function deleteAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Delete Phone Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->phone_id= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['delete_phone'])){
				$phone =  new phone();
				$ent = new entityData($_SESSION['log']['id']);
				$c = $ent->get_entity_count('phone');
				if($c>1){
					$phone->delete_me($this->registry->router->args['_POST']['delete_phone']);
					$this->header_redirect('phone');
				}else{
					throw new Exception('You cannot delete this phone entry since you musthave atleast one phone entry in the database');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$phone =  new phone($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->front_name= $phone->front_name;
					$this->registry->template->detail= $phone->detail;
					$this->registry->template->visibility= $phone->data_public;
					$this->registry->template->phone_id= $phone->id;
					$this->registry->template->show('delete_phone');
				}else{
					$this->registry->template->error_msg = 'Phone ID not specified';
					$this->registry->template->show('delete_phone');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('delete_phone');
		}
	}
}