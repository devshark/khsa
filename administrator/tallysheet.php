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

<body onload="window.print() ">



	<div id="home_title" align="left">
		TALLY SHEET
	</div>

       	<div>
		     		
			<table border="1" width="75%" style="border-collapse:collapse; " cellspacing="0" cellpadding="0">
				<tr align="center">
                  <td>
						<div id="table-header-title">
							Position
						</div>
					</td>
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
                    <td style="width:inherit">
						<div id="table-header-title">
							First Name
						</div>
					</td>
                    <td>
						<div id="table-header-title">
							Course
						</div>
					</td>
                   
                     <td >
						<div id="table-header-title">
							Party List
						</div>
					</td>
                  	<td >
						<div id="table-header-title">
							Vote Count						
                            </div>
					</td>
                  	
                   
				</tr>
				<?php
				
					$student = mysql_query("select candidates.student_id, students.last_name, students.first_name, students.gender, students.year, students.section, course_id, positions.position, party_list.partylist_name, candidates.partylist_id, candidates.platform, vote_count  FROM sisdb.students, evoting.candidates, evoting.positions, sisdb.students_registrations, evoting.party_list WHERE students.student_id = candidates.student_id and candidates.partylist_id = party_list.partylist_id and candidates.position_id = positions.position_id and students.student_id = students_registrations.student_id  and (positions.position_id like '%$find%' ) order by positions.position_id asc , vote_count desc ");
										
					while($result = mysql_fetch_object($student)){	
					
				?> 
                <tr align="center" >	
                 <td>
                    	<?php echo $result->position;?>
                    </td>			
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
                    	<?php echo $result->course_id;?>
                    </td>
                    
                    <td>
                    	<?php echo $result->partylist_name;?>
                    </td> 
                    <td>
                    	<?php echo $result->vote_count;?>
                    </td>
                   
				</tr>
                <?php 
					}
				?>
                
			</table>
          
	</div>
		
	<table align="center">
		<tr>
					
			<td> 
			
			 
            </td>
		</tr>
	</table>

    </div>
</body>
</html>
