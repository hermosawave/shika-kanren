<?php

//----------------------------------------------------------------
// CVDay
//----------------------------------------------------------------
class CVDay extends CVSerialSel
{
  /**
   * Set up the object
   *
   * @param object $msg
   *
   */
	function Setup()
	{
		$this->sstr = "";
		$this->snum = 1;
		$this->enum = 31;
		return nothing;
	}
}

//----------------------------------------------------------------
// CVMonth
//----------------------------------------------------------------
class CVMonth extends CVSerialSel
{
  /**
   * Set up the object
   *
   * @param object $msg
   *
   */
	function Setup()
	{
		$this->sstr = "";
		$this->snum = 1;
		$this->enum = 12;
		return nothing;
	}
}

//----------------------------------------------------------------
// CVYear
//----------------------------------------------------------------
class CVYear extends CVSerialSel
{
  /**
   * Set up the object
   *
   * @param object $msg
   *
   */
	function Setup()
	{
		$this->sstr = "";
		$this->snum = intval( date('Y') );
		$this->enum = $this->snum - 20;
		return nothing;
	}
}

//----------------------------------------------------------------
// CVCCExp_Year
//----------------------------------------------------------------
class CVCCExp_Year extends CVYear
{
  /**
   * Set up the object
   *
   * @param object $msg
   *
   */
	function Setup()
	{
		$this->sstr = "";
		$this->snum = intval( date('Y') );
		$this->enum = $this->snum + 10;
		return nothing;
	}
}

//----------------------------------------------------------------
// CVCCNumber
//----------------------------------------------------------------
class CVCCNumber extends CVText
{
  /**
   * Ouputs the value of the object in the default format
   *
   * @param object $msg
   *
   */
	function &OutputDefault( &$msg )
	{
		$os = new COutString();
		$os->AddItem( $v );
		return $os;

/*
		switch ( $msg->Get(XA_FORMAT) )
		{
		case XPT_CSV:
			$v = $this->GetVal();
			break;
			
		default:
			$v = "xxxxxxxxxxxx" . substr( $this->GetVal(), 12 );
			break;
		}
		
		return $v;
*/

	}

  /**
   * Validate the value of the object
   *
   * @param object $msg
   * @return true = yes, false = no
   *
   */
	function Validate_Value( &$msg )
	{
		$v = $this->GetVal();
		if ( !parent::Validate_Value( $msg ) ) return false;
		if ( !$this->Validate_CreditCardNumber( $v ) ) return false;
		if ( !$this->Validate_MasterOrVisa( $v ) ) return false;
		return true;
	}
	
  /**
   * Validate the value of a credit card number
   *
   * @param object $msg
   * @return true = yes, false = no
   *
   */
	function Validate_CreditCardNumber( $v )
	{
		if ( !ereg("^([0-9]{16})$", $v) )
		{
			$this->SetPDErrMsg( EMT_INVALID_FORMAT, $v );
			return false;
		}

		return true;
	}		

  /**
   * Validate if the value is master card or visa
   *
   * @param object $msg
   * @return true = yes, false = no
   *
   */
	function Validate_MasterOrVisa( $v )
	{
		if ( !ereg("^([4,5]{1})([0-9]{15})$", $v) )
		{
			$this->SetErrMsg( "「Master Card」または「Visa」をご使用ください。", $v );
			return false;
		}

		return true;
	}		
}

//----------------------------------------------------------------
// CVCCExp
//----------------------------------------------------------------
class CVCCExp extends CVFieldSet
{
	var $year;
	var $month;

  /**
   * Set up the child objects
   *
   * @param object $msg
   *
   */
	function CreateChildren()
	{
		$name = $this->GetName();
		$cap = $this->GetCaption();
		$capch = $this->Get(XA_CAPTION_CHILD);
		if ( !is_array( $capch ) ) $capch = array( 'year'=>'Year', 'month'=>'Month' );

		$this->year =& $this->SetupObject( $this, $name . '_year',
			array(
				XA_CLASS=>'CVCCExp_Year',
				XA_CAPTION=>$cap . $this->FrameChildCaption($capch['year']),
				XA_REQUIRED=>REQ_ASK_PARENT,
				XA_MIN_CHAR=>4,
				XA_MAX_CHAR=>4,
				XA_SELECT_ON_TOP=>STR_DEF_SELECT_CAPTION
			)
		);
		
		$this->month =& $this->SetupObject( $this, $name . '_month',
			array(
				XA_CLASS=>'CVMonth',
				XA_CAPTION=>$cap . $this->FrameChildCaption($capch['month']),
				XA_REQUIRED=>REQ_ASK_PARENT,
				XA_MIN_CHAR=>1,
				XA_MAX_CHAR=>2,
				XA_SELECT_ON_TOP=>STR_DEF_SELECT_CAPTION
			)
		);
	}

