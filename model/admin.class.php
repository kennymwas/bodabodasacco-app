<?php
class admin extends db{
	public $user_id=null;
	public $admin_login="";
	public $admin_name="";
	public $admin_pass="";
	
	public function __construct($id=''){
		parent::__construct();
		if(!empty($id)){
			$this->load_by_id($id);
		}
	}
	
	public function load_by_emailPass($email,$pass){
		if(empty($email) || empty($pass)){
			throw new Exception('Invalid login data supplied. Please specify the email and password correctly');
		}
		$table = 'admin_users';
		$mbr = $this->dbSelect_where($table, '*', array('admin_login' => $email, 'admin_pass' => md5($pass)));
		if(empty($mbr)){
			throw new Exception('Invalid username or password');
		}else{
			$this->user_id=$mbr[0]['user_id'];
			$this->admin_login=$mbr[0]['admin_login'];
			$this->admin_name=$mbr[0]['admin_name'];
		}
	}
	
	private function load_by_id($id){
		$table = 'admin_users';
		$mbr = $this->dbSelect_where($table, '*', array('user_id' => $id));
		if(empty($mbr)){
			throw new Exception('Invalid ID supplied. User data not found in database. Record deleted??');
		}else{
			$this->user_id=$mbr[0]['user_id'];
			$this->admin_login=$mbr[0]['admin_login'];
			$this->admin_name=$mbr[0]['admin_name'];
			return $mbr;
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('admin_users', 
				array(
					'admin_login' => $this->admin_login,
					'admin_name' => $this->admin_name,
					'admin_pass' => md5($this->admin_pass)
					));
			$this->user_id = $inst['last_insert_id'];
		}else{
			$this->dbUpdate('admin_users', 
						array(
							'admin_login' => $this->admin_login,
							'admin_name' => $this->admin_name,
						),
						array('user_id' => $this->user_id));
		}
	}
	
	public function get_admin_list_array($limit){
		return $this->dbSelect('admin_users', '*', $limit);
	}
	
	public function set_password($pass){
		if($this->user_id==null){
			return $this->dbUpdate('admin_users', array('admin_pass' => $pass), array('user_id' => $this->user_id));
		}else{
			throw New Exception('User data not loaded');
		}
	}
	
	public function get_admin_list_count(){
		$row_count=$this->dbSelect('admin_users', array('count(*)'));
		return $row_count[0]['count(*)'];
	}
}