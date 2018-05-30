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
										if(isset($mod_1)){
										?>
											<form action="" method="post">
												<strong>Loan Threshold : <?php echo $site_currency.$site_currency.$loan_max; ?></strong><br/><br/>
												<strong>Loan Type : <?php echo $loan_type_name; ?></strong><br/><br/>
												<strong>Loan Min Months : <?php echo $loan_type_min_months; ?></strong><br/><br/>
												<strong>Loan Max Months : <?php echo $loan_type_max_months; ?></strong><br/><br/>
												<strong>Loan Min Amount : <?php echo $site_currency.$loan_type_min_amount; ?></strong><br/><br/>
												<strong>Loan Max Amount : <?php echo $site_currency.$loan_type_max_amount; ?></strong><br/><br/>
												<strong>Loan Interest : <?php echo $loan_type_interest; ?> %</strong><br/><br/>
												<input type='hidden' name='add_loan' />	
												<input type='hidden' value='<?php echo $loan_type_id ?>' name='loan_type_id' />	
												Loan Amount<br/>
												<input type="text" name="loan_amount" /><br/><br/>
												Loan Payment Months<br/>
												<input type="text" name="loan_payment_months" /><br/><br/>
												<br/><br/>
												<input type="submit" value="Request Loan" /> | 
												<input type="button" onclick="window.location='<?php echo $base_url; ?>loan'" value="Cancel" />
											</form>
										<?php
										}else{
										?>
											Loan Type<br/>
											<?php echo $loan_type_name ?><br/><br/>
											Loan Amount<br/>
											<?php echo $loan_amount ?><br/><br/>
											Loan Payment Months<br/>
											<?php echo $loan_payment_months ?><br/><br/>
											Loan Interest<br/>
											<?php echo $loan_type_interest ?> %<br/><br/>
											Loan Monthly Payment Amount<br/>
											<?php echo $loan_monthly_payment ?><br/><br/>
											Loan Final Payment Amount<br/>
											<?php echo $loan_final_payment ?><br/><br/>
											[<a href="<?php echo $base_url; ?>loan/cancel">cancel loan request</a>]<br/><br/>
											[<a href="<?php echo $base_url; ?>loan/request_loan"><strong>make loan request<strong></a>]
										<?php
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