<?php

//----------------------------------------------------------------
// cls_ps_trans
//----------------------------------------------------------------
class cls_ps_trans extends cls_ps_base
{
	var $fs_name = 'trans';
	var $fs_reg_page1 = "(reg_page1)";
	var $fs_reg_page2 = "(reg_page1)";
	var $fs_reg_page3 = "(reg_page1),(reg_save)";

	//------------------------------------------------------------
	// GetFilePrefix
	//------------------------------------------------------------
	function GetFilePrefix()
	{
		return "trans";
	}

	//------------------------------------------------------------
	// CommandProc
	//------------------------------------------------------------
	function CommandProc( &$sc )
	{
		//-- [BEGIN] Assign PageSig
		$pagesig_key = 'pagesig:' . get_class( $this );
		//-- [END] Assign PageSig

		//-- [BEGIN] Get default field set
		$def =& $this->GetFieldList( $this->fs_name );
		//-- [END] Get default field set

		//-- [BEGIN] Read command
		$cmd = $sc->Cmd();
		//-- [END] Read command

		global $scart;
		$scart = OpenSCart();

		if ( $scart->Count() == 0  )
		{
			CUtil::RelRedirect( "../index.php" );
		}
		else if ( !CMemberInfo::IsLoggedIn() )
		{
			CUtil::RelRedirect( "../member/index.php?dest=checkout", true );
		}

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

			$member =& $this->GetFieldList( "member" );
			$obj =& $member->GetChild( "member_id" );
			$obj->SetVal( CMemberInfo::GetMemberID() );

			$member->SetList( "(key)" );
			$qc = $member->GetQueryCond();
			$member->SetList( "(fd)" );
			$member->FromRecordSet( $qc );

			$ax = array(
				"name_jpn",
				"name_alpha",
				"clinic",
				"zip",
				"street1",
				"street2",
				"tel",
				"email"
			);
			foreach( $ax as $key )
			{
				$obj =& $def->GetChild( $key );
				$objx =& $member->GetChild( $key );
				$obj->SetVal( $objx->GetVal() );
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

			$obj =& $def->GetChild('order_status');
			$obj->SetVal('A');
			//-- [END] Set init values

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Set MemberID
			$obj =& $def->GetChild( "member_id" );
			$obj->SetVal( CMemberInfo::GetMemberID() );
			//-- [END] Set MemberID

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

			//-- [BEGIN] Save shopping card info into database
			$scart->Save( $id );
			//-- [END] Save shopping card info into database

			//-- [BEGIN] Send email
			if ( !$this->SendRegEmail( $def, "(key)," . $this->fs_reg_page3 ) ) break;
			//-- [END] Send email

			//-- [BEGIN] Clear PageSig
			$this->sys->PageSig->Clear( $pagesig_key );
			//-- [END] Clear PageSig

			//-- [BEGIN] Clear SCart
			if ( !SKIP_CLEAR_SCART )
			{
				ResetSCart();
			}
			//-- [END] Clear SCart

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "reg_page3" );
			//-- [END] Set template page

			break;

		//------------------------------------------------------
		// go2scart
		//------------------------------------------------------
		case go2scart:
			CUtil::RelRedirect( "../product/index.php?_sc=scart" );
			break;

		//------------------------------------------------------
		// Default
		//------------------------------------------------------
		default:
			$sc->RaiseError( SC_ERR_PAGE_NOT_FOUND );
			break;
		}
	}

	//------------------------------------------------------------
	// SendRegEmail
	//------------------------------------------------------------
	function SendRegEmail( &$def, $fs_list )
	{
		$path = PATH_CONFIG . "config.email.order.php";

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
			$Body = str_replace( "##scart##", $this->PrintSCart( "text" ), $Body );
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
			$Html = str_replace( "##scart##", $this->PrintSCart( "html" ), $Html );
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
	// PrintSCart
	//------------------------------------------------------------
	function PrintSCart( $key )
	{
		ob_start();
		include( dirname(__FILE__) . '/tpl.scart.' . $key . '.inc.php' );
		$txt = ob_get_contents();
		ob_end_clean();
		
		return $txt;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>