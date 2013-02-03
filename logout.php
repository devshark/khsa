<?php 
$get = isset($_GET['url']) ? $_GET['url'] : '';
session_start();
session_destroy();
if( ! empty($get) )
{
	require_once('classes/class.audit.php');
	Audit::audit_log($_SESSION['adminid'], 'User has logged out');
	
	header('location:'.$get);
}
else
{
	header('location:index.php');
}