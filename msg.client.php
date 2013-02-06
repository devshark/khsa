<?php
session_start();

if(! isset($_GET['id']) )
	die('Invalid request.');

require_once('classes/class.messaging.php');
$msg = Messaging::get_client_messages($_GET['id']);
if( count( $msg ) > 0 )
{
foreach(Messaging::get_client_messages($_GET['id']) as $message)
{?>
<div id="message">
	<p>
	<span><?php echo date('Y-m-d h:i:s',strtotime( $message->date_submitted) );?></span><br/>
	<?php echo $message->comment; ?>
	</p>
</div>
<?php } 
(new Messaging($_GET['id']))->mark_messages_as_read();
}
else{
	echo '<div id="message"><p class="centered">No Messages</p></div>';
}
?>