<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, STR_PAGE_TITLE, RSTR_TRANS, RSTR_SEARCH ); ?>

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
		<td align="left"><?php echo $hm->Zb( 'sp:def:trans_id' ); ?></td>
		<td align="right">Active : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:active' ); ?></td>
		<td align="right">受注状況レベル : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:order_status' ); ?></td>
	</tr>

	<tr>
		<td align="right">名前(漢字) : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:name_jpn' ); ?></td>
		<td align="right">名前(半角ローマ字) : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:name_alpha' ); ?></td>
		<td align="right">&nbsp;</td>
		<td align="left">&nbsp;</td>
	</tr>

	<tr>
		<td align="right">Email : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:email' ); ?></td>
		<td align="right">クリニック名 : </td>
		<td align="left"><?php echo $hm->Zb( 'sp:def:clinic' ); ?></td>
		<td align="right">&nbsp;</td>
		<td align="right"><?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/search_pb&", 'src'=>'search', 'value'=>RSTR_SEARCH ) ); ?></td>
	</tr>

	</table>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] Search Criteria-->

	<!-- [BEGIN] Search Result -->
	<?php if ( $hm->Zb("def:display?") ) { ?>

	<?php echo $hm->SectBegin( RSTR_SEARCH_RESULT ); ?>

	<div style='overflow:auto;'>
	<table class='data_table' border="1" cellspacing="0" cellpadding="0">

		<tr class='data_table_caption'>
			<td>ID</td>
			<td>Edit</td>
			<!--<td>Delete</td>-->
			<td>Active</td>
			<td>日付</td>
			<td>受注状況レベル</td>
			<td>名前(漢字)</td>
			<td>名前(半角ローマ字)</td>
			<td>クリニック名</td>
			<td>Email</td>
		</tr>

		<?php while( $hm->zb('@rs:def:begin_table') ) { ?>
		<tr style='background-color:<?php echo ( $hm->zb('rs:def:row_idx') % 2 == 0 ? COLOR_ROW1 : COLOR_ROW2 ); ?>;'>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:trans_id'); ?></td>
			<?php
				$def_id = $hm->Zb("rs:def:" . $hm->GetDefID() );
				$param = "key:def:" . $hm->GetDefID() . "=" . $def_id;
			?>			
			<td style='text-align:center;' valign='middle'><?php
				echo $hm->Button( array( 
 					'<>'=>'<html/>',
 					'name'=>"_sc=_this/edit_inp&{$param}",
 					'value'=>RSTR_DETAIL,
 					'class'=>'data_button'
 				) ); ?></td>
			<?php if ( false ) { ?>
			<td style='text-align:center;'><?php
				echo $hm->Button( array( 
 					'<>'=>'<html/>',
 					'name'=>"_sc=_this/del_inp&{$param}",
 					'value'=>RSTR_DELETE,
 					'class'=>'data_button'
 				) ); ?></td>
			<?php } ?>
			<td style='text-align:center;'><?php echo $hm->Zb('rs:def:active'); ?></td>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:rlog_create_date_time'); ?></td>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:order_status'); ?></td>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:name_jpn'); ?></td>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:name_alpha'); ?></td>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:clinic'); ?></td>
			<td style='text-align:left;'><?php echo $hm->Zb('rs:def:email'); ?></td>
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
