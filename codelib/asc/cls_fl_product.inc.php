<?php

//----------------------------------------------------------------
// cls_fl_product
//----------------------------------------------------------------
class cls_fl_product extends cls_fl_aso
{
}

//----------------------------------------------------------------
// cls_category_sel
//----------------------------------------------------------------
class cls_category_sel extends CVSelection
{
	function Setup()
	{
		parent::Setup();

		$this->sel_text = $this->Populate(
			$msg,
			TBL_CATEGORY,
			array( "category_id", "category_name" ),
			array(  ), /* array( "active = 'Y'" ) */
			"view_order ASC"
		);
	}
}

//----------------------------------------------------------------
// cls_maker_sel
//----------------------------------------------------------------
class cls_maker_sel extends CVSelection
{
	function Setup()
	{
		parent::Setup();

		$this->sel_text = $this->Populate(
			$msg,
			TBL_MAKER,
			array( "maker_id", "maker_name" ),
			array(  ), /* array( "active = 'Y'" ) */
			"maker_name ASC"
		);
	}
}

//----------------------------------------------------------------
// cls_yen
//----------------------------------------------------------------
class cls_yen extends CVText
{
	function &OutputDefault( &$msg )
	{
		$v = $this->GetVal();
		global $yen_per_dollar;
		$v = $v * $yen_per_dollar;
		$v = number_format($v);
		$os = new COutString();
		$os->AddItem( CStr::n2e( $v ) );
		return $os;
	}
}

//----------------------------------------------------------------
// cls_pic_up
//----------------------------------------------------------------
class cls_pic_up extends CVImageUpload
{
	function Setup()
	{
		$this->file_key = 'rs:def:' . $this->GetName() . '_inp';
		$this->ext_list = array( 'jpg', 'jpeg', 'gif', 'png' );
		$this->fn_prefix = 'f_';

		$root_dir = dirname( __FILE__ ) . PATH_REL_TO_PIC_FOLDER;
		$this->path_tmp_storage = $root_dir . "tmp/";
		$this->path_sys_storage = $root_dir . "sys/";
		$this->path_empty_storage = $root_dir . "empty/";
		$this->empty_filename =  $this->Get('EMPTY_FILENAME');

		$this->max_pic_width = $this->Get('MAX_PIC_WIDTH');
		$this->max_pic_height = $this->Get('MAX_PIC_HEIGHT');;

		return nothing;
	}

	function ValidateUpload( $path, &$errmsg )
	{
		//-- [BEGIN] Get Image Dimention
		list($width, $height) = @getimagesize( $path );
		//-- [END] Get Image Dimention

		//-- [BEGIN] Check if file is image format
		if ( !isset( $width ) )
		{
			$errmsg = 'Invalid file format';
			return false;
		}
		//-- [END] Check if file is image format

		//-- [BEGIN] Width Check
		if ( $width > $this->max_pic_width )
		{
			$errmsg = "The image width ( {$width} pixels ) exceeds the maximum limit ( " .
				sprintf( "%d", $this->max_pic_width ) . " pixels )";
			return false;
		}
		//-- [END] Width Check

		//-- [BEGIN] Height Check
		if ( $height > $this->max_pic_height )
		{
			$errmsg = "The image height ( {$height} pixels ) exceeds the maximum limit ( " .
				sprintf( "%d", $this->max_pic_height ) . " pixels )";
			return false;
		}
		//-- [END] Height Check

		return true;
	}

	function Validate_Value( &$msg )
	{
		return true;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>