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
          <td width="540" height="25" valign="top">            <img src="../pic/titlebar/passwd.gif" alt="パスワード再発行" width="540" height="25"></td>
        </tr>
        <tr>
          <td height="5" valign="top"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></td>
        </tr>
        <tr>
          <td height="2" align="left" valign="top"><div align="left"><span class="body1_blk">ご登録のメールアドレスを入力して下さい。　<br>
  追って登録メールアドレスにパスワード再発行の通知をお送り致します。</span></div></td>
        </tr>
        <tr>
          <td height="5" valign="top">
              <span class="body1_blk">
<?php include( 'tpl.page.info.inc.php' ); ?>
              </span>
          </td>
        </tr>
        <tr>
          <td valign="top"><div align="left">
              <table width="400" border="0" cellpadding="5" cellspacing="1" bgcolor="#000000" class="form_box" >
                <tr bgcolor="#D7EBFF">
                  <th width="125" align="right" bgcolor="#D7EBFF" class="body1_blk"><strong>E-Mailアドレス</strong></th>
                  <td width="163">
                    <?php echo $hm->Zb('rs:def:email'); ?>
                  </td>
                </tr>
                <tr bgcolor="#FFFFFF">

                  <td colspan="2" align="center">

<!-- [BEGIN] Buttons -->
<div align="center" style="margin-top:0px">
<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/sendpass_page1_next&" ) ); ?>
<table width='100%'>
<tr>
	<td align='center'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/sendpass_page1_next&", 'src'=>'next', 'value'=>"送信", 'class'=>'def_button' ) ); ?>
	</td>
</tr>
</table>
</div>
<!-- [END] Buttons -->

                  </td>
                </tr>
              </table>
          </div></td>
        </tr>
      </table>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>