<?php
class router {
	private $registry;
	private $path;//path to controller directory
	public $args = array();//arguments from URL
	public $file;//path to controller file
	public $controller;//controller name
	public $action;//controller action

	/* set controller directory path*/
	private function setControllerPath($path) {
		/*** check if path is a directory ***/
		if (is_dir($path) == false){
			throw new Exception ('Invalid controller path: `' . $path . '`');
		}
		/*** set the path ***/
		$this->path = $path;
	}
	
	public function __construct($registry, $controllerPath, $admin_controller_path) {
		$this->registry = $registry;// store ref to registry
		$this->setControllerPath($controllerPath);// set controller path
		
		/*** get the route from the url ***/
		if(!isset($_SERVER['PATH_INFO'])){ 
			$route="index";
		}else if($_SERVER['PATH_INFO']=="/" || empty($_SERVER['PATH_INFO'])){
			$route="index";
		}else{
			$route=$_SERVER['PATH_INFO'];
		}
		/* get the parts of the route */
		$request = preg_replace("|/*(.+?)/*$|", "\\1", $route);
		$parts = explode('/', $request);
		
		/* check is site has been set to in-active */
		if($registry->site_configs['site']['in_active']==1 && $parts[0]!=$registry->site_configs['site']['admin_path']){
			if(!isset($parts[1])){
				$in_active_page=file_get_contents($registry->site_configs['site']['site_url'].'views/'.$registry->site_configs['template']['template_directory'].'/'.$registry->site_configs['site']['in_active_page']);
				die($in_active_page);
			}else if($parts[1]!='css'){
				$in_active_page=file_get_contents($registry->site_configs['site']['site_url'].'views/'.$registry->site_configs['template']['template_directory'].'/'.$registry->site_configs['site']['in_active_page']);
				die($in_active_page);
			}
		}
		
		/* if going back-end, set admin_controller_path as router->path */
		if($parts[0]==$registry->site_configs['site']['admin_path']){
			$this->setControllerPath($admin_controller_path);// set admin controller path
			if(empty($parts[1])){
				$this->controller = 'index';
				$this->action = 'indexAction';
			}else{
				$this->controller = $parts[1];
				$this->action = empty($parts[2]) ? 'indexAction' : $parts[2].'Action';
			}
		}else{
			$this->setControllerPath($controllerPath);// set controller path
			$this->controller = $parts[0];
			$parts[1] = empty($parts[1]) ? 'indexAction' : $parts[1].'Action';
			$this->action = $parts[1];
			/* check is site has been set to in-active */
			if($registry->site_configs['site']['in_active']==1 && $parts[1] !='css' ){
				$in_active_page=file_get_contents($registry->site_configs['site']['site_url'].'/views/'.$registry->site_configs['template']['template_directory'].'/'.$registry->site_configs['site']['in_active_page']);
				die($in_active_page);	
			}
		}
		
		/* store all parts of the route from $_SERVER['PATH_INFO']  */
		foreach($parts as $part){
			$this->args['_PATH'][]=$part;
		}
		
		/* store all $_GET variables passed in URl */
		if($_GET) $this->args['_GET']=$_GET;
		
		/* store all $_POST variables passed in URl */
		if($_POST) $this->args['_POST']=$_POST;
		
		/* check file path to identified controller, then set the file path if OK, otherwise point it to error page */
		if (is_readable($this->path .'/'. $this->controller . 'Controller.php') == false){
			$this->file = $this->path.'/indexController.php';
			$this->controller = 'index';
			$this->action = 'page_load';
		}else{
			$this->file = $this->path .'/'. $this->controller . 'Controller.php';
		}
	}
	
	/* load the controller */
	public function start(){
		//echo $this->file."<br/>".$this->path."<br/>";
		include $this->file;//include the controller

		/* create new controller-class instance */
		$class = $this->controller . 'Controller';

		$controller = new $class($this->registry);

		/* check if the controller-action is callable */
		if (is_callable(array($controller, $this->action)) == false){
			$action = 'errorAction';
		}else{
			$action = $this->action;
		}
		//echo  $this->controller."->".$this->action;
		/* run the action */
		$controller->$action();
		$controller=null;
	}
	
	public function router_redirect($path, $method_var_array='', $method_type='post'){
		/* check path paramater */
		if($path=="/" || empty($path)){
			$route="index";
		}else{
			$route=$path;
		}
		/* get the parts of the route */
		$request = preg_replace("|/*(.+?)/*$|", "\\1", $route);
		$parts = explode('/', $request);
		$this->controller = $parts[0];
		$this->action = empty($parts[1]) ? "indexAction" : $parts[1]."Action";
		/* store all parts of the route from $_SERVER['PATH_INFO']  */
		foreach($parts as $part){
			$this->args['_PATH'][]=$part;
		}
		
		/* store all get/post variables passed to function */
		if(is_array($method_var_array)){
			if(strtolower($method_type)=='post'){
				$this->args['_GET'] = $method_var_array;
			}else if(strtolower($method_type)=='get'){
				$this->args['_POST'] = $method_var_array;
			}else if(strtolower($method_type)=='delete'){
				throw new Exception('Un-supported DELETE method type specified for method-type in page_redirect');
			}else if(strtolower($method_type)=='put'){
				throw new Exception('Un-supported PUT method type specified for method-type in page_redirect');
			}else{
				throw new Exception('Invalid method type specified for method-type in page_redirect');
			}
		}
		/* check file path to identified controller, then set the file path if OK, otherwise point it to error page */
		if (is_readable($this->path .'/'. $this->controller . 'Controller.php') == false){
			$this->file = $this->path.'/indexController.php';
			$this->controller = 'index';
			$this->action = 'page_load';
		}else{
			$this->file = $this->path .'/'. $this->controller . 'Controller.php';
		}
		
		$this->start();
	}
}