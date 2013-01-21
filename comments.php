<?php
session_start();


if( ! isset($_SESSION['clientid']) || empty($_SESSION['clientid']) )
{
	header('location:login.php');
}

require_once('classes/class.comment.php');
if(isset($_POST['btnPost']))
{
	if( ! empty($_POST['comments']))
	{
		(new Comments())->send($_SESSION['clientid'], $_POST['comments']);
	}
	header('location:'.$_SERVER['HTTP_REFERER']);
}