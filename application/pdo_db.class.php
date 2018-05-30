<?php
class pdo_db{
	private static $instance = NULL;/* stores PDO object reference */
	
	
	private static $registry = null;/* stores $registry reference, to retrive database configs */
	
	public static function set_registry($reg){
		self::$registry = $reg;
	}
	
	public static function get_registry(){
		return self::$registry;
	}
	
	/* constructor set to private to prevent creation of new instance using new keyword*/
	private function __construct(){}

	/* set to private to prevent cloning of existing instance */
	private function __clone(){}

	/* Return PDO object instance, else create intitial connection object, then return instance */
	public static function getInstance(){
		if (!self::$instance){
			/* new PDO syntax: PDO("mysql:host=$hostname;dbname=mysql", $username, $password); */
			self::$instance = new PDO(self::$registry->site_configs['database']['db_type'].
										':host='.self::$registry->site_configs['database']['db_hostname'].
										';dbname='.self::$registry->site_configs['database']['db_name'],
									self::$registry->site_configs['database']['db_username'],
									self::$registry->site_configs['database']['db_password']);
			self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$instance;
	}
}