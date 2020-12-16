<?php require_once( "codelib/slib/CEmail.inc.php" ); ?>
<?php

function main()
{
	//-- [BEGIN] Check if redirect exists
	if ( !isset( $_POST["redirect"] ) ) return;
	//-- [END] Check if redirect exists

	//-- [BEGIN] Build Body
	$exclude_list =  array( "redirect" );
	$ax = array();
	foreach( $_POST as $key=>$val )
	{
		if ( !in_array( $key, $exclude_list ) )
		{
			$ax[] = ( $key . '=' . $val );
		}
	}

/*
	$ax[] = "TIME=" . date( "Y-m-d H:i:s" );

	$s = ( isset( $_SERVER["REMOTE_ADDR"] ) ? $_SERVER["REMOTE_ADDR"] : "" );
	$ax[] = "REMOTE_ADDR=" . $_SERVER["REMOTE_ADDR"];

	$s = ( isset( $_SERVER["HTTP_USER_AGENT"] ) ? $_SERVER["HTTP_USER_AGENT"] : "" );
	$ax[] = "HTTP_USER_AGENT=" . $s;
*/

	$Body = implode( "\r\n", $ax );
	//-- [END] Build Body

	//-- [BEGIN] Send Mail
	global $_SENDMAIL_CONFIG_FILE_;
	$path = "config/config.email." . $_SENDMAIL_CONFIG_FILE_ . ".php";

	$email = new CEmail();
	$email->OpenConfig( $path );
	$email->SetParam( 'Body', $Body );

	$b = $email->Send();

	$msg = "EMAIL ERROR : <br>";
	if ( $b )
		$msg .= "NONE";
	else
		$msg .= $email->GetErrMsg();

	//$email->DisplaySmtpLog();

	if ( !$b )
	{
		echo $msg;
		die;
	}
	//-- [END] Send Mail

	//-- [BEGIN] Redirect
	$redirect = $_POST["redirect"];
	header( 'Location: ' . $redirect );
	//-- [END] Redirect
}

main();

?>
