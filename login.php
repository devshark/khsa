<?php
session_start();
require_once('classes/class.authenticate.php'); 
?>
<?php
	$error_message = '';
	if(isset($_POST['enter'])){
		$id = ($_POST['id'] ?: '');
		$pwd = ($_POST['pwd'] ?: '');
		try{
			if( ! Authenticate::isValid($id, $pwd)){
				throw new AuthenticateException('Username and password does not match!');
			}else{
				$_SESSION['clientid'] = $id;
			}
		}catch(AuthenticateException $authEx){
			$error_message = $authEx->getMessage();
		}
	}else{
		$error_message = '';
	}
	
	if(isset($_SESSION['clientid'])){
		header("location:main.php");
	}
	?>

    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KING HENRY SECURITY AGENCY, INC.</title>
</head>
<link type="text/css" rel="stylesheet" href="css/style.css" />
<body class="body">
<center>
<div class="wrapper" align="center" >
		<table class="header" style="border-bottom:2px solid;" cellspacing="0" cellpadding="0" >
			<tr>
				<td>
					<img class="header_image" src="images/banner.png" />
				</td>
			</tr>
		</table>
  <body class="body">
	<center>
	<div class="wrapper" align="center"  >
		<table class="header" style="border-bottom:1px solid;" cellspacing="0" cellpadding="0">
	</table>
		
		<div style= "margin-top:20px; width:330px; padding:10px; border-color:#000000;">
			<div style=" border:6px groove #000 ">
            <table width="330px" cellpadding="0" cellspacing="1px" style="color:#000;">
				<tr align="center">
					<td colspan="2" style="font-family:'Times 'Times New Roman', Times, serif', Courier, monospace; font-size:24px; color:#000; font-weight:bold; margin-top: 5px;">
						KING HENRY SECURITY AGENCY, INC.
					</td>
				</tr>
				<tr align="center">
					<td colspan="2">
						<hr width="310" size="1px" noshade="noshade"/>
					</td>
				</tr>
				<tr>
					<td colspan="2"><br /></td>
				</tr>
				<form method="post" action="login.php">
				<tr>
					<td align="right" width="120px" style="padding-right:10px;">Client Code:</td>
					<td><input type="text" name="id" value="" /></td>
				</tr>
				<tr>
					<td align="right" width="120px" style="padding-right:10px;">Password:</td>
					<td><input type="password" name="pwd" value="" /></td>
				</tr>
                <tr height="5px">
					<td align="center" style="color:red;" colspan=2>
				<?php echo $error_message;?>
					</td>
				</tr>
				
				<tr align="center">
					<td colspan="2">
						<hr width="310" size="1px" noshade="noshade"/>
		 			</td>
				</tr>
				<tr>
					<td align="center" colspan="2" style="padding:3px">
						<input style = "margin-left: 10px; margin-bottom: 10 px;" type="submit" name="enter" value="Enter"/>
					</td>
				</tr>
				</form>
				
			</table>
          </div>
	  </div>
		<table align="center">
        <form method = "post">
        <tr >
        <td style="height:10px" align="center" >
        <input type="hidden" name = "activate" value="<?php echo $activate ?>" />
        </td>
        </tr>
        </form>
        </table>
	</div>
	</center>
</body>


</body>
</html>