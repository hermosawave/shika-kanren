<?php

//----------------------------------------------------------------
// cls_ps_frame
//----------------------------------------------------------------
class cls_ps_frame extends cls_ps_base
{
	//------------------------------------------------------------
	// Authenticate
	//------------------------------------------------------------
	function Authenticate( &$def )
	{
		//-- Get password from input
		$obj =& $def->GetChild( 'password_login' );
		$password_from_input = $obj->GetVal();

		//-- Set Active = 'Y'
		$obj =& $def->GetChild( 'active' );
		$obj->SetVal( 'Y' );

		//-- Create Criteria
		$def->SetList( "(auth)" );
		$qc = $def->GetQueryCond();

		//-- Find a record
		$user_id = -1;
		$def->SetList( "(ses)" );

		if ( $def->FromRecordSet( $qc, false ) )
		{
			$obj =& $def->GetChild( 'password' );
			$password_from_db = $obj->GetVal();

			if (
				( is_null( $password_from_db ) ) ||
				( $this->sys->EncryptPassword( $password_from_input ) == $password_from_db )
			)
			{
				$obj =& $def->GetPrimaryKey();
				$user_id = $obj->GetVal();

				$obj =& $def->GetChild('name_jpn');
				$name_jpn = $obj->GetVal();

				CMemberInfo::SetMemberInfo( $user_id, $name_jpn, $password_from_input );
			}
		}

		//-- If a record is not found then show error
		if ( $user_id == -1 )
		{
			$this->ReportError( RSTR_ERR_WRONG_UN_PASS );
			return false;
		}

		//-- Store user data in session
		$def->ToAuthSes();

		//-- Mark as a successful login
		$this->sys->AuthSession->Enable();

		//-- Record last login date/time
		$keyobj =& $def->GetPrimaryKey();
		$qc = array( $keyobj->GetName() . '=' . $user_id );
		$def->SetList( "(last_login)" );
		$def->UpdateRecordSet( $qc );

		//-- Return
		return true;
	}

	//------------------------------------------------------------
	// CommandProc
	//------------------------------------------------------------
	function CommandProc( &$sc )
	{
		$start_page = $this->sys->Get( XA_START_PAGE );
		$frame_fieldlist = $this->sys->Get( XA_FRAME_FIELDSET );

		$def =& $this->GetFieldList( $frame_fieldlist );

		$cmd = $sc->Cmd();

		switch( $cmd )
		{

		case "login":
			$this->sys->State->Clear( '*' );
			$def->SetList( "(login)" );
			$def->SetNS( "rs:def:" );
			$def->FromInput();
			$def->ToZBuffer( XC_OF_INPUT );
			$this->SetPage( $sc, "login" );
			break;

		case "auth":
			$this->sys->State->Clear( '*' );
			$sc->SetNextSc( "login" );
			$def->SetList( "(login)" );
			$def->SetNS( "rs:def:" );
			$def->FromInput();
			if ( !$def->Validate( XPT_INPUT ) ) break;
			if ( !$this->Authenticate( $def ) ) break;

			$dest = $this->sys->GetIV( 'dest' );
			if ( $dest == '' ) $dest = 'home';
			switch( $dest )
			{
			case 'edit_inp':
				$sc->SetNextSc( $start_page );
				break;
			case 'checkout':
				CUtil::RelRedirect( "../checkout/index.php", true );
				break;
			default:
				$this->SetPage( $sc, "home" );
				//CUtil::RelRedirect( "../index.php" );
				break;
			}
			break;

		case "logoff":
			$this->sys->State->Clear( '*' );
			$this->sys->AuthSession->Terminate();
			CMemberInfo::ResetMemberInfo();
			$this->SetPage( $sc, "logout" );
			//$sc->SetNextSc( "login" );
			break;

		default:
			$sc->RaiseError( SC_ERR_PAGE_NOT_FOUND );
			break;

		}
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>