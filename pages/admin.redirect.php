<?php
session_start () ; 
if (! isset($_SESSION['adminid'])) {
header ('location: admin.php');
}
