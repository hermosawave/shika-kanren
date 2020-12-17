<?php

//----------------------------------------------------------------
// cls_ps_member
//----------------------------------------------------------------
class cls_ps_member extends cls_ps_base
{
	var $fs_name = 'member';
	var $fs_reg_page1 = "(reg_page1)";
	var $fs_reg_page2 = "(reg_page1)";
	var $fs_reg_page3 = "(reg_page1),(reg_save)";
	var $fs_sendpass_page1 = "(sendpass_page1)";
	var $fs_sendpass_page2 = "(sendpass_page1),+password";

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
		// Reg Init
		//------------------------------------------------------
		case 'reg_init':

			//-- [BEGIN] Mark PageSig
			$this->sys->PageSig->Mark( $pagesig_key );
			//-- [END] Mark PageSig

			//-- [BEGIN] Set init values
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_page1 );
			$def->SetEmpty();
			global $init_values_for_member;
			if ( isset( $init_values_for_member ) )
			{
				foreach( $init_values_for_member as $key=>$val )
				{
					$obj =& $def->GetChild( $key );
					$obj->SetVal( $val );
				}
			}
			$def->ToState();
			//-- [END] Set init values

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "reg_page0" );
			//-- [END] Set PageID

			//-- [BEGIN] Go to page1
			$sc->SetNextSc( "reg_page1" );
			//-- [END] Go to page1

			break;

		//------------------------------------------------------
		// Reg Page1
		//------------------------------------------------------
		case 'reg_page1':
		case 'reg_page1_pb':

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "reg_page0", "reg_page1", "reg_page2", "reg_page3" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "reg_page1" );
			//-- [END] Set PageID

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Load values from State
			if ( $cmd == 'reg_page1' )
			{
				$def->SetNS( "rs:def:" );
				$def->SetList( $this->fs_reg_page1 );
				$def->FromState();
			}
			//-- [END] Load values from State

			//-- [BEGIN] Output
			$def->ToZBuffer( XC_OF_INPUT );
			//-- [END] Output

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page1" );
			//-- [END] Set template page

			break;

		case 'reg_page1_next':

			//-- [BEGIN] Set default destination
			$sc->SetNextSc( "reg_page1_pb" );
			//-- [END] Set default destination

			//-- [BEGIN] Input and Validate values
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page1 );
			$def->FromInput();
			if ( !$def->Validate( XPT_INPUT ) ) break;
			$def->ToState();
			//-- [END] Input and Validate values

			//-- [BEGIN] Prevent Email Confilct
			if ( !SKIP_DUPLICATE_EMAIL_CHECK )
			{
				if ( $this->CheckEmailConflict( $def ) ) break;
			}
			//-- [END] Prevent Email Confilct

			//-- [BEGIN] Go to page2
			$sc->SetNextSc( "reg_page2" );
			//-- [END] Go to page2

			break;

		//------------------------------------------------------
		// Reg Page2
		//------------------------------------------------------
		case "reg_page2":

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "reg_page1", "reg_page2" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "reg_page2" );
			//-- [END] Set PageID

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Load values from State
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_page2 );
			$def->FromState();
			//-- [END] Load values from State

			//-- [BEGIN] Output
			$def->ToZBuffer( XC_OF_DEFAULT );
			//-- [END] Output

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page2" );
			//-- [END] Set template page

			break;

		case 'reg_page2_prev':

			//-- [BEGIN] Go to page1
			$sc->SetNextSc( "reg_page1" );
			//-- [END] Go to page1

			break;

		case 'reg_page2_next':

			//-- [BEGIN] Go to page3
			$sc->SetNextSc( "reg_page3" );
			//-- [END] Go to page3

			break;

		//------------------------------------------------------
		// Reg Page3
		//------------------------------------------------------
		case "reg_page3":

			//-- [BEGIN] Check PageSig
			if ( !SKIP_DOUBLE_SUBMIT_CHECK )
			{
				if ( !$this->sys->PageSig->Check( $pagesig_key ) )
				{
					$sc->DoubleSubmitError();
					break;
				}
			}
			//-- [END] Check PageSig

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "reg_page2" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "reg_page3" );
			//-- [END] Set PageID

			//-- [BEGIN] Set default destination
			$sc->SetNextSc( "reg_page1_pb" );
			//-- [END] Set default destination

			//-- [BEGIN] Load values from state
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_page3 );
			$def->FromState();
			//-- [END] Load value from state

			//-- [BEGIN] Set init values
			$obj =& $def->GetChild('active');
			$obj->SetVal('Y');
			//-- [END] Set init values

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Output
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_page3 );
			$def->ToZBuffer( XC_OF_DEFAULT );
			//-- [END] Output

			//-- [BEGIN] Save data into database
			$obj =& $def->GetChild('active');
			$def->SetList( $this->fs_reg_page3 . ',+active' );
			$id = $def->InsertRecordSet();
			//-- [END] Save data into database

			//-- [BEGIN] Send email
			if ( !$this->SendRegEmail( $def, $this->fs_reg_page3 ) ) break;
			//-- [END] Send email

			//-- [BEGIN] Clear PageSig
			$this->sys->PageSig->Clear( $pagesig_key );
			//-- [END] Clear PageSig

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page3" );
			//-- [END] Set template page

			break;

		//------------------------------------------------------
		// SendPass Init
		//------------------------------------------------------
		case 'sendpass_init':

			//-- [BEGIN] Mark PageSig
			$this->sys->PageSig->Mark( $pagesig_key );
			//-- [END] Mark PageSig

			//-- [BEGIN] Set init values
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_sendpass_page1 );
			$def->SetEmpty();
			global $init_values_for_member;
			if ( isset( $init_values_for_member ) )
			{
				foreach( $init_values_for_member as $key=>$val )
				{
					$obj =& $def->GetChild( $key );
					$obj->SetVal( $val );
				}
			}
			$def->ToState();
			//-- [END] Set init values

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "sendpass_page0" );
			//-- [END] Set PageID

			//-- [BEGIN] Go to page1
			$sc->SetNextSc( "sendpass_page1" );
			//-- [END] Go to page1

			break;

		//------------------------------------------------------
		// SendPass Page1
		//------------------------------------------------------
		case 'sendpass_page1':
		case 'sendpass_page1_pb':

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "sendpass_page0", "sendpass_page1", "sendpass_page2" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "sendpass_page1" );
			//-- [END] Set PageID

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Load values from State
			if ( $cmd == 'sendpass_page1' )
			{
				$def->SetNS( "rs:def:" );
				$def->SetList( $this->fs_sendpass_page1 );
				$def->FromState();
			}
			//-- [END] Load values from State

			//-- [BEGIN] Output
			$def->ToZBuffer( XC_OF_INPUT );
			//-- [END] Output

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "sendpass_page1" );
			//-- [END] Set template page

			break;

		case 'sendpass_page1_next':

			//-- [BEGIN] Set default destination
			$sc->SetNextSc( "sendpass_page1_pb" );
			//-- [END] Set default destination

			//-- [BEGIN] Input and Validate values
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_sendpass_page1 );
			$def->FromInput();
			if ( !$def->Validate( XPT_INPUT ) ) break;
			if ( !$this->CheckEmailExists( $def ) ) break;
			$def->SetList( $this->fs_sendpass_page1 . ",+password" );
			$def->ToState();
			//-- [END] Input and Validate values

			//-- [BEGIN] Go to page2
			$sc->SetNextSc( "sendpass_page2" );
			//-- [END] Go to page2

			break;

		//------------------------------------------------------
		// SendPass Page2
		//------------------------------------------------------
		case "sendpass_page2":

			//-- [BEGIN] Check PageSig
			if ( !SKIP_DOUBLE_SUBMIT_CHECK )
			{
				if ( !$this->sys->PageSig->Check( $pagesig_key ) )
				{
					$sc->DoubleSubmitError();
					break;
				}
			}
			//-- [END] Check PageSig

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "sendpass_page1", "sendpass_page2" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Set default destination
			$sc->SetNextSc( "sendpass_page1_pb" );
			//-- [END] Set default destination

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "sendpass_page2" );
			//-- [END] Set PageID

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Load values from State
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_sendpass_page2 );
			$def->FromState();
			//-- [END] Load values from State

			//-- [BEGIN] Output
			$def->ToZBuffer( XC_OF_DEFAULT );
			//-- [END] Output

			//-- [BEGIN] Send email
			if ( !$this->SendPassEmail( $def, $this->fs_sendpass_page2 ) ) break;
			//-- [END] Send email

			//-- [BEGIN] Clear PageSig
			$this->sys->PageSig->Clear( $pagesig_key );
			//-- [END] Clear PageSig

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "sendpass_page2" );
			//-- [END] Set template page

			break;

		//------------------------------------------------------
		// Default Page2
		//------------------------------------------------------
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
		$path = PATH_CONFIG . "config.email.register.php";

		$email = new CEmail();
		$email->OpenConfig( $path );

		$obj =& $def->GetChild("email");
		$email_address = $obj->GetVal();
		$email->SetParam( "To", array( array( $email_address ) ) );

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

	//------------------------------------------------------------
	// CheckEmailExists
	//------------------------------------------------------------
	function CheckEmailExists( &$def )
	{
		$p = $def->GetChild( 'email' );
		$email = $p->GetVal();

		$db =& $this->sys->DB;
		$table_name = $def->Get(XA_TABLE_NAME);
		$flist = array( "email", "password" );
		$qc = array( "email = '". $db->Sanitize($email) . "'" );
		$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
		$result = $db->Query( $sql );
		$b = ( $rs = $db->GetRowA( $result ) );
		if ( $b )
		{
			$obj =& $def->GetChild('password');
			$obj->SetVal( $rs['password'] );
		}
		$db->FreeResult( $result );

		if ( !$b )
		{
			$p->SetErrMsg( "-" );
			$this->ReportError( "このE-Mailアドレスは登録されていません。" );
		}

		return $b;
	}

	//------------------------------------------------------------
	// SendPassEmail
	//------------------------------------------------------------
	function SendPassEmail( &$def, $fs_list )
	{
		$path = PATH_CONFIG . "config.email.sendpass.php";

		$email = new CEmail();
		$email->OpenConfig( $path );

		$obj =& $def->GetChild("email");
		$email_address = $obj->GetVal();
		$email->SetParam( "To", array( array( $email_address ) ) );

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