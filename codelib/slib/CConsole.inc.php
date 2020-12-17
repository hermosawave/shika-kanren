<?php

//----------------------------------------------------------------
// CConsole
//----------------------------------------------------------------
$CConsole_path_log = "";

class CConsole
{
	//-- private static $path_log = ""; //-- PHP5 only

	function Write( $path, $msg )
	{
		global $CConsole_path_log;

		$s = CConsole::PrintKV( $path, $msg );

		if ( $CConsole_path_log == "" )
		{
			$dir = CConfig::Get("debug/path_console_out");
			$CConsole_path_log = $dir . date( "Y-m-d_H-i-s" ) . ".html";
		}

		if( file_exists( $CConsole_path_log) )
			$f = fopen( $CConsole_path_log, 'a');
		else
			$f = fopen( $CConsole_path_log, 'w');

		fwrite( $f, $s );
		fclose( $f );
	}

	function PrintKV( $key, $val )
	{
		if ( strpos( $val, "<" ) == -1 )
			$val = CStr::html($val);

		$s = '';
		$s .= "<table border='0' cellpadding='4', cellspacing='3'>";
		$s .= '<tr>';
		$s .= "<td bgcolor='#008000'><font color='#ffffff'>" . CStr::html($key) . "</font></td>";
		$s .= "<td bgcolor='#c0ffc0'>" . $val .'</td>';
		$s .= '</tr>';
		$s .= '</table>';
		$s .= '<br/>';

		return $s;
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>