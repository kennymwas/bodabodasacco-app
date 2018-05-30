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
												if(isset($no_page_info)){
													echo '<br/><br/><strong>'.$no_page_info.'</strong><br/>';
												}else{
													$back_col='rgb(244, 246, 249)';
													echo '<br/><br/><table width=\'100%\'>';
													echo "<tr style='background-color:$back_col'>";
													echo '<td><strong>Name</strong></td>';
													echo '<td><strong>Email</strong></td>';
													echo '<td><strong>Message</strong></td>';
													echo '<td><strong>Time</strong></td>';
													echo '<td><strong>Status</strong></td>';
													echo '<td width=\'25%\'><strong>Actions</strong></td><tr>';
													foreach($query_list as $row_data){
														$back_col = $back_col=='rgb(244, 246, 249)' ? '':'rgb(244, 246, 249)';
														echo "<tr style='height:35px ;background-color:$back_col'>";
														if($row_data['member_id']){
															echo '<td><a href=\''.$admin_url.'members/view_detail/'.$row_data['member_id'].'\'>[.'.$row_data['member_query_name'].'.]</a></td>';
														}else{
															echo '<td>'.$row_data['member_query_name'].'</td>';
														}
														if($row_data['member_id']){
															echo '<td><a href=\''.$admin_url.'members/view_detail/'.$row_data['member_id'].'\'>[.member info.]</a></td>';
														}else{
															echo '<td>'.$row_data['member_query_email'].'</td>';
														}
														echo '<td>'.strip_tags($row_data['member_query_msg']).'.....</td>';
														echo '<td>'.$row_data['member_query_time'].'</td>';
														if($row_data['member_query_read']){
															echo '<td><font color=\'green\'>read</font></td>';
														}else{
															echo '<td><font color=\'red\'>unread</font></td>';
														}
														echo '<td>[ <a href=\''.$admin_url.'contact_queries/read/'.$row_data['member_query_id'].'\'>read entry</a> ]<br/>  
																[ <a href=\''.$admin_url.'contact_queries/delete/'.$row_data['member_query_id'].'\'>delete</a> ]<br/>';
														if($row_data['member_query_read']){
															echo '[ <a href=\''.$admin_url.'contact_queries/mark_as_unread/'.$row_data['member_query_id'].'\'>mark entry as unread</a> ]</td>';
														}else{
															echo '[ <a href=\''.$admin_url.'contact_queries/mark_as_read/'.$row_data['member_query_id'].'\'>mark entry as read</a> ]</td>';
														}
														echo "</tr>";
													}
													echo '</table><br/><br/>';
													if($query_number==1){
														echo" f i r s t  .:|:. ";
													}else{
														echo'[  <a href=\''.$admin_url.'contact_queries/list/page/1\'> f i r s t </a> ] .:|:. ';
													}
													if($query_number==1){
														echo" p r e v i o u s  .:|:. ";
													}else{
														echo'[ <a href=\''.$admin_url.'contact_queries/list/page/'.($query_number-1).'\'> p r e v i o u s </a> ] .:|:. ';
													}
													if($query_number==$query_count){
														echo" n e x t  .:|:. ";
													}else{
														echo'[ <a href=\''.$admin_url.'contact_queries/list/page/'.($query_number+1).'\'> n e x t </a> ] .:|:. ';
													}
													if($query_number==$query_count){
														echo" l a s t <br><br>";
													}else{
														echo'[ <a href=\''.$admin_url.'contact_queries/list/page/'.$query_count.'\'> l a s t </a> ]<br><br>';
													}
													echo 'Page Location : <strong>'.$query_number.'</strong> | ';
													echo 'Number of Page Locations : <strong>'.$query_count.'</strong> | ';
													echo 'Queries Count : <strong>'.$site_page_count.'</strong><br/><br/><br/>';
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