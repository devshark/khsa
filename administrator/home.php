<?php
//session_start();
require ("../include/connection.php");

$date = date("D-M-d-Y");

$user = $_SESSION['name'];

$admin_query = mysql_query("select * from admin WHERE id = $_SESSION[userid]");
$admin = mysql_fetch_object($admin_query);			
$_SESSION['name'] = $admin->name;		 
$_SESSION['userid'] = $admin->id;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../css/adminstyle.css"  rel= "stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title ?></title>
</head>

<body class="home_page">
<!-- <div style="position:absolute" id="home_page"> -->
	<table width="400" align="center" class = "home_page" >
    	<tr>
          <td colspan="3" align="right">
             Date: <?php echo $date ?>
    	  </td>
          </tr>
          <tr style="border:#006600 2px solid">
          <td colspan="2" align="left" style="color:#000; background:-moz-linear-gradient(left, #06F, #09F); border:#030 solid 2px">
          <font size="3px" style="color:#000; font:'Arial Black', Gadget, sans-serif; "  > " Welcome <?php echo $user ?> " </font>

    	  </td>
        </tr>
        
        <tr>
         <td colspan="3" align="center" style="font:Verdana, Geneva, sans-serif; font-size:18px;  color:#0000FF;"><h3>KING HENRY SECURITY AGENCY, INC.</h3>
            </td>
          </tr>
            <tr>
            <td colspan="3" align="center">
            <img src="../images/banner2.png" height=" 150px" width="400px" style = "border:2px solid #060;" alt="ptc picture" title="Supreme Student Council" />
            
              </td>
   			  </tr>
              
              		<tr>
              			<td height="5px">
              			</td>
              		</tr>
        
           	 <tr style="width:400px" align="center">
            <td width="400px">
           </div>
           <div style="width:600px; background-color:#FFFFFF; border:2px  #006600 solid; padding:5px;" align="center">
            	<p align="center" style="font:'Times New Roman', Times, serif;"><font style="text-align:center; font-size:18px; font-weight:bold; color:#00F">VISION</font><br/>
          	  </p>
<p align="center" style="font:'Times New Roman', Times, serif; color:#666; padding:0px 5px 5px 0px">
        To be a leading Agency with a clear focus on the constantly changing perspective of security. 
         </p>
         <p align="center" style="font:'Times New Roman', Times, serif;"><font style="text-align:center; font-size:18px; font-weight:bold; color:#00F">MISSION</font><br/>
          	  </p>
<p align="center" style="font:'Times New Roman', Times, serif; color:#666; padding:0px 5px 5px 0px">
            To deliver and provide our valued clientele with:<br /><br />
			Quality and efficient service.<br />
            Superior performance level of security personnel and to;<br />
			Contribute to the upliftment of the security industry thru professionalization and <br />
			Infusion of	good moral values to the guards.

         </p>
               </div>
         </td>
        </tr>
    </table>

<!-- </div> -->

</body>
</html>