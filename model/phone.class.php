<?php
class phone extends db{
	public $id=null;
	public $member_id=null;
	public $front_name=null;
	public $detail=null;
	public $data_public=1;
	
	public function __construct($id='', $mem_id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'phone';
			$field_array = array('phone_id', 'member_id', 'phone_front_name', 'phone_detail', 'public');
			if(empty($mem_id)){
				$cl = array('phone_id' => $id);
			}else{
				$cl = array('phone_id' => $id, 'member_id' => $mem_id);
			}
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Phone ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id=$mbr[0]['phone_id'];
				$this->member_id=$mbr[0]['member_id'];
				$this->front_name=$mbr[0]['phone_front_name'];
				$this->detail=$mbr[0]['phone_detail'];
				$this->data_public=$mbr[0]['public'];
			}
		}
	}
	
	public function delete_me($id){
		if(!empty($id)){
			$this->dbDelete('phone',array('phone_id' => $id));
		}else{
			throw new Exception('Phone data not loaded. Delete cannot execute');
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('phone', 
				array('member_id' => $this->member_id, 
					'phone_front_name' => $this->front_name, 
					'phone_detail' => $this->detail,
					'public' => '1'
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('phone', 
						array('member_id' => $this->member_id,
							'phone_front_name' => $this->front_name, 
							'phone_detail' => $this->detail,
							'public' => $this->data_public
						),
						array('phone_id' => $this->id));
		}	
	}
	
	public function get_phone_data_array($id){
		if(!empty($id)){
			$mbr = $this->dbSelect_where('phone', '*', array('member_id' => $id));
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Member ID required to retrieve phone data');
		}
	}
}