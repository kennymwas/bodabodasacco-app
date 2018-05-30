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
								[<a href="<?php echo $admin_url; ?>page/add">Add page</a>]<br/><br/>
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
													echo '<td><strong>Page Title</strong></td>';
													echo '<td><strong>Page Description</strong></td>';
													echo '<td><strong>Page Content</strong></td>';
													echo '<td width=\'25%\'><strong>Page Actions</strong></td><tr>';
													foreach($page_list as $row_data){
														$back_col = $back_col=='rgb(244, 246, 249)' ? '':'rgb(244, 246, 249)';
														echo "<tr style='height:35px ;background-color:$back_col'>";											
														echo '<td>'.$row_data['page_title'].'</td>';
														echo '<td>'.$row_data['page_desc'].'</td>';
														echo '<td>'.strip_tags($row_data['page_content']).'.....</td>';
														echo '<td>[ <a href=\''.$admin_url.'page/delete/'.$row_data['page_url_title'].'\'>delete page</a> ]<br/>
																[ <a href=\''.$admin_url.'page/edit/'.$row_data['page_url_title'].'\'>edit page</a> ] |  
																[ <a href=\''.$base_url.$row_data['page_url_title'].'\'>view page</a> ] </td>';
														echo "</tr>";
													}
													echo '</table><br/><br/>';
													if($page_number==1){
														echo" f i r s t  .:|:. ";
													}else{
														echo'[  <a href=\''.$admin_url.'page/list/page/1\'> f i r s t </a> ] .:|:. ';
													}
													if($page_number==1){
														echo" p r e v i o u s  .:|:. ";
													}else{
														echo'[ <a href=\''.$admin_url.'page/list/page/'.($page_number-1).'\'> p r e v i o u s </a> ] .:|:. ';
													}
													if($page_number==$page_count){
														echo" n e x t  .:|:. ";
													}else{
														echo'[ <a href=\''.$admin_url.'page/list/page/'.($page_number+1).'\'> n e x t </a> ] .:|:. ';
													}
													if($page_number==$page_count){
														echo" l a s t <br><br>";
													}else{
														echo'[ <a href=\''.$admin_url.'page/list/page/'.$page_count.'\'> l a s t </a> ]<br><br>';
													}
													echo 'Page Location : <strong>'.$page_number.'</strong> | ';
													echo 'Number of Page Locations : <strong>'.$page_count.'</strong> | ';
													echo 'Site Page Count : <strong>'.$site_page_count.'</strong><br/><br/><br/>';
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