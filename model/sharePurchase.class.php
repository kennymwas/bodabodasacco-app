<?php
class sharePurchase extends db{
	public $id = 0;
	public $member_id = 0;
	public $share_purchase_amount = 0;
	public $share_purchase_value_per_share = 0;
	public $share_purchase_date = 0;

	public function __construct($id=''){
		parent::__construct();
		if(!empty($id)){
			$rs = $this->dbSelect_where('share_purchase', '*', array('share_purchase_id' => $id));
			if(empty($rs)){
				throw new Exception('Invalid share-purchase ID supplied. ID not found in database. Record deleted?');
			}else{
				$this->id = $rs[0]['share_purchase_id'];
				$this->member_id = $rs[0]['member_id'];
				$this->share_purchase_amount = $rs[0]['share_purchase_amount'];
				$this->share_purchase_value_per_share = $rs[0]['share_purchase_value_per_share'];
				$this->share_purchase_date = $rs[0]['share_purchase_date'];
			}
		}
	}
	
	public function delete_me(){
		if(!empty($this->id)){
			$this->dbDelete('share_purchase',array('share_purchase_id' => $this->id));
		}else{
			throw new Exception('Share-purchase data not loaded. Delete cannot execute');
		}
	}
	
	public function get_share_purchase_data_array($id){
		if(!empty($id)){
			$mbr = $this->dbSelect_where('share_purchase', '*', array('member_id' => $id));
			if(empty($mbr)){
				return array();
			}else{
				return $mbr;
			}
		}else{
			throw New Exception('Account ID required to retrieve share-purchase data');
		}
	}

	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('share_purchase', 
				array('member_id' => $this->member_id, 
					'share_purchase_amount' => $this->share_purchase_amount, 
					'share_purchase_value_per_share' => $this->share_purchase_value_per_share
				));
			$this->id = $inst['last_insert_id'];
			return $inst;
		}else{
			$this->dbUpdate('share_purchase', 
					array('share_purchase_amount' => $this->share_purchase_amount, 
					'share_purchase_value_per_share' => $this->share_purchase_value_per_share
					),
					array('share_purchase_id' => $this->id));
		}	
	}
	
}