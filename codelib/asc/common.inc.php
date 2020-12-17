<?php

require( "CConst.inc.php" );
require( "CSCart.inc.php" );
require( "CMemberInfo.inc.php" );
require( "CVFileUpload.inc.php" );
require( "CCleanUpTmpFolder.inc.php" );

//----------------------------------------------------------------
// FileList
//----------------------------------------------------------------
require( "cls_fl_aso.inc.php" );
require( 'cls_fl_staff.inc.php' );
require( 'cls_fl_member.inc.php' );
require( 'cls_fl_maker.inc.php' );
require( 'cls_fl_category.inc.php' );
require( 'cls_fl_product.inc.php' );
require( 'cls_fl_trans.inc.php' );
require( 'cls_fl_items.inc.php' );
require( 'cls_fl_const.inc.php' );

//----------------------------------------------------------------
// HtmlMacro
//----------------------------------------------------------------
class cls_hm_aso extends CHtmlMacro {}

//----------------------------------------------------------------
// Authorization
//----------------------------------------------------------------
class cls_auth_aso extends CAuthorization {}

//----------------------------------------------------------------
// PageSet
//----------------------------------------------------------------
class cls_ps_aso extends CVPageSetEx {}

//----------------------------------------------------------------
// System
//----------------------------------------------------------------
class cls_sys_aso extends CVSystem
{
	function Run()
	{
		LoadConst();
		parent::Run();
	}

	function IsAdmin()
	{
		return false;
	}

	function ShowRLog()
	{
		$b = ( $this->sys->GetUserType( UT_STAFF ) == UT_STAFF );
		return $b;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>