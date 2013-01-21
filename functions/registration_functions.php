<?php

function validation_errors($error,$start='<p>',$end='</p>')
{
	$full_err = '';
	foreach($error as $err){
		$full_err .= $start . $err . $end;
	}
	return $full_err;
}

?>