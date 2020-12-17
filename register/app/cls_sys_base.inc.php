<?php

//----------------------------------------------------------------
// Spec
//----------------------------------------------------------------
$spec_sys_base = array(
	XA_CLASS=>'cls_sys_base',
	XA_AUTH=>false,
	XA_DEFAULT_PAGESET=>'member',
);

//----------------------------------------------------------------
// cls_sys_base
//----------------------------------------------------------------
class cls_sys_base extends cls_sys_aso
{
	function OnCompoSpec( &$compo )
	{
		parent::OnCompoSpec( $compo );
		$compo['HtmlMacro'] = 'cls_hm_base';
	}

	function OnLoadPageListSpec()
	{
		include( 'df.pageset.inc.php' );
		$this->SetPageSetSpec( $spec );
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>