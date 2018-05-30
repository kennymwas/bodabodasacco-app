<?php
Class sacco_configs{
	private $vars = array();

	public function __construct(){
		$db = new db();
		$configs = $db->dbSelect('site_configs', '*');
		foreach($configs as $cnfg){
			$this->vars[$cnfg['config_name']] = $cnfg['config_value'];
		}
	}

	/* get data item from $vars array	*/
	public function __get($key){
		return $this->vars[$key];
	}
}