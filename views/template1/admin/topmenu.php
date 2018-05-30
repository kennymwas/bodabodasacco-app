<?php
	if(isset($_admin_user)){
		echo "<td class='style9'>USER: ".$_admin_user." | ";
		echo "<a href='".$admin_url."home/logout'>[log out]</a></td>";
	}
?>
<td><a href="<?php echo $base_url ?>" class="style9">Home</a></td>
<td><a href="<?php echo $base_url ?>" class="style9">Contact us</a></td>
<td><a href="<?php echo $base_url ?>" class="style9">Site map</a></td>