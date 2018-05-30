<?php
Class physicalAddressController Extends base_controller{
	
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
		$this->registry->template->_page_title = 'Physical Address Data';
		try{
			$physicalAddress = new physicalAddress();
			$this->registry->template->physicalAddress_list = $physicalAddress->get_physicalAddress_data_array($_SESSION['log']['id']);
			$this->registry->template->physicalAddress_list_count = sizeof($this->registry->template->physicalAddress_list);
			$this->registry->template->show('manage_physicalAddress');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('add_physicalAddress');
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}	
	
	public function addAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Add Physical Address Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_physicalAddress'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['log']['id']);
				if($sc->max_physicalAddress == $ent->get_entity_count('phyAddress') || $sc->max_physicalAddress < $ent->get_entity_count('phyAddress') ) throw new Exception ('Max entries made');
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['city']) && !empty($ps['country_id']) && !empty($ps['visibility'])){
					$physicalAddress =  new physicalAddress();
					$physicalAddress->member_id=$_SESSION['log']['id'];
					$physicalAddress->front_name = $ps['front_name'];
					$physicalAddress->detail = $ps['detail'];
					$physicalAddress->city = $ps['city'];
					$physicalAddress->country_id = $ps['country_id'];
					if($ps['visibility']=="public"){
						$physicalAddress->data_public = 1;
					}else{
						$physicalAddress->data_public = 0;
					}
					$physicalAddress->save();
					$this->header_redirect('physicalAddress');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				$ent = new entityData($_SESSION['log']['id']);
				$this->registry->template->country_list = $ent->get_country_listing();
				$this->registry->template->show('add_physicalAddress');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('add_physicalAddress');
		}
	}
	
	private function visibilityToggle($bool){
		try{
			if(isset($this->registry->router->args['_PATH'][2]) && ($bool==1 || $bool==0)){
				$physicalAddress = new physicalAddress($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
				$physicalAddress->data_public = $bool;
				$physicalAddress->save();
				$this->header_redirect('physicalAddress');
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
		$this->registry->template->_page_title = 'Edit Physical Address Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->physicalAddress_id= 'N/A';
		$this->registry->template->city= 'N/A';
		$this->registry->template->country_name= 'N/A';
		$this->registry->template->country_id= 0;
		$this->registry->template->country_list=array();
		try{
			if(isset($this->registry->router->args['_POST']['edit_physicalAddress'])){
				$ps = $this->registry->router->args['_POST'];
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['city']) && !empty($ps['country_id']) && !empty($ps['visibility'])){
					$physicalAddress =  new physicalAddress($ps['edit_physicalAddress'], $_SESSION['log']['id']);
					$physicalAddress->front_name = $ps['front_name'];
					$physicalAddress->detail = $ps['detail'];
					$physicalAddress->city = $ps['city'];
					$physicalAddress->country_id = $ps['country_id'];
					if($ps['visibility']=="public"){
						$physicalAddress->data_public = 1;
					}else{
						$physicalAddress->data_public = 0;
					}
					$physicalAddress->save();
					$this->header_redirect('physicalAddress');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$physicalAddress =  new physicalAddress($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->front_name= $physicalAddress->front_name;
					$this->registry->template->detail= $physicalAddress->detail;
					$this->registry->template->visibility= $physicalAddress->data_public;
					$this->registry->template->physicalAddress_id= $physicalAddress->id;
					$this->registry->template->city= $physicalAddress->city;
					$this->registry->template->country_name= $physicalAddress->country_name;
					$this->registry->template->country_id= $physicalAddress->country_id;
					
					$ent = new entityData($_SESSION['log']['id']);
					$this->registry->template->country_list = $ent->get_country_listing();
					
					$this->registry->template->show('edit_physicalAddress');
				}else{
					$this->registry->template->error_msg = 'Physical Address ID not specified';
					$this->registry->template->show('edit_physicalAddress');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('edit_physicalAddress');
		}
	}
	
	public function deleteAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Edit Physical Address Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->physicalAddress_id= 'N/A';
		$this->registry->template->city= 'N/A';
		$this->registry->template->country_name= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['delete_physicalAddress'])){
				$physicalAddress =  new physicalAddress();
				$ent = new entityData($_SESSION['log']['id']);
				$physicalAddress->delete_me($this->registry->router->args['_POST']['delete_physicalAddress']);
				$this->header_redirect('physicalAddress');
			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$physicalAddress =  new physicalAddress($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->front_name= $physicalAddress->front_name;
					$this->registry->template->detail= $physicalAddress->detail;
					$this->registry->template->visibility= $physicalAddress->data_public;
					$this->registry->template->physicalAddress_id= $physicalAddress->id;
					$this->registry->template->city= $physicalAddress->city;
					$this->registry->template->country_name= $physicalAddress->country_name;
					$this->registry->template->show('delete_physicalAddress');
				}else{
					$this->registry->template->error_msg = 'Physical Address ID not specified';
					$this->registry->template->show('delete_physicalAddress');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('delete_physicalAddress');
		}
	}
}