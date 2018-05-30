	<?php
class utility_member extends db_auto{
	public function __construct($id='', $mem_id=''){
		if(empty($id)){
			parent::__construct();
			$this->load_structure('utility_member');
		}else{
			parent::__construct(array('utility_member_utility_id' => $id, 'utility_member_member_id' => $mem_id), 'utility_member', '*');
		}
	}
}