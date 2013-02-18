<?php
require_once('classes/class.database.php');

$db = new Database();
$columns = $db->query('SHOW COLUMNS FROM tblguards;');
$filename ="guards.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
$contents = '';
foreach($columns->result() as $column)
{
	$contents .= $column->Field."\t";
}
$contents .= "\n";

$data = '';
$guards = $db->query('select * from tblguards;');
foreach($guards->result() as $guard)
{
	$data .= $guard->id . "\t";
	$data .= $guard->last_name . "\t";
	$data .= $guard->middle_name . "\t";
	$data .= $guard->first_name . "\t";
	$data .= $guard->address . "\t";
	$data .= $guard->address_city . "\t";
	$data .= $guard->mobile_num . "\t";
	$data .= $guard->date_of_birth . "\t";
	$data .= $guard->status . "\t";
	$data .= $guard->educational_attainment . "\t";
	$data .= "'". $guard->license_num . "\t";
	$data .= $guard->license_expiry_date . "\t";
	$data .= $guard->Gender . "\t";
	$data .= $guard->guard_status . "\t";
	$data .= $guard->SSS_No . "\t";
	$data .= $guard->SSS_Deduc . "\t";
	$data .= $guard->Philhealth . "\t";
	$data .= $guard->TIN_Number . "\t";
	$data .= $guard->PAG_IBIG . "\t";
	$data .= $guard->Years_of_experience . "\t";
	$data .= "\n";
}
$contents .= $data;
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
echo $contents;
 ?>