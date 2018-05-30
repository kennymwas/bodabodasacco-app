<html>
<?php include("head.php"); ?>
<body>
<table width="966" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td bgcolor="#464646"  align="right">
		<table cellpadding="6">
			<tr>
			<?php include("topmenu.php"); ?>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table width="966" border="0" cellspacing="0" cellpadding="0">
			<tr>
                           
		     <td><a href="<?php echo $base_url ?>"><img src="<?php echo $template_path ?>images/logo.png" height="120" width="465" border="0"></a></td>
		      <td><a href="<?php echo $base_url ?>"><img src="<?php echo $template_path ?>images/top1.jpg"  height="139" width="360" border="0"></a></td>
		     <td><a href="<?php echo $base_url ?>"><img src="<?php echo $template_path ?>images/top2.jpg"  height="139" width="360" border="0"></a></td>
		     
            </tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table width="966" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="237" valign="top">
					<table width="237" border="0" cellspacing="0" cellpadding="0">
						
					</table>
					<table width="237" border="0" cellspacing="0" cellpadding="26">
						<tr>
							<td>
								<strong>Useful Links:</strong><br/><br/>
								[<a href="<?php echo $admin_url; ?>">Back to Admin home</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>loan/list">Loan applications</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>loan/add_loan_type">Add loan type</a>]<br/><br/>
								
							</td>
						</tr>
					</table>
				</td>
				<td>			
				</td>
				<td width="100%" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="3"><img src="<?php echo $template_path ?>images/orange.gif" width="960" height="6" border="0"></td>
						</tr>
						<tr>
						<td width="40"><img src="<?php echo $template_path ?>images/spacer.gif" width="40" height="1" border="0"></td>
							<td width="100%">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td align="left"><h1><?php if(isset($_page_title)) echo $_page_title ?></h1></td>
									</tr>
									<tr>
										<td width='20px'>
											<font color=red><?php if(isset($error_msg)) echo $error_msg.'<br/><br/>' ?></font>
											<font color=green><?php if(isset($info_msg)) echo $info_msg.'<br/><br/>' ?></font>
										</td>
									</tr>
									<tr>
										<td>
											<!-- content start -->
											<?php
											if($loan_type_list_count == 0){
											?>
												No Loan-Types have been defined. Click <a href='<?php echo $admin_url ?>loan/add_loan_type'>here</a> to define new loan-types
											<?php
											}else{
												echo "<h2>Loan Listing</h2><br/>";
												echo "<table width='600px' class='dotted'>";
												echo "<tr class='bg2'><td><strong>Loan Name</strong></td>";
												echo "<td><strong>Min Months</strong></td>";
												echo "<td><strong>Max Months</strong></td>";
												echo "<td><strong>Min Amount</strong></td>";
												echo "<td><strong>Max Amount</strong></td>";
												echo "<td><strong>Share Threshold</strong></td>";
												echo "<td><strong>Fund Threshold</strong></td>";
												echo "<td><strong>Account Age Threshold</strong></td>";
												echo "<td><strong>Loan Interest</strong></td>";
												echo "<td><strong>Actions</strong></td></tr>";
												foreach($loan_type_list as $loan_type){
													echo "<tr>";
													echo "<td>".$loan_type['loan_type_name']."</td>";
													echo "<td>".$loan_type['loan_type_min_months']."</td>";
													echo "<td>".$loan_type['loan_type_max_months']."</td>";
													echo "<td>".$site_currency.$loan_type['loan_type_min_amount']."</td>";
													echo "<td>".$site_currency.$loan_type['loan_type_max_amount']."</td>";
													echo "<td>".$loan_type['loan_type_share_threshold']."</td>";
													echo "<td>".$site_currency.$loan_type['loan_type_fund_threshold']."</td>";
													echo "<td>".$loan_type['loan_type_account_age_threshold']."</td>";
													echo "<td>".$loan_type['loan_type_interest']." %</td>";
													echo "<td><a href='".$admin_url."loan/edit_loan_type/".$loan_type['loan_type_id']."'>Edit</a><br/>";
													echo "<a href='".$admin_url."loan/delete_loan_type/".$loan_type['loan_type_id']."'>Delete</a></td> ";
													echo "</tr>";
												}
												echo "</table><br/><br/>";
												echo "Loan Count: ".$loan_type_list_count."<br/><br/>";
											}
											?>
											<!-- content end -->
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td><?php include("footer.php"); ?></td>
</tr>
</table>
</body>
</html>