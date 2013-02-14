<?php
	@session_start();
	require_once('classes/class.authenticate.php');
	$auth = new Admin($_SESSION['adminid']);
?>
<div id="header">
	<center><img class="header_image" width="810" src="images/banner.png" /></center>
	<?php if( $auth->type =='admin' ){ ?>
	<ul class="ul-menu six">
		<li><a href="admin.index.php">Home</a></li>
		<li><a href="admin.guards.php">201 Files</a></li>
		<li><a href="admin.messaging.php">Message</a></li>
		<li><a href="admin.client.php">Clients</a></li>
		<li><a href="#">Change Password</a></li>
		<li><a href="logout.php?url=admin.php">Logout</a></li>
	</ul>
	<?php }elseif( $auth->type =='logistic' ){ ?>
	<ul class="ul-menu four">
		<li><a href="admin.index.php">Home</a></li>
		<li><a href="logistics.inventory.php">Equipments</a></li>
		<li><a href="admin.client2.php">Clients</a></li>
		<li><a href="logout.php?url=admin.php">Logout</a></li>
	</ul>
	<?php }elseif ( $auth->type =='operation' ) { ?>
	<ul class="ul-menu four">
		<li><a href="admin.index.php">Home</a></li>
		<li><a href="DDO.php">DDO</a></li>
		<li><a href="MDR.php">MDR</a></li>
		<li><a href="logout.php?url=admin.php">Logout</a></li>
	</ul>
	<?php } ?>
</div>