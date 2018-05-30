<?php
Class Template {
	private $registry; /* ref to reg object */

	/* contains the dynamic properties, using the magic functions __get and __set */
	private $vars = array();
	
	private $template_dir=''; /* wll store name of chosen template dir */

	/* access to registry required to obtain template path */
	public function __construct($registry) {
		$this->registry = $registry;
		$this->template_dir = $registry->site_configs['template']['template_directory'];
	}

	/* magic finction for setting dynamic properties into template class */
	public function __set($index, $value){
		$this->vars[$index] = $value;
	}
	
	/* get data item from $vars array	*/
	public function __get($key){
		return $this->vars[$key];
	}

	/* loads view files, loading variables from set as "dynamic properties" into it into it */
	public function show($name) {
		$path = __SITE_PATH . '/views' . '/' .$this->template_dir.'/'. $name . '.php';

		if (file_exists($path) == false){
			throw new Exception('Template not found in '. $path);
			return false;
		}
		
		/* Load variables into html view files */
		foreach ($this->vars as $key => $value){
			$$key = $value;
		}
		
		include ($path);               
	}
}
