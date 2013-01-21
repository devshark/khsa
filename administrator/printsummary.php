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
		SUMMARY REPORT
	</div>
    
  <div>    
  <?php 
//GET THE SUM FROM THE RATES COLUMN
$query=mysql_query("SELECT COUNT(student_id) as total_voters from students WHERE is_enable = 2");

//DECLARE AN ARRAY TO GET YOUR VALUE
$total_voters=mysql_fetch_object($query);

$query2=mysql_query("SELECT COUNT(student_id) as total_students from students");
$total_students=mysql_fetch_object($query2);

$query3=mysql_query("SELECT COUNT(student_id) as total_not_voted from students WHERE is_enable = 0");
$not_vote  = mysql_fetch_object($query3);


//GET THE VALUE FROM THE ARRAY
$students =  $total_students->total_students;
$voters = $total_voters->total_voters;
$average=($voters*100/$students);

//GET THE TOTAL NUMBER OF ROWS IN THE QUERY
//ASSUMING ALL ROWS HAVE A VALUE FOR RATES

$vote=mysql_query("SELECT SUM(candidates.vote_count) as total_vote from evoting.candidates");
$totalvote =mysql_fetch_object($vote);

?>
<table border="1" width="50%" style="border-collapse:collapse; " cellspacing="5" cellpadding="5">
				<tr>				
					<td>
                    <div id="table-header-title">
							 Total Vote Count :
						</div>
                       
					</td>
                    <td style="margin-left:5px"><?php echo $totalvote->total_vote ?>
                    </td>
                </tr>
                <tr>
                     <td><div id="table-header-title">
							 Total Students  Who Voted :
						</div>
                     </td>
                     <td>
					 	 <?php echo $total_voters->total_voters ?>
					</td>
                </tr>   
                <tr> 
					<td><div id="table-header-title">
							Total Students Who Did not Voted : 
						</div>
                    
                   	 	</td>
                    	<td><?php echo $not_vote->total_not_voted ?>
					</td >
                </tr>
                <tr>    
                    <td><div id="table-header-title">
							  Total Number of Student :
						</div>
                   </td>
                    <td>
						<?php echo $total_students->total_students ?>
					</td>
                </tr>
                    <td><div id="table-header-title">
							 Percentage of Voters:
						</div>
                    </td>
					<td style="size:5">	
						<?php echo ($average) ?> %
					</td>
                                      
                   
				</tr>
			                
              </table>
          
	</div>


 
</body>
</html>
