<?php
Class kinController Extends base_controller{
	
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
		$this->registry->template->_page_title = 'Kin Data';
		try{
			$kin = new kin();
			$this->registry->template->kin_list = $kin->get_kin_data_array($_SESSION['log']['id']);
			$this->registry->template->kin_list_count = sizeof($this->registry->template->kin_list);
			$this->registry->template->show('manage_kin');
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('add_kin');
		}
	}
	
	public function errorAction() {
		echo "bad url";
	}	
	
	public function addAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Add Kin Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_kin'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['log']['id']);
				if($sc->max_kin == $ent->get_entity_count('kin') ) throw new Exception ('Max entries made');
				if(!empty($ps['name']) && !empty($ps['phone']) && !empty($ps['address']) && !empty($ps['relation'])){

					if(strlen($this->registry->router->args['_POST']['phone'])<10){
						throw new Exception('Please use a valid phone number');
						$this->registry->template->_page_title = 'Add Kin Data';
						$this->registry->template->error_msg = 'Invalid phone number';
						$this->registry->template->show('add_kin');}

						else{

						$kin =  new kin();
						$kin->member_id=$_SESSION['log']['id'];
						$kin->name = $ps['name'];
						$kin->phone = $ps['phone'];
						$kin->address = $ps['address'];
						$kin->relation = $ps['relation'];
						$kin->save();
						$this->header_redirect('kin');
							
							}

				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				$this->registry->template->show('add_kin');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Error: ".$err->getMessage();
			$this->registry->template->show('add_kin');
		}
	}
	
	public function editAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Edit Kin Data';
		$this->registry->template->name= '';
		$this->registry->template->relation= '';
		$this->registry->template->phone= '';
		$this->registry->template->address= '';
		try{
			if(isset($this->registry->router->args['_POST']['edit_kin'])){
				$ps = $this->registry->router->args['_POST'];
				if(!empty($ps['name']) && !empty($ps['phone']) && !empty($ps['address']) && !empty($ps['relation'])){
					$kin =  new kin($ps['edit_kin'], $_SESSION['log']['id']);
					$kin->name = $ps['name'];
					$kin->phone = $ps['phone'];
					$kin->address = $ps['address'];
					$kin->relation = $ps['relation'];
					$kin->save();
					$this->header_redirect('kin');
				}else{
					throw new Exception('Missing data in post');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$kin =  new kin($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->name= $kin->name;
					$this->registry->template->relation= $kin->relation;
					$this->registry->template->phone= $kin->phone;
					$this->registry->template->address= $kin->address;
					$this->registry->template->kin_id= $kin->id;
					$this->registry->template->show('edit_kin');
				}else{
					$this->registry->template->error_msg = 'Kin ID not specified';
					$this->registry->template->show('edit_kin');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('edit_kin');
		}
	}
	
	public function deleteAction(){
		$this->check_if_logged();
		$this->registry->template->_page_title = 'Edit Kin Data';
		$this->registry->template->name= 'N/A';
		$this->registry->template->relation= 'N/A';
		$this->registry->template->phone= 'N/A';
		$this->registry->template->address= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['delete_kin'])){
				$kin =  new kin();
				$ent = new entityData($_SESSION['log']['id']);
				$c = $ent->get_entity_count('kin');
				if($c>1){
					$kin->delete_me($this->registry->router->args['_POST']['delete_kin']);
					$this->header_redirect('kin');
				}else{
					throw new Exception('You cannot delete this kin entry since you musthave atleast one kin entry in the database');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][2])){
					$kin =  new kin($this->registry->router->args['_PATH'][2], $_SESSION['log']['id']);
					$this->registry->template->name= $kin->name;
					$this->registry->template->relation= $kin->relation;
					$this->registry->template->phone= $kin->phone;
					$this->registry->template->address= $kin->address;
					$this->registry->template->kin_id= $kin->id;
					$this->registry->template->show('delete_kin');
				}else{
					$this->registry->template->error_msg = 'Kin ID not specified';
					$this->registry->template->show('delete_kin');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('delete_kin');
		}
	}
}