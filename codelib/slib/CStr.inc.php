<?php

//----------------------------------------------------------------
// String Functions
//----------------------------------------------------------------
class CStr
{
	function e2n( $s )
	{
		return ( $s == '' ? null : $s );
	}

	function n2e( $s )
	{
		return ( is_null( $s ) ? '' : $s );
	}

	function html( $s )
	{
		if ( is_null( $s ) )
			return '';
		else
			return htmlspecialchars( $s );
	}

	function implode( $sepa, $ax, $idx )
	{
		$s = '';
		foreach( $ax as $v )
		{
			if ( $s != '' ) $s .= $sepa;
			$s .= $v[$idx];
		}
		return $s;
	}
}

?>