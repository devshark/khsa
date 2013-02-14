<?php
session_start();
try{
	if( count($_POST) > 0 )
	{
		if( empty($_POST['last_name']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Last name required.') ) ); }
		if( empty($_POST['middle_name']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Middle name required.') ) ); }
		if( empty($_POST['first_name']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'First name required.') ) ); }
		if( empty($_POST['Gender']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Gender required.') ) ); }
		if( empty($_POST['address']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Address required.') ) ); }
		if( empty($_POST['address_city']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Address city required.') ) ); }
		if( empty($_POST['mobile_num']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Mobile number required.') ) ); }
		if( empty($_POST['date_of_birth']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Date of birth required.') ) ); }
		if( empty($_POST['status']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Status required.') ) ); }
		if( empty($_POST['educational_attainment']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Educational attainment required.') ) ); }
		if( empty($_POST['license_num']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'License number required.') ) ); }
		if( empty($_POST['license_expiry_date']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'License expiry date required.') ) ); }
		if( empty($_POST['SSS_No']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'SSS Number required.') ) ); }
		if( empty($_POST['Philhealth']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Philhealth Number required.') ) ); }
		if( empty($_POST['PAG_IBIG']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'PAG IBIG Number required.') ) ); }
		if( empty($_POST['TIN_Number']) ){ die( json_encode( array( 'status'=>'failed', 'message'=>'TIN Number  required.') ) ); }
		
		$has_worked = false;
		foreach($_POST['Company_name'] as $seq => $compname){
			if( trim($compname) == '' && trim($_POST['Date_from'][$seq]) == '' && trim($_POST['Date_to'][$seq]) == '' )
			{ continue; }
			else{ $has_worked = true; }

			if( trim($compname) == '' ){ throw new Exception('Company Name required.'); }
			if( ! is_numeric($_POST['Date_from'][$seq]) || ( strlen($_POST['Date_from'][$seq]) <> 4 ) )
			{ throw new Exception('Year from must be a four-digit number.'); }
			if( ! is_numeric($_POST['Date_to'][$seq]) || ( strlen($_POST['Date_to'][$seq]) <> 4 ) )
			{ throw new Exception('Year to must be a four-digit number.'); }
		}
		
		if( $has_worked && ( (int) $_POST['Years_of_experience'] ) == 0 ){ die( json_encode( array( 'status'=>'failed', 'message'=>'Years of Experience is required.') ) ); }
		
		$company = array();
		$company['company'] = $_POST['Company_name'];
		$company['from'] = $_POST['Date_from'];
		$company['to'] = $_POST['Date_to'];
		unset($_POST['Company_name'], $_POST['Date_from'], $_POST['Date_to']);
		
		require_once('classes/class.database.php');
		
		$db = new Database();
		$db->insert('tblguards',
			$_POST
		);
		
		$id = $db->last_insert_id();
		
		$db->insert('tblrequirements',array('guard_id'=>$id));
		
		foreach($company['company'] as $seq => $compname){
			if( trim($compname) == '' && trim($company['from'][$seq]) == '' && trim($company['to'][$seq]) == '' )
			{ continue; }
			$db->insert('tbljobhistory',
				array('guard_id'=>$id,
				'Company_name'=>$compname,
				'Date_from'=>$company['from'][$seq],
				'Date_to'=>$company['to'][$seq]));
		}
		
		require_once('classes/class.audit.php');
		Audit::audit_log($_SESSION['adminid'], 'Added new client #'.$id);
		
		die( json_encode( array( 'status'=>'success', 'message'=>'Guard Sucessfuly added') ) );
	}
	else
	{
		die( json_encode( array( 'status'=>'failed', 'message'=>'Invalid Request.') ) );
	}
}
catch(Exception $ex){
	die( json_encode( array( 'status'=>'failed', 'message'=>$ex->getMessage()) ) );
}