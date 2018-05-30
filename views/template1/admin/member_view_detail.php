<html>
<?php include("head.php"); ?>
<body>
<script type="text/javascript" src="<?php echo $template_path ?>admin/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
var main_css = "<?php echo $base_url ?>index/style_css";
var page_text_elements = "page_content";
</script>
<script type="text/javascript" src="<?php echo $template_path ?>admin/jscripts/tiny_mce/def_setup.js"></script>
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
								[<a href="<?php echo $admin_url ?>">Back to Admin home</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>members">Back to member listing</a>]<br/><br/>
								[<a href="<?php echo $admin_url; ?>members/add">Add member</a>]<br/><br/>
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
										<td><br/><br/>
											<!-- content start -->
											<form action='' method="post">
												<table width='100%'>
													<tr width='100%'>
														<td >
															[<a href='<?php echo $admin_url; ?>members/edit/<?php echo $member_id ?>'>Edit member data</a>]<br/><br/>
															<strong>Member Name:</strong><br/>
															<?php echo $member_name ?><br/><br/>
															<strong>National ID:</strong><br/>
															<?php echo $nat_id ?><br/><br/>
															<strong> Membership ID:</strong><br/>
															<?php echo $work_id ?><br/><br/>
															<strong>Member Status:</strong><br/>
															<?php echo $member_status ?><br/><br/>
															<strong>Fund Balance : </strong>
															<?php echo $site_currency.$_fund_balance ?><br/><br/>
															<strong>Share Balance : </strong>
															<?php echo $_share_balance ?> Shares<br/><br/>
															<strong>Share Balance Value : </strong>
															<?php echo $site_currency.$_share_value ?><br/><br/>
															<strong>Value per Share : </strong>
															<?php echo $_value_per_share  ?><br/><br/>
														</td>
													</tr>
													<tr width='100%'>
														<td valign='top' width='50%'>
															<strong><br/><br/>PHONE DATA FOR THIS MEMBER</strong><br/>
															<?php
															if($phone_list_count == 0){
															?>
																No Phone Data added. Click [<a href='<?php echo $admin_url; ?>phone/add'>Here</a>] to add one
															<?php
															}else{
																echo "<table width='500px' class='dotted'>";
																echo "<tr class='bg2'><td><strong>Front Name</strong></td>";
																echo "<td><strong>Detail</strong></td>";
																echo "<td><strong>Visibility</strong></td>";
																echo "<td><strong>Actions</strong></td></tr>";
																foreach($phone_list as $phone){
																	echo "<tr>";
																	echo "<td>".$phone['phone_front_name']."</td>";
																	echo "<td>".$phone['phone_detail']."</td>";
																	if($phone['public']==1){
																		echo "<td>[ <a href='".$admin_url."phone/hide/".$phone['phone_id']."'><span style='color:red'>Public</span></a> ]</td>";
																	}else{
																		echo "<td>[ <a href='".$admin_url."phone/show/".$phone['phone_id']."'><span style='color:green'>Hidden</a></span> ]</td>";
																	}
																	echo "<td>[ <a href='".$admin_url."phone/edit/".$phone['phone_id']."'>Edit</a> ] | ";
																	echo "[ <a href='".$admin_url."phone/delete/".$phone['phone_id']."'><span style='color:red'>Delete</span></a> ]</td>";
																	echo "</tr>";
																}
																echo "</table><br/><br/>";
																echo "Phone Count: ".$phone_list_count."<br/><br/>";
																echo "[ <a href='".$admin_url."phone/add/'>Add phone for this user data</a> ]<br/>";
															}
															?>
														</td>
													</tr>
													<tr width='100%'>
														<td valign='top' width='50%'>
															<strong><br/><br/>EMAIL DATA FOR THIS MEMBER</strong><br/>
															<?php
															if($email_list_count == 0){
															?>
																No Email Data added. Click [<a href='<?php echo $admin_url; ?>email/add'>Here</a>] to add one
															<?php
															}else{
																echo "<table width='500px' class='dotted'>";
																echo "<tr class='bg2'><td><strong>Front Name</strong></td>";
																echo "<td><strong>Detail</strong></td>";
																echo "<td><strong>Visibility</strong></td>";
																echo "<td><strong>Actions</strong></td></tr>";
																foreach($email_list as $email){
																	echo "<tr >";
																	echo "<td>".$email['email_front_name']."</td>";
																	echo "<td>".$email['email_detail']."</td>";
																	if($email['public']==1){
																		echo "<td>[ <a href='".$admin_url."email/hide/".$email['email_id']."'><span style='color:red'>Public</span></a> ]</td>";
																	}else{
																		echo "<td>[ <a href='".$admin_url."email/show/".$email['email_id']."'><span style='color:green'>Hidden</a></span> ]</td>";
																	}
																	echo "<td>[ <a href='".$admin_url."email/edit/".$email['email_id']."'>Edit</a> ] | ";
																	echo "[ <a href='".$admin_url."email/delete/".$email['email_id']."'><span style='color:red'>Delete</span></a> ]</td>";
																	echo "</tr>";
																}
																echo "</table><br/><br/>";
																echo "Email Count: ".$email_list_count."<br/><br/>";
																echo "[ <a href='".$admin_url."email/add'>Add email data for this member</a> ]<br/>";
															}
															?>
														</td>
													</tr>
													<tr width='100%'>
														<td valign='top' width='50%'>
															<strong><br/><br/>KIN DATA FOR THIS MEMBER</strong><br/>
															<?php
															if($kin_list_count == 0){
															?>
																No Kin Data added. Click [<a href='<?php echo $admin_url; ?>kin/add'>Here</a>] to add one
															<?php
															}else{
																echo "<table width='500px' class='dotted'>";
																echo "<tr class='bg2'><td><strong>Name</strong></td>";
																echo "<td><strong>Relation</strong></td>";
																echo "<td><strong>Phone</strong></td>";
																echo "<td><strong>Actions</strong></td></tr>";
																foreach($kin_list as $kin){
																	echo "<tr >";
																	echo "<td>".$kin['kin_name']."</td>";
																	echo "<td>".$kin['kin_relation']."</td>";
																	echo "<td>".$kin['kin_phone']."</td>";
																	echo "<td>[ <a href='".$admin_url."kin/edit/".$kin['kin_id']."'>Edit</a> ] | ";
																	echo "[ <a href='".$admin_url."kin/delete/".$kin['kin_id']."'><span style='color:red'>Delete</span></a> ]</td>";
																	echo "</tr>";
																}
																echo "</table><br/><br/>";
																echo "Kin Count: ".$kin_list_count."<br/><br/>";
																echo "[ <a href='".$admin_url."kin/add'>Add kin data for this member</a> ]<br/>";
															}
															?>
														</td>
													</tr>
													<tr width='100%'>
														<td valign='top' width='50%'>
															<strong><br/><br/>PHYSICAL ADDRESS DATA FOR THIS MEMBER</strong><br/>
															<?php
															if($physicalAddress_list_count == 0){
															?>
																No Physical Address Data added. Click [<a href='<?php echo $admin_url; ?>physicalAddress/add'>Here</a>] to add one
															<?php
															}else{
																echo "<table width='500px' class='dotted'>";
																echo "<tr class='bg2'><td><strong>Front Name</strong></td>";
																echo "<td><strong>City</strong></td>";
																echo "<td><strong>Country</strong></td>";
																echo "<td><strong>Visibility</strong></td>";
																echo "<td><strong>Actions</strong></td></tr>";
																foreach($physicalAddress_list as $physicalAddress){
																	echo "<tr >";
																	echo "<td>".$physicalAddress['phyAddress_front_name']."</td>";
																	echo "<td>".$physicalAddress['phyAddress_city']."</td>";
																	echo "<td>".$physicalAddress['country_name']."</td>";
																	if($physicalAddress['public']==1){
																		echo "<td>[ <a href='".$admin_url."physicalAddress/hide/".$physicalAddress['phyAddress_id']."'><span style='color:red'>Public</span></a> ]</td>";
																	}else{
																		echo "<td>[ <a href='".$admin_url."physicalAddress/show/".$physicalAddress['phyAddress_id']."'><span style='color:green'>Hidden</a></span> ]</td>";
																	}
																	echo "<td>[ <a href='".$admin_url."physicalAddress/edit/".$physicalAddress['phyAddress_id']."'>Edit</a> ] | ";
																	echo "[ <a href='".$admin_url."physicalAddress/delete/".$physicalAddress['phyAddress_id']."'><span style='color:red'>Delete</span></a> ]</td>";
																	echo "</tr>";
																}
																echo "</table><br/><br/>";
																echo "Physical Address Count: ".$physicalAddress_list_count."<br/><br/>";
																echo "[ <a href='".$admin_url."physicalAddress/add'>Add physicalAddress data for this member</a> ]<br/>";
															}
															?>
														</td>
													</tr>
													<tr width='100%'>
														<td valign='top' width='50%'>
															<strong><br/><br/>POSTAL ADDRESS DATA FOR THIS MEMBER</strong><br/>
															<?php
															if($postal_list_count == 0){
															?>
																No Postal Data added. Click [<a href='<?php echo $admin_url; ?>postal/add'>Here</a>] to add one
															<?php
															}else{
																echo "<table width='500px' class='dotted'>";
																echo "<tr class='bg2'><td><strong>Front Name</strong></td>";
																echo "<td><strong>Postal Code</strong></td>";
																echo "<td><strong>Postal City</strong></td>";
																echo "<td><strong>Postal Country</strong></td>";
																echo "<td><strong>Visibility</strong></td>";
																echo "<td><strong>Actions</strong></td></tr>";
																foreach($postal_list as $postal){
																	echo "<tr >";
																	echo "<td>".$postal['postal_front_name']."</td>";
																	echo "<td>".$postal['postal_code']."</td>";
																	echo "<td>".$postal['postal_city']."</td>";
																	echo "<td>".$postal['country_name']."</td>";
																	if($postal['public']==1){
																		echo "<td>[ <a href='".$admin_url."postal/hide/".$postal['postal_id']."'><span style='color:red'>Public</span></a> ]</td>";
																	}else{
																		echo "<td>[ <a href='".$admin_url."postal/show/".$postal['postal_id']."'><span style='color:green'>Hidden</a></span> ]</td>";
																	}
																	echo "<td>[ <a href='".$admin_url."postal/edit/".$postal['postal_id']."'>Edit</a> ] | ";
																	echo "[ <a href='".$admin_url."postal/delete/".$postal['postal_id']."'><span style='color:red'>Delete</span></a> ]</td>";
																	echo "</tr>";
																}
																echo "</table><br/><br/>";
																echo "Postal Count: ".$postal_list_count."<br/><br/>";
																echo "[ <a href='".$admin_url."postal/add'>Add postal data for this member</a> ]<br/>";
																
															}
															?>
														</td>
													</tr>
												</table>
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