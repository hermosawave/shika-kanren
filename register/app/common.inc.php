<?php

//----------------------------------------------------------------
// System Platform
//----------------------------------------------------------------
require( dirname(__FILE__). "/../../codelib/sys/common.inc.php" );

//----------------------------------------------------------------
// Application Shared Code
//----------------------------------------------------------------
require( dirname(__FILE__). "/../../codelib/asc/common.inc.php" );

//----------------------------------------------------------------
// Resource
//----------------------------------------------------------------
require( "res.{$LANG_CODE}.inc.php" );

//----------------------------------------------------------------
// PageSet
//----------------------------------------------------------------
require( 'cls_ps_base.inc.php' );
require( 'cls_ps_member.inc.php' );

//----------------------------------------------------------------
// HtmlMacro
//----------------------------------------------------------------
require( 'cls_hm_base.inc.php' );

//----------------------------------------------------------------
// System
//----------------------------------------------------------------
require( 'cls_sys_base.inc.php' );

//-----------------------------------------------------------------------
// [END] StartUp Code
//-----------------------------------------------------------------------

?>