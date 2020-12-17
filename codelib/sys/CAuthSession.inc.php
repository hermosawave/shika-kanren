<?php

//----------------------------------------------------------------
// CAuthSession
//----------------------------------------------------------------
class CAuthSession extends CObject
{
	function GetKey()
	{
		return AUTHSESSION_KEY;
	}
	
	function Enable()
	{
		$_SESSION[$this->GetKey()] = $this->GetKey();
	}

	function Terminate()
	{
		unset( $_SESSION[$this->GetKey()] );
	}

	function Check()
	{
		return isset( $_SESSION[$this->GetKey()] ) && 
			( $_SESSION[$this->GetKey()] == $this->GetKey() );
	}

	function SetV( $key , $val )
	{
		$_SESSION[$this->GetKey() . $key ] = $val;
	}

	function SetAV( $ax )
	{
		foreach ( $ax as $key => $val )
			$_SESSION[$this->GetKey() . $key ] = $val;
	}

	function GetV( $key )
	{
		if ( isset( $_SESSION[$this->GetKey() . $key ] ) )
			return $_SESSION[$this->GetKey() . $key ];
		else
			return '';
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>