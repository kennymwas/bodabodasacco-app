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
										<td align="left"><h1><?php if(isset($_rep_title)) echo $_rep_title ?></h1></td>
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
											<LINK REL=STYLESHEET HREF='<?php echo $template_path; ?>admin/fomarts.css' TYPE='text/css'>
											<script type="text/javascript" src="<?php echo $template_path; ?>admin/jscripts/datepicker-source.js"></script>
											<br/><br/><br/>Please specify the dates for which you want to retrieve the data below<br/><br/>
											<form action="" method="post">
											<input type='hidden' name='<?php echo $trans_type; ?>' />
											From Date<br/>
											<input type="text" readonly="true" value="<?php echo '2010-01-01';//date("Y-m-d"); ?>" name="from_date" />
											<input type="button" value="Choose Date" onClick="javascript: displayDatePicker('from_date', false, 'ymd', '-'); return false" /><br/><br/>
											To Date<br/>
											<input type="text" readonly="true" value="<?php echo date("Y-m-d"); ?>" name="to_date" />
											<input type="button" value="Choose Date" onClick="javascript: displayDatePicker('to_date', false, 'ymd', '-'); return false" /><br/><br/>
											<table width="900px">
											<tr><td>
											Loan Amount<br/>
											<input type="text" readonly="true" value="" name="loan_amount" />
											</td><td>
											Compare-Type<br/>
											<input type="text" readonly="true" value="" name="loan_amount" />
											</td></tr>
											</table>
											<input type="submit" value="Generate PDF" /> | 
											<input type="button" onclick="window.location='<?php echo $admin_url; ?>'" value="Cancel" />
											</form>
											<br/><br/><br/>
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