<?php  include ("../include/connection.php");
include ("main.php");
?>

<html>
<body>

<div style="border:#0000 1px solid; padding:2px; background:#FFFFFF" align="center">
			<table class="body_content" cellpadding="0" cellspacing="0">
				<tr>
					<td width="200px" valign="top">
						<?php
							include "sidebar.php";
						?>
                        <?php 
						include "sidebar2.php";
						?>
					</td>
					<td valign="top">
						<?php
						
			 				if($_GET['page'] == "home" or $_GET['page'] == ""){
								include "home.php";
							}else if($_GET['page'] == "home"){
								include "home.php";
							}						
						?>
					</td>
				</tr>
			</table>
		</div>
		<br /><br />
		<div align="center">
			Copyright 2012 <br/>
            Pateros Technological College<br />
            Electronic Voting System
		</div>