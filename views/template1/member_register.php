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
							<td height="270">
								<span class="style4">
									<p>
									You will use the email address you specify to login to your account.
									</p>
									<p>
									Alternatively, you can login into your account using any of the email addresses you add to your member profile.
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

											<form class="form-signin" action="" method="post">
												<input type='hidden' name='member_registration' />
												<table width='100%'>
												<tr width='100%'>
													<td valign='top' width='50%'>
														Member Name:<br/>
														<input type='text' maxlength="32" class="form-control" placeholder="firstname & lastname"  name='name' required value="<?php echo $name ?>" /><br/><br/>
														National ID:<br/>
														<input type='text' name='nat_id' maxlength="8" class="form-control" placeholder="ID Number" required autofocus value="<?php echo $nat_id ?>" /><br/><br/>
														Mobile Number:<br/>
														<input type='text' onfocus="tooltip()" name='phone'  class="form-control" required="" oninvalid="this.setCustomValidity('Please put a Safaricom phone number')" oninput="setCustomValidity('')" maxlength="12"  placeholder="07XXXXXXXX" value="<?php echo $phone ?>" /><br/><br/>
														Membership ID:<br/>
														<input type='text' name='emp_id' maxlength="5" class="form-control" required value="<?php echo $emp_id ?>" /><br/><br/>
													</td>
													<td valign='top' width='50%'>
														Email:<br/>
														<input type='text' maxlength="48" name='email' class="form-control" placeholder="Email" required value="<?php echo $email ?>" /><br/><br/>
														Password:<br/>
														<input type='password' name='pass' class="form-control" placeholder="********" required  /><br/><br/>
														Confirm Password:<br/>
														<input type='password' name='c_pass' class="form-control" placeholder="********" required /><br/><br/>
					
													</td>
												</tr>
												</table>
												I agree to the <a href="#" onclick="popup()" >terms and conditions.</a>
												<input type='checkbox' name='agree' class="form-control"  required /><br/><br/>
												<input type='submit' value='Register' /><br/><br/>
												Registered? login to your account <a href="<?php echo $base_url.'member/login'; ?>">Here</a>
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
	<script type="text/javascript">

	function passwordStrength(password)
	{
		var desc = new Array(0);
		desc[0]="very weak";
		desc[1]="very weak";
		desc[2]="very weak";
		desc[4]="very weak";
		desc[4]="very weak";
		desc[5]="very weak";

		var score=0;

		if (password.length >6) score++;
		if (password.match(/[a-z]/)) && (password.match(/[A-Z]/))) score++; 
		if (password.match(/\d+/)) score++;
		if (password.match(/.[!,@,$,%,^,&,*,?,_,~,-(,)]/)) score ++;
		if (password.length > 12) score++;
		document.getElementByid("passwordDescription").innerHTML=desc[score];
		document.getElementByid("passwordStrength").classname="strength" + score;
			}

	</script>
	<style type="text/css">
		#passwordStrength {height: :10px;display: block;float: left;}
		.strength0{width: 250px;background: #cccccc;}
		.strength1{width: 50px;background: #ff0000;}
		.strength2{width: 100px;background: #ff5f5f;}
		.strength3{width: 150;background: #56e500;}
		.strength4{width: 200px;background: #4dcd00;}
		.strength5{width: 250px;background: #399800;}
	</style>
</tr>
</table>
</body>
</html>