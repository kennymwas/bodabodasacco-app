<?php
class physicalAddress extends db{
	public $id=null;
	public $member_id=null;
	public $front_name=null;
	public $detail=null; 
	public $city=null; 
	public $country_id=null;
	public $country_name=null;
	public $data_public=1;
	
	public function __construct($id='', $mem_id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'phyAddress inner join country_list on country_list.country_id = phyAddress.country_id';
			$field_array = array('phyAddress_id', 'member_id', 'phyAddress_front_name', 'phyAddress_city', 'phyAddress.country_id', 'country_name', 'phyAddress_detail', 'public');
			if(empty($mem_id)){
				$cl = array('phyAddress_id' => $id);
			}else{
				$cl = array('phyAddress_id' => $id, 'member_id' => $mem_id);
			}
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Physical Address ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id=$mbr[0]['phyAddress_id'];
				$this->member_id=$mbr[0]['member_id'];
				$this->front_name=$mbr[0]['phyAddress_front_name'];
				$this->detail=$mbr[0]['phyAddress_detail'];
				$this->city=$mbr[0]['phyAddress_city'];
				$this->country_id=$mbr[0]['country_id'];
				$this->country_name=$mbr[0]['country_name'];
				$this->data_public=$mbr[0]['public'];
			}
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('phyAddress', 
				array('member_id' => $this->member_id, 
					'phyAddress_front_name' => $this->front_name, 
					'phyAddress_detail' => $this->detail,
					'country_id' => $this->country_id,
					'phyAddress_city' => $this->city,
					'public' => $this->data_public
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('phyAddress', 
						array('member_id' => $this->member_id,
							'phyAddress_front_name' => $this->front_name, 
							'phyAddress_detail' => $this->detail,
							'country_id' => $this->country_id,
							'phyAddress_city' => $this->city,
							'public' => $this->data_public
						),
						array('phyAddress_id' => $this->id));
		}
		$this->refresh_values();
	}
	
	private function refresh_values(){
		if(empty($this->id)) throw new Exception('Physical Address ID required to retrieve database data');
		$table = 'phyAddress inner join country_list on country_list.country_id = phyAddress.country_id';
		$field_array = array('phyAddress_id', 'member_id', 'phyAddress_front_name', 'phyAddress_city', 'phyAddress.country_id', 'country_name', 'phyAddress_detail', 'public');
		$cl = array('phyAddress_id' => $this->id);
		$mbr = $this->dbSelect_where($table, $field_array, $cl);
		if(empty($mbr)){
			throw new Exception('Invalid Physical Address ID supplied. ID not found in database. Record deleted?');
		}else{
			$this->id=$mbr[0]['phyAddress_id'];
			$this->member_id=$mbr[0]['member_id'];
			$this->front_name=$mbr[0]['phyAddress_front_name'];
			$this->detail=$mbr[0]['phyAddress_detail'];
			$this->city=$mbr[0]['phyAddress_city'];
			$this->country_id=$mbr[0]['country_id'];
			$this->country_name=$mbr[0]['country_name'];
			$this->data_public=$mbr[0]['public'];
		}
	}
	
	public function delete_me($id){
		if(!empty($id)){
			$this->dbDelete('phyAddress',array('phyAddress_id' => $id));
		}else{
			throw new Exception('Physical address data not loaded. Delete cannot execute');
		}
	}
	
	public function get_physicalAddress_data_array($id){
		if(!empty($id)){
			$table = 'phyAddress inner join country_list on country_list.country_id = phyAddress.country_id';
			$field_array = array('phyAddress_id', 'member_id', 'phyAddress_front_name', 'phyAddress_city', 'phyAddress.country_id', 'country_name', 'phyAddress_detail', 'public');
			$mbr = $this->dbSelect_where($table, $field_array, array('member_id' => $id));
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Member ID required to retrieve physical address data');
		}
	}
}