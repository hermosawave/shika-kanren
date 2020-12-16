<?php

//----------------------------------------------------------------
// cls_ps_trans
//----------------------------------------------------------------
class cls_ps_trans extends cls_ps_base
{
	var $ps_caption = RSTR_TRANS;
	var $fs_name = 'trans';
	var $fs_edit_inp = "(edit_staff),(edit_inp)";
	var $fs_edit_save = "(edit_staff),(edit_save)";
	var $fs_detail = "(detail_staff)";

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

		switch( $cmd )
		{
		case "search":
		case "search_pb":
		case "search_ps":
		case "search_ret":

			//-- [BEGIN] Clear "Key (PrimaryKey)" 
			if ( $cmd == "search_ret" )
			{
				$def->SetNS( "key:def:" );
				$def->SetList( "(key)" );
				$def->ClearState();
			}
			//-- [END] Clear "Key (PrimaryKey)" 

			//-- [BEGIN] Prepare to get criteria from state or criteria input
			$def->SetNS( "sp:def:" );
			$def->SetList( "(sp)" );
			switch ( $cmd )
			{
			case "search_ret":
				//-- Restore state to fieldlist and clear state
				$def->FromState();
				$def->ClearState();
				break;

			case "search":
				//-- Set criteria input to fieldlist and set init values
				$def->FromInput();
				$def->FromInitValue( 'search' );
				break;

			case "search_pb":
			case "search_ps":
				//-- Set criteria input to fieldlist
				$def->FromInput();
				break;
			}
			//-- [END] Prepare to get criteria from state or criteria input

			//-- [BEGIN] Validate criteria
			$b = $def->Validate( XPT_SEARCH );
			//-- [END] Validate criteria

			//-- [BEGIN] Output criteria input
			$def->ToZBuffer( XC_OF_SEARCH );
			//-- [END] Output criteria input

			//-- [BEGIN] Criteria validated successfully 
			if ( $b )
			{
				//-- [BEGIN] OK to show results
				$this->SetDisplay( "def:", true );
				//-- [END] OK to show results

				//-- [BEGIN] Create query
				$qc = $def->GetQueryCond();
				//-- [END] Create query

				//-- [BEGIN] Output query results in table memberat
				$def->SetNS( "rs:def:" );
				$def->SetList( "(sr)" );
				$b_clear = ( $cmd == "search_pb" );
				$def->ToZBufferTable( "_this/search_ps", $qc, $b_clear, 'AND' );
				//-- [END] Output query results in table format
			}
			//-- [END] Criteria validated successfully 

			//-- [BEGIN] Set default id
			$sc->SetDefID( $def->Get(XA_ID_NAME) );
			//-- [END] Set default id

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "search" );
			//-- [END] Set template page

			break;

		case 'edit_inp':
		case 'edit_inp_pb':

			//-- [BEGIN] Set verb and caption
			$this->sys->ZBuffer->Set( 'page:caption_verb', RSTR_EDIT );
			$this->sys->ZBuffer->Set( 'page:verb', 'edit' );
			//-- [END] Set verb and caption

			//-- [BEGIN] Is first time?
			$b_init = ( $cmd == "edit_inp" );
			//-- [END] Is first time?

			//-- [BEGIN] If this is the first time, then save search paramerters
			if ( $b_init ) $this->SaveSearchParams( $def );
			//-- [END] If this is the first time, then save search paramerters

			//-- [BEGIN] Load primary key
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
			//-- [END] Load primary key

			//-- [BEGIN] Validate key(primary key)
			if ( !$def->Validate( XPT_INPUT ) )
			{
				$sc->CriticalError( "Invalid Key" );
				break;
			}
			//-- [END] Validate key(primary key)

			//-- [BEGIN] Load SCart
			$obj =& $def->GetPrimaryKey();
			$trans_id = $obj->GetVal();
			$scart = new CSCart();
			$scart->Setup();
			$scart->Load( $trans_id );
			$GLOBALS['scart'] = $scart;
			//-- [END] Load SCart

			//-- [BEGIN] Set display on
			$b_display = true;
			//-- [END] Set display on

			//-- [BEGIN] Load data from database

			//-- Create query condition
			$qc = $def->GetQueryCond();

			//-- Prepare to get data from record set
			$fs = "(rlog)," . $this->fs_detail;
			if ( $b_init )
			{
				$fs .= "," . $this->fs_edit_inp;
			}
			$def->SetList( $fs );

			//-- Get data from database. if no data, then set display off
			if ( !$def->FromRecordSet( $qc ) )
			{
				$b_display = false;
			}
			//-- [END] Load data from database

