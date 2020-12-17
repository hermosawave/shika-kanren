<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, STR_PAGE_TITLE, STR_AREA_TITLE, RSTR_LOG_IN ); ?>

<head><?php include(INC_HTML_HEADER); ?>

<style type="text/css">
span.format_input input {
	width:150px;
}
</style>

</head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<div style='width:400px; margin:0 auto;'>

<!-- [BEGIN] Main Form -->
<?php include(INC_FORM_BEGIN); ?>

<div style="margin-top:80px;"></div>

<?php include(INC_BODY_INFO); ?>

	<!-- [BEGIN] Log In -->
	<?php echo $hm->SectBegin( RSTR_LOG_IN ); ?>

		<div style="margin-top:10px;text-align:center;font-size:18px;">
		<?php echo STR_HOME_TITLE; ?><br>
		<?php echo STR_HOME_SUBTITLE; ?><br>
		</div>

		<!-- [BEGIN] Title -->
		<div style='text-align:center;'>
		</div>
		<!-- [END] Title -->

		<div style="margin-top:20px;">
		</div>

	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<tr>
	  <td class='column_caption' style='width:150px;'><span class="required">*</span> <?php echo RSTR_USERNAME; ?> : </td>
	  <td class='column_value'><span class='format_input'><?php echo $hm->Zb('rs:def:username_login'); ?></span></td>
	</tr>

	<tr>
	  <td class='column_caption' style='width:150px;'><span class="required">*</span> <?php echo RSTR_PASSWORD; ?> : </td>
	  <td class='column_value'><span class='format_input'><?php echo $hm->Zb('rs:def:password_login'); ?></span></td>
	</tr>

	</table>

	<div style="text-align:center;margin-top:20px;margin-bottom:10px;">
		<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>'_sc=_this/auth&', 'src'=>'enter', 'value'=>RSTR_ENTER ) ); ?>
	</div>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] Log In -->

	<?php echo $hm->SectEndMarker(); ?>

<?php include(INC_FORM_END); ?>
<!-- [END] Main Form -->

</div>

<?php include(INC_BODY_FOOTER); ?>

</div>
<!-- [END] Container -->

</body>
</html>

<?php include(INC_HTML_END); ?>
