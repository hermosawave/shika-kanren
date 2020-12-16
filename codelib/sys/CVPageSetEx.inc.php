<?php

//----------------------------------------------------------------
// CVPageSetEx
//----------------------------------------------------------------
class CVPageSetEx extends CVPageSet
{
	function SaveSearchParams( &$def )
	{
		$def->SetNS( "sp:def:" );
		$def->SetList( "(sp)" );
		$def->FromInput();
		$def->ToState();
		$def->SetEmpty();
	}

	function ValidateKey( &$def, &$sc, $b_init )
	{
		//-- Prepare to read key(primary key)
		$def->SetNS( "key:def:" );
		$def->SetList( "(key)" );

		if ( $b_init )
		{
			//-- Read key from input and set it to state
			$def->FromInput();
			$def->ToState();
		}
		else
		{
			//-- Read key from state
			$def->FromState();
		}

		//-- Validate key(primary key)
		if ( !$def->Validate( XPT_INPUT ) )
		{
			$sc->CriticalError( "Invalid Key" );
			return false;
		}

		return true;
	}

	function GetFilePrefix()
	{
		return '';
	}

	function SetPage( &$sc, $path )
	{
		$pf = $this->GetFilePrefix();
		if ( $pf != '' ) $pf .= ".";

		parent::SetPage( $sc, "tpl." . $pf . $path . ".inc.php" );
	}
}

//-----------------------------------------------------------------------
// END OF FILE
//-----------------------------------------------------------------------
?>