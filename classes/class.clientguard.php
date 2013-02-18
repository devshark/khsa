<?php
require_once('classes/class.guards.php');
require_once('classes/class.client.php');

class Deployment{
	public static $TABLENAME = 'tbldeployment';

	public static function get_list(){
		$db = new Database();
		return $db->get_where(self::$TABLENAME,
			array('deleted'=>'0'))->result();
	}
}