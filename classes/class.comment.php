<?php

require_once('classes/class.database.php');

class Comments
{
	protected $db = null;
	protected $tablename = 'client_comments';
	
	public $clientid = null;
	public $comment = null;
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function send($clientid, $comment)
	{
		$this->db->insert($this->tablename,
			array('clientid'=>$clientid,
			'comment'=>$comment)
		);
	}
	
}