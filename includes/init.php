<?php
/*** include the registry class ***/
include __SITE_PATH . '/application/' . 'registry.class.php';

/* create registry object */
$registry = new registry();

/* include the base controller class */
include __SITE_PATH . '/application/' . 'base_controller.class.php';

/* include the base admin controller class */
include __SITE_PATH . '/application/' . 'admin_base_controller.class.php';

/* include the PDO class */
include __SITE_PATH . '/application/' . 'pdo_db.class.php';

/* include the router class */
include __SITE_PATH . '/application/' . 'router.class.php';

/* include the template class */
include __SITE_PATH . '/application/' . 'template.class.php';

/* auto-load function for the model-classes */
function __autoload($class_name) {
	$filename = strtolower($class_name) . '.class.php'; // model-classes named following convention: "model_name.class.php"
	$file = __SITE_PATH . '/model/' . $filename;
	if (file_exists($file) == false){
		return false;
	}
	include ($file);
}

/* create database-connection object, save in registry */
pdo_db::set_registry($registry);
$registry->db = pdo_db::getInstance();

/* place site_configs in registry */
$registry->sacco_configs = new sacco_configs();

?>