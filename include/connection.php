<?php 	
	$host 		= "localhost";
	$user 		= "root";
	$pass	 	= "admin";
	$dbase		= "evoting";
	//$dbase		= "khsa";
	$dbase2		= "sisdb";
	$title		= "KHSA INTEGRATED SYSTEM";
	
	$con = mysql_connect($host,$user,$pass) or die("Could not connect: ".mysql_error());
	mysql_select_db($dbase,$con) or die("Could not connect: ".mysql_error());
?>