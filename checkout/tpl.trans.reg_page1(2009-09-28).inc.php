<?php include( 'tpl.html_tag.inc.php'); ?>
<head>
<?php include( 'tpl.html_head.inc.php'); ?>
<title>歯科材の輸入代行　|　歯科関連ドットコム</title>
<style type="text/css">
<!--
.style2 {font-size: 11pt; line-height: 12pt; font-weight: bold; font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";}
.style3 {color: #FF0000}
.style5 {color: #666666}
-->
</style>
</head>

<body>

<?php include( 'tpl.page_header.inc.php'); ?>

<!-- [BEGIN] Content -->

<?php include(INC_FORM_BEGIN); ?>

        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="540" height="25" valign="top">            <img src="../pic/titlebar/checkout2.gif" alt="登録商品" width="540" height="25"></td>
        </tr>
        <tr>
          <td valign="top" class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span> </td>
        </tr>
        <tr>
          <td align="left" valign="top" class="body1_blk"><div align="left">
              <table width="540" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td width="470" align="center" valign="top" bgcolor="#99CCFF"><div align="center"><strong class="style2"><font size="3">発送先情報</font></strong></div></td>
                </tr>
                <tr>
                  <td>
                    <span class="style6"><img src="../pic/space.gif" width="5" height="2"> </span>
              <span class="body1_blk">
<?php include( 'tpl.page.info.inc.php' ); ?>
              </span>
                  </td>
                </tr>
                <tr>
                  <td valign="top"><table width="534" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#0000FF"><table width="534" border="0" cellspacing="1" cellpadding="2">
                        <tr valign="middle" bgcolor="#FFFFFF" class="body1_blk">
                          <td width="145" align="right">お名前(漢字)：</td>
                          <td width="386">
                          <?php echo $hm->Zb('rs:def:name_jpn'); ?>
                          </td>
                        </tr>
                        <tr valign="middle" bgcolor="#FFFFFF" class="body1_blk">
                          <td align="right">お名前(半角ローマ字)：</td>
                          <td>
                            <?php echo $hm->Zb('rs:def:name_alpha'); ?>
                          </td>
                        </tr>
                        <tr valign="middle" bgcolor="#FFFFFF" class="body1_blk">
                          <td align="right">クリニック名：</td>
                          <td>
                            <?php echo $hm->Zb('rs:def:clinic'); ?>
                          </td>
                        </tr>
                        <tr valign="middle" bgcolor="#FFFFFF" class="body1_blk">
                          <td align="right">郵便番号：</td>
                          <td>
                            <?php echo $hm->Zb('rs:def:zip'); ?>
                          </td>
                        </tr>
                        <tr valign="middle" bgcolor="#FFFFFF" class="body1_blk">
                          <td align="right">ご住所：</td>
                          <td>
                            <?php echo $hm->Zb('rs:def:street1'); ?><br>
                            <?php echo $hm->Zb('rs:def:street2'); ?>
                          </td>
                        </tr>
                        <tr valign="middle" bgcolor="#FFFFFF" class="body1_blk">
                          <td align="right">電話番号：</td>
                          <td>
                            <?php echo $hm->Zb('rs:def:tel'); ?>
                          </td>
                        </tr>
                        <tr valign="middle" bgcolor="#FFFFFF" class="body1_blk">
                          <td align="right">E-mailアドレス：</td>
                          <td>
                            <?php echo $hm->Zb('rs:def:email'); ?>
                          </td>
                        </tr>
                        <tr bgcolor="#FFFFFF" class="body1_blk">
                          <td colspan="2"><p>上記発送情報をご確認下さい。　<br>
                            今回の発送情報に変更がある場合は、上記フィールド内に変更をお願いします。<br>
                            登録済み情報に修正が生じた場合は、<a href="<?php echo $_https_; ?>member/index.php?_sc=member/edit_inp&dest=edit_inp">会員情報管理画面</a>で修正下さい。</p>                            </td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
                <tr align="right">
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center" valign="top" bgcolor="#99CCFF"><div align="center"><strong class="style2"><font size="3">ご購入商品</font></strong></div></td>
                </tr>
                <tr>
                  <td><span class="style6"><img src="../pic/space.gif" width="5" height="2"> </span></td>
                </tr>
                <tr>
                  <td align="right" valign="top"><div align="left"></div>                    <div align="left">
                    <table width="534" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#0000FF"><table width="534" border="0" cellpadding="2" cellspacing="1">
<?php
	global $scart;
	foreach( $scart->items as $item )
	{
		$obj =& GetItemObj( $item );
?>
<!-- [BEGIN] Item -->
                          <tr align="left" valign="top" bgcolor="#FFFFFF">
                              <td width="397">商品番号：
                              <span class="body3_red">
                              <?php echo $obj->ProductCode(); ?>
                              </span><br>
                              メーカー：
                              <?php echo $obj->Maker(); ?><br>
                              <strong>商品名：
                              <?php echo $obj->ProductName(); ?>
                              </strong><br>
                              (<?php echo $obj->Size(); ?>)
                            </td>
                            <td width="134">
                              単価：$<?php echo $obj->Price(); ?><br>
                              数量：<?php echo $obj->Qty(); ?><br>
                              <strong>合計：$<?php echo $obj->Total(); ?></strong>
                            </td>
                          </tr>
<!-- [END] Item -->
<?php
	}
?>
                        </table>
                        </td>
                      </tr>
                    </table> 
                    </div>
                  </td>
                </tr>
                <tr align="right" valign="middle">
                  <td><div><span class="style6"><img src="../pic/dot_blue.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td><div class="body1_blk2">合計：$<?php echo $scart->ItemsTotal(); ?></div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td><div><span class="style6"><img src="../pic/dot_red.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td><div class="body1_blk2">手数料<?php echo $scart->HandlingRate(); ?>：
                  $<?php echo $scart->HandlingFee(); ?></div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td><div ><span class="style6"><img src="../pic/dot_red.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td><div>

                  <span class="bodytop1_blk">総合計：
                  $<?php echo $scart->GrandTotal(); ?>
                  </span><br>
                  <strong><span class="style3">
                  (￥<?php echo $scart->GrandTotalYen(); ?>)
                  </span></strong>
                  </div></td>
                </tr>
                <tr align="right" valign="middle">
                  <td><div ><span class="style6"><img src="../pic/dot_red.gif" width="530" height="1"> </span>
                  </div></td>
                </tr>
                <tr align="center" valign="middle">
                  <td>
                  <div align="center">

<!-- [BEGIN] Buttons -->
<div align="center" style="margin-top:0px">
<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_page1_next&" ) ); ?>
<table width='100%'>
<tr>
	<td align='left'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/go2scart&", 'value'=>"購入商品リストへ戻る", 'class'=>'def_button' ) ); ?>
	</td>
	<td>&nbsp;&nbsp;&nbsp;</td>
	<td align='right'>
		<?php echo $hm->Button( array( '<>'=>'<html/>', 'name'=>"_sc=_this/reg_page1_next&", 'value'=>"&nbsp;&nbsp;&nbsp;確認ページへ進む&nbsp;&nbsp;&nbsp;", 'class'=>'def_button' ) ); ?>
	</td>
</tr>
</table>
</div>
<!-- [END] Buttons -->

                  </div>
                  </td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
          <td valign="top" align='left'>
            <span class="body1_blk"><span class="style5"><br>
■上記価格は代理購入の為、ご注文後に変更される可能性があります。</span></span><br/>
            <span class="body1_blk"><span class="style5">■海外送金でお支払いの場合は、銀行振り込み手数料として別途費用をご請求致します。<br>
■アメリカから日本への送料は、発送方法や条件に応じて加算されます。<br>
■米国内消費税及び送料が、商品によっては発注時に加算される事があります。<br>
            ■商品代引きでのご請求は行なっておりません。<br>
            ■通関時に日本での税金として、送料と商品代の合計に消費税が加算されます。<br>
■送料着払いの際は配達時に請求されますので、商品と引換にお支払い下さい。<br>
            ■</span><span class="style3">カッコ内は1ドル=<?php echo $GLOBALS['yen_per_dollar']; ?>円で算出した円換算の参考価格です。</span></span><br>          </td>
        </tr>
      </table>

<?php include(INC_FORM_END); ?>

<!-- [END] Content -->

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>