<?php
require_once('classes/class.database.php');
class Client 
{
	protected $db = null;
	protected $tablename = 'tblclient';
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public static function get_list()
	{
		$db = new Database();
		return $db->get('tblclient')->result();
	}
}