<?php	
class email extends db{
	public $id=null;
	public $member_id=null;
	public $front_name=null;
	public $detail=null;
	public $data_public=1;
	
	public function __construct($id='', $mem_id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'email';
			$field_array = array('email_id', 'member_id', 'email_front_name', 'email_detail', 'public');
			if(empty($mem_id)){
				$cl = array('email_id' => $id);
			}else{
				$cl = array('email_id' => $id, 'member_id' => $mem_id);
			}
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Email ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id=$mbr[0]['email_id'];
				$this->member_id=$mbr[0]['member_id'];
				$this->front_name=$mbr[0]['email_front_name'];
				$this->detail=$mbr[0]['email_detail'];
				$this->data_public=$mbr[0]['public'];
			}
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('email', 
				array('member_id' => $this->member_id, 
					'email_front_name' => $this->front_name, 
					'email_detail' => $this->detail,
					'public' => $this->data_public
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('email', 
						array('member_id' => $this->member_id,
							'email_front_name' => $this->front_name, 
							'email_detail' => $this->detail,
							'public' => $this->data_public
						),
						array('email_id' => $this->id));
		}	
	}
	
	public function delete_me($id){
		if(!empty($id)){
			$this->dbDelete('email',array('email_id' => $id));
		}else{
			throw new Exception('Email data not loaded. Delete cannot execute');
		}
	}
	
	public function get_email_data_array($id){
		if(!empty($id)){
			$mbr = $this->dbSelect_where('email', '*', array('member_id' => $id));
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Member ID required to retrieve email data');
		}
	}
}