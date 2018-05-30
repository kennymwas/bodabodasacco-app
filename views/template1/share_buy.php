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
								<span class="style4">
									<p>
									Your email address is like your account number.
									</p>
									<p>
									You can recieve shares or funds to your account through any of the email addresses you have registered with
									</p>
								</span>
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
										<h2>Current Value per Share:  <?php echo $site_currency.$share_price ?></h2><br/><br/>
										<h2>Available Shares:  <?php echo $new_share_balance ?></h2><br/><br/>
										<h3>[<a href="<?php echo $base_url ?>share_buy/list">list pending share requests</a>]</h3><br/><br/>
										<?php 
										if($share_buy_step==1){
										?>
											<form action="" method="post">
												Specify the number of share you would like to buy:<br/>
												<input type='text' name='buy_shares' /><br/><br/>
												<input type='submit' value='Buy Shares' /><br/><br/>
											</form><br/><br/>
										<?php 
										}else if($share_buy_step==2){
										?>
											<strong>Your share purchase request has been received. If disapproved, you will receive a full refund</strong><br/>
											Bought Shares: <?php echo $share_purchase_amount ?><br/>
											Value per Share: <?php echo $share_purchase_value_per_share ?><br/><br/>
											[<a href="<?php echo $base_url ?>share_buy">buy more</a>]
										<?php 
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