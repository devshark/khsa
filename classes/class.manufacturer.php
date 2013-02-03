<?php
/*
* Class ni Marie Angelica Alzola
*
*/

require_once('classes/class.database.php');
class Manufacturer
{
	protected $db = null;
	protected static $TABLENAME = 'tblmanufacturer';
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public static function get_list()
	{
		$db = new Database();
		return $db->get(self::$TABLENAME)->result();
	}
	
	public static function get_name ($id)
	{
		$db = new Database();
		return $db->get_where(self::$TABLENAME,
			array('Manufacturer_ID'=>$id))->row()->Manufacturer_Name;
	}
}