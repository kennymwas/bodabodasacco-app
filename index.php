<?php
session_start();
date_default_timezone_set('Africa/Nairobi');

/*** error reporting on ***/
error_reporting(E_ALL);

/*** define the site path ***/
$site_path = realpath(dirname(__FILE__));
define ('__SITE_PATH', $site_path); 

/*** include the init.php file ***/
include __SITE_PATH.'/includes/init.php';

/*** load the router into registry, setting controller path ***/
$registry->router = new router($registry, __SITE_PATH . '/controller', __SITE_PATH . '/admin_controller');

/*** load up the template ***/
$registry->template = new template($registry);

/* make url data from config file more directly accessible */
$registry->base_url = $registry->site_configs['site']['base_url'];

/* make url data available to template also */
$registry->template->base_url = $registry->site_configs['site']['base_url'];
$registry->template->admin_url = $registry->site_configs['site']['base_url'].$registry->site_configs['site']['admin_path'].'/';

$registry->template->template_path = $registry->site_configs['site']['site_url'].'views/'.$registry->site_configs['template']['template_directory'].'/';
$registry->template->site_currency = $registry->site_configs['site']['site_currency'];

if($registry->site_configs['site']['in_active']==1){
	$registry->template->_site_status = '<font color=\'red\'>OFFLINE</font>';
}else{
	$registry->template->_site_status = '<font color=\'green\'>ONLINE</font>';
}

if(isset($_SESSION['log'])){
	$registry->template->logged_in = true;
	$member = new member($_SESSION['log']['id']);
	if($member->check_login_time()==false){
		unset($_SESSION['log']);
		if(!isset($_SESSION['admin_log'])){
			header('location: '.$registry->site_configs['site']['base_url'].'member/login/2');
			exit;
		}
	}
	$member->set_last_activity();
	$registry->template->_member_name = $member->name;
	$registry->template->_fund_balance = $member->get_fund_account()->get_account_bal();
	$registry->template->_share_balance = $member->get_share_account()->get_account_bal();
	$registry->template->_share_value = $registry->template->_share_balance * $registry->sacco_configs->share_value;
	$member = null;
}else{
	$registry->template->logged_in = false;
}
$registry->template->site_msg = $registry->sacco_configs->site_message;

/*** load the controller ***/
$registry->router->start();

?>
