<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo $title ?: '' ?></title>
</head>

<body>
<div id="sidebar">


<?php 
		$sidebar = "";
		if (isset($_GET['page'])){$sidebar = $_GET['page'];}{?>
		<div id="sidebar-title">CONTACT INFO</div>
		<div id="sidebar-inside" align="center" ><img src="images/khsa_logo.png" width="155px" align="middle" title="KING HENRY SECURITY AGENCY, INC."/><br />
        <font style="text-align:center; font-size:12px; font-weight:bold">
        <center>KING HENRY SECURITY AGENCY, INC.</center></font>
        <font style="font-size:12px">
        <center>3rd Floor ZEN Bldg. No. 75 F. Legaspi St., Maybunga, Pasig City</center>
        <center> Tele/Fax # 576-3537/ Hotline 710-6989/642-7081</center>
      <center>   E-mail:   kinghenry_hcl@yahoo.com</center>
        </font>
        </div>

<?php }?>
</div>
</body>
</html>
