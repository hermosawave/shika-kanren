<?php

class CMySQL extends CObject
{
	var $oConn = null;
	var $b_commit = true;
	var $b_attached = false;
	var $version = "3.x";
	var $b_handle_shift_jis = false;

	//----------------------------------------------------------------
	// Setup
	//----------------------------------------------------------------
	function Setup()
	{
		$hostname = CConfig::Get('database/hostname');
		$username = CConfig::Get('database/username');
		$password = CConfig::Get('database/password');
		$database = CConfig::Get('database/database');
		$set_names_cmd = CConfig::Get('database/set_names_cmd');
		$this->Open( $hostname, $username, $password, $database );
		$this->Query( $set_names_cmd );
	}

	//----------------------------------------------------------------
	// Open
	//----------------------------------------------------------------
  /**
   * Open database
   *
   * @param string $DB_SERVER
   * @param string $DB_USERNAME
   * @param string $DB_PASSWORD
   * @param string $DB_DATABASE
   */
	function Open( $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE )
	{
		if ( !( $this->oConn = mysql_connect( $DB_SERVER, $DB_USERNAME, $DB_PASSWORD ) ) )
		{
			$this->oConn = null;
			$this->sys->SystemError( get_class($this) . '/Open', 'Could not connect' );
		}

		mysql_select_db( $DB_DATABASE, $this->oConn );
	}

	//----------------------------------------------------------------
	// Close
	//----------------------------------------------------------------
  /**
   * Close database
   *
   */
	function Close()
	{
		if ( !$this->b_attached ) mysql_close($this->oConn);
		$this->oConn = null;
	}

	//----------------------------------------------------------------
	// AttachConn
	//----------------------------------------------------------------
  /**
   * Attach a connection
   *
   * @param handle $oConn
   */
	function AttachConn( $oConn )
	{
		$this->oConn = &$oConn;
		$this->b_attached = true;
	}
	
	//----------------------------------------------------------------
	// IsOpen
	//----------------------------------------------------------------
  /**
   * Checks if the connection is open
   *
   * @return handle $oConn
   * @return true = success, false = failure
   */
	function IsOpen()
	{
		return !is_null( $this->oConn );
	}

	//----------------------------------------------------------------
	// Sanitize
	//----------------------------------------------------------------
  /**
   * Sanitize user's input
   *
   * @return string $s
   * @return string
   */
	function Sanitize( $s )
	{
		if ( $this->b_handle_shift_jis ) { $s = mb_convert_encoding( $s, 'EUC-JP', 'SJIS'); }

		//--------------------------------------------------------
		//--- Characters before space keys(\x20)
		//--- except TAB(\x09), LF(\x0a), CR(\x0d)
		//--- [\x00-\x08,\x0b,\x0c,\x0e-\x0f]

		$s = mb_ereg_replace( "[\x00-\x08\x0b\x0c\x0e-\x0f]", '' , $s );

		//---
		//---
		//--------------------------------------------------------
		
		//--------------------------------------------------------
		//---
		//---

		$s = mysql_real_escape_string($s);

		//---
		//---
		//--------------------------------------------------------

		if ( $this->b_handle_shift_jis ) { $s = mb_convert_encoding( $s, 'SJIS', 'EUC-JP'); }
	
		return $s;
	}
	
	//----------------------------------------------------------------
	// Query
	//----------------------------------------------------------------
  /**
   * Make a query
   *
   * @return string $sql
   * @return true = success, false = failure
   */
	function Query( $SQL )
	{
		//------------------------------------------------------
		if ( $this->b_handle_shift_jis ) $SQL = mb_convert_encoding( $SQL, 'EUC-JP', 'SJIS' );
		//------------------------------------------------------
		if ( CConfig::Get( 'debug/write_to_console' ) )
		{
			CConsole::Write( get_class($this) . "/sql", $SQL );
		}

		return mysql_query( $SQL, $this->oConn );
	}

	//----------------------------------------------------------------
	// BeginTrans
	//----------------------------------------------------------------
  /**
   * Begin transaction
   *
   * @return true = success, false = failure
   */
	function BeginTrans()
	{
		return $this->Query( "BEGIN" );
	}

	//----------------------------------------------------------------
	// EndTrans
	//----------------------------------------------------------------
  /**
   * End transaction
   *
   * @return true = success, false = failure
   */
	function EndTrans()
	{
		if ( $this->b_commit )
			return $this->CommitTrans();
		else
			return $this->RollBackTrans();
	}

	//----------------------------------------------------------------
	// SetRollBack
	//----------------------------------------------------------------
  /**
   * Set rollback
   *
   */
	function SetRollBack()
	{
		$this->b_commit = false;
	}

