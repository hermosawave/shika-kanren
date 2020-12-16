<?php include( 'tpl.html_tag.inc.php'); ?>
<head>
<?php include( 'tpl.html_head.inc.php'); ?>
<title>歯科材の輸入代行　|　歯科関連ドットコム</title>
<script type="text/javascript" src="js/default.js"></script>
<style type="text/css">
<!--
.style2 {font-size: 11pt; line-height: 12pt; font-weight: bold; font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";}
.style3 {color: #FF0000}
-->
</style>
</head>

<body>

<?php include( 'tpl.page_header.inc.php'); ?>

<?php include(INC_FORM_BEGIN); ?>
<input type='hidden' name='_sc' value='_this/search' />

<!-- [BEGIN] Content -->

        <table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="540" height="25" valign="top">            <img src="../pic/titlebar/product.gif" alt="登録商品" width="540" height="25"></td>
        </tr>
        <tr>
          <td height="5" valign="top" class="body1_blk"><span class="style6"><img src="../pic/space.gif" width="1" height="10"> </span> </td>
        </tr>
        <tr>
          <td height="2" align="left" valign="top" class="body1_blk"><div align="left"><strong>歯科関連ドットコム</strong>で登録している主要取扱商品の一覧です。一覧より御希望の商品をお選び下さい。<br>
<br>
  こちらの商品はアメリカ国内で歯科医が購入している<span class="style3"><strong>一般的な市場定価</strong></span>です。<br>
商品によってはカリフォルニア州の<strong>セールスタックス(消費税)</strong>や<strong>送料及び手数料</strong>が、弊社仕入先から加算される場合がございます。<br>
価格は予告なしに変更される場合がございますので、こちらで表示している価格はあくまでも<span class="style3"><strong>参考価格</strong></span>としてご理解下さい。<br>
  <strong><br>
歯科関連ドットコム</strong>ではこの定価に15%の手数料(ご購入合計額が100ドル未満の場合は一律15ドル)を頂きます。<br>
  また商品によってはアメリカ国内の消費税や送料が必要な場合もあります事をご了承下さい。<br>
  <span class="style3">(カッコ内円換算額は$1=￥<?php echo $GLOBALS['yen_per_dollar']; ?>で算出した参考価格です。)
  </span><br>
</div></td>
        </tr>
        <tr>
          <td height="3" align="left" valign="top" class="body1_blk">&nbsp;</td>
        </tr>
        <tr>
          <td height="5" align="left" valign="top" class="body1_blk">御希望の商品が見つからない場合は、<a href="../estimate.php"><strong>こちら</strong></a>よりお問い合せ下さい。<br>
可能な限り御希望商品をお探しして、御見積り致します。</td>
        </tr>
        <tr>
          <td height="5" valign="top" class="body1_blk">
          <br/>
          </td>
        </tr>
        <tr>
          <td valign="top"><table width="540" border="0"cellpadding="2" cellspacing="1" bgcolor="#000000">
            <tr align="center" valign="middle" bgcolor="#99CCFF" class="test">
              <td colspan="4"><div align="center"><strong class="style2"><font size="3"><?php echo $GLOBALS['selected_category']; ?></font></strong></div></td>
            </tr>
            <tr align="center" valign="middle" class="body1_blk">
              <td width="50" height="7" bgcolor="#EEEEEE"><div align="center">写真</div></td>
              <td width="377" bgcolor="#EEEEEE"><div align="center">商品情報</div></td>
              <td bgcolor="#EEEEEE"><div align="center">価格</div></td>
              <td bgcolor="#EEEEEE"><div align="center">詳細</div></td>
            </tr>

<?php while( $hm->zb('@rs:def:begin_table') ) { ?>
            <tr style='background-color:<?php echo ( $hm->zb('rs:def:row_idx') % 2 == 0 ? COLOR_ROW1 : COLOR_ROW2 ); ?>;'>
              <td align='center' height="24" bgcolor="#FFFFFF">
                <a href="index.php?_sc=detail&key:def:product_id=<?php echo $hm->zb('rs:def:product_id'); ?>">
                <?php echo $hm->Zb('rs:def:pic_s'); ?></a>
              </td>
              <td width="377" align="left" valign="middle" bgcolor="#FFFFFF">
                <div align="left">
                <span class="body1_blk">商品番号：<span class="style3">
                <?php echo $hm->Zb('rs:def:product_code'); ?></span><br>
                メーカー： </span>

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

                <span class="body1_blk"><br>
                <strong>商品名：<?php echo $hm->Zb('rs:def:product_name'); ?></strong><br>
                <?php echo $hm->Zb('rs:def:size'); ?></span><br>
                </div>
              </td>
              <td width="60" height="24" valign="middle" bgcolor="#FFFFFF">
                <div align="center" class="body1_blk">
                  $<?php echo $hm->Zb('rs:def:price'); ?><br>
                  <span class="style3">(￥<?php echo $hm->Zb('rs:def:yen'); ?>)</span>
                </div>
              </td>
              <td width="40" valign="middle" bgcolor="#FFFFFF">
                <div align="center">
                <a class="body1_blk" href="index.php?_sc=detail&key:def:product_id=<?php echo $hm->zb('rs:def:product_id'); ?>">詳細</a>
                </div>
              </td>
            </tr>
<?php } ?>

          </table></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">
			<table width="98%" border="0" cellspacing="5" cellpadding="0">
			<tr>
				<td style='text-align:left; color:#808080;'>
				<span class="body1_blk">
				<?php echo $hm->Zb("stat:rs:def:msg"); ?>
				</span>
				</td>
				<td style='text-align:right'>
				<span class="body1_blk">
				<?php echo $hm->Zb("navi:rs:def:page_tabs"); ?>
				</span>
				</td>
			</tr>
			</table>
          </td>
        </tr>
      </table>

<!-- [END] Content -->

<?php include(INC_FORM_END); ?>

<?php include("tpl.page_footer.inc.php"); ?>

</body>
</html>
