<?php
Class postalController extends admin_base_controller{
	
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
		$this->registry->template->_page_title = 'Add Postal Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_postal'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['admin_log']['id']);
				if($sc->max_postal == $ent->get_entity_count('postal') || $sc->max_postal < $ent->get_entity_count('postal') ) throw new Exception ('Max entries made');
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['code']) && !empty($ps['city']) && !empty($ps['country_id']) && !empty($ps['visibility'])){
					$postal =  new postal();
					$postal->member_id=$_SESSION['admin_log']['id'];
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
				$ent = new entityData($_SESSION['admin_log']['id']);
				$this->registry->template->country_list = $ent->get_country_listing();
				$this->registry->template->show('admin/add_postal');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/add_postal');
		}
	}
	
	private function visibilityToggle($bool){
		try{
			if(isset($this->registry->router->args['_PATH'][3]) && ($bool==1 || $bool==0)){
				$postal = new postal($this->registry->router->args['_PATH'][3]);
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
					$postal =  new postal($ps['edit_postal']);
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
				if(isset($this->registry->router->args['_PATH'][3])){
					$postal =  new postal($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $postal->front_name;
					$this->registry->template->detail= $postal->detail;
					$this->registry->template->visibility= $postal->data_public;
					$this->registry->template->postal_id= $postal->id;
					$this->registry->template->code= $postal->postal_code;
					$this->registry->template->city= $postal->city;
					$this->registry->template->country_name= $postal->country_name;
					$this->registry->template->country_id= $postal->country_id;
					
					$ent = new entityData($_SESSION['admin_log']['id']);
					$this->registry->template->country_list = $ent->get_country_listing();
					
					$this->registry->template->show('admin/edit_postal');
				}else{
					$this->registry->template->error_msg = 'Postal ID not specified';
					$this->registry->template->show('admin/edit_postal');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/edit_postal');
		}
	}
	
	public function deleteAction(){
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
				$ent = new entityData($_SESSION['admin_log']['id']);
				$postal->delete_me($this->registry->router->args['_POST']['delete_postal']);
				$this->header_redirect('postal');

			}else{
				if(isset($this->registry->router->args['_PATH'][3])){
					$postal =  new postal($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $postal->front_name;
					$this->registry->template->detail= $postal->detail;
					$this->registry->template->visibility= $postal->data_public;
					$this->registry->template->postal_id= $postal->id;
					$this->registry->template->code= $postal->postal_code;
					$this->registry->template->city= $postal->city;
					$this->registry->template->country_name= $postal->country_name;
					$this->registry->template->show('admin/delete_postal');
				}else{
					$this->registry->template->error_msg = 'Postal ID not specified';
					$this->registry->template->show('admin/delete_postal');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/delete_postal');
		}
	}
}