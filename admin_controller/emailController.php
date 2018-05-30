<?php
Class emailController extends admin_base_controller{
	
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
		echo "bad url";
	}	
	
	public function addAction(){
		$this->registry->template->_page_title = 'Add Email Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_email'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['admin_log']['id']);
				if($sc->max_email == $ent->get_entity_count('email') || $sc->max_email < $ent->get_entity_count('email') ) throw new Exception ('Max entries made');
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['visibility'])){
					$email =  new email();
					$email->member_id=$_SESSION['admin_log']['id'];
					$email->front_name = $ps['front_name'];
					$email->detail = $ps['detail'];
					if($ps['visibility']=="public"){
						$email->data_public = 1;
					}else{
						$email->data_public = 0;
					}
					$email->save();
					$this->header_redirect('email');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				$this->registry->template->show('admin/add_email');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/add_email');
		}
	}
	
	private function visibilityToggle($bool){
		try{
			if(isset($this->registry->router->args['_PATH'][3]) && ($bool==1 || $bool==0)){
				$email = new email($this->registry->router->args['_PATH'][3]);
				$email->data_public = $bool;
				$email->save();
				$this->header_redirect('email');
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
		$this->registry->template->_page_title = 'Edit Email Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->email_id= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['edit_email'])){
				$ps = $this->registry->router->args['_POST'];
				if(!empty($ps['front_name']) && !empty($ps['detail']) && !empty($ps['visibility'])){
					$email =  new email($ps['edit_email']);
					$email->front_name = $ps['front_name'];
					$email->detail = $ps['detail'];
					if($ps['visibility']=="public"){
						$email->data_public = 1;
					}else{
						$email->data_public = 0;
					}
					$email->save();
					$this->header_redirect('email');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][3])){
					$email =  new email($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $email->front_name;
					$this->registry->template->detail= $email->detail;
					$this->registry->template->visibility= $email->data_public;
					$this->registry->template->email_id= $email->id;
					$this->registry->template->show('admin/edit_email');
				}else{
					$this->registry->template->error_msg = 'Email ID not specified';
					$this->registry->template->show('admin/edit_email');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/edit_email');
		}
	}
	
	public function deleteAction(){
		$this->registry->template->_page_title = 'Delete Email Data';
		$this->registry->template->front_name= 'N/A';
		$this->registry->template->detail= 'N/A';
		$this->registry->template->visibility= 'N/A';
		$this->registry->template->email_id= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['delete_email'])){
				$email =  new email();
				$ent = new entityData($_SESSION['admin_log']['id']);
				$c = $ent->get_entity_count('email');
				if($c>1){
					$email->delete_me($this->registry->router->args['_POST']['delete_email']);
					$this->header_redirect('email');
				}else{
					throw new Exception('You cannot delete this email entry since you musthave atleast one email entry in the database');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][3])){
					$email =  new email($this->registry->router->args['_PATH'][3]);
					$this->registry->template->front_name= $email->front_name;
					$this->registry->template->detail= $email->detail;
					$this->registry->template->visibility= $email->data_public;
					$this->registry->template->email_id= $email->id;
					$this->registry->template->show('admin/delete_email');
				}else{
					$this->registry->template->error_msg = 'Email ID not specified';
					$this->registry->template->show('admin/delete_email');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/delete_email');
		}
	}
}