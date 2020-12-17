<?php if ( $hm->Zb("page:info_msg?") ) { ?>
<!-- [BEGIN] Info Message -->
<div style='margin-top:10px;'></div>
<?php $hm->SectBegin("Info"); ?>
<div style='padding:5px 0 5px 10px;font-weight:bold;text-align:left;color:#008000;'>
<?php echo $hm->Zb("page:info_msg"); ?>
</div>
<?php $hm->SectEnd(); ?>
<div style='margin-top:10px;'></div>
<!-- [END] Info Message -->
<?php } ?>

<?php if ( $hm->Zb("page:err_msg?") ) { ?>
<!-- [BEGIN] Error Message -->
<div style='margin-top:10px;'></div>
<?php $hm->SectBegin("Error"); ?>
<div style='padding:5px 0 5px 10px;font-weight:bold;text-align:left;color:red;'>
<?php echo $hm->Zb("page:err_msg"); ?>
</div>
<?php $hm->SectEnd(); ?>
<div style='margin-top:10px;'></div>
<!-- [END] Error Message -->
<?php } ?>
