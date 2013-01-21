<?php 
	session_start();
	
	if(!isset($_SESSION['userid'])){
		header("location:login.php");
	}else{
		header("location:main.php");
	}
?>