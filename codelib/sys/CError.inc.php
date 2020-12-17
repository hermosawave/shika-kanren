<?php

//----------------------------------------------------------------
// CError
//----------------------------------------------------------------
class CError extends CObject
{
	function GetErrStyle( &$ht )
	{
		if ( strcasecmp( get_class( $ht ), 'COutHtml' ) == 0 )
			$this->UseErrStyle( $ht );
		else
			{}
	}

	function UseErrStyle( &$ht )
	{
		$ht->SetStyle( 'background-color', 'yellow' );
	}

	function GetPDErrMsg( $err_msg_id, $v = null, $b_hide_value = false )
	{
		$msg_eng = array(
			EMT_EMPTY=>"[##c##] is empty.",
			EMT_INVALID_FORMAT=>"[##c##] Invalid format ##v##",
			EMT_TOO_SHORT=>"[##c##] is too short. ##v##",
			EMT_TOO_LONG=>"[##c##] is too long. ##v##",
			EMT_TOO_SMALL=>"[##c##] is too small. ##v##",
			EMT_TOO_LARGE=>"[##c##] is too large. ##v##",
			EMT_INCOMPLETE_INPUT=>"[##c##] is imcomplete.",
			EMT_CAN_NOT_CONFIRM=>"[##c##] can not be confirmed.",
			EMT_NOT_ASCII=>"[##c##] contains non-alphanumerc characters.",
			EMT_NOT_DIGIT=>"[##c##] contains non-numeric characters.",
			EMT_DATE_NOT_EXIST=>"[##c##] : Invalid date ##v## [mm/dd/yyyy]",
		);

		$msg_jpn = array(
			EMT_EMPTY=>"「##c##」が入力されていません。",
			EMT_INVALID_FORMAT=>"「##c##」 の書式が正しくありません。##v##",
			EMT_TOO_SHORT=>"「##c##」 の入力が短すぎます。##v##",
			EMT_TOO_LONG=>"「##c##」 の入力が長すぎます。##v##",
			EMT_TOO_SMALL=>"「##c##」 の値が小さすぎます。##v##",
			EMT_TOO_LARGE=>"「##c##」 の値が大きすぎます。##v##",
			EMT_INCOMPLETE_INPUT=>"「##c##」 が入力されていません。", //の入力が不完全です
			EMT_CAN_NOT_CONFIRM=>"「##c##」 が確認できません。",
			EMT_NOT_ASCII=>"「##c##」 に半角英数字以外の文字が含まれています。",
			EMT_NOT_DIGIT=>"「##c##」 に半角数字以外の文字が含まれています。",
			EMT_DATE_NOT_EXIST=>"「##c##」 日付を再度確認して下さい。##v##",
		);

		switch ( $this->sys->GetLangCode() )
		{
		case LC_JPN: $msg_array = $msg_jpn; break;
		default: $msg_array = $msg_eng; break;
		}

		if ( isset( $msg_array[$err_msg_id] ) )
			$msg = $msg_array[$err_msg_id];
		else
			$msg = "Unknown Error : ##c## ##v##";

		//--- Special Handling for Password
		if ( $b_hide_value || ( $v == null ) || ( $v == '' ))
			$v = '';
		else
		{
			if ( CMBStr::strlen( $v ) > 20 ) $v = CMBStr::substr( $v, 0, 20 ) . '...';
			$v = CStr::html( $v );
			if ( $v != '' ) $v = "(" . $v . ")";
		}
		$msg = CMBStr::replace( '##v##', $v, $msg );
		
		return $msg;
	}

	// Stops immediately and gives an err message to users
	function CriticalError( $msg )
	{
		$encoding = CConfig::Get( 'system/encoding/internal' );

		//--- [BEGIN] Template ---
		$s =<<<EOM
<html><head><title>Error</title>
<meta http-equiv="Content-Type" content="text/html; charset={$encoding}" />
</head><body>##msg##</body></html>
EOM;
		//--- [END] Template ---

		echo CMBStr::replace('##msg##', $msg, $s );
		exit;
	}

}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>