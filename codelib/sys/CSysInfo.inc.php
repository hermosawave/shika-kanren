<?php

//----------------------------------------------------------------
// CSysInfo
//----------------------------------------------------------------
class CSysInfo extends CObject
{
	function Setup()
	{
		$this->sys->ZBuffer->Set('page:err_msg', "");
		$this->sys->ZBuffer->Set('page:info_msg', "");
		$this->list_err = array();
		$this->list_info = array();
	}

	function Commit()
	{
		$err_msg = implode( '<br>', $this->list_err );
		$this->sys->ZBuffer->Set('page:err_msg', $err_msg );

		$info_msg = implode( '<br>', $this->list_info );
		$this->sys->ZBuffer->Set('page:info_msg', $info_msg );
	}

	function SetErrMsg( $list_err )
	{
		if ( is_array( $list_err ) ) 
			$this->list_err = array_merge( $this->list_err, $list_err );
		else
			$this->list_err[] = $list_err;
		
		return ( count( $list_err ) > 0 );
	}
	
	function SetInfoMsg( $list_info )
	{
		if ( is_array( $list_info ) ) 
			$this->list_info = array_merge( $this->list_info, $list_info );
		else
			$this->list_info[] = $list_info;

		return ( count( $list_info ) > 0 );
	}

}

//-----------------------------------------------------------------------
// END OF FILE
//-----------------------------------------------------------------------
?>