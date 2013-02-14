<?php
require_once('classes/class.guards.php');

class Req
{
	public $guard;
	public static $TABLENAME = 'tblrequirements';
	
	protected $db;
	
	public function __construct($guardid)
	{
		$this->db = new Database();
		$this->guard = (new Guard())->get($guardid);
	}
	
	public function get_checklist()
	{
		$db = new Database();
		return $db->get_where(self::$TABLENAME,
			array('guard_id'=>$this->guard->id))->row();
	}
	
	public static function get_checklists($guardid)
	{
		return (new Req($guardid))->get_checklist();
	}
	
	public function updateCheck($name, $value)
	{
		$this->db->update(self::$TABLENAME,
			array($name=>$value),
			array('guard_id'=>$this->guard->id));
	}
	
	public static function get_list()
	{
		$guards = array();
		foreach(Guard::get_list() as $guard)
		{
			$guards[] = new Req($guard->id);
		}
		return $guards;
	}
	
	public static function get_req_status( $guardid ){
		$sql = "select * from view_pendingrequirements where guard_id={$guardid};";
		$db = new Database();
		return $db->query($sql)->num_rows() > 0 ? 'Pending' : 'Complete';
	}
	
}