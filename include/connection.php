<?php 	
	$set = new db_settings();
	$host = $set->host;
	$user = $set->user;
	$pass = $set->passwd;
	$dbase = $set->db;
	
	$con = mysql_connect($host,$user,$pass) or die("Could not connect: ".mysql_error());
	mysql_select_db($dbase,$con) or die("Could not connect: ".mysql_error());
?>