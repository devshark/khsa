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

if (isset($_POST['interview']))
{
	include('include/connection2.php');
	$nGuardId = $_POST['guardname'];
	if (empty($nGuardId) == false)
	{
		foreach	($nGuardId as $nId)
		{
			$oSelect = "Select `last_name`, `middle_name`, `first_name` From `khsa`.`tblguards` Where `id` = '$nId'";
			$eSelect = mysql_query($oSelect);
			if ($eSelect == false)
			{
				echo "<script> alert('Failed to update system!');</script>";
				header('location:'.$_SERVER['HTTP_REFERER']);
			}
			else
			{
				$datas = mysql_fetch_array($eSelect);
				$sNames .= $datas['first_name']." " .$datas['first_name']." ".$datas['last_name'] ."||";
				//header('location:'.$_SERVER['HTTP_REFERER']);		
			}
		}
		$Names = explode("||", $sNames);
		for ($x = 0; $x < sizeof($Names) - 1 ; $x++)
		{
			(new Comments())->send($_SESSION['clientid'], $Names[$x]." : For Interview");
		}
		header('location:'.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		echo "<script> alert('No Record Selected!');</script>";
		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}


if (isset($_POST['deployment']))
{
include('include/connection2.php');
	$nGuardId = $_POST['guardname'];
	if (empty($nGuardId) == false)
	{
		foreach	($nGuardId as $nId)
		{
			$oSelect = "Select `last_name`, `middle_name`, `first_name` From `khsa`.`tblguards` Where `id` = '$nId'";
			$eSelect = mysql_query($oSelect);
			if ($eSelect == false)
			{
				echo "<script> alert('Failed to update system!');</script>";
				header('location:'.$_SERVER['HTTP_REFERER']);
			}
			else
			{
				$datas = mysql_fetch_array($eSelect);
				$sNames .= $datas['first_name']." " .$datas['first_name']." ".$datas['last_name'] ."||";
				//header('location:'.$_SERVER['HTTP_REFERER']);		
			}
		}

		$Names = explode("||", $sNames);
		for ($x = 0; $x < sizeof($Names) - 1 ; $x++)
		{
			(new Comments())->send($_SESSION['clientid'], $Names[$x]." : For Deployment");
		}
		header('location:'.$_SERVER['HTTP_REFERER']);
	}
	else
	{
		echo "<script> alert('No Record Selected!');</script>";
		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}