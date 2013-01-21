<?php

require ("../include/connection.php");
				
	
	mysql_select_db($dbase2,$con) or die("Could not connect: ".mysql_error());
	session_start();
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

<body onLoad="window.print() ">




<div id="home_title" align="left">
		STUDENTS LIST
	</div>
    
  <div>    
       		<table border="1" width="75%" style="border-collapse:collapse; " cellspacing="0" cellpadding="0">
				<tr align="center">
					<td >
						<div id="table-header-title">
							Student ID
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
							Gender
						</div>
					</td>
                       <td>
						<div id="table-header-title">
							Year
						</div>
					</td>
                     <td>
						<div id="table-header-title">
							Section
						</div>
					</td>
                     <td>
						<div id="table-header-title">
							Course
						</div>
					</td>

				</tr>
				<?php
				
					$student = mysql_query("select students.student_id, last_name, first_name, gender, year, students.section, course_id, is_enable FROM students, students_registrations WHERE students.student_id = students_registrations.student_id   order by last_name");
										
					while($result = mysql_fetch_object($student)){	
					$id = $result->student_id;
				?> 
                <a title="table" name="table">
				<tr align="center" >				
					<td>
                        
						<?php echo $result->student_id;?>
					</td>
					<td>
						<?php echo $result->last_name;?>
					</td >
                    <td>
						<?php echo $result->first_name;?>
					</td>
                    <td>
						<?php echo $result->gender;?>
					</td>
                    <td>
						<?php echo $result->year;?>
					</td>
                    <td>
						<?php echo $result->section;?>
					</td>
                    <td>
                    	<?php echo $result->course_id;?>
                    </td>
                    
                   
				</tr>
				<?php 
					}
				?>
                
                <tr>
                <td colspan="7">
               <?php $query=mysql_query("SELECT COUNT(student_id) as total_voters from students ");

//DECLARE AN ARRAY TO GET YOUR VALUE
$total_voters=mysql_fetch_object($query);
?>
Total Students  Who Voted: <?php echo $total_voters->total_voters ?><br/>
                </td>
                </tr>
			</table>
            </a>
	</div>


    </div>
</body>
</html>
