<?php
require_once('classes/class.database.php');
class Audit
{
	protected $db;
	protected $adminid;

	public function __construct($adminid){
		$this->db = new Database();
		$this->adminid = $adminid;
	}
	
	public function log($message){
		$this->db->insert('tblaudit',
			array('adminid'=>$this->adminid,
			'action'=>$message));
	}
	
	public static function audit_log($id, $message){
		$au = new Audit($id);
		$au->log($message);
	}
}