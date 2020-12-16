<?php

define( 'STR_PAGESIG_KEY', '_page_key' );
define( 'STR_NS_LISTVIEW', '_lv:');
define( 'STR_PAGENO_KEY', 'pn');
define( 'STR_PAGESIZE_KEY', 'ps');
define( 'STR_ORDERBY_KEY', 'ob');

//----------------------------------------------------------------
// CRecordList
//----------------------------------------------------------------
class CRecordList extends CObject
{
	function SetSc( &$sc )
	{
		$this->sc = $sc;
	}

  /**
   * Set name space
   *
   * @param string $ns
   */
	function SetNameSpace( $ns )
	{
		$this->ns = $ns;
	}
	
	function GetNameSpace()
	{
		return $this->ns;
	}

	function SetFieldList( $ls )
	{
		$this->ls = $ls;
	}

  /**
   * Set page #
   *
   * @param integer $init_page_no
   * @param bool $b_force
   */
	function SetPageNo( $init_page_no = 1, $b_force = true )
	{
		if ( $b_force )
			$page_no = $init_page_no;
		else
		{
			$ns_lv = $this->ns . STR_NS_LISTVIEW . STR_PAGENO_KEY;

			$page_no = $this->sys->Request->Get( $ns_lv );
			if ( $page_no == null ) $page_no = $this->sys->State->Get( $ns_lv );

			if (( $page_no == '' ) || ( !CValidator::IsInteger( $page_no ) ))
				$page_no = $init_page_no;
			else
			{
				$page_no = intval( $page_no );
				if ( $page_no < 1 ) $page_no = $init_page_no;
			}
		}
		
		$this->page_no = $page_no;
	}

  /**
   * Set page size
   *
   * @param integer $init_page_size
   */
	function SetPageSize( $init_page_size )
	{
		$ns_lv = $this->ns . STR_NS_LISTVIEW . STR_PAGESIZE_KEY;

		$page_size = $this->sys->Request->Get( $ns_lv );
		if ( $page_size == null ) $page_size = $this->sys->State->Get( $ns_lv );

		if (( $page_size == '' ) || ( !CValidator::IsInteger( $page_size ) ))
			$page_size = $init_page_size;
		else
		{
			$page_size = intval( $page_size );
			if ( $page_size < 0 ) $page_size = $init_page_size;
		}
		
		$this->page_size = $page_size;
	}

  /**
   * Set order by
   *
   * @param string $init_order_by
   */
	function SetOrderBy( $init_order_by )
	{
		$ns_lv = $this->ns . STR_NS_LISTVIEW . STR_ORDERBY_KEY;

		$order_by = $this->sys->Request->Get( $ns_lv );
		if ( $order_by == null ) $order_by = $this->sys->State->Get( $ns_lv );

		if ( $order_by == '' ) $order_by = $init_order_by;

		$this->order_by = $order_by;
	}

