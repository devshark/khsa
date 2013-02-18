<?php
require_once('classes/class.database.php');

$db = new Database();
$columns = $db->query('SHOW COLUMNS FROM tblclient;');
$filename ="clients.xls";
$contents = "Client_ID \t Client_Name \t Address \t Contact_No \t Contact_person \t Owner \t \n";
$contents = '';
foreach($columns->result() as $column)
{
	$contents .= $column->Field."\t";
}
$contents .= "\n";

$data = '';
$clients = $db->query('select * from tblclient;');
foreach($clients->result() as $client)
{
	$data .= $client->Client_ID . "\t";
	$data .= $client->pwd . "\t";
	$data .= $client->Client_Name . "\t";
	$data .= $client->Address . "\t";
	$data .= $client->Contact_No . "\t";
	$data .= $client->Contact_person . "\t";
	$data .= $client->Owner . "\t";
	$data .= "\n";
}
$contents .= $data;
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $contents;
 ?>