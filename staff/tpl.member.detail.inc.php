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
	<?php echo $hm->SectBegin( $hm->Zb( 'page:caption_verb' ) . " [" . RSTR_MEMBER ."]" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<?php if ( $b_edit || $b_del ) { ?>
	<tr>
		<td class='column_caption'><span class="required"></span> ID : </td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:member_id'); ?></td>
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
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			携帯番号 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:cell'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			Ｆａｘ番号 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:fax'); ?>
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

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			パスワード :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:password'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			通信欄 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:comment'); ?>
		</td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] basic_info -->

	<!-- [BEGIN] staff only -->
	<?php echo $hm->SectBegin( "Staff Only" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

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
