<?php
ini_set('display_errors','Off');
error_reporting(E_ERROR);
session_start () ; 
if (! isset($_SESSION['adminid'])) {
header ('location: admin.php');
}
