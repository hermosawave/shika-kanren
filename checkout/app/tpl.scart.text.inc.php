---------------------------------------------
購入商品
<?php
	global $scart;
	$idx = 1;
	foreach( $scart->items as $item )
	{
		$obj =& GetItemObj( $item );
?>
---------------------------------------------
[ <?php echo $idx; ?> ]
商品番号 : <?php echo $obj->ProductCode() . "\r\n"; ?>
商品名 : <?php echo $obj->ProductName() . "\r\n"; ?>
         <?php echo $obj->Maker(false) . "\r\n"; ?>
         (<?php echo $obj->Size(); ?>)
単価 : $<?php echo $obj->Price() . "\r\n"; ?>
数量 : <?php echo $obj->Qty() . "\r\n"; ?>
合計 : $<?php echo $obj->Total() . "\r\n"; ?>
<?php $idx++; } ?>
---------------------------------------------
合計 : $<?php echo $scart->ItemsTotal() . "\r\n"; ?>
手数料 : $<?php echo $scart->HandlingFee() . "\r\n"; ?>
総合計 : $<?php echo $scart->GrandTotal() . "\r\n"; ?>
---------------------------------------------
