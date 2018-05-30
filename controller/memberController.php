<?php
Class memberController Extends base_controller{
	
	public function indexAction() {
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/');
		}else{
			$this->infoAction();
		}
	}
	
	public function pdfAction(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			return 0;
		}
		try{
			$member = new member($_SESSION['log']['id']);
			
			$header=array('Member Data', 'Detail');
					
			$pdf=new FPDF();
			
			$pdf->SetFont('Arial','B',16);
			$pdf->AddPage();
			$pdf->Cell(180,10,'BodaBoda Sacco',0,1,'C');
			$pdf->Ln();
			$pdf->Cell(180,10,'MEMBER STATEMENT',0,1,'C');
			
			$pdf->SetFont('Arial','',14);
			
			//Colors, line width and bold font
			$pdf->SetFillColor(187,26,24);
			$pdf->SetTextColor(255);
			$pdf->SetDrawColor(128,0,0);
			$pdf->SetLineWidth(.3);
			$pdf->SetFont('','B', 14);
			//Header
			$w=array(70,110);
			for($i=0;$i<count($header);$i++)
				$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$pdf->Ln();
			//Color and font restoration
			$pdf->SetFillColor(224,235,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
			//Data
			$fill=false;
			$c = 1;
			$sc = $this->registry->template->site_currency;
			$total_sum = 0;
			$pdf->Cell($w[0],6,"DATE",'LR',0,'L',$fill);
			$pdf->Cell($w[1],6, date("l, j-F Y; H:i:s"),'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			$pdf->Cell($w[0],6,'Member Name','LR',0,'L',$fill);
			$pdf->Cell($w[1],6, strtoupper($member->name),'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			$pdf->Cell($w[0],6,'National ID','LR',0,'L',$fill);
			$pdf->Cell($w[1],6, $member->nat_id,'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			$pdf->Cell($w[0],6,'Employee ID','LR',0,'L',$fill);
			$pdf->Cell($w[1],6, $member->work_id,'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			$pdf->Cell($w[0],6,'Registartion Date','LR',0,'L',$fill);
			$pdf->Cell($w[1],6, $member->reg_date,'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			$pdf->Cell($w[0],6,'Savings Account Balance','LR',0,'L',$fill);
			$pdf->Cell($w[1],6, $sc.$this->registry->template->_fund_balance,'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			$pdf->Cell($w[0],6,'Share Account Balance','LR',0,'L',$fill);
			$pdf->Cell($w[1],6, $this->registry->template->_share_balance,'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			$pdf->Cell($w[0],6,'Share Account Value','LR',0,'L',$fill);
			$pdf->Cell($w[1],6, $sc.$this->registry->template->_share_value,'LR',0,'L',$fill);
			$pdf->Ln();
			$fill=!$fill;
			
			$pdf->Cell(array_sum($w),0,'','T');
			
			$pdf->Output();
		}catch(Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->infoAction();
		}
	}
	
	public function infoAction(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			return 0;
		}
		try{		
		$member = new member($_SESSION['log']['id']);
		$mem_data = new entityData($member->id);
		$this->registry->template->member_name = $member->name;
		$this->registry->template->session_time = $member->session_time;
		$this->registry->template->last_successful_login = date("l, j-F Y; H:i:s", strtotime($_SESSION['log']['last_login_time']));
		$this->registry->template->last_web_activity = date("l, j-F Y; H:i:s", strtotime($member->last_activity));
		$this->registry->template->fund_balance = $member->get_fund_account()->get_account_bal();
		$this->registry->template->share_balance = $member->get_share_account()->get_account_bal();
		$this->registry->template->phone_count = $mem_data->get_entity_count('phone');
		$this->registry->template->phyAddress_count = $mem_data->get_entity_count('phyAddress');
		$this->registry->template->postal_count = $mem_data->get_entity_count('postal');
		$this->registry->template->email_count = $mem_data->get_entity_count('email');
		$this->registry->template->kin_count = $mem_data->get_entity_count('kin');
		$this->registry->template->utility_count = $mem_data->get_entity_count('utility_member');
		$this->registry->template->minimum_inactivity_time = $this->registry->sacco_configs->minimum_inactivity_time;
		$this->registry->template->maximum_inactivity_time = $this->registry->sacco_configs->maximum_inactivity_time;
		
		$lst_trans= $mem_data->fetch_trans_data($member->fund_transaction_id);
		$lst_trans_sh= $mem_data->fetch_trans_data_sh($member->share_transaction_id);
		$lst_trans_sh_sale= $mem_data->fetch_trans_data_sh_sale($member->share_sale_id);
		
		if(!empty($lst_trans_sh)){
			$this->registry->template->last_trans_amount_sh = $lst_trans_sh['share_transaction_amount'];
			$this->registry->template->last_trans_share_info = "[Requested: ".$lst_trans_sh['share_transaction_request_date']."]<br/>[Approved: ".$lst_trans_sh['share_transaction_approved_date']."]";
		}else{
			$this->registry->template->last_trans_amount_sh = "N/A";
			$this->registry->template->last_trans_share_info="";
		}
		
		if(!empty($lst_trans_sh_sale)){
			$this->registry->template->last_trans_amount_sh_sale = $lst_trans_sh_sale['share_transaction_amount'];
			$this->registry->template->last_trans_share_sale_info = "[Requested: ".$lst_trans_sh_sale['share_transaction_request_date']."]<br/>[Approved: ".$lst_trans_sh_sale['share_transaction_approved_date']."]";
		}else{
			$this->registry->template->last_trans_amount_sh_sale = "N/A";
			$this->registry->template->last_trans_share_sale_info="";
		}
		
		if(!empty($lst_trans)){
			$this->registry->template->last_trans_amount = $lst_trans['fund_transaction_amount'];
			$this->registry->template->last_trans_date = '<br/>['.$lst_trans['fund_transaction_date'].']';
		}else{
			$this->registry->template->last_trans_amount = "N/A";
			$this->registry->template->last_trans_date = "";
		}
		
		$this->registry->template->show('member_info');
		}catch (Exception $e){
			//throw $e;exit;
			if(isset($_SESSION['log'])){
				unset($_SESSION['log']);
			}
			$this->registry->template->error_msg = $e->getMessage();
			$this->registry->template->show('member_error_page');
		} 
	}
	
	public function loginAction(){
		try{
			if(isset($this->registry->router->args['_PATH'][2])){
				if($this->registry->router->args['_PATH'][2]=='1'){
					$this->registry->template->error_msg='You need to be logged in first to view that page';
				}else if($this->registry->router->args['_PATH'][2]=='2'){
					$this->registry->template->error_msg='You were automatically logged-off because of a session time-out';
				}
			}
			if(isset($this->registry->router->args['_POST']['user_email']) && isset($this->registry->router->args['_POST']['user_pass'])){
				if($this->registry->router->args['_POST']['user_email'] == '' || $this->registry->router->args['_POST']['user_pass']==''){
					$this->registry->template->_page_title = 'Member Login';
					$this->registry->template->error_msg= 'Error: Entries required for both member email and password';
					$this->registry->template->show('member_login');
				}else{
					$mem =  new member();
					$mem->load_by_emailPass($this->registry->router->args['_POST']['user_email'],$this->registry->router->args['_POST']['user_pass']);
					$_SESSION['log']['last_login_time'] = $mem->last_login;
					$mem->set_last_login();
					$mem->set_last_activity();
					$_SESSION['log']['type']= 'member';
					$_SESSION['log']['id'] = $mem->id;
					$_SESSION['log']['member_name'] = $mem->name;
					$this->header_redirect('member/info');
				}
			}else if(!isset($_SESSION['log'])){
				$this->registry->template->_page_title = 'Member Login';
				$this->registry->template->info_msg = 'TIP: You can login to your member account using any of your email addresses with your single password';
				$this->registry->template->show('member_login'); 
			}else{
				$this->header_redirect('member/info');
			}
		}catch (Exception $err){
			$this->registry->template->_page_title = 'Member Login';
			$this->registry->template->error_msg= $err->getMessage();
			$this->registry->template->show('member_login');
		}
	}

	//forgot password method
	public function forgotpasswordAction(){
	   	 if(isset($this->registry->router->args['_POST']['emp_id'])) {
	   	 	if (!empty($this->registry->router->args['_POST']['emp_id'])) {
	   	 		
	   	 		$checkemp_id = new entityData('-1');

	   	 		if(!$checkemp_id->check_employee_id($this->registry->router->args['_POST']['emp_id'])){
					$this->registry->template->_page_title = 'Forgot Password';
					$this->registry->template->error_msg = 'That membership ID does not exists in our system';
					$this->registry->template->show('forgotpassword');
					exit;
				}else if(!is_numeric($this->registry->router->args['_POST']['emp_id'])){
					
					$this->registry->template->_page_title = 'Forgot Password';
					$this->registry->template->error_msg = 'Invalid Membership id entry';
					$this->registry->template->show('forgotpassword');
					
				
				}else if(!$checkemp_id->check_employee_id($this->registry->router->args['_POST']['emp_id'])){

					$this->registry->template->_page_title = 'Forgot Password';
					$this->registry->template->error_msg = 'Invalid membership id';
					$this->registry->template->show('forgotpassword');
					
				}else{

					$mem =  new member();
					$mem->name;
					$mem->load_by_work_id($this->registry->router->args['_POST']['emp_id']);
					$this->registry->template->info_msg = 'Password link sent to your email successful';
					$this->registry->template->show('member_forgot_pass_info');


				}
	   	 	}else{
	   	 		$this->registry->template->_page_title = 'Forgot Password';
				$this->registry->template->error_msg = 'Membership ID is required';
				$this->registry->template->show('forgotpassword');
	   	 	}
   	    }else{
   	    	$this->registry->template->_page_title = 'Forgot password';
			$this->registry->template->info_msg = 'You can reset your password by entering your Membership ID';
			$this->registry->template->show('forgotpassword'); 
   	    }
				
	   
	}
	/*changing password after sending email link*/
	public function resetPasswordAction(){


		if(isset($this->registry->router->args['_POST']['member_password_change'])){
           if (!empty($this->registry->router->args['_POST']['password']) && !empty($this->registry->router->args['_POST']['c_password'])){
		         if(strlen($this->registry->router->args['_POST']['password'])<6 || strlen($this->registry->router->args['_POST']['c_password'])<6){
					$this->registry->template->_page_title = 'Reset Password';
					$this->registry->template->error_msg = 'Password should be atleast 6 characters long';
					$this->registry->template->show('forgot_pass_email_login');
					exit;
				}else if(($this->registry->router->args['_POST']['password']) !== ($this->registry->router->args['_POST']['c_password'])){
					$this->registry->template->_page_title = 'Reset Password';
					$this->registry->template->error_msg = 'Password does not match';
					$this->registry->template->show('forgot_pass_email_login');
					exit;
				}else if(($this->registry->router->args['_POST']['old_password']) == ($this->registry->router->args['_POST']['password'])){
                    $this->registry->template->_page_title = 'Reset Password';
					$this->registry->template->error_msg = 'New password must be different from the old password';
					$this->registry->template->show('forgot_pass_email_login');
					exit;
				}else{

                    $member = new member();
                    $resetPass = $this->registry->router->args['_POST'];
				    $member->set_password_link($resetPass['old_password'],$resetPass['password']);
				    $this->registry->template->_page_title = 'Password updated';
				    $this->registry->template->info_msg = 'Password data update was successful';
				    $this->registry->template->show('password_reset_success'); 
			        
				}

            }else{

            	$this->registry->template->_page_title = 'Reset Password';
				$this->registry->template->error_msg = 'All fields are required';
				$this->registry->template->show('forgot_pass_email_login');

            }
           

		}else{
		 $this->registry->template->_page_title = 'Reset Password';
		 $this->registry->template->info_msg = 'Please Fill All The Fields Correctly Inorder To Update Your Password';
		 $this->registry->template->show('forgot_pass_email_login'); 
		}
		 
		
	}
	
	public function session_timeAction(){
		$this->registry->template->_page_title = 'Session-Time';
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			return 0;
		}		
		try{
			if(isset($this->registry->router->args['_POST']['session_time'])){
				$sess_time = $this->registry->router->args['_POST']['session_time'];
				$member = new member($_SESSION['log']['id']);
				if(!is_numeric($sess_time)) throw new Exception('Invalid value supplied');
				if($sess_time>$this->registry->sacco_configs->maximum_inactivity_time || $sess_time<$this->registry->sacco_configs->minimum_inactivity_time) throw new Exception('Supplied value is outside acceptable range');
				$member->set_session_time($sess_time);
				$this->registry->template->info_msg = 'Session time update was successful';
				$this->infoAction();
			}else{
				$this->registry->template->show('session_time');
			}
		}catch (Exception $err){
			$this->registry->template->error_msg = $e->getMessage();
			$this->registry->template->show('session_time');
		}
	}
	
	public function logoutAction(){
		unset($_SESSION['log']);
		$this->header_redirect('member/login');
	}
	
	public function account_infoAction(){
		if(!isset($_SESSION['log'])){
			$this->header_redirect('member/login/1');
			return 0;
		}		$this->registry->template->_page_title = 'Account Info';
		try{
			$member = new member($_SESSION['log']['id']);
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->name = $member->name;
				$this->registry->template->nat_id = $member->nat_id;
				$this->registry->template->emp_id = $member->work_id;
				$this->registry->template->show('account_info');
			}else if(isset($this->registry->router->args['_POST']['member_data'])){
				$p = $this->registry->router->args['_POST'];
				$member->name = $p['name'];
				$member->nat_id = $p['nat_id'];
				$member->work_id = $p['emp_id'];
				$member->save();
				$this->registry->template->info_msg = 'Member data update was successful';
				$this->infoAction();
			}else if(isset($this->registry->router->args['_POST']['pass_data'])){
				$p = $this->registry->router->args['_POST'];
				if($member->check_pass($p['current_pass'])==false){
					throw new Exception('Invalid password supplied');
				}else if($p['pass'] != $p['c_pass']){
					throw new Exception('Your new password doesn\'t match your confirmation password');
				}
				$member->set_pass($p['pass']);
				$this->registry->template->info_msg = 'Password data update was successful';
				$this->infoAction();
			}else{
				$this->registry->template->error_msg = 'Invalid POST data in request';
				$this->infoAction();
			}
		}catch (Exception $err){
			$this->registry->template->error_msg = $err->getMessage();
			$this->infoAction();
		}
	}
	
	public function registerAction(){
		$this->registry->template->name = '';
		$this->registry->template->nat_id = '';
		$this->registry->template->phone = '';
		$this->registry->template->emp_id = '';
		$this->registry->template->email = '';
		//echo $this->registry->router->args['_POST']['member_registration'];
		if(isset($this->registry->router->args['_POST']['member_registration'])){
			if(!empty($this->registry->router->args['_POST']['name']) 
				&& !empty($this->registry->router->args['_POST']['nat_id'])
				&& !empty($this->registry->router->args['_POST']['phone'])
				&& !empty($this->registry->router->args['_POST']['emp_id'])
				&& !empty($this->registry->router->args['_POST']['email'])
				&& !empty($this->registry->router->args['_POST']['pass'])
				&& !empty($this->registry->router->args['_POST']['c_pass'])
			){
				$this->registry->template->name = $this->registry->router->args['_POST']['name'];
				$this->registry->template->nat_id = $this->registry->router->args['_POST']['nat_id'];
				$this->registry->template->phone = $this->registry->router->args['_POST']['phone'];
				$this->registry->template->emp_id = $this->registry->router->args['_POST']['emp_id'];
				$this->registry->template->email = $this->registry->router->args['_POST']['email'];
			
				if(!is_numeric($this->registry->router->args['_POST']['phone'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'Please use a valid phone number!';
					$this->registry->template->show('member_register');
					exit;
				}
				
				if(!is_numeric($this->registry->router->args['_POST']['nat_id'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'Invalid national id entry';
					$this->registry->template->show('member_register');
					exit;
				}
				
				if(!is_numeric($this->registry->router->args['_POST']['emp_id'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'Invalid Member id entry';
					$this->registry->template->show('member_register');
					exit;
				}
				
				$name_len = strlen($this->registry->router->args['_POST']['name']);
				for($i=0; $i<$name_len; $i++){
					if(is_numeric(substr($this->registry->router->args['_POST']['name'], $i,1))){
						$this->registry->template->_page_title = 'Member Registration';
						$this->registry->template->error_msg = 'Please suppply your real name';
						$this->registry->template->show('member_register');
						exit;
					}

				}
				
				if(empty($this->registry->router->args['_POST']['name'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'Please supply your valid name';
					$this->registry->template->show('member_register');
					exit;
				}
				
				if(filter_var($this->registry->router->args['_POST']['email'], FILTER_VALIDATE_EMAIL) == false){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'Invalid email entry';
					$this->registry->template->show('member_register');
					exit;
				}
				
				$ent = new entityData('-1');
				
				if($ent->check_national_id($this->registry->router->args['_POST']['nat_id'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'That national ID entry is already in use';
					$this->registry->template->show('member_register');
					exit;
				}
				
				if($ent->check_employee_id($this->registry->router->args['_POST']['emp_id'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'That Member ID is already in use';
					$this->registry->template->show('member_register');
					exit;
				}
				
				if($ent->check_phone($this->registry->router->args['_POST']['phone'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'That phone contact is already in use';
					$this->registry->template->show('member_register');
					exit;
				}
				
				if($ent->check_email($this->registry->router->args['_POST']['email'])){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'That email contact is already in use';
					$this->registry->template->show('member_register');
					exit;
				}
				
				if(strlen($this->registry->router->args['_POST']['pass'])<6){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'Password should be atleast 6 characters long';
					$this->registry->template->show('member_register');
					exit;
				}

				if(strlen($this->registry->router->args['_POST']['phone'])<10 || strlen($this->registry->router->args['_POST']['phone'])>10){
					$this->registry->template->_page_title = 'Member Registration';
					$this->registry->template->error_msg = 'Please use a valid phone number';
					$this->registry->template->show('member_register');
					exit;
				}
				
				$member = new member();
				$member->name = $this->registry->router->args['_POST']['name'];
				$member->nat_id = $this->registry->router->args['_POST']['nat_id'];
				$member->work_id = $this->registry->router->args['_POST']['emp_id'];
				$member->password = $this->registry->router->args['_POST']['pass'];
				$member->active = 0;
				$member->save();
				
				
				$member->set_last_login();
				$member->set_last_activity();
				
				$phone = new phone();
				$phone->front_name = 'Primary Phone';
				$phone->member_id = $member->id;
				$phone->detail = $this->registry->router->args['_POST']['phone'];
				$phone->save();
				
				$email = new email();
				$email->front_name = 'Primary Email';
				$email->member_id = $member->id;
				$email->detail = $this->registry->router->args['_POST']['email'];
				$email->save();
				
				// $_SESSION['log']['type']= 'member';
				// $_SESSION['log']['id'] = $member->id;
				// $_SESSION['log']['last_login_time'] = $member->last_login;
				// $_SESSION['log']['member_name'] = $member->name;
				
				// $this->header_redirect('member/info');
				
				$this->registry->template->show('member_reg_info');
				
			}else{
				$this->registry->template->_page_title = 'Member Registration';
				$this->registry->template->error_msg = 'Entries are required for all the text-fields';
				$this->registry->template->show('member_register');
			}
		}else{
			$this->registry->template->_page_title = 'Member Registration';
			$this->registry->template->info_msg = 'Registration is free an open for all';
			$this->registry->template->show('member_register'); 
		}
	}
	
	public function page_load(){
		//echo $name;
		//print_r($this->registry->router->args['_PATH']);
		$page = new page();
		$page->run_page_load();
		//exit;
		if($page->error==0){
			$this->registry->template->page_content_meta_desc = $page->page_content_meta_desc;
			$this->registry->template->page_creation_time = $page->page_creation_time;
			$this->registry->template->page_data_title = $page->page_data_title;
			$this->registry->template->page_content_detail = $page->page_content_detail;
			$this->registry->template->page_section_title = $page->page_section_title;
			$this->registry->template->page_section_side_section_title = $page->page_section_side_section_title;
			$this->registry->template->page_section_side_section_data = $page->page_section_side_section_data;
			$this->registry->template->user_front_name = $page->user_front_name;
			$this->registry->template->show('page');
		}else{
			echo $page->error_type;
		}
		
    }
	
	public function errorAction() {
		echo "bad url";
	}	
}