<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, STR_PAGE_TITLE, RSTR_CONST, $hm->Zb( 'page:caption_verb' ) ); ?>
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
	<?php echo $hm->SectBegin( "ドル-円レート" ); ?>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<?php if ( false ) { ?>
	<?php if ( $b_edit || $b_del ) { ?>
	<tr>
		<td class='column_caption'><span class="required"></span> ID : </td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:const_id'); ?></td>
	</tr>
	<?php } ?>
	<?php } ?>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			$1=
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:yen'); ?> 円
		</td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] basic_info -->

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
		<td align='center'>
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

		<?php if ( false ) { ?>
		<td align='left'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/search_ret&", 'src'=>'cancel', 'value'=>RSTR_CANCEL ) ); ?>
		</td>
		<?php } ?>

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
