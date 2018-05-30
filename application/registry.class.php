<?php
Class Registry{
	private $vars = array(); /* contains the unset variable */
	private $config_file = '\config\config.ini';

	public function __construct(){
		$this->vars['site_configs'] = parse_ini_file(__SITE_PATH.$this->config_file, true);
	}
	
	/* set to private to prevent cloning of existing instance */
	private function __clone(){}
	
	/* unset data items in $vars */
	public function __unset($name) {
		unset($this->vars[$name]);
	}
	
	/* set undefined variables into $vars */
	public function __set($key, $value){
		$this->vars[$key] = $value;
	}

	/* get data item from $vars array	*/
	public function __get($key){
		return $this->vars[$key];
	}
}