<?php
session_start();

// if(! isset($_SESSION['adminid']) )
	// die('Invalid request.');

require_once('classes/class.client.php');
$clients = array();
foreach(Client::get_list() as $client){
	$clients[$client->Client_ID] = $client->Client_Name;
}
echo json_encode( $clients );