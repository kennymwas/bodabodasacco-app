<?php
class dividend_payout extends db_auto{
	public function __construct($id=''){
		if(empty($id)){
			parent::__construct();
			$this->load_structure('dividend_payout');
		}else{
			parent::__construct(array('dividend_payout_id' => $id), 'dividend_payout', '*');
		}
	}
	
	public function get_row_data(){
		return $this->get_table_rows_in_array('', '', '*', '');
	}
	
	public function get_row_count(){
		return $this->get_table_row_count();
	}
}