  /**
   * Event Message Procedure
   *
   * @param object $msg
   * @return string
   *
   */
	function XProc( &$msg )
	{
		switch ( $msg->Get(XM_CMD) )
		{

		case XC_IS_RECORD:
			if ( $this->Get(XA_NAME_RS) == nothing ) return nothing;
			$rs =& $msg->Get(XM_RS);
			$this->SetVal( $rs[ $this->Get(XA_NAME_RS) ] );
			if ( $this->GetVal() == '' )
			{
				$this->year->SetVal( '' );
				$this->month->SetVal( '' );
			}
			else
			{
				$t = strtotime( $this->GetVal() );
				$this->year->val = date( "Y", $t );
				$this->month->val = date( "m", $t );
			}
			
			return nothing;

		case XC_OF_DEFAULT:
		case XC_OF_INPUT:
			$y = $this->year->XProc( $msg );
			$m = $this->month->XProc( $msg );

			if (( $y == '' ) && ( $m == '' ))
				$v = '';
			else
			{
				if ( $msg->Get(XM_CMD) == XC_OF_DEFAULT ) 
				{
					$y = sprintf("%04d", $y );
					$m = sprintf("%02d", $m );
				}
				
				$v = new COutString();
				$v->Set( "%s/%s", array( $m, $y ) );
			}

			return $v;

		}

		return parent::XProc( $msg );
	}
	
	function SetVal( $v )
	{
		$this->val = $v;
		$ax = explode( '-', $v );
		if ( count($ax) == 2 )
		{
			$this->year->val = $ax[0];
			$this->month->val = $ax[1];
		}
	}

  /**
   * Get the value of the object
   *
   * @param object $msg
   * @return string
   *
   */
	function GetValue( &$msg )
	{
		$year = $this->year->GetValue( $msg );
		$month = $this->month->GetValue( $msg );

		if (( $year == '' ) && ( $month == '' ))
			$v = '';
		else
			$v = sprintf( "%04d-%02d-%02d", $year, $month, 1 );
			
		return $v;
	}

  /**
   * Checks if the object has an empty value
   *
   * @param object $msg
   * @return true = empty, false = not empty
   *
   */
	function IsEmpty( &$msg )
	{
		$empty = 
			$this->year->IsEmpty( $msg ) &&
			$this->month->IsEmpty( $msg );
		return $empty;
	}

  /**
   * Validate the consistancy of the child objects
   *
   * @param object $msg
   * @return true = success, false = failure
   *
   */
	function Validate_Relation( &$msg )
	{
		$ret = array();

		if ( $this->year->IsEmpty( $msg ) )
		{
			$this->year->SetPDErrMsg( EMT_INCOMPLETE_INPUT );
			$ret[$this->year->GetName()] = false;
		}

		if ( $this->month->IsEmpty( $msg ) )
		{
			$this->month->SetPDErrMsg( EMT_INCOMPLETE_INPUT );
			$ret[$this->month->GetName()] = false;
		}

		$exp_date = date("Ym", mktime(0, 0, 0, $this->month->val, 1, $this->year->val ) );
		$this_month = date("Ym" );

		if ( $this_month > $exp_date )
		{
			$this->month->SetErrMsg( "「##c##」 有効期限が切れています" );
			$ret[$this->month->GetName()] = false;
		}

		if ( count($ret) == 0 ) $ret = true;

		return $ret;
	}
}

//----------------------------------------------------------------
// CVSSN
//----------------------------------------------------------------
class CVSSN extends CVFieldSet
{
	var $num1;
	var $num2;
	var $num3;

