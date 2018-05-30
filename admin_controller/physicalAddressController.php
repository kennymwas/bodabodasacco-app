<?php
Class physicalAddressController extends admin_base_controller{
	
	public function indexAction(){
		$this->listAction();
	}
	
	public function listAction(){
		try{
			if(isset($_SESSION['admin_log']['member_id'])){
				$this->header_redirect('members/view_detail/'.$_SESSION['admin_log']['member_id']);
			}else{
				$this->header_redirect('members');
			}
		}catch(Exception $err){
			echo "Some error occured!! ".$err->getMessage();
		}
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}	
	
	public function addAction(){
		$this->registry->template->_page_title = 'Add Physical Address Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_physicalAddress'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['admin_log']['id']);
				if($sc->max_physicalAddress == $ent->get_entity_count('phyAddress') || $sc->max_physicalAddress < $ent->get_entity_count('phyAddress') ) throw new Exception ('Max entries made');
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['city']) && !empty($ps['country_id']) && !empty($ps['visibility'])){
					$physicalAddress =  new physicalAddress();
					$physicalAddress->member_id=$_SESSION['admin_log']['id'];
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
				$ent = new entityData($_SESSION['admin_log']['id']);
				$this->registry->template->country_list = $ent->get_country_listing();
				$this->registry->template->show('admin/add_physicalAddress');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/add_physicalAddress');
		}
	}
	
	private function visibilityToggle($bool){
		try{
			if(isset($this->registry->router->args['_PATH'][3]) && ($bool==1 || $bool==0)){
				$physicalAddress = new physicalAddress($this->registry->router->args['_PATH'][3]);
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
					$physicalAddress =  new physicalAddress($ps['edit_physicalAddress']);
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
				if(isset($this->registry->router->args['_PATH'][3])){
					$physicalAddress =  new physicalAddress($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $physicalAddress->front_name;
					$this->registry->template->detail= $physicalAddress->detail;
					$this->registry->template->visibility= $physicalAddress->data_public;
					$this->registry->template->physicalAddress_id= $physicalAddress->id;
					$this->registry->template->city= $physicalAddress->city;
					$this->registry->template->country_name= $physicalAddress->country_name;
					$this->registry->template->country_id= $physicalAddress->country_id;
					
					$ent = new entityData($_SESSION['admin_log']['id']);
					$this->registry->template->country_list = $ent->get_country_listing();
					
					$this->registry->template->show('admin/edit_physicalAddress');
				}else{
					$this->registry->template->error_msg = 'Physical Address ID not specified';
					$this->registry->template->show('admin/edit_physicalAddress');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/edit_physicalAddress');
		}
	}
	
	public function deleteAction(){
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
				$ent = new entityData($_SESSION['admin_log']['id']);
				$physicalAddress->delete_me($this->registry->router->args['_POST']['delete_physicalAddress']);
				$this->header_redirect('physicalAddress');
			}else{
				if(isset($this->registry->router->args['_PATH'][3])){
					$physicalAddress =  new physicalAddress($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $physicalAddress->front_name;
					$this->registry->template->detail= $physicalAddress->detail;
					$this->registry->template->visibility= $physicalAddress->data_public;
					$this->registry->template->physicalAddress_id= $physicalAddress->id;
					$this->registry->template->city= $physicalAddress->city;
					$this->registry->template->country_name= $physicalAddress->country_name;
					$this->registry->template->show('admin/delete_physicalAddress');
				}else{
					$this->registry->template->error_msg = 'Physical Address ID not specified';
					$this->registry->template->show('admin/delete_physicalAddress');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/delete_physicalAddress');
		}
	}
}