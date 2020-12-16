<?php

//----------------------------------------------------------------
// cls_ps_member
//----------------------------------------------------------------
class cls_ps_member extends cls_ps_base
{
	var $fs_name = 'member';
	var $fs_edit_inp = "(edit_page1)";
	var $fs_edit_save = "(edit_page1),(edit_save)";

	//------------------------------------------------------------
	// GetFilePrefix
	//------------------------------------------------------------
	function GetFilePrefix()
	{
		return "member";
	}

	//------------------------------------------------------------
	// CommandProc
	//------------------------------------------------------------
	function CommandProc( &$sc )
	{
		$pagesig_key = 'pagesig:' . get_class( $this );
		$def =& $this->GetFieldList( $this->fs_name );
		$cmd = $sc->Cmd();

		switch( $cmd )
		{

		//------------------------------------------------------
		// edit
		//------------------------------------------------------
		case 'edit_inp':
		case 'edit_inp_pb':

			//-- [BEGIN] Set verb and caption
			$this->sys->ZBuffer->Set( 'page:caption_verb', RSTR_EDIT );
			$this->sys->ZBuffer->Set( 'page:verb', 'edit' );
			//-- [END] Set verb and caption

			//-- [BEGIN] Is first time?
			$b_init = ( $cmd == "edit_inp" );
			//-- [END] Is first time?

			//-- [BEGIN] Load primary key
			$def->SetNS( "key:def:" );
			$def->SetList( "(key)" );
			$obj =& $def->GetPrimaryKey();
			$obj->SetVal( CMemberInfo::GetMemberID() );
			//-- [END] Load primary key

			//-- [BEGIN] Validate key(primary key)
			if ( !$def->Validate( XPT_INPUT ) )
			{
				$sc->CriticalError( "Invalid Key" );
				break;
			}
			//-- [END] Validate key(primary key)

			//-- [BEGIN] Set display on
			$b_display = true;
			//-- [END] Set display on

			//-- [BEGIN] For the first time, load data from database
			if ( $b_init )
			{
				//-- Create query condition
				$qc = $def->GetQueryCond();

				//-- Prepare to get data from record set
				$def->SetList( $this->fs_edit_inp . ",(rlog)" );

				//-- Get data from database. if no data, then set display off
				if ( !$def->FromRecordSet( $qc ) )
				{
					$b_display = false;
				}
			}
			//-- [END] For the first time, load data from database

			//-- [BEGIN] Output fields
			if ( $b_display )
			{
				//-- Output key in default output format
				$def->SetNS( "rs:def:" );
				$def->SetList( "(key)" );
				$def->ToZBuffer( XC_OF_DEFAULT );

				//-- Output fields in input box
				$def->SetNS( "rs:def:" );
				$def->SetList( $this->fs_edit_inp );
				$def->ToZBuffer( XC_OF_INPUT );

				//-- Output log in default output format
//				$def->SetNS( "rs:def:" );
//				$def->SetList( "(rlog)" );
//				$def->ToZBuffer( XC_OF_DEFAULT );
			}
			//-- [END] Output fields

			//-- [BEGIN] Set Display
			$this->SetDisplay( "def:", $b_display );
			//-- [END] Set Display

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "edit_inp" );
			//-- [END] Set PageID

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "edit_inp" );
			//-- [END] Set template page

			break;

		case 'edit_done':

			//-- [BEGIN] Set Return Page
			$ret_cmd = "edit_inp_pb";
			$sc->SetNextSc( $ret_cmd );
			//-- [END] Set Return Page

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "edit_inp" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Primary Key
			$def->SetNS( "key:def:" );
			$def->SetList( "(key)" );
			$obj =& $def->GetPrimaryKey();
			$obj->SetVal( CMemberInfo::GetMemberID() );
			if ( !$def->Validate( XPT_INPUT ) )
			{
				$sc->CriticalError( "Invalid Key" );
				break;
			}
			$qc = $def->GetQueryCond();
			//-- [END] Primary Key

