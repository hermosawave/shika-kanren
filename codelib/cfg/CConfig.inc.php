

<?php

//----------------------------------------------------------------
// CConfig
//----------------------------------------------------------------
class CConfig
{
	function Get( $path )
	{
		$px = explode( '/', $path );

		switch ( $px[0] )
		{
		case 'debug':
			switch ( $px[1] )
			{
			case 'skip_sending_email' : return false;
			case 'write_to_console' : return false;
			case 'path_console_out' : return dirname(__FILE__) . "/../../";
			case 'print_to_html': return false;
			case 'trace_msg_loop': return false;
			case 'dump_deleted_record': return false;
			case 'display_smtp_log': return false;
			}
			return false;

		case 'system':
			switch ( $px[1] )
			{
			case 'encoding': return 'utf-8';
			case 'transaction': return false;
			case 'log_period': return 90;
			}
			break;

		case 'database':
			return constant( 'DB_' . strtoupper($px[1]) );

		}

		echo "<hr>";
		echo "CConfig : Unknown Path ( " . $path . " )";
		echo "<hr>";
		exit();
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>