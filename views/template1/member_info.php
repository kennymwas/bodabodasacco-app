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
					<table width="237" height="220" border="0" cellspacing="0" cellpadding="26" bgcolor="#4A748A">
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
						<td width="40"><img src="<?php echo $template_path ?>images/spacer.gif" width="60" height="1" border="0"></td>
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

											<table width="60%">
												<tr>
												<td class="smooth">
												<table class="dotted" border="0" cellpadding="0" cellspacing="0" width="99%">
												<h1>Hi, <?php echo $member_name; ?> !</h1>
													<tr>
														<th class="nobg" colspan="2" align="left">
															<p class="float_l section_table_title">ACTIVITY SUMMARY
															<span style="color: rgb(248, 95, 2);"></span>
															</p>
															<span class="float_r" style="padding-right: 5px;"></span>
														</th>
													</tr>		
													<tr class="bg2">
														<td class="smooth" nowrap="nowrap" width="50%">Savings Balance</td>
														<td class="highlight" align="right" nowrap="nowrap" width="50%"><?php echo $site_currency.$fund_balance; ?></td>
													</tr>
													<tr>
														<td class="smooth" nowrap="nowrap" width="50%">Share Balance</td>
														<td class="highlight" align="right" nowrap="nowrap" width="50%"><?php echo $share_balance; ?></td>
													</tr>
													<tr class="bg2">
														<td class="smooth" nowrap="nowrap" width="50%">Last Fund Transaction</td>
														<td class="highlight" align="right" width="50%"><?php echo $site_currency.$last_trans_amount; ?><?php echo $last_trans_date; ?></td>
													</tr>
													<tr>
														<td class="smooth" nowrap="nowrap" width="50%">Last Share Transaction</td>
														<td class="highlight" align="right" width="50%"><?php echo $last_trans_amount_sh; ?> shares<br>
															<?php echo $last_trans_share_info ?></td>
													</tr>
													<tr class="bg2">
														<td class="smooth" nowrap="nowrap" width="50%">Last Share Sale</td>
														<td class="highlight" align="right" width="50%"><?php echo $last_trans_amount_sh_sale; ?> shares<br>
															<?php echo $last_trans_share_sale_info ?></td>
													</tr>
													<tr>
														<td class="smooth" nowrap="nowrap" width="50%">Last Successful Login</td>
														<td class="highlight" align="right"><?php echo $last_successful_login; ?></td>
													</tr>
													<tr class="bg2">
														<td class="smooth" nowrap="nowrap" width="50%">Last Web Activity</td>
														<td class="highlight" align="right"><?php echo $last_web_activity; ?></td>
													</tr>
												</table><br><br><br>
												<table class="dotted" border="0" cellpadding="0" cellspacing="0" width="99%">
													<tr>
														<th class="nobg" colspan="2" align="left">
															<p class="float_l section_table_title">ACCOUNT SUMMARY
															<span style="color: rgb(248, 95, 2);"></span>
															</p>
															<span class="float_r" style="padding-right: 5px;"></span>
														</th>
													</tr>
													<tr class="bg2">
														<td class="smooth" nowrap="nowrap" width="30%">Account Info</td>
														<td class="smooth" nowrap="nowrap" width="30%">[<a href="<?php echo $base_url; ?>member/account_info">manage</a>]</td>
														<td class="highlight" align="right" nowrap="nowrap" width="30%">[<a href="<?php echo $base_url; ?>member/pdf">pdf statement</a>]</td>
													</tr>
													<tr>
														<td class="smooth" nowrap="nowrap" width="30%">Next of Kin</td>
														<td class="smooth" nowrap="nowrap" width="30%">[<a href="<?php echo $base_url; ?>kin">manage</a>]</td>
														<td class="highlight" align="right" nowrap="nowrap" width="30%"><?php echo $kin_count; ?> Specified</td>
													</tr>
													<tr class="bg2">
														<td class="smooth" nowrap="nowrap" width="30%">Email Addresses</td>
														<td class="smooth" nowrap="nowrap" width="30%">[<a href="<?php echo $base_url; ?>email">manage</a>]</td>
														<td class="highlight" align="right" width="30%"><?php echo $email_count; ?> Specified</td>
													</tr>	
													<tr>
														<td class="smooth" nowrap="nowrap" width="30%">Physical Addresses</td>
														<td class="smooth" nowrap="nowrap" width="30%">[<a href="<?php echo $base_url; ?>physicalAddress">manage</a>]</td>
														<td class="highlight" align="right" width="30%"><?php echo $phyAddress_count; ?> Specified</td>
													</tr>
													<tr class="bg2">
														<td class="smooth" nowrap="nowrap" width="30%">Postal Addresses</td>
														<td class="smooth" nowrap="nowrap" width="30%">[<a href="<?php echo $base_url; ?>postal">manage</a>]</td>
														<td class="highlight" align="right" width="30%"><?php echo $postal_count; ?> Specified</td>
													</tr>
													<tr>
														<td class="smooth" nowrap="nowrap" width="30%">Phone Numbers</td>
														<td class="smooth" nowrap="nowrap" width="30%">[<a href="<?php echo $base_url; ?>phone">manage</a>]</td>
														<td class="highlight" align="right" width="30%"><?php echo $phone_count; ?> Specified</td>
													</tr>
												</table><br><br><br>
												<table class="dotted" border="0" cellpadding="0" cellspacing="0" width="99%">
												<tr>
													<th class="nobg" colspan="2" align="left">
														<p class="float_l section_table_title">SESSION TIME<br>
														<span style="color: rgb(248, 95, 2);"></span>
														</p>
														<span class="float_r" style="padding-right: 5px;">[<a href="<?php echo $base_url; ?>member/session_time">change</a>]</span>
													</th>
												</tr>        <!-- Account Summary -->
												<tr class="bg2">
													<td class="smooth" nowrap="nowrap" width="50%">*Automatic Log-Off In:</td>
													<td nowrap="nowrap" width="50%" class="highlight" align="right"><?php echo $session_time; ?> Minutes</td>
												</tr>
												</table>
												*Automatic Log-Off time specifies the maximum amount of idle-time the system will allow for your logged session before automatically logging it off.<br>
												You can specify a value between <strong><?php echo $minimum_inactivity_time; ?> and <?php echo $maximum_inactivity_time; ?> minutes</strong>. 
													<br><br><br>
												</td>
												</tr>
												</table>

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