<?php

require ("../include/connection.php");
				
	
	mysql_select_db($dbase2,$con) or die("Could not connect: ".mysql_error());
	//session_start();
	$header = ("images/banner.png"); //insert path here for banner ex. "images/apache.png"
	if(!isset($_SESSION['userid'])){
		header("location:index.php");
	}
	
	$login_time = $_SESSION['time-in']; //this is user logged in time in your site
	$timeoutseconds = 60 * 60; // this is particular user session time 15 mins into secs
	$timestamp = time(); // present your systemtime in seconds
	$timeout = $timestamp - $timeoutseconds;
	
	if($login_time < $timeout){
?>
		<script language="javascript">
			alert("Your session has timeout! You're automatically log-out!");
			document.location.href = "<?php echo "logout.php";?>";
		</script>
<?php 
	}else{
		$_SESSION['time-in'] = time();
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/adminstyle.css" type="text/css" rel="stylesheet" />


<title><?php echo $title ?></title>


</head>

<body class="body">




<div align="center" style="background-color:#09F; border:#060 solid; width:600px;">
	<div id="home_title" align="left">
		SECURITY GUARD INFORMATION
	</div>

    <div align="right" style="margin-right:20px">
    
    <form name="search" method="GET" action="<?php $_SERVER['PHP_SELF'] ?>" >
	Seach: <input type="text" name="find" />
	<input type="submit" name="search" value="Search" />
	</form>
	</div>
    

	<div  class="banner" style="overflow:scroll; background-color:#FFFFFF; border:#00CC33 1px solid;" align="center">
		<?php 
			@$find = $_GET['find'];
		?>		
       
       
      		
			<table border="1" width="100%" style="border-collapse:inherit; " cellspacing="0" cellpadding="0">
				<tr align="center">
					<td >
						<div id="table-header-title">
							Employee No
						</div>
					</td> 
					<td>
						<div id="table-header-title">
							Last Name
						</div>
					</td>
                    <td>
						<div id="table-header-title">
							First Name
						</div>
					</td>
                    <td>
						<div id="table-header-title">
							License No.
						</div>
					</td>
                       <td>
						<div id="table-header-title">
						Requirement Status
						</div>
					</td>
                     <td>
						<div id="table-header-title">
						Rank
						</div>
					</td>
                     <td>
						<div id="table-header-title">
						Deployement Status
						</div>
					</td>
                     <td width="5px">
						<div id="table-header-title">
						Client Deployment
						</div>
					</td>
                  
                   
				</tr>
				<?php
				
					$employee = mysql_query("select  employee.emp_num, employee.last_name, employee.first_name, rank.rank_desc, employee_status.emp_stat_id, emp_license.license_num FROM khsa.employee, khsa.emp_license, khsa.rank, khsa.employee_status WHERE employee.emp_num = emp_license.emp_num and rank.rank_id = employee_status.rank_id order by employee.emp_num asc");	
						
					while($result = mysql_fetch_object($employee)){	
					$id = $result->emp_num;
				?> 
                <a title="table" name="table">
				<tr align="center" >				
					<td>
                        
						<?php echo $result->emp_num;?>
					</td>
					<td>
						<?php echo $result->last_name;?>
					</td >
                    <td>
						<?php echo $result->first_name;?>
					</td>
                    <td>
						<?php echo $result->license_num;?>
					</td>
                    <td>
						<?php //echo $result->year;?>
					</td>
                    <td>
						<?php  echo $result->rank_desc;?>
					</td>
                    <td>
                    	<?php  // echo $result->course_id;?>
                    </td>
                    
                    <td>
                    	<?php // echo $result->is_enable;?>
                    </td>  
				</tr>
				<?php 
					}
				?>
                
			</table>
            </a>
	</div>
		
	<table align="center">
		<tr>
			<td>
            <form name="activefrm" method="POST" action="#table">
<a href="activatestudent.php"> <input  type="submit" name="add" value="Add Security Guard" /></a>
             <a href="deactivatestudent.php">  <input  type="submit" name="edit" value="Edit Security Guard" /></a>
                <a href="">  <input  type="submit" name="delete" value="Delete Security Guard" /></a>
          </form> 
            </td>
			
			<td> 
	
		   </td>
		</tr>
	</table>

    </div>
</body>
</html>
