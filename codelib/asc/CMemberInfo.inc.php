<?php

//----------------------------------------------------------------
// CMemberInfo
//----------------------------------------------------------------
class CMemberInfo
{
	function IsLoggedIn()
	{
		return isset( $_SESSION['member_id'] );
	}

	function GetMemberID()
	{
		return $_SESSION['member_id'];
	}

	function GetMemberName()
	{
		return $_SESSION['member_name'];
	}

	function GetMemberPassword()
	{
		return $_SESSION['member_password'];
	}

	function SetMemberInfo( $user_id, $name_jpn, $password )
	{
		$_SESSION['member_id'] = $user_id;
		$_SESSION['member_name'] = $name_jpn;
		$_SESSION['member_password'] = $password;
	}

	function ResetMemberInfo()
	{
		unset( $_SESSION['member_id'] );
		unset( $_SESSION['member_name'] );
		unset( $_SESSION['member_password'] );
	}
}

?>