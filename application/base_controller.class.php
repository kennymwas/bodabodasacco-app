<?php

Abstract Class base_controller{

/*
 * @registry object
 */
protected $registry;

public function __construct($registry) {
	$this->registry = $registry;
}

/* all controllers must contain an index method, in the case when no action is specified in URL */
abstract function indexAction();

/* all controllers must contain an index method, in the case where invalid action is specified in URL */
abstract function errorAction();

protected function header_redirect($path){
	if(empty($path)){
		throw new Exception('Blank path supplied for page-header re-router');
	}
	header('location: '.$this->registry->site_configs['site']['base_url'].$path);
}

}