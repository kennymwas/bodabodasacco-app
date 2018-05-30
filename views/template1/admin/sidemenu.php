<tr>
<td background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'home'; ?>"><span class="style2" style="color:black">Home</span></a></td>
</tr>
<tr>
<td background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'about_us'; ?>"><span class="style2" style="color:black">About Us</span></a></td>
</tr>
<tr>
<td background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'services'; ?>"><span class="style2" style="color:black">Services</span></a></td>
</tr>
<tr>
<td background="<?php echo $template_path ?>images/b3.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'news'; ?>"><span class="style2" style="color:black">News and Announcements</span></a></td>
</tr>
<tr>
<td background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'contact_us'; ?>"><span class="style2" style="color:black">Contact Us </span></a></td>
</tr>
<?php
if($logged_in==false){
?>
<tr>
<td  background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'member/login'; ?>"><span class="style2" style="color:black">Log In </span></a></td>
</tr>
<?php
}else{
?>
<tr>
<td background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'member/info'; ?>"><span class="style2" style="color:black">Profile</span></a></td>
</tr>
<tr>
<td background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'value_transfer'; ?>"><span class="style2" style="color:black">Value Transfer</span></a></td>
</tr>
<tr>
<td background="<?php echo $template_path ?>images/b1.jpg" height="40"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'member/logout'; ?>"><span class="style2" style="color:black">Log Out </span></a></td>
<tr>
<td background="<?php echo $template_path ?>images/b2.jpg" height="43"><a href="<?php echo $base_url ?>"><br/><img src="<?php echo $template_path ?>images/spacer.gif" width="50" height="8" border="0"></a><a href="<?php echo $base_url.'member/logout'; ?>"><span class="style2" style="color:black">Chat Forum </span></a></td>
</tr>
</tr>
<tr bgcolor="#4A748A"><td>
	<span class="style4">
		<hr/>
		&nbsp;<strong><?php echo $_member_name ?></strong><br/><br/>
		&nbsp;Funds&nbsp;&nbsp;:<?php echo $site_currency.$_fund_balance ?><br/>
		&nbsp;Shares&nbsp;:<?php echo $_share_balance ?><br/>
		[Shares Value: &nbsp;:<?php echo $site_currency.$_share_value ?>]<br/>
		<hr/>
	</span>
</td></tr>
<?php
}
?>