<?php
class entityData extends db{
	public $member_id='';
	
	public function __construct($mem_id){
		parent::__construct();
		if(empty($mem_id)){
			throw new Exception('Invalid member ID supplied');
		}
		$this->member_id = $mem_id;
	}
	
	public function check_employee_id($emp_id){
		$dt = $this->dbSelect_where('member', array('count(*)'), array('member_work_id' => $emp_id));
		return $dt[0]['count(*)'];
	}
	
	public function check_national_id($nat_id){
		$dt = $this->dbSelect_where('member', array('count(*)'), array('member_national_id' => $nat_id));
		return $dt[0]['count(*)'];
	}
	
	public function check_email($email){
		$dt = $this->dbSelect_where('email', array('count(*)'), array('email_detail' => $email));
		return $dt[0]['count(*)'];
	}
	
	public function check_phone($phone){
		$dt = $this->dbSelect_where('phone', array('count(*)'), array('phone_detail' => $phone));
		return $dt[0]['count(*)'];
	}
	
	public function get_entity_count($entity_name){
		if(!isset($this->member_id)){
			throw new Exception('Cannot retrieve count. Member ID required');
		}
		$fld = 'member_id';
		switch($entity_name){
			case 'phone':
				$table_name= 'phone';
				break;
			case 'postal':
				$table_name= 'postal';
				break;
			case 'phyAddress':
				$table_name= 'phyAddress';
				break;
			case 'email':
				$table_name= 'email';
				break;
			case 'kin':
				$table_name= 'kin';
				break;
			case 'utility_member':
				$table_name= 'utility_member';
				$fld = 'utility_member_member_id';
				break;
			default:
				throw new Exception('Unknown entity type: '.$entity_name);
		}
		$mbr = $this->dbSelect_where($table_name, array('count(*)'), array($fld => $this->member_id));
		return $mbr[0]['count(*)'];
	}
	
	public function get_entity_ids($entity_name){
		if(!isset($this->member_id)){
			throw new Exception('Cannot retrieve count. Member ID required');
		}
		switch($entity_name){
			case 'phone':
				$table_name= 'phone';
				break;
			case 'postal':
				$table_name= 'phone';
				break;
			case 'phyAddress':
				$table_name= 'phyAddress';
				break;
			case 'email':
				$table_name= 'email';
				break;
			case 'kin':
				$table_name= 'kin';
				break;
			case 'member':
				$table_name= 'member';
				break;
			default:
				throw new Exception('Unknown entity type: '.$entity_name);
		}
		$mbr = $this->dbSelect_where($table, array($table_name.'_id'), array($table_name.'_id' => $this->member_id));
		$arr = array();
		foreach($mbr as $row){
			$arr[] = $row[$table_name.'_id'];
		}
		return $arr;
	}
	
	public function get_country_listing($en=1){
		if($en==1){
			$mbr = $this->dbSelect_where('country_list', '*', array('enabled'=>1));
		}else if($en==0){
			$mbr = $this->dbSelect_where('country_list', '*', array('enabled'=>0));
		}else if($en==2){
			$mbr = $this->dbSelect('country_list', '*');
		}else{
			$mbr = $this->dbSelect_where('country_list', '*', array('enabled'=>1));
		}
		return $mbr;
	}
	
	public function set_share_val($share_val){
		if(!is_numeric($share_val)) throw new Exception ('Invalid share value supplied supplied');
		$this->dbUpdate('site_configs', array('config_value' =>$share_val), array('config_name' => 'share_value'));
	}
	
