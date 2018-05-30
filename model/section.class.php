<?php
class section extends db{
	public $page_content_meta_desc = '';
	public $page_creation_time = '';
	
	public $page_data_title = '';
	private $page_data_url_title = '';
	
	public $page_section_title = '';
	public $page_section_url_title = '';
	
	public $page_content_detail = '';
	public $page_section_side_section_title = '';
	public $page_section_side_section_data = '';
	public $user_front_name = '';
	
	public $error = 0;
	public $error_type = '';
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_section_list_array(){
		return $this->dbSelect('page_section', array('page_section_id','page_section_title'));
	}
}