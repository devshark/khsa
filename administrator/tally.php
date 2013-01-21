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
<noscript>
<!--
    We have the "refresh" meta-tag in case the user's browser does
    not correctly support JavaScript or has JavaScript disabled.

    Notice that this is nested within a "noscript" block.
-->
<meta http-equiv="refresh" content="3">

</noscript>
<script language="JavaScript">
<!--

var sURL = unescape(window.location.pathname);

function doLoad()
{
    // the timeout value should be the same as in the "refresh" meta-tag
    setTimeout( "refresh()", 3*1000 );
}

function refresh()
{
    //  This version of the refresh function will cause a new
    //  entry in the visitor's history.  It is provided for
    //  those browsers that only support JavaScript 1.0.
    //
    window.location.href = sURL;
}
//-->
</script>

<script language="JavaScript1.1">
<!--
function refresh()
{
    //  This version does NOT cause an entry in the browser's
    //  page view history.  Most browsers will always retrieve
    //  the document from the web-server whether it is already
    //  in the browsers page-cache or not.
    //  
    window.location.replace( sURL );
}
//-->
</script>

<script language="JavaScript1.2">
<!--
function refresh()
{
    //  This version of the refresh function will be invoked
    //  for browsers that support JavaScript version 1.2
    //
    
    //  The argument to the location.reload function determines
    //  if the browser should retrieve the document from the
    //  web-server.  In our example all we need to do is cause
    //  the JavaScript block in the document body to be
    //  re-evaluated.  If we needed to pull the document from
    //  the web-server again (such as where the document contents
    //  change dynamically) we would pass the argument as 'true'.
    //  
    window.location.reload( false );
}
//-->
</script>

<!--
    Use the "onload" event to start the refresh process.
-->
<body onLoad="doLoad()">

<script language="JavaScript">
<!--
    // we put this here so we can see something change
    document.write('<b>' + (new Date).toLocaleString() + '</b>');
//-->
</script>


</head>

<body class="body">




<div align="center" style="background-color:#090; border:#060 solid; width:600px;">
	<div id="home_title" align="left">
		TALLY SHEET
	</div>

    <div align="right" style="margin-right:20px">
    
    <form name="search" method="GET" action="<?php $_SERVER['PHP_SELF']; ?>" >
	Seach:<select name="find" id="candidate" style="width:200px">
    	<option value="" name= "">--Please Select Candidate--</option>
        <option value="1" name="president"  "<?php if ($find == 1) {  echo "selected" ; } ?>"> President </option>
        <option value="2" name="vice_ext"  "<?php if ($find == 2) {  echo "selected" ; } ?>"> Vice President External </option>
        <option value="3" name="vice_int"  "<?php if ($find == 3) {  echo "selected" ; } ?>"> Vice President Interal </option>
        <option value="4" name="secretary" "<?php if ($find == 4) {  echo "selected" ; } ?>"> Secretary </option>
        <option value="5" name="treasurer" "<?php if ($find == 5) {  echo "selected" ; } ?>"> Treasurer </option>
        <option value="6" name="auditor" "<?php if ($find == 6){  echo "selected" ; } ?>"> Auditor </option>
        <option value="7" name="business" "<?php if ($find == 7) {  echo "selected" ; } ?>"> Business Manager </option>
        <option value="8" name="pro_am" "<?php if ($find == 8) {  echo "selected" ; } ?>"> PRO AM </option>
        <option value="9" name="pro_pm" "<?php if ($find == 9) {  echo "selected" ; } ?>"> PRO PM </option> 
	<input type="submit" name="search" value="Search" />
	</form>
	</div>

	<div  class="banner" style="overflow:scroll; background-color:#FFFFFF; border:#00CC33 1px solid;" align="center">
		<?php 
			$find = $_GET['find'];
		?>		
       
       
      		
			<table border="1" width="100%" style="border-collapse:collapse; " cellspacing="0" cellpadding="0">
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
							Vote Count</div>
					</td>
                  	
                   
				</tr>
				<?php
				
					$student = mysql_query("select candidates.student_id, students.last_name, students.first_name, students.gender, students.year, students.section, course_id, positions.position, party_list.partylist_name, candidates.partylist_id, candidates.platform, vote_count  FROM sisdb.students, evoting.candidates, evoting.positions, sisdb.students_registrations, evoting.party_list WHERE students.student_id = candidates.student_id and candidates.partylist_id = party_list.partylist_id and candidates.position_id = positions.position_id and students.student_id = students_registrations.student_id  and (positions.position_id like '%$find%' ) order by candidates.position_id, vote_count desc");
										
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