	public function update_new_share_balance($amount){
		try{
		
			if(!is_numeric($amount)) throw new Exception ('Invalid share balance supplied supplied');
			$this->db->beginTransaction();
			if($amount < 0){
				$upd_acc = 'update site_configs set config_value = config_value + '.$amount.' where config_name=\'new_share_balance\' and config_value >= '.$amount;
			}else{
				$upd_acc = 'update site_configs set config_value = config_value + '.$amount.' where config_name=\'new_share_balance\'';
			}
			$num = $this->db->exec($upd_acc);
			$this->db->commit();
			
			return $num;
		}catch(PDOException $e){
		
			$this->db->rollback();
			throw new Exception($e->getMessage());
			
		}
	}
	
	public function get_loan_total($mem_id){
		if(!empty($mem_id)){
			$mbr = $this->dbSelect_where('loan', '*', array('member_id' => $mem_id));
			if(empty($mbr)){
				return 0;
			}else{
				$loan_total = 0;
				foreach($mbr as $rec){
					$loan_total += $rec['loan_amount'];
				}
				return $loan_total;
			}
		}else{
			throw New Exception('Member ID required to retrieve loan data');
		}
	}
	
	public function get_loan_total_in_db(){
		$mbr = $this->dbSelect('loan', '*');
		if(empty($mbr)){
			return 0;
		}else{
			$loan_total = 0;
			foreach($mbr as $rec){
				$loan_total += $rec['loan_amount'];
			}
			return $loan_total;
		}
	}
	
	public function set_new_share_balance($amount){
		try{
		
			if(!is_numeric($amount)) throw new Exception ('Invalid share balance supplied supplied');
			$this->db->beginTransaction();
			$upd_acc = 'update site_configs set config_value = '.$amount.' where config_name=\'new_share_balance\'';
			$this->db->exec($upd_acc);
			$this->db->commit();
			
		}catch(PDOException $e){
		
			$this->db->rollback();
			throw new Exception($e->getMessage());
			
		}
	}
	
	public function set_last_fund_trans_id($trans_id){
		if(empty($trans_id)) throw new Exception ('Invalid transaction ID supplied');
		$this->dbUpdate('member', array('fund_transaction_id' =>$trans_id), array('member_id' => $this->member_id));
	}
	
	public function set_last_share_trans_id($trans_id){
		if(empty($trans_id)) throw new Exception ('Invalid transaction ID supplied');
		$this->dbUpdate('member', array('share_transaction_id' =>$trans_id), array('member_id' => $this->member_id));
	}
	
	public function set_last_share_sale_trans_id($trans_id){
		if(empty($trans_id)) throw new Exception ('Invalid transaction ID supplied');
		$this->dbUpdate('member', array('share_sale_id' =>$trans_id), array('member_id' => $this->member_id));
	}
	
	public function fetch_trans_data($trans_id){
		if(!is_numeric($trans_id)) throw new Exception ('Invalid fund transaction ID supplied');
		$ft = $this->dbSelect_where('fund_transaction', '*', array('fund_transaction_id'=>$trans_id));
		if(isset($ft[0])){
			return $ft[0];
		}else{
			return '0';
		}
	}
	public function fetch_trans_data_sh($trans_id){
		if(!is_numeric($trans_id)) throw new Exception ('Invalid share transaction ID supplied');
		$ft = $this->dbSelect_where('share_transaction', '*', array('share_transaction_id'=>$trans_id));
		if(isset($ft[0])){
			return $ft[0];
		}else{
			return '0';
		}
	}
	public function fetch_trans_data_sh_sale($trans_id){
		if(!is_numeric($trans_id)) throw new Exception ('Invalid share-sale transaction ID supplied');
		$ft = $this->dbSelect_where('share_sale_transaction', '*', array('share_transaction_id'=>$trans_id));
		if(isset($ft[0])){
			return $ft[0];
		}else{
			return '0';
		}
	}
	