  /**
   * Set up the child objects
   *
   * @param object $msg
   *
   */
	function CreateChildren()
	{
		$name = $this->GetName();
		$cap = $this->GetCaption();
		$capch = $this->Get(XA_CAPTION_CHILD);
		if ( !is_array( $capch ) ) $capch = array( 1=>"###-__-____", 2=>'___-##-____', 3=>'___-__####' );

		$this->num1 =& $this->SetupObject( $this, $name . '_1',
			array(
				XA_CLASS=>'CVDigit',
				XA_CAPTION=>$cap . $this->FrameChildCaption($capch[1]),
				XA_REQUIRED=>REQ_ASK_PARENT,
				XA_SIZE=>4,
				XA_MIN_CHAR=>3,
				XA_MAX_CHAR=>3,
				XA_FORMAT=>'%-3s'
			)
		);
		
		$this->num2 =& $this->SetupObject( $this, $name . '_2',
			array(
				XA_CLASS=>'CVDigit',
				XA_CAPTION=>$cap . $this->FrameChildCaption($capch[2]),
				XA_REQUIRED=>REQ_ASK_PARENT,
				XA_SIZE=>3,
				XA_MIN_CHAR=>2,
				XA_MAX_CHAR=>2,
				XA_FORMAT=>'%-3s'
			)
		);
		
		$this->num3 =& $this->SetupObject( $this, $name . '_3',
			array(
				XA_CLASS=>'CVDigit',
				XA_CAPTION=>$cap . $this->FrameChildCaption($capch[3]),
				XA_REQUIRED=>REQ_ASK_PARENT,
				XA_SIZE=>5,
				XA_MIN_CHAR=>4,
				XA_MAX_CHAR=>4,
				XA_FORMAT=>'%-4s'
			)
		);
	}

  /**
   * Event Message Procedure
   *
   * @param object $msg
   * @return string
   *
   */
	function XProc( &$msg )
	{
		switch ( $msg->Get(XM_CMD) )
		{

		case XC_IS_REQUEST:
			$this->num1->XProc( $msg );
			$this->num2->XProc( $msg );
			$this->num3->XProc( $msg );
			return nothing;

		case XC_IS_RECORD:
			$rs =& $msg->Get(XM_RS);
			$this->SetVal( $rs[ $this->Get(XA_NAME_RS) ] );
			$this->SplitSSN( $this->GetVal(), $n1, $n2, $n3 );
			$this->num1->SetVal( $n1 );
			$this->num2->SetVal( $n2 );
			$this->num3->SetVal( $n3 );
			return nothing;

		case XC_OF_DEFAULT:
		case XC_OF_INPUT:
			$num1 = $this->num1->XProc( $msg );
			$num2 = $this->num2->XProc( $msg );
			$num3 = $this->num3->XProc( $msg );

			if (( $num1 == '' ) && ( $num2 == '' ) && ( $num3 == '' ))
				$v = '';
			else
			{
				switch( $msg->Get(XA_FORMAT) )
				{
				case XPT_CSV:
					$v = sprintf("%s-%s-%s", $num1, $num2, $num3);
					break;

				default:
					$v = new COutString();
					$v->Set( "%s-%s-%s", array( $num1, $num2, $num3 ) );
					break;
				}
			}

			return  $v;

		}

		return parent::XProc( $msg );
	}
	
  /**
   * Checks if the object has an empty value
   *
   * @param object $msg
   * @return true = empty, false = not empty
   *
   */
	function IsEmpty( &$msg )
	{
		$empty = 
			$this->num1->IsEmpty( $msg ) &&
			$this->num2->IsEmpty( $msg ) &&
			$this->num3->IsEmpty( $msg );

		return $empty;
	}

	function SetVal( $v )
	{
		$this->val = $v;
		$this->SplitSSN( $v, $n1, $n2, $n3 );
		$this->num1->val = $n1;
		$this->num2->val = $n2;
		$this->num3->val = $n3;
	}
	
  /**
   * Get the value of the object
   *
   * @param object $msg
   * @return string
   *
   */
	function GetValue( &$msg )
	{
		$num1 = $this->num1->GetValue( $msg );
		$num2 = $this->num2->GetValue( $msg );
		$num3 = $this->num3->GetValue( $msg );

		if (( $num1 == '' ) && ( $num2 == '' ) && ( $num3 == '' ))
			$v = '';
		else
			$v = sprintf( "%-3s-%-2s-%-4s", $num1, $num2, $num3 );
			
		return $v;
	}

