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
				<td width="24%" valign="top">
					<strong>Useful Links:</strong><br/><br/>
					[<a href="<?php echo $admin_url ?>">Back to Admin home</a>]<br/><br/>
					[<a href="<?php echo $admin_url; ?>members">Back to member listing</a>]<br/><br/>
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
											<form action="" method="post">
											<input type='hidden' name='edit_phone' value = "<?php echo $phone_id; ?>" />
											Phone Front Name<br/>
											<input type="text" name="front_name" value = "<?php echo $front_name; ?>" /><br/><br/>
											Phone Detail<br/>
											<input type="text" name="detail" value = "<?php echo $detail; ?>" /><br/><br/>
											Visibility<br/>
											<select name="visibility" />
												<?php
													if($visibility==1){
														echo "<option selected='selected' value='public'>Public</option>";
														echo "<option value='hidden'>Hidden</option>";
													}else{
														echo "<option value='public'>Public</option>";
														echo "<option selected='selected' value='hidden'>Hidden</option>";
													}
												?>
											</select>
											<br/><br/>
											<input type="submit" value="Update Phone Data" /> | 
											<input type="button" onclick="window.location='<?php echo $admin_url; ?>phone'" value="Cancel" />
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