	public function date_diff($interval, $datefrom, $dateto, $using_timestamps = false)
	{

		/*
		$interval can be:
		yyyy - Number of full years
		q - Number of full quarters
		m - Number of full months
		y - Difference between day numbers
		(eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33".
					 The datediff is "-32".)
		d - Number of full days
		w - Number of full weekdays
		ww - Number of full weeks
		h - Number of full hours
		n - Number of full minutes
		s - Number of full seconds (default)
		*/

		if (!$using_timestamps) {
			$datefrom = strtotime($datefrom, 0);
			$dateto = strtotime($dateto, 0);
		}
		$difference = $dateto - $datefrom; // Difference in seconds

		switch($interval) {
			case 'yyyy': // Number of full years
			$years_difference = floor($difference / 31536000);
			if (mktime(date("H", $datefrom),
								  date("i", $datefrom),
								  date("s", $datefrom),
								  date("n", $datefrom),
								  date("j", $datefrom),
								  date("Y", $datefrom)+$years_difference) > $dateto) {

			$years_difference--;
			}
			if (mktime(date("H", $dateto),
								  date("i", $dateto),
								  date("s", $dateto),
								  date("n", $dateto),
								  date("j", $dateto),
								  date("Y", $dateto)-($years_difference+1)) > $datefrom) {

			$years_difference++;
			}
			$datediff = $years_difference;
			break;
			
			case 'y': 
			// Difference between day numbers 
			$datediff = date("z", $dateto) - date("z", $datefrom); 
			break;
			
			case "q": // Number of full quarters
			$quarters_difference = floor($difference / 8035200);
			while (mktime(date("H", $datefrom),
									   date("i", $datefrom),
									   date("s", $datefrom),
									   date("n", $datefrom)+($quarters_difference*3),
									   date("j", $dateto),
									   date("Y", $datefrom)) < $dateto) {

			$months_difference++;
			}
			$quarters_difference--;
			$datediff = $quarters_difference;
			break;

			case "m": // Number of full months
			$months_difference = floor($difference / 2678400);
			while (mktime(date("H", $datefrom),
									   date("i", $datefrom),
									   date("s", $datefrom),
									   date("n", $datefrom)+($months_difference),
									   date("j", $dateto), date("Y", $datefrom)))
							{ // Sunday
			$days_remainder--;
			}
			if ($odd_days > 6) { // Saturday
			$days_remainder--;
			}
			$datediff = ($weeks_difference * 5) + $days_remainder;
			break;

			case "ww": // Number of full weeks
			$datediff = floor($difference / 604800);
			break;

			case "d": // Number of full hours
			$datediff = floor($difference / 86400);
			break;
			
			case "h": // Number of full hours
			$datediff = floor($difference / 3600);
			break;

			case "n": // Number of full minutes
			$datediff = floor($difference / 60);
			break;

			default: // Number of full seconds (default)
			$datediff = $difference;
			break;
		}

		return $datediff;
	}
	public function DateAdd($interval, $number, $date) {
		/*yyyy	year
		q	Quarter
		m	Month
		y	Day of year
		d	Day
		w	Weekday
		ww	Week of year
		h	Hour
		n	Minute
		s	Second*/
		$date=strtotime($date, 0);
		$date_time_array = getdate($date);
		$hours = $date_time_array['hours'];
		$minutes = $date_time_array['minutes'];
		$seconds = $date_time_array['seconds'];
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];

		switch ($interval) {
		
			case 'yyyy':
				$year+=$number;
				break;
			case 'q':
				$year+=($number*3);
				break;
			case 'm':
				$month+=$number;
				break;
			case 'y':
			case 'd':
			case 'w':
				$day+=$number;
				break;
			case 'ww':
				$day+=($number*7);
				break;
			case 'h':
				$hours+=$number;
				break;
			case 'n':
				$minutes+=$number;
				break;
			case 's':
				$seconds+=$number;
				break;            
		}
		$timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
		return date('Y-m-d H:i:s',$timestamp);
	/*	$newdate = strtotime ( '-3 day' , strtotime ( $date ) ) ;
	$newdate = date ( 'Y-m-j' , $newdate );
	echo $newdate;*/	
	}
}