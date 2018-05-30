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
												Are you sure you want to delete this record?<br/><br/>
												<font color='red'>All phone, email, physical address, postal and kin data for this member will be deleted too,<br/>
												as well as that member's fund and share accounts</font><br/><br/>
												<input type='hidden' name='member_delete' value="<?php echo $member_id ?>" />
												<table width='100%'>
												<tr width='100%'>
													<td valign='top' width='50%'>
														<strong>Member Name:</strong><br/>
														<?php echo $member_name ?><br/><br/>
														<strong>National ID:</strong><br/>
														<?php echo $nat_id ?><br/><br/>
													</td>
													<td valign='top' width='50%'>
														<strong>Membership ID:</strong><br/>
														<?php echo $work_id ?><br/><br/>
														<strong>Active Status:</strong><br/>
															<?php
																if($member_status==1){
																	echo "Active";
																}else{
																	echo "Disabled";
																}
															?>
														<br/><br/>
													</td>
												</tr>
												</table>
												<input type='submit' value='Delete' /><br/><br/>
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