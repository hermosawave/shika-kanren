<?php $_NO_NEW_REG_BOX_ = true ?>
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
          <td width="540" valign="top">
            <img src="../pic/titlebar/regist.gif" alt="新規会員登録" width="540" height="25"></td>
        </tr>
        <tr>
          <td height="5" valign="top"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
        </tr>
        <tr>
          <td valign="top">
            <table width="540" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" class="body1_blk">

<div style='padding:0 0 10px 0;'>
以下の入力を確認してください。誤りがある場合は、下の「戻る」ボタンを
クリックして修正してください。確認ができましたら「登録」ボタンをクリックして
登録を完了してください。
</div>
              </td>
            </tr>
            <tr>
              <td height="5">
              <span class="body1_blk">
<?php include( 'tpl.page.info.inc.php' ); ?>
              </span>
              </td>
            </tr>
            <tr>
              <td>
                <table width="539" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" class="test">
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="2" align="center" class="tbl_left"><div align="right">名前(漢字)：</div></td>
                    <td width="413" height="2" align="left" valign="top" class="tbl_right">
                        <?php echo $hm->Zb('rs:def:name_jpn'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="3" align="center" class="tbl_left"><div align="right">名前(半角ローマ字)：</div></td>
                    <td height="3" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:name_alpha'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="5" align="center" class="tbl_left"><div align="right">クリニック名：</div></td>
                    <td width="413" height="5" align="left" valign="top" class="tbl_right">
                        <?php echo $hm->Zb('rs:def:clinic'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="5" align="center" class="tbl_left"><div align="right">郵便番号：</div></td>
                    <td height="5" align="left" valign="top" class="tbl_right">
                      <?php echo $hm->Zb('rs:def:zip'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="5" align="center" class="tbl_left"><div align="right">ご住所：</div></td>
                    <td height="5" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:street1'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="2" align="center" class="tbl_left"><div align="right">電話番号：</div></td>
                    <td height="2" align="left" valign="top" class="tbl_right">
                      <?php echo $hm->Zb('rs:def:tel'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="2" align="center" class="tbl_left"><div align="right">携帯番号：</div></td>
                    <td height="2" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:cell'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td height="3" align="center" class="tbl_left"><div align="right">Ｆａｘ番号：</div></td>
                    <td height="3" align="left" valign="top" class="tbl_right">
                    <?php echo $hm->Zb('rs:def:fax'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="10" align="center" class="tbl_left"><div align="right">E-mailアドレス：</div></td>
                    <td width="413" height="10" align="left" valign="top" class="tbl_right">
                        <?php echo $hm->Zb('rs:def:email'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="10" align="center" class="tbl_left"><div align="right">パスワード：</div></td>
                    <td width="413" height="10" align="left" valign="top" class="tbl_right">
                        <?php echo $hm->Zb('rs:def:password'); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td width="123" height="4" align="center" valign="top" class="tbl_left"><div align="right">通信欄： </div></td>
                    <td width="413" height="4" align="left" valign="top" class="tbl_right">
                        <?php echo $hm->Zb('rs:def:comment', ZB_ATTR, array( 'style'=>array( 'background-color'=>'#FFFFCC' ) ) ); ?></td>
                  </tr>
                  <tr bgcolor="#FFFFCC">
                    <td height="5" colspan="2" align="center" valign="top" class="tbl_right">

<!-- [BEGIN] Buttons -->
<div align="center" style="margin:0px 0px 0px 0px">
<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_page2_next&" ) ); ?>
<table width='100%'>
<tr>
	<td align='center'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/reg_page2_prev&", 'src'=>'prev', 'value'=>"戻る", 'class'=>'def_button' ) ); ?>
	</td>
	<td align='center'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/reg_page2_next&", 'src'=>'send', 'value'=>"登録", 'class'=>'def_button' ) ); ?>
	</td>
</tr>
</table>
</div>
<!-- [END] Buttons -->

                  </td>
                </tr>
                </table>
              </td>
            </tr>
            </table>
          </td>
        </tr>
        </table>

<?php include(INC_FORM_END); ?>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>