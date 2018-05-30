<?php
class kin extends db{
	public $id=null;
	public $member_id=null;
	public $relation=null;
	public $name=null;
	public $phone=null;
	public $address=null;
	
	public function __construct($id='', $mem_id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'kin';
			$field_array = array('kin_id', 'member_id', 'kin_relation', 'kin_name', 'kin_phone', 'kin_address');
			if(empty($mem_id)){
				$cl = array('kin_id' => $id);
			}else{
				$cl = array('kin_id' => $id, 'member_id' => $mem_id);
			}
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Kin ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id=$mbr[0]['kin_id'];
				$this->member_id=$mbr[0]['member_id'];
				$this->relation=$mbr[0]['kin_relation'];
				$this->name=$mbr[0]['kin_name'];
				$this->phone=$mbr[0]['kin_phone'];
				$this->address=$mbr[0]['kin_address'];
			}
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('kin', 
				array('member_id' => $this->member_id, 
					'kin_relation' => $this->relation, 
					'kin_name' => $this->name,
					'kin_phone' => $this->phone,
					'kin_address' => $this->address
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('kin', 
				array('kin_relation' => $this->relation, 
					'kin_name' => $this->name,
					'kin_phone' => $this->phone,
					'kin_address' => $this->address
				),
				array('kin_id' => $this->id), 'and', '1');
		}	
	}
	
	public function delete_me($id){
		if(!empty($id)){
			$this->dbDelete('kin',array('kin_id' => $id));
		}else{
			throw new Exception('Kin data not loaded. Delete cannot execute');
		}
	}
	
	public function get_kin_data_array($id){
		if(!empty($id)){
			$mbr = $this->dbSelect_where('kin', '*', array('member_id' => $id));
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Member ID required to retrieve kin data');
		}
	}
}