  /**
   * Set up
   *
   * @param string $sql
   */
	function Setup( $sql, $msgx = '' )
	{
		$this->msg_no_record = "No Records Found";
		$this->msg_showing_record = "Showing records ##sel_range## of ##total_record##";
		if ( $msgx != '' )
		{
			$this->msg_no_record = $msgx['msg_no_record'];
			$this->msg_showing_record = $msgx['msg_showing_record'];
		}

		$db =& $this->sys->DB;

		//--- [BEGIN] Init
		$ns_lv = $this->ns . STR_NS_LISTVIEW;
		if ( $this->order_by != '' ) $sql .= ' ORDER BY ' . $db->Sanitize($this->order_by);
		//--- [END] Init

		//--- [BEGIN] Get Page Result
		$db->GetPageResult(
			$this->result,
			$sql,
			$this->page_size,
			$this->total_record,
			$this->total_page,
			$this->page_no );
		//--- [END] Get Page Result

		//--- [BEGIN] Calc Page Ranges
		$this->fidx = ( $this->page_no - 1 ) * $this->page_size + 1;
		$this->eidx = $this->page_no * $this->page_size;
		if ( $this->eidx > $this->total_record ) $this->eidx = $this->total_record;
		//--- [END] Calc Page Ranges

		//--- [BEGIN] Page Tabs
		$pt = new CPageTab();
		$w = 5;
		$tmpl_sel = "<span class='pageno_sel'>#PageNo#</span>";
		$tmpl_link = "<a class='pageno' href='' onClick='return CallSubmit(\"" . CPath::ThisFileUrl() . '?'. $ns_lv . STR_PAGENO_KEY . "=#PageNo#&_sc=" . $this->sc . "&\");'>#Caption#</a>";

		$page_tabs = $pt->GetPageTabs( $this->total_page, $this->page_no, $w, $tmpl_sel, $tmpl_link );
		//--- [END] Page Tabs

		//--- [BEGIN] Navigational Messages
		if ( $this->page_no == 0 )
			$msg = $this->msg_no_record;
		else
		{
			$sel_range = ( $this->fidx == $this->eidx ? $this->fidx : $this->fidx . ' - ' . $this->eidx );
			$msg = $this->msg_showing_record;
			$msg = str_replace( "##sel_range##", $sel_range, $msg );
			$msg = str_replace( "##total_record##", $this->total_record, $msg );
		}
		//--- [END] Navigational Messages

		//--- [BEGIN] State Maintenance
		$this->sys->State->Set( $ns_lv . STR_PAGESIZE_KEY,  $this->page_size );
		$this->sys->State->Set( $ns_lv . STR_PAGENO_KEY,  $this->page_no );
		$this->sys->State->Set( $ns_lv . STR_ORDERBY_KEY, $this->order_by );
		//--- [END] State Maintenance

		//--- [BEGIN] ZBuffer
		$zb =& $this->sys->ZBuffer;
		$ns = $this->ns;
		$zb->Set("navi:{$ns}ps", $this->page_size);
		$zb->Set("navi:{$ns}fidx", $this->fidx);
		$zb->Set("navi:{$ns}eidx", $this->eidx);
		$zb->Set("navi:{$ns}page_tabs", $page_tabs);
		$zb->Set("stat:{$ns}msg", $msg);
		$zb->Set("stat:{$ns}total_record", $this->total_record);
		$zb->Set("stat:{$ns}total_page", $this->total_page);
		foreach( $this->ls as $vfield )
			$zb->Set( "ob:{$ns}{$vfield}", $this->GetOrderByIcons( $vfield ) );
		//--- [END] ZBuffer

		return $this->total_record;
	}

  /**
   * Fetch next record
   *
   * @return handle
   */
	function FetchNextRecord()
	{
		if ( !$this->result ) return false;
		$db =& $this->sys->DB;
		if ( !( $rs = $db->GetRowA( $this->result ) ) ) return false;
		return $rs;
	}

  /**
   * Set next record
   *
   * @param object $obj
   * @param object $rs
   * @param string $ns
   * @param array $ls
   */
	function SetNextRecord( &$obj, &$rs, $list_display = null, $param = null )
	{
		$ns = $this->ns;

		//---------------------------
		$ls = $this->ls;
		foreach( $ls as $key => $val ) $ls[$key] = $key;
		if ( $list_display == null ) $list_display = $ls;
		//---------------------------

		$obj->SendMsg( $ls, array( XM_CMD=>XC_IS_RECORD, XM_RS=>$rs ) );
		$px = array( XM_CMD=>XC_OF_DEFAULT, XM_NS=>$ns );
		if ( is_array( $param ) ) foreach ( $param as $key => $val ) $px[$key] = $val;
		$obj->SendMsg( $list_display, $px );
	}

	function GetOrderByIcons( $vfield )
	{
		return
			$this->CreateOrderByLink( $vfield, "ASC" ) . 
			$this->CreateOrderByLink( $vfield, "DESC" );
	}

	function CreateOrderByLink( $vfield, $asc_desc, $class_name = "" )
	{
		$ns_lv = $this->ns . STR_NS_LISTVIEW;
		$up_down = ( $asc_desc == "ASC" ? "up" : "down" );
		$on_off = ( $this->order_by == $vfield . " " . $asc_desc ? "on" : "off" );
		if ( $class_name == '' ) $class_name = 'class_orderby_button';
		
		return
			"<a class='" . $class_name . "' href='' onClick='return CallSubmit(" . 
				"\"". 
					CPath::ThisFileUrl() . '?' . 
					$ns_lv . STR_PAGENO_KEY . "=1&" . 
					"_sc=" . $this->sc . "&" .
					$ns_lv . STR_ORDERBY_KEY . "=" . $vfield . " " . $asc_desc.
				"\"" .
			");'>" .
			$this->GetOrderByIcon( $up_down, $on_off ) . 
			"</a>";
	}
	
	function GetOrderByIcon( $up_down, $on_off )
	{
		switch( 1 )
		{
		case 1:
			$image_path = "images/order_by";
			return "<img src='" . $image_path . "/icon_" . $up_down . "_" . $on_off . ".gif' border='0'>";

		case 2:
			$ch = ( $up_down == "up" ? '&and;' : '&or;' );
			$color = ( $on_off == "on" ? 'white' : '#a0a0a0' );
			return "<span style='color:{$color};'>{$ch}</span>";
		}
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>