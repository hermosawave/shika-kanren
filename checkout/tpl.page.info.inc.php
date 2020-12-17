<?php if ( $hm->Zb("page:info_msg?") ) { ?>
	<!-- [BEGIN] Info Message -->
	<div style='margin:10px;padding:5px 0 5px 10px;font-weight:bold;text-align:left;color:#008000;'>
	<?php echo $hm->Zb("page:info_msg"); ?>
	</div>
	<!-- [END] Info Message -->
<?php } ?>

<?php if ( $hm->Zb("page:err_msg?") ) { ?>
	<!-- [BEGIN] Error Message -->
	<div style='margin:10px;padding:5px 0 5px 10px;font-weight:bold;text-align:left;color:#ff0000;'>
	<?php echo $hm->Zb("page:err_msg"); ?>
	</div>
	<!-- [END] Error Message -->
<?php } ?>
