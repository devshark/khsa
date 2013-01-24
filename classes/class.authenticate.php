<?php
// require_once('conn/connect.php');
require_once('classes/class.database.php');
class Authenticate
{
	public $Client_ID = null;
	public $pwd = null;
	public $new = true;
	
	protected $conn;
	public static $TABLENAME = 'tblclient';
	
	public function __construct($Client_ID = null)
	{
		$this->conn = new Database();
		$this->new = true;
		if($Client_ID != null)
		{
			$res = $this->conn->get_where(self::TABLENAME,
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
			$result = $this->conn->get_where(self::TABLENAME,
				array('Client_ID'=>$this->Client_ID));
			if($result->num_rows()>0)
			{
				throw new AuthenticateException('User ID already exist!');
			}
			else
			{
				$this->conn->insert(self::TABLENAME,
					array('Client_ID'=>$this->Client_ID,
					'pwd'=>$this->pwd,
					'scope'=>$this->scope));
			}
		}
		// else, update.
		else
		{
			$this->conn->update(self::TABLENAME,
				array('pwd'=>$this->pwd,
				'scope'=>$this->scope),
				array('Client_ID'=>$this->Client_ID));
		}
	}
	
	public static function get_list($order = 'asc')
	{
		$db = new Database();
		return $db->get(Authenticate::$TABLENAME)->result();
	}
	
	public function delete()
	{
		if($this->Client_ID != null)
		{
			$sql = "delete from ".self::TABLENAME." where Client_ID='{$this->Client_ID}';";
			$this->conn->query($sql);
		}
	}
	
	public static function isValid($Client_ID,$pwd)
	{
		try{
			$db = new Database();
			return $db->get_where(Authenticate::$TABLENAME,
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

class Admin
{
	public $is_admin = false;
	public $username = null;
	public $Password = null;
	public $type = null;
	public $new = true;
	
	protected $conn;
	public static $TABLENAME = 'tblclient';
	
	public function __construct($username = null)
	{
		$conn = new Database();
		$this->new = true;
		if($username != null)
		{
			$res = $this->conn->get_where(self::TABLENAME,
				array('Username'=>$username));
			if($res->num_rows() > 0)
			{
				$row = $res->row();
				$this->username = $row->username;
				$this->Password = $row->Password;
				$this->type = strtolower( $row->Account_Type );
				$this->is_admin = $this->type == 'admin';
				$this->new = false;
			}
		}
		return $this;
	}
	
	public function sanitize()
	{
		$this->username = $this->conn->escape($this->username);
		$this->Password = $this->conn->escape($this->Password);
		$this->type = $this->conn->escape($this->type);
	}
	
	public function save()
	{
		// escape the data before inserting
		$this->sanitize();
		
		// validation
		if(trim($this->username) == '' ){throw new AuthenticateException('Username is required.');}
		if( strlen(trim($this->Password)) < 8 ){throw new AuthenticateException('Password should be at least 8 characters long.');}
		
		if($this->new)
		{
			$result = $this->conn->get_where(self::TABLENAME,
				array('username'=>$this->username));
			if($result->num_rows()>0)
			{
				throw new AuthenticateException('Username already exist!');
			}
			else
			{
				$this->conn->insert(self::TABLENAME,
					array('username'=>$this->Client_ID,
					'Password'=>$this->password,
					'Account_Type'=>$this->type));
			}
		}
		// else, update.
		else
		{
			$this->conn->update(self::TABLENAME,
				array('pwd'=>$this->pwd,
				'scope'=>$this->scope),
				array('Client_ID'=>$this->Client_ID));
		}
	}
	
	public static function get_list($order = 'asc')
	{
		$db = new Database();
		return $db->get(Authenticate::$TABLENAME)->result();
	}
	
	public function delete()
	{
		if($this->Client_ID != null)
		{
			$sql = "delete from ".self::TABLENAME." where Client_ID='{$this->Client_ID}';";
			$this->conn->query($sql);
		}
	}
	
	public static function isValid($Client_ID,$pwd)
	{
		try{
			$db = new Database();
			return $db->get_where(Authenticate::$TABLENAME,
				array('Client_ID'=>$Client_ID,
				'pwd'=>$pwd))->num_rows() == 1;
		}catch(Exception $e)
		{
			throw new AuthenticateException($e.getMessage());
		}
	}
}