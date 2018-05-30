<?php
Class phoneController extends admin_base_controller{
	
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
	
	public function errorAction(){
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}	
	
	public function addAction(){
		$this->registry->template->_page_title = 'Add Phone Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_phone'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['admin_log']['id']);
				if($sc->max_phone == $ent->get_entity_count('phone') || $sc->max_phone < $ent->get_entity_count('phone') ) throw new Exception ('Max entries made');
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['visibility'])){
					if(!is_numeric($ps['detail'])){
						throw new Exception('Phone detail should be numeric');
					}
					$phone =  new phone();
					$phone->member_id=$_SESSION['admin_log']['id'];
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
				$this->registry->template->show('admin/add_phone');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/add_phone');
		}
	}
	
	private function visibilityToggle($bool){
		try{
			if(isset($this->registry->router->args['_PATH'][3]) && ($bool==1 || $bool==0)){
				$phone = new phone($this->registry->router->args['_PATH'][3]);
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
					$phone =  new phone($ps['edit_phone']);
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
				if(isset($this->registry->router->args['_PATH'][3])){
					$phone =  new phone($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $phone->front_name;
					$this->registry->template->detail= $phone->detail;
					$this->registry->template->visibility= $phone->data_public;
					$this->registry->template->phone_id= $phone->id;
					$this->registry->template->show('admin/edit_phone');
				}else{
					$this->registry->template->error_msg = 'Phone ID not specified';
					$this->registry->template->show('admin/edit_phone');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/edit_phone');
		}
	}
	
	public function deleteAction(){
		$this->registry->template->_page_title = 'Delete Phone Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->phone_id= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['delete_phone'])){
				$phone =  new phone();
				$ent = new entityData($_SESSION['admin_log']['id']);
				$c = $ent->get_entity_count('phone');
				if($c>1){
					$phone->delete_me($this->registry->router->args['_POST']['delete_phone']);
					$this->header_redirect('phone');
				}else{
					throw new Exception('You cannot delete this phone entry since you must have atleast one phone entry in the database');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][3])){
					$phone =  new phone($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $phone->front_name;
					$this->registry->template->detail= $phone->detail;
					$this->registry->template->visibility= $phone->data_public;
					$this->registry->template->phone_id= $phone->id;
					$this->registry->template->show('admin/delete_phone');
				}else{
					$this->registry->template->error_msg = 'Phone ID not specified';
					$this->registry->template->show('admin/delete_phone');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/delete_phone');
		}
	}
}