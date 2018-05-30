<?php
class utility extends db_auto{
	public function __construct($id=''){
		if(empty($id)){
			parent::__construct();
			$this->load_structure('utility');
		}else{
			parent::__construct(array('utility_id' => $id), 'utility', '*');
		}
	}
	
	public function get_mem_utilities($mem_id){
		$tb = 'utility inner join utility_member on utility.utility_id = utility_member.utility_member_utility_id inner join member on member.member_id = utility_member.utility_member_member_id';
		return $this->dbSelect_where($tb, '*', array('utility_member_member_id' => $mem_id), '');
	}
	
	public function get_mem_utility_count($mem_id){
		$tb = 'utility inner join utility_member on utility.utility_id = utility_member.utility_member_utility_id inner join member on member.member_id = utility_member.utility_member_member_id';
		return $this->dbSelect_where($tb, array('count(*)'), array('utility_member_member_id' => $mem_id), '');
	}
	
	public function get_all_utility_data(){
		return $this->get_table_rows_in_array('' , '', '*', '');
	}
	
	public function enable($bool){
		if($this->fetch_success){
			$this->__set('utility_available', $bool);
			$this->save();
		}else{
			throw new Exception('Cannot set enabled status of utility. ');
		}
	}
}