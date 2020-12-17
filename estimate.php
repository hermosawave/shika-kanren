<?php include( 'common.inc.php' ); ?>
<?php
	$_SENDMAIL_CONFIG_FILE_ = 'estimate';
	include( 'sendmail.inc.php');
?>
<?php include( 'tpl.html_tag.inc.php'); ?>
<head>
<?php include( 'tpl.html_head.inc.php'); ?>
<title>歯科材の輸入代行　|　歯科関連ドットコム</title>
<style type="text/css">
<!--
.style1 {
	font-size: 10pt;
	line-height: 11pt;
	color: #000000;
	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
<script>
function formOnSubmit()
{
	var f = document.forms["main"];
	for ( var i = 0; i < f.elements.length; i++ )
	{
		var ele = f.elements[i];
		var ch = ele.name.substr( 0, 1 );
		if ( ch == "*" )
		{
			var s = ele.value;
			if ( s == "" )
			{
				var v = ele.name.substr( 1 );
				alert( "「" + v + "」が記入されていません。" );
				return false;
			}
		}
	}

	return true;
}
</script>
</head>

<body>

<?php include( 'tpl.page_header.inc.php'); ?>

<!-- [BEGIN] Content -->

      <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="540" valign="top"><img src="pic/titlebar/estimate.gif" alt="見積依頼" width="540" height="25"></td>
        </tr>
        <tr>
          <td height="5" valign="top"><span class="style6"><img src="pic/space.gif" width="1" height="10"> </span></td>
        </tr>
        <tr>
          <td valign="top"><div align="left"><span class="body1_blk"><strong>歯科関連ドットコム</strong>は、個人輸入代行業者です。もし当サイトに掲載していない歯科材料や医療機器など、御希望の商品も可能な限りお探しして、御見積り致します。<br>
            商品を探し御見積りまでは手数料はかかりません。<br>
            ご希望商品をご成約時に、<span class="style2">20％(合計金額が100ドル未満の場合は一律20ドル)</span>の手数料を加算させて頂きます。<br>
            御希望商品のお問い合せは以下のフォーム、もしくは<a href="mailto:ask@shika-kanren.com">メール(ask@shika-kanren.com)</a>よりお知らせ下さい。<br>
            </span><span class="style1"><br>
            【ご注意】<br>
            歯科関連ドットコム</span><span class="body1_blk">は日本の歯科医限定の会員サイトです。見積依頼も基本的に登録頂いている会員様もしくは日本国歯科医師免許保有の歯科医様のみとさせて頂きます。<br>
(一部歯科技工用商品等につきましては、歯科技工関係者様にもご提供させて頂きます。)            </span></div></td>
        </tr>
        <tr>
          <td height="5" valign="top"><span class="style6"><img src="pic/space.gif" width="1" height="10"> </span></td>
        </tr>
        <tr>
          <td valign="top">
            <form action="estimate.php" method="post" name="main" onsubmit="return formOnSubmit();">
            <table width="539" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" class="test">
              <input type="hidden" name="redirect" value="estimate_sent.php">
              <tr bgcolor="#FFFFFF">
                <td height="2" align="center" class="tbl_left"><div align="right">名前(漢字)：</div></td>
                <td height="2" align="left" valign="top" class="tbl_right">
                  <div align="left">
                    <input name="*名前(漢字)" class="body1_blk" size=30 maxlength="50">
                    <span class="body3_red">※必修</span> <br>
      (例：志賀太郎)</div></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="3" align="center" class="tbl_left"><div align="right">名前(半角ローマ字)：</div></td>
                <td height="3" align="left" valign="top" class="tbl_right">
                    <input name="*名前(半角ローマ字)" class="body1_blk" size=30 maxlength="50">
                    <span class="body3_red">※必修</span><br>
    (例：Taro Shika)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="5" align="center" class="tbl_left"><div align="right">クリニック名：</div></td>
                <td height="5" align="left" valign="top" class="tbl_right">
                  <div align="left">
                    <input name="*クリニック名" class="body1_blk" size=30 maxlength="50">
                    <span class="body3_red">※必修</span><br>
      (例：しか歯科医院)<br>
                </div></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="5" align="center" class="tbl_left"><div align="right">郵便番号：</div></td>
                <td height="5" align="left" valign="top" class="tbl_right">
                  <input name="郵便番号" class="body1_blk" size=10 maxlength="8">                    <br>
    (例：123-0001)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="5" align="center" class="tbl_left"><div align="right">ご住所：</div></td>
                <td height="5" align="left" valign="top" class="tbl_right"><input name="住所1" class="body1_blk" id="住所1" size=50 maxlength="50">                    <br>
    (例：東京都港区赤坂1丁目1-1) <br>
    <input name="住所2" class="body1_blk" id="住所2" size=50 maxlength="50">
    <br>
    (例：赤坂ビル1F) </td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="2" align="center" class="tbl_left"><div align="right">電話番号：</div></td>
                <td height="2" align="left" valign="top" class="tbl_right">
                   <input name="*電話番号" class="body1_blk" id="電話番号" size=30 maxlength="50">
                    <span class="body3_red">※必修</span><br>
    (例：03-1234-1000)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="2" align="center" class="tbl_left"><div align="right">携帯番号：</div></td>
                <td height="2" align="left" valign="top" class="tbl_right">
                  <input name="携帯番号" class="body1_blk" id="携帯番号" size=30 maxlength="50">
                    <br>
    (例：090-1234-1000)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="3" align="center" class="tbl_left"><div align="right">Ｆａｘ番号：</div></td>
                <td height="3" align="left" valign="top" class="tbl_right">
                  <input name="Ｆａｘ番号" class="body1_blk" size=30 maxlength="50">
                    <br>
    (例：03-1234-1001)</td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td height="10" align="center" class="tbl_left"><div align="right">E-mailアドレス：</div></td>
                <td height="10" align="left" valign="top" class="tbl_right">
                  <div align="left">
                    <input name="*E-mailアドレス" class="body1_blk" size=30 maxlength="50">
                    <span class="body3_red">※必修</span><br>
      (例：shika_taro@shika-kanren.com)</div></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td width="123" height="4" align="center" valign="top" class="tbl_left"><div align="right">お問合せ： </div></td>
                <td width="413" height="4" align="left" valign="top" class="tbl_right">
                  <div align="left">
                    <textarea wrap=physical name="お問い合わせ内容" cols=50 rows=10></textarea>
                    <br>
                    <br>
                </div></td>
              </tr>
              <tr bgcolor="#FFFFCC">
                <td height="5" colspan="2" align="center" valign="top" class="tbl_right">
        <input type="reset" value="リセット" class="def_button">&nbsp;&nbsp;&nbsp;
        <input type="submit" value="  登録  " class="def_button">
                </td>
              </tr>
            </table>
          </form></td>
        </tr>
      </table>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>