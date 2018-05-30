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
								[<a href="<?php echo $admin_url; ?>share_trans/list">Approved share transfers</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>share_trans/list_s">Pending share sales</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>share_trans/list_sales">Approved share sales</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>share_trans/list_purchases">Share purchase</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>share_trans/list_requested_purchases">Share purchase requests</a>]<br/><br/>
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
													echo '<td><strong>Member Name</strong></td>';
													echo '<td><strong>Share Amount</strong></td>';
													echo '<td><strong>Value Per Share</strong></td>';
													echo '<td><strong>Total Share Value</strong></td>';
													echo '<td><strong>Request Date</strong></td>';
													echo '<td><strong>Actions</strong></td>';
													foreach($trans_list as $row_data){
														$back_col = $back_col=='rgb(244, 246, 249)' ? '':'rgb(244, 246, 249)';
														echo "<tr style='height:35px ;background-color:$back_col'>";											
														echo '<td>'.$row_data['member_name'].'</td>';
														echo '<td>'.$row_data['share_purchase_amount'].'</td>';
														echo '<td>'.$site_currency.$row_data['share_purchase_value_per_share'].'</td>';
														echo '<td>'.$site_currency.$row_data['share_purchase_amount']*$row_data['share_purchase_value_per_share'].'</td>';
														echo '<td>'.$row_data['share_purchase_date'].'</td>';
														echo "<td>[<a href='".$admin_url."share_trans/approve_req/".$row_data['share_purchase_id']."'>approve</a>]<br/>[<a href='".$admin_url."share_trans/cancel_req/".$row_data['share_purchase_id']."'>cancel</a>]</td>";
														echo "</tr>";
													}
													echo '</table><br/><br/>';
													if($pageNum==1){
														echo" f i r s t  .:|:. ";
													}else{
														echo'[  <a href=\''.$admin_url.'share_trans/list_purchases/page/1\'> f i r s t </a> ] .:|:. ';
													}
													if($pageNum==1){
														echo" p r e v i o u s  .:|:. ";
													}else{
														echo'[ <a href=\''.$admin_url.'share_trans/list_purchases/page/'.($pageNum-1).'\'> p r e v i o u s </a> ] .:|:. ';
													}
													if($pageNum==$site_page_count){
														echo" n e x t  .:|:. ";
													}else{
														echo'[ <a href=\''.$admin_url.'share_trans/list_purchases/page/'.($pageNum+1).'\'> n e x t </a> ] .:|:. ';
													}
													if($pageNum==$site_page_count){
														echo" l a s t <br><br>";
													}else{
														echo'[ <a href=\''.$admin_url.'share_trans/list_purchases/page/'.$site_page_count.'\'> l a s t </a> ]<br><br>';
													}
													echo 'Page Location : <strong>'.$pageNum.'</strong> | ';
													echo 'Number of Page Locations : <strong>'.$site_page_count.'</strong> | ';
													echo 'Share Transaction Count : <strong>'.$trans_count.'</strong><br/><br/><br/>';
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