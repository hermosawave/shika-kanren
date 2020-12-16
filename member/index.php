<?php
	error_reporting( E_ALL );
	$LANG_CODE = "jpn";
	require( 'common.inc.php' );
	$sys =& CVSystem::SetupSystem( $spec_sys_base );
	$sys->SetUserType( UT_MEMBER );
	$sys->Run();
?>