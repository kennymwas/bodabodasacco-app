<?php
class news extends db{
	public $news_id;
	public $news_title;
	public $news_url_title;
	public $news_desc;
	public $news_date;
	public $news_content;
	
	public function __construct($news_url_title=''){
		parent::__construct();
		if(!empty($news_url_title)){
			$this->load_news($news_url_title);
		}
	}
	
	private function load_news($news_url_title){
		$clause = array('news_url_title' =>$news_url_title);
		$row_data = $this->dbSelect_where('news','*',$clause);
		if(empty($row_data)){
			throw new Exception('Error 404. News Not Found');
		}else{
			$this->news_id = $row_data[0]['news_id'];
			$this->news_title = $row_data[0]['news_title'];
			$this->news_url_title = $row_data[0]['news_url_title'];
			$this->news_desc = $row_data[0]['news_desc'];
			$this->news_date = $row_data[0]['news_date'];
			$this->news_content = $row_data[0]['news_content'];
		}
	}
	
	public function save(){
		if($this->news_id==null){
			if($this->check_news($this->news_title)) throw new Exception('A news entry by that title already exists');
			if(empty($this->news_title)) throw new Exception('News title required');
			$inst =  $this->dbInsert('news', 
							array('news_title' => $this->news_title, 
							'news_url_title' => $this->prep_url_title($this->news_title),
							'news_desc' => $this->news_desc,
							'news_date' => $this->news_date,
							'news_content' => $this->news_content)
						);
			$this->news_id = $inst['last_insert_id'];
			return $inst;
		}else{
			if(empty($this->news_title)) throw new Exception('News title required');
			$this->dbUpdate('news', 
						array('news_title' => $this->news_title, 
							'news_url_title' => $this->prep_url_title($this->news_title),
							'news_desc' => $this->news_desc,
							'news_date' => $this->news_date,
							'news_content' => $this->news_content),
						array('news_id' => $this->news_id));
		}	
	}
	
	public function add_news($news_id, $news_title, $news_desc, $news_date, $news_content){
		if($this->check_news($news_title)) throw new Exception('A news entry by that title already exists');
		if(empty($this->news_title)) throw new Exception('News title required');
		$insert_reply1 = $this->dbInsert('news', 
							array('news_title' => $news_title, 
							'news_url_title' => $this->prep_url_title($news_title),
							'news_desc' => $news_desc,
							'news_date' => $news_date,
							'news_content' => $news_content)
						);
		return $insert_reply1['row_count'];
	}
	
	public function delete_me(){
		if(!empty($this->news_id)){
			$this->dbDelete('news',array('news_id' =>$this->news_id));
		}else{
			throw new Exception('News entry data not loaded. Delete cannot execute');
		}
	}
	
	public function check_news($news_title){
		$clause = array('news_url_title' =>$this->prep_url_title($news_title));
		$row_data = $this->dbSelect_where('news',array('count(*)'),$clause);
		return $row_data[0]['count(*)'];
	}
	
	private function prep_url_title($str_title){
		return str_replace(' ','_',$str_title);
	}
	
	public function get_news_list_array($limit){
		return $this->dbSelect('news', array('substr(news_content, 1,10) as news_content', 'news_id', 'news_title', 'news_url_title', 'news_desc', 'news_date'), $limit);
	}
	
	public function get_news_list_count(){
		$row_count=$this->dbSelect('news', array('count(*)'));
		return $row_count[0]['count(*)'];
	}
}