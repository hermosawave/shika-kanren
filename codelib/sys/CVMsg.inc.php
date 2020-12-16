<?php

//----------------------------------------------------------------
// CVMsg
//----------------------------------------------------------------
class CVMsg
{
	var $sender;
	var $ls;
	var $msg_arr;

  /**
   * Initialize Object
   *
   * @param object $prt
   * @param array $ls
   * @param array $msg_arr
   */
	function Init( $sender, &$ls, &$msg_arr )
	{
		$this->sender = $sender;
		$this->ls =& $ls;
		$this->msg_arr =& $msg_arr;
	}

  /**
   * Get
   *
   * @param string $key
   * @return string
   */
	function Get( $key )
	{
		if ( isset( $this->msg_arr[$key] ) )
			return $this->msg_arr[$key];
		else
			return '';
	}

  /**
   * Set
   *
   * @param string $key
   * @param string $val
   */
	function Set( $key, $val )
	{
		$this->msg_arr[$key] = $val;
		return $val;
	}
}

//-----------------------------------------------------------------------
// END OF FILE
//-----------------------------------------------------------------------
?>