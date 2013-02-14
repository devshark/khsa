<?php
require_once('classes/class.database.php');

class Status
{
	protected $db;
	const TABLENAME = 'tblstatus';
	
	function __construct()
	{
		$this->db = new Database();
	}

	public static function civil_statuses()
	{
		$db = new Database();
		return $db->get_where(Status::TABLENAME,
			array('type'=>'marital'))->result();
	}

	public static function educ_status()
	{
		$db = new Database();
		return $db->get_where(Status::TABLENAME,
			array('type'=>'educ'))->result();
	}
	
	public static function hire_status()
	{
		$db = new Database();
		return $db->get_where(Status::TABLENAME,
			array('type'=>'hire'))->result();
	}
	
	public static function get_status_name($id)
	{
		$db = new Database();
		return $db->get_where(Status::TABLENAME,
			array('id'=>$id))->row();
	}
	
	// public function__tostring()
	// {
		// return $
	// }
	
}