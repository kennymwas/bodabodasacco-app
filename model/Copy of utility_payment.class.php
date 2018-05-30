<?php
class utility_payment extends db_auto{
	public function __construct($id=''){
		if(empty($id)){
			parent::__construct();
			$this->load_structure('utility_payment');
		}else{
			parent::__construct(array('utility_payment_id' => $id), 'utility_payment', '*');
		}
	}
}