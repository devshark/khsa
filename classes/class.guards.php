<?php
require_once('classes/class.database.php');
class Guard 
{
	protected $db = null;
	// const TABLENAME = 'tblemployee';
	const TABLENAME = 'tblguards';
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function search( $filters = array() )
	{
		return $this->db->get_where($this->tablename,$filters)->result();
	}
	
	public static function filter($post)
	{
		$where = array();
		$db = new Database();
		if($post['City'] != '--')
		{
			$where['City'] = $post['City'];
		}
		if($post['Gender'] != '--')
		{
			$where['Gender'] = $post['Gender'];
		}
		if($post['educ_attainment'] != '--')
		{
			$where['educ_attainment'] = $post['educ_attainment'];
		}
		if($post['sign'] != '--')
		{
			if( preg_match('/^\d+$/',$post['age']) )
			{
				$where['FLOOR(DATEDIFF(CURDATE(),DOB)/365) '.$post['sign']] = (int)$post['age'];
			}
		}
		if( count($where) >0 )
		{
			return $db->get_where(Guard::TABLENAME, $where)->result();
		}else{
			return array();
		}
	}
	
	public static function get_list()
	{
		$db = new Database();
		return $db->get(Guard::TABLENAME)->result();
	}
	
	public static function get_locations()
	{
		$db = new Database();
		return $db->query('select distinct City from '.Guard::TABLENAME)->result();
	}
	
	public static function get_genders()
	{
		$db = new Database();
		return $db->query('select distinct Gender from '.Guard::TABLENAME)->result();
	}
	
	public static function get_educs()
	{
		$db = new Database();
		return $db->query('select distinct educ_attainment educ from '.Guard::TABLENAME)->result();
	}
	
	public function __tostring()
	{
		return var_dump($this);
	}
}

class GuardException extends Exception{}