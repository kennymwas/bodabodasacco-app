<html>
<?php include("head.php"); ?>
<body>
<script type="text/javascript" src="<?php echo $template_path ?>admin/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
var main_css = "<?php echo $base_url ?>index/style_css";
var page_text_elements = "page_content";
</script>
<script type="text/javascript" src="<?php echo $template_path ?>admin/jscripts/tiny_mce/def_setup.js"></script>
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
								[<a href="<?php echo $admin_url ?>">Back to Admin home</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>members/view_detail/<?php echo $member_id ?>">Back to view-detail</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>members">Back to member listing</a>]<br/><br/>
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
										<td><br/><br/>
											<!-- content start -->
											<form action="" method="post">
												<input type='hidden' name='member_edit' value="<?php echo $member_id ?>" />
												<table width='100%'>
												<tr width='100%'>
													<td valign='top' width='50%'>
														Member Name:<br/>
														<input type='text' name='member_name' value="<?php echo $member_name ?>" /><br/><br/>
														National ID:<br/>
														<input type='text' name='nat_id' value="<?php echo $nat_id ?>" /><br/><br/>
													</td>
													<td valign='top' width='50%'>
														Membership ID:<br/>
														<input type='text' name='work_id' value="<?php echo $work_id ?>" /><br/><br/>
														Active Status:<br/>
														<select name="member_status">
															<?php
																if($member_status==1){
																	echo "<option value='active' selected='selected'>Active</option>";
																	echo "<option value='disabled'>Disabled</option>";
																}else{
																	echo "<option value='active'>Active</option>";
																	echo "<option value='disabled' selected='selected'>Disabled</option>";
																}
															?>
														</select><br/><br/>
													</td>
												</tr>
												</table>
												<input type='submit' value='Update' /><br/><br/>
											</form>
											<br/><br/>
											<h2>Account Data</h2><br/><br/>
											<form action="" method="post" >
												<strong>Savings Account Balance</strong><br/>
												To change this member's account data, specify an update value here.<br/>
												The value will be added to the current member's balance, hence, to reduce<br/>
												a customer's account balance, specify a negative value.<br/><br/>
												<input type="hidden" name="upd_finance" value="<?php echo $member_id ?>"/>
												Current Fund Balance: <?php echo $site_currency.$_fund_balance ?><br/><br/>
												<input type="text" name="fund_upd_val" /><br/><br/>
												<input type="submit" value="Update" />
											</form><br/><br/><br/>
											<form action="" method="post" >
												<strong>Share Account Balance</strong><br/>
												To change this member's account data, specify an update value here.<br/>
												The value will be added to the current member's balace, hence, to reduce<br/>
												a customer's account balance, specify a negative value.<br/><br/>
												<input type="hidden" name="upd_share" value="<?php echo $member_id ?>" />
												Current Share Balance: <?php echo $_share_balance ?><br/><br/>
												<input type="text" name="share_upd_val" /><br/><br/>
												<input type="submit" value="Update" />
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