<?php
class postal extends db{
	public $id=null;
	public $member_id=null;
	public $front_name=null;
	public $detail=null;
	public $postal_code=null;
	public $city=null;
	public $country_id=null;
	public $country_name=null;
	public $data_public=1;
	
	public function __construct($id='', $mem_id=''){
		parent::__construct();
		if(!empty($id)){
			$table = 'postal inner join country_list on country_list.country_id	= postal.country_id';
			$field_array = array('postal_id', 'member_id', 'postal_front_name', 'postal_detail', 'postal_code', 'postal_city', 'postal.country_id', 'country_name', 'public');
			if(empty($mem_id)){
				$cl = array('postal_id' => $id);
			}else{
				$cl = array('postal_id' => $id, 'member_id' => $mem_id);
			}
			$mbr = $this->dbSelect_where($table, $field_array, $cl);
			if(empty($mbr)){
				throw new Exception('Invalid Postal ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id=$mbr[0]['postal_id'];
				$this->member_id=$mbr[0]['member_id'];
				$this->front_name=$mbr[0]['postal_front_name'];
				$this->detail=$mbr[0]['postal_detail'];
				$this->postal_code=$mbr[0]['postal_code'];
				$this->city=$mbr[0]['postal_city'];
				$this->country_id=$mbr[0]['country_id'];
				$this->country_name=$mbr[0]['country_name'];
				$this->data_public=$mbr[0]['public'];
			}
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('postal', 
				array('member_id' => $this->member_id, 
					'postal_front_name' => $this->front_name, 
					'postal_detail' => $this->detail,
					'postal_code' => $this->postal_code,
					'postal_city' => $this->city,
					'country_id' => $this->country_id,
					'public' => $this->data_public
				));
			$this->id = $inst['last_insert_id'];
		}else{
			$this->dbUpdate('postal', 
						array('member_id' => $this->member_id,
							'postal_front_name' => $this->front_name, 
							'postal_detail' => $this->detail,
							'public' => $this->data_public
						),
						array('postal_id' => $this->id));
		}
		$this->refresh_values();
	}
	
	private function refresh_values(){
		if(empty($this->id)) throw new Exception('Postal ID required to retrieve database data');
		$table = 'postal inner join country_list on country_list.country_id	= postal.country_id';
		$field_array = array('postal_id', 'member_id', 'postal_front_name', 'postal_detail', 'postal_code', 'postal_city', 'postal.country_id', 'country_name', 'public');
		$mbr = $this->dbSelect_where($table, $field_array, array('postal_id' => $this->id));
		if(empty($mbr)){
			throw new Exception('Invalid Postal ID supplied. ID not found in database. Record deleted?');
		}else{
			$this->id=$mbr[0]['postal_id'];
			$this->member_id=$mbr[0]['member_id'];
			$this->front_name=$mbr[0]['postal_front_name'];
			$this->detail=$mbr[0]['postal_detail'];
			$this->postal_code=$mbr[0]['postal_code'];
			$this->city=$mbr[0]['postal_city'];
			$this->country_id=$mbr[0]['country_id'];
			$this->country_name=$mbr[0]['country_name'];
			$this->data_public=$mbr[0]['public'];
		}
	}
	
	public function delete_me($id){
		if(!empty($id)){
			$this->dbDelete('postal',array('postal_id' => $id));
		}else{
			throw new Exception('Postal address data not loaded. Delete cannot execute');
		}
	}
	
	public function get_postal_data_array($id){
		if(!empty($id)){
			$table = 'postal inner join country_list on country_list.country_id	= postal.country_id';
			$field_array = array('postal_id', 'member_id', 'postal_front_name', 'postal_detail', 'postal_code', 'postal_city', 'postal.country_id', 'country_name', 'public');
			$mbr = $this->dbSelect_where($table, $field_array, array('member_id' => $id));
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Member ID required to retrieve postal address data');
		}
	}
}