<?php
// require_once('conn/connect.php');
require_once('classes/class.database.php');
class Authenticate
{
	public $is_admin = false;
	public $Client_ID = null;
	public $pwd = null;
	public $new = true;
	
	protected $conn;
	protected $tablename = 'tblclient';
	
	public function __construct($Client_ID = null)
	{
		$this->conn = new Database();
		$this->new = true;
		if($Client_ID != null)
		{
			$res = $this->conn->get_where($this->tablename,
				array('Client_ID'=>$Client_ID));
			if($res->num_rows() > 0)
			{
				$row = $res->row();
				$this->Client_ID = $row->Client_ID;
				$this->pwd = $row->pwd;
				$this->new = false;
			}
		}
		return $this;
	}
	
	public function sanitize()
	{
		$this->Client_ID = $this->conn->escape($this->Client_ID);
		$this->pwd = $this->conn->escape($this->pwd);
		$this->scope = $this->conn->escape($this->scope);
	}
	
	public function save()
	{
		// escape the data before inserting
		$this->sanitize();
		
		// validation
		if(trim($this->Client_ID) == '' ){throw new AuthenticateException('User ID is required.');}
		if( strlen(trim($this->pwd)) < 8 ){throw new AuthenticateException('Password should be at least 8 characters long.');}
		
		// if Client_ID is null, it is a new record, so insert.
		if($this->new)
		{
			$result = $this->conn->get_where($this->tablename,
				array('Client_ID'=>$this->Client_ID));
			if($result->num_rows()>0)
			{
				throw new AuthenticateException('User ID already exist!');
			}
			else
			{
				$this->conn->insert($this->tablename,
					array('Client_ID'=>$this->Client_ID,
					'pwd'=>$this->pwd,
					'scope'=>$this->scope));
			}
		}
		// else, update.
		else
		{
			$this->conn->update($this->tablename,
				array('pwd'=>$this->pwd,
				'scope'=>$this->scope),
				array('Client_ID'=>$this->Client_ID));
		}
	}
	
	public static function get_list($order = 'asc')
	{
		$db = new Database();
		return $db->get('tblclient')->result();
	}
	
	public function delete()
	{
		if($this->Client_ID != null)
		{
			$sql = "delete from {$this->tablename} where Client_ID='{$this->Client_ID}';";
			$this->conn->query($sql);
		}
	}
	
	public static function isValid($Client_ID,$pwd)
	{
		try{
			$db = new Database();
			return $db->get_where('tblclient',
				array('Client_ID'=>$Client_ID,
				'pwd'=>$pwd))->num_rows() == 1;
		}catch(Exception $e)
		{
			throw new AuthenticateException($e.getMessage());
		}
	}
}

class AuthenticateException extends Exception
{
	public function __construct($message){ parent::__construct($message); }
}