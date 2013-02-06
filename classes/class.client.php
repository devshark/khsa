<?php
require_once('classes/class.database.php');
class Client 
{
	protected $db = null;
	protected static $TABLENAME = 'tblclient';
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public static function get_list()
	{
		$db = new Database();
		return $db->get(self::$TABLENAME)->result();
	}
	
	public static function get_name($id)
	{
		$db = new Database();
		return $db->get_where(self::$TABLENAME,
			array('Client_ID'=>$id))->row()->Client_Name;
	}
}