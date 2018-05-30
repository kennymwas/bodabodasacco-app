<?php
class page extends db{
	public $page_id;
	public $page_title;
	public $page_url_title;
	public $page_desc;
	public $page_content;
	
	public function __construct($page_url_title=''){
		parent::__construct();
		if(!empty($page_url_title)){
			$this->load_page($page_url_title);
		}
	}
	
	private function load_page($page_url_title){
		$clause = array('page_url_title' =>$page_url_title);
		$row_data = $this->dbSelect_where('pages','*',$clause);
		if(empty($row_data)){
			throw new Exception('Error 404. Page Not Found');
		}else{
			$this->page_id = $row_data[0]['page_id'];
			$this->page_title = $row_data[0]['page_title'];
			$this->page_url_title = $row_data[0]['page_url_title'];
			$this->page_desc = $row_data[0]['page_desc'];
			$this->page_content = $row_data[0]['page_content'];
		}
	}
	
	public function save(){
		if($this->page_id==null){
			if($this->check_page($this->page_title)) throw new Exception('A page by that title already exists');
			if(empty($this->page_title)) throw new Exception('Page title required');
			$inst =  $this->dbInsert('pages', 
							array('page_title' => $this->page_title, 
							'page_url_title' => $this->prep_url_title($this->page_title),
							'page_desc' => $this->page_desc,
							'page_content' => $this->page_content)
						);
			$this->page_id = $inst['last_insert_id'];
			return $inst;
		}else{
			if(empty($this->page_title)) throw new Exception('Page title required');
			$this->dbUpdate('pages', 
						array('page_title' => $this->page_title, 
							'page_url_title' => $this->prep_url_title($this->page_title),
							'page_desc' => $this->page_desc,
							'page_content' => $this->page_content),
						array('page_id' => $this->page_id));
		}	
	}
	
	public function add_page($page_id, $page_title, $page_desc, $page_content){
		if($this->check_page($page_title)) throw new Exception('A page by that title already exists');
		if(empty($this->page_title)) throw new Exception('Page title required');
		$insert_reply1 = $this->dbInsert('pages', 
							array('page_title' => $page_title, 
							'page_url_title' => $this->prep_url_title($page_title),
							'page_desc' => $page_desc,
							'page_content' => $page_content)
						);
		return $insert_reply1['row_count'];
	}
	
	public function delete_me(){
		if(!empty($this->page_id)){
			$this->dbDelete('pages',array('page_id' =>$this->page_id));
		}else{
			throw new Exception('Page data not loaded. Delete cannot execute');
		}
	}
	
	public function check_page($page_title){
		$clause = array('page_url_title' =>$this->prep_url_title($page_title));
		$row_data = $this->dbSelect_where('pages',array('count(*)'),$clause);
		return $row_data[0]['count(*)'];
	}
	
	private function prep_url_title($str_title){
		return str_replace(' ','_',$str_title);
	}
	
	public function get_page_list_array($limit){
		return $this->dbSelect('pages', array('substr(page_content, 1,10) as page_content', 'page_id', 'page_title', 'page_url_title', 'page_desc'), $limit);
	}
	
	public function get_page_list_count(){
		$row_count=$this->dbSelect('pages', array('count(*)'));
		return $row_count[0]['count(*)'];
	}
}