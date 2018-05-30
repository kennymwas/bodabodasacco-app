<?php
class member_query extends db_auto{
	public function __construct($id=''){
		if(empty($id)){
			parent::__construct();
			$this->load_structure('member_query');
		}else{
			parent::__construct(array('member_query_id' => $id), 'member_query', '*');
		}
	}
	
	public function mark_read_value($bool_val){
		if(!empty($this->table_name)){
			$this->dbUpdate($this->table_name, array('member_query_read' => $bool_val), $this->condition_array);
		}else{
			throw new Exception('Table-data not yet initialized. Cannot persist new read-value.');
		}
	}
	
	public function get_listing_rows_in_array($limit){
		return $this->dbSelect($this->table_name, array('member_query_id', 'member_id', 'member_query_name', 'member_query_email', 'substr(member_query_msg, 1, 12) as member_query_msg', 'member_query_time', 'member_query_read'), $limit);
	}
	
}