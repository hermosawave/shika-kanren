<?php
	error_reporting( E_ALL );
	require( 'common.inc.php' );
	if ( isset( $_GET[ 'cn' ] ) )
	{
		$class_name = $_GET[ 'cn' ];
		if ( class_exists( $class_name ) )
		{
			$obj =& CUtil::CreateObject( $class_name );
			$obj->Download();
			return;
		}
	}

return "OBJECT ERROR";

?>