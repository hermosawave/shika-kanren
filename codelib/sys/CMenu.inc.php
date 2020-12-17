<?php

class CMenu extends CObject
{
	function IsSelected( $mitem )
	{
		$sc = $mitem['sc'];
		return ( strpos( $sc, $this->Get( 'sc_sel' ) ) !== false );
	}

	function SetSel( &$menu )
	{
		foreach( $menu as $key => $val )
		{
			$b1 = $this->IsSelected( $val );
			$b2 = isset( $val['menu'] ) && $this->SetSel( $val['menu'] );
			if ( $b1 || $b2 )
			{
				$val['sel'] = true;
				$menu[$key] = $val;
				return true;
			}
		}

		return false;
	}

	function Run()
	{
		$menu = $this->Get( 'menu' );
		$this->SetSel( $menu );
		$this->Set( 'menu', $menu );
		$this->sel_key = '_root_';
		$this->count = 0;
	}

	function GetMenuItemInfo( $key, &$val, &$sc, &$sel, &$caption )
	{
		$caption = $val['caption'];
		$sc = $val['sc'];
		$sel = ( isset( $val['sel'] ) && $val['sel'] );
		$ax = explode( '/', $sc );
		if (
			( count($ax) == 2 ) && 
			( $this->sys->Authorization->IsAuthorized( $ax[0], $ax[1] ) )
		)
		{
			if ( $sel && ( $this->sel_key != '_end_' ))
				$this->sel_key = $key;

			return true;
		}
		return false;
	}
	
	function GetMenu()
	{
		$this->count++;
		
		switch ( $this->sel_key )
		{
		case '_end_':
		case '':
			return false;
			
		case '_root_':
			$this->sel_key = '';
			return $this->Get( 'menu' );

		default:
			$menu = $this->Get( 'menu' );
			$item = $menu[ $this->sel_key ];
			$this->sel_key = '_end_';
			if ( isset( $item['menu'] ) )
				return $item['menu'];
			else
				return false;
		}
	}
}

//-----------------------------------------------------------------------
// END OF FILE
//-----------------------------------------------------------------------
?>