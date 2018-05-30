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
                            <td><a href="<?php echo $base_url ?>"><img src="<?php echo $template_path ?>images/logo.png" height="120"width="465" border="0"></a></td>
                            <td><a href="<?php echo $base_url ?>"><img src="<?php echo $template_path ?>images/top1.jpg"  height="139"width="360" border="0"></a></td>
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
						<?php include("sidemenu.php"); ?>
					</table>
					<table width="237" border="0" cellspacing="0" cellpadding="26" bgcolor="#4A748A">
						<tr>
							<td>
								<span class="style4"><?php echo $site_msg; ?></span>
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
							<td width="1000px">
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
											if($loan_list_count == 0){
											?>
												No Loan Data added. Click <a href='<?php echo $base_url ?>loan/add'>here</a> to add one
											<?php
											}else{
												echo "<h2>Loan Listing</h2><br/>";
												echo "<table width='500px' class='dotted'>";
												echo "<tr class='bg2'><td><strong>Loan Amount</strong></td>";
												echo "<td><strong>Payment Months</strong></td>";
												echo "<td><strong>Monthly Payment</strong></td>";
												echo "<td><strong>Final Re-Payment</strong></td>";
												echo "<td><strong>Loan Interest</strong></td>";
												echo "<td><strong>Loan Status</strong></td>";
												echo "<td><strong>Actions</strong></td></tr>";
												foreach($loan_list as $loan){
													echo "<tr >";
													echo "<td>".$site_currency.$loan['loan_amount']."</td>";
													echo "<td>".$loan['loan_payment_months']."</td>";
													echo "<td>".$site_currency.$loan['loan_monthly_payment']."</td>";
													echo "<td>".$site_currency.$loan['loan_final_payment']."</td>";
													echo "<td>".$loan['loan_interest'] ."%</td>";
													if($loan['loan_approved']==1){
														echo "<td>Approved</a></td>";
														echo "<td>[ <a href='".$base_url."loan/make_payment/".$loan['loan_id']."'>Make Payment</a> ]<br/>";
														echo "[ <a href='".$base_url."loan/list_payments/".$loan['loan_id']."'>List Payments</a> ] </td> ";
													}else{
														echo "<td>Pending</td>";
														echo "<td>[ <a href='".$base_url."loan/drop_request/".$loan['loan_id']."'>Drop Request</a> ]	</td>";
													}
													echo "</tr>";
												}
												echo "</table><br/><br/>";
												echo "Loan Count: ".$loan_list_count."<br/><br/>";
												echo "Loan Amount: ".$site_currency.$total_loan_amount."<br/><br/>";
												echo "[ <a href='".$base_url."loan/add'>apply for new loan</a> ]<br/>";
												echo "[ <a href='".$base_url."member/'>back to profile</a> ]";
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