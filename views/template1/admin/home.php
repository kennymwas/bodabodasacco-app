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
								<strong>Member Count:</strong><br/>
								<?php echo $_member_count; ?><br/><br/>
								<strong>Date:</strong><br/>
								<?php echo date("l, j-F Y; H:i:s"); ?><br/><br/>
								<strong>Site Status:</strong><br/>
								<?php echo $_site_status ?><br/><br/>
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
											<h1>ADMIN BACKEND</h1><br/><br/>
											<table width='100%'>
												<tr valign='top' width='100%'>
												<td style='background-color:rgb(244, 246, 249)' width='50%'>
													<h1>PAGE-CMS</h1><br/>
													Manage the content of some of this site's web-pages, dynamically, conviniently and easily<br/><br/>
													[ <a href="<?php echo $admin_url; ?>page"><strong>list pages</strong></a> ]<br/><br/>
												</td>
												<td style='background-color:rgb(240, 240, 240)' width='50%'>
													<h1>MEMBERS</h1><br/>
													List and manage membership data here, and communicate with all of them via e-mail, or SMS<br/><br/>
													[ <a href="<?php echo $admin_url; ?>members"><strong>list members</strong></a> ]<br/><br/>
												</td>
												</tr>
												
												<tr valign='top' width='100%'>
												<td style='background-color:rgb(240, 240, 240)' width='50%'>
													<h1>NEWS</h1><br/>
													Manage News entries here, to diseminate important information to members quickly and efficiently<br/><br/>
													[ <a href="<?php echo $admin_url; ?>news"><strong>list entries</strong></a> ]<br/><br/>
												</td>
												<td style='background-color:rgb(244, 246, 249)' width='50%'>
													<h1>REPORTS</h1><br/>
													Set-up and manage events and announcements, informing members of when and where they will happen.<br/><br/> 
													[ <a href="<?php echo $admin_url; ?>reports/share_sale_trans_fee"><strong>Share-sale transaction fee reports</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>reports/share_trans_fee"><strong>Share-transaction fee reports</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>reports/fund_trans_fee"><strong>Fund-transaction fee reports</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>reports/mem"><strong>Member reports</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>reports/fund_accounts"><strong>Fund account reports</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>reports/share_accounts"><strong>Share account reports</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>reports/loan_applications"><strong>Loan applications</strong></a> ]<br/><br/>
												</td>
												</tr>
												<tr valign='top' width='100%'>
													<td style='background-color:rgb(244, 246, 249)' width='50%'>
													<h1>SHARE-TRANSACTIONS</h1><br/>
													Manage and authorize share-transactions for members<br/><br/>
													[ <a href="<?php echo $admin_url; ?>share_trans/new_shares"><strong>Share configs</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>share_trans"><strong>Manage shares</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>share_trans/dividend"><strong>Manage dividends</strong></a> ]<br/><br/>
												</td>
												<td style='background-color:rgb(240, 240, 240)' width='50%'>
													<h1>FUND TRANSACTIONS</h1><br/>
													Manage fund transactions<br/><br/>
													[ <a href="<?php echo $admin_url; ?>loan"><strong>Manage loan</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>fund_trans"><strong>Manage funds</strong></a> ]<br/>
													[ <a href="<?php echo $admin_url; ?>list_utility"><strong>Manage utilities</strong></a> ]<br/><br/>
												</td>
												</tr>
												<tr valign='top' width='100%'>
												<td style='background-color:rgb(240, 240, 240)' width='50%'>
													<h1>SITE-CONFIGS</h1><br/>
													Manage site-wide configuration data<br/><br/>
													[ <a href="<?php echo $admin_url; ?>site_config"><strong>Manage configs</strong></a> ]<br/><br/>
												</td>
												<td style='background-color:rgb(244, 246, 249)' width='50%'>
													<h1>CONTACT QUERIES</h1><br/>
													Respond to member and other queries made on the site<br/><br/> 
													[ <a href="<?php echo $admin_url; ?>contact_queries"><strong>List queries</strong></a> ]<br/><br/>
												</td>
												</tr>
											</table><br/><br/><br/>

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