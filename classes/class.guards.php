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
	
	public function get($id)
	{
		return $this->db->get_where(Guard::TABLENAME,
			array('id'=>$id))->row();
	}
	
	public static function filter($post)
	{
		$where = array();
		$db = new Database();
		if($post['address_city'] != '--')
		{
			$where['address_city'] = $post['address_city'];
		}
		if($post['Gender'] != '--')
		{
			$where['Gender'] = $post['Gender'];
		}
		if($post['educational_attainment'] != '--')
		{
			$where['educational_attainment'] = $post['educational_attainment'];
		}
		if($post['sign'] != '--')
		{
			if( preg_match('/^\d+$/',$post['age']) )
			{
				$where['FLOOR(DATEDIFF(CURDATE(),date_of_birth)/365) '.$post['sign']] = (int)$post['age'];
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
		return $db->query('select distinct address_city from '.Guard::TABLENAME)->result();
	}
	
	public static function get_genders()
	{
		$db = new Database();
		return $db->query('select distinct Gender from '.Guard::TABLENAME)->result();
	}
	
	public static function get_educs()
	{
		$db = new Database();
		return $db->query("select status from tblstatus where type='educ'")->result();
	}
	
	public function __tostring()
	{
		return var_dump($this);
	}
}

class GuardException extends Exception{}