			//-- [BEGIN] Output fields
			if ( $b_display )
			{
				//-- Output key in default output format
				$def->SetNS( "rs:def:" );
				$def->SetList( "(key)," . $this->fs_detail );
				$def->ToZBuffer( XC_OF_DEFAULT );

				//-- Output fields in input box
				$def->SetNS( "rs:def:" );
				$def->SetList( $this->fs_edit_inp );
				$def->ToZBuffer( XC_OF_INPUT );

				//-- Output log in default output format
				$def->SetNS( "rs:def:" );
				$def->SetList( "(rlog)" );
				$def->ToZBuffer( XC_OF_DEFAULT );
			}
			//-- [END] Output fields

			//-- [BEGIN] Set Display
			$this->SetDisplay( "def:", $b_display );
			//-- [END] Set Display

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "edit_inp" );
			//-- [END] Set PageID

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "detail" );
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
			$def->FromState();
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

			//-- [BEGIN] Validate Input
			if ( !$def->Validate( XPT_INPUT ) ) return false;
			//-- [END] Validate Input

			//-- [BEGIN] Save data into database
			$def->SetList( $this->fs_edit_save );
			$id = $def->UpdateRecordSet( $qc );
			//-- [END] Save data into database

			//-- [BEGIN] Output Report Info
			$this->ReportInfo( CMBStr::replace( "%s", $this->ps_caption, RSTR_RECORD_UPDATED ) );
			//-- [END] Output Report Info

			//-- [BEGIN] Go to search_ret
			$sc->SetNextSc( 'search_ret' );
			//-- [END] Go to search_ret

			break;

