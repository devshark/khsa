<?php @session_start();?>
			<div id="header">
				<center><img class="header_image" width="810" src="images/banner.png" /></center>
				<ul class="ul-menu <?php echo $_SESSION['clientid'] ? 'five' : '';?>">
					<li><a href="index.php">Home</a></li>
					<li><a href="company_profile.php">Company Profile</a></li>
					<li><a href="client.list.php">Lists</a></li>
					<?php if(isset($_SESSION['clientid'])) { ?>
					<li><a href="guard.list.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
					<?php } else{ ?>
					<li><a href="login.php">Login</a></li>
					<?php } ?>
				</ul>
			</div>