	//----------------------------------------------------------------
	// CommitTrans
	//----------------------------------------------------------------
  /**
   * Commite transaction
   *
   */
	function CommitTrans()
	{
		return $this->Query( "COMMIT" );
	}

	//----------------------------------------------------------------
	// RollBackTrans
	//----------------------------------------------------------------
  /**
   * Roll back transaction
   *
   * @return true = success, false = failure
   */
	function RollBackTrans()
	{
		return $this->Query( "ROLLBACK" );
	}
	
	//----------------------------------------------------------------
	// GetRow
	//----------------------------------------------------------------
  /**
   * Get a row
   *
   * @param handle $result
   * @return handle recordset
   */
	function GetRow( $result )
	{
		return mysql_fetch_row( $result );
	}
	
	//----------------------------------------------------------------
	// GetRowA
	//----------------------------------------------------------------
  /**
   * Get a associative row
   *
   * @param handle $result
   * @return handle recordset
   */
	function GetRowA( $result )
	{
		$ax = mysql_fetch_array( $result );

		//---------------------------------------------------
		if ( $this->b_handle_shift_jis ) 
		{
			if ( is_array($ax) )
			{
				foreach ( $ax as $key => $val )
				{
					$t = mb_convert_encoding( $val, 'SJIS', 'EUC-JP' );
					$ax[$key] = $t;
				}
			}
		}
		//---------------------------------------------------
		
		return $ax;
	}

	//----------------------------------------------------------------
	// GetRowCount
	//----------------------------------------------------------------
  /**
   * Get the row count
   *
   * @param handle $result
   * @return integer
   */
	function GetRowCount( $result )
	{
		return mysql_num_rows( $result );
	}
	
	//----------------------------------------------------------------
	// FreeResult
	//----------------------------------------------------------------
  /**
   * Free up the result set
   *
   * @param handle $result
   */
	function FreeResult( $result )
	{
		mysql_free_result( $result );
	}
	
	//----------------------------------------------------------------
	// GetLastError
	//----------------------------------------------------------------
  /**
   * Get the last error message
   *
   * @return string
   */
	function GetLastError()
	{
		return mysql_error();
	}
	
	//----------------------------------------------------------------
	// GetInsertID
	//----------------------------------------------------------------
  /**
   * Get the inserted ID
   *
   * @param string $TableName
   * @param string $FieldName
   * @return integer
   */
	function GetInsertID( $TableName = null, $FieldName = null )
	{
		return mysql_insert_id( $this->oConn );
	}

	//----------------------------------------------------------------
	// GetRecordCount
	//----------------------------------------------------------------
  /**
   * Get the record count
   *
   * @param string $SQL
   * @return integer
   */
	function GetRecordCount( $SQL )
	{
		if ( $this->version == "3.x" )
		{
			//--- MySQL 3.x
			$ax = explode( ' ORDER ', $SQL );
			$bx = explode( ' FROM ',  $ax[0] );
			$sql_y = 'SELECT COUNT(*) AS c FROM ' . $bx[1];
			$result = $this->Query( $sql_y ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'Query() failed: ' . $this->GetLastError() );
			$rs = $this->GetRowA( $result ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'GetRow() failed: ' . $this->GetLastError() );
			$Total = $rs['c'];
			$this->FreeResult( $result );
		}
		else
		{
			//--- MySQL 4.x
			$SQLX = "SELECT COUNT(*) As count_of_records FROM ( " . $SQL . " ) AS TABLE_FOR_COUNT";
			$result = $this->Query( $SQLX ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'Query() failed: ' . $this->GetLastError() );
			$rs = $this->GetRow( $result ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'GetRow() failed: ' . $this->GetLastError() );
			$Total = $rs[0];
			$this->FreeResult( $result );
		}

		return $Total;
	}

