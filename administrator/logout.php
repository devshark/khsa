<?php 
	include "../include/connection.php";
	session_start();
	
	$_SESSION=array();
	unset($_SESSION['userid']);
	session_destroy();
	mysql_close($con);
	header('location:index.php');
	exit;
?>