<?php
Class reportsController extends admin_base_controller{
	public function indexAction() {
		$this->listAction();
	}
	
	public function share_sale_trans_feeAction(){	
		$this->registry->template->_page_title = 'REPORTS: Share-Sale Transaction Fees';
		$this->registry->template->_rep_title = 'REPORTS:<br/>Share-Sale Transaction Fees';
		$this->registry->template->trans_type = 'share_trans_sale_fee';
		try{
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->show('admin/rep_trans_fee');
			}else if(isset($this->registry->router->args['_POST']['share_trans_sale_fee'])){
				$f_date = $this->registry->router->args['_POST']['from_date'].' 00:00:00';
				$t_date = $this->registry->router->args['_POST']['to_date'].' 23:59:59';
				$db = new db();
				$data = $db->raw_select("select * from ((share_sale_trans_charges inner join share_account on share_sale_trans_charges.account_id = share_account.share_account_id) inner join member on member.member_id = share_account.member_id) where share_trans_charge_date >= '".$f_date."' and share_trans_charge_date <= '".$t_date."'");
				if(count($data)==0){
					$this->registry->template->error_msg = 'No data available for that period';
					$this->registry->template->show('admin/rep_trans_fee');
				}else{
					$header=array('#', 'ID' , 'Trans-ID' , 'Member' , 'Date', 'Fee Amount');
					
					$pdf=new FPDF();
					
					$pdf->SetFont('Arial','B',16);
					$pdf->AddPage();
					$pdf->Cell(120,10,'BodaBoda Sacco',0,1,'C');
					$pdf->Cell(120,10,'TRANSACTION FEES FOR SHARE-SALES',0,1,'C');
					
					$pdf->SetFont('','', 10);
					$pdf->Cell(190,10,'[ Data from '.date("l, j-F Y; H:i:s", strtotime($f_date)).' to '.date("l, j-F Y; H:i:s", strtotime($t_date)).' ]',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(120,10,'REPORT PRINT DATE: '.date("l, j-F Y; H:i:s"),0,1,'L');
					
					//$pdf->SetFont('Arial','',14);
					
					//Colors, line width and bold font
					$pdf->SetFillColor(255,0,0);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(128,0,0);
					$pdf->SetLineWidth(.3);
					$pdf->SetFont('','B', 10);
					//Header
					$w=array(10,15,25,30,50,35);
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
					foreach($data as $row)
					{
						$pdf->Cell($w[0],6,$c,'LR',0,'L',$fill);
						$pdf->Cell($w[1],6,$row['share_trans_charge_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[2],6,$row['trans_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[3],6,$row['member_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[4],6,$row['share_trans_charge_date'],'LR',0,'L',$fill);
						$pdf->Cell($w[5],6,$sc.$row['share_trans_charge_amount'],'LR',0,'R',$fill);
						$total_sum += $row['share_trans_charge_amount'];
						// $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
						// $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
						$pdf->Ln();
						$fill=!$fill;
						$c++;
					}
					$pdf->Cell(130,6,'Total','LR',0,'R',$fill);
					$pdf->Cell(35,6,$sc.$total_sum,'LR',0,'R',$fill);
					$pdf->Ln();
					$pdf->Cell(array_sum($w),0,'','T');
					
					$pdf->Output();
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Error: '.$err->getMessage();
			$this->registry->template->show('admin/rep_trans_fee');
		}
	}
	
	public function share_trans_feeAction(){	
		$this->registry->template->_page_title = 'REPORTS: Share-Transaction Fees';
		$this->registry->template->_rep_title = 'REPORTS:<br/>Share-Transaction Fees';
		$this->registry->template->trans_type = 'share_trans_fee';
		try{
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->show('admin/rep_trans_fee');
			}else if(isset($this->registry->router->args['_POST']['share_trans_fee'])){
				$f_date = $this->registry->router->args['_POST']['from_date'].' 00:00';
				$t_date = $this->registry->router->args['_POST']['to_date'].' 23:59';
				$db = new db();
				$data = $db->raw_select("select * from ((share_trans_charges inner join share_account on share_trans_charges.account_id = share_account.share_account_id) inner join member on member.member_id = share_account.member_id) where share_trans_charge_date >= '".$f_date."' and share_trans_charge_date <= '".$t_date."'");
				if(count($data)==0){
					$this->registry->template->error_msg = 'No data available for that period';
					$this->registry->template->show('admin/rep_trans_fee');
				}else{
					$header=array('#', 'ID' , 'Trans-ID' , 'Member' , 'Date', 'Fee Amount');
					
					$pdf=new FPDF();
					
					$pdf->SetFont('Arial','B',16);
					$pdf->AddPage();
					$pdf->Cell(120,10,'TRANSACTION FEES FOR SHARE-TRANSFERS',0,1,'C');
					
					$pdf->SetFont('','', 10);
					$pdf->Cell(190,10,'[ Data from '.date("l, j-F Y; H:i:s", strtotime($f_date)).' to '.date("l, j-F Y; H:i:s", strtotime($t_date)).' ]',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(120,10,'REPORT PRINT DATE: '.date("l, j-F Y; H:i:s"),0,1,'L');
					
					//Colors, line width and bold font
					$pdf->SetFillColor(255,0,0);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(128,0,0);
					$pdf->SetLineWidth(.3);
					$pdf->SetFont('','B', 10);
					//Header
					$w=array(10,15,25,30,50,35);
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
					foreach($data as $row)
					{
						$pdf->Cell($w[0],6,$c,'LR',0,'L',$fill);
						$pdf->Cell($w[1],6,$row['share_trans_charge_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[2],6,$row['trans_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[3],6,$row['member_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[4],6,$row['share_trans_charge_date'],'LR',0,'L',$fill);
						$pdf->Cell($w[5],6,$sc.$row['share_trans_charge_amount'],'LR',0,'R',$fill);
						$total_sum += $row['share_trans_charge_amount'];
						// $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
						// $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
						$pdf->Ln();
						$fill=!$fill;
						$c++;
					}
					$pdf->Cell(130,6,'Total','LR',0,'R',$fill);
					$pdf->Cell(35,6,$sc.$total_sum,'LR',0,'R',$fill);
					$pdf->Ln();
					$pdf->Cell(array_sum($w),0,'','T');
					
					$pdf->Output();
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Error: '.$err->getMessage();
			$this->registry->template->show('admin/rep_trans_fee');
		}
	}
	
	private function get_loan_types(){
		try{
			$db = new db();
			return $db->dbSelect('loan_types', array('loan_type_id','loan_type_name'));
		}catch(PDOException $err){
			$r = array();
			return $r;
		}
	}
	
	public function loan_applicationsAction(){	
		$this->registry->template->_page_title = 'REPORTS: LOAN APPLICATIONS';
		$this->registry->template->_rep_title = 'REPORTS:<br/>LOAN APPLICATIONS';
		$this->registry->template->trans_type = 'loan_applications';
		try{
			$this->registry->template->loan_type_list=$this->get_loan_types();
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->show('admin/rep_loan_app');
			}else if(isset($this->registry->router->args['_POST']['loan_applications'])){
				$f_date = $this->registry->router->args['_POST']['from_date'].' 00:00';
				$t_date = $this->registry->router->args['_POST']['to_date'].' 23:59';
				$compare_types = array('>','=','<','>=','<=','<>');
				if($this->registry->router->args['_POST']['compare_type']>5 || $this->registry->router->args['_POST']['compare_type']<0 ){
					throw new Exception('Invalid compare-type specified');
				}
				if(!is_numeric($this->registry->router->args['_POST']['loan_amount'])){
					throw new Exception('Invalid loan amount specified');
				}
				if($this->registry->router->args['_POST']['loan_amount']<0){
					throw new Exception('Negative loan amount specified');
				}
				
				if(!isset($this->registry->router->args['_POST']['loan_type'])){
					throw new Exception('Loan type not specified');
				}
				if(!is_numeric($this->registry->router->args['_POST']['loan_type'])){
					throw new Exception('Invalid loan type specified');
				}
				
				$loan_type_cond='';
				if($this->registry->router->args['_POST']['loan_type'] != 0){
					$loan_type_cond = ' and  loan_types.loan_type_id='.$this->registry->router->args['_POST']['loan_type'];
				}
				// if($this->registry->router->args['_POST']['loan_amount']==0){
					// throw new Exception('Zero loan amount specified');
				// }
				$db = new db();
				$loan_cond = ' and loan_amount'.$compare_types[$this->registry->router->args['_POST']['compare_type']].$this->registry->router->args['_POST']['loan_amount'].$loan_type_cond;
				$data = $db->raw_select("select * from loan inner join loan_types on loan_types.loan_type_id = loan.loan_type_id inner join member on loan.member_id = member.member_id where loan_time >= '".$f_date."' and loan_time <= '".$t_date."' ".$loan_cond);
				if(count($data)==0){
					$this->registry->template->error_msg = 'No data available for that period';
					$this->registry->template->show('admin/rep_loan_app');
				}else{
					$header=array('Member' , 'Loan-Type' , 'Loan Amount', 'Final Payment', 'Months');
					
					$pdf=new FPDF();
					
					$pdf->SetFont('Arial','B',16);
					$pdf->AddPage();
					$pdf->Cell(120,10,'LOAN APPLICATIONS',0,1,'C');
					
					$pdf->SetFont('','', 10);
					$pdf->Cell(190,10,'[ Data from '.date("l, j-F Y; H:i:s", strtotime($f_date)).' to '.date("l, j-F Y; H:i:s", strtotime($t_date)).' ]',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(120,10,'REPORT PRINT DATE: '.date("l, j-F Y; H:i:s"),0,1,'L');
					
					//Colors, line width and bold font
					$pdf->SetFillColor(255,0,0);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(128,0,0);
					$pdf->SetLineWidth(.3);
					$pdf->SetFont('','B', 10);
					//Header
					$w=array(40,40,30,30,30);
					for($i=0;$i<count($header);$i++)
						$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
					$pdf->Ln();
					//Color and font restoration
					$pdf->SetFillColor(224,235,255);
					$pdf->SetTextColor(0);
					$pdf->SetFont('');
					//Data
					$fill=false;
					$sc = $this->registry->template->site_currency;
					$total_sum = 0;
					foreach($data as $row)
					{
						$pdf->Cell($w[0],6,$row['member_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[1],6,$row['loan_type_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[2],6,$sc.$row['loan_amount'],'LR',0,'R',$fill);
						$pdf->Cell($w[3],6,$sc.$row['loan_final_payment'],'LR',0,'R',$fill);
						$pdf->Cell($w[4],6,$row['loan_payment_months'],'LR',0,'R',$fill);
						// $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
						// $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
						$pdf->Ln();
						$fill=!$fill;
					}
					
					$pdf->Cell(array_sum($w),0,'','T');
					
					$pdf->Output();
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Error: '.$err->getMessage();
			$this->registry->template->show('admin/rep_loan_app');
		}
	}
	
	public function fund_trans_feeAction(){	
		$this->registry->template->_page_title = 'REPORTS: Fund-Transaction Fees';
		$this->registry->template->_rep_title = 'REPORTS:<br/>Fund-Transaction Fees';
		$this->registry->template->trans_type = 'fund_trans_fee';
		try{
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->show('admin/rep_trans_fee');
			}else if(isset($this->registry->router->args['_POST']['fund_trans_fee'])){
				$f_date = $this->registry->router->args['_POST']['from_date'].' 00:00';
				$t_date = $this->registry->router->args['_POST']['to_date'].' 23:59';
				$db = new db();
				$data = $db->raw_select("select * from ((fund_trans_charges inner join fund_account on fund_trans_charges.account_id = fund_account.fund_account_id) inner join member on member.member_id = fund_account.member_id) where fund_trans_charge_date >= '".$f_date."' and fund_trans_charge_date <= '".$t_date."'");
				if(count($data)==0){
					$this->registry->template->error_msg = 'No data available for that period';
					$this->registry->template->show('admin/rep_trans_fee');
				}else{
					$header=array('#', 'ID' , 'Trans-ID' , 'Member' , 'Date', 'Fee Amount');
					
					$pdf=new FPDF();
					
					$pdf->SetFont('Arial','B',16);
					$pdf->AddPage();
					$pdf->Cell(120,10,'TRANSACTION FEES FOR FUND-TRANSFERS',0,1,'C');
					
					$pdf->SetFont('','', 10);
					$pdf->Cell(190,10,'[ Data from '.date("l, j-F Y; H:i:s", strtotime($f_date)).' to '.date("l, j-F Y; H:i:s", strtotime($t_date)).' ]',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(120,10,'REPORT PRINT DATE: '.date("l, j-F Y; H:i:s"),0,1,'L');
					
					//Colors, line width and bold font
					$pdf->SetFillColor(255,0,0);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(128,0,0);
					$pdf->SetLineWidth(.3);
					$pdf->SetFont('','B', 10);
					//Header
					$w=array(10,15,25,30,50,35);
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
					foreach($data as $row)
					{
						$pdf->Cell($w[0],6,$c,'LR',0,'L',$fill);
						$pdf->Cell($w[1],6,$row['fund_trans_charge_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[2],6,$row['trans_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[3],6,$row['member_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[4],6,$row['fund_trans_charge_date'],'LR',0,'L',$fill);
						$pdf->Cell($w[5],6,$sc.$row['fund_trans_charge_amount'],'LR',0,'R',$fill);
						$total_sum += $row['fund_trans_charge_amount'];
						// $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
						// $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
						$pdf->Ln();
						$fill=!$fill;
						$c++;
					}
					$pdf->Cell(130,6,'Total','LR',0,'R',$fill);
					$pdf->Cell(35,6,$sc.$total_sum,'LR',0,'R',$fill);
					$pdf->Ln();
					$pdf->Cell(array_sum($w),0,'','T');
					
					$pdf->Output();
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Error: '.$err->getMessage();
			$this->registry->template->show('admin/rep_trans_fee');
		}
	}
	
	public function memAction(){
		$this->registry->template->_page_title = 'REPORTS: Member Accounts';
		$this->registry->template->_page_title = 'REPORTS:<br/>Member Accounts';
		$this->registry->template->trans_type = 'member_list';
		try{
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->show('admin/rep_trans_fee');
			}else if(isset($this->registry->router->args['_POST']['member_list'])){
				$f_date = $this->registry->router->args['_POST']['from_date'].' 00:00';
				$t_date = $this->registry->router->args['_POST']['to_date'].' 23:59';
				$db = new db();
				$data = $db->raw_select("select * from member where reg_date >= '".$f_date."' and reg_date <= '".$t_date."'");
				if(count($data)==0){
					$this->registry->template->error_msg = 'No data available for that period';
					$this->registry->template->show('admin/rep_trans_fee');
				}else{
					$header=array('#', 'ID' , 'ID Number' , 'Work ID' , 'Member Name', 'Registration Date');
					$pdf=new FPDF();
					
					$pdf->SetFont('Arial','B',16);
					$pdf->AddPage();
					$pdf->Cell(120,10,'MEMBER RECORDS',0,1,'C');
					
					$pdf->SetFont('','', 10);
					$pdf->Cell(190,10,'[ Data from '.date("l, j-F Y; H:i:s", strtotime($f_date)).' to '.date("l, j-F Y; H:i:s", strtotime($t_date)).' ]',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(120,10,'REPORT PRINT DATE: '.date("l, j-F Y; H:i:s"),0,1,'L');
					
					//Colors, line width and bold font
					$pdf->SetFillColor(255,0,0);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(128,0,0);
					$pdf->SetLineWidth(.3);
					$pdf->SetFont('','B', 10);
					//Header
					$w=array(10,15,30,35,40,60);
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
					foreach($data as $row)
					{
						$pdf->Cell($w[0],6,$c,'LR',0,'L',$fill);
						$pdf->Cell($w[1],6,$row['member_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[2],6,$row['member_national_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[3],6,$row['member_work_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[4],6,$row['member_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[5],6,$row['reg_date'],'LR',0,'L',$fill);
						// $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
						// $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
						$pdf->Ln();
						$fill=!$fill;
						$c++;
					}
					$pdf->Cell(array_sum($w),0,'','T');
					
					$pdf->Output();
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Error: '.$err->getMessage();
			$this->registry->template->show('admin/rep_trans_fee');
		}
	}
	
	public function fund_accountsAction(){
		$this->registry->template->_page_title = 'REPORTS: Fund Accounts';
		$this->registry->template->_rep_title = 'REPORTS:<br/>Fund Accounts';
		$this->registry->template->trans_type = 'fund_account_list';
		try{
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->show('admin/rep_trans_fee');
			}else if(isset($this->registry->router->args['_POST']['fund_account_list'])){
				$f_date = $this->registry->router->args['_POST']['from_date'].' 00:00';
				$t_date = $this->registry->router->args['_POST']['to_date'].' 23:59';
				$db = new db();
				$data = $db->raw_select("select * from fund_account inner join member on member.member_id= fund_account.member_id where reg_date >= '".$f_date."' and reg_date <= '".$t_date."'");
				if(count($data)==0){
					$this->registry->template->error_msg = 'No data available for that period';
					$this->registry->template->show('admin/rep_trans_fee');
				}else{
					$header=array('#', 'ID' , 'Name' ,  'Member ID', 'Balance', 'Create-Date');
					$pdf=new FPDF();
					
					$pdf->SetFont('Arial','B',16);
					$pdf->AddPage();
					$pdf->Cell(120,10,'MEMBER FUND ACCOUNT RECORDS',0,1,'C');
					
					$pdf->SetFont('','', 10);
					$pdf->Cell(190,10,'[ Data from '.date("l, j-F Y; H:i:s", strtotime($f_date)).' to '.date("l, j-F Y; H:i:s", strtotime($t_date)).' ]',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(120,10,'REPORT PRINT DATE: '.date("l, j-F Y; H:i:s"),0,1,'L');
					
					//Colors, line width and bold font
					$pdf->SetFillColor(255,0,0);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(128,0,0);
					$pdf->SetLineWidth(.3);
					$pdf->SetFont('','B', 10);
					//Header
					$w=array(10,15,35,30,30,55);
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
					
					foreach($data as $row)
					{
						$pdf->Cell($w[0],6,$c,'LR',0,'L',$fill);
						$pdf->Cell($w[1],6,$row['fund_account_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[2],6,$row['member_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[3],6,$row['member_national_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[4],6,$sc.($row['fund_account_debit'] - $row['fund_account_credit']),'LR',0,'L',$fill);
						$pdf->Cell($w[5],6,$row['reg_date'],'LR',0,'L',$fill);
						// $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
						// $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
						$pdf->Ln();
						$fill=!$fill;
						$c++;
					}
					$pdf->Cell(array_sum($w),0,'','T');
					
					$pdf->Output();
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Error: '.$err->getMessage();
			$this->registry->template->show('admin/rep_trans_fee');
		}
	}
	
	public function share_accountsAction(){
		$this->registry->template->_page_title = 'REPORTS: Share Accounts';
		$this->registry->template->_rep_title = 'REPORTS:<br/>Share Accounts';
		$this->registry->template->trans_type = 'share_account_list';
		try{
			if(!isset($this->registry->router->args['_POST'])){
				$this->registry->template->show('admin/rep_trans_fee');
			}else if(isset($this->registry->router->args['_POST']['share_account_list'])){
				$f_date = $this->registry->router->args['_POST']['from_date'].' 00:00';
				$t_date = $this->registry->router->args['_POST']['to_date'].' 23:59';
				$db = new db();
				$data = $db->raw_select("select * from share_account inner join member on member.member_id= share_account.member_id where reg_date >= '".$f_date."' and reg_date <= '".$t_date."'");
				if(count($data)==0){
					$this->registry->template->error_msg = 'No data available for that period';
					$this->registry->template->show('admin/rep_trans_fee');
				}else{
					$header=array('#', 'ID' , 'Name' ,  'Member ID', 'Balance', 'Create-Date');
					$pdf=new FPDF();
					
					$pdf->SetFont('Arial','B',16);
					$pdf->AddPage();
					$pdf->Cell(120,10,'MEMBER SHARE ACCOUNT RECORDS',0,1,'C');
					
					$pdf->SetFont('','', 10);
					$pdf->Cell(190,10,'[ Data from '.date("l, j-F Y; H:i:s", strtotime($f_date)).' to '.date("l, j-F Y; H:i:s", strtotime($t_date)).' ]',0,0,'L');
					$pdf->Ln();
					$pdf->Cell(120,10,'REPORT PRINT DATE: '.date("l, j-F Y; H:i:s"),0,1,'L');
					
					//Colors, line width and bold font
					$pdf->SetFillColor(255,0,0);
					$pdf->SetTextColor(255);
					$pdf->SetDrawColor(128,0,0);
					$pdf->SetLineWidth(.3);
					$pdf->SetFont('','B', 10);
					//Header
					$w=array(10,15,35,30,30,55);
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
					
					foreach($data as $row)
					{
						$pdf->Cell($w[0],6,$c,'LR',0,'L',$fill);
						$pdf->Cell($w[1],6,$row['share_account_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[2],6,$row['member_name'],'LR',0,'L',$fill);
						$pdf->Cell($w[3],6,$row['member_national_id'],'LR',0,'L',$fill);
						$pdf->Cell($w[4],6,($row['share_account_debit'] - $row['share_account_credit']).' SH','LR',0,'L',$fill);
						$pdf->Cell($w[5],6,$row['reg_date'],'LR',0,'L',$fill);
						// $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
						// $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
						$pdf->Ln();
						$fill=!$fill;
						$c++;
					}
					$pdf->Cell(array_sum($w),0,'','T');
					
					$pdf->Output();
				}
			}
		}catch(Exception $err){
			$this->registry->template->error_msg = 'Error: '.$err->getMessage();
			$this->registry->template->show('admin/rep_trans_fee');
		}
	}
		
	public function errorAction() {
		echo 'Bad URL';
	}
}