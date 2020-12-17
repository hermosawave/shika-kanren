<?php

//----------------------------------------------------------------
// CSCart
//----------------------------------------------------------------
class CSCart
{
	function Setup()
	{
		$this->items = array();
	}

	function CreateItem( $pid, $qty )
	{
		$item = array();
		$item['pid'] = $pid;
		$item['qty'] = $qty;

		//-- [BEGIN] Get Product Data
		global $sys;
		$db =& $sys->DB;
		$table_name = TBL_PRODUCT;
		$flist = array(
			"product_code",
			"product_name",
			"price",
			"size",
			"category_id",
			"maker_id",
			"pic_s"
		);
		$qc = array( "product_id = " . $pid . "" );
		$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
		$result = $db->Query( $sql );
		if ( $rs = $db->GetRowA( $result ) )
		{
			$item['product_name'] = $rs['product_name'];
			$item['product_code'] = $rs['product_code'];
			$item['price'] = CStr::html( $rs['price'] );
			$item['size'] = $rs['size'];
			$item['category_id'] = $rs['category_id'];
			$item['maker_id'] = $rs['maker_id'];
			$item['pic_s'] = $rs['pic_s'];
		}
		else
			$item = null;
		$db->FreeResult( $result );
		//-- [END] Get Product Data

		return $item;
	}

	function Count()
	{
		return count( $this->items );
	}

	function AddItem( $pid, $qty )
	{
		$this->ChangeItem( $pid, $qty, true );
	}

	function UpdateItem( $pid, $qty )
	{
		if ( $qty == 0 )
			$this->RemoveItem( $pid );
		else
			$this->ChangeItem( $pid, $qty, false );
	}

	function ChangeItem( $pid, $qty, $b_add_qty )
	{
		$items = array();
		$b_found = false;
		foreach( $this->items as $item )
		{
			if ( $item['pid'] == $pid )
			{
				if ( $b_add_qty )
					$item['qty'] = $item['qty'] + $qty;
				else
					$item['qty'] = $qty;
				$b_found = true;
			}

			$items[] = $item;
		}

		if ( !$b_found )
		{
			$ax = $this->CreateItem( $pid, $qty );
			if ( $ax != null ) $items[] = $ax;
		}

		$this->items = $items;
		$this->Calc();
	}

	function RemoveItem( $pid )
	{
		$items = array();
		foreach( $this->items as $item )
		{
			if ( $item['pid'] != $pid )
			{
				$items[] = $item;
			}
		}
		$this->items = $items;
		$this->Calc();
	}

	function FormatDollar( $v )
	{
		return sprintf( "%1.2f", $v );
	}

	function OverMinimum()
	{
		return ( $this->items_total > MINIMUM_TOTAL_AMOUNT );
	}

	function Calc()
	{
		//-- Items Total
		$total = 0;
		foreach( $this->items as $item )
		{
			$total += $this->FormatDollar( $item['price'] ) * $item['qty'];
		}
		$this->items_total = $this->FormatDollar( $total );

		//-- Handling Rate
		if ( $this->OverMinimum() )
			$this->handling_rate = "(" . HANDLING_RATE . "%)";
		else
			$this->handling_rate = "";

		//-- Handling Fee
		if ( $this->OverMinimum() )
		{
			$this->handling_fee = $this->FormatDollar( $this->items_total * HANDLING_RATE / 100 );
		}
		else
		{
			$this->handling_fee = $this->FormatDollar( MINIMUM_HANDLING_FEE );
		}

		//-- Grand Total
		$this->grand_total = $this->FormatDollar( $this->items_total + $this->handling_fee );
	}

	function ItemsTotal()
	{
		return $this->items_total;
	}

	function HandlingRate()
	{
		return $this->handling_rate;
	}

	function HandlingFee()
	{
		return $this->handling_fee;
	}

	function GrandTotal()
	{
		return $this->grand_total;
	}

	function GrandTotalYen()
	{
		$v = $this->GrandTotal();
		global $yen_per_dollar;
		$v = $v * $yen_per_dollar;
		$v = number_format($v);
		return $v;
	}

	function Save( $trans_id )
	{
		global $sys;
		$db =& $sys->DB;

		//-- [BEGIN] Trans
		$table_name = TBL_TRANS;
		$fv = array(
			array( "items_total", $this->ItemsTotal() ),
			array( "handling_rate", "'" . $db->Sanitize($this->HandlingRate()) . "'" ),
			array( "handling_fee", $this->HandlingFee() ),
			array( "grand_total", $this->GrandTotal() )
		);
		$qc = array(
			"trans_id = " . $trans_id . ""
		);
		$db->UpdateRecord( $table_name, $fv, $qc );
		//-- [END] Trans

		//-- [BEGIN] Items
		$table_name = TBL_ITEMS;
		foreach( $this->items as $item )
		{
			$fv = array(
				array( "trans_id", $trans_id ),
				array( "product_id", $item['pid'] ),
				array( "product_code", "'" . $db->Sanitize( $item['product_code'] ) . "'" ),
				array( "product_name", "'" . $db->Sanitize( $item['product_name'] ) . "'" ),
				array( "size", "'" . $db->Sanitize( $item['size'] ) . "'" ),
				array( "category_id", $item['category_id'] ),
				array( "maker_id", $item['maker_id'] ),
				array( "price", $this->FormatDollar( $item['price'] ) ),
				array( "qty", $item['qty'] ),
				array( "total", $this->FormatDollar( $item['price'] ) * $item['qty'] ),
			);
			$db->InsertRecord( $table_name, $fv );
		}
		//-- [BEGIN] Items
	}

