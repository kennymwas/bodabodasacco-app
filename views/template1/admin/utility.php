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
								[<a href="<?php echo $admin_url; ?>list_utility/add">Add utility</a>]<br/><br/>
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
											if($utility_count == 0){
												echo '<br/><br/><strong>'.$no_page_info.'</strong><br/>';
											}else{
												echo "<table width='100%' class='dotted'>";
												echo "<tr class='bg2'><td><strong>Utility Name</strong></td>";
												echo "<td><strong>Website</strong></td>";
												echo "<td><strong>Phone</strong></td>";
												echo "<td><strong>Status</strong></td>";
												echo "<td><strong>Actions</strong></td></tr>";
												foreach($utility_list as $utility){
													echo "<tr >";
													echo "<td>[ <a href='".$admin_url.'list_utility/show/'.$utility['utility_id']."'>".$utility['utility_name']."</a> ]</td>";
													echo "<td><a href='".$utility['utility_website']."'>".$utility['utility_website']."</a></td>";
													echo "<td>".$utility['utility_phone']."</td>";
													if($utility['utility_available']){
														echo "<td>[ <a href='".$admin_url."list_utility/disable/".$utility['utility_id']."'><font color='green'>Available</font></a> ]</td>";
													}else{
														echo "<td>[ <a href='".$admin_url."list_utility/enable/".$utility['utility_id']."'><font color='red'>Unavailable</font></a> ]</td>";
													}
													echo "<td>[ <a href='".$admin_url."list_utility/edit/".$utility['utility_id']."'><font color='green'>edit</font></a> ] | ";
													echo "[ <a href='".$admin_url."list_utility/show/".$utility['utility_id']."'><font color='green'>more detail</font></a> ]<br/>";
													echo "[ <a href='".$admin_url."list_utility/payments/".$utility['utility_id']."'>view payments</a> ]</td>";
													echo "</tr>";
												}
												echo "</table><br/><br/>";
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