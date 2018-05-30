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
								<span class="style4">
									<p>
									Your email address is like your account number.
									</p>
									<p>
									You can recieve shares or funds to your account through any of the email addresses you have registered with
									</p>
								</span>
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
						<td width="40"><img src="<?php echo $template_path ?>images/spacer.gif" width="80" height="1" border="0"></td>
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
										if($transfer_step==1){
										?>
											<form action="" method="post">
												<input type='hidden' name='share_sale' />
												Recipient :<br/>
												<input type='text' name='recipient_email' /><br/><br/>
												Value per Share:<br/>
												<input type='text' name='share_value' />
												<br/><br/>
												Share Amount:<br/>
												<input type='text' name='value_amount' /><br/><br/>
												<input type='submit' value='Continue' /><br/><br/>
											</form><br/><br/>
										<?php 
										}else if($transfer_step==2){
										?>
											<strong>RECIPIENT NAME: </strong><br/>
											<?php echo $recep_name ; ?>
											<br/><br/>
											<strong>RECIPIENT EMAIL: </strong><br/>
											<?php echo $recep_email ; ?>
											<br/><br/>
											<strong>SHARE AMOUNT: </strong><br/>
											<?php echo $value_amount ; ?>
											<br/><br/>
											<strong>SALE CHARGE TO SENDER: </strong><br/>
											<?php echo $sender_trans_charge ; ?>
											<br/><br/>
											<strong>SALE CHARGE TO RECIPIENT: </strong><br/>
											<?php echo $recipient_trans_charge ; ?>
											<br/><br/><br/>
											To confirm and effect this sale request:
											<form action='' method='post'>
												<input type='hidden' name='make_sale' />
												<input type='submit' value='Click here to MAKE sale request' />
											</form><br/><br/>
											To cancel this transaction:
											<form action='' method='post'>
												<input type='hidden' name='cancel_sale' />
												<input type='submit' value='Click here to CANCEL sale request' />
											</form><br/><br/>
										<?php 
										}else if($transfer_step==3){
										?>
											<h2><?php echo $transfer_info; ?></h2><br/>
											[ <a href="<?php echo $base_url; ?>share_sale">...new value transfer ? </a> ]
										<?php 
										}else if($transfer_step==4){
										?>
											<h2><?php echo $transfer_info; ?></h2><br/>
											[ <a href="<?php echo $base_url; ?>share_sale">...new value transfer ? </a> ]
										<?php 
										}else{
										?>
											<h2>Error.</h2> A problem occured while loading this page. Please contact support
										<?php 
										}
										?>
											<!-- content end -->
										</td>
										<td>
										<p><img src="<?php echo $template_path ?>images/spacer.gif" width="200" height="0" border="0">
										<strong> Your Current Account Status</strong>:<br/> <br/>
										<img src="<?php echo $template_path ?>images/spacer.gif" width="200" height="0" border="0">Account Holder Name:<br/> 
										<img src="<?php echo $template_path ?>images/spacer.gif" width="200" height="0" border="0"><?php echo $member_name; ?>
										<br><br>
										 <img src="<?php echo $template_path ?>images/spacer.gif" width="200" height="0" border="0">Fund Balance:<br/> 
										<img src="<?php echo $template_path ?>images/spacer.gif" width="200" height="0" border="0"><?php echo $site_currency.$fund_balance ; ?>
										<br><br>
										<img src="<?php echo $template_path ?>images/spacer.gif" width="200" height="0" border="0">Share Balance:<br/> 
										<img src="<?php echo $template_path ?>images/spacer.gif" width="200" height="0" border="0"><?php echo $share_balance ; ?>	
									</p>
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