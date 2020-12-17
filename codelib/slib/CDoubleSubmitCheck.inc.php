<?php

class CDoubleSubmitCheck
{
	function Init()
	{
		$_SESSION[ 'double_submit' ] = '';
	}
	
	function Submitted()
	{
		$_SESSION[ 'double_submit' ] = 'Y';
	}
	
	function Check()
	{
		return ( $_SESSION[ 'double_submit' ] == 'Y' );
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>