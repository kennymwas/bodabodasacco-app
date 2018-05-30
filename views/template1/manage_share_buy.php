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
											if($dt_count == 0){
											?>
												You have not made any requests for new shares. Click <a href='<?php echo $base_url ?>share_buy'>here</a> buy new shares
											<?php
											}else{
												echo "<h2>Share Purchase Requests</h2><br/>";
												echo "<table width='500px' class='dotted'>";
												echo "<tr class='bg2'><td><strong>Share Amount</strong></td>";
												echo "<td><strong>Value Per Share</strong></td>";
												echo "<td><strong>Request Date</strong></td>";
												echo "<td><strong>Total Cost</strong></td>";
												echo "<td><strong>Actions</strong></td></tr>";
												foreach($dt_list as $dt){
													echo "<tr >";
													echo "<td>".$dt['share_purchase_amount']."</td>";
													echo "<td>".$dt['share_purchase_value_per_share']."</td>";
													echo "<td>".$dt['share_purchase_date']."</td>";
													echo "<td>".$site_currency.round($dt['share_purchase_amount']*$dt['share_purchase_value_per_share'],2)."</td>";
													echo "<td>[ <a href='".$base_url."share_buy/delete_req/".$dt['share_purchase_id']."'><span style='color:red'>drop request</span></a> ]</td>";
													echo "</tr>";
												}
												echo "</table><br/><br/>";
												echo "Request Count: ".$dt_count."<br/><br/>";
												echo "[ <a href='".$base_url."share_buy'>Buy More Shares</a> ]<br/>";
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