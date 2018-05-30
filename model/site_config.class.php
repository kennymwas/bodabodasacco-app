<?php
class site_config extends db_auto{
	public function __construct($id=''){
		parent::__construct();
		$this->field_data = '*';
		$this->table_name = 'site_configs';
		$rs = $this->dbSelect($this->table_name, $this->field_data);
		if(empty($rs)){
			throw new Exception('No config dat found');
		}else{
			foreach($rs as $row){
				$this->vars[$row['config_name']] = $row['config_value'];
			}
		}
	}
	
	public function set_config($key, $val){
		$this->vars[$key] = $val;
	}
	
	public function save($limit='1'){
		if($this->is_view){
			throw new Exception('Update/Insert cannot be executed based on complex select-statements');
		}
		foreach($this->vars as $key => $val){
			$this->dbUpdate($this->table_name, array('config_value' => $val), array('config_name' => $key), 'and', '1');	
		}
	}	
}