/*
		case 'reg_inp':
		case 'reg_inp_pb':

			//-- [BEGIN] Set verb and caption
			$this->sys->ZBuffer->Set( 'page:caption_verb', RSTR_ADDNEW );
			$this->sys->ZBuffer->Set( 'page:verb', 'reg' );
			//-- [END] Set verb and caption

			//-- [BEGIN] Mark PageSig
			$this->sys->PageSig->Mark( $pagesig_key );
			//-- [END] Mark PageSig

			//-- [BEGIN] Is first time?
			$b_init = ( $cmd == "reg_inp" );
			//-- [END] Is first time?

			//-- [BEGIN] If this is the first time, then save search paramerters
			if ( $b_init ) $this->SaveSearchParams( $def );
			//-- [END] If this is the first time, then save search paramerters

			//-- [BEGIN] Set display on
			$this->SetDisplay( "def:", true );
			//-- [END] Set display on

			//-- [BEGIN] Output input data to zbuffer.
			$def->SetNS( "rs:def:" );
			$def->SetList( $this->fs_reg_inp );
			//-- If this is the first time, get data from input box
			if ( $b_init )
			{
				$def->SetEmpty();
				$def->FromInitValue( 'reg' );
			}
			$def->ToZBuffer( XC_OF_INPUT );
			//-- [END] Output input data to zbuffer.

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "reg_inp" );
			//-- [END] Set PageID

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "detail" );
			//-- [END] Set template page

			break;

		case "reg_done":

			//-- [BEGIN] Check PageSig
			if ( !$this->sys->PageSig->Check( $pagesig_key ) )
			{
				$sc->DoubleSubmitError();
				break;
			}
			//-- [END] Check PageSig

			//-- [BEGIN] Set return page
			$ret_cmd = "reg_inp_pb";
			$sc->SetNextSc( $ret_cmd );
			//-- [END] Set return page

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "reg_inp" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Input & Validate
			$def->SetNS( 'rs:def:' );
			$def->SetList( $this->fs_reg_inp );
			$def->FromInput();
			if ( !$def->Validate( XPT_INPUT ) ) return false;
			//-- [END] Input & Validate

			//-- [BEGIN] Save data into database
			$def->SetList( $this->fs_reg_save );
			$id = $def->InsertRecordSet();
			//-- [END] Save data into database

			//-- [BEGIN] Clear Value
			$def->SetEmpty();
			//-- [END] Clear Value

			//-- [BEGIN] Clear PageSig
			$this->sys->PageSig->Clear( $pagesig_key );
			//-- [END] Clear PageSig

			//-- [BEGIN] Output Report Info
			$this->ReportInfo( CMBStr::replace( "%s", $this->ps_caption, RSTR_RECORD_ADDED ) );
			//-- [END] Output Report Info

			//-- [BEGIN] Go to search_ret
			$sc->SetNextSc( 'search_ret' );
			//-- [END] Go to search_ret

			break;

		case 'del_inp':
		case 'del_inp_pb':

			//-- [BEGIN] Set verb and caption
			$this->sys->ZBuffer->Set( 'page:caption_verb', RSTR_DELETE );
			$this->sys->ZBuffer->Set( 'page:verb', 'del' );
			//-- [END] Set verb and caption

			//-- [BEGIN] Mark PageSig
			$this->sys->PageSig->Mark( $pagesig_key );
			//-- [END] Mark PageSig

			//-- [BEGIN] Is first time?
			$b_init = ( $cmd == "del_inp" );
			//-- [END] Is first time?

			//-- [BEGIN] If this is the first time, then save search paramerters
			if ( $b_init ) $this->SaveSearchParams( $def );
			//-- [END] If this is the first time, then save search paramerters

			//-- [BEGIN] Read primary key
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
			//-- [END] Read primary key

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

			//-- [BEGIN] Create query condition
			$qc = $def->GetQueryCond();
			//-- [END] Create query condition

			//-- [BEGIN] Prepare to get data from record set
			$def->SetList( $this->fs_del_inp . ",(rlog)" );
			//-- [END] Prepare to get data from record set

			//-- [BEGIN] Get data from database. if no data, then set display off
			if ( !$def->FromRecordSet( $qc ) )
			{
				$b_display = false;
			}
			//-- [END] Get data from database. if no data, then set display off

			//-- [BEGIN] Output
			if ( $b_display )
			{
				//-- Output key in default output format
				$def->SetNS( "rs:def:" );
				$def->SetList( "(key)" );
				$def->ToZBuffer( XC_OF_DEFAULT );

				//-- Output fields in input box
				$def->SetNS( "rs:def:" );
				$def->SetList( $this->fs_del_inp );
				$def->ToZBuffer( XC_OF_DEFAULT );

				//-- Output log in default output format
				$def->SetNS( "rs:def:" );
				$def->SetList( "(rlog)" );
				$def->ToZBuffer( XC_OF_DEFAULT );
			}
			//-- [END] Output

			//-- [BEGIN] Set Display
			$this->SetDisplay( "def:", $b_display );
			//-- [END] Set Display

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "del_inp" );
			//-- [END] Set PageID

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "detail" );
			//-- [END] Set template page

			break;

		case "del_done":

			//-- [BEGIN] Check PageSig
			if ( !$this->sys->PageSig->Check( $pagesig_key ) )
			{
				$sc->DoubleSubmitError();
				break;
			}
			//-- [END] Check PageSig

			//-- [BEGIN] Set Return Page
			$ret_cmd = "del_inp_pb";
			$sc->SetNextSc( $ret_cmd );
			//-- [END] Set Return Page

			//-- [BEGIN] Validate the privious page
			if ( !$sc->CheckPrevPageID(
				array( "del_inp" )
			) ) break;
			//-- [END] Validate the privious page

			//-- [BEGIN] Read primary key
			$def->SetNS( "key:def:" );
			$def->SetList( "(key)" );
			$def->FromState();
			//-- [END] Read primary key

			//-- [BEGIN] Validate key(primary key)
			if ( !$def->Validate( XPT_INPUT ) )
			{
				$sc->CriticalError( "Invalid Key" );
				break;
			}
			//-- [END] Validate key(primary key)

			//-- [BEGIN] Create query condition
			$qc = $def->GetQueryCond();
			//-- [END] Create query condition

			//-- [BEGIN] Get the value of primary key
			$pkey =& $def->GetPrimaryKey();
			$pkey_val = $pkey->GetVal();
			//-- [END] Get the value of primary key

			//-- [BEGIN] Log the deletion
			if ( CConfig::Get( 'debug/dump_deleted_record' ) )
			{
				$txt = array();
				$sql = "SELECT * FROM " . $def->Get(XA_TABLE_NAME) . 
					" WHERE " . $pkey->GetName() . "=" . $pkey_val . " LIMIT 1;";
				$txt[] = CGenLog::DumpRecord( $this->sys, $sql );
				$user_id = $this->sys->AuthSession->GetV( $this->sys->Get( XA_FRAME_FIELDSET_ID ) );
				$username = $this->sys->AuthSession->GetV("username");
				$txt[] = "user_id = " . $user_id;
				$txt[] = "username = " . $username;
				$txt = implode( "\r\n", $txt );
				CGenLog::Send( $this->sys,
					$def->Get(XA_TABLE_NAME),
					"Deletion",
					$txt
				);
			}
			//-- [END] Log the deletion

			//-- [BEGIN] Delete from database
			$def->DeleteRecordSet( $qc );
			//-- [END] Delete from database

			//-- [BEGIN] Clear PageSig
			$this->sys->PageSig->Clear( $pagesig_key );
			//-- [END] Clear PageSig

			//-- [BEGIN] Output Report Info
			$this->ReportInfo( CMBStr::replace( "%s", $this->ps_caption, RSTR_RECORD_DELETED ) );
			//-- [END] Output Report Info

			//-- [BEGIN] Set template page
			$sc->SetNextSc( 'search_ret' );
			//-- [END] Set template page

			break;
*/

		default:
			//-- [BEGIN] Unknown command
			$sc->RaiseError( SC_ERR_PAGE_NOT_FOUND );
			//-- [END] Unknown command

			break;
		}
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>