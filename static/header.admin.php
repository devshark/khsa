<?php
	@session_start();
	require_once('classes/class.authenticate.php');
	$auth = new Admin($_SESSION['adminid']);
?>
<div id="header">
	<img class="header_image" width="810" src="images/banner.png" />
	<?php if( $auth->type =='admin' ){ ?>
	<ul class="ul-menu six">
		<li><a href="admin.index.php">Home</a></li>
		<li><a href="admin.guards.php">Security Guards</a></li>
		<li><a href="admin.requirements.php">Requirements</a></li>
		<li><a href="admin.client.php">Clients</a></li>
		<li><a href="#">Change Password</a></li>
		<li><a href="logout.php?url=admin.php">Logout</a></li>
	</ul>
	<?php }elseif( $auth->type =='logistic' ){ ?>
		<ul class="ul-menu three">
		<li><a href="admin.index.php">Home</a></li>
		<li><a href="logistics.inventory.php">Equipments</a></li>
		<li><a href="logout.php?url=admin.php">Logout</a></li>
	</ul>
	<?php }?>
</div>