<?php

/*
-----------------------------------------
CPageTab
-----------------------------------------

        |<----w---->|
        |     |     |
< 1 ... 23|24|25|26|27 ... 46 >
  |     |     |     |      |
  |     |     |     |      $idx_e
  |     |     |     $idx_re
  |     |     $idx
  |     $idx_rf
  $idx_f

-----------------------------------------
*/  

/*
define('STR_BTN_FIRST','≪');
define('STR_BTN_LAST','≫');
define('STR_BTN_PREV','＜');
define('STR_BTN_NEXT','＞');
*/

/*
define('STR_BTN_FIRST','《&nbsp;');
define('STR_BTN_LAST','&nbsp;》');
define('STR_BTN_PREV','〈&nbsp;');
define('STR_BTN_NEXT','&nbsp;〉');
*/

define('STR_BTN_FIRST','&lt;&lt;');
define('STR_BTN_LAST','&gt;&gt;');
define('STR_BTN_PREV','&lt;');
define('STR_BTN_NEXT','&gt;');


class CPageTab extends CObject
{
	var $idx;
	var $tmpl_sel;
	var $tmpl_link;
	
  /**
   * Create page tabs
   *
   * @param integer $total
   * @param integer $idx
   * @param integer $w
   * @param string $temp_sel
   * @param string $temp_link
   * @param integer $total
   * @return string
   */
	function GetPageTabs( $total, $idx, $w, $tmpl_sel, $tmpl_link )
	{
		if ( $total == 0 ) return '';
		
		$w2 = floor( $w / 2 );

		$this->idx = $idx;
		$this->tmpl_sel = $tmpl_sel;
		$this->tmpl_link = $tmpl_link;

		$this->idx_f = 1;
		$this->idx_e = $total;
		
		$idx_rf = $idx - $w2;
		if ( $this->idx_f < $idx_rf )
		{
			$idx_re = $idx + $w2;
			if (!( $idx_re < $this->idx_e ))
			{
				$idx_re = $this->idx_e;
				$idx_rf = $idx_re - $w;
				if (!( $this->idx_f < $idx_rf ))
					$idx_rf = $this->idx_f;
			}
		}
		else
		{
			$idx_rf = $this->idx_f;
			$idx_re = $idx_rf + $w;
			if (!( $idx_re < $this->idx_e ))
				$idx_re = $this->idx_e;
		}

		//--- Init Buffer
		$s = '';
		
		//--- First & Prev Button
		if ( $this->idx_f < $this->idx )
		{
			$s .= $this->GetFirst();
			$s .= $this->GetPrev();
		}

		if ( $this->idx_f < $idx_rf )
		{
			$s .= $this->GetTab( $this->idx_f );

			if ( $this->idx_f+1 == $idx_rf )
				$s .= $this->GetSepa();
			else if ( $this->idx_f+2 == $idx_rf )
			{
				$s .= $this->GetSepa();
				$s .= $this->GetTab( $this->idx_f+1 );
				$s .= $this->GetSepa();
			}
			else
				$s .= $this->GetDots();
		}

		for ( $i = $idx_rf; $i <= $idx_re; $i++ )
		{
			$s .= $this->GetTab( $i );
			if ( $i < $idx_re ) $s .= $this->GetSepa();
		}	

		if ( $idx_re < $this->idx_e )
		{
			if ( $idx_re+1 == $this->idx_e )
				$s .= $this->GetSepa();
			else if ( $idx_re+2 == $this->idx_e )
			{
				$s .= $this->GetSepa();
				$s .= $this->GetTab( $idx_re+1 );
				$s .= $this->GetSepa();
			}
			else
				$s .= $this->GetDots();

			$s .= $this->GetTab( $this->idx_e );
		}
		
		//--- Next & Last Button
		if ( $this->idx < $this->idx_e )
		{
			$s .= $this->GetNext();
			$s .= $this->GetLast();
		}
		
		return $s;
	}

  /**
   * Get "previous" link
   *
   * @return string
   */
	function GetPrev()
	{
		$s = CMBStr::replace( '#PageNo#', ( $this->idx - 1 ), $this->tmpl_link );
		$s = CMBStr::replace( '#Caption#',  STR_BTN_PREV, $s );
		return ' ' . $s . ' ';
	}

  /**
   * Get "next" link
   *
   * @return string
   */
	function GetNext()
	{
		$s = CMBStr::replace( '#PageNo#', ( $this->idx + 1 ), $this->tmpl_link );
		$s = CMBStr::replace( '#Caption#',  STR_BTN_NEXT, $s );
		return ' ' . $s . ' ';
	}

  /**
   * Get "first" link
   *
   * @return string
   */
	function GetFirst()
	{
		$s = CMBStr::replace( '#PageNo#', ( $this->idx_f ), $this->tmpl_link );
		$s = CMBStr::replace( '#Caption#',  STR_BTN_FIRST, $s );
		return ' ' . $s . ' ';
	}

  /**
   * Get "last" link
   *
   * @return string
   */
	function GetLast()
	{
		$s = CMBStr::replace( '#PageNo#', ( $this->idx_e ), $this->tmpl_link );
		$s = CMBStr::replace( '#Caption#',  STR_BTN_LAST, $s );
		return ' ' . $s . ' ';
	}

  /**
   * Get "tab" link
   *
   * @return string
   */
	function GetTab( $i )
	{
		if ( $this->idx == $i )
			$s = $this->tmpl_sel;
		else
			$s = $this->tmpl_link;

		$s = CMBStr::replace( '#PageNo#', $i, $s );
		$s = CMBStr::replace( '#Caption#', $i, $s );

		return $s;
	}

  /**
   * Get a separtor
   *
   * @return string
   */
	function GetSepa()
	{
		$s = ' | ';
		return $s;
	}

  /**
   * Get dots
   *
   * @return string
   */
	function GetDots()
	{
		$s = ' ... ';
		return $s;
	}

	function ShowEx( $w, $sidx, $eidx )
	{
		$tmpl_sel = '<b>#PageNo#</b>';
		$tmpl_link = "<a href='index.php?pn=#PageNo#'>#Caption#</a>";

		echo "<hr>";
		for ( $total = $sidx; $total <= $eidx; $total++ )
		{
			for ( $idx = 1; $idx <= $total; $idx++ )
			{
				echo "w=$w; total=$total; idx=$idx;<br>";
				echo $this->GetPageTabs( $total, $idx, $w, $tmpl_sel, $tmpl_link );
				echo "<hr>";
			}
		}
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>