	function Load( $trans_id )
	{
		global $sys;
		$db =& $sys->DB;

		//-- [BEGIN] Trans
		$table_name = TBL_TRANS;
		$flist = array(
			"items_total",
			"handling_rate",
			"handling_fee",
			"grand_total"
		);
		$qc = array( "trans_id = " . $trans_id . "" );
		$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
		$result = $db->Query( $sql );
		if ( $rs = $db->GetRowA( $result ) )
		{
			$this->items_total = $rs['items_total'];
			$this->handling_rate = $rs['handling_rate'];
			$this->handling_fee = $rs['handling_fee'];
			$this->grand_total = $rs['grand_total'];
		}
		$db->FreeResult( $result );
		//-- [END] Trans

		//-- [BEGIN] Items
		$this->items = array();
		$table_name = TBL_ITEMS;
		$flist = array(
			"trans_id",
			"product_id",
			"product_code",
			"product_name",
			"size",
			"category_id",
			"maker_id",
			"price",
			"qty",
			"total"
		);
		$qc = array( "trans_id = " . $trans_id . "" );
		$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
		$result = $db->Query( $sql );
		while ( $rs = $db->GetRowA( $result ) )
		{
			$item = array(
				'trans_id' => $rs['trans_id'],
				'pid' => $rs['product_id'],
				'product_code' => $rs['product_code'],
				'product_name' => $rs['product_name'],
				'size' => $rs['size'],
				'category_id' => $rs['category_id'],
				'maker_id' => $rs['maker_id'],
				'price' => $rs['price'],
				'qty' => $rs['qty'],
				'total' => $rs['total']
			);
			$this->items[] = $item;
		}
		$db->FreeResult( $result );
		//-- [BEGIN] Items
	}
}

//----------------------------------------------------------------
// CSItem
//----------------------------------------------------------------
class CSItem
{
	function Setup( $item )
	{
		$this->item = $item;	
	}

	function Pid()
	{
		$v = $this->item['pid'];
		return $v;
	}

	function Qty()
	{
		$v = $this->item['qty'];
		return $v;
	}

	function ProductCode()
	{
		return CStr::html( $this->item['product_code'] );
	}

	function ProductName()
	{
		return CStr::html( $this->item['product_name'] );
	}

	function Size()
	{
		return CStr::html( $this->item['size'] );
	}

	function Maker( $b_link = true )
	{
		$maker_id = $this->item['maker_id'];

		global $sys;
		$db =& $sys->DB;
		$table_name = TBL_MAKER;
		$flist = array( "maker_name", "url" );
		$qc = array( "maker_id = " . $maker_id . "" );
		$sql = $db->GetSQLSelect( $table_name, $flist, $qc );
		$result = $db->Query( $sql );
		if ( $rs = $db->GetRowA( $result ) )
		{
			$maker_name = CStr::html( $rs['maker_name'] );
			$url = $rs['url'];
		}
		$db->FreeResult( $result );

		if (( $url == null ) || ( !$b_link ))
		{
			$v = $maker_name;
		}
		else
		{
			$v = "<a href='" . $url . "' target='_blank'>" .
				$maker_name . "</a>";
		}

		return $v;
	}

	function Price()
	{
		$v = $this->item['price'];
		return sprintf( "%1.2f", $v );
	}

	function PriceYen()
	{
		$v = $this->item['price'];
		global $yen_per_dollar;
		$v = $v * $yen_per_dollar;
		$v = number_format($v);
		return $v;
	}

	function Total()
	{
		$v = $this->item['price'] * $this->item['qty'];
		return sprintf( "%1.2f", $v );

	}

	function TotalYen()
	{
		$v = $this->item['price'] * $this->item['qty'];
		global $yen_per_dollar;
		$v = $v * $yen_per_dollar;
		$v = number_format($v);
		return $v;
	}

	function PicS()
	{
		$obj =& CUtil::CreateObject( "cls_pic_up" );
		$obj->Setup();
		$obj->SetVal( $this->item['pic_s'] );
		$obj->SetDBData();
		$obj->empty_filename = "no_pic_s.png";
		$url = $obj->GetFileUrl();
		return $url;
	}
}

//----------------------------------------------------------------
// Shopping Cart
//----------------------------------------------------------------
define( 'SCART_KEY', "SCart:(" . __FILE__ . ")" );

function &OpenSCart()
{
	if ( isset( $_SESSION[SCART_KEY] ) )
	{
		$obj =& unserialize( $_SESSION[SCART_KEY] );
	}
	else
	{
		$obj = new CSCart();
		$obj->Setup();
	}

	return $obj;
}

function CloseSCart( &$obj )
{
	 $_SESSION[SCART_KEY] = serialize( $obj );
}

function ResetSCart()
{
	 unset( $_SESSION[SCART_KEY] );
}

function &GetItemObj( $item )
{
	$obj = new CSItem();
	$obj->Setup( $item );
	return $obj;
}

?>