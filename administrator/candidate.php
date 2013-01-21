<?php

require ("../include/connection.php");

mysql_select_db($dbase2,$con) or die ("Could not connect: ".mysql_error());

session_start();
	
$header = ("../images/banner.png"); //insert path here for banner ex. "images/apache.png"
	
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




<div align="center" style="background-color:#090; border:#060 solid; width:600px;">
	<div id="home_title" align="left">
		CANDIDATE INFORMATION
	</div>

    <div align="right" style="margin-right:20px">
    
    <form name="search" method="GET" action="<?php $_SERVER['PHP_SELF'] ?>" >
	Seach: <select name="find">
    <?php 
			$find = $_GET['find'];
		?>		
    <option value="">Please Select Position</option>
     <option value="1" name="president" "<?php if ($find == 1) {  echo "selected" ; } ?>"> President </option>
     <option value="2" name="vice_ext"  "<?php if ($find == 2) {  echo "selected" ; }?>"  > Vice President External </option>
     <option value="3" name="vice_int"   "<?php if ($find == 3) {  echo "selected" ; }?>"  > Vice President Interal </option>
     <option value="4" name="secretary" "<?php if ($find == 4) {  echo "selected" ; }?>" > Secretary </option>
     <option value="5" name="treasurer" "<?php if ($find == 5) {  echo "selected" ; }?>"  > Treasurer </option>
     <option value="6" name="auditor"   "<?php if ($find == 6) {  echo "selected" ; }?>" > Auditor </option>
     <option value="7" name="business"  "<?php if ($find == 7) {  echo "selected" ; }?>" > Business Manager </option>
      <option value="8" name="pro_am"   "<?php if ($find == 8) {  echo "selected" ; }?>"  > PRO AM </option>
      <option value="9" name="pro_pm"   "<?php if ($find == 9) {  echo "selected" ; }?>" > PRO PM </option>
      </select>
	<input type="submit" name="search" value="Search" />
	</form>
	</div>

	<div  class="banner" style="overflow:scroll; background-color:#FFFFFF; border:#00CC33 1px solid;" align="center">
		
       
       
      		
			<table border="1" width="100%" style="border-collapse:collapse; " cellspacing="0" cellpadding="0">
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
                    <td style="width:inherit">
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
                     <td>
						<div id="table-header-title">
							Position
						</div>
					</td>
                     <td >
						<div id="table-header-title">
							Party List
						</div>
					</td>
                  	<td >
						<div id="table-header-title">
							Platform
						</div>
					</td>
                  	
                   
				</tr>
				<?php
				
					$student = mysql_query("SELECT candidates.student_id, students.last_name, students.first_name, students.gender, students.year, students.section, course_id, positions.position, party_list.partylist_name, candidates.platform  FROM sisdb.students, evoting.candidates, evoting.positions, sisdb.students_registrations, evoting.party_list WHERE students.student_id = candidates.student_id and candidates.position_id = positions.position_id and students.student_id = students_registrations.student_id  and party_list.partylist_id = candidates.partylist_id and ( positions.position_id like '%$find%' ) order by positions.position_id asc");
										
					while($result = mysql_fetch_object($student)){	
					
				?> 
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
                    
                    <td>
                    	<?php echo $result->position;?>
                    </td> 
                    <td>
                    	<?php echo $result->partylist_name;?>
                    </td> 
                    <td>
                    	<?php echo $result->platform;?>
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
          <form name="activefrm" method="POST" action="#table">
 		  <a href="candidateadd.php"><input  type="submit" name="add" value="Add Candidate" /></a>
          <a href="candidateedit.php"> <input  type="submit" name="edit" value="Edit Candidate" /></a>
           <a href="candidatedelete.php"> <input  type="submit" name="delete" value="Delete Candidate" /></a>
          </form>
            </td>
			
			<td> 
			
			 
            </td>
		</tr>
	</table>

    </div>
</body>
</html>
