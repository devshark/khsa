<?php
/*
* Class ni Marie Angelica Alzola
*
*/

require_once('classes/class.database.php');
class Equipment
{
	protected $db = null;
	protected static $TABLENAME = 'tblequipment';
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public static function get_list()
	{
		$db = new Database();
		return $db->get(Equipment::$TABLENAME)->result();
	}
}