<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, STR_PAGE_TITLE, RSTR_MAKER, RSTR_SEARCH ); ?>

<head><?php include(INC_HTML_HEADER); ?></head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<?php include(INC_BODY_HEADER); ?>

<!-- [BEGIN] Main Form -->
<div id="main_div">

<?php include(INC_FORM_BEGIN); ?>
<input type='hidden' name='_sc' value='_this/search' />

<?php include(INC_BODY_INFO); ?>

	<!-- [BEGIN] Search Criteria -->
	<?php echo $hm->SectBegin( RSTR_SEARCH_CRITERIA ); ?>

	<table width='100%'>

	<tr>
		<td align="right">ID : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:maker_id' ); ?></td>
		<td align="right">Active : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:active' ); ?></td>
		<td align="right">メーカー名 : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:maker_name' ); ?></td>
	</tr>

	<tr>
		<td align="right">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="left">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="right"><?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/search_pb&", 'src'=>'search', 'value'=>RSTR_SEARCH ) ); ?></td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] Search Criteria-->

	<!-- [BEGIN] Search Result -->
	<?php if ( $hm->Zb("def:display?") ) { ?>

	<?php echo $hm->SectBegin( RSTR_SEARCH_RESULT ); ?>

	<!-- [BEGIN] Buttons -->
	<div align="center" style="margin:5px 0px 5px 10px;">
	<table width='100%'>
	<tr>
		<td align='left'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/reg_inp&", 'src'=>'addnew', 'value'=>RSTR_ADDNEW ) ); ?>
		</td>
	</tr>
	</table>
	</div>
	<!-- [END] Buttons -->

	<div style='overflow:auto;'>
	<table class='data_table' border="1" cellspacing="0" cellpadding="0">

		<tr class='data_table_caption'>
			<td>ID</td>
			<td>Edit</td>
			<!--<td>Delete</td>-->
			<td>Active</td>
			<td>メーカー名</td>
		</tr>

		<?php while( $hm->zb('@rs:def:begin_table') ) { ?>
		<tr style='background-color:<?php echo ( $hm->zb('rs:def:row_idx') % 2 == 0 ? COLOR_ROW1 : COLOR_ROW2 ); ?>;'>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:maker_id'); ?></td>
			<?php
				$staff_id = $hm->Zb("rs:def:" . $hm->GetDefID() );
				$b_root_user = ( ROOT_USER_ID == $staff_id );
				$param = "key:def:" . $hm->GetDefID() . "=" . $staff_id;
			?>			
			<td style='text-align:center;' valign='middle'><?php
				echo $hm->Button( array( 
 					'<>'=>'<html/>',
 					'name'=>"_sc=_this/edit_inp&{$param}",
 					'value'=>RSTR_EDIT,
 					'class'=>'data_button'
 				) ); ?></td>
			<?php if ( false ) { ?>
			<td style='text-align:center;'><?php
				if ( !$b_root_user ) {
				echo $hm->Button( array( 
 					'<>'=>'<html/>',
 					'name'=>"_sc=_this/del_inp&{$param}",
 					'value'=>RSTR_DELETE,
 					'class'=>'data_button'
 				) ); } else echo "&nbsp;"; ?></td>
			<?php } ?>
			<td style='text-align:center;'><?php echo $hm->Zb('rs:def:active'); ?></td>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:maker_name'); ?></td>
		</tr>
		<?php } ?>

	</table>
	</div>

	<table class='layout_table' width="98%" border="0" cellspacing="5" cellpadding="0">
	<tr>
		<td style='text-align:left; color:#808080;'><span class='data1'><?php echo $hm->Zb("stat:rs:def:msg"); ?></span></td>
		<td style='text-align:right'><?php echo $hm->Zb("navi:rs:def:page_tabs"); ?></td>
	</tr>
	</table>

	<?php echo $hm->SectEnd(); ?>

	<?php } ?>
	<!-- [END] Search Result -->

	<?php echo $hm->SectEndMarker(); ?>

<?php include(INC_FORM_END); ?>

</div>
<!-- [END] Main Form -->

<?php include(INC_BODY_FOOTER); ?>

</div>
<!-- [END] Container -->

</body>
</html>

<?php include(INC_HTML_END); ?>