	//----------------------------------------------------------------
	// GetPageResult
	//----------------------------------------------------------------
  /**
   * Get page result set
   *
   * @param handle $result
   * @param string $SQL
   * @param integer $PageSize
   * @param integer $TotalRecord
   * @param integer $TotalPage
   * @param integer $PageIdx
   */
	function GetPageResult(
		&$result, 
		&$SQL, 
		$PageSize, 
		&$TotalRecord, 
		&$TotalPage, 
		&$PageIdx )
	{

		$TotalRecord = $this->GetRecordCount( $SQL );

		//--- Set all variables
		if ( $PageSize == 0 )
		{
			$PageSize = $TotalRecord;
			if ( $TotalRecord == 0 )
			{
				$TotalPage = 0;
				$PageIdx = 0;
			}
			else
			{
				$TotalPage = 1;
				$PageIdx = 1;
			}
		}
		else
		{
			$TotalPage = intval( $TotalRecord / $PageSize );
			if (( $TotalRecord % $PageSize ) != 0 ) { $TotalPage = $TotalPage + 1; }
			if ( $TotalPage == 0 ) { $PageIdx = 0; }
			if ( $PageIdx > $TotalPage ) { $PageIdx = $TotalPage; }
		}

		if ( $TotalPage > 0 )
		{
			$Offset = ($PageIdx-1) * $PageSize;

			if ( $this->version == "3.x" )
			{
				//--- MySQL 3.x
				$SQLX = $SQL . " LIMIT $Offset, $PageSize;";
			}
			else
			{
				//--- MySQL 4.x
				$SQLX = "SELECT *  FROM ( " . $SQL . " ) AS TABLE_FOR_PAGING LIMIT $PageSize OFFSET $Offset;";
			}
			
			$result = $this->Query( $SQLX ) or $this->sys->SystemError( get_class($this) . '/GetPageResult', 'Query() failed: ' . $this->GetLastError() );
		}

		//if ( $GLOBALS['B_DISPLAY_SQL'] ) echo "<hr>SQL => " . $SQLX . "<hr>";
	}

	//------------------------------------------------------------
	// CombineCond
	//------------------------------------------------------------
	function CombineCond( $qx, $op = "AND" )
	{
		$qx1 = array();
		foreach( $qx as $s ) $qx1[] = "( " . $s . " )";
		return implode( " " . $op . " ", $qx1 );
	}
	
	//------------------------------------------------------------
	// GetSQLSelect
	//------------------------------------------------------------
	function GetSQLSelect( $table_name, $ls, $qx, $op = "AND" )
	{
		$sql = 'SELECT ' . implode( ', ', $ls ) . ' FROM ' . $table_name;
		if ( count( $qx ) > 0 )
		 	$sql .= ' WHERE ' . $this->CombineCond( $qx, $op );

		return $sql;
	}

	//------------------------------------------------------------
	// InsertRecord_Bool
	//------------------------------------------------------------
	function InsertRecord_Bool( $table_name, $fv )
	{
		$sql = 'INSERT INTO ' . $table_name . 
			' (' . CStr::implode( ', ', $fv, 0 ) . ') VALUES' .
			' (' . CStr::implode( ', ', $fv, 1 ) . ')';

		return ( $this->Query( $sql ) );;
	}

	//------------------------------------------------------------
	// InsertRecord
	//------------------------------------------------------------
	function InsertRecord( $table_name, $fv )
	{
		if ( !$this->InsertRecord_Bool( $table_name, $fv )  )
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "Insert Record (" . $table_name . ") : " . $this->GetLastError() );
		}

		return $this->GetInsertID( $table_name );
	}
	
	//------------------------------------------------------------
	// UpdateRecord
	//------------------------------------------------------------
	function UpdateRecord( $table_name, $fv, $qx )
	{
		if ( count( $qx ) > 0 )
		{
			$ax = array();
			foreach( $fv as $v ) $ax[] = $v[0] . '=' . $v[1];

			$sql = 'UPDATE ' . $table_name .
			 ' SET ' . implode( ', ', $ax ) .
			 ' WHERE ' . $this->CombineCond( $qx );

			if ( !$this->Query( $sql ) )
			{
				$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "Update Record (" . $table_name . ") : " . $this->GetLastError() );
			}
		}
		else
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "No WHERE Clauses in UPDATE (" . $table_name . ")" );
		}
	}

	//------------------------------------------------------------
	// DeleteRecord
	//------------------------------------------------------------
	function DeleteRecord( $table_name, $qx )
	{
		if ( count( $qx ) > 0 )
		{
			$sql = 'DELETE FROM ' . $table_name . ' WHERE ' . $this->CombineCond( $qx );

			if ( !$this->Query( $sql ) )
			{
				$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "Delete Record (" . $table_name . ") : " . $this->GetLastError() );
			}
		}
		else
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "No WHERE Clauses in DELETE (" . $table_name . ")" );
		}
	}

	//------------------------------------------------------------
	// SetNextAutoIncrement
	//------------------------------------------------------------
	function SetNextAutoIncrement( $table_name, $next_id )
	{
		$sql = "ALTER TABLE {$table_name} AUTO_INCREMENT = " . $next_id;
		if ( !$this->Query( $sql ) )
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "SetNextAutoIncrement (" . $table_name . ") : " . $this->GetLastError() );
		}
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>