			//-- [BEGIN] Input
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_edit_inp );
			$def->FromInput();
			//-- [END] Input

			//-- [BEGIN] Password Change I
			//-- If both password_new and password_conf are empty
			//-- Make them Not required
			$obj1_password =& $def->GetChild('password_old');
			$obj2_password =& $def->GetChild('password_new');
			$obj3_password =& $def->GetChild('password_new_conf');
			$b_change_password = ( $obj1_password->GetVal() != '' );
			if ( $b_change_password )
			{
				$obj1_password->Set( XA_REQUIRED, true );
				$obj2_password->Set( XA_REQUIRED, true );
				$obj3_password->Set( XA_REQUIRED, true );
			}
			//-- [END] Password Change I

			//-- [BEGIN] Validate Input
			if ( !$def->Validate( XPT_INPUT ) ) return false;
			//-- [END] Validate Input

			//-- [BEGIN] Prevent Email Confilct
			if ( !SKIP_DUPLICATE_EMAIL_CHECK )
			{
				if ( $this->CheckEmailConflict( $def, CMemberInfo::GetMemberID() ) ) break;
			}
			//-- [END] Prevent Email Confilct

			$fs = $this->fs_edit_save;

			//-- [BEGIN] Password Change II
			//-- If password_new is not empty then
			//-- copy password_new to password and
			//-- Add password to fieldlist to save
			if ( $b_change_password )
			{
				$obj =& $def->GetChild('password_new');
				$pwd = $obj->GetVal();
				if ( $pwd != '' )
				{
					$obj =& $def->GetChild('password');
					$obj->SetVal( $pwd );
					$fs .= ",+password";
				}
			}
			//-- [END] Password Change II

			//-- [BEGIN] Save data into database
			$def->SetList( $fs );
			$id = $def->UpdateRecordSet( $qc );
			//-- [END] Save data into database

			//-- [BEGIN] Output Report Info
			$this->ReportInfo( "会員情報が更新されました。" );
			//-- [END] Output Report Info

			//-- [BEGIN] Reset Password Boxes
			$obj1_password->SetVal('');
			$obj2_password->SetVal('');
			$obj3_password->SetVal('');
			//-- [BEGIN] Reset Password Boxes

			//-- [BEGIN] Go to edit_inp
			$sc->SetNextSc( 'edit_inp' );
			//-- [END] Go to edit_inp

			break;

		//------------------------------------------------------
		// Home
		//------------------------------------------------------
		case "home":

			//-- [BEGIN] Go to edit_inp
			$sc->SetNextSc( 'edit_inp' );
			//-- [END] Go to edit_inp

			//CUtil::Redirect( '../index.php' );
			//-- [BEGIN] Set template page
			//$this->SetPage( $sc, "home" );
			//-- [END] Set template page

			break;

		default:
			$sc->RaiseError( SC_ERR_PAGE_NOT_FOUND );
			break;
		}
	}

	//------------------------------------------------------------
	// CheckEmailConflict
	//------------------------------------------------------------
	function CheckEmailConflict( &$def, $id = -1 )
	{
		$p = $def->GetChild( 'email' );
		$email = $p->GetVal();

		$db =& $this->sys->DB;
		$table_name = $def->Get(XA_TABLE_NAME);
		$flist = array( "email" );
		$qc = array( "email = '". $db->Sanitize($email) . "'" );
		if ( $id != -1 ) $qc[] = $def->Get(XA_ID_NAME) . " <> {$id}";
		$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
		$result = $db->Query( $sql );
		$b = ( $rs = $db->GetRowA( $result ) );
		$db->FreeResult( $result );

		if ( $b )
		{
			$p->SetErrMsg( "-" );
			$this->ReportError( RSTR_ERR_USED_EMAIL . " [" . CStr::html($email) . "]" );
		}

		return $b;
	}

	//------------------------------------------------------------
	// SendRegEmail
	//------------------------------------------------------------
	function SendRegEmail( &$def, $fs_list )
	{
		$path = PATH_CONFIG . "config.email.member.php";

		$email = new CEmail();
		$email->OpenConfig( $path );

		//$obj =& $def->GetChild("email");
		//$email_address = $obj->GetVal();
		//$email->SetParam( "To", array( array( $email_address ) ) );

		$def->SetNS( 'rs:def:' );
		$def->SetList( $fs_list );
		$def->ToZBuffer( XC_OF_DEFAULT );

		$Body = $email->GetParam( 'Body' );
		if ( !is_null( $Body ) )
		{
			foreach( $def->clist as $key => $val )
			{
				$v = $this->sys->ZBuffer->Get( "rs:def:" . $key . "=" );
				$Body = str_replace( "##" . $key . "##", $v, $Body );
			}
			$email->SetParam( 'Body', $Body );
		}

		$Html = $email->GetParam( 'Html' );
		if ( !is_null( $Html ) )
		{
			foreach( $def->clist as $key => $val )
			{
				$v = $this->sys->ZBuffer->Get( "rs:def:" . $key );
				$Html = str_replace( "##" . $key . "##", $v, $Html );
			}
			$email->SetParam( 'Html', $Html );
		}

		$b = $email->Send();

		$msg = "EMAIL ERROR : <br>";
		if ( $b )
			$msg .= "NONE";
		else
			$msg .= $email->GetErrMsg();

		if ( CConfig::Get( 'debug/display_smtp_log' ) )
		{
			echo $msg . '<br/>';
			$email->DisplaySmtpLog();
		}

		if ( !$b )
		{
			$this->ReportError( $msg );
			return false;
		}

		return true;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>