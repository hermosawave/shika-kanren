<?php 
	$user_id = $this->sys->AuthSession->GetV( $this->sys->Get( XA_FRAME_FIELDSET_ID ) );
	$username = $this->sys->AuthSession->GetV("username");
?>

<!-- [BEGIN] Page Header -->

<table border="0" width="100%">
	<tr>
	<td rowspan='2'>
		<span style='color:#000000;font-size:140%;font-weight:bold;'> 
		<?php echo STR_HOME_TITLE; ?>
		</span>
	</td>
	<td align='right' valign='top'>
		<span style='margin-right:10px;font-size:100%;font-weight:bold;color:#000000;'>
		<?php echo $GLOBALS['PAGE_TITLE']; ?>
		</span>
	</td>
	</tr>
	<tr>
	<td align='right' valign='bottom'>
		<?php if ( false ) { ?>
		<span style='font-size:80%; font-weight:bold; color:#000000;'>
			<?php echo $sys->GetUserTypeCaption(); ?> : <?php echo $username; ?>&nbsp;&nbsp;[<?php echo $user_id; ?>]&nbsp;&nbsp;
		</span>
		<?php } ?>
		<span style='font-size:80%; font-weight:normal; color:#404040;'>
			User : 
		</span>
		<span style='font-size:80%; font-weight:bold; color:#000000;'>
			<?php echo $username; ?>&nbsp;&nbsp;&nbsp;
		</span>
	</td>
	</tr>
</table>

<?php
	include( 'df.top_menu.inc.php' );

	$p = $this->sys->GetPageSet();
	$sc_sel = $p->name;

	$attri = array(
		XA_CLASS=>'CMenu',
		'menu'=>$spec,
		'sc_sel'=>$sc_sel
	);

	$menu_obj =& $sys->RunObject( $sys, 'Menu', $attri );

	$agent = '';
	if ( isset( $_SERVER["HTTP_USER_AGENT"] ) )
		$agent = $_SERVER["HTTP_USER_AGENT"];
	//echo $agent;

	if ( strpos( $agent, "Windows NT 5" ) !== false )
	{
		$menu_item_padding = "padding:6px 10px 6px 10px;";
	}
	else
	{
		$menu_item_padding = "padding:0px 10px 0px 10px;";
	}
?>

<table style='background-color:#000000' border="0" cellspacing='0' cellpadding='0' width="100%">

<?php while ( $menu = $menu_obj->GetMenu() ) { $cnt = ( isset( $cnt ) ? $cnt+1 : 1 ); ?>
<tr>
	<td align='<?php echo ( $cnt % 2 != 0 ? 'left' : 'left' ); ?>'>
	<?php
		foreach( $menu as $key => $val )
		{
			if ( $menu_obj->GetMenuItemInfo( $key, $val, $sc, $sel, $caption ) )
			{
	?>
		<span style='<?php echo $menu_item_padding; ?><?php if ( $sel ) echo "background-color:#808080;"; ?>'><a
			class="menu_item" style="color:#ffffff;" href="<?php echo $hm->Url( '_sc=' . $sc . '&' ); ?>"
			><?php echo $caption; ?></a></span>
	<?php 
			}
		}
	?>
	</td>
</tr>
<?php } ?>

</table>

<!-- [END] Page Header -->