  /**
   * Validate the consistancy of the child objects
   *
   * @param object $msg
   * @return true = success, false = failure
   *
   */
	function Validate_Relation( &$msg )
	{
		$ret = array();

		if ( $this->num1->IsEmpty( $msg ) )
		{
			$this->num1->SetPDErrMsg( EMT_INCOMPLETE_INPUT );
			$ret[$this->num1->GetName()] = false;
		}

		if ( $this->num2->IsEmpty( $msg ) )
		{
			$this->num2->SetPDErrMsg( EMT_INCOMPLETE_INPUT );
			$ret[$this->num2->GetName()] = false;
		}

		if ( $this->num3->IsEmpty( $msg ) )
		{
			$this->num3->SetPDErrMsg( EMT_INCOMPLETE_INPUT );
			$ret[$this->num3->GetName()] = false;
		}

		if ( count($ret) == 0 ) $ret = true;

		return $ret;
	}

  /**
   * Splits a ssn number
   *
   * @param $v
   * @param $n1
   * @param $n2
   * @param $n3
   *
   */
	function SplitSSN( $v, &$n1, &$n2, &$n3 )
	{
		$n1 = trim(substr($v,0,3));
		$n2 = trim(substr($v,4,2));
		$n3 = trim(substr($v,7,4));
	}

  /**
   * Concatinate a SSN
   *
   * @param $v
   * @param $n1
   * @param $n2
   * @param $n3
   * @return string
   *
   */
	function ConcatSSN( &$v, $n1, $n2, $n3 )
	{
		$SP = ' ';
		$sx = 
			str_pad( $n1, 3, $SP, STR_PAD_LEFT) . '-' .
			str_pad( $n2, 2, $SP, STR_PAD_LEFT) . '-' .
			str_pad( $n3, 4, $SP, STR_PAD_LEFT);
		
		return $sx;
	}
}

//----------------------------------------------------------------
// CVOneExtDay
//----------------------------------------------------------------
class CVOneExtDay extends CVDateTime
{
  /**
   * Get
   *
   * @param object $msg
   * @return string
   */
	function GetValue( &$msg )
	{
		switch ( $msg->Get(XM_CMD) )
		{
		case XC_SQL_COND:
			if ( $this->GetVal() == '' )
				$v = '';
			else
			{
				$t = strtotime( $this->GetVal() );
				$t2 = mktime(
					date( "H", $t ), date( "i", $t ), date( "s", $t ),
					date( "m", $t ), date( "d", $t ) + 1, date( "Y", $t ) );
				$v = date('Y-m-d H:i:s', $t2 );
			}
			return $v;
		}
		
		return parent::GetValue( $msg );
	}
}

//----------------------------------------------------------------
// CVUrl
//----------------------------------------------------------------
class CVUrl extends CVText
{
	function &OutputDefault( &$msg )
	{
		$v = CStr::n2e( $this->GetVal() );
		$caption = $v;
		if ( strlen( $caption ) > 64 )
		{
			$caption = substr( $caption, 0, 64 ) . "...";
		}

		$ht = new COutHtml();
		$ht->SetTagName( 'a' );
		$ht->SetKV( 'href', $v );
		$ht->SetKV( 'target', '_blank' );
		$ht->SetInside( $caption );
		return $ht;
	}
}

//----------------------------------------------------------------
// CVFileUp
//----------------------------------------------------------------
class CVFileUp extends CVText
{
	function &BuildHtmlTag( &$msg )
	{
		$obj =& parent::BuildHtmlTag( $msg );
		$obj->SetKV( 'type', 'file' );
		return $obj;
	}

	//------------------------------------------------------------
	// XProc
	//------------------------------------------------------------
	function XProc( &$msg )
	{
		switch ( $msg->Get(XM_CMD) )
		{
		case XC_IS_INPUT:
			$key = $this->GetRpName( $msg );
			if ( isset( $_FILES[ $key ] ) && isset( $_FILES[ $key ][ 'name' ]  ) )
				$v = $_FILES[ $key ][ 'name' ];
			else
				$v = null;
			$this->SetVal( $v );
			return nothing;
		}

		return parent::XProc( $msg );
	}

  /**
   * Validate value
   *
   * @param object $msg
   * @return true = yes, false = no
   */
	function Validate_Value( &$msg )
	{
		$v = $this->GetVal();
		if ( !$this->Validate_FileUp( $v ) ) return false;
		return true;
	}

  /**
   * Validate fileup
   *
   * @param string $s
   * @return true = yes, false = no
   */
	function Validate_FileUp( $v )
	{
		return true;
	}		
}

//----------------------------------------------------------------
// CVHidden
//----------------------------------------------------------------
class CVHidden extends CVText
{
	function &BuildHtmlTag( &$msg )
	{
		$obj =& parent::BuildHtmlTag( $msg );
		$obj->SetKV( 'type', 'hidden' );
		return $obj;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>