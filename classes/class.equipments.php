<?php
/*
* Class ni Marie Angelica Alzola
*
*/

require_once('classes/class.database.php');
class Equipment
{
	protected $db = null;
	public static $TABLENAME = 'tblequipment';
	protected $equipid;
	
	function __construct( $equip_id = null )
	{
		$this->db = new Database();
		$this->equipid = $equip_id;
	}
	
	function is_available(){
		$sql = "select * 
from tbldeployment tbldep
inner join tblassignequip tblequip
on tbldep.id = tblequip.deploy_id
where tbldep.deleted = '0'
and tblequip.equipment_id={$this->equipid}";
		return $this->db->query($sql)->num_rows() > 0;
	}
	
	public function get_details()
	{
		return $this->db->get_where(self::$TABLENAME,
			array('Equipment_ID'=>$this->equipid))->row();
	}
	
	public static function get_list()
	{
		$db = new Database();
		return $db->get(Equipment::$TABLENAME)->result();
	}
	
	public static function s_get_details( $equip_id )
	{
		return (new Equipment($equip_id))->get_details();
	}
	public static function compile_sdetails( $equip_id )
	{
		$row = Equipment::s_get_details( $equip_id );
		if( count($row) > 0 ){
			return $row->Equipment_Desc . '('.$row->Equipment_Serial_No .')'.($row->Ammo_quantity != null ? ' Ammo ' . $row->Ammo_quantity : '');
		}else{
			return '';
		}
	}
}