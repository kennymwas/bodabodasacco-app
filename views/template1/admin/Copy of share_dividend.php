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
				<td width='24%' valign="top">
					<strong>Useful Links:</strong><br/><br/>
					[<a href="<?php echo $admin_url ?>">Back to Admin home</a>]<br/><br/>
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
													echo '<td><strong>Payout Date</strong></td>';
													echo '<td><strong>Value Per Share</strong></td>';
													echo '<td><strong>Total Paid</strong></td>';
													echo '<td width=\'25%\'><strong>Accounts Affected</strong></td><tr>';
													foreach($dt_list as $row_data){
														$back_col = $back_col=='rgb(244, 246, 249)' ? '':'rgb(244, 246, 249)';
														echo "<tr style='height:35px ;background-color:$back_col'>";											
														echo '<td>'.$row_data['dividend_payout_date'].'</td>';
														echo '<td>'.$row_data['dividend_payout_value'].'</td>';
														echo '<td>'.$site_currency.$row_data['dividend_payout_amount'].'</td>';
														echo '<td>'.$row_data['dividend_payout_member_count'].'</td>';
														echo "</tr>";
													}
													echo '</table><br/><br/>';
												}
											?>
											<br/><br/><br/>Make New Dividend Payout
											<form action="" method="post">
												<strong>Dividend Amount Per Share</strong><br/>
												<input type='text' name='value_per_share' /><br/><br/>
												<input type='submit' value='Make Divident Payout' />
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