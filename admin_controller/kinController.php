<?php
Class kinController extends admin_base_controller{
	
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
		$this->registry->template->_page_title = 'Add Kin Data';
		try{
			if(isset($this->registry->router->args['_POST']['add_kin'])){
				$ps = $this->registry->router->args['_POST'];
				$sc = $this->registry->sacco_configs;
				$ent = new entityData($_SESSION['admin_log']['id']);
				if($sc->max_kin == $ent->get_entity_count('kin') ) throw new Exception ('Max entries made');
				if(!empty($ps['name']) && !empty($ps['phone']) && !empty($ps['address']) && !empty($ps['relation'])){
					$kin =  new kin();
					$kin->member_id=$_SESSION['admin_log']['id'];
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
				$this->registry->template->show('admin/add_kin');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/add_kin');
		}
	}
	
	public function editAction(){
		$this->registry->template->_page_title = 'Edit Kin Data';
		$this->registry->template->name= 'N/A';
		$this->registry->template->relation= 'N/A';
		$this->registry->template->phone= 'N/A';
		$this->registry->template->address= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['edit_kin'])){
				$ps = $this->registry->router->args['_POST'];
				if(!empty($ps['name']) && !empty($ps['phone']) && !empty($ps['address']) && !empty($ps['relation'])){
					$kin =  new kin($ps['edit_kin']);
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
				if(isset($this->registry->router->args['_PATH'][3])){
					$kin =  new kin($this->registry->router->args['_PATH'][3]);
					$this->registry->template->name= $kin->name;
					$this->registry->template->relation= $kin->relation;
					$this->registry->template->phone= $kin->phone;
					$this->registry->template->address= $kin->address;
					$this->registry->template->kin_id= $kin->id;
					$this->registry->template->show('admin/edit_kin');
				}else{
					$this->registry->template->error_msg = 'Kin ID not specified';
					$this->registry->template->show('admin/edit_kin');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/edit_kin');
		}
	}
	
	public function deleteAction(){
		$this->registry->template->_page_title = 'Edit Kin Data';
		$this->registry->template->name= 'N/A';
		$this->registry->template->relation= 'N/A';
		$this->registry->template->phone= 'N/A';
		$this->registry->template->address= 'N/A';
		try{
			if(isset($this->registry->router->args['_POST']['delete_kin'])){
				$kin =  new kin();
				$ent = new entityData($_SESSION['admin_log']['id']);
				$c = $ent->get_entity_count('kin');
				if($c>1){
					$kin->delete_me($this->registry->router->args['_POST']['delete_kin']);
					$this->header_redirect('kin');
				}else{
					throw new Exception('You cannot delete this kin entry since you musthave atleast one kin entry in the database');
				}
			}else{
				if(isset($this->registry->router->args['_PATH'][3])){
					$kin =  new kin($this->registry->router->args['_PATH'][3]);
					$this->registry->template->name= $kin->name;
					$this->registry->template->relation= $kin->relation;
					$this->registry->template->phone= $kin->phone;
					$this->registry->template->address= $kin->address;
					$this->registry->template->kin_id= $kin->id;
					$this->registry->template->show('admin/delete_kin');
				}else{
					$this->registry->template->error_msg = 'Kin ID not specified';
					$this->registry->template->show('admin/delete_kin');
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->registry->template->show('admin/delete_kin');
		}
	}
}