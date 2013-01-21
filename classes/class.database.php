<?php
require_once('classes/class.db.settings.php');
require_once('classes/security.php');
class Database
{
	protected $_conn;
	protected $_resource = null;
	
	public $sql = null;
	
	private $_log = array();				
	private $_log_file = null;
	//protected $_settings = array('user'=>'root','password'=>'','host'=>'localhost','database'=>'','port'=>3306);
	protected $_settings = null;
	protected $_security = null;
	function __construct($settings = array())
	{
		$this->_log_file = 'logs/dblogs ' . date('m-d-Y') . '.txt';
		$this->_settings = new db_settings();
		$this->_security = new Security();
		$this->set_settings($settings);
		$this->log("instanciated database class");
	}
	
	function __destruct()
	{
		//$this->close();
	}
	
	function close()
	{
		mysql_close($this->_conn);
	}
	
	function set_settings($settings)
	{
		if(is_array($settings))
		{
			foreach($settings as $key=>$value)
			{
				$this->_settings->$key = $value;
			}
		}
		else
		{
			$this->_settings->db = $settings;
		}
		$this->log('set database settings : ' . print_r($settings,true));
		$this->_connect();
	}
	
	function log($message){
		//$this->_log[] = date('m-d-y h:m:s') . " " . $message;
		try{
			$log = date('m-d-y h:m:s') . " " . $message;
			$contents = null;
			if( ! file_exists('logs/') OR ! is_dir('logs/')){
				mkdir('logs/');
			}						
			$fh = fopen($this->_log_file,'a');
			fwrite($fh,$log."\n");
			fclose($fh);
			// if( ! file_exists($this->_log_file)){
				// $fh = fopen($this->_log_file,'w');
				// fwrite($fh,$log);
				// fclose($fh);
			// }else{
				// $fr = fopen( $this->_log_file , 'r');
				// $contents = fread( $fr , filesize($this->_log_file));
				// $contents .= $log . "\n";
				// fclose($fr);
				// $fw = fopen( $this->_log_file , 'w');
				// fwrite($fw,$contents);
				// fclose($fw);
			// }
		}catch(Exception $e){
			var_dump($e);
		}
		return;
	}
	
	function _connect()
	{	
		$this->log('started connection to database');
		$host = $this->_settings->host;
		$user = $this->_settings->user;
		$password = $this->_settings->passwd;
		$db = $this->_settings->db;
		$this->_conn = mysql_connect($host,$user,$password) or die("Could not connect to host." . $this->log(mysql_error($this->_conn)));
		mysql_select_db($db,$this->_conn) or die("Database error." . $this->log(mysql_error($this->_conn)));
		
		$this->log('connection successful');
	}
	
	protected $_queries = array();
	
	function go()
	{
		foreach($this->_queries as $sql)
		{
			$this->query($sql);
		}
		unset($this->_queries);
	}
	
	function query($sql)
	{
		
		$this->sql = $sql;
		$this->log('query executed : ' . $sql);
		$this->_resource = mysql_query( $sql, $this->_conn) or die("Query error." . mysql_error() . $this->__tostring());
		return $this;
	}
	
	function result_object()
	{
		if($this->_resource===null){return array();}
		else
		{
			$result=array();
			while($row = mysql_fetch_object($this->_resource))
			{
				$result[] = $row;
			}
			return $result;
		}
	}
	
	function result_array()
	{
		if($this->_resource===null){return array();}
		else
		{
			while($row = mysql_fetch_array($this->_resource))
			{
				$result[] = $row;
			}
			return $result;
		}
	}
	
	function num_rows()
	{
		return (int) mysql_num_rows($this->_resource);
	}
	
	function insert( $table, $fields)
	{
		$query_fields = null;
		$query_values = null;
		if(is_array($fields))
		{
			foreach($fields as $key=>$value)
			{
				$query_fields .= $key . ',';
				$query_values .= "'" . $this->escape($value) . "',";
			}
			$query_fields = substr($query_fields,0,strlen($query_fields)-1); //removes the last comma(,)
			$query_values = substr($query_values,0,strlen($query_values)-1); //removes the last comma(,)
		}
		$sql = "insert into $table (" . $query_fields . ") values (" . $query_values . ")";
		$this->log('insert is array : ' . (string) is_array($fields));
		$this->query($sql);
	}
	
	function escape($str)
	{
		$str = $this->_security->xss_clean($str);
		return mysql_real_escape_string($str,$this->_conn);
	}
	
	function update( $table, $fields, $where)
	{
		$query_fields = null;
		$query_where = null;
		if( is_array($fields)) //if $fields is an array, extract and format the query string
		{
			foreach($fields as $key=>$value)
			{
				$query_fields .= $key . '=' . "'" . $this->escape($value) . "',";
			}
			$query_fields = substr($query_fields,0,strlen($query_fields)-1); //removes the last ,
		}
		else //if $fields is not an array (expected to be a string)
		{
			$query_fields = (string) $fields;
		}
		if( is_array( $where))
		{
			foreach($where as $k => $v)
			{
				$query_where .= ' and ' . $k . '=' . "'{$this->escape($v)}'";
			}
		}else{
			$query_where = $where;
		}
		$query_where = 'where 1 ' . $query_where;
		$sql = "update $table set $query_fields  $query_where";
		$this->log('update is array : ' . (string) is_array($fields));
		$this->query($sql);
	}

	function last_insert_id()
	{
		return mysql_insert_id($this->_conn);
	}
	
	function row($index=0)
	{
		$result = $this->result();
		if($index>$this->num_rows()){	$index = $this->num_rows();}
		return $result[$index];
	}
	
	function result($type='object')
	{
		if($type=='array'){return $this->result_array();}
		else{return $this->result_object();}
	}
	
	function get( $tablename, $startrow=0, $limit=500)
	{
		$sql = "select * from $tablename limit $startrow, $limit";
		
		return $this->query($sql);
	}
	
	function get_where( $tablename, $where=array())
	{
		$where_clause = 'where 1 ';
		if( is_array( $where))
		{
			foreach($where as $key=>$value)
			{
				if( strpos($key, '>' ) > 0 || strpos($key, '<' ) > 0 || strpos($key, '=' ) > 0)
				{
					$where_clause .= ' and ' . $key . "'{$this->escape($value)}'";
				}
				else{
					$where_clause .= ' and ' . $key . '=' . "'{$this->escape($value)}'";
				}
			}
		}
		else
		{
			$where_clause .= ' and ' . (string) $where;
		}
		$sql = "select * from {$this->escape($tablename)} $where_clause";
		return $this->query($sql);
	}
	
	function order_by($order = 'asc')
	{
		// pass
	}

	function __tostring()
	{
		$par = null;
		foreach($this->_log as $val){$par .= "<p>$val</p>";}
		$par .= print_r($this->_queries,false);
		return $par;
	}	
}

Class DatabaseException extends Exception{
	
}