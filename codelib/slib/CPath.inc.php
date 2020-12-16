<?php

//----------------------------------------------------------------
// CPath
//----------------------------------------------------------------
class CPath
{
	function ThisFileUrl()
	{
		return $_SERVER['PHP_SELF'];
	}

	function ThisFileName()
	{
		$path = CPath::ThisFileUrl();
		$pos = strrpos( $path, '/' );
		return substr( $path, $pos+1 );
	}

	function ThisFolderUrl()
	{
		$path = CPath::ThisFileUrl();
		$pos = strrpos( $path, '/' );
		return substr( $path, 0, $pos+1 );
	}

	function ThisFilePath()
	{
		if ( isset( $_SERVER['SCRIPT_FILENAME'] ) )
			$path = $_SERVER['SCRIPT_FILENAME'];
		else
			$path = $_SERVER["PATH_TRANSLATED"];

		return str_replace( "\\", '/', $path );
	}

	function ThisFolderPath()
	{
		$path = CPath::ThisFilePath();
		if (( $pos = strrpos( $path, '/' ) ) !== false )
			return substr( $path, 0, $pos+1 );
		else if (( $pos = strrpos( $path, "\\" ) ) !== false )
			return substr( $path, 0, $pos+1 );
		else
			return $path;
	}
}

?>