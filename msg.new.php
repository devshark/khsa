<?php
session_start();

// if(! isset($_SESSION['adminid']) )
	// die('Invalid request.');

require_once('classes/class.messaging.php');
require_once('classes/class.client.php');
$clients = array();
foreach(Messaging::get_unread_messages_client_desc() as $client){
	$clients[$client->clientid] = Client::get_name( $client->clientid );
}
echo json_encode( $clients );