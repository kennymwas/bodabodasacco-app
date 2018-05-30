<?php
	if(isset($_member_name)){
		echo "<td class='style9'style='color: #ffffff;'>USER: ".$_member_name." | ";
		echo "<a href='".$base_url."member/logout'style='color: #ffffff;'>[log out]</a></td>";
	}
?>
<td><a href="<?php echo $base_url ?>home" class="style9" style="color: #ffffff;">Home</a></td>
<td><a href="<?php echo $base_url ?>contact_us" class="style9" style="color: #ffffff;">Contact us</a></td>
<td><a href="<?php echo $base_url ?>site_map" class="style9" style="color: #ffffff;">Site map</a></td>