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
											<?php
											if($kin_list_count == 0){
											?>
												No Kin Data added. Click <a href='<?php echo $base_url ?>kin/add'>here</a> to add one
											<?php
											}else{
												echo "<h2>Kin Listing</h2><br/>";
												echo "<table width='500px' class='dotted'>";
												echo "<tr class='bg2'><td><strong>Name</strong></td>";
												echo "<td><strong>Relation</strong></td>";
												echo "<td><strong>Phone</strong></td>";
												echo "<td><strong>Actions</strong></td></tr>";
												foreach($kin_list as $kin){
													echo "<tr >";
													echo "<td>".$kin['kin_name']."</td>";
													echo "<td>".$kin['kin_relation']."</td>";
													echo "<td>".$kin['kin_phone']."</td>";
													echo "<td>[ <a href='".$base_url."kin/edit/".$kin['kin_id']."'>edit</a> ] | ";
													echo "[ <a href='".$base_url."kin/delete/".$kin['kin_id']."'><span style='color:red'>delete</span></a> ]</td>";
													echo "</tr>";
												}
												echo "</table><br/><br/>";
												echo "Kin Count: ".$kin_list_count."<br/><br/>";
												echo "[ <a href='".$base_url."kin/add'>add kin data</a> ]<br/>";
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