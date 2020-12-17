	<table width="534" border="1" cellspacing="0" cellpadding="3">
	<tr align="left" valign="top" style='background-color:#c0c0c0;'>
		<td align='center' width='80'>商品番号</td>
		<td align='center'>商品名</td>
		<td align='center'>単価</td>
		<td align='center' width='40'>数量</td>
		<td align='center'>合計</td>
	</tr>
<?php
	global $scart;
	foreach( $scart->items as $item )
	{
		$obj =& GetItemObj( $item );
?>
<!-- [BEGIN] Item -->
	<tr align="left" valign="top">
		<td align='left'><?php echo $obj->ProductCode(); ?></td>
		<td align='left'><?php echo $obj->ProductName(); ?><br/>
			<?php echo $obj->Maker(); ?><br/>
			(<?php echo $obj->Size(); ?>)</td>
		<td align='right'>$<?php echo $obj->Price(); ?></td>
		<td align='right'><?php echo $obj->Qty(); ?></td>
		<td align='right'>$<?php echo $obj->Total(); ?></td>
	</td>
	</tr>
<!-- [END] Item -->
<?php
	}
?>
	<tr>
		<td align="right" colspan='4' style='background-color:#c0c0c0;'>合計 ：</td>
		<td align="right">$<?php echo $scart->ItemsTotal(); ?></td>
	</tr>
	<tr>
		<td align="right" colspan='4' style='background-color:#c0c0c0;'>手数料<?php echo $scart->HandlingRate(); ?> ：</td>
		<td align="right">$<?php echo $scart->HandlingFee(); ?></td>
	</tr>
	<tr>
		<td align="right" colspan='4' style='background-color:#c0c0c0;'>総合計 ：</td>
		<td align="right">$<?php echo $scart->GrandTotal(); ?></td>
	</tr>
	</table>
