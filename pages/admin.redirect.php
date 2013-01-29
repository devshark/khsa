<?php
// ini_set('display_errors','Off');
ini_set('display_errors','On');
// error_reporting(E_ERROR);
error_reporting(E_ALL);
session_start () ; 
if (! isset($_SESSION['adminid'])) {
header ('location: admin.php');
}
