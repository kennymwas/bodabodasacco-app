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
	
	public function get_utility_payment_data_in_array($utility_id, $mem_id=''){
		$table = 'utility_payment inner join member on utility_payment.member_id = member.member_id inner join utility_member on utility_member.utility_member_utility_id = utility_payment.utility_id';
		if(empty($mem_id)){
			$mbr = $this->dbSelect_where($table, '*', array('utility_id' => $utility_id));
		}else{
			$mbr = $this->dbSelect_where('utility_payment', '*', array('utility_id' => $utility_id, 'member_id' => $mem_id));
		}
		if(empty($mbr)){
			return 0;
		}else{
			return $mbr;
		}
	}
	
	public function get_utility_payment_count($utility_id, $mem_id=''){
		$table = 'utility_payment inner join member on utility_payment.member_id = member.member_id inner join utility_member on utility_member.utility_member_utility_id = utility_payment.utility_id';
		if(empty($mem_id)){
			$mbr = $this->dbSelect_where($table, array('count(*)'), array('utility_id' => $utility_id));
		}else{
			$mbr = $this->dbSelect_where('utility_payment', array('count(*)'), array('utility_id' => $utility_id, 'member_id' => $mem_id));
		}
		if(empty($mbr)){
			return 0;
		}else{
			return $mbr[0]['count(*)'];
		}
	}
	
	public function get_utility_payments_total($utility_id, $mem_id=''){
		if(empty($mem_id)){
			$mbr = $this->dbSelect_where('utility_payment', array('sum(utility_payment_amount)'), array('utility_id' => $utility_id));
		}else{
			$mbr = $this->dbSelect_where('utility_payment', array('sum(utility_payment_amount)'), array('utility_id' => $utility_id, 'member_id' => $mem_id));
		}
		if(empty($mbr)){
			return 0;
		}else{
			return $mbr[0]['sum(utility_payment_amount)'];
		}
	}
}