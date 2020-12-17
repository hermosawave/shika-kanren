<?php include( 'tpl.html_tag.inc.php'); ?>
<head>
<?php include( 'tpl.html_head.inc.php'); ?>
<title>歯科材の輸入代行　|　歯科関連ドットコム</title>
</head>

<body>

<?php include( 'tpl.page_header.inc.php'); ?>

<!-- [BEGIN] Content -->

<?php include(INC_FORM_BEGIN); ?>
<input type='hidden' name='dest' value='<?php echo $sys->GetIV( 'dest' ); ?>' />
      <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="540" valign="top"><img src="../pic/titlebar/login.gif" alt="ログイン" width="540" height="25"></td>
        </tr>
        <tr>
          <td valign="top"><div align="left" class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></div></td>
        </tr>
        <tr>
          <td align="left" valign="top"><div align="left"><span class="body1_blk"><strong>歯科関連ドットコム</strong>で購入を頂く前に、こちらから会員資格を確認致します。<br>
お手数ですが登録されているe-mailアドレスとパスワードを入力下さい。</span></div><br/></td>
        </tr>
        <tr>
          <td align="left" valign="top">
<span class="body1_blk">
<?php include( 'tpl.page.info.inc.php' ); ?>
</span>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top"><div align="left">
                <table width="426" border="0" cellpadding="5" cellspacing="1" bgcolor="#000000" class="form_box" >
                  <tr bgcolor="#D7EBFF">
                    <th width="103" align="right" class="body1_blk"><div align="right"><strong>E-Mailアドレス</strong></div></th>
                    <td width="274">
                      <div align="left">
                      <?php echo $hm->Zb('rs:def:email_login'); ?>
                    </div></td>
                  </tr>
                  <tr bgcolor="#D7EBFF">
                    <th width="103" align="right" class="body1_blk"><div align="right"><strong>パスワード</strong></div></th>
                    <td width="274" bgcolor="#D7EBFF">
                      <div align="left">
                      <?php echo $hm->Zb('rs:def:password_login'); ?>
                    </div></td>
                  </tr>
                  <tr bgcolor="#D7EBFF">
                    <td colspan="2" align="center">
<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>'_sc=_this/auth&', 'value'=>"ログイン", 'class'=>'def_button' ) ); ?>
                    </td>
                  </tr>
                </table>
          </div></td>
          </tr>
        <tr>
          <td align="left" valign="top"><span class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></span></td>
        </tr>
        <tr>
          <td align="left" valign="top"><div align="left"><span class="body1_blk">■<a href="../register/index.php?_sc=member/sendpass_init&">ログインパスワードをお忘れですか？こちらで確認下さい。</a></span></div></td>
        </tr>
        <tr>
          <td align="left" valign="top"><span class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span></span></td>
        </tr>
        <tr>
          <td align="left" valign="top" class="body1_blk"><div align="left">■<a href="../register/index.php">まだ登録されていない場合は、こちらから会員登録(無料)をお願いします。</a></div></td>
        </tr>
        <tr>
          <td align="left" valign="top"><span class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="250"> </span></span></td>
        </tr>
      </table>
      
<?php include(INC_FORM_END); ?>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>