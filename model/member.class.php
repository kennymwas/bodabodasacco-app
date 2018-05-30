<?php
class member extends db{
	public $id=null;
	public $nat_id=null;
	public $name=null;
	public $work_id=null;
	public $password=null;
	public $share_transaction_id=null;
	public $fund_transaction_id=null;
	public $share_sale_id=null;
	public $reg_date=null;
	public $last_login=null;
	public $last_activity=null;
	public $session_time=null;
	public $active=null;
	public $member_token=null;
	
	



	
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
		$table = 'member inner join email on email.member_id = member.member_id';
		$field_array = array('member.member_id, member_work_id, member_national_id', 'share_sale_id', 'fund_transaction_id', 'share_transaction_id', 'member_name', 'member_active', 'reg_date', 'last_login', 'last_activity', 'session_time','member_password','email_detail');
		$mbr = $this->dbSelect_where($table, $field_array, array('email_detail' => $email), $where_type='and', '1');
		
		
        
            
            if(empty($mbr)){

			throw new Exception('Invalid username or password');
		    	
		    }else if($mbr[0]['member_active']=='0'){

			throw new Exception('Member Account de-activated. Please contact support for more information');
		   
		    }else{
            
					$CorrectPass = password_verify($pass,$mbr[0]['member_password']);
					

					if($CorrectPass){
		            $this->id=$mbr[0]['member_id'];
					$this->nat_id=$mbr[0]['member_national_id'];
					$this->work_id=$mbr[0]['member_work_id'];
					$this->name=$mbr[0]['member_name'];
					$this->fund_transaction_id=$mbr[0]['fund_transaction_id'];
					$this->share_sale_id=$mbr[0]['share_sale_id'];
					$this->share_transaction_id=$mbr[0]['share_transaction_id'];
					$this->reg_date=$mbr[0]['reg_date'];
					$this->last_login=$mbr[0]['last_login'];
					$this->last_activity=$mbr[0]['last_activity'];
					$this->session_time=$mbr[0]['session_time'];
					$this->active=$mbr[0]['member_active'];
					
					}else{
						throw new Exception("Password is incorrect");
						
					}

		   }
			
		
	}
	
	public function load_by_email($email){
		if(empty($email)){
			throw new Exception('Invalid email supplied');
		}
		$table = 'member inner join email on email.member_id = member.member_id';
		$field_array = array('member.member_id', 'member_work_id', 'share_sale_id', 'fund_transaction_id', 'share_transaction_id', 'member_national_id', 'member_name', 'member_active', 'reg_date', 'last_login', 'last_activity', 'session_time');
		$mbr = $this->dbSelect_where($table, $field_array, array('email_detail' => $email), $where_type='and', '1');
		if(empty($mbr)){
			throw new Exception('Member Data not found using supplied email');
		}else if($mbr[0]['member_active']=='0'){
			throw new Exception('Member Account de-activated.');
		}else{
			$this->id=$mbr[0]['member_id'];
			$this->nat_id=$mbr[0]['member_national_id'];
			$this->work_id=$mbr[0]['member_work_id'];
			$this->name=$mbr[0]['member_name'];
			$this->fund_transaction_id=$mbr[0]['fund_transaction_id'];
			$this->share_sale_id=$mbr[0]['share_sale_id'];
			$this->share_transaction_id=$mbr[0]['share_transaction_id'];
			$this->reg_date=$mbr[0]['reg_date'];
			$this->last_login=$mbr[0]['last_login'];
			$this->last_activity=$mbr[0]['last_activity'];
			$this->session_time=$mbr[0]['session_time'];
			$this->active=$mbr[0]['member_active'];
		}
	}

	/*Fogot password function*/
	public function load_by_work_id($emp_id){
		if(empty($emp_id)){
			throw new Exception('Invalid work ID supplied');
		}
		$table = 'member inner join email on email.member_id = member.member_id';
		$field_array = array('member.member_id', 'member_work_id', 'share_sale_id', 'fund_transaction_id', 'share_transaction_id', 'member_national_id', 'member_name', 'member_active', 'reg_date', 'last_login', 'last_activity', 'session_time','email_detail');
		$mbr = $this->dbSelect_where($table, $field_array, array('member_work_id' => $emp_id), $where_type='and', '1');
		if(empty($mbr)){
			throw new Exception('Member Data not found using supplied work id');
		}else if($mbr[0]['member_active']=='0'){
			throw new Exception('Member Account de-activated.');
		}else{
            
            $this->id=$mbr[0]['member_id'];
            $this->registry->template->email=$mbr[0]['email_detail'];
            $this->registry->template->name=$mbr[0]['member_name'];
            $this->work_id=$mbr[0]['member_work_id'];

            $table1 = 'member inner join phone on phone.member_id = member.member_id';
            $field_array1 = array('member.member_id', 'member_work_id', 'share_sale_id', 'fund_transaction_id', 'share_transaction_id', 'member_national_id', 'member_name', 'member_active', 'reg_date', 'last_login', 'last_activity', 'session_time','phone_detail');
            $mbr1 = $this->dbSelect_where($table1, $field_array1, array('member_work_id' => $emp_id), $where_type='and', '1');
              $this->registry->template->phone=$mbr1[0]['phone_detail'];

			//creating a random string
			$str = "0123456789abcdefghijklmnopqrstuvwxyz";
			$str = str_shuffle($str);
			$str = substr($str,0 , 10);
			$this->registry->template->member_token = $this->member_token = $str;

			if(!empty($this->id)){
			$this->dbUpdate('member', array('member_token' =>$this->member_token) , array('member_id' => $this->id), 'and', '1');
		    }
		}
	}

	public function set_password_link($old_password,$password){
        if(empty($old_password) || empty($password)){
			throw new Exception('Invalid reset data supplied. Please specify the old password and password correctly');
		}
		$table = 'member';
		$field_array = array('member.member_id, member_work_id, member_national_id', 'share_sale_id', 'fund_transaction_id', 'share_transaction_id', 'member_name', 'member_active', 'reg_date', 'last_login', 'last_activity', 'session_time','member_token');
		$mbr = $this->dbSelect_where($table, $field_array, array('member_token' => $old_password), $where_type='and', '1');
		if(empty($mbr)){
			throw new Exception('Invalid old password or password');
		}else if($mbr[0]['member_active']=='0'){
			throw new Exception('Member Account de-activated. Please contact support for more information');
		}else if($old_password == $password){
            throw new Exception('New password must be different from the old password');
		}else if($old_password !== $mbr[0]['member_token']){
			 throw new Exception('please enter the sent old password');
		}else{
			$this->id=$mbr[0]['member_id'];
			$this->nat_id=$mbr[0]['member_national_id'];
			$this->work_id=$mbr[0]['member_work_id'];
			$this->registry->template->name=$mbr[0]['member_name'];
			$this->fund_transaction_id=$mbr[0]['fund_transaction_id'];
			$this->share_sale_id=$mbr[0]['share_sale_id'];
			$this->share_transaction_id=$mbr[0]['share_transaction_id'];
			$this->reg_date=$mbr[0]['reg_date'];
			$this->last_login=$mbr[0]['last_login'];
			$this->last_activity=$mbr[0]['last_activity'];
			$this->session_time=$mbr[0]['session_time'];
			$this->active=$mbr[0]['member_active'];
			$this->member_token=$mbr[0]['member_token'];

			if(!empty($this->id)){
			$this->dbUpdate($table, array('member_password' => password_hash($password,PASSWORD_DEFAULT),'member_token' => '') , array('member_id' => $this->id), 'and', '1');

		    }

		}
	}
		 
		
      
		
	
	
	private function load_by_id($id){
		$table = 'member';
		$field_array = array('member.member_id', 'member_work_id', 'share_sale_id', 'fund_transaction_id', 'share_transaction_id', 'member_national_id', 'member_name', 'member_active', 'reg_date', 'last_login', 'last_activity', 'session_time');
		$mbr = $this->dbSelect_where($table, $field_array, array('member_id' => $id), $where_type='and', '1');
		if(empty($mbr)){
			throw new Exception('Invalid ID supplied. Member ID not found in database. Record deleted??');
		}else{
			$this->id=$mbr[0]['member_id'];
			$this->nat_id=$mbr[0]['member_national_id'];
			$this->work_id=$mbr[0]['member_work_id'];
			$this->name=$mbr[0]['member_name'];
			$this->fund_transaction_id=$mbr[0]['fund_transaction_id'];
			$this->share_sale_id=$mbr[0]['share_sale_id'];
			$this->share_transaction_id=$mbr[0]['share_transaction_id'];
			$this->reg_date=$mbr[0]['reg_date'];
			$this->last_login=$mbr[0]['last_login'];
			$this->last_activity=$mbr[0]['last_activity'];
			$this->session_time=$mbr[0]['session_time'];
			$this->active=$mbr[0]['member_active'];
			return $mbr;
		}
	}
	
	public function save(){
		if($this->id==null){
			$inst =  $this->dbInsert('member', 
				array('member_national_id' => $this->nat_id,
					'member_work_id' => $this->work_id, 
					'member_name' => $this->name, 
					'last_login' => date('Y-m-d H:i:s'),
					'last_activity' => date('Y-m-d H:i:s'),
					'session_time' => 3,
					'member_password' =>password_hash($this->password,PASSWORD_DEFAULT),
					'member_active' => '0'
				));
			$this->id = $inst['last_insert_id'];
			$this->dbInsert('share_account', array('member_id' => $this->id));
			$this->dbInsert('fund_account', array('member_id' => $this->id));
		}else{
			$this->dbUpdate('member', 
						array('member_national_id' => $this->nat_id,
							'member_work_id' => $this->work_id, 
							'member_name' => $this->name,
							'session_time' => $this->session_time,
							'member_active' => $this->active
						),
						array('member_id' => $this->id), 'and', '1');
		}
	}
	
	public function delete_me(){
		$c = array('member_id' => $this->id);
		$this->dbDelete('member', $c);
		$this->dbDelete('phone', $c);
		$this->dbDelete('email', $c);
		$this->dbDelete('kin', $c);
		$this->dbDelete('phyaddress', $c);
		$this->dbDelete('fund_account', $c);
		$this->dbDelete('share_account', $c);
	}
	
	public function set_last_login(){
		$t = date('Y-m-d H:i:s');
		if(!empty($this->id)){
			$this->dbUpdate('member', array('last_login' => date('Y-m-d H:i:s')) , array('member_id' => $this->id), 'and', '1');
		}
		$this->last_login = $t;
	}
	
	public function set_session_time($time){
		if(!empty($this->id)){
			$this->dbUpdate('member', array('session_time' => $time) , array('member_id' => $this->id), 'and', '1');
		}
	}
	
	public function set_pass($pass_text){
		if(!empty($this->id)){
			$this->dbUpdate('member', array('member_password' => password_hash($pass_text,PASSWORD_DEFAULT)) , array('member_id' => $this->id), 'and', '1');
		}
	}

	
	public function check_pass($pass_text){
		if(!empty($this->id)){
			$mbr = $this->dbSelect_where('member', array('count(*)'), array('member_id' => $this->id), 'and', '1');
			
			return $mbr[0]['count(*)'];
		}
	}
	
	public function check_login_time(){
		$ent = new entityData('-1');
		$t1 = $ent->date_diff("n", $this->last_activity, date('Y-m-d H:i:s'));
		//echo $t1;exit;
		if($t1>=$this->session_time){
			return false;
		}else{
			return true;
		}
	}
	
	public function set_last_activity(){
		if(!empty($this->id)){
			$this->dbUpdate('member', array('last_activity' => date('Y-m-d H:i:s')) , array('member_id' => $this->id), 'and', '1');
		}
	}
	
	public function get_fund_account(){
		$account = new account($this->id,'fund');
		return $account;
	}
	
	public function get_share_account(){
		$account = new account($this->id,'share');
		return $account;
	}
	
	public function get_member_list_array($limit='', $fields='*'){
		return $this->raw_select("select $fields from member order by member_id desc limit $limit");
	}
	
	public function get_member_list_count(){
		$row_count=$this->dbSelect('member', array('count(*)'));
		return $row_count[0]['count(*)'];
	}
}