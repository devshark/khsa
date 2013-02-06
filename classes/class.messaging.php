<?php
require_once('classes/class.database.php');
class Messaging{
	
	protected $db;
	public static $TABLENAME = 'client_comments';
	protected $client_id;
	
	public function __construct($client_id=null)
	{
		$this->db = new Database();
		$this->client_id = $client_id;
	}
	
	public function get_messages(){
		return $this->db->get_where(self::$TABLENAME,
			array('clientid'=>$this->client_id))->result();
	}
	
	public static function get_client_messages($client_id)
	{
		return (new Messaging($client_id))->get_messages();
	}
	
	public static function get_unread_messages_client_desc(){
		$db = new Database();
		return array_reverse( $db->get_where(self::$TABLENAME,
			array('`read`'=>'0'))->result() );
	}
	
	public function mark_messages_as_read(){
		$this->db->update(self::$TABLENAME,
			array('`read`'=>'1'),
			array('clientid'=>$this->client_id));
	}
	
}