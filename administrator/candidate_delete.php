<?php

require ("../include/connection.php");

mysql_select_db($dbase2,$con) or die ("Could not connect: ".mysql_error());
session_start();	
	require ('../include/connection.php');
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
		DELETE CANDIDATE
	</div>

    <div align="right" style="margin-right:20px">
    
    <form name="search" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
	Seach: <input type="text" name="find" />
	<input type="submit" name="search" value="Search" />
	</form>
	</div>
    

	<div  class="banner" style="overflow:scroll; background-color:#090;" align="center">
		<?php 
			$find = $_POST['find'];
       
       ?>
       
      		
				<?php
				if(isset($_POST['find'])){
				
					$student = mysql_query("SELECT candidates.student_id, last_name, first_name, gender, year, students.section, course_id, candidates.partylist_id, party_list.partylist_name, candidates.platform FROM evoting.candidates, sisdb.students, sisdb.students_registrations , evoting.party_list WHERE candidates.partylist_id = party_list.partylist_id and  students.student_id = students_registrations.student_id and candidates.student_id = students.student_id and (candidates.student_id = '$find' or students.last_name like '%$find%' or students.first_name like '%$find%' or course_id like '%$find%' ) order by candidates.student_id asc limit 0,1");
										
					while($result = mysql_fetch_object($student)){	
					
			  if (!$result){
				
				echo "Student not Found!";
				
			  }else{
											
				?> 
                
                <table align="center" border="0" width="100%" style="" cellspacing="0" cellpadding="0">
                 <form name="addfrm" method="POST" action="" >
                
				 <tr align="left" height="30px">
					<td style ="padding:2px" colspan="2" height="30px">
					 <div id="table-row">
					Student ID: <input type="text" name="studentid"  readonly="readonly"  size="15" value="<?php echo $result->student_id;?>" />
                     
					</td ><br />
                </tr>
				<tr>
                <td colspan="2">
                <div style="height:10px" id="table-row"></div>
                </td>
                </tr>
               
                <tr align="left">
					<td style ="padding:2px">
					 <div id="table-row">
					 Last Name:&nbsp <input type="text" name="lname" readonly size="18" value="<?php echo $result->last_name;?>" />
                     </div> </td>
                     <td  style="padding:2px">
                     <div id="table-row">
					 First Name: <input type="text" name="fname" readonly size="18" value="<?php echo $result->first_name;?>" />
                     </div>
					</td >
                </tr>
                <tr>
                <td colspan="2">
                <div style="height:10px" id="table-row"></div>
                </td>
                </tr>
                
                   <tr align="left">
					<td style ="padding:2px">
					 <div id="table-row">
					 Gender: &nbsp&nbsp&nbsp <input type="text" name="gender" readonly size="18" value="<?php echo $result->gender;?>" />
                     </div>
					</td >
                    <td style ="padding:2px">
					 <div id="table-row">
					  Year:&nbsp&nbsp&nbsp&nbsp&nbsp  <input type="text" name="year" readonly size="19" value="<?php echo $result->year;?>" />
                     </div>
					</td >
                </tr>
                <tr>
               	 	<td colspan="2">
               			 <div style="height:10px" id="table-row"></div>
               		</td>
                </tr>
                 <tr align="left">
					<td style ="padding:2px">
					 <div id="table-row">
					Section:&nbsp&nbsp&nbsp <input type="text" name="section" readonly size="18" value="<?php echo $result->section;?>" />
                     </div>
					</td >
                    <td style ="padding:2px">
					 <div id="table-row">
					Course: &nbsp&nbsp&nbsp <input type="text" name="course" readonly size="18" value="<?php echo $result->course_id;?>" />
                     </div>
					</td >
                </tr>
                <tr>
                		<td colspan="2">
                			<div style="height:10px" id="table-row"></div>
                		</td>
                </tr>
                <tr align="left" >
					<td colspan="2" style ="padding:2px">
					 <div id="table-row">
					Position:&nbsp;&nbsp;  
                 
                     <select name="selectpos" id="pos" style="width:200px">
                     <option value="1" name="president"> President </option>
                     <option value="2" name="vice_ext"> Vice President External </option>
                     <option value="3" name="vice_int"> Vice President Interal </option>
                     <option value="4" name="secretary"> Secretary </option>
                     <option value="5" name="treasurer"> Treasurer </option>
                     <option value="6" name="auditor"> Auditor </option>
                     <option value="7" name="business"> Business Manager </option>
                     <option value="8" name="pro_am"> PRO AM </option>
                     <option value="9" name="pro_pm"> PRO PM </option>
                     </select>
                     
                     </div>
					</td >
                </tr>
                  <tr>
                		<td colspan="2">
                			<div style="height:10px" id="table-row"></div>
                		</td>
                </tr>
                 <tr align="left">
						<td style ="padding:2px" colspan="2">
						 <div id="table-row">
						Party List: <input type="text" name="partylist"  readonly="readonly"  size="29" value="<?php echo $result->partylist_name; ?>" />
                    	 </div>
					</td >
                    </tr>
                <tr>
                	<td colspan="2">
                		<div style="height:10px" id="table-row"></div>
               		 </td>
                </tr>
                     
     			 <tr align="left">
					<td style ="padding:2px" colspan="2">
					 <div id="table-row">
					Platform: &nbsp; <input type="text" name="platform"  size="29" value="<?php echo $result->platform; ?>"/>
                     </div>
					</td >
                    </tr>
				</tr>
            
             
                
			</table>
            
  
           
	</div>
		
	<table align="center">
		<tr>
			<td>
           
			 <input  type="submit" name="delete" value="Delete" />
             <input  type="submit" name="deleteall" value="Delete All" />
             <a href="main.php"> <input  type="submit" name="cancel" value="Cancel" /></a>
            
   			 </form>
            </td>
            
			
			
		</tr>
        	<?php 
			  }
					}
			}
				?>
                 <?php 
			 $candidateid = $_POST['candidateid'];
			$studentid = $_POST['studentid'];
			$lname = $_POST['lname'];
			$fname = $_POST['fname'];
			$gender = $_POST['gender'];
			$year = $_POST['year'];
			$section = $_POST['section'];
			$course = $_POST['course'];
			$partylist = $_POST['partylist'];
			$position = $_POST['selectpos'];
			$platform = $_POST['platform'];	
			?>
            
<?php 
	if(isset($_POST['deleteall'])){
				
				$sql1 = "TRUNCATE TABLE `candidates` " ;   
			$row1 = mysql_query($sql1);
			
		if($row1) {
			echo ("Delete Successful!");
		}
		else 
			{ 
			die ("Error Deleting Candidates")	;
			}
			}
		
		?>
			
			<?php if(isset($_POST['delete'])){
				
				$sql = "DELETE FROM evoting.candidates WHERE candidates.student_id ='" .$_POST['studentid'] . "' ";   
				
				
				
			$row = mysql_query($sql);
			
		if($row) {
			echo ("Delete Successful!");
		}
		else 
			{ 
			die ("Error Deleting Candidate")	;
			}
			}
		
		?>

	</table>
    
    </div>
</body>
</html>
