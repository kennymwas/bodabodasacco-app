<?php
Class list_utilityController extends admin_base_controller{
	public function indexAction(){
		$this->listAction();
	}
	
	public function errorAction() {
		$this->registry->template->error_msg = 'Bad URL specified';
		$this->listAction();
	}
	
	public function listAction(){
		try{
			$this->registry->template->_page_title = 'Utilities';
			$ut = new utility();
			$this->registry->template->utility_count = $ut->get_table_row_count();
			if($this->registry->template->utility_count==0){
				$this->registry->template->no_page_info = 'No utilities have been defined';
			}else{
				$this->registry->template->utility_list = $ut->get_table_rows_in_array();
			}
			$this->registry->template->show('admin/utility');
		}catch(Exception $err){
			echo "Some error occured. Cannot list utilities :<br/><br/>".$err->getMessage();
		}
	}
	
	public function paymentsAction(){
		$this->registry->template->_page_title = 'Utility-Payments';
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$utility = new utility($this->registry->router->args['_PATH'][3]);
				$utility_payment = new utility_payment();
				
				$this->registry->template->_page_title = 'Utility-Payments: '.$utility->utility_name;
				$this->registry->template->utility_payment_list = $utility_payment->get_utility_payment_data_in_array($this->registry->router->args['_PATH'][3]);
				$this->registry->template->utility_payment_count = $utility_payment->get_utility_payment_count($this->registry->router->args['_PATH'][3]);
				$this->registry->template->utility_payment_total = $utility_payment->get_utility_payments_total($this->registry->router->args['_PATH'][3]);
				
				//print_r($this->registry->template->loan_payment_list);
				$this->registry->template->show('admin/utility_payments');
			}else{
				$this->registry->template->error_msg = "Bad URL. Valid Utility ID required in URL";
				$this->listAction();
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = "Some error occured: ".$err->getMessage();
			$this->listAction();
		}
	}
	
	public function addAction(){
		try{
			$this->registry->template->_page_title = 'Add Utility';
			if(isset($this->registry->router->args['_POST']['utility_add'])){
				$p = $this->registry->router->args['_POST'];
				$ut = new utility();
				$ut->utility_name= $p['utility_name'];
				$ut->utility_website= $p['utility_website'];
				$ut->utility_email= $p['utility_email'];
				$ut->utility_phone= $p['utility_phone'];
				$ut->utility_postal= $p['utility_postal'];
				$ut->utility_address= $p['utility_address'];
				$ut->save();
				$this->listAction();
			}else{
				$this->registry->template->show('admin/utility_add');
			}
		}catch(Exception $err){
			if($err->getMessage()=="SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'kplc' for key 'utility_name'"){
				$this->registry->template->error_msg = 'A utility record already exists with that utility name';
			}else{
				$this->registry->template->error_msg = $err->getMessage();
			}
			$this->registry->template->show('admin/utility_add');
		}
	}
	
	private function load_utility_data($id){
		$ut = new utility($id);
		$this->registry->template->utility_id= $ut->utility_id;
		$this->registry->template->utility_name= $ut->utility_name;
		$this->registry->template->utility_website= $ut->utility_website;
		$this->registry->template->utility_email= $ut->utility_email;
		$this->registry->template->utility_phone= $ut->utility_phone;
		$this->registry->template->utility_postal= $ut->utility_postal;
		$this->registry->template->utility_address= $ut->utility_address;
	}
	
	public function editAction(){
		try{
			$this->registry->template->_page_title = 'Edit Utility';
			if(isset($this->registry->router->args['_POST']['utility_edit'])){
				$p = $this->registry->router->args['_POST'];
				$ut = new utility($p['utility_edit']);
				$ut->utility_name= $p['utility_name'];
				$ut->utility_website= $p['utility_website'];
				$ut->utility_email= $p['utility_email'];
				$ut->utility_phone= $p['utility_phone'];
				$ut->utility_postal= $p['utility_postal'];
				$ut->utility_address= $p['utility_address'];
				$ut->save();
				$this->listAction();
			}else if(isset($this->registry->router->args['_PATH'][3])){
				$this->load_utility_data($this->registry->router->args['_PATH'][3]);
				$this->registry->template->show('admin/utility_edit');
			}else{
				throw new Exception('Bad URL. Cannot edit utility');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
	
	public function enableAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$ut = new utility($this->registry->router->args['_PATH'][3]);
				$ut->enable(true);
				$this->listAction();
			}else{
				throw new Exception('Bad URL. Cannot enable utility');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
	
	public function disableAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][3])){
				$ut = new utility($this->registry->router->args['_PATH'][3]);
				$ut->enable(false);
				$this->listAction();
			}else{
				throw new Exception('Bad URL. Cannot disable utility');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
	
	public function showAction(){
		try{
			$this->registry->template->_page_title = 'Utility Detail';
			if(isset($this->registry->router->args['_PATH'][3])){
				$this->load_utility_data($this->registry->router->args['_PATH'][3]);
				$this->registry->template->show('admin/utility_show');
			}else{
				throw new Exception('Bad URL. Cannot show utility detail');
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->listAction();
		}
	}
}