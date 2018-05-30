<html>
<?php include("head.php"); ?>
<body>
<script type="text/javascript" src="<?php echo $template_path ?>admin/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
var main_css = "<?php echo $base_url ?>index/style_css";
var page_text_elements = "news_content";
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
								[<a href="<?php echo $admin_url; ?>">Back to Admin home</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>news/add">Add news entry</a>]<br/><br/>

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
											<LINK REL=STYLESHEET HREF='<?php echo $template_path ?>admin/fomarts.css' TYPE='text/css'>
											<script type="text/javascript" src="<?php echo $template_path ?>admin/jscripts/datepicker-source.js"></script>
											<form action='' method="post">
												<input type='hidden' name='news_add' />
												<strong>News Title</strong><br/>
												<input type='text' name='news_title' /><br/><br/>
												<strong>News Description</strong><br/>
												<textarea name='news_desc' style='width:260px;height:90px'></textarea><br/><br/>
												<strong>News Date</strong>
												<input type="text" readonly="true" value="<?php echo date("Y-m-d"); ?>" id='news_date' name="news_date" />
												<input type="button" value="Choose Date" onclick="displayDatePicker('news_date', false, 'ymd', '-'); return false" /><br/><br/>
												<strong>News Content</strong><br/>
												<textarea style='width:100%;height:500px' name='news_content' /></textarea><br/><br/>
												<input type='submit' value='Add News' /> | 
												<input type='button' value='Cancel' onclick="window.location='<?php echo $admin_url; ?>news'" />
											</form>
											<!-- content end -->

											<?php
													echo '<br/><br/><table width=\'100%\'>';
													echo "<tr style='background-color:$back_col'>";
													echo '<td><strong>Member Name</strong></td>';
													echo '<td><strong>Member ID</strong></td>';
													echo '<td><strong>National ID</strong></td>';
													echo '<td width=\'25%\'><strong>Page Actions</strong></td><tr>';
													foreach($member_list as $row_data){
														$back_col = $back_col=='rgb(244, 246, 249)' ? '':'rgb(244, 246, 249)';
														echo "<tr style='height:35px ;background-color:$back_col'>";											
														echo '<td>'.$row_data['member_name'].'</td>';
														echo '<td>'.$row_data['member_work_id'].'</td>';
														echo '<td>'.$row_data['member_national_id'].'</td>';
														echo '<td>[ <a href=\''.$admin_url.'members/delete/'.$row_data['member_id'].'\'>delete</a> ]<br/>
																[ <a href=\''.$admin_url.'members/edit/'.$row_data['member_id'].'\'>edit</a> ] |  
																[ <a href=\''.$admin_url.'members/view_detail/'.$row_data['member_id'].'\'>view member details</a> ] </td>';
														echo "</tr>";
													}
													echo '</table><br/><br/>';
											?>

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