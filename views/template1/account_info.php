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
							<td colspan="3"><img src="<?php echo $template_path ?>images/orange.gif" width="100%" height="6" border="0"></td>
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
											<t<table width='100%'>
												<tr width='100%'>
													<td valign='top' width='50%'>
														<strong>Change Member Data</strong><br/><br>
														<form action="" method="post">
															<input type='hidden' name='member_data' />
															Member Name:<br/>
															<input type='text' name='name' value="<?php echo $name ?>" /><br/><br/>
															National ID:<br/>
															<input type='text' name='nat_id' value="<?php echo $nat_id ?>" /><br/><br/>
															Member ID:<br/>
															<input type='text' name='emp_id' value="<?php echo $emp_id ?>" /><br/><br/>
															<input type='submit' value='Update Member Data' />
														</form>
													</td>
													<td valign='top' width='50%'>
														<strong>Change Password Data</strong><br/><br>
														<form action="" method="post">
															<input type='hidden' name='pass_data' />
															Current Password:<br/>
															<input type='password' name='current_pass' /><br/><br/>
															New Password:<br/>
															<input type='password' name='pass' /><br/><br/>
															Confirm New Password:<br/>
															<input type='password' name='c_pass' /><br/><br/>
															<input type='submit' value='Update Password Data' />
														</form>
													</td>
												</tr>
												</table><br/><br/>
												<input type="button" onclick="window.location='<?php echo $base_url; ?>member/info'" value="Cancel" /><br/><br/><br/>
											</form>
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