<?php

//----------------------------------------------------------------
// CVPageSet
//----------------------------------------------------------------
class CVPageSet extends CObject
{

	function CreateChildren()
	{
		$this->OnLoadFieldListSpec();
	}

	function OnLoadFieldListSpec()
	{
		// Must be overwritten :
		//------------------------------------------
		//[e.g.] include( 'df.fieldsets.inc.php' );
		//[e.g.] $this->SetFieldListSpec( $spec );
		//------------------------------------------
	}

	//------------------------------------------------------------
	// SetFieldListSpec
	//------------------------------------------------------------
	function SetFieldListSpec( $spec )
	{
		$this->spec_fieldsets = $spec;
	}
	
	//------------------------------------------------------------
	// GetFieldListAttri
	//------------------------------------------------------------
	function GetFieldListAttri( $name )
	{
		if ( !isset( $this->spec_fieldsets[$name] ) )
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "Fieldset ({$name}) does not exist in spec_fieldsets : PageSet Name = " . $this->GetName() );
		}

		$attri = $this->spec_fieldsets[$name];

		//--- Inherits the attributes of the fieldset specified by XA_BASE
		if ( isset( $attri[XA_BASE] ) )
		{
			$base = $this->spec_fieldsets[$attri[XA_BASE]];
			foreach ( $attri as $key => $val )
				$base[$key] = $val;
			$attri = $base;
		}

		return $attri;
	}

	//------------------------------------------------------------
	// GetFieldList
	//------------------------------------------------------------
	function &GetFieldList( $class_name, $obj_name = null )
	{
		if ( $obj_name == null ) $obj_name = $class_name;
		if ( isset( $this->clist[$obj_name] ) )
			return $this->clist[$obj_name];
		else
		{
			$attri = $this->GetFieldListAttri($class_name);
			$obj =& CObject::SetupObject( $this, $obj_name, $attri );
			return $obj;
		}
	}

	//------------------------------------------------------------
	// SetPage
	//------------------------------------------------------------
	function SetPage( &$sc, $path, $page_id = "" )
	{
		$sc->SetPage( $path, $page_id );
	}

	//------------------------------------------------------------
	// SetDisplay
	//------------------------------------------------------------
	function SetDisplay( $ns, $b )
	{
		$this->sys->ZBuffer->Set( $ns . "display", $b );
	}

	//------------------------------------------------------------
	// ReportInfo
	//------------------------------------------------------------
	function ReportInfo( $s )
	{
		$this->sys->SysInfo->SetInfoMsg( $s );
	}

	//------------------------------------------------------------
	// ReportError
	//------------------------------------------------------------
	function ReportError( $s )
	{
		$this->sys->SysInfo->SetErrMsg( $s );
	}

	//------------------------------------------------------------
	// IsAuthorized
	//------------------------------------------------------------
	function IsAuthorized()
	{
		if ( $this->sys->Get(XA_AUTH) === true )
		{
			if (( $this->Get(XA_AUTH) === true ) || ( $this->Get(XA_AUTH) === '' ))
				return $this->sys->AuthSession->Check();
			else
				return true;
		}
		else
		{
			if ( $this->Get(XA_AUTH) === true )
				return $this->sys->AuthSession->Check();
			else
				return true;
		}
	}
	
	//------------------------------------------------------------
	// CommandProc
	//------------------------------------------------------------
	function CommandProc( &$sc )
	{
		echo "Default CommandProc";
	}

	//------------------------------------------------------------
	// Run
	//------------------------------------------------------------
	function Run( &$sc )
	{
		//-- Check the user's session 
		if ( !$this->IsAuthorized() )
		{
			$sc->SetNextSc( '/' );
			return;
		}

		while ( $sc->GetNextCommand( $this ) )
		{
			//-- Check the user is allowed to enter ( e.g. staff table )
			if ( isset( $this->sys->Authorization ) )
			{
				if ( !$this->sys->Authorization->IsAuthorized( $sc->Ps(), $sc->Cmd() ) )
				{
					$sc->RaiseError( SC_ERR_UNAUTHORIZED );
					return;
				}
			}

			$this->CommandProc( $sc );
		}
	}
}

//-----------------------------------------------------------------------
// END OF FILE
//-----------------------------------------------------------------------
?>