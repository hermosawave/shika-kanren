<?php

function LoadConst()
{
	global $sys;
	$db =& $sys->DB;
	$table_name = TBL_CONST;
	$flist = array( "yen" );
	$qc = array( "const_id = 1001" );
	$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
	$result = $db->Query( $sql );
	if ( $rs = $db->GetRowA( $result ) )
	{
		global $yen_per_dollar;
		$yen_per_dollar = $rs['yen'];
	}
	$db->FreeResult( $result );
}

?>