<?php include( 'tpl.html_tag.inc.php'); ?>
<head>
<?php include( 'tpl.html_head.inc.php'); ?>
<title>歯科材の輸入代行　|　歯科関連ドットコム</title>
</head>

<body>

<?php include( 'tpl.page_header.inc.php'); ?>

<!-- [BEGIN] Content -->

<?php include(INC_FORM_BEGIN); ?>

       <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="540" height="25" valign="top">            <img src="../pic/titlebar/product.gif" alt="登録商品" width="540" height="25"></td>
        </tr>
        <tr>
          <td valign="top" class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span> </td>
        </tr>
        <tr>
          <td align="left" valign="top" class="body1_blk"><div align="left">
              <table width="540" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td colspan="2" align="center" valign="top" bgcolor="#99CCFF">
                  <div align="center">
                  <strong class="style2">
                  <font size="3"><?php echo $hm->Zb('rs:def:category_id'); ?></font>
                  </strong>
                  </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2"><span class="style6"><img src="../pic/space.gif" width="5" height="2"> </span></td>
                </tr>
                <tr>
                  <td width="200" rowspan="6" align="left" valign="top">
                  <div align="center">
<?php echo $hm->Zb('rs:def:pic_m'); ?>
                  </div>
                  </td>
                  <td width="328" align="left" valign="top"><div align="left"> 商品番号：
                  <span class="body3_red"><?php echo $hm->Zb('rs:def:product_code'); ?>
                  </span><br>
                  </div></td>
                </tr>

                <tr>
                  <td align="left" valign="top" class="body1_blk">メーカー：
				<!-- [BEGIN] Maker Link -->
                <?php
					$ax = GetMakerInfo( $hm->Zb('rs:def:maker_id_raw') );
					$b_link = ( $ax['url'] != null );
                ?>
                <span class="body1_blk">
				<?php if ( $b_link ) { ?>
                <a href="<?php echo $ax['url']; ?>" target="_blank">
				<?php } ?>
                <?php echo $ax['name']; ?>
				<?php if ( $b_link ) { ?></a><?php } ?>
                </span>
				<!-- [END] Maker Link -->

                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="body1_blk"><strong>商品名：
                  <?php echo $hm->Zb('rs:def:product_name'); ?></strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="body1_blk">
                  (<?php echo $hm->Zb('rs:def:size'); ?>)</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="body1_blk">
                  <?php echo str_replace( "\r\n", "<br/>", $hm->Zb('rs:def:description_raw') ); ?>
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top" bgcolor="#FFFFCC" class="body1_blk">
                  $<?php echo $hm->Zb('rs:def:price'); ?>
                  <span class="style3">(￥<?php echo $hm->Zb('rs:def:yen'); ?>)
                  </span></td>
                </tr>
                <tr align="center" valign="middle">
                  <td colspan="2"><div align="center"><span class="style6"><img src="../pic/dot_blue.gif" width="520" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="center" valign="middle">
                  <td colspan="2"><div align="center">

<!-- [BEGIN] Buttons -->
<div align="center" style="margin-top:0px">
<table width='100%'>
<tr>
	<td align='center'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/scart_add&pid=" . $hm->Zb('rs:def:product_id') . "&", 'value'=>"購入", 'class'=>'def_button' ) ); ?>
	</td>
</tr>
</table>
</div>
<!-- [END] Buttons -->

                  </div></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
      </table>

<?php include(INC_FORM_END); ?>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>