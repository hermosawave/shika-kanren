<?php

function LoadCategoryName( $category_id )
{
	global $sys;
	$db =& $sys->DB;
	$table_name = TBL_CATEGORY;
	$flist = array( "category_name" );
	$qc = array( "category_id = " . $category_id );
	$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
	$result = $db->Query( $sql );
	if ( $rs = $db->GetRowA( $result ) )
	{
		global $selected_category;
		$selected_category = CStr::html( $rs['category_name'] );
	}
	$db->FreeResult( $result );
}

function GetMakerInfo( $maker_id )
{
	global $sys;
	$db =& $sys->DB;
	$table_name = TBL_MAKER;
	$flist = array( "maker_name", "url" );
	$qc = array( "maker_id = " . $maker_id . "" );
	$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
	$result = $db->Query( $sql );
	if ( $rs = $db->GetRowA( $result ) )
	{
		$ax = array(
			'name'=>CStr::html( $rs['maker_name'] ),
			'url'=>$rs['url']
		);
	}
	$db->FreeResult( $result );
	return $ax;
}

//----------------------------------------------------------------
// cls_ps_product
//----------------------------------------------------------------
class cls_ps_product extends cls_ps_base
{
	var $ps_caption = RSTR_PRODUCT;
	var $fs_name = 'product';
	var $fs_detail = '(product_detail)';

	//------------------------------------------------------------
	// GetFilePrefix
	//------------------------------------------------------------
	function GetFilePrefix()
	{
		return "product";
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

		//------------------------------------------------------
		// Search
		//------------------------------------------------------
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
			$def->SetList( "(list_sp)" );

			$cid = '';
			switch ( $cmd )
			{
			case "search_ret":
				$cid = ( isset( $_SESSION['_cid_'] ) ? $_SESSION['_cid_'] : '' );

				//-- Restore state to fieldlist and clear state
				//$def->FromState();
				//$def->ClearState();
				break;

			case "search":
				$cid = $this->sys->GetIV('cid');
				if ( $cid != "" )
				{
					if ( !CValidator::IsInteger( $cid ) )
					{
						$sc->CriticalError( "Invalid Key" );
						return;
					}
				}
				$_SESSION['_cid_'] = $cid;

				//-- Set criteria input to fieldlist and set init values
				//$def->FromInput();
				//$def->FromInitValue( 'search' );
				break;

			case "search_pb":
			case "search_ps":
				$cid = ( isset( $_SESSION['_cid_'] ) ? $_SESSION['_cid_'] : '' );

				//-- Set criteria input to fieldlist
				//$def->FromInput();
				break;
			}
			//-- [END] Prepare to get criteria from state or criteria input

			$obj =& $def->GetChild('active');
			$obj->SetVal( 'Y' );

			global $selected_category;
			$selected_category = '登録商品';
			if ( $cid != '' )
			{
				$obj =& $def->GetChild('category_id');
				$obj->SetVal( $cid );
				LoadCategoryName( $cid );
			}

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
				$def->SetList( "(list_sr)" );
				$b_clear = ( $cmd == "search_pb" );
				$def->Set( "record_list_msg",
					array(
						'msg_no_record' => "No Products Found",
						'msg_showing_record' => "##sel_range##件目 / ##total_record##件"
					)
				);
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

		//------------------------------------------------------
		// Detail
		//------------------------------------------------------
		case 'detail':

			//-- [BEGIN] Load primary key
			$def->SetNS( "key:def:" );
			$def->SetList( "(key)" );
			$def->FromInput();
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

			//-- Create query condition
			$qc = $def->GetQueryCond();

			//-- Prepare to get data from record set
			$def->SetList( $this->fs_detail );

			//-- Get data from database. if no data, then set display off
			if ( !$def->FromRecordSet( $qc ) )
			{
				$b_display = false;
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
				$def->SetList( $this->fs_detail );
				$def->ToZBuffer( XC_OF_DEFAULT );
			}
			//-- [END] Output fields

			//-- [BEGIN] Set Display
			$this->SetDisplay( "def:", $b_display );
			//-- [END] Set Display

			//-- [BEGIN] Set PageID
			$sc->SetPageID( "detail" );
			//-- [END] Set PageID

			//-- [BEGIN] Set template page
			$this->SetPage( $sc, "detail" );
			//-- [END] Set template page

			break;

		//------------------------------------------------------
		// SCart
		//------------------------------------------------------

		case 'scart':

			global $scart;
			$scart = OpenSCart();
			CloseSCart( $scart );
			$this->SetSCartPage( $sc, $scart );
			break;

		case 'scart_add':

			global $scart;
			$scart = OpenSCart();

			$pid = $this->sys->GetIV('pid');
			if ( CValidator::IsInteger( $pid ) )
			{
				$scart->AddItem( $pid, 1 );
			}

			CloseSCart( $scart );
			$this->SetSCartPage( $sc, $scart );
			break;

		case 'scart_update_qty':

			global $scart;
			$scart = OpenSCart();

			$pid = $this->sys->GetIV('pid');
			if ( CValidator::IsInteger( $pid ) )
			{
				$name = "qty_" . $pid;
				$qty = $this->sys->GetIV($name);
				if ( CValidator::IsInteger( $qty ) )
				{
					$scart->UpdateItem( $pid, $qty );
				}
			}

			CloseSCart( $scart );
			$this->SetSCartPage( $sc, $scart );
			break;

		case 'scart_remove':

			global $scart;
			$scart = OpenSCart();

			$pid = $this->sys->GetIV('pid');
			if ( CValidator::IsInteger( $pid ) )
			{
				$scart->RemoveItem( $pid );
			}

			CloseSCart( $scart );
			$this->SetSCartPage( $sc, $scart );
			break;

		case 'scart_checkout':

			global $scart;
			$scart = OpenSCart();

			if ( $scart->Count() == 0  )
			{
				CUtil::RelRedirect( "../index.php" );
			}
			else
			{
				if ( CMemberInfo::IsLoggedIn() )
				{
					CUtil::RelRedirect( "../checkout/index.php", true );
				}
				else
				{
					CUtil::RelRedirect( "../member/index.php?dest=checkout", true );
				}
			}
			break;

		//------------------------------------------------------
		// Unknown
		//------------------------------------------------------
		default:
			//-- [BEGIN] Unknown command
			$sc->RaiseError( SC_ERR_PAGE_NOT_FOUND );
			//-- [END] Unknown command

			break;
		}
	}

	function SetScartPage( &$sc, &$scart )
	{
		$page_name = ( $scart->Count() > 0 ? "scart" : "scart_empty" );

		//-- [BEGIN] Set template page
		$this->SetPage( $sc, $page_name );
		//-- [END] Set template page
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>