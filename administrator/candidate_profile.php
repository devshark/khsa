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




<div align="center" style="background-color:#090; border:#060 solid; width:600px; height:400px">
	<div id="home_title" align="left">
		CANDIDATE PROFILE
	</div>

    <div align="right" style="margin-right:20px">
    
    <form name="search" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
     <?php  
 require ("../include/connection.php");// we will include our connect.php here  
	$sql = "SELECT * FROM positions";  
  	$result1 = mysql_query($sql);  
 ?>  
 <form method="post" name="can_profile">
  <select name="can_pos">
  <option value="">--Select Position--</option>
    <?php   
	 $can_pos = $_POST['can_pos'];
     while($row = mysql_fetch_array($result1)){  
	 $pos_id = $row['position_id'];
	 
	 
	 if ($_POST['can_pos'] == $row['position_id'])
    {
        $selected = 'selected="selected"';
    }
    else
    {
    $selected = '';
    }
    echo('<option value="'.$row['position_id'].'" ' .$selected. '>'.$row['position'].' </option>');


     } ?> 
   </select>  
   
 	<select name="find" > 
    <option value="0" > ---Select Candidate--- </option>
    <?php 
	
	$find = $_POST['find'];
	$pos = mysql_query("SELECT  candidates.student_id, students.last_name, students.first_name, candidates.position_id FROM evoting.candidates, sisdb.students WHERE candidates.student_id = students.student_id and candidates.position_id = '$can_pos' order by students.last_name");
	
	while($position = mysql_fetch_array($pos)){
	

    if ($_POST['find'] == $position['student_id'])
    {
        $selected = 'selected="selected"';
    }
    else
    {
    $selected = '';
    }
    echo('<option value="'.$position['student_id'].'" ' .$selected. '>'.$position['last_name'].', '.$position['first_name'].' </option>');


     } ?>
    </select>
    
	<input type="submit" name="search" value="Search" />
	</form>
	</div>
    

	<div  class="banner" style="overflow:scroll; background-color:#090;" align="center">
		
       
      		
				<?php
				if(isset($_POST['find'])){
				
					$student = mysql_query("SELECT candidates.student_id, last_name, first_name, gender, year, students.section, course_id, candidates.partylist_id, candidates.platform, positions.position, party_list.partylist_name, candidates.img FROM evoting.candidates, sisdb.students, sisdb.students_registrations, evoting.positions, evoting.party_list  WHERE  students.student_id = students_registrations.student_id and candidates.student_id = students.student_id and candidates.position_id = positions.position_id and party_list.partylist_id = candidates.partylist_id and (candidates.student_id = '$find' and candidates.position_id = '$can_pos' or students.last_name like '%$find%' or students.first_name like '%$find%') order by candidates.student_id asc limit 0,1");
										
					while($result = mysql_fetch_object($student)){	
					
		$img_name = $result->img;
        $image = "<img src='site_images/$img_name' / height='170px' width='195px' alt='picture'><br />";
       
        //store all images in one variable
        $all_img = $all_img . $image;
   
					
					
				?> 
                
                <table align="center" border="0" width="100%" style="" cellspacing="0" cellpadding="0">
                 <form name="addfrm" method="POST" action="" >
                
			<tr align="left" >
					<td style ="height:180px; width:200px; border:2px  #000099 outset;">
					 <div id="table-image" align="center" >
                     <?php echo $all_img;?>
                     </div>
					</td >
                    <td align="left">
                    <div id="table-row" >
					Student ID: &nbsp; <?php echo $result->student_id;?>   </div>
                   </td>
                   <br />
               	</tr>
			<tr>
                <td colspan="2">
                <div style="height:10px" id="table-row"></div>
                </td>
               </tr>
               
                <tr align="left">
					<td style ="padding:2px">
					 <div id="table-row">
					 Last Name:&nbsp <?php echo $result->last_name;?>
                     </div> </td>
                     <td  style="padding:2px">
                     <div id="table-row">
					 First Name: <?php echo $result->first_name;?>
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
					 Gender: &nbsp&nbsp&nbsp <?php echo $result->gender;?>
                     </div>
					</td >
                    <td style ="padding:2px">
					 <div id="table-row">
					  Year:&nbsp&nbsp&nbsp&nbsp&nbsp  <?php echo $result->year;?>
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
					Section:&nbsp&nbsp&nbsp <?php echo $result->section;?>
                     </div>
					</td >
                    <td style ="padding:2px">
					 <div id="table-row">
					Course:&nbsp&nbsp&nbsp <?php echo $result->course_id;?>
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
					Position:&nbsp;&nbsp; <?php echo $result->position; ?>
                                     
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
						Party List: <?php echo $result->partylist_name;?>
						                        
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
					Platform: <?php echo $result->platform; ?>
                     </div>
					</td >
                    </tr>
                    
				</tr>
            
                
			
                
			</table>
            
  
           
	</div>
		
	     	<?php 
					}
				}
				?>

    </div>
</body>
</html>
