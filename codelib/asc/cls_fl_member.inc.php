<?php

//----------------------------------------------------------------
// cls_fl_member
//----------------------------------------------------------------
class cls_fl_member extends cls_fl_aso
{
}

//----------------------------------------------------------------
// cls_EmailConf
//----------------------------------------------------------------
class cls_EmailConf extends CVEmail
{
  /**
   * Validate the value of the object
   *
   * @param object $msg
   * @return true = success, false = failure
   *
   */
	function Validate_Value( &$msg )
	{
		$v = $this->val;
		if ( !parent::Validate_Value( $msg ) ) return false;
		if ( !$this->Validate_Conf( $v ) ) return false;
		return true;
	}
	
  /**
   * Confirm email
   *
   * @param object $msg
   * @return true = success, false = failure
   *
   */
	function Validate_Conf( $v )
	{
		$obj =& $this->prt->GetChild('email');
		if ( ! ( $v == $obj->GetVal() ) )
		{
			$this->SetPDErrMsg( EMT_CAN_NOT_CONFIRM, $v );
			return false;
		}

		return true;
	}
}

//----------------------------------------------------------------
// cls_PasswordConf
//----------------------------------------------------------------
class cls_PasswordConf extends CVPassword
{
  /**
   * Validate the value of the object
   *
   * @param object $msg
   * @return true = success, false = failure
   *
   */
	function Validate_Value( &$msg )
	{
		$v = $this->val;
		if ( !parent::Validate_Value( $msg ) ) return false;
		if ( !$this->Validate_Conf( $v ) ) return false;
		return true;
	}
	
  /**
   * Confirm email
   *
   * @param object $msg
   * @return true = success, false = failure
   *
   */
	function Validate_Conf( $v )
	{
		$obj =& $this->prt->GetChild('password');
		if ( ! ( $v == $obj->GetVal() ) )
		{
			$this->SetPDErrMsg( EMT_CAN_NOT_CONFIRM, $v );
			return false;
		}

		return true;
	}
}

//----------------------------------------------------------------
// cls_email_login
//----------------------------------------------------------------
class cls_email_login extends CVEmail
{
	function Validate_Value( &$msg )
	{
		$v = $this->val;
		if ( !parent::Validate_Value( $msg ) ) return false;
		return true;
	}
}

//----------------------------------------------------------------
// cls_member_password_old
//----------------------------------------------------------------
class cls_member_password_old extends CVPassword
{
	function Validate_Value( &$msg )
	{
		$v = $this->val;
		if ( !parent::Validate_Value( $msg ) ) return false;
		if ( !$this->Validate_Password( $v ) ) return false;
		return true;
	}

	function Validate_Password( $v )
	{
		$password = CMemberInfo::GetMemberPassword();
		if ( ! ( $v == $password ) )
		{
			$this->SetPDErrMsg( EMT_CAN_NOT_CONFIRM, $v );
			return false;
		}

		return true;
	}
}

//----------------------------------------------------------------
// cls_member_password_new_conf
//----------------------------------------------------------------
class cls_member_password_new_conf extends CVPassword
{
	function Validate_Value( &$msg )
	{
		$v = $this->val;
		if ( !parent::Validate_Value( $msg ) ) return false;
		if ( !$this->Validate_Conf( $v ) ) return false;
		return true;
	}

	function Validate_Conf( $v )
	{
		$obj =& $this->prt->GetChild('password_new');
		if ( ! ( $v == $obj->GetVal() ) )
		{
			$this->SetPDErrMsg( EMT_CAN_NOT_CONFIRM, $v );
			return false;
		}

		return true;
	}
}



//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>