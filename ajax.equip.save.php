<?php
session_start();
$id = $_POST['id'] ?: null;
$equips = $_POST['equips'] ?: null;
require_once('classes/class.equipments.php');
// ini_set('display_errors','On');
// error_reporting(E_ALL);
// echo 'oi,gana';
try{
	if( $id && $equips ){
		$db = new Database();
		$str_equipments = '';
		foreach( explode(',',$equips) as $equip ){
			if(is_numeric($equip)) {
				$eq = new Equipment($equip);
				if( ! $eq->is_available() )
				{
					$db->insert('tblassignequip',
						array('deploy_id'=>$db->escape($id),
						'equipment_id'=>$db->escape($equip)));
					// $row = $eq->get_details();
					$str_equipments .= Equipment::compile_sdetails($equip) . ',';
				}
				else{
					throw new Exception("Equipment #{$equip} is unavailable.");
				}
			}
			else{
				throw new Exception("Equipment IDs are not in the correct format.");
			}
		}
		echo json_encode( array( 'status'=>'success', 'message'=>$str_equipments ) );
	}
	else{
		throw new Exception("Equip and ID error.");
	}
}
catch(Exception $ex)
{
	echo json_encode( array( 'status'=>'failed', 'message'=>$ex->getMessage() ) );
}