<?php

define( 'STR_PACK_SEPARATOR', "\x1");
define( 'STR_ARRAY_ITEM_SEPARATOR', "\x2" );

//----------------------------------------------------------------
// MB String
//----------------------------------------------------------------
define( 'SYS_INTERNAL_ENCODING', "utf-8" ); // utf-8, euc-jp

class CMBStr
{
	function internal_encoding()
	{
		return SYS_INTERNAL_ENCODING;
	}

	function explode( $pattern, $s )
	{
		mb_regex_encoding( CMBStr::internal_encoding() );
		return mb_split( $pattern, $s );
	}

	function replace( $s1, $s2, $s3 )
	{
		mb_regex_encoding( CMBStr::internal_encoding() );
		return mb_ereg_replace( $s1, $s2, $s3 );
	}

	function strpos( $s, $find_this, $offset = 0 )
	{
		return mb_strpos( $s, $find_this, $offset, CMBStr::internal_encoding() );
	}

	function strrpos( $s, $find_this, $offset = 0 )
	{
		return mb_strrpos( $s, $find_this, $offset, CMBStr::internal_encoding() );
	}

	function strlen( $s )
	{
		return mb_strlen( $s, CMBStr::internal_encoding() );
	}

	function substr( $s1, $s2, $s3 )
	{
		return mb_substr( $s1, $s2, $s3, CMBStr::internal_encoding() );
	}

	function splite( $s, &$key, &$val )
	{
		$pos = CMBStr::strpos( $s, '=' );
		if ( $pos !== false )
		{
			$key = CMBStr::substr( $s, 0, $pos );
			$val = CMBStr::substr( $s, CMBStr::strlen( $s ) - ( CMBStr::strlen( $s ) - $pos ) + 1, CMBStr::strlen($s) );
		}
		else
		{
			$key = $s;
			$val = $s;
		}
	}
	
	//----------------------------------------------------------------
	// pack_kv
	//----------------------------------------------------------------
	function pack_kv( $kv )
	{
		$s = '';
		foreach ( $kv as $key => $val )
		{
			if ( $s != '' ) $s .= STR_PACK_SEPARATOR;

			// [BEGIN] Process Array
			if ( is_array( $val ) )
			{
				$sx = STR_ARRAY_ITEM_SEPARATOR;
				foreach( $val as $k => $v )
				{
					if ( $sx != STR_ARRAY_ITEM_SEPARATOR )
						$sx .= STR_ARRAY_ITEM_SEPARATOR;
					$sx .= $v;
				}
				$val = $sx;
			}
			// [END] Process Array

			$s .= ( $key . '=' . $val );
		}
		return base64_encode($s);
	}

	//----------------------------------------------------------------
	// unpack_kv
	//----------------------------------------------------------------
	function unpack_kv( $l, &$kv )
	{
		$px = CMBStr::explode( '&', $l );

		if ( count( $px ) >= 1 )
		{
			$ax = CMBStr::explode( STR_PACK_SEPARATOR, base64_decode( $px[0] ) );

			for ( $i = 0; $i < count( $ax ); $i++ )
			{
				CMBStr::splite( $ax[$i], $key, $val );

				// [BEGIN] Process Array
				if ( CMBStr::substr( $val, 0, 1 ) == STR_ARRAY_ITEM_SEPARATOR )
				{
					$val = CMBStr::substr( $val, 1 );
					$val = CMBStr::explode( STR_ARRAY_ITEM_SEPARATOR, $val );
				}
				// [END] Process Array

				if ( $key != '' ) $kv[$key] = $val;
			}
		}

		if ( count( $px ) >= 2 )
		{
			for ( $i = 1; $i < count( $px ); $i++ )
			{
				CMBStr::splite( $px[$i], $key, $val );
				if ( $key != '' ) $kv[$key] = $val;
			}
		}
	}

	//----------------------------------------------------------------
	// mline_to_kv
	//----------------------------------------------------------------
	function mline_to_kv( $s, $sepa = "\|" )
	{
		$ax = CMBStr::replace( "\r", "", $s );
		$ax = CMBStr::explode( "\n", $s );
		$cx = array();
		foreach( $ax as $ln )
		{
			$bx = CMBStr::explode( $sepa, $ln );
			$key = '';
			$val = '';
			if ( count( $bx ) >= 1 ) $key = $bx[0];
			if ( count( $bx ) >= 2 ) $val = $bx[1];
			if ( trim( $key ) != '' )
				$cx[] = array( 'key' => $key, 'val' => $val ); 
		}
		return $cx;
	}
}

?>