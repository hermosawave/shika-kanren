<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, STR_PAGE_TITLE, RSTR_PRODUCT, $hm->Zb( 'page:caption_verb' ) ); ?>
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

<?php $_form_params_ = "enctype='multipart/form-data'"; ?>
<?php include(INC_FORM_BEGIN); ?>

<?php include(INC_BODY_INFO); ?>

	<?php if ( $hm->Zb("def:display?") ) { ?>

	<!-- [BEGIN] basic_info -->
	<?php echo $hm->SectBegin( $hm->Zb( 'page:caption_verb' ) . " [" . RSTR_PRODUCT ."]" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<?php if ( $b_edit || $b_del ) { ?>
	<tr>
		<td class='column_caption'><span class="required"></span> ID : </td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:product_id'); ?></td>
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
			表示順序 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:view_order'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			商品コード :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:product_code'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			商品名 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:product_name'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			カテゴリ :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:category_id'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			メーカー :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:maker_id'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			単価 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:price'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			サイズ :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:size'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			説明 :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:description'); ?>
		</td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] basic_info -->

	<!-- [BEGIN] pic_info -->
	<?php echo $hm->SectBegin( "画像" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			画像 :
		</td>
		<td class='column_value'>
			<?php if ( $hm->Zb('rs:def:pic_m_state=') == 'E' ) { ?>
			<span style='font-size:80%'>
			Allowable image types : jpg, gif, png<br/>
			Maximum image size : 180 pixels [width] x 180 pixels [height]<br/>
			</span>
			<?php } ?>

			<?php echo $hm->Zb('rs:def:pic_m'); ?>

			<?php if ( $hm->Zb('rs:def:pic_m_state=') == 'E' ) { ?>
				<br/>
				<span style='font-size:80%'>
				Use [Browse...] to select a picutre and then click
				</span>
				<input type="submit" name="_sc=_this/<?php echo $verb; ?>_inp_file_upload&fileup_key=pic_m" value="Upload"/>
			<?php } else { ?>
				<br/>
				<input type="submit" name="_sc=_this/<?php echo $verb; ?>_inp_file_remove&fileup_key=pic_m" value="Remove"/>
			<?php } ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			画像(サムネイル) :
		</td>
		<td class='column_value'>
			<?php if ( $hm->Zb('rs:def:pic_s_state=') == FILEUP_EMPTY_FILE ) { ?>
			<span style='font-size:80%'>
			Allowable image types : jpg, gif, png<br/>
			Maximum image size : 50 pixels [width] x 50 pixels [height]<br/>
			</span>
			<?php } ?>

			<?php echo $hm->Zb('rs:def:pic_s'); ?>

			<?php if ( $hm->Zb('rs:def:pic_s_state=') == 'E' ) { ?>
				<br/>
				<span style='font-size:80%'>
				Use [Browse...] to select a picutre and then click
				</span>
				<input type="submit" name="_sc=_this/<?php echo $verb; ?>_inp_file_upload&fileup_key=pic_s" value="Upload"/>
			<?php } else { ?>
				<br/>
				<input type="submit" name="_sc=_this/<?php echo $verb; ?>_inp_file_remove&fileup_key=pic_s" value="Remove"/>
			<?php } ?>
		</td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] pic_info -->

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
