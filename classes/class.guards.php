<?php
require_once('classes/class.database.php');
class Guard 
{
	protected $db = null;
	protected $tablename = 'tblemployee';
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function search( $filters = array() )
	{
		return $this->db->get_where($this->tablename,$filters)->result();
	}
	
	public static function get_list()
	{
		$db = new Database();
		return $db->get('tblemployee')->result();
	}
}