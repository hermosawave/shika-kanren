<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, STR_PAGE_TITLE, RSTR_MEMBER, $hm->Zb( 'page:caption_verb' ) ); ?>
<?php 
	$verb = $hm->Zb( 'page:verb=' );
	$b_edit = ( $verb == 'edit' );
	$b_del = ( $verb == 'del' );
	$b_reg = ( $verb == 'reg' );
?>

<head><?php include(INC_HTML_HEADER); ?></head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<?php include(INC_BODY_HEADER); ?>

<!-- [BEGIN] Main Form -->
<div id="main_div">

<?php include(INC_FORM_BEGIN); ?>

<?php include(INC_BODY_INFO); ?>

	<?php if ( $hm->Zb("def:display?") ) { ?>

	<!-- [BEGIN] basic_info -->
	<?php echo $hm->SectBegin( RSTR_TRANS ."情報" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<?php if ( $b_edit || $b_del ) { ?>
	<tr>
		<td class='column_caption'><span class="required"></span> ID : </td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:trans_id'); ?></td>
	</tr>
	<?php } ?>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?>
			<span class="required">*</span>
			<?php } ?>
			Active :
		</td>
		<td class='column_value'>
			<?php if ( $b_reg || $b_edit ) { ?>
				<?php echo $hm->Zb('rs:def:active_Y'); ?>Yes&nbsp;&nbsp;&nbsp;
				<?php echo $hm->Zb('rs:def:active_N'); ?>No
			<?php } ?>
			<?php if ( $b_del ) { ?>
				<?php echo $hm->Zb('rs:def:active'); ?>
			<?php } ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			名前(漢字) :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:name_jpn'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			名前(半角ローマ字) :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:name_alpha'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			クリニック名 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:clinic'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			郵便番号 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:zip'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			ご住所1 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:street1'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			ご住所2 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:street2'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			電話番号 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:tel'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			E-mailアドレス :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:email'); ?>
		</td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] basic_info -->

	<!-- [BEGIN] scart -->
	<?php echo $hm->SectBegin( "購入商品" ); ?>

	<div style='margin:10px 0 10px 100px;'>
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
	</div>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] scart -->

	<!-- [BEGIN] delivery -->
	<?php echo $hm->SectBegin( "発送" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			発送方法 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:delivery_method'); ?>
		</td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] delivery -->

	<!-- [BEGIN] staff only -->
	<?php echo $hm->SectBegin( "Staff Only" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			受注状況レベル :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:order_status'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			メモ :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:note'); ?>
		</td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] staff only -->

	<?php if ( $sys->ShowRLog() && ( $b_edit || $b_del ) ) { ?>
	<!-- [BEGIN] rlog -->
	<?php echo $hm->SectBegin( RSTR_RLOG ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<tr>
		<td class='column_caption'><span class="required"></span> <?php echo RSTR_CREATE_DATE_TIME; ?> : </td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:rlog_create_date_time'); ?></td>
	</tr>

	<tr>
		<td class='column_caption'><span class="required"></span> <?php echo RSTR_EDIT_DATE_TIME; ?> : </td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:rlog_edit_date_time'); ?></td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] rlog -->
	<?php } ?>


	<?php echo $hm->SectEndMarker(); ?>

	<!-- [BEGIN] Buttons -->
	<div align="center" style="margin-top:10px">
	<?php if ( $b_reg ) { ?>
		<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_done&" ) ); ?>
	<?php } ?>
	<?php if ( $b_edit ) { ?>
		<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/edit_done&" ) ); ?>
	<?php } ?>
	<table width='100%'>
	<tr>
		<td align='right'>
			<?php if ( $b_reg ) { ?>
				<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/reg_done&", 'src'=>'addnew', 'value'=>RSTR_ADDNEW ) ); ?>
			<?php } ?>
			<?php if ( $b_edit ) { ?>
				<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/edit_done&", 'src'=>'save', 'value'=>RSTR_SAVE ) ); ?>
			<?php } ?>
			<?php if ( $b_del ) { ?>
				<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/del_done&", 'src'=>'delete', 'value'=>RSTR_DELETE ) ); ?>
			<?php } ?>
		</td>
		<td></td>
		<td align='left'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/search_ret&", 'src'=>'cancel', 'value'=>RSTR_CANCEL ) ); ?>
		</td>
	</tr>
	</table>
	</div>
	<!-- [END] Buttons -->

	<?php } ?>

<?php include(INC_FORM_END); ?>

</div>
<!-- [END] Main Form -->

<?php include(INC_BODY_FOOTER); ?>

</div>
<!-- [END] Container -->

</body>
</html>

<?php include(INC_HTML_END); ?>
