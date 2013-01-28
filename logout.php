<?php 
	$get = isset($_GET['url']) ? $_GET['url'] : '';
	session_start();
	session_destroy();
	if( ! empty($get) )
	{
		header('location:'.$get);
	}
	else
	{
		header('location:index.php');
	}
?>